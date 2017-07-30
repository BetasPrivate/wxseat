<?php
Class TradesController extends AppController {
	public $uses = [
		'Trade',
	];

	public function editTradeInfo()
	{
		$data = $this->request->data;

		$tradeId = $data['trade_id'];

		unset($data['trade_id']);

		$this->Trade->id = $tradeId;

		$this->Trade->save($data);
		exit;
	}

	public function returnDeposit()
	{
		$data = $this->request->data;

		$data['has_return_deposit'] = 1;

		$saveRes = $this->Trade->save($data);

		if ($saveRes) {
			$result = [
				'status' => 1,
			];
		} else {
			$result = [
				'status' => 0,
				'msg' => '系统错误，请重试',
			];
		}

		echo json_encode($result);
		exit();
	}

	public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('editTradeInfo');
    }
}