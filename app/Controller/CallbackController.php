<?php
class CallbackController extends AppController
{
    public $uses = [
        'User',
        'WxLog',
        'Trade',
    ];

    function entrance()
    {
        $postStr = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : null;
        if ($postStr) {
            $this->WxLog->create();
            $this->WxLog->save(['data' => $postStr]);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $eventKey = trim((string)$postObj->EventKey);
            $event = trim((string)$postObj->Event);
            if ($eventKey == '1'){
                $msg = '报名地址：http://childwelfare.zhanshen1.com/registration';
                $this->sendTextMsg($postObj, $msg);
            } else if ($event == 'CLICK') {
                $this->dealWithClickEvents($postObj);
            } else if ($eventKey == 'on_scan_entrance_guard1') {
                $this->openEntranceGuard($postObj);
            }
        } else {
            $signature = isset($this->request->query['signature']) ? $this->request->query['signature'] : null;
            if ($signature) {
                $this->checkSignature($signature);
            }
        }
    }

    function openEntranceGuard($postObj){
        $util = new Utility();
        $res = $util->testEntranceGuard();
        $msg = $res['msg'];
        $this->sendTextMsg($postObj, $msg);
    }

    function wxPayCallback()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $this->WxLog->create();
        $result = $this->WxLog->save(['data' => $postStr]);
        if ($result) {
            echo "<xml>
                <return_code><![CDATA[SUCCESS]]></return_code>
                <return_msg><![CDATA[OK]]></return_msg>
                </xml>";
        }
        $this->Trade->parseTradePayReturnData($postStr);
        exit;
    }

    function sendTextMsg($obj, $msg)
    {
        $toUserName = (string)$obj->ToUserName;
        $fromUsername = (string)$obj->FromUserName;
        $createTime = time();
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>$createTime</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[%s]]></Content>
            <FuncFlag>0</FuncFlag>
            </xml>";
        echo sprintf($textTpl, $fromUsername, $toUserName, $msg);
        exit();
    }

    function checkSignature($signature)
    {
        $echoStr = isset($this->request->query['echostr']) ? $this->request->query['echostr'] : null;
        $timeStamp = isset($this->request->query['timestamp']) ? $this->request->query['timestamp'] : null;
        $nonce = isset($this->request->query['nonce']) ? $this->request->query['nonce'] : null;
        $token = 'zhanshenkeji';
        $tmpArr = array($token, $timeStamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            echo $echoStr;
            exit();
        }
    }

    function dealWithClickEvents($obj)
    {
        $eventKey = trim((string)$postObj->EventKey);
        switch ($eventKey) {
            case 'WX_PLAYER_REG':
                $this->sendPicMsg($obj, $mediaId);
                break;
            case 'WX_PLAYER_INTRO':
                $this->sendPicMsg($obj, $mediaId);
                break;
            case 'WX_COMPANY_INTRO':
                $this->sendPicMsg($obj, $mediaId);
                break;
            case 'WX_CONTACT_US':
                $this->sendPicMsg($obj, $mediaId);
                break;
        }
    }

    function sendPicMsg($obj, $mediaId)
    {
        $toUserName = (string)$obj->ToUserName;
        $fromUsername = (string)$obj->FromUserName;
        $createTime = time();
        $textTpl = "<xml>
            <ToUserName><![CDATA[%s]]></ToUserName>
            <FromUserName><![CDATA[%s]]></FromUserName>
            <CreateTime>$createTime</CreateTime>
            <MsgType><![CDATA[image]]></MsgType>
            <Image>
            <MediaId><![CDATA[%s]]></MediaId>
            </Image>
            </xml>";
        echo sprintf($textTpl, $fromUsername, $toUserName, $mediaId);
        exit();
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('wxPayCallback', 'entrance');
    }
}