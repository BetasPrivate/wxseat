<?php 
    echo $this->Html->css([
        'bootstrap.min',
        'bootstrap-theme.min',
        'jquery-ui.min',
    ]);
    echo $this->Html->script(array(
        "jquery-3.2.1.min",
        'bootstrap.min',
        'jquery-ui.min',
        'jquery-ui-zh',
    ));
?>
<style type="text/css">
    .tips{
    position:fixed;
    padding:10px;
    font-size:14px;
    line-height:14px;
    left:50%;
    top:200px;
    -webkit-transform:translate(-50%);
    transform:translate(-50%);
    background-color:rgba(0,0,0,.7);
    text-align:center;
    color:#fff;
    z-index:101;
    box-sizing:content-box;
    border-radius:5px
}
</style>
<div style="width: 80%;" class="container-fluid">
    <ol class="breadcrumb">
        <li><a href="/su/tradeManager">订单管理</a></li>
        <li class="active">座位管理</li>
        <li><a href="/su/userManager">用户管理</a></li>
    </ol>
    <tr class="row">
        <td class="col-md-3">上网账号:
        <input type="text" name="" value="<?php echo $wifiConfig['WifiConfig']['name'];?>" id="wifi_name">
        </td>
        <td class="col-md-3">上网密码:
        <input type="text" name="" value="<?php echo $wifiConfig['WifiConfig']['pwd'];?>" id="wifi_pwd">
        </td>
        <td class="col-md-3"><button class="btn btn-info" onclick="updateWifiConfig()">更新</button></td>
    </tr>
    <hr class="mini">
    <tr class="row">
        <td class="col-md-3">门禁账号:
        <input type="text" name="" value="<?php echo $guardConfig['EntranceGuardConfig']['dev_id'];?>" id="dev_id">
        </td>
        <td class="col-md-3">门禁密码:
        <input type="text" name="" value="<?php echo $guardConfig['EntranceGuardConfig']['dev_pwd'];?>" id="dev_pwd">
        </td>
        <td class="col-md-3"><button class="btn btn-info" onclick="updateGuardConfig()">更新</button></td>
        <br>
        <button class="btn btn-default" onclick="testEntranceGuard(11)">测试打开门禁</button>
        <button class="btn btn-default" onclick="testEntranceGuard(12)">测试关闭门禁</button>
        <button class="btn btn-default" onclick="getEntranceGuardQRCode()">查看门禁二维码</button>
    </tr>
    <hr class="mini">
    <table class="table table-hover table-condensed">
        <caption>座位价格表</caption>
        <thead class="row">
            <tr>
                <th class="col-md-2">类型</th>
                <th class="col-md-2">日租金</th>
                <th class="col-md-2">月租金</th>
                <th class="col-md-2">年租金</th>
                <th class="col-md-2">保证金</th>
                <th class="col-md-2">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($seatTypes as $key => $seatType): ?>
            <tr>
                <td class="col-md-2"><?php echo $seatType['SeatType']['name'];?></td>
                <td class="col-md-2"><input type="text" name="" value="<?php echo $seatType['SeatType']['daily_price'];?>" style="width: 50px;" id="daily_price<?php echo $seatType['SeatType']['id'];?>"></td>
                <td class="col-md-2"><input type="text" name="" value="<?php echo $seatType['SeatType']['monthly_price'];?>" style="width: 50px;" id="monthly_price<?php echo $seatType['SeatType']['id'];?>"></td>
                <td class="col-md-2"><input type="text" name="" value="<?php echo $seatType['SeatType']['annual_price'];?>" style="width: 50px;" id="annual_price<?php echo $seatType['SeatType']['id'];?>"></td>
                <td class="col-md-2"><input type="text" name="" value="<?php echo $seatType['SeatType']['deposit'];?>" style="width: 50px;" id="deposit<?php echo $seatType['SeatType']['id'];?>"></td>
                <td class="col-md-2"><button class="btn btn-info" onclick="updateSeatTypeInfo(<?php echo $seatType['SeatType']['id'];?>)">更新</button></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <hr class="mini">
    <table class="table table-hover table-condensed">
        <caption>座位信息表</caption>
        <thead class="row">
            <tr>
                <th class="col-md-1">座位号</th>
                <th class="col-md-2">座位状态</th>
                <th class="col-md-2">座位类型</th>
                <th class="col-md-3">到期时间</th>
                <th class="col-md-1">编辑</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($seats as $key => $seat): ?>
            <tr class="<?php echo $seat['clz_name'];?>">
                <td class="col-md-1"><?php echo $seat['Seat']['real_id'];?></td>
                <td class="col-md-2"><?php echo $seat['seat_status_text'];?></td>
                <td class="col-md-2"><?php echo $seat['seat_type_text'];?></td>
                <td class="col-md-3"><?php echo $seat['Seat']['free_time'];?></td>
                <td class="col-md-1">
                    <button class="btn btn-info" onclick="showSeatDetailPanel(<?php echo $seat['Seat']['id'];?>, <?php echo $key;?>)">详细信息</button>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="modal fade" tabindex="-1" role="dialog" id="PanelSeatDetail">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">工位详情</h4>
                    <label class="label label-info"><span id="seatTypeName"></span>&nbsp&nbsp&nbsp&nbsp&nbsp<span id='seatRealId'></span></label>
                </div>
                <div class="modal-body">
                   <!--  <p><span style="width: 100px;">开始日期: </span><input type="text" id="startDate"></p>
                    <p><span style="width: 100px;">结束日期: </span><input type="text" id="endDate"></p>
                    <p><span style="width: 100px;">使用者：</span><input type="text" id="username"></p> -->
                    <!-- <p><span style="width: 100px;">租金：</span><input type="number" id="price"></p> -->
                    <!-- <p><span style="width: 100px;">押金：</span><input type="number" id="deposit"></p> -->
                    <p><span style="width: 100px;">占用到: </span><input type="text" id="freeTime"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <input type="hidden" id='seatId'>
                    <button type="button" class="btn btn-primary" onclick="saveSeatInfo()">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="tips" style="display: none;">☺ 复制成功</div>
