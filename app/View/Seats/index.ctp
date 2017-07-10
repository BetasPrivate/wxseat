<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1.0,minimum-scale=1.0,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<title>工位租赁</title>
<link rel="stylesheet" href="css/common.css" type="text/css"/>
<link rel="stylesheet" href="css/gongwei.css?1" type="text/css"/>
</head>

<body>
<section class="mobile">
    <section class="seat" id="seat">
        <section class="home" id="home">
        <!--改动，把header删除-->
        <section class="homeTop"></section>
        <section class="homeMain clearfix">
            <aside class="left"></aside>
            <article>
                <div class="three threeOne"><i></i></div>
                <div class="huiyishi">
                    <!--7.8改图片名称-->
                    <img src="/img/room3.jpg" alt="会议室"/>
                </div>
                <div class="three threeTwo">
                    <i></i>
                    <!--<div class="jifang">
                        <img src="/img/工位图2-拷贝_33.jpg" alt="机房" style="opacity:0;"/>
                    </div>-->
                </div>
            </article>
            <aside class="right" style="width:25.1%;float:right;margin-right:2%;">
                <!--7.8右上会议室-->
                <div style="position:relative;">
                    <img class="dayinshi" src="/img/xiuxishi.jpg" style="height:2rem;"/>
                    <!-- <a href="/seats/rentConference/创新厅"><img class="conference2" src="/img/conferance_2.jpg" style="position:absolute;width:47%;left:2.5%;top:28.2%;" /></a> -->
                    <a href=#><img class="conference2" src="/img/conferance_2.jpg" style="position:absolute;width:47%;left:2.5%;top:28.2%;" /></a>
                </div>
                <div class="home_right_left">
                    <!--7.8右下左会议室-->
                    <img class="qiantai" src="/img/room1.jpg" alt="前台" style="height:10rem;"/>
                    <!-- <a href="/seats/rentConference/泛态厅"><img src="/img/conferance_1.jpg" class="conference1"></a> -->
                    <a href=#><img src="/img/conferance_1.jpg" class="conference1"></a>
                </div>
                <div class="home_right_right"></div>
            </aside>
        </section>
        <section class="homeBottom clearfix">
            <h2></h2>
            <h3>
                <!--6.17改动-->
                <img src="/img/top_six.jpg" alt="六人间" style="width:13.5%;float:right; margin-right:2.5%;"/>
                <img src="/img/top_five.jpg" alt="五人间" style="width:13.5%;float:right;margin-right:0.7%;"/>
                <img src="/img/top_eight.jpg" alt="八人间" style="width:17.36%;float:right;margin-right:0.7%;"/>  
            </h3>
        </section>
        <section class="zhanwei"></section>
    </section>
    </section>
    <section class="footer">
        <h4>
            <ul class="clearfix">
                <li>
                    <img src="/img/kaifanggongwei.jpg" />可选
                </li>
                <li>
                    <img src="/img/xuanzhong.jpg" />已选
                </li>
                <li>
                    <img src="/img/yixuan.jpg" />占用
                </li>
            </ul>
        </h4>
        <h2>工位的类别</h2>
        <h3 class="clearfix">
            <ul class="ul_1">
                <li class="clearfix">
                    <i><img src="/img/kaifanggongwei.jpg" alt="开放工位" class="img_1"/></i>
                    <span>开放工位</span>
                </li>
                <li class="clearfix">
                    <i><img src="/img/wurenjian.jpg" alt="五人间" class="img_2"/></i>
                    <span>五人间</span>
                </li>
                <li class="clearfix">
                    <i><img src="/img/barenjian.jpg" alt="八人间" class="img_3"/></i>
                    <span>八人间</span>
                </li>
            </ul>
            <ul>
                <li class="clearfix">
                    <i><img src="/img/sanrenjian.jpg" alt="三人间" class="img_4"/></i>
                    <span>三人间</span>
                </li>
                <li class="clearfix">
                    <i><img src="/img/liurenjian.jpg" alt="六人间" class="img_5"/></i>
                    <span>六人间</span>
                </li>
            </ul>
        </h3>
    </section>
</section>
<section class="zhezhaoceng"></section>
<section class="layer">
    <!--改动-->
    <!--6.19-->
    <h2><em>工&nbsp;&nbsp;位&nbsp;&nbsp;号：</em><!--<span>开放空间</span>--><i></i></h2>
    <h3><em>租赁状态：</em><span class="kongxian"></span><i>可选</i></h3>
    <h4 class="zuqi">
        <em>租&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;期：</em>
        <i class="nianzu active">年</i>
        <i class="yuezu">月</i>
        <i class="zhouzu">周</i>
        <i class="rizu">日</i>
        <i class="custom">自定义</i><br />
    </h4>
  <h5>
        <div class="starttime">
            <em>起始时间：</em>
            <!--6.19-->
            <span class="startnian"></span>年
            <span class="startyue"></span>月
            <span class="startri"></span>日<br />
        </div>
        <div class="stop_timer_one"><em>终止时间：</em><span id="invalidate_seat_end_time"></span></div>
        <div class="stop_timer_two">
            <em>终止时间：</em>
            <label><i></i><select name="stopnian" class="endnian"></select>年</label>
            <label><i></i><select name="stopyue" class="endyue"></select>月</label>
            <label><i></i><select name="stopri" class="endri"></select>日</label>
        </div>
        <!--<div class="zidingyi" style="color:#30C;">自定义</div>-->
        <p><i></i>提示：当前时间内工位已被租赁，请选择其他租赁方式</p>
        <aside class="h1"></aside>
    </h5>
    <h6 class="zhantips"><a href="#" class="continue">继续选择</a></h6>
    <h6 class="ketips">
        <a href="#" class="continue">继续选择</a>
        <a href="#" class="queding">确定选择</a>
    </h6>
</section>
<script type="text/javascript">
    var seats = <?php echo json_encode($result['seats']);?>;
</script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/gongwei.js"></script>
<script type="text/javascript" src="js/hammer.js"></script>
<script src="js/scaling.js"></script>
<script>
    window.onresize=function(){
        window.location.reload();
    }
    //改动
//  $(".iconfont").click(function(){
//      $(".zhezhaoceng").css({display:"none"});
//      $(".layer").css({bottom:-400});
//  })
</script>
</body>
</html>