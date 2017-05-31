<?php
class SeatsController extends AppController {
	public $uses = [
		'Seat',
		'SeatTypePriceRelation',
	];

	function index()
	{
		$this->set('title_for_layout', '预订工位');
	}

	function checkSeatsAvailable()
	{
		$data = $this->request->data['json'];
		$seatIds = $data['seatIds'];
		$startDate = $data['startDate'];
		$endDate = $data['endDate'];
		$result['status'] = 1;

		$checkResult = $this->getUnavaliableIdInfos($seatIds, $startDate, $endDate);
		if (sizeof($checkResult['unavaliableIdInfos']) != 0) {
			$result['status'] = 0;
			$msg = '';
			foreach($unavaliableIdInfos as $seatId => $info)
			{
				$msg .= '座位号：'.$seatId.'。在'.$info['startDate'].'和'.$info['endDate'].'之间被占用。';
			}
			$result['msg'] = $msg;
		} else {
			$infoResult = $this->getAvaliableSeatInfos($seatIds);
			$result['info'] = $infoResult['avaliableIdInfos'];
			$result['dates'] = [
				'startDate' => $startDate,
				'endDate' => $endDate,
			];
		}

		$this->layout = "ajax";
		$this->set(compact('result'));
	}

	public function getUnavaliableIdInfos($seatIds, $startDate, $endDate)
	{
		$seatIdStr = '';
		foreach ($seatIds as $id) {
			$seatIdStr .= ",'".$id."'";
		}
		$seatIdStr = '('.substr($seatIdStr, 1).')';
		$query = sprintf("select * from seats as Seat left join orders `Order` on Seat.id = `Order`.seat_id where Seat.real_id in %s and ((`Order`.start_date between '%s' and '%s') or (`Order`.end_date between '%s' and '%s')) and Seat.is_deleted = 0", $seatIdStr, $startDate, $endDate, $startDate, $endDate);
		$seatInfos = $this->Seat->query($query);

		$unavaliableIdInfos = [];
		foreach ($seatInfos as $seatInfo) {
			$seatId = $seatInfo['Seat']['real_id'];
			$startDate = $seatInfo['Order']['start_date'];
			$endDate = $seatInfo['Order']['end_date'];
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

	public function getAvaliableSeatInfos($seatIds)
	{
		$seatInfos = $this->Seat->find('all', [
			'conditions' => [
				'Seat.real_id' => $seatIds,
			],
		]);

		$avaliableIdInfos = [];
		foreach ($seatInfos as $seatInfo) {
			$version = $seatInfo['Seat']['version'];
			$id = $seatInfo['Seat']['real_id'];
			$avaliableIdInfos[] = [
				'seatId' => $id,
				'version' => $version,
			];
		}

		$result = [
			'avaliableIdInfos' => $avaliableIdInfos,
		];

		return $result;
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
		$price = $this->getSeatPrices($seatIdStr);

		$result = [
			'idInfo' => $seatIds,
			'price' => $price,
			'seatInfo' => $idInfos,
			'totalFee' => $price +100,
			'dates' => $dates,
		];

		$this->set(compact('result'));
	}

	public function getSeatPrices($ids)
	{
		$price = 0;
		$query = sprintf("select * from seats Seat left join seat_type_price_relations SeatTypePriceRelation on Seat.type = SeatTypePriceRelation.seat_type_id where Seat.real_id in %s", $ids);
		$seatInfos = $this->Seat->query($query);

		foreach ($seatInfos as $seatInfo) {
			$price += $seatInfo['SeatTypePriceRelation']['price'];
		}

		return $price;
	}

	

}