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
        <caption>座位信息表</caption>
        <thead class="row">
            <tr>
                <th class="col-md-1">座位号</th>
                <th class="col-md-2">座位状态</th>
                <th class="col-md-2">座位类型</th>
                <th class="col-md-2">开始时间</th>
                <th class="col-md-2">到期时间</th>
                <th class="col-md-2">使用者</th>
                <th class="col-md-1">编辑</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($seats as $seat): ?>
            <tr>
                <td class="col-md-1"><?php echo $seat['Seat']['real_id'];?></td>
                <td class="col-md-2"><?php echo $seat['seat_status_text'];?></td>
                <td class="col-md-2"><?php echo $seat['seat_type_text'];?></td>
                <td class="col-md-2"><?php echo $seat['Order']['start_date'];?></td>
                <td class="col-md-2"><?php echo $seat['Order']['end_date'];?></td>
                <td class="col-md-2"><?php echo $seat['Order']['User']['username'];?></td>
                <td class="col-md-1">
                	<input type="hidden" value='<?php echo json_encode($seat);?>' id='seatId<?php echo $seat['Seat']['id'];?>' >
                	<button class="btn btn-info" onclick="showSeatDetailPanel(<?php echo $seat['Seat']['id'];?>)">详细信息</button>
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
		        	<h4 class="modal-title">Modal title</h4>
		      	</div>
		      	<div class="modal-body">
		        	<p>One fine body&hellip;</p>
		      	</div>
		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	<button type="button" class="btn btn-primary">Save changes</button>
		      	</div>
	    	</div><!-- /.modal-content -->
	  	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
<script type="text/javascript">
	function showSeatDetailPanel(seatId) {
		$('#PanelSeatDetail').modal('show');
		var a = document.getElementById('seatId'+seatId);
		console.log(a.value);
	}
</script>