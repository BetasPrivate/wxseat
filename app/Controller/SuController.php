<?php
class SuController extends AppController{
	public $uses = [
		'Trade',
		'Token',
		'Seat',
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
		]);

		foreach ($trades as $key => $trade) {
			$tradeStatus = $trade['Trade']['status'];
			$trades[$key]['trade_status_text'] = \Trade::text($tradeStatus);
			$trades[$key]['class_name'] = \Trade::className($tradeStatus);
			$orders = $trade['Order'];

			$seatIds = [];
			foreach ($orders as $order) {
				$startDate = $order['start_date'];
				$endDate = $order['end_date'];
				$seatId = $order['seat_id'];
				array_push($seatIds, $seatId);
			}

			$seatIdStr = $this->Seat->getSeatStrBySeatIds($seatIds);
			$trades[$key]['seat_id_str'] = $seatIdStr;
			$trades[$key]['start_date'] = $startDate;
			$trades[$key]['end_date'] = $endDate;
		}

		$this->set(compact('trades'));
	}
}