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
        <li><a href="/su/seatManager">座位管理</a></li>
        <li class="active">用户管理</li>
    </ol>
    <table class="table table-hover table-condensed">
        <caption>已注册用户</caption>
        <thead class="row">
            <tr>
                <th class="col-md-1">昵称</th>
                <th class="col-md-2">手机号</th>
                <th class="col-md-2">角色</th>
                <th class="col-md-2">注册时间</th>
                <th class="col-md-2">编辑</th>
                <th class="col-md-2">门禁</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr class="<?php echo $user['clz_name'];?>">
                <td class="col-md-1"><?php echo $user['User']['username'];?></td>
                <td class="col-md-2"><?php echo $user['User']['phone'];?></td>
                <td class="col-md-2"><?php echo $user['User']['role_name'];?></td>
                <td class="col-md-2"><?php echo $user['User']['created'];?></td>
                <?php if($user['User']['is_activated'] == 1):?>
                <td class="col-md-2"><button class="btn btn-warning" onclick="editUser(0, <?php echo $user['User']['id'];?>)">禁用该用户</button></td>
                <?php else:?>
                <td class="col-md-2"><button class="btn btn-success" onclick="editUser(1, <?php echo $user['User']['id'];?>)">启用该用户</button></td>
                <?php endif;?>
                <?php if($user['User']['is_allow_enter'] == 1):?>
                <td class="col-md-2"><button class="btn btn-warning" onclick="allowUser(0, <?php echo $user['User']['id'];?>)">禁用扫码开门</button></td>
                <?php else:?>
                <td class="col-md-2"><button class="btn btn-success" onclick="allowUser(1, <?php echo $user['User']['id'];?>)">启用扫码开门</button></td>
                <?php endif;?>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <div class="tips" style="display: none;">☺ 复制成功</div>
</div>
<script type="text/javascript">
    function editUser(type, userId) {
        var confirmMsg;

        var data = {
            type: type,
            user_id: userId,
        };

        if (type == 0) {
            confirmMsg = '确认禁用?';
        } else {
            confirmMsg = '确认启用?';
        }

        if (confirm(confirmMsg)) {
            $.ajax({
                'url':'/users/editUser',
                'type':'POST',
                'dataType': 'json',
                'data': data,
                success:function(response) {
                    if (response.status == 1) {
                        showTips('修改成功(*^__^*) 嘻嘻……');
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

    function allowUser(type, userId) {
        var confirmMsg;

        var data = {
            type: type,
            user_id: userId,
        };

        if (type == 0) {
            confirmMsg = '确认禁用该用户的扫码开门功能?';
        } else {
            confirmMsg = '确认启用该用户的扫码开门功能?';
        }

        if (confirm(confirmMsg)) {
            $.ajax({
                'url':'/users/allowUser',
                'type':'POST',
                'dataType': 'json',
                'data': data,
                success:function(response) {
                    if (response.status == 1) {
                        showTips('修改成功(*^__^*) 嘻嘻……');
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

    function showTips(tipNote) {
        $("body").find(".tips").remove().end().append("<div class='tips'>"+tipNote+"</div>"),setTimeout(function(){$(".tips").fadeOut(500)},500);
    }
</script>