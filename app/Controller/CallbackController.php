<?php
class CallbackController extends AppController
{
	public $uses = [
		'User',
	];

	function entrance()
	{
		$echoStr = isset($this->request->query['echostr']) ? $this->request->query['echostr'] : null;
		$signature = isset($this->request->query['signature']) ? $this->request->query['signature'] : null;
		$timeStamp = isset($this->request->query['timestamp']) ? $this->request->query['timestamp'] : null;
		$nonce = isset($this->request->query['nonce']) ? $this->request->query['nonce'] : null;;
		$token = 'zhanshenkeji';
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if ($tmpStr == $signature) {
			echo $echoStr;
			exit();
		}
	}
}