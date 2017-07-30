<?php 
    echo $this->Html->css([
        'bootstrap.min',
        'bootstrap-theme.min',
    ]);
    echo $this->Html->script(array(
        "jquery-3.2.1.min",
        'bootstrap.min',
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
        <li class="active">订单管理</li>
        <li><a href="/su/seatManager">座位管理</a></li>
        <li><a href="/su/userManager">用户管理</a></li>
    </ol>
    <table class="table table-hover table-condensed">
        <caption>当前已下订单</caption>
        <thead class="row">
            <tr>
                <th class="col-md-2">单号</th>
                <th class="col-md-1">买家昵称</th>
                <th class="col-md-1">实付金额</th>
                <th class="col-md-1">座位号</th>
                <th class="col-md-2">租赁时间段</th>
                <th class="col-md-2">下单时间</th>
                <th class="col-md-2">订单状态</th>
                <th class="col-md-1">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($trades as $key => $trade): ?>
            <tr>
                <td class="col-md-2 <?php echo $trade['class_name'];?>"><?php echo $trade['Trade']['platform_trade_id'];?></td>
                <td class="col-md-1 <?php echo $trade['class_name'];?>"><?php echo $trade['User']['username'];?></td>
                <td class="col-md-1 <?php echo $trade['class_name'];?>"><?php echo $trade['Trade']['total_fee'];?></td>
                <td class="col-md-1 <?php echo $trade['class_name'];?>"><?php echo $trade['seat_id_str'];?></td>
                <td class="col-md-2 <?php echo $trade['class_name'];?>"><?php echo substr($trade['start_date'], 0, 10).' 至 '.substr($trade['end_date'], 0, 10);?></td>
                <td class="col-md-2 <?php echo $trade['class_name'];?>"><?php echo $trade['Trade']['created'];?></td>
                <td class="col-md-2 <?php echo $trade['class_name'];?>"><?php echo $trade['trade_status_text'];?></td>
                <td class="col-md-1 <?php echo $trade['class_name'];?>">
                    <!-- <button class="btn btn-success" onclick="showTradeDetailPanel(<?php echo $trade['Trade']['id'];?>, <?php echo $key;?>)">订单详情</button> -->
                    <button class="btn <?php echo $trade['Trade']['has_return_deposit'] == 1 ? 'btn-danger': "btn-success"?>" <?php echo $trade['Trade']['has_return_deposit'] == 0 ? '': "disabled='disabled'"?> onclick="returnDeposit(<?php echo $trade['Trade']['id'];?>)" id="returnDeposit<?php echo $trade['Trade']['id'];?>"><?php echo $trade['Trade']['has_return_deposit'] == 1 ? '保证金已退': "设置退回保证金"?></button>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="modal fade" tabindex="-1" role="dialog" id="PanelTradeDetail">
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
                    <p><span style="width: 100px;">租金：</span><input type="number" id="price"></p>
                    <p><span style="width: 100px;">押金：</span><input type="number" id="deposit"></p>
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

    var trades = <?php echo json_encode($trades);?>;

    function returnDeposit(tradeId) {
        var confirmMsg;

        var data = {
            id:tradeId
        };

        confirmMsg = '确认设置?';

        if (confirm(confirmMsg)) {
            $.ajax({
                'url':'/trades/returnDeposit',
                'type':'POST',
                'dataType': 'json',
                'data': data,
                success:function(response) {
                    if (response.status == 1) {
                        $('#returnDeposit'+tradeId).attr('disabled', true);
                        showTips('设置成功(*^__^*) 嘻嘻……');
                    } else {
                        showTips(response.msg);
                    }
                },
                error: function(res) {
                    console.log(res);
                }
            })
        }
    }

    function initPanel() {
        $( "#price" ).val('');
        $( "#deposit" ).val('');
        $( "#freeTime" ).val('');
    }

    function showTradeDetailPanel(seatId, index) {
        initPanel();
        var trade = trades[index];
        // var startDate = seat.Order.start_date;
        // var endDate = seat.Order.end_date;
        // var seatTypeName = seat.SeatType.name;
        // var seatRealId = seat.Seat.real_id;
        // var userName = seat.Order.User.username;
        // var price = seat.Seat.price;
        // var deposit = seat.Seat.deposit;
        // var freeTime = seat.Seat.free_time;

        $('#PanelTradeDetail').modal('show');
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