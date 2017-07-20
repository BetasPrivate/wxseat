<?php
class Trade extends AppModel {
	const NO_PAY = 0;
	const PAID = 1;
	const CLOSED_BY_SYSETM = 2;
	//超时关闭时间为5分钟
	const CLOSE_TIME = 300;

	public static $texts = [
		self::NO_PAY => '待支付',
		self::PAID => '已付款',
		self::CLOSED_BY_SYSETM => '超时关闭',
	];

	public static $classes = [
		self::NO_PAY => 'info',
		self::PAID => 'success',
		self::CLOSED_BY_SYSETM => 'warning',
	];

	public static function text($index)
	{
		$result = '未知';
		if (isset(self::$texts[$index])) {
			$result = self::$texts[$index];
		}

		return $result;
	}

	public static function className($index)
	{
		$result = 'active';
		if (isset(self::$classes[$index])) {
			$result = self::$classes[$index];
		}

		return $result;
	}

	public $belongsTo = [
		'User',
	];

	public $hasMany = [
		'Order',
	];

	public function getTradeNo()
	{
		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$orderSn = $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));

		return $orderSn;
	}

	public function parseTradePayReturnData($postStr)
	{
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		$resultCode = strtolower(trim((string) $postObj->result_code));
		if ($resultCode === 'success') {
			$platformTradeId = trim((string) $postObj->out_trade_no);
			$this->setPaidTradeStatus($platformTradeId);
		}
	}

	public function setPaidTradeStatus($platformTradeId)
	{
		$trade = $this->find('first', [
			'conditions' => [
				'platform_trade_id' => $platformTradeId,
			],
		]);

		$this->id = $trade['Trade']['id'];
		$this->save(['status' => self::PAID]);
	}

	public function getTradeDetailByUserId($userId)
	{
		$trades = $this->find('all', [
			'contain' => [
				'User',
				'Order',
			],
			'conditions' => [
				'User.id' => $userId,
				'Trade.is_deleted' => 0,
			],
		]);

		foreach ($trades as $key => $trade) {
			$tradeStatus = $trade['Trade']['status'];
			$trades[$key]['trade_status_text'] = self::text($tradeStatus);
			$orders = $trade['Order'];

			$seatIds = [];
			foreach ($orders as $order) {
				$startDate = $order['start_date'];
				$endDate = $order['end_date'];
				$seatId = $order['seat_id'];
				array_push($seatIds, $seatId);
			}

			$seatIdStr = ClassRegistry::init('Seat')->getSeatStrBySeatIds($seatIds);
			$trades[$key]['seat_id_str'] = $seatIdStr;
			$trades[$key]['start_date'] = $startDate;
			$trades[$key]['end_date'] = $endDate;
		}

		return $trades;
	}

	public function getTradeByTradeId($tradeId)
	{
		return $this->find('first', [
			'conditions' => [
				'Trade.id' => $tradeId,
			],
		]);
	}

	public function closeTrades()
	{
		$trades = $this->find('all', [
			'fields' => [
				'Trade.id',
			],
			'conditions' => [
				'Trade.created <' => date('Y-m-d H:i:s', time() - self::CLOSE_TIME),
				'Trade.status' => self::NO_PAY,
			],
		]);

		$tradeIds = [];

		foreach ($trades as $trade) {
			array_push($tradeIds, $trade['Trade']['id']);
		}

		$this->updateAll(
		[
			'status' => self::CLOSED_BY_SYSETM,	
		],
		[
			'Trade.id' => $tradeIds,
		]);

		$this->Order->updateAll(
		[
			'Order.is_deleted' => 1,
		],
		[
			'Trade.id' => $tradeIds,
		]);

	}
}