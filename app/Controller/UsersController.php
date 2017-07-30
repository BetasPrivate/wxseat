<?php
require_once WX_PAY . "/example/WxPay.JsApiPay.php";
App::uses('Token', 'Model');
class UsersController extends AppController
{
    public $uses = [
        'User',
        'Trade',
        'Token',
    ];

    public function index()
    {
        $this->set('title_for_layout', '个人中心');

    }

    public function userInfo()
    {
        $this->set('title_for_layout', '个人资料');
    }

    public function login()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false && !$this->request->is('post')) {
            // $this->redirect('/users/PCLogin');
        }
        $this->set('title_for_layout', '用户登录');
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('账号或密码错误，请重试'));
        }
    }

    public function PCLogin()
    {
        $this->set('title_for_layout', '后台登陆');
    }

    public function checkLogin()
    {
        $data = $this->request->data;
        $userName = $data['nick_name'];
        $userPwd = sha1($data['key']);
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

    public function signIn()
    {
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        $this->set(compact('openId'));
    }

    public function findPasswd()
    {
       if (!$this->request->is('post')) {
            $tools = new JsApiPay();
            $openId = $tools->GetOpenid();
            // $openId = 'o5FzDw2nQn9jY5eqHrOKOJZOdq6U';
            $result = [
                'open_id' => $openId,
            ];
        } else {
            $data = $this->request->data;

            $userName = $data['userName'];
            $openId = $data['open_id'];
            $newKey = $data['newKey'];

            $user = $this->User->getUserByName($userName);

            if (!$user) {
                $result = [
                    'status' => 0,
                    'msg' => '没有找到该用户，请重新注册',
                ];
            } elseif(!empty($user['User']['open_id'])) {
                if ($user['User']['open_id'] == $openId) {
                    $this->User->id = $user['User']['id'];
                    $saveResult = $this->User->save(['password' => $newKey]);
                    if ($saveResult) {
                        $result = [
                            'status' => 1,
                        ];
                    } else {
                        $result = [
                            'status' => 0,
                            'msg' => '找回密码失败，请重试',
                        ];
                    }
                } else {
                    $util = new Utility();
                    $token = $this->Token->getToken(\Token::ACCESS_TOKEN);
                    $userDetail = $util->getUserDetailInfo($token, $user['User']['open_id']);
                    $nickName = isset($userDetail['nickname']) ? $userDetail['nickname'] : false;
                    $result = [
                        'status' => 0,
                        'msg' => '请使用注册账号时候的微信号 '.$nickName.' 来找回密码',
                    ];
                }
            } else {
                $this->User->id = $user['User']['id'];
                $saveData = [
                    'open_id' => $openId,
                    'password' => $newKey,
                ];
                $saveResult = $this->User->save($saveData);
                if ($saveResult) {
                    $result = [
                        'status' => 1,
                    ];
                } else {
                    $result = [
                        'status' => 0,
                        'msg' => '找回密码失败，请重试',
                    ];
                }
            }
            echo json_encode($result);
            exit();
        }
        $this->set(compact('result'));
    }

    public function getVerficationCode()
    {
        $data = $this->request->data;

        $a = new Utility();
        $phoneNum = $data['phoneNum'];

        $user = $this->User->find('first', [
            'conditions' => [
                'phone_num' => $phoneNum,
            ],
        ]);

        if ($user) {
            $result = [
                'status' => 0,
                'msg' => '该手机号已被注册, 请尝试找回密码或直接登录',
            ];
        } else {
            $data['code'] = $a->getRandomCode();
            $url = 'http://www.ihuyi.com/upload/file/cu-fa-jie-kou.rar';
            $sendCode = $a->customizeCurl($url, 1, $data);
            $result = [
                'code' => $data['code'],
                'status' => 1,
            ];
        }

        $this->layout = 'ajax';
        $this->set(compact('result'));
    }

    public function setPasswd()
    {
        $data = $this->request->data;
        $data = (array)json_decode($data['userInfo']);
        $phoneNum = $data['phoneNum'];
        $userName = $data['userName'];
        $openId = $data['openId'];

        $result = [
            'phoneNum' => $phoneNum,
            'userName' => $userName,
            'openId' => $openId,
        ];
        $this->layout = 'ajax';
        $this->set(compact('result'));
    }

    public function submitRegInfo()
    {
        $data = $this->request->data;

        $userName = $data['userName'];
        $phoneNum = $data['phoneNum'];
        $passwd = $data['passwd'];
        $openId = $data['openId'];
        $result = [];
        $isSaveUser = true;

        $user = $this->User->find('first', [
            'conditions' => [
                'username' => $userName,
            ],
        ]);

        if ($user) {
            if (!$user['User']['password']) {
                $this->User->id = $user['User']['id'];
            } else {
                $result = [
                    'status' => 0,
                    'msg' => '已有该用户名的注册信息，请尝试登陆或找回密码',
                ];
                $isSaveUser = false;
            }
        } else {
            $this->User->create();
        }

        if ($isSaveUser) {
            $saveData = [
                'username' => $userName,
                'phone' => $phoneNum,
                'password' => $passwd,
                'open_id' => $openId,
            ];

            $saveResult = $this->User->save($saveData);

            if ($saveResult) {
                $result['status'] = 1;
            } else {
                $result['status'] = 0;
                $result['msg'] = '服务器忙，请稍后重试';
            }
        }

        $this->layout = 'ajax';
        $this->set(compact('result'));
    }

    public function changePasswd()
    {
        $this->set('title_for_layout', '修改密码');
    }

    public function submitEditInfo()
    {
        $data = $this->request->data;

        $userName = AuthComponent::user('username');
        $oldKey = $data['origin_key'];
        $newKey = $data['new_key'];
        $result['status'] = 0;

        $checkRes = $this->User->checkPasswd($userName, $oldKey);

        if (!$checkRes['res']) {
            $result['msg'] = $checkRes['msg'];    
        } else {
            $saveResult = $this->User->updatePasswd($userName, $newKey);
            if ($saveResult) {
                $result['status'] = 1;
            } else {
                $result['msg'] = '修改失败，请稍后重试';
            }
        }

        echo json_encode($result);
        exit();
    }

    public function editUser()
    {
        $data = $this->request->data;

        $userId = $data['user_id'];
        $type = $data['type'];

        $this->User->id = $userId;
        $saveResult = $this->User->save(['is_activated' => $type]);

        if ($saveResult) {
            $result = [
                'status' => 1,
            ];
        } else {
            $result = [
                'status' => 0,
                'msg' => '保存失败，请稍后重试',
            ];
        }

        echo json_encode($result);
        exit();

    }

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('signIn', 'setPasswd', 'submitRegInfo', 'getVerficationCode', 'login', 'submitEditInfo', 'PCLogin', 'findPasswd');
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}