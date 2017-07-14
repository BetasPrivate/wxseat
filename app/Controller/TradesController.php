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

	public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('editTradeInfo');
    }
}