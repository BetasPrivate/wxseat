<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<title>支付订单</title>
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<style>
	body {
		background-color:#f4f4f4;
		color:#333;
		}
	.home {
		width:100%;
		max-width:750px;
		min-width:320px;
		margin:0 auto;
		background-color:#fff;
		}
	.home h2,.home h3,.home h4 {
		width:87%;
		margin:0 auto;
		}
	.home h2 {
		font-size:0.7rem;
		color:#666;
		line-height:2.75rem;
		padding-top:0.5rem;
		}
	.home h2 em {
		font-size:1.1rem;
		color:#ff462d;
		}
	.home h3 {
		color:#999;
		font-size:0.7rem;
		line-height:1rem;
		padding-bottom:1.5rem;
		border-bottom:solid 1px #d7d7d7;
		}
	.home h2 span,.home h3 span {
		float:left;
		width:25%;
		}
	.home h2 em,.home h3 em {
		float:left;
		width:75%;
		}
	.home h4 {
		font-size:0.8rem;
		line-height:2.1rem;
		padding-bottom:0.75rem;
		}
	.home h4 em {
		float:right;
		height:1.2rem;
		width:1.2rem;
		border:solid 1px #d7d7d7;
		border-radius:0.15rem;
		-webkit-border-radius:0.15rem;
		-moz-border-radius:0.15rem;
		-o-border-radius:0.15rem;
		margin-top:0.45rem;
		}
	.chengnuo {
		padding-left:3%;
		}
	.chengnuo em {
		float:left;
		height:0.8rem;
		width:0.8rem;
		margin-right:0.8rem;
		border:solid 1px #d7d7d7;
		border-radius:0.15rem;
		-webkit-border-radius:0.15rem;
		-moz-border-radius:0.15rem;
		-o-border-radius:0.15rem;
		margin-top:0.95rem;
		}
	.home h4 em.active,.chengnuo em.active {
		background:url(/img/qrzf_one_duihao.png);
		background-size:100%;
		-webkit-background-size:100%;
		-moz-background-size:100%;
		-o-background-size:100%;
		}
	.chengnuo {
		font-size:0.7rem;
		line-height:2.7rem;
		}
	.chengnuo span {
		color:#ff462d;
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
	@media screen and (max-device-width:340px) {
		.home h2 span,.home h3 span {
			width:27%;
			}
		.home h2 em,.home h3 em {
			width:73%;
			}
		}
	@media screen and (min-device-width:340px) {
		.home h2 span,.home h3 span {
			width:25%;
			}
		.home h2 em,.home h3 em {
			width:75%;
			}
		}
	</style>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script>
	    wx.config({

	        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。

	        appId: "<?php echo $result['appId'];?>", // 必填，公众号的唯一标识

	        timestamp: <?php echo $result['timeStamp'];?>, // 必填，生成签名的时间戳

	        nonceStr: "<?php echo $result['nonceStr'];?>", // 必填，生成签名的随机串

	        signature: "<?php echo $result['signature'];?>",// 必填，签名，见附录1

	        jsApiList: ['chooseWXPay', 'checkJsApi'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2

	    });


	    wx.checkJsApi({
	        jsApiList: ['chooseImage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
	        success: function(res) {
	            console.log(res);
	        }
	    });
	</script>
	<script type="text/javascript">
	    //调用微信JS api 支付
	    function jsApiCall()
	    {
	        WeixinJSBridge.invoke(
	            'getBrandWCPayRequest',
	            <?php echo $result['jsApiParameters']; ?>,
	            function(res){
	                WeixinJSBridge.log(res.err_msg);
	                alert(res.err_code+res.err_desc+res.err_msg);
	                if (res.err_msg == 'get_brand_wc_pay_request:ok') {
	                	window.location.href = '/orders/paySuccess';
	                }
	            }
	        );
	    }

	    function callpay()
	    {
	        if (typeof WeixinJSBridge == "undefined"){
	            if( document.addEventListener ){
	                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
	            }else if (document.attachEvent){
	                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
	                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
	            }
	        }else{
	            jsApiCall();
	        }
	    }
	</script>
	<script type="text/javascript">
	    //获取共享地址
	    function editAddress()
	    {
	        WeixinJSBridge.invoke(
	            'editAddress',
	            <?php echo $result['editAddress']; ?>,
	            function(res){
	                var value1 = res.proviceFirstStageName;
	                var value2 = res.addressCitySecondStageName;
	                var value3 = res.addressCountiesThirdStageName;
	                var value4 = res.addressDetailInfo;
	                var tel = res.telNumber;
	                
	                alert(value1 + value2 + value3 + value4 + ":" + tel);
	            }
	        );
	    }
	    
	    window.onload = function(){
	        if (typeof WeixinJSBridge == "undefined"){
	            if( document.addEventListener ){
	                document.addEventListener('WeixinJSBridgeReady', editAddress, false);
	            }else if (document.attachEvent){
	                document.attachEvent('WeixinJSBridgeReady', editAddress); 
	                document.attachEvent('onWeixinJSBridgeReady', editAddress);
	            }
	        }else{
	            editAddress();
	        }
	    };
	    
	</script>
</head>

<body>
	<div class="home">
    	<h2><span>实际支付：</span><em> ¥ <?php echo $result['totalFee'];?></em></h2>
        <h3 class="clearfix"><span>温馨提示：</span><em>保证金作为押金以防办公设施破坏，租期结束后五个工作日内线下返还。</em></h3>
        <h4>开具发票<em></em></h4>
    </div>
    <div class="chengnuo"><em></em>确认<span>“协议”</span>和<span>“承诺书”</span></div>
    <a onclick="callpay()" class="submit">立即付款</a>
    <!-- <a href="/orders/payOrder/1">立即付款</a> -->
</body>
<script src="/js/jquery-3.2.1.min.js"></script>

<script>
	$(document).ready(function(e){
        $(".home h4 em").click(function() {
			if($(this).hasClass("active")){
				$(this).removeClass("active");
			}else{
				$(this).addClass("active");
				};
			});
		$(".chengnuo em").click(function() {
			if($(this).hasClass("active")){
				$(this).removeClass("active");
			}else{
				$(this).addClass("active");
				};
			});
    });

</script>
</html>
