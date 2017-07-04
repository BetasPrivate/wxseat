<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<script src="/js/jquery-3.2.1.min.js"></script>
<style>
body {
    max-width:750px;
    min-width:320px;
    margin:0 auto;
    background-color:#fff;
    }
.home {
    padding: 0 5.5%;
    }
.top {
    text-indent:35%;
    position:relative;
    line-height:4.9rem;
    border-bottom:solid 1px #d7d7d7;
    }
.top i {
    height:2.5rem;
    width:2.5rem;
    background:url(/img/success.jpg);
    background-size:100%;
    -webkit-background-size:100%;
    -moz-background-size:100%;
    -o-background-size:100%;
    position:absolute;
    top:1.2rem;
    left:16%;
    }
.main li {
    padding-left:4%;
    }
.main li h2 {
    font-size:0.7rem;
    color:#999;
    line-height:2.2rem;
    padding-top:0.2rem;
    }
.main li h3 {
    font-size:0.8rem;
    color:#333;
    }
ul {
    padding-bottom:1.25rem;
    }
.main {
    border-bottom:solid 1px #d7d7d7;
    }
.footer h2 {
    font-size:0.7rem;
    line-height:2.5rem;
    text-align:center;
    color:#999;
    }
.footer h3 {
    text-align:center;
    font-size:0.8rem;
    color:#333;
    padding-bottom:0.75rem;
    }
.footer h3 span {
    padding:0 0.8rem;
    }
.footer h4 {
    font-size:0.7rem;
    color:#999;
    line-height:2.2rem;
    text-align:center;
    }
.footer h5 img {
    width:39%;
    margin:0 auto;
    display:block;
    }
</style>
</head>

<body>
    <div class="home">
        <div class="top">
            <i></i>恭喜您预定成功！
        </div>
        <span id="msg" style="color: green;">支付成功！正在前往个人中心</span>
        <div class="main">
            <ul>
                <li>
                    <h2>上网账号</h2>
                    <h3>00000000000</h3>
                </li>
                <li>
                    <h2>密码</h2>
                    <h3>00000000000</h3>
                </li>
            </ul>
        </div>
        <div class="footer">
            <h2>您预定的工位号</h2>
            <h3>001<span></span>002<span></span>003</h3>
            <h4>门禁二维码</h4>
            <h5><img src="/img/erweima.jpg" alt="门禁二维码"/></h5>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    window.onload = function() {
    	setTimeout("window.location.href='/users'", 3000);
    }
</script>