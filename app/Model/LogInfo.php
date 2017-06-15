<?php
class LogInfo extends AppModel {
	const SYS_LOG = 0;
	const SEAT_LOG = 1;

	public static $texts = [
		self::SYS_LOG => '系统备注',
		self::SEAT_LOG => '工位备注',
	];

	public static function text($index)
	{
		$result = '未知备注类型';
		if (isset(self::$texts[$index])) {
			$result = self::$texts[$index];
		}

		return $result;
	}
}