<?php
class Seat extends AppModel {
	var $hasMany = [
		'Order',
	];

	const PROVISIONAL_TIME = 5 * 60;
	const FREE = 0;
	const OCCUPIED = 1;
	
	public function getUnavaliableIdInfos($seatIds, $startDate, $endDate)
	{
		$seatInfos = $this->find('all', [
			'contain' => [
				'Order',
			],
			'conditions' => [
				'Seat.id in' => $seatIds,
				'or' => [
					'Order.start_date between ? and ?' => [
						$startDate, $endDate
					],
					'Order.end_date between ? and ?' => [
						$startDate, $endDate
					],
				],
			],
		]);

		$unavaliableIdInfos = [];
		foreach ($seatInfos as $seatInfo) {
			$seatId = $seatInfo['Seat']['id'];
			$startDate = $seatInfo['Seat']['start_date'];
			$endDate = $seatInfo['Seat']['end_date'];
			$unavaliableIdInfos[$seatId] = [
				'startDate' => $startDate,
				'endDate' => $endDate,
			];
		}

		$result = [
			'unavaliableIdInfos' => $unavaliableIdInfos,
		];

		return $result;
	}

	public function getSeatStrBySeatIds($seatIds)
	{
		$seatIdStr = '';
		foreach ($seatIds as $id) {
			$seatIdStr .= ','.$id;
		}

		$seatIdStr = substr($seatIdStr, 1);

		return $seatIdStr;
	}


	public function releaseSeats()
	{
		$seats = $this->find('all', [
			'conditions' => [
				'status' => self::OCCUPIED,
			],
		]);

		$seatIdStr = '';
		foreach ($seats as $seat) {
			$seatId = $seat['Seat']['id'];
			$freeTime = $seat['Seat']['free_time'];

			//no free time, means no order.
			if (!$freeTime) {
				$seatIdStr .= ','.$seatId;
				//time exceed, means can free.
			} elseif (strtotime($freeTime) < time()) {
				$seatIdStr .= ','.$seatId;
			}
		}

		if (strlen($seatIdStr) > 0) {
			$seatIdStr = '('.substr($seatIdStr, 1).')';
			$query  = sprintf('update seats set status = %d where id in %s', self::FREE, $seatIdStr);
			$this->query($query);
		}
	}

	public function setSeatOcuppiedProvisionally($seatRealId)
	{
		$this->updateAll(
			[
				'free_time' => self::PROVISIONAL_TIME,
			],
			[
				'real_id' => $seatRealId,
				'is_deleted' => 0,
			]
		);
	}

	public function getDeposit($seatIdStr)
	{
		return round(100,2);
		//codes to write.
	}
}