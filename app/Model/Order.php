<?php
class Order extends AppModel {
	public $belongsTo = [
		'Seat',
		'Trade',
	];
	const CLOSE_TIME = 300;
	const NORMAL = 0;
	const MANUAL = 1;
	const PENDING_SUBMIT = 2;

	public static $texts = [
		self::NORMAL => '普通单',
		self::MANUAL => '手工单',
		self::PENDING_SUBMIT => '待顾客提交',
	];

	public static function text($index)
	{
		$result = '未知订单类型';
		if (isset(self::$texts[$index])) {
			$result = self::$texts[$index];
		}

		return $result;
	}

	public function createPendingOrderForConference($conferenceId, $dates)
	{
		$dataSource = $this->getDataSource();
		$dataSource->begin();
		$needRollBack = false;

		foreach ($dates as $date) {
			$startDate = $date['start_date'];
			$endDate = $date['end_date'];

			//判断当前会议室的时间是否已有订单
			$checkCurrentOrder = $this->updateAll(
				[
					'updated' => '"'.date('Y-m-d H:i:s').'"',
				],
				[
					'seat_id' => $conferenceId,
					'start_date' => $startDate,
					'end_date' => $endDate,
					'Order.is_deleted' => 0,
				]
			);
			$rows = $this->getAffectedRows();
			if ($rows > 0) {
				$needRollBack = true;
				break;
			}

			$this->create();
			$saveData = [
				'seat_id' => $conferenceId,
				'start_date' => $startDate,
				'end_date' => $endDate,
				'type' => self::PENDING_SUBMIT,
			];
			$this->save($saveData);
		}

		//边界情况：两个客户同时检查了一个座位的占用之后，同时生成了一个订单，导致订单总数为2
		if ($needRollBack) {
			$result['status'] = 0;
			$dataSource->rollback();
		} else {
			$dataSource->commit();
			$result['status'] = 1;
		}

		return $result;
	}

	public function genTradeForConference($conferenceId, $totalFee, $dates, $userId, $platformTradeId)
	{
		$dataSource = $this->getDataSource();
		$dataSource->begin();
		$needRollBack = false;
		$totalFee = 1;

		$this->Trade->create();
		$this->Trade->save(['user_id' => $userId, 'total_fee' => $totalFee, 'platform_trade_id' => $platformTradeId]);
		$tradeId = $this->Trade->getLastInsertId();

		foreach ($dates as $date) {
			$startDate = $date['start_date'];
			$endDate = $date['end_date'];

			$setTradeId = $this->updateAll(
				[
					'trade_id' => $tradeId,
				],
				[
					'seat_id' => $conferenceId,
					'start_date' => $startDate,
					'end_date' => $endDate,
					'trade_id' => 0,
				]
			);

			$rows = $this->getAffectedRows();
			if ($rows !== 1) {
				$needRollBack = true;
				break;
			}
		}

		if ($needRollBack) {
			$dataSource->rollback();
			$result = [
				'status' => 0,
				'msg' => '会议室信息有变更，请刷新页面重试',
				'tradeId' => 0,
			];
		} else {
			$dataSource->commit();
			$result = [
				'status' => 1,
				'msg' => 'ok',
				'tradeId' => $tradeId,
			];
		}

		return $result;
	}

	public function disableOrders()
	{
		$this->updateAll(
			[
				'Order.is_deleted' => 1,
			],
			[
				'Order.trade_id' => 0,
				'Order.created <' => date('Y-m-d H:i:s', time() - self::CLOSE_TIME),
			]
		);
	}
}