<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1.0,minimum-scale=1.0,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" href="/css/common.css" type="text/css"/>
		<title>预订会议室| <?php echo $conferenceName;?></title>
		<style>
			body {
				background-color: #FFFFFF;
				max-width:750px;
				min-width:320px;
				margin:0 auto;
			}
			.home {
				width:92%;
				margin:0.8rem auto 0;
			}
			.top {
				position: relative;
			}
			.top img {
				width:100%;
				height: 1.5rem;
				display: block;
			}
			.top p {
				position: absolute;
				left:0;
				top:0;
				width:100%;
				font-size: 0.65rem;
				line-height:1.5rem;
				color:#333333;
				text-indent: 0.5rem;
			}
			.main ul {
				padding-bottom: 0.4rem;
				border-bottom: solid 1px #d7d7d7;
			}
			.main ul li.day {
				padding-bottom: 0.15rem;
				background-color: #ebf0f6;
				margin-bottom: 0.1rem;
			}
			.main ul li.last_day {
				padding-bottom: 0.25rem;
				border-bottom-left-radius: 0.2rem;
				border-bottom-right-radius: 0.2rem;
			}
			.main ul li.day article {
				width:14%;
				float:left;
				padding:0;
				margin:0;
				color:#4bb5c3;
				height:2.1rem;
			}
			.main ul li.day article span {
				font-size: 0.75rem;
				line-height: 1.35rem;
				display: block;
				text-align: center;
				font-weight: bold;
			}
			.main ul li.day article em {
				font-size: 0.6rem;
				line-height: 0.6rem;
				display: block;
				text-align: center;
			}
			.main ul li.day dl {
				width:85%;
				height:1.95rem;
				margin-top:0.075rem;
				float:left;
				background-color: #FFFFFF;
			}
			.main ul li.day dl dd {
				width:31.5%;
				height:1.5rem;
				line-height: 1.5rem;
				float:left;
				text-align: center;
				font-size: 0.65rem;
				margin-top:0.225rem;
				margin-left: 1.375%;
				color:#4bb5c3;
			}
			.main ul li.day dl dd.close {
				background-color: #f4f8fb;
				color:#999999;
			}
			.main ul li.day dl dd.select {
				background-color: #4ab5c2;
				color:#FFFFFF;
			}
			.submit {
				width:40%;
				height:2.2rem;
				line-height: 2.2rem;
				font-size: 0.75rem;
				text-align: center;
				color:#FFFFFF;
				background-color: #4ab5c2;
				margin:0.55rem auto;
				border-radius: 0.2rem;
			}
			/*详细时间*/
			.main ul li.details {
				width:100%;
				height:7.05rem;
				background-color: #ebf0f6;
				margin-bottom: 0.1rem;
				position: relative;
				display:none;
			}
			.main ul li.details section {
				width:86%;
				position:absolute;
				top:0.15rem;
				left:14%;
				display:none;
			}
			.main ul li.details section.select {
				display: block;
			}
			.main ul li.details section dl {
				width:100%;
				background-color: #ebf0f6;
				margin:0;
				padding:0;
			}
			.details section dl dd {
				width:31%;
				height:1.5rem;
				line-height: 1.5rem;
				float:left;
				text-align: center;
				font-size: 0.65rem;
				margin-top:0.2rem;
				margin-left: 1.6%;
				color:#4bb5c3;
				background-color: #FFFFFF;
				border:solid 2px #FFFFFF;
				box-sizing: border-box;
			}
			.details section dl dd.notselect {
				background-color: #f0f4f7;
				color:#999999;
			}
			.details section dl dd.active {
				background-color: #4bb5c3;
				color:#FFFFFF;
			}
		</style>
	</head>
	<body>
		<section class="home">
			<section class="top">
				<img src="/img/conference.jpg" />
				<p>2017年6月</p>
			</section>
			<section class="main">
				<ul>
					<li class="clearfix day" id="day1">
						<article>
							<span>18</span><em>周日</em>
						</article>
						<dl>
							<dd class="am">
								上午
							</dd>
							<dd class="pm">
								下午
							</dd>
							<dd class="night">
								晚上
							</dd>
						</dl>
					</li>
					<li class="clearfix day" id="day2">
						<article>
							<span>18</span><em>周日</em>
						</article>
						<dl>
							<dd class="am">
								上午
							</dd>
							<dd class="pm">
								下午
							</dd>
							<dd class="night">
								晚上
							</dd>
						</dl>
					</li>
					<li class="clearfix day" id="day3">
						<article>
							<span>18</span><em>周日</em>
						</article>
						<dl>
							<dd class="am">
								上午
							</dd>
							<dd class="pm">
								下午
							</dd>
							<dd class="night">
								晚上
							</dd>
						</dl>
					</li>
					<li class="clearfix day" id="day4">
						<article>
							<span>18</span><em>周日</em>
						</article>
						<dl>
							<dd class="am">
								上午
							</dd>
							<dd class="pm">
								下午
							</dd>
							<dd class="night">
								晚上
							</dd>
						</dl>
					</li>
					<li class="clearfix day" id="day5">
						<article>
							<span>18</span><em>周日</em>
						</article>
						<dl>
							<dd class="am">
								上午
							</dd>
							<dd class="pm">
								下午
							</dd>
							<dd class="night">
								晚上
							</dd>
						</dl>
					</li>
					<li class="clearfix day" id="day6">
						<article>
							<span>18</span><em>周日</em>
						</article>
						<dl>
							<dd class="am">
								上午
							</dd>
							<dd class="pm">
								下午
							</dd>
							<dd class="night">
								晚上
							</dd>
						</dl>
					</li>
					<li class="last_day clearfix day" id="day7">
						<article>
							<span>18</span><em>周日</em>
						</article>
						<dl>
							<dd class="am">
								上午
							</dd>
							<dd class="pm">
								下午
							</dd>
							<dd class="night">
								晚上
							</dd>
						</dl>
					</li>
				</ul>
			</section>
			<section class="submit">确定选择</section>
			<section class="clone" style="display:none;">
				<li class="details">
					<section class="morning">
						<dl class="clearfix">
							<dd>08:00-08:30</dd>
							<dd>08:30-09:00</dd>
							<dd>09:00-09:30</dd>
							<dd>09:30-10:00</dd>
							<dd>10:00-10:30</dd>
							<dd>10:30-11:00</dd>
							<dd>11:00-11:30</dd>
							<dd>11:30-12:00</dd>
							<!--<dd>
								12:00-12:30
							</dd>
							<dd>
								12:00-13:30
							</dd>
							<dd>
								12:00-13:30
							</dd>
							<dd>
								12:00-13:30
							</dd>-->
						</dl>
					</section>
					<section class="afternoon select">
						<dl class="clearfix">
							<dd>12:00-12:30</dd>
							<dd>12:30-13:00</dd>
							<dd>13:00-13:30</dd>
							<dd>13:30-14:00</dd>
							<dd>14:00-14:30</dd>
							<dd>14:30-15:00</dd>
							<dd>15:00-15:30</dd>
							<dd>15:30-16:00</dd>
							<dd>16:00-16:30</dd>
							<dd>16:30-17:00</dd>
							<dd>17:00-17:30</dd>
							<dd>17:30-18:00</dd>
						</dl>
					</section>
					<section class="evening">
						<dl class="clearfix">
							<dd>18:00-18:30</dd>
							<dd>18:30-19:00</dd>
							<dd>19:00-19:30</dd>
							<dd>19:30-20:00</dd>
							<dd>20:00-20:30</dd>
							<dd>20:30-21:00</dd>
							<!--<dd>
								12:00-13:30
							</dd>
							<dd>
								12:00-13:30
							</dd>
							<dd>
								12:00-13:30
							</dd>
							<dd>
								12:00-13:30
							</dd>
							<dd>
								12:00-13:30
							</dd>
							<dd>
								12:00-13:30
							</dd>-->
						</dl>
					</section>
				</li>
			</section>
		</section>
		<script type="text/javascript" src="/js/jquery-3.2.1.min.js" ></script>
		<script>
			$(function(){
				//新建事件详情页
				for(i=0;i<$(".main .day").length;i++){
					var oli=$($(".clone .details")[0]).clone(1);
					var j=i+1;
					$(oli).addClass("num"+j);
					$($(".main .day")[i]).after(oli);
				}
				//当前日期
				var today=new Date();
				var today_time=today.getTime();
				var today_year=today.getFullYear();
				var today_month=today.getMonth()+1;
				var today_date=today.getDate();
				var today_day=today.getDay();
				var today_day1;
				//当前年月
				$(".top p").html(today_year+"年"+today_month+"月");
				var allday=30;
				if(today_month==1||today_month==3||today_month==5||today_month==7||today_month==8||today_month==10||today_month==12){
					allday=31;
				}else if(today_month==4||today_month==6||today_month==9||today_month==11){
					allday=30;
				}else if(today_month==2){
					if(today_year%4==0){
						allday=29;
					}
					allday=28;
				}
				for(i=0;i<$(".main .day").length;i++){
					if(today_day==1){
						today_day1="周一";
					}else if(today_day==2){
						today_day1="周二";
					}else if(today_day==3){
						today_day1="周三";
					}else if(today_day==4){
						today_day1="周四";
					}else if(today_day==5){
						today_day1="周五";
					}else if(today_day==6){
						today_day1="周六";
					}else if(today_day==7){
						today_day1="周日";
					}
					if(today_month<10){
						today_month="0"+today_month;
					}
					if(today_date<10){
						today_date="0"+today_date;
					}
					$($(".main .details")[i]).attr("data-date",today_year+"-"+today_month+"-"+today_date);
					$($(".main .day span")[i]).html(today_date);
					$($(".main .day em")[i]).html(today_day1);
					today_time+=86400000;
					today_year=new Date(today_time).getFullYear();
					today_month=new Date(today_time).getMonth()+1;
					today_date=new Date(today_time).getDate();
					today_day=new Date(today_time).getDay();
					if(today_day==0){
						today_day=7;
					}
				}
				
				
				//传入不能点击事件
				// var notselect_arr=["2017-07-08-08:00-08:30","2017-07-07-18:00-18:30","2017-07-07-18:30-19:00","2017-07-07-19:00-19:30","2017-07-07-19:30-20:00","2017-07-07-20:00-20:30","2017-07-07-20:30-21:00"
				// ,"2017-07-09-18:00-18:30","2017-07-09-18:30-19:00","2017-07-09-19:00-19:30","2017-07-09-19:30-20:00","2017-07-09-20:00-20:30","2017-07-09-20:30-21:00"
				// ,"2017-07-10-18:00-18:30","2017-07-10-18:30-19:00","2017-07-10-19:00-19:30","2017-07-10-19:30-20:00","2017-07-10-20:00-20:30","2017-07-10-20:30-21:00"
				// ,"2017-07-10-08:00-08:30","2017-07-10-08:30-09:00","2017-07-10-09:00-09:30","2017-07-10-09:30-10:00","2017-07-10-10:00-10:30","2017-07-10-10:30-11:00","2017-07-10-11:00-11:30","2017-07-10-11:30-12:00",];
				var notselect_arr = <?php echo json_encode($conferenceRentInfos);?>;
				for(j=0;j<notselect_arr.length;j++){
					var notselect_data=notselect_arr[j].substr(0,10);
					var notselect_text=notselect_arr[j].substr(11,15)
					for(m=0;m<$(".main .details").length;m++){
						if(notselect_data==$($(".main .details")[m]).attr("data-date")){
							for(n=0;n<$($(".main .details")[m]).find("dd").length;n++){
								if($($($($(".main .details")[m]).find("dd"))[n]).html()==notselect_text){
									$($($($(".main .details")[m]).find("dd"))[n]).addClass("notselect");
									var opar=$($($($(".main .details")[m]).find("dd"))[n]).parent();
									var star=0;
									for(t=0;t<$($(opar).find("dd")).length;t++){
										if($($($(opar).find("dd"))[t]).hasClass("notselect")){
											star++;
										}
									}
									if(star==$($(opar).find("dd")).length){
										if($($(opar).parent()).hasClass("morning")){
											$($($($(opar).parents(".details")).prev()).find(".am")).addClass("close");
										}else if($($(opar).parent()).hasClass("afternoon")){
											$($($($(opar).parents(".details")).prev()).find(".pm")).addClass("close");
										}else if($($(opar).parent()).hasClass("evening")){
											$($($($(opar).parents(".details")).prev()).find(".night")).addClass("close");
										}
									}
								}
							}
							//判断上午下午晚上是否全被选
						}	
					}		
				}

				
				
				//点击事件
				//点击上午下午伸展出对应时间表
				$(".main ul .day dl dd").click(function(){
					$(".details").css({display:"none"});
					var oid=$($(this).parents("li")[0]).attr("id");
					var type=oid.split("")[3];
					$(".num"+type).css({display:"block"});
					$(".main ul .day dl dd").removeClass("select");
					$(this).addClass("select");
					$(".num"+type).children("section").removeClass("select");
					if($(this).hasClass("am")){
						$($(".num"+type).children("section")[0]).addClass("select");
					}else if($(this).hasClass("pm")){
						$($(".num"+type).children("section")[1]).addClass("select");
					}else if($(this).hasClass("night")){
						$($(".num"+type).children("section")[2]).addClass("select");
					}
					if($(this).hasClass("close")){
						$(this).removeClass("select");
					}
				})
				//点击时间选中
				$(".details dd").click(function(){
					if($(this).hasClass("notselect")){
						return;
					}
					if($(this).hasClass("active")){
						$(this).removeClass("active");
					}else{
						$(this).addClass("active");
					}
				})
				
				//点击提交
				var arr=[];
				$(".submit").click(function(){
					for(j=0;j<$(".active").length;j++){
						var time=$($(".active")[j]).text();
						var time1=$($(".active")[j]).parents(".details").attr("data-date");
						var dat=time1+"-"+time;
						arr.push(dat);
					}
					if(arr.length==0){
						alert("提交内容不能为空！");
						return;
					}else{
						json = JSON.stringify(arr);
						var conferenceName = <?php echo '"'.$conferenceName.'"';?>;
						var data = {
							conferenceName:conferenceName,
							arr:json,
						};
						console.log(arr);
						$.ajax({
							url:'/seats/rentConference',
							type:'POST',
							dataType:'json',
							data:data,
							success:function(response){
								if (response.status == 1) {
								 	window.location.href = '/orders/paySuccess/' + response.tradeId;
								} else {
									alert(response.msg);
									// response.is_conference = true;
									// var mapForm = document.createElement("form");
								 //    mapForm.method = "POST"; // or "post" if appropriate
								 //    mapForm.action = "/seats/rentSeats";
								 //    var mapInput = document.createElement("input");
								 //    mapInput.type = "hidden";
								 //    mapInput.name = "seatInfo";
								 //    mapInput.value = JSON.stringify(response);
								 //    mapForm.appendChild(mapInput);
								 //    document.body.appendChild(mapForm);
								 //    mapForm.submit();
								}
							}
						})
					}
				})
				
				
			})
		</script>
	</body>
</html>
