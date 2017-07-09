<?php
class Order extends AppModel {
	public $belongsTo = [
		'Seat',
	];
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

			$checkCurrentOrder = $this->updateAll(
				[
					'updated' => date('Y-m-d H:i:s'),
				],
				[
					'seat_id' => $conferenceId,
					'start_date' => $startDate,
					'end_date' => $endDate,
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

		if ($needRollBack) {
			$result['status'] = 0;
			$dataSource->rollback();
		} else {
			$dataSource->commit();
			$result['status'] = 1;
		}

		return $result;
	}
}