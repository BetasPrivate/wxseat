<?php
class Seat extends AppModel {
	var $hasMany = [
		'Order',
	];

	public $belongsTo = [
		'SeatType' => [
			'className' => 'SeatType',
			'foreignKey' => 'type',
		],
	];

	//下单后锁定时间为5min
	const PROVISIONAL_TIME = 5 * 60;
	const FREE = 0;
	const OCCUPIED = 1;
	
	public static $texts = [
		self::FREE => "空闲",
		self::OCCUPIED => "占用",
	];

	public static $classes = [
		self::FREE => 'info',
		self::OCCUPIED => 'warning',
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

	public function getOccupiedStatus()
	{
		return self::OCCUPIED;
	}

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

	public function formatSeatDate($seat)
	{
		if (sizeof($seat['Order']) == 0) {
			$seat['start_date'] = '';
			$seat['end_date'] = '';
		} else {
			$seat['start_date'] = $seat['Order'][0]['start_date'];
			$seat['end_date'] = $seat['Order'][0]['end_date'];
		}

		//座位如果有过期时间，则按照座位的过期时间来展示
		if ($seat['Seat']['free_time']) {
			$seat['start_date'] = '';
			$seat['end_date'] = $seat['Seat']['free_time'];
		}

		return $seat;
	}

	public function getDeposit($seatIdStr)
	{
		return round(100,2);
		//codes to write.
	}
}