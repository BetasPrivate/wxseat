<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
<meta name="format-detection" content="telephone=no" />
<title>登录</title>
<link rel="stylesheet" href="/css/common.css" type="text/css"/>
<style>
    body {
        background-color:#f4f4f4;
        color:#333;
        }
    .home {
        width:100%;
        max-width:750px;
        min-width:320px;
        margin:0 auto;
        }
    .user {
        background-color:#fff;
        }
    input[type="text"],input[type="password"] {
        width:87%;
        display:block;
        margin:0 auto;
        height:2.5rem;
        border:none;
        outline:none;
        font-size:0.8rem;
        }
    input[type="text"] {
        border-bottom:solid 1px #d7d7d7;
        }
    input[type="submit"] {
        width:86.38%;
        height:2rem;
        font-size:0.8rem;
        text-align:center;
        line-height:2rem;
        border:none;
        outline:none;
        display:block;
        margin:1.1rem auto;
        /*6.21改动*/
        background-color:#4bb5c3;
        color:#FFFFFF;
        border-radius:0.15rem;
        -webkit-border-radius:0.15rem;
        -moz-border-radius:0.15rem;
        -o-border-radius:0.15rem;
        }
    ::-webkit-input-placeholder { /* WebKit browsers */
        color:#333;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
        color:#333;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
        color:#333;
        }
        :-ms-input-placeholder { /* Internet Explorer 10+ */
        color:#333;
        }
    h2 {
        text-align:center;
        font-size:0.7rem;
        }
    a {
        color:#333;
        }
    a.a_1 {
        padding-right:1.5rem;
        }
    a.a_2 {
        padding-left:1.5rem;
        }
</style>
</head>

<body>
    <div class="home">
        <?php echo $this->Flash->render('auth'); ?>
        <form action="/users/login" method="post">
            <div class="user">
            <input type="text" name="data[User][username]" placeholder="账户"/>
            <input type="password" name="data[User][password]" placeholder="密码"/>
            </div>
            <input type="submit" value="确定"/>
        </form>
      <!--   <form action="/users/login" id="UserLoginForm" method="post" accept-charset="utf-8">
            <div style="display:none;">
                <input type="hidden" name="_method" value="POST">
            </div>
            <fieldset>
                <legend>
                    请输入账号密码
                </legend>
                <div class="user">
                    <input type="text" name="data[User][username]" placeholder="账户" id = 'UserUsername'/>
                    <input type="password" name="data[User][password]" placeholder="密码" id="UserPassword"/>
                </div>
            </fieldset>
            <div class="submit"><input type="submit" value="确定"></div>
        </form> -->
        <h2>
            <a href="/users/changePasswd" class="a_1">修改密码</a>|<a href="/users/signIn" class="a_2">免费注册</a>
        </h2>
    </div>
</body>
</html>
