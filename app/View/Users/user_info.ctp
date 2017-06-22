<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<style>
body {
	background-color:#f4f4f4;
	min-width:320px;
	max-width:750px;
	margin:0 auto;
	}
.home {
	width:89%;
	padding:0 5.5%;
	margin:0.4rem 0;
	background-color:#fff;
	}
.home span {
	float:left;
	width:15%;
	line-height:2.2rem;
	font-size:0.8rem;
	color:#999;
	}
.home input {
	float:left;
	height:2.2rem;
	width:85%;
	border:none;
	outline:none;
	box-sizing:border-box;
	font-size:0.8rem;
	color:#333;
	appearance:none;
	-webkit-appearance:none;
	-moz-appearance:none;
	-o-appearance:none;
	}
</style>
</head>

<body>
	<div class="home clearfix">
    	<span>昵称</span><input type="text" name="nickname" value="<?php echo AuthComponent::user('username');?>" />
    </div>
</body>
</html>
