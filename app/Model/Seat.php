<?php
class Seat extends AppModel {
	var $hasMany = [
		'Order',
	];
	
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
}