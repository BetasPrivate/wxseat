<div class="time">
	<p>租用记录</p>
    <hr class="mini">
	<?php foreach($trades as $trade): ?>
        <p class="clearfix"><span>租用到期时间</span><em><?php echo $trade['start_date'];?>至<?php echo $trade['end_date'];?></em></p>
        <p class="clearfix"><span>租用的工位号/办公室号</span><em><?php echo $trade['seat_id_str'] ?></em></p>
        <p class="clearfix"><span>租借费用</span><em><?php echo $trade['Trade']['total_fee']/100;?></em></p>
        <p class="clearfix"><span>订单状态</span><em><?php echo $trade['trade_status_text'];?></em></p>
        <?php if ($trade['Trade']['status'] == 0):?>
        <p class="clearfix"><span><em><a href="/orders/prePay?tradeId=<?php echo $trade['Trade']['id'];?>">前往付款</a></em></span></p>
        <?php endif;?>
        <hr class="mini">
	<?php endforeach;?>
</div>