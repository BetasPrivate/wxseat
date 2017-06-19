<?php
class Order extends AppModel {
	const NORMAL = 0;
	const MANUAL = 1;

	public static $texts = [
		self::NORMAL => '普通单',
		self::MANUAL => '手工单',
	];

	public static function text($index)
	{
		$result = '未知订单类型';
		if (isset(self::$texts[$index])) {
			$result = self::$texts[$index];
		}

		return $result;
	}
}