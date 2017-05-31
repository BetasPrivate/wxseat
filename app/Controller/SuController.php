<?php
class SuController extends AppController{
	public $uses = [
		'Trade',
	];

	public function index()
	{
		$this->set('title_for_layout', '管理中心');
		$query = sprintf("select * from trades Trade left join orders `Order` on Trade.id = `Order`.trade_id left join users User on User.id = Trade.user_id where Trade.is_deleted = 0;");
		$trades = $this->Trade->query($query);

		$result['trades'] = $trades;
		$this->set(compact('result'));
	}
}