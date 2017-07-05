<?php
class SeatsController extends AppController {
	public $uses = [
		'Seat',
		'SeatTypePriceRelation',
		'Trade',
	];

	function index()
	{
		$this->set('title_for_layout', '预订工位');
		
		$this->Seat->releaseSeats();
		$this->Trade->closeTrades();

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
		$idInfos = $postInfos['info'];
		$dates = $postInfos['dates'];

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

		$result = [
			'idInfo' => $seatIds,
			'price' => $price,
			'seatInfo' => $idInfos,
			'totalFee' => $price + $deposit,
			'dates' => $dates,
			'deposit' => $deposit,
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
}