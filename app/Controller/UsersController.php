<?php
class UsersController extends AppController
{
	public $uses = [
		'User',
	];

	public function login()
	{
		$this->set('title_for_layout', '用户登录');
	}

	public function checkLogin()
	{
		$data = $this->request->data;
		$userName = $data['nick_name'];
		$userPwd = $data['key'];
		$query = sprintf("update users set last_login_time = '%s' where `name` = '%s' and password = '%s'", date('Y-m-d H:i:s'), $userName, $userPwd);
		$this->User->query($query);
		$count = $this->User->getAffectedRows();
		if ($count == 1) {
			echo '登录成功，跳转中...';
			$this->redirect('/seats/index');
		} else {
			echo '账号或密码错误，请重试';
			$this->redirect($this->referer());
		}
	}
}