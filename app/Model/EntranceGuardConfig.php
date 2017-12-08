<?php
class EntranceGuardConfig extends AppModel{
	
	public function getConfig($id = 1)
	{
		return $this->find('first', [
			'conditions' => [
				'is_deleted' => 0,
				'id' => $id,
			],
		]);
	}
}