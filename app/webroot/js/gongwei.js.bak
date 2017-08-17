// JavaScript Document
window.onload=function(){
	//前台图片高度与左边一致
	$(function(){
	var ohei=$(".homeMain article .huiyishi img").height();
	var hei=$(".homeMain article .jifang img").height();
	var sum=ohei+hei;
	$(".home_right_left img").height(sum);
	var m=$(".right .dayinshi").height();
	var n=$(".homeMain article .threeOne").height();
	});	
	//上方添加图片及效果
	var a,b,c=1,d=9,e,f;
	for(var m=0;m<3;m++){
		switch(m){
			case 0:a=93;break;
			case 1:a=92;break;
			case 2:a=91;break;
			}
		for(var n=0;n<24;n++){
			var oimg1=document.createElement("img");
			oimg1.src="/img/one_seat.jpg";
			oimg1.alt="开放工位";
			oimg1.index=a;
			a+=3;
			$(".homeTop").append(oimg1);
			}
		}
	$(".homeTop img").click(function(){
		$(".layer h2 span").text("开放工位");
		$(".layer h3 i").text("");
		if($(this).hasClass("waring")){
			$(".layer h2 i").text(this.index);
			var seat = getSeatFromSeats(this.index);
			console.log(this.index);
			if (seat.length != 0) {
				$('#invalidate_seat_end_time').text(seat.Seat.free_time);
			}
			cover();
		}else if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(this).attr("src","/img/one_seat.jpg");
			seatnum();
		}else{
			$(this).addClass("active");
			$(this).attr("src","/img/checked.jpg");
			add();
			seatnum();
			}
		});
	//中左添加座位及点击效果
	for(var i=0;i<15;i++){
		switch(i){
			case 0:b=88;break;
			case 1:b=86;break;
			case 2:b=84;break;
			case 3:b=82;break;
			case 4:b=80;break;
			case 5:b=78;break;
			case 6:b=76;break;
			case 7:b=74;break;
			case 8:b=72;break;
			case 9:b=70;break;
			case 10:b=68;break;
			case 11:b=66;break;
			case 12:b=64;break;
			case 13:b=62;break;
			case 14:b=60;break;
			}
		for(var n=0;n<2;n++){
			var oimg1=document.createElement("img");
			oimg1.src="/img/one_seat.jpg";
			oimg1.alt="开放工位";
			oimg1.index=b;
			b-=1;
			$(".homeMain aside.left").append(oimg1);
			}
		}
	$(".homeMain aside.left img").click(function(){
		$(".layer h2 span").text("开放空间");
		$(".layer h3 i").text("");
		if($(this).hasClass("waring")){
			$(".layer h2 i").text(this.index);
			var seat = getSeatFromSeats(this.index);
			console.log(this.index);
			if (seat.length != 0) {
				$('#invalidate_seat_end_time').text(seat.Seat.free_time);
			}
			cover();
		}else if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(this).attr("src","/img/one_seat.jpg");
			seatnum();
		}else{
			$(this).addClass("active");
			$(this).attr("src","/img/checked.jpg");
			add();
			seatnum();
			}
		});
	//中上三人间添加及点击效果
	for(var p=0;p<8;p++){
		var oimg2=document.createElement("img");
		oimg2.src="/img/three.jpg";
		oimg2.alt="三人间";
		oimg2.index="v"+c;
		c++;
		$(".homeMain article .threeOne").append(oimg2);
		}
	$(".homeMain article .threeOne img").click(function(){
		$(".layer h2 span").text("三人间");
		$(".layer h3 i").text("");
		if($(this).hasClass("waring")){
			$(".layer h2 i").text(this.index);
			var seat = getSeatFromSeats(this.index);
			console.log(this.index);
			if (seat.length != 0) {
				$('#invalidate_seat_end_time').text(seat.Seat.free_time);
			}
			cover();
		}else if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(this).attr("src","/img/three.jpg");
			seatnum();
		}else{
			$(this).addClass("active");
			$(this).attr("src","/img/three_checked.jpg");
			add();
			seatnum();
			}
		});
	//中下三人间添加及点击效果
	for(var p=0;p<6;p++){
		var oimg2=document.createElement("img");
		oimg2.src="/img/three.jpg";
		oimg2.alt="三人间";
		oimg2.index="v"+d;
		d++;
		$(".homeMain article .threeTwo").append(oimg2);
		}
	$(".homeMain article .threeTwo img").click(function(){
		if(this.index){
		$(".layer h2 span").text("三人间");
		$(".layer h3 i").text("");
		if($(this).hasClass("waring")){
			$(".layer h2 i").text(this.index);
			var seat = getSeatFromSeats(this.index);
			console.log(this.index);
			if (seat.length != 0) {
				$('#invalidate_seat_end_time').text(seat.Seat.free_time);
			}
			cover();
		}else if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(this).attr("src","/img/three.jpg");
			seatnum();
		}else{
			$(this).addClass("active");
			$(this).attr("src","/img/three_checked.jpg");
			add();
			seatnum();
		}
		}
		});
	//中右改动开始
	//中右添加工位及点击效果
	for (var q=0;q<11;q++){
		switch(q){
			case 0:e=1;break;
			case 1:e=3;break;
			case 2:e=5;break;
			case 3:e=7;break;
			case 4:e=9;break;
			case 5:e=11;break;
			case 6:e=13;break;
			case 7:e=15;break;
			case 8:e=17;break;
			case 9:e=19;break;
			case 10:e=21;break;
			}
		for(var n=0;n<2;n++){
			var oimg1=document.createElement("img");
			oimg1.src="/img/one_seat.jpg";
			oimg1.alt="开放工位";
			oimg1.index=e;
			e+=1;
			$(".home_right_right").append(oimg1);
			}
		}
	$(".home_right_right img").click(function(){
		$(".layer h2 span").text("开放工位");
		$(".layer h3 i").text("");
		if($(this).hasClass("waring")){
			$(".layer h2 i").text(this.index);
			var seat = getSeatFromSeats(this.index);
			console.log(this.index);
			if (seat.length != 0) {
				$('#invalidate_seat_end_time').text(seat.Seat.free_time);
			}
			cover();
		}else if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(this).attr("src","/img/one_seat.jpg");
			seatnum();
		}else{
			$(this).attr("src","/img/checked.jpg");
			$(this).addClass("active");
			add();
			seatnum();
			}
		});	
	//中右改动结束
	//下左开放工位添加及点击效果
	for (var q=0;q<3;q++){
		switch(q){
			case 0:f=56;break;
			case 1:f=57;break;
			case 2:f=58;break;
			}
		for(var n=0;n<4;n++){
			var oimg1=document.createElement("img");
			oimg1.src="/img/one_seat.jpg";
			oimg1.alt="开放工位";
			oimg1.index=f;
			f-=3;
			$(".homeBottom h2").append(oimg1);
			}
		}
	$(".homeBottom h2 img").click(function(){
		$(".layer h2 span").text("开放工位");
		$(".layer h3 i").text("");
		if($(this).hasClass("waring")){
			$(".layer h2 i").text(this.index);
			var seat = getSeatFromSeats(this.index);
			console.log(this.index);
			if (seat.length != 0) {
				$('#invalidate_seat_end_time').text(seat.Seat.free_time);
			}
			cover();
		}else if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(this).attr("src","/img/one_seat.jpg");
			seatnum();
		}else{
			$(this).addClass("active");
			$(this).attr("src","/img/checked.jpg");
			add();
			seatnum();
			}
		});
	//下右添加三张图片点击效果
	for(var i=0;i<3;i++){
			var m=i+1;
			$(".homeBottom h3 img")[i].index="s"+m;
			}
	$(".homeBottom h3 img").click(function(){
		if(this.index=="s1"){
			$(".layer h2 span").text("六人间");
			}
		if(this.index=="s2"){
			$(".layer h2 span").text("五人间");
			}
		if(this.index=="s3"){
			$(".layer h2 span").text("八人间");
			}
		$(".layer h3 i").text("");
		if($(this).hasClass("waring")){
			$(".layer h2 i").text(this.index);
			var seat = getSeatFromSeats(this.index);
			console.log(this.index);
			if (seat.length != 0) {
				$('#invalidate_seat_end_time').text(seat.Seat.free_time);
			}
			cover();
		}else if($(this).hasClass("active")){
			$(this).removeClass("active");
			if(this.index=="s1"){
				$(this).attr("src","/img/top_six.jpg");
			}else if(this.index=="s2"){
				$(this).attr("src","/img/top_five.jpg");
			}else if(this.index=="s3"){
				$(this).attr("src","/img/top_eight.jpg");
			}
			seatnum();
		}else{
			$(this).addClass("active");
			if(this.index=="s1"){
				$(this).attr("src","/img/six_checked.jpg");
			}else if(this.index=="s2"){
				$(this).attr("src","/img/five_checked.jpg");
			}else if(this.index=="s3"){
				$(this).attr("src","/img/eight_checked.jpg");
			}
			add();
			seatnum();
			}
		});
	//点击遮罩层关闭
	$(".continue").click(function(){
		$(".zhezhaoceng").css({display:"none"});
		$(".layer").css({bottom:-1000});
		});
	$(".zhezhaoceng").click(function(){
		$(this).css({display:"none"});
		$(".layer").css({bottom:-1000});
		});
	//给当前已租用的座位加红框 6.17改动
	var oimg=$("img");
	var olen=oimg.length;
	for (var i = 0; i< olen; i++){
		var b=oimg[i].index;
		for (var j= 0; j < seats.length; j++) {
			if (seats[j].Seat.status == 1 && seats[j].Seat.real_id == b) {
				counts(i);
			}
		}
	}
	function counts(m){
		var count=oimg[i].index;
		$(oimg[m]).addClass("waring");
		if(count<23||count>46&&count<89||count>90&&count<163){
			oimg[m].src="/img/checkout.jpg";
		}else if(count<'v15'&&count>='v10'||count<='v9'&&count>'v0'){
			oimg[m].src="/img/three_checkout.jpg";
		}else if(count=='s1'){
			oimg[m].src="/img/six_checkout.jpg";
		}else if(count=="s2"){
			oimg[m].src="/img/five_checkout.jpg";
		}else if(count=="s3"){
			oimg[m].src="/img/eight_checkout.jpg";
		}
	}

	function getSeatFromSeats(seatRealId) {
		for (var i in seats) {
			var seat = seats[i];
			if (seat.Seat.real_id == seatRealId) {
				return seat;
			}
		}

		return [];
	}