</div>
<script type="text/javascript">
    var seats = <?php echo json_encode($seats);?>;

    function initPanel() {
        $( "#price" ).val('');
        $( "#deposit" ).val('');
        $( "#freeTime" ).val('');
    }

    function testEntranceGuard(type) {
        var data = {
            type:type
        }
        $.ajax({
            url:'/su/testEntranceGuard',
            type:'POST',
            dataType:'json',
            data:data,
            success:function(response) {
                alert(response.msg+' 代码：'+ response.code);
            }
        })
    }

    function updateSeatTypeInfo(typeId) {
        if (!confirm('确定更新?')) {
            return;
        }

        var data =  {
            id:typeId,
            daily_price:$('#daily_price'+typeId).val(),
            monthly_price:$('#monthly_price'+typeId).val(),
            annual_price:$('#annual_price'+typeId).val(),
            deposit:$('#deposit'+typeId).val(),
        };


        $.ajax({
            url:'/su/updateSeatTypeInfo',
            type:'POST',
            dataType:'json',
            data:data,
            success:function(response) {
                if (response.status == 1) {
                    showTips('☺ 修改成功');
                } else {
                    showTips(response.msg);
                }
            }
        })
    }

    function getEntranceGuardQRCode(){
        $.ajax({
            url:'/su/getEntranceGuardQRCode',
            type:'GET',
            dataType:'json',
            success:function(response) {
                if (response.status == 1) {
                    window.location.href = response.url;
                } else {
                    alert(response.msg);
                }
            }
        })
    }

    function updateWifiConfig(){
        if (!confirm('确定更新?')) {
            return;
        }

        var data = {
            name:$('#wifi_name').val(),
            pwd:$('#wifi_pwd').val(),
        }

        $.ajax({
            url:'/su/updateWifiConfig',
            type:'POST',
            dataType:'json',
            data:data,
            success:function(response) {
                if (response.status == 1) {
                    showTips('☺ 修改成功');
                    $( "#PanelSeatDetail" ).modal('hide');
                } else {
                    showTips(response.msg);
                }
            }
        })
    }

    function updateGuardConfig(){
        if (!confirm('确定更新?')) {
            return;
        }

        var data = {
            dev_id:$('#dev_id').val(),
            dev_pwd:$('#dev_pwd').val(),
        }

        $.ajax({
            url:'/su/updateGuardConfig',
            type:'POST',
            dataType:'json',
            data:data,
            success:function(response) {
                if (response.status == 1) {
                    showTips('☺ 修改成功');
                    $( "#PanelSeatDetail" ).modal('hide');
                } else {
                    showTips(response.msg);
                }
            }
        })
    }

    function showSeatDetailPanel(seatId, index) {
        initPanel();
        var seat = seats[index];
        // var startDate = seat.Order.start_date;
        // var endDate = seat.Order.end_date;
        var seatTypeName = seat.SeatType.name;
        var seatRealId = seat.Seat.real_id;
        // var userName = seat.Order.User.username;
        var price = seat.Seat.price;
        var deposit = seat.Seat.deposit;
        var freeTime = seat.Seat.free_time;

        $('#PanelSeatDetail').modal('show');
        // $( "#startDate" ).datepicker();
        // $( "#endDate" ).datepicker();
        $( "#freeTime" ).datepicker();
        $( "#seatId" ).val(seatId);
        $( "#seatTypeName" ).html(seatTypeName);
        $( "#seatRealId" ).html(seatRealId);

        // if (startDate != '无') {
        //     $( "#startDate" ).val(startDate);
        // }
        // if (endDate != '无') {
        //     $( "#endDate" ).val(endDate);
        // }
        // if (userName != '无') {
        //     $( "username" ).val(userName);
        // }
        if (price) {
            $( "#price" ).val(price);
        }
        if (deposit) {
            $( "#deposit" ).val(deposit);
        }
        if (freeTime) {
            $( "#freeTime" ).val(freeTime);
        }
    }

    function saveSeatInfo() {
        var startDate = $( "#startDate" ).val();
        var endDate = $( "#endDate" ).val();
        var username = $( "#username" ).val();
        var price = $( "#price" ).val();
        var deposit = $( "#deposit" ).val();
        var freeTime = $( "#freeTime" ).val();

        if (!price || !deposit) {
            alert('信息不完整！');
            return;
        }
        var data = {
            // start_date: startDate,
            // end_date: endDate,
            // username: username,
            price: price,
            deposit: deposit,
            seat_id: $( "#seatId" ).val(),
        };
        if ($( "#freeTime" ).val()) {
            data.free_time = $( "#freeTime" ).val();
        }
        console.log(data);
        $.ajax({
            url:'/seats/editSeatInfo',
            type: 'POST',
            dataType:"json",
            data:data,
            success:function (response) {
                if (response.status == 1) {
                    showTips('☺ 修改成功');
                    $( "#PanelSeatDetail" ).modal('hide');
                } else {
                    showTips(response.msg);
                }
            },
            error:function (data) {
            }
        })
    }

    function showTips(tipNote) {
        $("body").find(".tips").remove().end().append("<div class='tips'>"+tipNote+"</div>"),setTimeout(function(){$(".tips").fadeOut(500)},500);
    }
</script>