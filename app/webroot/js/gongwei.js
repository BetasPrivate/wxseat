// JavaScript Document
$(document).ready(function(e) {
	//前台图片高度与左边一致
	$(function(){
	var ohei=$(".homeMain article .huiyishi img").height();
	var hei=$(".homeMain article .jifang img").height();
	var sum=ohei+hei;
	$(".home_right_left img").height(sum);
	var m=$(".right .dayinshi").height();
	var n=$(".homeMain article .threeOne").height();
	$(".right .dayinshi").height(n);
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
		if($(this).hasClass("warning")){
			$(".layer h3 span").removeClass("kongxian");
			$(".layer h3 span").addClass("zhanyong");
			$(".layer h3 i").text("占用");
			$(".layer h5 p").css({opacity:1});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			$(".layer h2 i").text(this.index);
		}else if($(this).hasClass("active")){
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			var owidth=$(this).width();
			owidth=owidth+4;
			$(this).width(owidth);
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			var owidth=$(this).width();
			owidth=owidth-4;
			$(this).width(owidth);
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			var green_array=[];
			for(var j=0;j<olen;j++){
				if($(oimg[j]).hasClass("active")){
					var onew=oimg[j].index;
					green_array.push(onew);
					}
				}
			$(".layer h2 i").text(green_array);
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
		if($(this).hasClass("warning")){
			$(".layer h3 span").removeClass("kongxian");
			$(".layer h3 span").addClass("zhanyong");
			$(".layer h3 i").text("占用");
			$(".layer h5 p").css({opacity:1});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			$(".layer h2 i").text(this.index);
		}else if($(this).hasClass("active")){
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			var owidth=$(this).width();
			owidth=owidth+4;
			$(this).width(owidth);
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			var owidth=$(this).width();
			owidth=owidth-4;
			$(this).width(owidth);
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			var green_array=[];
			for(var j=0;j<olen;j++){
				if($(oimg[j]).hasClass("active")){
					var onew=oimg[j].index;
					green_array.push(onew);
					}
				}
			$(".layer h2 i").text(green_array);
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
		if($(this).hasClass("warning")){
			$(".layer h3 span").removeClass("kongxian");
			$(".layer h3 span").addClass("zhanyong");
			$(".layer h3 i").text("占用");
			$(".layer h5 p").css({opacity:1});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			$(".layer h2 i").text(this.index);
		}else if($(this).hasClass("active")){
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			var owidth=$(this).width();
			owidth=owidth+4;
			$(this).width(owidth);
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			var owidth=$(this).width();
			owidth=owidth-4;
			$(this).width(owidth);
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			var green_array=[];
			for(var j=0;j<olen;j++){
				if($(oimg[j]).hasClass("active")){
					var onew=oimg[j].index;
					green_array.push(onew);
					}
				}
			$(".layer h2 i").text(green_array);
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
		if($(this).hasClass("warning")){
			$(".layer h3 span").removeClass("kongxian");
			$(".layer h3 span").addClass("zhanyong");
			$(".layer h3 i").text("占用");
			$(".layer h5 p").css({opacity:1});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			$(".layer h2 i").text(this.index);
		}else if($(this).hasClass("active")){
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			var owidth=$(this).width();
			owidth=owidth+4;
			$(this).width(owidth);
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			var owidth=$(this).width();
			owidth=owidth-4;
			$(this).width(owidth);
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			var green_array=[];
			for(var j=0;j<olen;j++){
				if($(oimg[j]).hasClass("active")){
					var onew=oimg[j].index;
					green_array.push(onew);
					}
				}
			$(".layer h2 i").text(green_array);
		}
		}
		});
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
			if(n%2==1){
				oimg1.style.cssFloat="right";
				}
			}
		}
	$(".home_right_right img").click(function(){
		$(".layer h2 span").text("开放工位");
		$(".layer h3 i").text("");
		if($(this).hasClass("warning")){
			$(".layer h3 span").removeClass("kongxian");
			$(".layer h3 span").addClass("zhanyong");
			$(".layer h3 i").text("占用");
			$(".layer h5 p").css({opacity:1});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			$(".layer h2 i").text(this.index);
		}else if($(this).hasClass("active")){
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			var m=$(this).width();
			m=m+4;
			var n=$(this).height();
			n=n+4;
			$(this).width(m);
			$(this).height(n);
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			var m=$(this).width();
			m=m-4;
			var n=$(this).height();
			n=n-4;
			$(this).width(m);
			$(this).height(n);
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			var green_array=[];
			for(var j=0;j<olen;j++){
				if($(oimg[j]).hasClass("active")){
					var onew=oimg[j].index;
					green_array.push(onew);
					}
				}
			$(".layer h2 i").text(green_array);
			}
		});	
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
		if($(this).hasClass("warning")){
			$(".layer h3 span").removeClass("kongxian");
			$(".layer h3 span").addClass("zhanyong");
			$(".layer h3 i").text("占用");
			$(".layer h5 p").css({opacity:1});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			$(".layer h2 i").text(this.index);
		}else if($(this).hasClass("active")){
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			var m=$(this).width();
			m=m+4;
			var n=$(this).height();
			n=n+4;
			$(this).width(m);
			$(this).height(n);
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			var m=$(this).width();
			m=m-4;
			var n=$(this).height();
			n=n-4;
			$(this).width(m);
			$(this).height(n);
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			var green_array=[];
			for(var j=0;j<olen;j++){
				if($(oimg[j]).hasClass("active")){
					var onew=oimg[j].index;
					green_array.push(onew);
					}
				}
			$(".layer h2 i").text(green_array);
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
		if($(this).hasClass("warning")){
			$(".layer h3 span").removeClass("kongxian");
			$(".layer h3 span").addClass("zhanyong");
			$(".layer h3 i").text("占用");
			$(".layer h5 p").css({opacity:1});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			$(".layer h2 i").text(this.index);
		}else if($(this).hasClass("active")){
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			var owidth=$(this).width();
			owidth=owidth+4;
			$(this).width(owidth);
			$(this).removeClass("active");
		}else{
			$(this).addClass("active");
			var owidth=$(this).width();
			owidth=owidth-4;
			$(this).width(owidth);
			$(".layer h3 span").removeClass("zhanyong");
			$(".layer h3 span").addClass("kongxian");
			$(".layer h3 i").text("空闲");
			$(".layer h5 p").css({opacity:0});
			$(".zhezhaoceng").css({display:"block"});
			$(".layer").animate({bottom:0},300);
			var green_array=[];
			for(var j=0;j<olen;j++){
				if($(oimg[j]).hasClass("active")){
					var onew=oimg[j].index;
					green_array.push(onew);
					}
				}
			$(".layer h2 i").text(green_array);
			}
		});
	//点击遮罩层关闭
	$("#reset").click(function(){
		$(".zhezhaoceng").css({display:"none"});
		$(".layer").css({bottom:-400});
		});
	$(".zhezhaoceng").click(function(){
		$(this).css({display:"none"});
		$(".layer").css({bottom:-400});
		});
	//给当前已租用的座位加红框
	var oimg=$("img");
	var olen=oimg.length;
	for (var i = 0; i< olen; i++){
		var b=oimg[i].index;
		for (var j= 0; j < seats.length; j++) {
			if (seats[j].Seat.status == 1 && seats[j].Seat.real_id == b) {
				var ohei=$(oimg[i]).width();
				ohei=ohei-4;
				$(oimg[i]).width(ohei);
				$(oimg[i]).addClass("warning");
			}
		}
	}
	// var a=["s2","1","v2","54","86","100"];
	// var oimg=$("img");
	// var olen=oimg.length;
	// for(var i=0;i<olen;i++){
	// 	var b=oimg[i].index;
	// 	if(oimg[i].index==a[0]){
	// 		var ohei=$(oimg[i]).width();
	// 		ohei=ohei-4;
	// 		$(oimg[i]).width(ohei);
	// 		$(oimg[i]).addClass("warning");
	// 	}else if(oimg[i].index==a[1]){
	// 		var ohei=$(oimg[i]).width();
	// 		ohei=ohei-4;
	// 		$(oimg[i]).width(ohei);
	// 		$(oimg[i]).addClass("warning");
	// 	}else if(oimg[i].index==a[2]){
	// 		var ohei=$(oimg[i]).width();
	// 		ohei=ohei-4;
	// 		$(oimg[i]).width(ohei);
	// 		$(oimg[i]).addClass("warning");
	// 	}else if(oimg[i].index==a[3]){
	// 		var ohei=$(oimg[i]).width();
	// 		ohei=ohei-4;
	// 		$(oimg[i]).width(ohei);
	// 		$(oimg[i]).addClass("warning");
	// 	}else if(oimg[i].index==a[4]){
	// 		var ohei=$(oimg[i]).width();
	// 		ohei=ohei-4;
	// 		$(oimg[i]).width(ohei);
	// 		$(oimg[i]).addClass("warning");
	// 	}else if(oimg[i].index==a[5]){
	// 		var ohei=$(oimg[i]).width();
	// 		ohei=ohei-4;
	// 		$(oimg[i]).width(ohei);
	// 		$(oimg[i]).addClass("warning");
	// 	}
	// 	}
//tips添加弹出层起止年月日
    var h=2017,i=1,j=1;
	for (var m=0;m<5;m++){
		var option=document.createElement("option");
		var option_1=document.createElement("option");
		option.innerHTML=h;
		option_1.innerHTML=h;
		h++;
		$(".startnian").append(option);
		$(".endnian").append(option_1);
	}
	for (var m=0;m<12;m++){
		var option=document.createElement("option");
		var option_1=document.createElement("option");
		option.innerHTML=i;
		option_1.innerHTML=i;
		i++;
		$(".startyue").append(option);
		$(".endyue").append(option_1);
	}
	for (var m=0;m<31;m++){
		var option=document.createElement("option");
		var option_1=document.createElement("option");
		option.innerHTML=j;
		option_1.innerHTML=j;
		j++;
		$(".startri").append(option);
		$(".endri").append(option_1);
	}
	//默认选择第一种方式确认终止时间
	//点击年月周日终止日期改变
	$(".nianzu").click(function(){
		var nian=$(".startnian").val();
		var yue=$(".startyue").val();
		var ri=$(".startri").val();
		nian++;
		$(".nian").text(nian);
		$(".yue").text(yue);
		$(".ri").text(ri);
		});
	$(".yuezu").click(function(){
		var nian=$(".startnian").val();
		var yue=$(".startyue").val();
		var ri=$(".startri").val();
		yue++;
		if(yue=="13"){
			nian++;
			yue=1;
			}
		$(".nian").text(nian);
		$(".yue").text(yue);
		$(".ri").text(ri);
		});
	$(".zhouzu").click(function(){
		var nian=$(".startnian").val();
		var yue=$(".startyue").val();
		var ri=Number($(".startri").val());
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
		$(".nian").text(nian);
		$(".yue").text(yue);
		$(".ri").text(ri);
		});
	$(".rizu").click(function(){
		var nian=$(".startnian").val();
		var yue=$(".startyue").val();
		var ri=$(".startri").val();
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
		$(".nian").text(nian);
		$(".yue").text(yue);
		$(".ri").text(ri);
		});
	//定义一个默认第一种方式变量
	var fangshi="one";
	//点击自定义终止日期表单出现选择,第二种方式确认终止时间	
	$(".zidingyi").click(function(){
		$(".stop_timer_one").css({display:"none"});
		$(".stop_timer_two").css({display:"block"});
		$(".zuqi").css({display:"none"});
		$(".zidingyi").css({display:"none"});
		fangshi="two";//选择方式二
		});
	//声明一个对象装有工位号，起止日期
	var json={};
	//自定义终止日期
	$(".queding").click(function(){
		//获取当前被选中的座位号
		var green_array=[];
		for(var j=0;j<olen;j++){
			if($(oimg[j]).hasClass("active")){
				var onew=oimg[j].index;
				green_array.push(onew);
				}
			}
		var zuoweihao=green_array;
		json["seatIds"]=zuoweihao;
		//点击年月周日单选框方式获取起始时间，终止时间
		var startdate,stopdate;
		if(fangshi=="one"){
			//获取起始时间
			var startnian=$(".startnian").val();
			var startyue=$(".startyue").val();
			var startri=$(".startri").val();
			startdate=startnian+"-"+startyue+"-"+startri;
			//获取终止时间
			var stopnian=$(".nian").text();
			var stopyue=$(".yue").text();
			var stopri=$(".ri").text();
			stopdate=stopnian+"-"+stopyue+"-"+stopri;
		json["startDate"]=startdate;
		json["endDate"]=stopdate;
		}else if(fangshi=="two"){
			//获取起始时间
			var startnian=$(".startnian").val();
			var startyue=$(".startyue").val();
			var startri=$(".startri").val();
			startdate="起始时间:"+startnian+"-"+startyue+"-"+startri;
			//获取终止时间
			var stopnian=$(".endnian").val();
			var stopyue=$(".endyue").val();
			var stopri=$(".endri").val();
			var stopdate="终止时间:"+stopnian+"-"+stopyue+"-"+stopri;
			json["startDate"]=startdate;
			json["endDate"]=stopdate;
			}
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
	            	console.log(response);
	            	if (response.status != 1) {
	            		$(".layer h5 p").css({opacity:1});
	            		document.getElementById('warningMsg').innerHTML = response.msg;
	            	} else {
	            		//post 方法打开 /seats/rentSeats
	            		var mapForm = document.createElement("form");
					    mapForm.method = "POST"; // or "post" if appropriate
					    mapForm.action = "/seats/rentSeats";
					    var mapInput = document.createElement("input");
					    mapInput.type = "text";
					    mapInput.name = "seatInfo";
					    mapInput.value = JSON.stringify(response);
					    mapForm.appendChild(mapInput);
					    document.body.appendChild(mapForm);
					    mapForm.submit();
						$(".zhezhaoceng").css({display:"none"});
						$(".layer").css({bottom:-400});
	            	}
	            },
	            error:function (data) {
	            	console.log(data);
	            }
	        });
			}		
		});
});




