//6.15选择座位时工位号改变函数
	function seatnum(){
		var green_array=[];
		for(var j=0;j<olen;j++){
			if($(oimg[j]).hasClass("active")){
				var onew=oimg[j].index;
				green_array.push(onew);
				}
		}
		$(".layer h2 i").text(green_array.join(" "));
		if(green_array.length==0){
			$(".layer").css({bottom:-1000});
		}
	}
//占用位弹出层函数
	function cover(){
		$(".layer h3 span").removeClass("kongxian");
		$(".layer h3 span").addClass("zhanyong");
		$(".layer h3 i").text("占用");
		$(".layer h5 p").css({display:"block"});
		$(".layer h4").css({display:"none"});
		$(".starttime").css({display:"none"});
		$(".zhezhaoceng").css({display:"block"});
		$(".layer .stop_timer_one").css({display:"block"});
		$(".layer .stop_timer_two").css({display:"none"});
		$(".layer h6.zhantips").css({display:"block"});
		$(".layer h6.ketips").css({display:"none"});
		$(".layer").animate({bottom:0},300);
		
	}
//可选弹出层函数
	function add(){
		$(".layer h3 span").removeClass("zhanyong");
		$(".layer h3 span").addClass("kongxian");
		$(".layer h3 i").text("空闲");
		$(".layer h5 p").css({display:"none"});
		$(".layer h4").css({display:"block"});
		$(".starttime").css({display:"block"});
		$(".zhezhaoceng").css({display:"block"});
		$(".layer .stop_timer_one").css({display:"none"});
		$(".layer .stop_timer_two").css({display:"block"});
		$(".layer h6.zhantips").css({display:"none"});
		$(".layer h6.ketips").css({display:"block"});
		$(".layer").animate({bottom:0},300);	
		//年租默认执行一次
		(function(){
			var nian=$(".startnian").html();
			var yue=$(".startyue").html();
			var ri=$(".startri").html();
			nian++;
			$(".endnian").val(nian);
			$(".endyue").val(yue);
			$(".endri").val(ri);
		})();
	}
}	
$(document).ready(function(e) {	
//tips添加弹出层起止年月日
	var nowtime=new Date();
	$(".startnian").html(nowtime.getFullYear());
	$(".startyue").html(nowtime.getMonth()+1);
	$(".startri").html(nowtime.getDate());
	var beginnian=nowtime.getFullYear();
    var h=beginnian,i=1,j=1;
	for (var m=0;m<5;m++){
		var option=document.createElement("option");
		option.innerHTML=h;
		h++;
		$(".endnian").append(option);
	}
	for (var m=0;m<12;m++){
		var option=document.createElement("option");
		option.innerHTML=i;
		i++;
		$(".endyue").append(option);
	}
	for (var m=0;m<31;m++){
		var option=document.createElement("option");
		option.innerHTML=j;
		j++;
		$(".endri").append(option);
	}
	//默认选择第一种方式确认终止时间
	//点击年月周日终止日期改变
	$(".nianzu").click(function(){
		$(".layer h4 i").removeClass("active");
		$(this).addClass("active");
		var nian=Number($(".startnian").html());
		var yue=Number($(".startyue").html());
		var ri=Number($(".startri").html());
		nian++;
		$(".endnian").val(nian);
		$(".endyue").val(yue);
		$(".endri").val(ri);
		});
	$(".yuezu").click(function(){
		$(".layer h4 i").removeClass("active");
		$(this).addClass("active");
		var nian=Number($(".startnian").html());
		var yue=Number($(".startyue").html());
		var ri=Number($(".startri").html());
		yue++;
		if(yue=="13"){
			nian++;
			yue=1;
			}
		$(".endnian").val(nian);
		$(".endyue").val(yue);
		$(".endri").val(ri);
		});
	$(".zhouzu").click(function(){
		$(".layer h4 i").removeClass("active");
		$(this).addClass("active");
		var nian=Number($(".startnian").html());
		var yue=Number($(".startyue").html());
		var ri=Number($(".startri").html());
		ri=ri+7;
		if(yue=='1'||yue=='3'||yue=='5'||yue=='7'||yue=='8'||yue=='10'||yue=='12'){
			if(ri>31){
				yue++;
				ri=ri-31;
				if(yue=="13"){
					nian++;
					yue=1;
					}
				}
			}
		if(yue=='4'||yue=='6'||yue=='9'||yue=='11'){
			if(ri>30){
				yue++;
				ri=ri-30;
				if(yue=="13"){
					nian++;
					yue=1;
					}
				}
			}
		if(yue=='2'){
			if(nian%4==0){
				if(ri>29){
				yue++;
				ri=ri-29;
				if(yue=="13"){
					nian++;
					yue=1;
					}
				}
				}
			if(nian%4!=0){
				if(ri>28){
				yue++;
				ri=ri-28;
				if(yue=="13"){
					nian++;
					yue=1;
					}
				}
				}
			}
		$(".endnian").val(nian);
		$(".endyue").val(yue);
		$(".endri").val(ri);
		});
	$(".rizu").click(function(){
		$(".layer h4 i").removeClass("active");
		$(this).addClass("active");
		var nian=Number($(".startnian").html());
		var yue=Number($(".startyue").html());
		var ri=Number($(".startri").html());
		ri++;
		if(yue=='1'||yue=='3'||yue=='5'||yue=='7'||yue=='8'||yue=='10'||yue=='12'){
			if(ri>31){
				yue++;
				ri=ri-31;
				if(yue=="13"){
					nian++;
					yue=1;
					}
				}
			}
		if(yue=='4'||yue=='6'||yue=='9'||yue=='11'){
			if(ri>30){
				yue++;
				ri=ri-30;
				if(yue=="13"){
					nian++;
					yue=1;
					}
				}
			}
		if(yue=='2'){
			if(nian%4==0){
				if(ri>29){
				yue++;
				ri=ri-29;
				if(yue=="13"){
					nian++;
					yue=1;
					}
				}
				}
			if(nian%4!=0){
				if(ri>28){
				yue++;
				ri=ri-28;
				if(yue=="13"){
					nian++;
					yue=1;
					}
				}
				}
			}
		$(".endnian").val(nian);
		$(".endyue").val(yue);
		$(".endri").val(ri);
	});
	//点击自定义终止日期表单出现选择,第二种方式确认终止时间	
	$(".custom").click(function(){
		$(".layer h4 i").removeClass("active");
		$(this).addClass("active");
	});
	$(".stop_timer_two").on("click",function(){
		$(".layer h4 i").removeClass("active");
		$(".custom").addClass("active");
	})
	//声明一个对象装有工位号，起止日期
	var json={};
	//自定义终止日期
	$(".queding").click(function(){
		//获取当前被选中的座位号
		var green_array=[];
		var oimg=$("img");
		for(var j=0;j<oimg.length;j++){
			if($(oimg[j]).hasClass("active")){
				var onew=oimg[j].index;
				green_array.push(onew);
				}
			}
		var zuoweihao=green_array;
		json["seatIds"]=zuoweihao;
		//点击年月周日单选框方式获取起始时间，终止时间
		var startdate,stopdate;
			//获取起始时间
			var startnian=$(".startnian").html();
			var startyue=$(".startyue").html();
			var startri=$(".startri").html();
			startdate=startnian+"-"+startyue+"-"+startri;
			//获取终止时间
			var stopnian=$(".endnian").val();
			var stopyue=$(".endyue").val();
			var stopri=$(".endri").val();
			var stopdate=stopnian+"-"+stopyue+"-"+stopri;
			json["startDate"]=startdate;
			json["endDate"]=stopdate;
		//判断2月29日，某些月的31日
		if(startyue==2||stopyue==2){
			if(startnian%4==0){
				if(startri>=30||stopri>=30){
					alert("您输入的日期有误，请重新输入");
					}
				}else{
					if(startri>=29||stopri>=29){
					alert("您输入的日期有误，请重新输入");
					}
					else {
						panduantimer();
						}
					}
		}else if(startyue=='4'||startyue=='6'||startyue=='9'||startyue=='11'){
			if(startri==31||stopri==31){
				alert("您输入的日期有误，请重新输入");
			}else{
				panduantimer();
				}
		}else {
			panduantimer();
			}
		function  panduantimer(){
			//判断终止时间大于起始时间
			startnian=Number(startnian);//改动开始
			stopnian=Number(stopnian);
			startyue=Number(startyue);
			stopyue=Number(stopyue);
			startri=Number(startri);
			stopri=Number(stopri);//改动结束
			if(startnian>stopnian){
				alert("您输入的日期有误，请重新输入");
			}else if(startnian==stopnian){
				if(startyue>stopyue){
					alert("您输入的日期有误，请重新输入");
				}else if(startyue==stopyue){
					if(startri>stopri){
						alert("您输入的日期有误，请重新输入");
					}else if(startri==stopri){
						alert("您输入的日期有误，请重新输入");
					}else {
						chuanshu();
						}
				}else{
					chuanshu();
					}
			}else{
				chuanshu();
			}
			}
		
		function chuanshu(){
			console.log(json);
			$.ajax({
	            url:'/seats/checkSeatsAvailable',
	            type: 'POST',
	            dataType:"json",
	            data:{json},
	            success:function (response) {
	            	if (response.status != 1) {
	            		$(".layer h5 p").css({opacity:1});
	            		document.getElementById('warningMsg').innerHTML = response.msg;
	            	} else {
	            		//post 方法打开 /seats/rentSeats
	            		var mapForm = document.createElement("form");
					    mapForm.method = "POST"; // or "post" if appropriate
					    mapForm.action = "/seats/rentSeats";
					    var mapInput = document.createElement("input");
					    mapInput.type = "hidden";
					    mapInput.name = "seatInfo";
					    mapInput.value = JSON.stringify(response);
					    mapForm.appendChild(mapInput);
					    document.body.appendChild(mapForm);
					    mapForm.submit();
						$(".zhezhaoceng").css({display:"none"});
						$(".layer").css({bottom:-1000});
	            	}
	            },
	            error:function (data) {
	            	console.log(data);
	            }
	        });
		}		
		});
})