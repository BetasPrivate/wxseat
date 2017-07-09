<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<title>修改密码</title>
<style>
body {
	max-width:750px;
	min-width:320px;
	margin:0 auto;
	background-color:#f4f4f4;
	}
form {
	padding:0 10.5%;
	margin-top:5rem;
	}
form input {
	width:100%;
	height:1.8rem;
	border:0;
	outline:none;
	box-sizing:border-box;
	appearance:none;
	-webkit-appearance:none;
	-moz-appearance:none;
	-o-appearance:none;
	font-size:0.8rem;
	margin-bottom: 0.5rem;
	text-indent: 4.6%;
	}
.h28 {
	height:0.2rem;
	width:100%;
	}
input[type=submit]{
	width:64.7%;
	display:block;
	margin:0 auto;
	height:1.65rem;
	line-height:1.65rem;
	text-align:center;
	background-color:#4bb5c3;
	color:#FFFFFF;
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
    	<form>
        	<!-- <h2 class="clearfix"><span>用户名</span><input type="text" id="userName" name="user_name" placeholder="用户名"/></h2>
        	<h2 class="clearfix"><span>原密码</span><input type="password" id="originKey" name="old_key" placeholder="原密码"/></h2>
            <h2 class="clearfix"><span>新密码</span><input type="password" id="newKey" name="new_key" placeholder="新密码（8位及以上）"/></h2>
            <h3 class="clearfix"><span>再次输入新密码</span><input type="password" id="newKeyForCheck" name="resetkey" placeholder="再次输入"/></h3> -->
            <input type="text" id="userName" name="user_name" placeholder="用户名"/>
            <input type="password" name="originKey" placeholder="原密码"/>
            <input type="password" name="newKey" placeholder="新密码"/>
            <input type="password" name="newKeyForCheck" placeholder="再次输入新密码"/>
        </form>
        <div class="h28"></div>
        <span id="msg" style="color: red;"></span>
        <a href="#" onclick="changePasswd()"><input type="submit" value="确认修改"/></a>
    </div>
</body>
<script src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	function changePasswd() {
		var a = document.getElementById('msg');
		var userName = $('#userName').val();
		var originKey = $('#originKey').val();
		var newKey = $('#newKey').val();
		var newKeyForCheck = $('#newKeyForCheck').val();
		if (newKey.length < 8) {
			alert('密码长度小于8！');
			return;
		}
		if (newKey != newKeyForCheck) {
			alert('两次输入的密码不一致！');
			return;
		}
		var data = {
			user_name:userName,
			origin_key:originKey,
			new_key: newKey,
			new_key_for_check:newKeyForCheck,
		};
		$.ajax({
			url: '/users/submitEditInfo',
			type:'POST',
			dataType:'json',
			data: data,
			success:function(response) {
				if (response.status == 1) {
					a.innerText = '修改成功，正在转往登陆界面';
                    a.style = 'color: green;';
                    setTimeout("window.location.href='/'", 3000);
				} else {
					a.innerText = response.msg;
				}
			},
			error:function(response) {
				console.log(response);
			}
		})
	}
</script>
</html>
