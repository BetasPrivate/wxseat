<?php
class SeatsController extends AppController {
	public $uses = [
		'Seat',
		'SeatTypePriceRelation',
		'Trade',
		'Order',
	];

	function index()
	{
		$this->set('title_for_layout', '预订工位');
		
		$this->Seat->releaseSeats();
		$this->Trade->closeTrades();
		$this->Order->disableOrders();

		$seats = $this->Seat->find('all', [
			'conditions' => [
				'is_deleted' => 0,
			],
		]);


		$result['seats'] = $seats;
		$this->set(compact('result'));
	}

	function checkSeatsAvailable()
	{
		$data = $this->request->data['json'];
		$seatIds = isset($data['seatIds']) ? $data['seatIds'] : [];

		if (AuthComponent::user('is_activated') == 0) {
			$result = [
				'status' => 0,
				'msg' => '当前账号已被禁用，请联系管理员激活',
			];
			echo json_encode($result);
			exit();
		}

		if (sizeof($seatIds) == 0) {
			$result = [
				'status' => 0,
				'msg' => '不可选的座位，请重试',
			];
			echo json_encode($result);
			exit();
		}
		$startDate = date('Y-m-d', strtotime($data['startDate']));
		$endDate = date('Y-m-d', strtotime($data['endDate']));
		$result['status'] = 1;
		$result['room_id'] = 1;

		$checkResult = $this->Seat->getUnavaliableIdInfos($seatIds, $startDate, $endDate);
		if (sizeof($checkResult['unavaliableIdInfos']) != 0) {
			$result['status'] = 0;
			$msg = '';
			foreach($unavaliableIdInfos as $seatId => $info)
			{
				$msg .= '座位号：'.$seatId.'。在'.$info['endDate'].'之前被占用。';
			}
			$result['msg'] = $msg;
		} else {
			$infoResult = $this->Seat->getAvaliableSeatInfos($seatIds);
			$result['info'] = $infoResult['avaliableIdInfos'];
			$result['dates'] = [
				'startDate' => $startDate,
				'endDate' => $endDate,
			];
		}

		$this->layout = "ajax";
		$this->set(compact('result'));
	}

	public function rentSeats()
	{
		$this->set('title_for_layout', '订单信息');
		$data = $this->request->data;

		$infoStr = $data['seatInfo'];

		//info => [], dates => []
		$postInfos = json_decode($infoStr, true);
		$dates = $postInfos['dates'];
		$isConference = isset($postInfos['is_conference']) ? $postInfos['is_conference'] : false;

		if ($isConference) {
			$conferenceId = $postInfos['conference_id'];
			$seatIds = $this->Seat->find('first', [
				'conditions' => [
					'Seat.id' => $conferenceId,
				],
			])['SeatType']['name'];
			$price = $this->Seat->getConferencePrice($dates, $conferenceId);
			$deposit = $this->Seat->getDeposit($conferenceId);

			$idInfos = ['0' => $conferenceId];
		} else {
			$idInfos = $postInfos['info'];
			//为了在前端展示
			$seatIds = '';
			//为了查数据库
			$seatIdStr = '';

			foreach ($idInfos as $idInfo) {
				$seatIds .= ','.$idInfo['seatId'];
				$seatIdStr .= ",'".$idInfo['seatId']."'";
			}
			$seatIds = substr($seatIds, 1);
			$seatIdStr = '('.substr($seatIdStr, 1).')';

			//总金额
			$price = $this->Seat->getSeatPrices($seatIdStr);

			//总押金
			$deposit = $this->Seat->getDeposit($seatIdStr);
		}


		$result = [
			'idInfo' => $seatIds,
			'price' => $price,
			'seatInfo' => $idInfos,
			'totalFee' => $price + $deposit,
			'dates' => $dates,
			'deposit' => $deposit,
			'isConference' => $isConference,
		];

		$this->set(compact('result'));
	}

	public function editSeatInfo()
	{
		$data = $this->request->data;

		// $startDate = $data['start_date'];
		// $endDate = $data['end_date'];
		// $username = $data['username'];
		$price = $data['price'];
		$deposit = $data['deposit'];
		$seatId = $data['seat_id'];
		$freeTime = isset($data['free_time']) ? $data['free_time'] : null;

		$saveData = [
			'price' => $price,
			'deposit' => $deposit,
		];
		if ($freeTime) {
			$saveData['status'] = $this->Seat->getOccupiedStatus();
			$saveData['free_time'] = $freeTime;
		}
		$this->Seat->id = $seatId;
		$saveResult = $this->Seat->save($saveData);

		if ($saveResult) {
			$result = [
				'status' => 1,
			];
		} else {
			$result = [
				'status' => 0,
				'msg' => '保存失败，请重试',
			];
		}
		echo json_encode($result);
		exit();
	}

	public function rentConference($conferenceName='泛态厅')
	{
		$conferenceId = $this->Seat->getConferenceIdByConferenceName($conferenceName);
		if (!$conferenceId) {
			$result = [
				'status' => 0,
				'msg' => '无效的会议室！',
			];
			echo '无效的会议室, 请联系管理员！';
			exit();
		}

		if ($this->request->is('post')) {
			$data = $this->request->data;
			if (!isset($data['arr']) || sizeof($data['arr']) == 0) {
				$result = [
					'status' => 0,
					'msg' => '请选择正确的预订时间',
				];
				echo json_encode($result);
				exit();
			}
			$conferenceName = $data['conferenceName'];
			$conferenceId = $this->Seat->getConferenceIdByConferenceName($conferenceName);

			if (!$this->Seat->checkConferenceLegal($data)) {
				$result = [
					'status' => 0,
					'msg' => '请符合选会议室的规则',
				];
				echo json_encode($result);
				exit();
			}

			$datesArr = json_decode($data['arr'], true);

			$dates = $this->Seat->parseConferenceRentData($datesArr);

			$saveResult = $this->Order->createPendingOrderForConference($conferenceId, $dates);

			if ($saveResult['status'] == 1) {
				$result = [
					'status' => 1,
					'dates' => $dates,
					'conference_id' => $conferenceId,
				];
			} else {
				$result = [
					'status' => 0,
					'msg' => '会议室信息有变更，请刷新页面重试',
				];
			}

			echo json_encode($result);
			exit();
		}

		//得到当前会议室不可以被租赁的时间段
		$conferenceRentInfos = $this->Seat->getConferenceRentInfos($conferenceId);

		$this->set(compact('conferenceRentInfos', 'conferenceName'));
	}
}