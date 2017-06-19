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
    <ol class="breadcrumb">
        <li><a href="/su/tradeManager">订单管理</a></li>
        <li><a href="/su/seatManager">座位管理</a></li>
        <li class="active">用户管理</li>
    </ol>
    <table class="table table-hover table-condensed">
        <caption>已注册用户</caption>
        <thead class="row">
            <tr>
                <th class="col-md-3">昵称</th>
                <th class="col-md-2">手机号</th>
                <th class="col-md-2">角色</th>
                <th class="col-md-2">注册时间</th>
                <th class="col-md-2">编辑</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td class="col-md-3"><?php echo $user['User']['username'];?></td>
                <td class="col-md-2"><?php echo $user['User']['phone'];?></td>
                <td class="col-md-2"><?php echo $user['User']['role_name'];?></td>
                <td class="col-md-2"><?php echo $user['User']['created'];?></td>
                <td class="col-md-2"><button class="btn btn-primary">修改密码</button></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>