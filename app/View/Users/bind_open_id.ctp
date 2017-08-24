<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<title>注册</title>
<style>
body {
	max-width:750px;
	min-width:320px;
	margin:0 auto;
	}
	/*7.5*/
.home {
	padding:0 10.5%;
	margin-top:5rem;
	}
input[type=text],input[type=tel] {
	background-color:#fff;
	width:100%;
	height:1.8rem;
	border:0;
	outline:none;
	box-sizing:border-box;
	appearance:none;
	-webkit-appearance:none;
	-moz-appearance:none;
	-o-appearance:none;
	/*border-bottom:solid 1px #d7d7d7;*/
	font-size:0.8rem;
	margin-bottom: 0.5rem;
	text-indent: 4.6%;
	}
input[type=text].yanzhengma {
	border:none;
	}
::-webkit-input-placeholder{color:#999;}    /* 使用webkit内核的浏览器 */
:-moz-placeholder{color:#999;}                  /* Firefox版本4-18 */
::-moz-placeholder{color:#999;}                  /* Firefox版本19+ */
:-ms-input-placeholder{color:#999;} 
h2 {
	position:relative;
	}
.get_number {
	height:1.1rem;
	line-height:1.1rem;
	width:5.3rem;
	position:absolute;
	top:0.75rem;
	right:0;
	text-align:center;
	/*6.21*/
	background-color:#4bb5c3;
	color:#FFFFFF;
	border-radius:0.55rem;
	-webkit-border-radius:0.55rem;
	-moz-border-radius:0.55rem;
	-o-border-radius:0.55rem;
	font-size:0.6rem;
	}
.h28 {
	height:0.75rem;
	width:100%;
	}
input[type=submit]{
	width:64.7%;
	display:block;
	margin:0 auto;
	height:1.65rem;
	line-height:1.65rem;
	text-align:2rem;
	border:0;
	outline:none;
	box-sizing:border-box;
	appearance:none;
	-webkit-appearance:none;
	-moz-appearance:none;
	-o-appearance:none;
	/*6.21*/
	background-color:#4ab5c2;
	color:#FFFFFF;
	/*6.12 end*/
	font-size:0.8rem;
	border-radius:0.15rem;
	-webkit-border-radius:0.15rem;
	-moz-border-radius:0.15rem;
	-o-border-radius:0.15rem;
	}
</style>
</head>

<body>
	<div class="home">
    	<form>
        	<!-- <input type="text" name="nicheng" id="userName" placeholder="用户名(请使用真实信息)"/>
            <h2><input type="tel" name="phone" id="phoneNum" placeholder="手机号码(请使用真实信息)"/> --><!-- <i class="get_number" onclick="getVerficationCode()">获取验证码</i> --></h2>
            <!-- <input type="text" id="verficationCode" placeholder="验证码" class="yanzhengma"/> -->
        </form>
    </div>
    <div class="h28"></div>
    <!--提交表单，或用其他方法跳转-->
    <a href="#"><input type="submit" value="一键绑定当前微信号" onclick="bindOpenId()"/></a>
    <span id="msg" style="color: red;"></span>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script>
    	function bindOpenId() {
    		if (!confirm('确认绑定？')) {
    			return;
    		}
    		var data = {
    			open_id:'<?php echo $openId;?>',
    		};
    		$.ajax({
    			url:'/users/setOpenId',
    			method:'POST',
    			dataType:'json',
    			data:data,
    			success:function(res){
    				if (res.status == 1) {
    					alert('绑定成功');
    				} else {
    					alert(res.msg);
    				}
    			},
    		})
    	}
    </script>
</body>
</html>
