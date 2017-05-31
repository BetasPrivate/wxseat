<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<title>预定工位</title>
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<style>
body {
	background-color:#fff;
	max-width:750px;
	min-width:320px;
	}
.home {
	padding:0 5.5%;
	width:89%;
	margin:0 auto;
	background-color:#fff;
	}
h2 {
	font-size:0.7rem;
	color:#999;
	line-height:2rem;
	margin-top:0.7rem;
	} 
.method h3 li {
	width:12%;
	float:left;
	line-height:1.4rem;
	font-size:0.8rem;
	text-align:center;
	border:solid 2px #ffceb0;
	margin-left:3%;
	border-radius:0.5rem;
	-webkit-border-radius:0.5rem;
	-moz-border-radius:0.5rem;
	-o-border-radius:0.5rem;
	color:#333;
	}
.method h3 li.active {
	background-color:#ffceb0;
	}
h4 {
	font-size:1.1rem;
	color:#ff462d;
	}
h5 {
	color:#333;
	font-size:0.8rem;
	padding-bottom:0.7rem;
	border-bottom:solid 1px #d7d7d7;
	}
h6 em {
	float:left;
	margin:0 0.5rem;
	}
h6 span,h6 i {
	height:1.2rem;
	width:1.2rem;
	float:left;
	}
h6 span {
	background:url(/img/jian.jpg);
	background-size:100%;
	-webkit-background-size:100%;
	-moz-background-size:100%;
	-o-background-size:100%;
	}
h6 i {
	background:url(/img/jia.jpg);
	background-size:100%;
	-webkit-background-size:100%;
	-moz-background-size:100%;
	-o-background-size:100%;
	}
.submit {
	width:100%;
	height:2.2rem;
	line-height:2.2rem;
	text-align:center;
	color:#333;
	position:fixed;
	left:0;
	bottom:0;
	font-size:0.8rem;
	background-color:#ffceb0;
	}
</style>
</head>

<body>
	<div class="home">
		<p style="color: red;" id="warningMsg"></p>
		<div class="seatIds">
			<h2>已选工位</h2>
			<h4><?php echo $result['idInfo'];?></h4>
		</div>
        <div class="zujin">
        	<h2>租金</h2>
            <h4>￥<?php echo $result['price'];?></h4>
        </div>
        <div class="zujin">
        	<h2>保证金</h2>
            <h4>￥100.00</h4>
        </div>
        <div class="srartdate">
        	<h2>起始日期</h2>
            <h5>2017-03-11</h5>
        </div>
        <div class="gongweihao">
        	<h2>工位数</h2>
            <h6 class="clearfix"><em class="number"><?php echo sizeof($result['seatInfo']);?></em></h6>
        </div>
        <div class="total">
        	<h2>总计</h2>
            <h4>￥<?php echo $result['totalFee'];?></h4>
        </div>
    </div>
    <div style="height:2.2rem;"></div>
	<a onclick="submitOrder()" class="submit">提交订单</a>
<script src="/js/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function(e) {
		var number=Number($(".number").text());
        $(".jian").click(function(){
			if(number<2){
				number=1;
			}else{
				number--;
				}
			$(".number").text(number);
			});
		 $(".jia").click(function(){
			if(number>162){
				number=163;
			}else{
				number++;
				}
			$(".number").text(number);
			});
		$(".method li").click(function(){
			$(".method li").removeClass("active");
			$(this).addClass("active");
			});
    });
    function submitOrder() {
    	var data = <?php echo json_encode($result);?>;
    	var postData = {};
    	postData.seatInfo = data.seatInfo;
    	postData.totalFee = data.totalFee;
    	postData.dates = data.dates;
    	$.ajax({
    		url: '/orders/createNewOrder',
    		method: 'post',
    		dataType: 'json',
    		data: postData,
    		success: function(response) {
    			console.log(response);
    			if (response.status == 1) {
    				var mapForm = document.createElement("form");
				    mapForm.method = "POST"; // or "post" if appropriate
				    mapForm.action = "/orders/prePay";
				    var mapInput = document.createElement("input");
				    mapInput.type = "text";
				    mapInput.name = "seatInfo";
				    mapInput.value = JSON.stringify(data);
				    mapForm.appendChild(mapInput);
				    document.body.appendChild(mapForm);
				    mapForm.submit();
    			} else {
    				document.getElementById('warningMsg').innerHTML = response.msg;
    			}
    		},
    		error:function(response) {
    			console.log(response);
    		}
    	})
    }
</script>
</body>
</html>
