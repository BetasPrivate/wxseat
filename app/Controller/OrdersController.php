<?php
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once WX_PAY . "/lib/WxPay.Api.php";
require_once WX_PAY . "/example/WxPay.JsApiPay.php";
require_once WX_PAY . "/example/log.php";
class OrdersController extends AppController {
	public $uses = [
		'Order',
		'Seat',
		'Trade',
		'Token',
		'WifiConfig',
		'Protocol',
	];

	public function index()
	{
		$this->set('title_for_layout', '我的订单');
        $trades = $this->Trade->getTradeDetailByUserId(AuthComponent::user('id'));

        $this->set(compact('trades'));
	}

	public function createNewOrder()
	{
		$data = $this->request->data;

		$seatInfos = $data['seatInfo'];//seat_id, version
		$dates = $data['dates'];
		$startDate = $dates['startDate'];
		$endDate = $dates['endDate'];
		$totalFee = $data['totalFee'];
		$userId = AuthComponent::user('id');

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
		}

		if (!$hasChanged) {
			$seatIdStr = '('.substr($seatIdStr, 1).')';

			//set seat occupied.
			$query = sprintf("update seats set status = 1 where real_id in %s", $seatIdStr);
			$this->Seat->query($query);
			
			$this->Trade->create();
			$platformTradeId = WxPayConfig::MCHID.$this->Trade->getTradeNo();
			$this->Trade->save(['user_id' => $userId, 'total_fee' => $totalFee *100, 'platform_trade_id' => $platformTradeId]);
			$tradeId = $this->Trade->getLastInsertId();

			//生成订单
			foreach ($seatInfos as $seatInfo) {
				$seatRealId = $seatInfo['seatId'];
				$seatId = $this->Seat->find('first', [
					'conditions' => [
						'Seat.real_id' => $seatRealId,
						'Seat.is_deleted' => 0,
					],
				])['Seat']['id'];
				$this->Order->create();
				$saveData = [
					'seat_id' => $seatId,
					'trade_id' => $tradeId,
					'start_date' => $startDate,
					'end_date' => $endDate,
				];
				$this->Order->save($saveData);
				$this->Seat->setSeatOcuppiedProvisionally($seatRealId);
			}

			$result = [
				'status' => 1,
				'tradeId' => $tradeId,
			];
		}

		$this->layout = 'ajax';
		$this->set(compact('result'));
	}

	public function createOrderForConference()
	{
		$data = $this->request->data;
		$conferenceId = $data['seatInfo'][0];
		$totalFee = $data['totalFee'];
		$dates = $data['dates'];
		$userId = AuthComponent::user('id');
		$platformTradeId = WxPayConfig::MCHID.$this->Trade->getTradeNo();

		$saveResult = $this->Order->genTradeForConference($conferenceId, $totalFee, $dates, $userId, $platformTradeId);

		$result = [
			'status' => $saveResult['status'],
			'msg' => $saveResult['msg'],
			'tradeId' => $saveResult['tradeId'],
		];

		echo json_encode($result);
		exit();

	}

	public function prePay()
	{
		$this->set('title_for_layout', '支付订单');
		$tradeId = isset($this->request->query['tradeId']) ? $this->request->query['tradeId'] : null;
		if ($tradeId) {
			$result = $this->initPayOrder($tradeId);
		} else {
			echo "wrong trade";
			exit();
		}

		$this->set(compact('result'));
	}

	public function initPayOrder($tradeId)
	{
		$util = new Utility();
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

		$jsParams = $this->getJsApiParameters($tradeId);
		$result['jsApiParameters'] = $jsParams['jsApiParameters'];
		$result['editAddress'] = $jsParams['editAddress'];
		$result['totalFee'] = $jsParams['totalFee'];
		$result['tradeId'] = (String)$tradeId;

		return $result;
	}

	// public function payOrder($weixinResult)
	// {
	// 	if (true) {
	// 		$this->Order->query($query);
	// 	}
	// }


	public function getJsApiParameters($tradeId)
	{
		//①、获取用户openid
		$tools = new JsApiPay();
		$openId = $tools->GetOpenid();
		$trade = $this->Trade->getTradeByTradeId($tradeId);
		$platformTradeId = $trade['Trade']['platform_trade_id'];
		$totalFee = $trade['Trade']['total_fee'];
		$totalFeeWXPay = $totalFee;
		$totalFeeWXPay = 1;

		//②、统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody("test");
		$input->SetAttach("test");
		$input->SetOut_trade_no($platformTradeId);
		$input->SetTotal_fee($totalFeeWXPay);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test");
		$input->SetNotify_url("http://".ROOT_URL."/callback/wxPayCallback");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = WxPayApi::unifiedOrder($input);
		$jsApiParameters = $tools->GetJsApiParameters($order);
		$editAddress = $tools->GetEditAddressParameters();

		$this->Trade->save(['id' => $tradeId, 'open_id' => $openId]);

		return ['jsApiParameters' => $jsApiParameters,
			'editAddress' => $editAddress,
			'totalFee' => $totalFee,
		];
	}

	public function paySuccess($tradeId)
	{
		$this->set('title_for_layout', '支付成功！');

		$orders = $this->Order->find('list', [
			'fields' => [
				'Order.id',
				'Order.seat_id',
			],
			'conditions' => [
				'Order.trade_id' => $tradeId,
				'Order.is_deleted' => 0,
			],
		]);

		$seats = $this->Seat->find('list', [
			'fields' => [
				'Seat.id',
				'Seat.real_id',
			],
			'conditions' => [
				'Seat.id' => $orders,
			],
		]);

		$seatIdStr = $this->Seat->getSeatStrBySeatIds($seats);

		$sectionId = 1;

		$wifiConfig = $this->WifiConfig->find('first', [
			'conditions' => [
				'id' => $sectionId,
			],
		]);

		$this->set(compact('wifiConfig', 'seatIdStr'));
	}

	function printf_info($data)
	{
	    foreach($data as $key=>$value){
	        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
	    }
	}

	function agreement($id=1)
	{
		$protocol = $this->Protocol->find('first', [
			'conditions' => [
				'Protocol.id' => $id,
			],
		]);

		$protocol['Protocol']['text'] = str_replace("\n",'<br>',$protocol['Protocol']['text']);
		$this->set(compact('protocol'));

	}
}