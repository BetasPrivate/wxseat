<?php
App::uses('Seat', 'Model');
App::uses('User', 'Model');
class SuController extends AppController{
	public $uses = [
		'Trade',
		'Token',
		'Seat',
		'User',
		'WifiConfig',
		'SeatType',
		'EntranceGuardConfig',
		'Protocol',
	];

	public function index()
	{
		$this->set('title_for_layout', '管理中心');
		// $query = sprintf("select * from trades Trade left join orders `Order` on Trade.id = `Order`.trade_id left join users User on User.id = Trade.user_id where Trade.is_deleted = 0;");
		// $trades = $this->Trade->query($query);

		// $result['trades'] = $trades;
		// $this->set(compact('result'));
		$util = new Utility();
        $util->editMenu($this->Token->getToken(\Token::ACCESS_TOKEN));
	}

	public function updateProtocols()
	{
		if (!$this->request->is('post')) {
			$protocols = $this->Protocol->find('all', [
			]);
			foreach ($protocols as &$protocol) {
				$protocol['Protocol']['text'] = str_replace("\n",'<br>',$protocol['Protocol']['text']);;
			}
		} else {
			$data = $this->request->data;
			$saveRes = $this->Protocol->save($data);
			$result = [
				'status' => 0,
				'msg' => '',
			];
			if ($saveRes) {
				$result['status'] = 1;
			} else {
				$result['msg'] = '保存失败，请稍后重试';
			}
			echo json_encode($result);
			exit();
		}

		$this->set(compact('protocols'));
	}

	public function testEntranceGuard()
	{
		$data = $this->request->data;
		$util = new Utility();
		$result = $util->testEntranceGuard($data['type'], $data['id']);
		echo json_encode($result);
		exit();
	}

	public function tradeManager()
	{
		$this->set('title_for_layout', '订单管理');

		$trades = $this->Trade->find('all', [
			'contain' => [
				'User',
				'Order',
			],
			'order' => [
				'Trade.status ASC',
				'Trade.has_return_deposit ASC',
				'Trade.created DESC',
			],
		]);

		foreach ($trades as $key => $trade) {
			$tradeStatus = $trade['Trade']['status'];
			$trades[$key]['trade_status_text'] = \Trade::text($tradeStatus);
			$trades[$key]['class_name'] = \Trade::className($tradeStatus);
			$trades[$key]['Trade']['total_fee'] = $trade['Trade']['total_fee']/100;
			$orders = $trade['Order'];

			$seatIds = [];
			foreach ($orders as $order) {
				$startDate = $order['start_date'];
				$endDate = $order['end_date'];
				$seatId = $order['seat_id'];
				array_push($seatIds, $seatId);
			}

			if (empty($startDate) || empty($endDate)) {
				unset($trades[$key]);
				continue;
			}

			$seatIdStr = $this->Seat->getSeatStrBySeatIds($seatIds);
			$trades[$key]['seat_id_str'] = $seatIdStr;
			$trades[$key]['start_date'] = $startDate;
			$trades[$key]['end_date'] = $endDate;
		}

		$this->set(compact('trades'));
	}

	public function addEntranceConfig()
	{
		$guardConfig = $this->EntranceGuardConfig->find('first', [
		]);
		$saveData = $guardConfig['EntranceGuardConfig'];
		unset($saveData['id']);
		unset($saveData['qr_scene_ticket']);
		$this->EntranceGuardConfig->create();
		$this->EntranceGuardConfig->save($saveData);
		var_dump($saveData);
		exit();
	}

	public function seatManager()
	{
		$this->set('title_for_layout', '座位管理');

		$seats = $this->Seat->find('all', [
			'contain' => [
				'Order' => [
					'conditions' => [
						'Order.is_deleted' => 0,
					],
					'order' => [
						'Order.id desc',
					],
				],
				'Order.User',
				'SeatType',
			],
			'conditions' => [
				'Seat.is_deleted' => 0,
			],
			'order' => [
				'Seat.free_time DESC',
			],
		]);

		$wifiConfig = $this->WifiConfig->find('first', [

		]);

		$guardConfigs = $this->EntranceGuardConfig->find('all', [
		]);

		$seatTypes = $this->SeatType->find('all', [
		]);

		foreach ($seats as $key => $seat) {
			$seats[$key]['seat_status_text']  = \Seat::text($seat['Seat']['status']);
			$seats[$key]['clz_name'] = \Seat::className($seat['Seat']['status']);
			$seats[$key]['seat_type_text'] = $seat['SeatType']['name'];
		}

		$this->set(compact('seats', 'wifiConfig', 'seatTypes', 'guardConfigs'));
	}

	public function userManager()
	{
		$this->set('title_for_layout', '用户管理');

		$users = $this->User->find('all', [
			'order' => [
				'is_activated DESC',
			],
		]);

		foreach ($users as &$user) {
			$user['clz_name'] = \User::className($user['User']['is_activated']);
		}

		$this->set(compact('users'));
	}

	public function updateWifiConfig()
	{
		$data = $this->request->data;

		$data['id'] = 1;

		$result = [
			'status' => 0,
			'msg' => '',
		];

		$saveRes = $this->WifiConfig->save($data);

		if ($saveRes) {
			$result['status'] = 1;
		} else {
			$result['msg'] = '系统错误，请重试';
		}

		echo json_encode($result);
		exit();
	}

	public function updateGuardConfig()
	{
		$data = $this->request->data;

		$result = [
			'status' => 0,
			'msg' => '',
		];

		$saveRes = $this->EntranceGuardConfig->save($data);

		if ($saveRes) {
			$result['status'] = 1;
		} else {
			$result['msg'] = '系统错误，请重试';
		}

		echo json_encode($result);
		exit();
	}

	function getEntranceGuardQRCode($guardId=1)
	{
		$guardConfig = $this->EntranceGuardConfig->find('first', [
			'conditions' => [
				'EntranceGuardConfig.id' => $guardId,
			],
		]);

		$util = new Utility();

		if (!empty($guardConfig['EntranceGuardConfig']['qr_scene_ticket'])) {
			$url = $util->getSceneTicketUrl($this->Token->getToken(\Token::ACCESS_TOKEN), null, 'on_scan_entrance_guard'.$guardId, $isTemp = false, $guardConfig['EntranceGuardConfig']['qr_scene_ticket'])['url'];
		} else {
			$res = $util->getSceneTicketUrl($this->Token->getToken(\Token::ACCESS_TOKEN), null, 'on_scan_entrance_guard'.$guardId, $isTemp = false, '');
			$ticket = $res['ticket'];
			$this->EntranceGuardConfig->save(['id' => $guardId, 'qr_scene_ticket' => $ticket]);
			$url = $res['url'];
		}

		if (!empty($url)) {
			$result['status'] = 1;
			$result['url'] = $url;
		} else {
			$result['status'] = 0;
			$result['msg'] = '系统忙，请重试';
		}
		echo json_encode($result);
		exit();
	}

	function updateSeatTypeInfo()
	{
		$data = $this->request->data;

		$result = [
			'status' => 0,
			'msg' => '',
		];

		$saveRes = $this->SeatType->save($data);

		if ($saveRes) {
			$result['status'] = 1;
		} else {
			$result['msg'] = '系统错误，请重试';
		}

		echo json_encode($result);
		exit();
	}

	function beforeFilter()
    {
        parent::beforeFilter();
    }


    function afterFilter()
    {
        parent::afterFilter();
        if (AuthComponent::user('role') == 0) {
            $this->redirect('/users/noAuthentication');
        }
    }
}