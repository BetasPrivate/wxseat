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

		$seatTypes = $this->SeatType->find('all', [
		]);

		foreach ($seats as $key => $seat) {
			$seats[$key]['seat_status_text']  = \Seat::text($seat['Seat']['status']);
			$seats[$key]['clz_name'] = \Seat::className($seat['Seat']['status']);
			$seats[$key]['seat_type_text'] = $seat['SeatType']['name'];
		}

		$this->set(compact('seats', 'wifiConfig', 'seatTypes'));
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
}