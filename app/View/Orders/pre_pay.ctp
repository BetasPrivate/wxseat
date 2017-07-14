<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<title>支付订单</title>
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<link rel="stylesheet" href="/css/LArea.css">
<style>
	body {
	background-color:#f4f4f4;
	color:#333;
	max-width:750px;
	min-width:320px;
	margin:0 auto;
	}
	.home {
		width:100%;
		background-color:#fff;
		}
	.home h2,.home h3,.home h4 {
		width:87%;
		margin:0 auto;
		}
	.home h4.active {
		border-top:solid #d7d7d7 1px;
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
	.home h4.active {
		display:none;
		}
	.home h4.active input {
		border:none;
		outline:none;
		box-sizing:border-box;
		height:2.1rem;
		font-size:0.8rem;
		width:75%;
		float:right;
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
		margin-bottom:1rem;
		}
	.chengnuo span {
		color:#ff462d;
		}
	.submit {
		width:100%;
		height:2.2rem;
		line-height:2.2rem;
		text-align:center;
		position:fixed;
		left:0;
		bottom:0;
		font-size:0.8rem;
		/*6.21改动*/
		background-color:#4bb5c3;
		color:#FFFFFF;
		}
	.post_msg {
		display:none;
		}
	.post_msg h2 {
		height:1.8rem;
		line-height:1.8rem;
		font-size:0.7rem;
		color:#999;
		padding:0 5.5%;
		}
	.post_msg h3 {
		background-color:#fff;
		padding:0 5.5%;
		}
	.post_msg h3 li {
		line-height:2.2rem;
		font-size:0.8rem;
		color:#333;
		border-bottom:solid 1px #d7d7d7;
		}
	.post_msg h3 li.last{
		border-bottom:none;
		}
	.post_msg h3 li input {
		border:none;
		outline:none;
		box-sizing:border-box;
		height:2.1rem;
		font-size:0.8rem;
		width:75%;
		float:right;
		}
	::-webkit-input-placeholder{color:#999;}    /* 使用webkit内核的浏览器 */
	:-moz-placeholder{color:#999;}                  /* Firefox版本4-18 */
	::-moz-placeholder{color:#999;}                  /* Firefox版本19+ */
	:-ms-input-placeholder{color:#999;}
	.h28 {
		height:1.4rem;	
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
	/*地址选择改动*/
	.area_ctrl {
		background-color:#ffffff;
	}
	.larea_cancel {
		color:#999999;
		font-family:"DFPHannotateW5-GB";
		font-size:0.8rem;
	}
	.larea_finish {
		color:#ff553e;
		font-family:"DFPHannotateW5-GB";
		font-size:0.8rem;
	}
	.area_btn_box {
		background-color: #ffffff;
	}
	.area_roll>div {
		font-size: 0.7rem;
	}
	</style>
	<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<script>
	    wx.config({

	        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。

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
	                // alert(res.err_code+res.err_desc+res.err_msg);
	                if (res.err_msg == 'get_brand_wcpay_request:ok') {
                        editBuyerInfo();
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
	                
	                // alert(value1 + value2 + value3 + value4 + ":" + tel);
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
        <h4 class="active">
        	<!--7.5改动-->
        	<ul>
        		<li>
        			发票抬头<input type="text" name="header" placeholder="填写公司抬头" id="company"/>
        		</li>
        		<li style="border-top: solid #d7d7d7 1px;">
        			发票税号<input type="text" name="header" placeholder="填写公司税号" id="tax_payer_id"/>
        		</li>
        	</ul>
        </h4>
    </div>
    <div class="post_msg">
    	<h2>收件信息</h2>
        <h3>
        	<ul>
            	<li>收件人<input type="text" name="person" placeholder="填写收件人" id="recipients"/></li>
                <li>联系电话<input type="tel" name="phone" placeholder="填写联系电话" id="phone"/></li>
                <!--地址选择改动-->
                <li  class="content-block">所在地区<input id="demo1" type="text" name="area" readonly="readonly" value="请选择，请选择，请选择"/></li>
                <li class="last">详细地址<input type="text" name="address" placeholder="填写详细地址" id="address" /></li>
            </ul>
        </h3>
    </div>
    <div class="chengnuo"><em></em>确认<span>“协议”</span>和<span>“承诺书”</span></div>
    <a onclick="callpay()" class="submit">立即付款</a>
    <!-- <a href="/orders/payOrder/1">立即付款</a> -->
</body>
<script src="/js/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function(e){
		//6.14逻辑改动
		$(".chengnuo em").addClass("active");
		//点击发票
		function fapiao(){
			if($(this).hasClass("active")){
				$(this).removeClass("active");
				$(".home h4").css({paddingBottom:"0.75rem"});
				$(".home h4.active").css({display:"none"});
				$(".post_msg").css({display:"none"});
			}else{
				$(".home h4 em").addClass("active");
				$(".home h4").css({paddingBottom:"0"});
				$(".home h4.active").css({display:"block"});
				$(".post_msg").css({display:"block"});
			};
		}
		//获取信息
		function bangding(){
			if($(".home h4 em").hasClass("active")){
				var company_name=$("#company").val();
				var person=$("#recipients").val();
				var phone=$("#phone").val();
				var arean=$("#demo1").val();
				var area_details=$("#area_details").val();
				console.log(company_name,person,phone,arean,area_details);
			}
		}
		
		$(".home h4 em").bind("click",fapiao);
		$(".submit").bind("click",bangding);
		
		$(".chengnuo em").click(function() {
			if($(this).hasClass("active")){
				$(this).removeClass("active");
				$(".home h4 em").unbind("click");
				$(".submit").unbind("click");
				$('.home h4 em').removeClass("active");
				$(".home h4").css({paddingBottom:"0.75rem"});
				$(".home h4.active").css({display:"none"});
				$(".post_msg").css({display:"none"});
			}else{
				$(this).addClass("active");
				 $(".home h4 em").bind("click",fapiao);	
				 $(".submit").bind("click",bangding);
				}
			});
    });
</script>
<!--地址选择改动-->
<script src="/js/LAreaData1.js"></script>
<script src="/js/LArea.js"></script>
<script>
    var area1 = new LArea();
    area1.init({
        'trigger': '#demo1', //触发选择控件的文本框，同时选择完毕后name属性输出到该位置
        'valueTo': '#value1', //选择完毕后id属性输出到该位置
        'keys': {
            id: 'id',
            name: 'name'
        }, //绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
        'type': 1, //数据源类型
        'data': LAreaData //数据源
    });
    area1.value=[27,13,3];//控制初始位置，注意：该方法并不会影响到input的value
</script>
<script type="text/javascript">
    function editBuyerInfo()
    {
        var company = $('#company').val();
        var tax_payer_id = $('#tax_payer_id').val();
        var recipients = $('#recipients').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var country = '中国';
        var provinceKey = area1.value[0];
        var cityKey = area1.value[1];
        var districtKey = area1.value[2] == undefined ? area1.value[1] : area1.value[2];
        var data = area1.data;
        var province = data[provinceKey].name;
        var city = data[provinceKey].child[cityKey].name;
        if (area1.value[2] != undefined) {
            var district = data[provinceKey].child[cityKey].child[districtKey].name;
        } else {
            var district = city;
        }

        var data = {
            invoice_title:company,
            tax_payer_id:tax_payer_id,
            receiver_name:recipients,
            receiver_phone:phone,
            receiver_country:country,
            receiver_province:province,
            receiver_city:city,
            receiver_district:district,
            receiver_address:address,
            trade_id:'<?php echo $result['tradeId'];?>',
        };

        $.ajax({
            url:'/trades/editTradeInfo',
            type:'POST',
            dataType:'json',
            data:data,
            success:function(res){
                window.location.href = '/orders/paySuccess';
            },
            error:function(res){
                alert(JSON.stringify(res));
                window.location.href = '/orders/paySuccess';
            }
        });
    }
</script>
</html>
