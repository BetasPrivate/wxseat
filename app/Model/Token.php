<?php 
class Token extends AppModel
{
	const ACCESS_TOKEN = 1;
	const JS_API_TICKET = 2;

	public static $texts = [
		self::ACCESS_TOKEN => 'accessToken',
		self::JS_API_TICKET => 'jsApiTicket',
	];

	public static function text($index) {
		$result = 'unknown';
		if (isset(self::$texts[$index])) {
			$result = self::$texts[$index];
		}

		return $result;
	}

	public function getToken($tokenId)
	{
		$util = new Utility();
	        
	    $token = $this->find('first', [
	    	'conditions' => [
	    		'id' => $tokenId,
	    	],
	    ]);

	    if (!$token || ($token['Token']['updated'] < date('Y-m-d H:i:s', (time() - $token['Token']['expire_seconds'])))) {
	    	if ($tokenId == self::ACCESS_TOKEN) {
	        	$tokenRes = $util->getAccessToken();
		        $token = $tokenRes['access_token'];
		        $expires = $tokenRes['expires_in'];
		        $this->save(['id' => $tokenId, 'token' => $token, 'expire_seconds' => $expires]);
	    	} elseif ($tokenId == self::JS_API_TICKET) {
	    		$tokenRes = $util->getJsApiTicket($this->getToken(self::ACCESS_TOKEN));
	    		$token = $tokenRes['ticket'];
	    		$expires = $tokenRes['expires_in'];
	    		$this->save(['id' => $tokenId, 'token' => $token, 'expire_seconds' => $expires]);
	    	}
	    } else{
	        $token = $token['Token']['token'];
	    }

	    return $token;
	}
}