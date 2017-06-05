<?php
class OrdersController extends AppController {
	public $uses = [
		'Order',
		'Seat',
		'Trade',
		'Token',
	];

	public function createNewOrder()
	{
		$data = $this->request->data;
		//seat_id, version
		$seatInfos = $data['seatInfo'];
		$dates = $data['dates'];
		$startDate = $dates['startDate'];
		$endDate = $dates['endDate'];
		$userId = 1;

		$result = [
			'status' => 0,
			'msg' => '当前座位信息有变，请重新选择',
		];
		$hasChanged = false;
		$seatIdStr = '';
		$newOrderQuerys = [];
		foreach ($seatInfos as $seatInfo) {
			$version = $seatInfo['version'];
			$seatRealId = $seatInfo['seatId'];
			$seatIdStr .= ",'".$seatRealId."'";

			$query = sprintf("update seats Seat set version = %s where real_id = '%s' and version = '%s' and is_deleted = 0", $version, $seatRealId, $version);
			$this->Seat->query($query);
			$count = $this->Seat->getAffectedRows();

			if ($count == 0) {
				//若无记录，说明当前位子仍未更新，修改其版本.
				$versionTo = $version >= 99 ? 0 : $version +1;
				$query = sprintf("update seats set version = %s where real_id = '%s' and version = %s and is_deleted = 0", $versionTo, $seatRealId, $version);
				$this->Seat->query($query);
				$count = $this->Seat->getAffectedRows();
				if ($count == 0) {
					$hasChanged = true;
					break;
				} else {
					continue;	
				}
			} else {
				$versionTo = $version >= 99 ? 0 : $version ++;
				$query = sprintf("update seats set version = %s where real_id = '%s' and version = '%s' and is_deleted = 0", $versionTo, $seatRealId, $version);
				$this->Seat->query($query);
				$hasChanged = true;
				break;
			}

			$query = sprintf("INSERT INTO `orders` (`seat_id`, `user_id`, `status`, `is_deleted`, `start_date`, `end_date`) VALUES ('%s', %s, 0, 0, '%s', '%s')", $seatId, $userId, $startDate, $endDate);
			$newOrderQuerys[] = $query;
		}

		if (!$hasChanged) {
			$seatIdStr = '('.substr($seatIdStr, 1).')';

			$query = sprintf("update seats set status = 1 where real_id in %s", $seatIdStr);
			$this->Seat->query($query);
			
			$this->Trade->create();
			$this->Trade->save(['user_id' => $userId]);
			$tradeId = $this->Trade->getLastInsertId();

			foreach ($seatInfos as $seatInfo) {
				$seatRealId = $seatInfo['seatId'];
				$this->Order->create();
				$saveData = [
					'seat_id' => $seatRealId,
					'trade_id' => $tradeId,
					'start_date' => $startDate,
					'end_date' => $endDate,
				];
				$this->Order->save($saveData);
			}

			$result = [
				'status' => 1,
			];
		}

		$this->layout = 'ajax';
		$this->set(compact('result'));
	}

	public function prePay()
	{
		$this->set('title_for_layout', '支付订单');
		$dataStr = $this->request->data['seatInfo'];
		$util = new Utility();

		$data = json_decode($dataStr, true);
		$result['totalFee'] = $data['totalFee'];
		$result['seatInfos'] = $data['seatInfo'];

		$noncestr = 'zhanshenkeji';
		$jsApiTicket = $this->Token->getToken(\Token::JS_API_TICKET);
		$timeStamp = time();
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$tmpArr = [
			'noncestr' => $noncestr,
			'jsapi_ticket' => $jsApiTicket,
			'timestamp' => $timeStamp,
			'url' => $url,
		];

		ksort($tmpArr);
		$tmpStr = $util->ToUrlParams($tmpArr);
		$signature = sha1($tmpStr);

		$result['nonceStr'] = $noncestr;
		$result['jsApiTicket'] = $jsApiTicket;
		$result['timeStamp'] = $timeStamp;
		$result['signature'] = $signature;
		$result['appId'] = APP_ID;

		$this->set(compact('result'));
	}

	public function payOrder($weixinResult)
	{
		if (true) {
			$this->Order->query($query);
		}
	}
}