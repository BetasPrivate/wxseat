<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {

	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'A username is required'
            )
        ),
    );

	public $hasMany = [
		'Trade',
	];

    public $virtualFields = [
        "role_name" => 'if (role = 0, "普通用户", "管理员")',
    ];

    const IN_ACTIVATED = 0;
    const ACTIVATED = 1;
    
    public static $texts = [
        self::IN_ACTIVATED => "已被禁用",
        self::ACTIVATED => "正在启用",
    ];

    public static $classes = [
        self::IN_ACTIVATED => 'warning',
        self::ACTIVATED => 'success',
    ];

    public static function className($index)
    {
        $result = 'active';
        if (isset(self::$classes[$index])) {
            $result = self::$classes[$index];
        }

        return $result;
    }

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}

    public function getUserByName($username)
    {
        $user = $this->find('first', [
            'conditions' => [
                'username' => $username,
            ],
        ]);

        // if (!$user) {
        //     $this->create();
        //     $user = $this->save(['username' => $username]);
        // }

        return $user;
    }

    public function checkPasswd($userName, $passwd)
    {
        $checkRes = false;
        $msg = '';
        $passwordHasher = new BlowfishPasswordHasher();
        $user = $this->find('first', [
            'conditions' => [
                'username' => $userName,
            ],
        ]);

        if (!$user) {
            $msg = '未找到用户';
        } elseif (!$passwordHasher->check($passwd, $user['User']['password'])) {
            $msg = '原始密码错误';
        } else {
            $checkRes = true;
        }

        $result = [
            'res' => $checkRes,
            'msg' => $msg,
        ];

        return $result;
    }

    public function updatePasswd($userName, $newKey)
    {
        $passwordHasher = new BlowfishPasswordHasher();
        return $this->updateAll(
            [
                'password' => "'".$passwordHasher->hash($newKey)."'",
            ],
            [
                'username' => $userName,
            ]
        );
    }

    public function isAllowEnterUser($openId)
    {
        $user = $this->find('first', [
            'conditions' => [
                'User.open_id' => $openId,
            ],
        ]);
        $result = [
            'status' => 0,
            'msg' => '',
        ];

        if (!$user) {
            $result['msg'] = '您需要先注册才能拥有扫码开门权限';
        } elseif($user['User']['is_allow_enter'] == 1) {
            $result['status'] = 1;
        } else {
            $result['msg'] = '您需要找管理员开通扫码开门权限';
        }

        return $result;
    }
}