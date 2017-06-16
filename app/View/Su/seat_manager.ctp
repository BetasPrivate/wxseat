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
<div style="width: 80%;" class="container-fluid">
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
</div>
<div class="tips" style="display: none;">☺ 复制成功</div>
<script type="text/javascript">
    var seats = <?php echo json_encode($seats);?>;

    function showSeatDetailPanel(seatId, index) {
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
                
            },
            error:function (data) {
            }
        })
    }

    function showTips(tipNote) {
        $("body").find(".tips").remove().end().append("<div class='tips'>"+tipNote+"</div>"),setTimeout(function(){$(".tips").fadeOut(300)},500);
    }
</script>