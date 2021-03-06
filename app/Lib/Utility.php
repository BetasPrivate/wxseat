<?php
App::uses('Seat', 'Model');
class Utility {

	public function customizeCurl($url, $opt=0, $data=[])
    {
        $ch = curl_init();
        if ($opt == 1) {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            $curlDefault = [
                CURLOPT_URL => $url,
                CURLOPT_TIMEOUT => 300,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPAUTH => CURLAUTH_ANY,
                CURLOPT_FOLLOWLOCATION => TRUE,
            ];
            curl_setopt_array($ch, $curlDefault);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function getFileGetContents($url)
    {
        return (array) json_decode(file_get_contents($url));
    }

    public function postFileGetContents($url, $data)
    {
        $postdata = $data;

        $opts = array('http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata,
            ),
        );

        $context = stream_context_create($opts);
        $results = (array) json_decode(file_get_contents($url, false, $context));

        return $results;
    }

    //wx util

    public function getRandomCode()
    {
        return '888888';
    }

    //get scene ticket for QR
    public function getSceneTicket($token, $expireSeconds, $scendId, $isTemp = true)
    {
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s", $token);
        $data = [
            'action_info' => [
                'scene' => [
                    'scene_id' => $scendId,
                ],
            ],
        ];
        if ($isTemp) {
            $data['action_name'] = 'QR_SCENE';
            $data['expire_seconds'] = $expireSeconds;
        } else {
            $data['action_name'] = 'QR_LIMIT_STR_SCENE';
            unset($data['action_info']['scene']['scene_id']);
            $data['action_info']['scene']['scene_str'] = $scendId;
        }

        $data = json_encode($data);

        $result = $this->postFileGetContents($url, $data);

        $ticket = isset($result['ticket']) ? $result['ticket'] : '';

        return $ticket;
    }

    public function getSceneTicketUrl($token, $expireSeconds = 604800, $scendId, $isTemp = true, $ticket = '')
    {
        if ($ticket == '') {
            $ticket = $this->getSceneTicket($token, $expireSeconds, $scendId, $isTemp);
        }
        $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;

        $result = [
            'ticket' => $ticket,
            'url' => $url,
        ];

        return $result;
    }

    public function getAccessToken()
    {
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s", APP_ID, APP_SECRET);
        $result = $this->getFileGetContents($url);
        
        return $result;
    }

    public function getJsApiTicket($token)
    {
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi", $token);
        $result = $this->getFileGetContents($url);

        return $result;
    }

    public function getUserDetailInfo($token, $openId)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$openId.'&lang=zh_CN';

        return $this->getFileGetContents($url);
    }

    //edit the menu to what u want.
    public function editMenu($token = '')
    {
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s", $token);
          $data = [
            'button' => [
                0 => [
                    "name" => urlencode('用户'),
                    'type' => 'click',
                    'key' => 'DO_NOTHING',
                    'sub_button' => [
                        0 => [
                            'name' => urlencode('选座页面'),
                            'type' => 'view',
                            'url' => 'http://'.ROOT_URL,
                        ],
                        1 => [
                            'name' => urlencode('个人中心'),
                            'type' => 'view',
                            'url' => 'http://'.ROOT_URL.'/users/',
                        ],
                    ],
                ],
            ],
        ];
        $data = json_encode($data);
        $data = urldecode($data);

        var_dump($this->postFileGetContents($url, $data));
    }

    public function addMedia($token = '')
    {
        $postUrl = sprintf("https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=%s", '_gl-huotDRouGUtWzO8xKEB3xGuFHgOmJ6QgA2Eli0n6HHQTW8e8XTCWos8CAFmu47qB0lhOCwcIgC9MSCKE5JOQA1bXpivfN9rLfhZhHkyrEtrMXSQ3u7aHQcYJiw2DPVPaAHAAGA');
        $url = 'http://childwelfare.zhanshen1.com/pic1.jpg';
        $data = [
            'articles' => [
                0 => [
                    "title" => 'pic1',
                    "thumb_media_id" => 'pic1',
                    "author" => 'cary',
                    "digest" => 'empty',
                    "show_cover_pic" => 0,
                    "content" => 'empty',
                    "content_source_url" => $url,
                ],
            ],
        ];
        $data = json_encode($data);

        var_dump($this->customizeCurl($postUrl, 1, $data));
    }

    public function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v)
        {
            if($k != "sign"){
                $buff .= $k . "=" . $v . "&";
            }
        }
        
        $buff = trim($buff, "&");
        return $buff;
    }

    public function diffDate($date1,$date2){

        if(strtotime($date1) > strtotime($date2)){
            $tmp = $date2;
            $date2 = $date1;
            $date1 = $tmp;
        } 
        list($Y1, $m1, $d1) = explode('-', $date1);
        list($Y2, $m2, $d2) = explode('-', $date2);
        $Y = $Y2-$Y1;
        $m = $m2-$m1;
        $d = $d2-$d1;
        if($d < 0){
            $d += (int)date('t',strtotime("-1 month $date2"));
            $m--;
        }
        if($m < 0){
            $m += 12;
            $Y--;
        }
        return array('year'=>$Y,'month'=>$m,'day'=>$d);
    }

    public function testEntranceGuard($type=11, $id=1)
    {
        if (extension_loaded('soap')) {
            $url = "http://mj2vm.cn/SyncWebService.asmx?wsdl";
            $client = new SoapClient($url);
            $client->soap_defencoding = 'utf-8';  
            $client->decode_utf8 = false;   
            $client->xml_encoding = 'utf-8';

            $guardConfig = ClassRegistry::init('EntranceGuardConfig')->getConfig($id);
            $devId = $guardConfig['EntranceGuardConfig']['dev_id'];
            $devPwd = $guardConfig['EntranceGuardConfig']['dev_pwd'];
            $devInterval = $guardConfig['EntranceGuardConfig']['close_interval'];
            $openCmd = $guardConfig['EntranceGuardConfig']['open_cmd'];
            $closeCmd = $guardConfig['EntranceGuardConfig']['close_cmd'];

            if ($type == 11) {
                $type = $openCmd;
                if ((Int)$devInterval > 0) {
                    $type = $openCmd.':'.$devInterval;
                }
            } else {
                $type = $closeCmd;
            }

            $param = array('devId'=>$devId, 'devPwd'=>$devPwd);
            $param['devCmd'] = $type;
            $res = $client->__Call("SendCommand", array( $param ))->SendCommandResult;

            $result['msg'] = \Seat::entranceGuardModeText($res);
            $result['code'] = $res;
        } else {
            $result['msg'] = '当前服务器不支持此操作';
        }

        return $result;
    }
}