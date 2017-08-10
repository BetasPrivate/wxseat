<?php
class EntranceGuardConfig extends AppModel{
	
	public function getConfig($companyId = 1)
	{
		return $this->find('first', [
			'conditions' => [
				'is_deleted' => 0,
				'company_id' => 1,
			],
		]);
	}
}