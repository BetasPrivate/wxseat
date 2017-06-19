<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=yes,maximum-scale=3.0,minimum-scale=1.0,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<title>工位租赁</title>
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<link rel="stylesheet" href="/css/gongwei.css?ss21s" type="text/css"/>
</head>

<body>
<section class="mobile">
    <section class="home">
    	<section class="homeTop"></section>
        <section class="homeMain clearfix">
        	<aside class="left"></aside>
            <article>
            	<div class="three threeOne"><i></i></div>
            	<div class="huiyishi">
                	<img src="/img/工位图2-拷贝_28.jpg" alt="会议室"/>
                </div>
                <div class="three threeTwo">
					<i></i>
                    <div class="jifang">
                        <img src="/img/工位图2-拷贝_33.jpg" alt="机房" style="opacity:0;"/>
                    </div>
                </div>
            </article>
            <aside class="right" style="width:25.1%;float:right;margin-right:2%;">
            	<img class="dayinshi" src="/img/xiuxishi.jpg"/>
                <div class="home_right_left" style="">
                	<img class="qiantai" src="/img/工位图2-拷贝_30.jpg" alt="前台" style=""/>
                </div>
                <div class="home_right_right"></div>
            </aside>
        </section>
        <section class="homeBottom clearfix">
        	<h2></h2>
            <h3>
            	<img src="/img/工位图2-拷贝_40.jpg" alt="六人间" style="width:13.5%;float:right; margin-right:2.5%;"/>
            	<img src="/img/工位图2-拷贝_38.jpg" alt="五人间" style="width:13.5%;float:right;margin-right:0.7%;"/>
            	<img src="/img/工位图2-拷贝_36.jpg" alt="八人间" style="width:17.36%;float:right;margin-right:0.7%;"/>  
            </h3>
        </section>
        <section class="zhanwei"></section>
    </section>
    <section class="footer">
    	<h2>工位的类别</h2>
        <h3 class="clearfix">
        	<ul class="ul_1">
            	<li class="clearfix">
                	<i><img src="/img/kaifangkongjian.png" alt="开放工位" class="img_1"/></i>
                    <span>开放工位</span>
                </li>
                <li class="clearfix">
                	<i><img src="/img/wurenjian.png" alt="五人间" class="img_2"/></i>
                    <span>五人间</span>
                </li>
                <li class="clearfix">
                	<i><img src="/img/barenjian.png" alt="八人间" class="img_3"/></i>
                    <span>八人间</span>
                </li>
            </ul>
            <ul>
            	<li class="clearfix">
                	<i><img src="/img/sanrenjian.png" alt="三人间" class="img_4"/></i>
                    <span>三人间</span>
                </li>
                <li class="clearfix">
                	<i><img src="/img/liurenjian.png" alt="六人间" class="img_5"/></i>
                    <span>六人间</span>
                </li>
            </ul>
        </h3>
    </section>
</section>
<section class="zhezhaoceng"></section>
<section class="layer">
    <i class="iconfont">&#xe604;</i>
	<h2>工&nbsp;&nbsp;位&nbsp;&nbsp;号：<!--<span>开放空间</span>--><i></i></h2>
  	<h3>租赁状态：<span class="kongxian"></span>&nbsp;&nbsp;&nbsp;<i>空闲</i></h3>
    <h4 class="zuqi">租&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;期：
    <label><input type="radio" name="zuqi" class="nianzu"/>年</label>
    <label><input type="radio" name="zuqi" class="yuezu"/>月</label>
    <label><input type="radio" name="zuqi" class="zhouzu"/>周</label>
    <label><input type="radio" name="zuqi" class="rizu"/>日</label>
    </h4>
  <h5>
    	起始时间：
        <select name="startnian" class="startnian"></select>年
        <select name="startyue" class="startyue"></select>月
        <select name="startri" class="startri"></select>日<br />
        <div class="stop_timer_one">终止时间：<span class="nian">2017</span>年<em class="yue">5</em>月<i class="ri">8</i>日</div>
        <div class="stop_timer_two">
        终止时间：
        <select name="stopnian" class="endnian"></select>年
        <select name="stopyue" class="endyue"></select>月
        <select name="stopri" class="endri"></select>日
        </div>
        <div class="zidingyi" style="color:#30C;">自定义</div>
        <p id="warningMsg">*某一时间区间内工位已被租赁，请选择其他租赁方式</p>
    </h5>
    <a href="#"><h6 class="queding">确定</h6></a>
</section>
<script src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    var seats = <?php echo json_encode($result['seats']);?>;
</script>
<script src="/js/gongwei.js?aasdsag"></script>
<script>
    window.onresize=function(){
        window.location.reload();
    }
    $(".iconfont").click(function(){
        $(".zhezhaoceng").css({display:"none"});
        $(".layer").css({bottom:-400});
    })
</script>
</body>
</html>
