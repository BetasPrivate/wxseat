<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<title>找回密码</title>
<style>
body {
	max-width:750px;
	min-width:320px;
	margin:0 auto;
	}
form {
	/*background-color:#fff;*/
	margin-top:5rem;
	padding:0 10.5%;
	}
input[type=text],input[type=password] {
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
::-webkit-input-placeholder{color:#999;}    /* 使用webkit内核的浏览器 */
:-moz-placeholder{color:#999;}                  /* Firefox版本4-18 */
::-moz-placeholder{color:#999;}                  /* Firefox版本19+ */
:-ms-input-placeholder{color:#999;} 
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
</style>
</head>

<body>
	<div class="home">
    	<form>
    		<input type="text" id="userName" name="user_name" placeholder="用户名"/>
        	<input type="password" id="newKey" placeholder="新密码"/>
            <input type="password" id="newKeyForCheck" placeholder="再次输入新密码"/>
        </form>
        <div class="h28"></div>
        <a onclick="findPasswd()"><input type="submit" value="确定"/></a>
        <span id="msg" style="color: red;"></span>
    </div>
</body>
<script src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	var a = document.getElementById('msg');
	function findPasswd() {
		var data = <?php echo json_encode($result);?>;

		var newKey = $('#newKey').val();
		var newKeyForCheck = $('#newKeyForCheck').val();
		var userName = $('#userName').val();

		if (newKey.length < 8) {
			alert('密码长度小于8！');
			return;
		}
		if (newKey != newKeyForCheck) {
			alert('两次输入的密码不一致！');
			return;
		}

		data.newKey = newKey;
		data.userName = userName;

		$.ajax({
			'url': '/users/findPasswd',
			'type': 'POST',
			'dataType': 'json',
			'data': data,
			success:function(response) {
				if (response.status == 1) {
					a.innerText = '找回成功，3S后会跳往登录页面';
	                a.style = 'color: green;';
	                setTimeout("window.location.href='/'", 3000);
				} else {
					a.innerText = response.msg;
				}
			},
			error:function(res) {
				console.log(res);
			}
		})
	}

</script>
</html>
