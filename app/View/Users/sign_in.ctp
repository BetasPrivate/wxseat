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
        	<input type="text" name="nicheng" id="userName" placeholder="用户名(请使用真实信息)"/>
            <h2><input type="tel" name="phone" id="phoneNum" placeholder="手机号码(请使用真实信息)"/><!-- <i class="get_number" onclick="getVerficationCode()">获取验证码</i> --></h2>
            <!-- <input type="text" id="verficationCode" placeholder="验证码" class="yanzhengma"/> -->
        </form>
    </div>
    <div class="h28"></div>
    <!--提交表单，或用其他方法跳转-->
    <a href="#"><input type="submit" value="下一步" onclick="verifyCode()"/></a>
    <span id="msg" style="color: red;"></span>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script>
    	var code = 0;
		var a = document.getElementById('msg');
    	//6.21
    	$(".get_number").click(function(){
			$(this).text("60s后重新获取");
			$(this).css({backgroundColor:"#d7d7d7",color:"#999999"});
			$("input[type='submit']").css({backgroundColor:"#4bb5c3",color:"#ffffff"});
			setTimeout(function(){
				$(".get_number").text("获取验证码");
				$(".get_number").css({backgroundColor:"#4bb5c3",color:"#ffffff"});
				$("input[type='submit']").css({backgroundColor:"#ffffff",color:"#4bb5c3"});
				},60000);
			});
    	function getVerficationCode() {
			var userName = document.getElementById('userName').value.trim();
			var phoneNum = document.getElementById('phoneNum').value.trim();
    		var data = {
    			userName: userName,
    			phoneNum: phoneNum,
    		};
    		console.log(data);
    		$.ajax({
    			url: '/users/getVerficationCode',
    			type: 'POST',
    			dataType: 'json',
    			data: data,
    			success:function(response) {
    				if (response.status == 1) {
    					code = response.code;
    				} else {
    					a.innerText = response.msg;
    				}
    			},
    			error: function(data) {
    				console.log(data);
    			}
    		})
    	}

    	function verifyCode() {
    		// var inputCode = document.getElementById('verficationCode').value.trim();
    		// if (inputCode == '') {
    		// 	a.innerText = '请输入验证码!';
    		// 	return;
    		// }
    		// if (code != inputCode) {
    		// 	a.innerText = '验证码输入有误!';
    		// 	return;
    		// }
    		var phoneNum = document.getElementById('phoneNum').value.trim();
    		var userName = document.getElementById('userName').value.trim();
    		if (phoneNum == '') {
    			a.innerText = '手机号不能为空!';
    			return;
    		}
    		if (userName == '') {
    			a.innerText = '用户名不能为空!';
    			return;
    		}
    		var data = {
    			phoneNum: phoneNum,
    			userName: userName,
    			openId: '<?php echo $openId;?>',
    		};
    		if(!confirm('用户名和手机号会用作后续的会员管理，您确认填入的信息无误吗？')){
    			return;
    		}
    		var mapForm = document.createElement("form");
    		mapForm.style = 'display:none';
		    mapForm.method = "POST"; // or "post" if appropriate
		    mapForm.action = "/users/setPasswd";
		    var mapInput = document.createElement("input");
		    mapInput.type = "text";
		    mapInput.name = "userInfo";
		    mapInput.value = JSON.stringify(data);
		    mapForm.appendChild(mapInput);
		    document.body.appendChild(mapForm);
		    mapForm.submit();
    	}
    </script>
</body>
</html>
