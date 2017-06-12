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
<div style="width: 80%;" class="container-fluid">
    <table class="table table-hover table-condensed">
        <caption>当前已下订单</caption>
        <thead class="row">
            <tr>
                <th class="col-md-3">单号</th>
                <th class="col-md-2">买家昵称</th>
                <th class="col-md-2">实付金额</th>
                <th class="col-md-1">座位号</th>
                <th class="col-md-2">下单时间</th>
                <th class="col-md-2">订单状态</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($trades as $trade): ?>
            <tr>
                <td class="col-md-3 <?php echo $trade['class_name'];?>"><?php echo $trade['Trade']['platform_trade_id'];?></td>
                <td class="col-md-2 <?php echo $trade['class_name'];?>"><?php echo $trade['User']['username'];?></td>
                <td class="col-md-2 <?php echo $trade['class_name'];?>"><?php echo $trade['Trade']['total_fee'];?></td>
                <td class="col-md-1 <?php echo $trade['class_name'];?>"><?php echo $trade['seat_id_str'];?></td>
                <td class="col-md-2 <?php echo $trade['class_name'];?>"><?php echo $trade['Trade']['created'];?></td>
                <td class="col-md-2 <?php echo $trade['class_name'];?>"><?php echo $trade['trade_status_text'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>