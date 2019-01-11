<?php /*a:2:{s:49:"D:\work\pay\application\pay\view\login\login.html";i:1547185804;s:51:"D:\work\pay\application\pay\view\Public\\login.html";i:1547190736;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv='content-type' content='text/html;charset=utf8'>
    <meta http-equiv='X-UA-Compatible' content='IE=Edge,Chrome=1'>
    <meta name='form-detection' content='telephone=no'>
    <meta name='renderer' content='webkit'>

    

    <!--<link rel='shortcut icon' href='<?php echo htmlentities($url); ?>/logo/logo.ico' />-->
    <link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/css/base.css?version=<?php echo htmlentities($version); ?>">
    <link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/css/ui/ui.css?version=<?php echo htmlentities($version); ?>">
    <link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/iview/styles/iview.css?version=<?php echo htmlentities($version); ?>">
    <link rel="stylesheet" href="<?php echo htmlentities($pub_url); ?>/css/iviewReset.css?version=<?php echo htmlentities($version); ?>">

    
<link rel="stylesheet" href="<?php echo htmlentities($pub_url); ?>/css/login.css">


    <title>用户登录</title>
</head>
<body>


<div class="app" id="app">
    <div class="main">
        <div class="top header">
            <div class="avatar">
                <img src="/static/image/lovely.jpg" class="image">
            </div>
        </div>
        <form class="btm form layui-form" @submit="submit">
            <div class="line input-line">
                <div class="top">
                    <div class="c-input">
                        <input type="text" placeholder="请输入用户名" v-model="form.name" class="input">
                    </div>
                    <div class="c-ico">
                        <img src="<?php echo htmlentities($act_url); ?>/image/user.png" class="image">
                    </div>
                </div>
                <div class="btm tip">{{ tip.name }}</div>
            </div>

            <div class="line input-line">
                <div class="top">
                    <div class="c-input">
                        <input type="password" placeholder="请输入密码" v-model="form.password" class="input">
                    </div>
                    <div class="c-ico">
                        <img src="<?php echo htmlentities($act_url); ?>/image/password.png" class="image">
                    </div>
                </div>
                <div class="btm tip">{{ tip.password }}</div>
            </div>

            <div class="line check-line">
                <div class="left">
                    <span>记住密码：</span>
                    <!--<input type="checkbox" lay-skin="switch" v-model="form.remember"  lay-text="ON|OFF">-->
                    <i-switch size="large" v-model="remember">
                        <span slot="open">开启</span>
                        <span slot="close">关闭</span>
                    </i-switch>
                </div>
                <div class="right"></div>
            </div>

            <div class="line btn-line">
                <button type="submit" class="btn-2">登录</button>
            </div>
        </form>
    </div>
</div>


<script src="<?php echo htmlentities($plugin_url); ?>/Vue/vue.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/JQuery/jquery-3.3.1.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/layer-v3.1.1/layer/layer.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/iview/iview.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/tool.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/currency.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/login.js"></script>



<script src="<?php echo htmlentities($act_url); ?>/js/login.js"></script>

</body>
</html>