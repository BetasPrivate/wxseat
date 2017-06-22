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
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

	public $hasMany = [
		'Trade',
	];

    public $virtualFields = [
        "role_name" => 'if (role = 0, "普通用户", "管理员")',
    ];

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

        if (!$user) {
            $this->create();
            $user = $this->save(['username' => $username]);
        }

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
}