<?php /*a:2:{s:49:"D:\work\pay\application\pay\view\index\index.html";i:1547189620;s:52:"D:\work\pay\application\pay\view\Public\\public.html";i:1547198255;}*/ ?>
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
    <link rel="stylesheet" href="<?php echo htmlentities($pub_url); ?>/css/public.css?version=<?php echo htmlentities($version); ?>">

    

    <title></title>
</head>
<body>

<div class="app">
    <div class="doc-left" id="doc-left">
        <div class="top">
            <div class="logo"><img src="<?php echo htmlentities($res_url); ?>/image/lovely.jpg" class="image"></div>
            <div class="text">支付系统</div>
        </div>
        <div class="mid">
            <div class="avatar">
                <div class="image-for-container"><img src="<?php echo htmlentities($res_url); ?>/image/lovely.jpg" class="image"></div>
            </div>
            <div class="text"><?php echo htmlentities($user->phone); ?></div>
        </div>
        <div class="btm">
            <i-menu theme="dark" mode="vertical" width="200">
                <submenu name="1">
                    <template slot="title">
                        <icon type="ios-paper"></icon>内容管理
                    </template>
                    <menu-item name="1-1">文章管理</menu-item>
                    <menu-item name="1-2">文章管理</menu-item>
                    <menu-item name="1-3">文章管理</menu-item>
                </submenu>
            </i-menu>
        </div>
        <div class="fixed"></div>
    </div>
    <div class="doc-right" id="doc-right">
        <div class="top" ref="pub-top">
            <div class="left"></div>
            <div class="right">
                <!-- 用户控制 -->
                <div class="user" @mouseenter="mouseEnterForUser" @mouseleave="mouseLeaveForUser">
                    <div class="control">
                        <div class="c-left">
                            <div class="image-for-container">
                                <img src="<?php echo htmlentities($res_url); ?>/image/lovely.jpg" class="image">
                            </div>
                        </div>
                        <div class="c-right text">月舒</div>
                    </div>
                    <div class="function hide" ref="pub-function">
                        <div class="line">
                            <div class="ico"><img src="<?php echo htmlentities($pub_url); ?>/image/power.png" class="image"></div>
                            <div class="text">占位功能</div>
                        </div>
                        <div class="line" @click="loginOut">
                            <div class="ico"><img src="<?php echo htmlentities($pub_url); ?>/image/power.png" class="image"></div>
                            <div class="text">注销</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="btm" ref="pub-btm"></div>
    </div>
</div>

<script src="<?php echo htmlentities($plugin_url); ?>/Vue/vue.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/JQuery/jquery-3.3.1.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/layer-v3.1.1/layer/layer.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/iview/iview.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/tool.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/currency.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/globalVar.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/public.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/docLeft.js"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/docRight.js"></script>


</body>
</html>