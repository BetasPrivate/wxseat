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
    background-color:#f4f4f4;
    }
form {
    padding:0 5.5%;
    background-color:#fff;
    }
form span {
    width:25%;
    float:left;
    }
form input {
    width:70%;
    float:left;
    height:2.6rem;
    border:0;
    outline:none;
    box-sizing:border-box;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;
    -o-appearance:none;
    font-size:0.7rem;
    }
h2 {
    border-bottom:solid 1px #d7d7d7;
    }
h2,h3 {
    font-size:0.8rem;
    line-height:2.6rem;
    }
.h28 {
    height:1.4rem;
    width:100%;
    }
input[type=submit]{
    width:89%;
    display:block;
    margin:0 auto;
    height:2rem;
    line-height:2rem;
    text-align:2rem;
    background-color:#ffceb0;
    color:#333;
    border:0;
    outline:none;
    box-sizing:border-box;
    appearance:none;
    -webkit-appearance:none;
    -moz-appearance:none;
    -o-appearance:none;
    font-size:0.8rem;
    border-radius:0.15rem;
    -webkit-border-radius:0.15rem;
    -moz-border-radius:0.15rem;
    -o-border-radius:0.15rem;
    }
::-webkit-input-placeholder{color:#999;}    /* 使用webkit内核的浏览器 */
:-moz-placeholder{color:#999;}                  /* Firefox版本4-18 */
::-moz-placeholder{color:#999;}                  /* Firefox版本19+ */
:-ms-input-placeholder{color:#999;} 
</style>
</head>

<body>
    <div class="home">
        <span id="msg" style="color: green;">支付成功！正在前往个人中心</span>
    </div>
</body>
</html>
<script type="text/javascript">
    window.onload = function() {
    	setTimeout("window.location.href='/users'", 3000);
    }
</script>