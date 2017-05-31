<?php
class TradeModel extends AppModel {
	public $belongsTo = [
		'User',
	];

	public $hasMany = [
		'Order',
	];
}