<?php
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
            'expire_seconds' => 604800,
            'action_info' => [
                'scene' => [
                    'scene_id' => 1,
                ],
            ],
        ];
        if ($isTemp) {
            $data['action_name'] = 'QR_SCENE';
        } else {
            $data['action_name'] = 'QR_LIMIT_SCENE';
        }

        $data = json_encode($data);

        $resultStr = $this->postFileGetContents($url, $data);

        $result = json_decode($resultStr, true);
        $ticket = isset($result['ticket']) ? $result['ticket'] : '';

        return $ticket;
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
                            'url' => 'http://rentoffice.zhanshen1.com',
                        ],
                        1 => [
                            'name' => urlencode('个人中心'),
                            'type' => 'view',
                            'url' => 'http://rentoffice.zhanshen1.com/users/',
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
}