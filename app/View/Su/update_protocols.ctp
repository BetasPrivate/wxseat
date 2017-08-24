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
    .text{
        overflow: scroll;
    }
</style>
<div>
    <div>
        <h2><label class="label label-primary">协议：</label></h2>
        <textarea id="1" class='form-control text'></textarea>
        <button class="btn btn-info" onclick="postData(1)">更新</button>
        <a class="btn btn-info" target="__blank" href="/orders/agreement">查看</a>
    </div>
    <div>
        <h2><label class="label label-success">承诺书：</label></h2>
        <textarea id="2" class='form-control text'></textarea>
        <button class="btn btn-info" onclick="postData(2)">更新</button>
        <a class="btn btn-info" target="__blank" href="/orders/agreement/2">查看</a>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("textarea").css('width', '50%');
        $("textarea").css('height', '300px');
        // $('#1').html("<?php echo $protocols[0]['Protocol']['text'];?>");
        // $('#2').html("<?php echo $protocols[1]['Protocol']['text'];?>");
    })

    function postData(id) {
        var data = {
            id:id,
            text:$('#'+id).val(),
        };
        $.ajax({
            url:'/su/updateProtocols',
            method:'POST',
            dataType:'json',
            data:data,
            success:function(res){
                if (res.status == 1) {
                    alert('更新成功');
                } else {
                    alert(res.msg);
                }
            },
        })
    }
</script>