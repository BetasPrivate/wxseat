<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<title>个人中心</title>
<style>
<style>
body {
	background-color:#fff;
	}
.home {
	background-color:#f4f4f4;
	width:100%;
	min-width:320px;
	max-width:750px;
	margin:0 auto;
	}
.header {
	width:100%;
	height:6.8rem;
	border-top:solid 1px #ffceb0;
	background-color:#ffceb0;
	}
/*头像换图片改动*/
/*.header img {
	height:3.25rem;
	width:3.25rem;
	border-radius:50%;
	-webkit-border-radius:50%;
	-moz-border-radius:50%;
	-o-border-radius:50%;
	margin:1.1rem auto 0;
	display:block;
	}*/
.header {
	position: relative;
}
.header p {
	height:3.25rem;
	width:3.25rem;
	border-radius:50%;
	-webkit-border-radius:50%;
	-moz-border-radius:50%;
	-o-border-radius:50%;
	overflow: hidden;
	background:url(/img/touxiang.jpg);
	background-size:100%;
	-webkit-background-size:100%;
	margin:1.1rem auto 0;
}
.header p.active {
	opacity:0;
	position:absolute;
	top:0;
	left:50%;
	margin-left:-1.625rem;
}
/*改动开始*/
.header a {
	font-size:0.7rem;
	display: block;
	text-align: center;
	color:#333333;
	margin-top:0.5rem;
}
/*改动结束*/
.change {
	padding-left:5.5%;
	line-height:2.5rem;
	font-size:0.7rem;
	color:#333;
	background-color:#fff;
	margin:0.5rem 0;
	}
.time {
	padding-top:0.6rem;
	padding-left:5.5%;
	padding-right:3%;
	color:#999;
	font-size:0.6rem;
	background-color:#fff;
	line-height:1.4rem;
	}
.time p span {
	float:left;
	}
.time p em {
	float:right;
	}
.zhezhaoceng {
	background-color:rgba(0,0,0,0.5);
	position:fixed;
	top:0;
	left:0;
	width:100%;
	height:100%;
	display:none;
	}
.layer {
	width:84%;
	position:fixed;
	left:8%;
	top:30%;
	background-color:#fff;
	display:none;
	}
.layer li {
	height:2rem;
	line-height:2rem;
	border-bottom:solid 1px #d7d7d7;
	padding-left:6%;
	}
.layer li.li_1 {
	border-bottom:solid 1px #d7d7d7;
	}
.layer li.li_2 {
	border-top:solid 1px #d7d7d7;
	border-bottom:solid 1px #d7d7d7;
	}
.layer li i {
	float:left;
	margin-top:0.45rem;
	margin-right:0.4rem;
	width:1.4rem;
	height:1.1rem;
	background:url(/img/15_photo.jpg);
	background-size:100%;
	-webkit-background-size:100%;
	-moz-background-size:100%;
	-o-background-size:100%;
	}
.layer li em {
	float:left;
	margin-top:0.45rem;
	margin-right:0.4rem;
	width:1.4rem;
	height:1.1rem;
	background:url(/img/15_xiangce.jpg);
	background-size:100%;
	-webkit-background-size:100%;
	-moz-background-size:100%;
	-o-background-size:100%;
	}
/*点击拍照改动*/
.layer li {
	position: relative;
}
.layer li input {
	position:absolute;
	border:none;
	outline: none;
	box-sizing: border-box;
	width:100%;
	height:100%;
	opacity:0;
	top:0;
	left:0;
	z-index: 3;
}
</style>
</style>
</head>

<body>
<div class="home">
	<div class="header">
    	<!-- <img src="/img/touxiang.jpg" alt="头像"/> -->
    	<p id="imagePreview"></p>
    	<p id="imagePreview1" class="active"></p>
    	<a href="nickname_change.html"><?php echo AuthComponent::user('username');?></a>
    </div>
    <div class="change">修改密码</div>
    <div class="change"><a href="/users/logout">退出登录</a></div>
    <div class="time">
    	<p>租用记录</p>
        <hr class="mini">
    	<?php foreach($trades as $trade): ?>
	        <p class="clearfix"><span>租用到期时间</span><em><?php echo $trade['start_date'];?>至<?php echo $trade['end_date'];?></em></p>
	        <p class="clearfix"><span>租用的工位号/办公室号</span><em><?php echo $trade['seat_id_str'] ?></em></p>
	        <p class="clearfix"><span>租借费用</span><em><?php echo $trade['Trade']['total_fee'];?></em></p>
	        <p class="clearfix"><span>订单状态</span><em><?php echo $trade['trade_status_text'];?></em></p>
	        <hr class="mini">
    	<?php endforeach;?>
    </div>
</div>
<div class="zhezhaoceng"></div>
<div class="layer">
	<ul>
    	<li class="li_1">修改头像</li>
        <li class="li_2">
        	<i></i>相册
        	<input type="file" id="imageInput" onchange="loadImageFile();"/>
        </li>
        <li>
        	<em></em>拍照
        	<input type="file" accept="image/*" id="imageInput1" onchange="loadImageFile1();"/>
        </li>
    </ul>
</div>
<script src="/js/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function(e){
		//改动 header img
		$(".header p").click(function(){
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").css({display:"block"});
		});
		$(".zhezhaoceng").click(function(){
			$(".zhezhaoceng").css({display:"none"});
			$(".layer").css({display:"none"});
			});
		//更改头像改动
		$(".layer li input").click(function(){
			$(".zhezhaoceng").css({display:"none"});
			$(".layer").css({display:"none"});
		})
		$("#imageInput").click(function(){
			$(".header p").removeClass("active");
			$("#imagePreview1").addClass("active");
		})
		$("#imageInput1").click(function(){
			$(".header p").removeClass("active");
			$("#imagePreview").addClass("active");
		})
		});
</script>
<script src="/js/file_image.js"></script>
</body>
</html>
