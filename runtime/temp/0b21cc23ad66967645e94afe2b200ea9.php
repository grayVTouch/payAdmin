<?php /*a:2:{s:47:"D:\work\pay\application\pay\view\role\role.html";i:1547457088;s:52:"D:\work\pay\application\pay\view\Public\\public.html";i:1547454125;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv='content-type' content='text/html;charset=utf8'>
    <meta http-equiv='X-UA-Compatible' content='IE=Edge,Chrome=1'>
    <meta name='form-detection' content='telephone=no'>
    <meta name='renderer' content='webkit'>

    

    <link rel='shortcut icon' href='<?php echo htmlentities($res_url); ?>/image/logo.png' />
    <link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/css/base.css?version=<?php echo htmlentities($version); ?>">
    <link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/css/ui/ui.css?version=<?php echo htmlentities($version); ?>">
    <link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/_Loading/css/Loading.css?version=<?php echo htmlentities($version); ?>">
    <link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/iview/styles/iview.css?version=<?php echo htmlentities($version); ?>">
    <link rel="stylesheet" href="<?php echo htmlentities($pub_url); ?>/css/iviewReset.css?version=<?php echo htmlentities($version); ?>">
    <link rel="stylesheet" href="<?php echo htmlentities($pub_url); ?>/css/public.css?version=<?php echo htmlentities($version); ?>">

    
<link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/css/form/input.css">
<link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/css/form/ui.css">
<link rel="stylesheet" href="<?php echo htmlentities($act_url); ?>/css/role.css">


    <title><?php echo htmlentities($pos['top']['name']); ?>-<?php echo htmlentities($pos['cur']['name']); ?></title>
</head>
<body>

<div class="app">
    <div class="doc-left" id="doc-left" ref="container">
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
            <i-menu theme="dark" ref="menu" :accordion="true" mode="vertical" width="200" @on-select="linkTo" :active-name="activeName" :open-names="openName">
                <submenu v-for="v in menu" :key="v.id" :name="v.id">
                    <template slot="title">
                        <icon :type="v.ico_for_font"></icon>{{ v.name }}
                    </template>
                    <menu-item v-for="v1 in v.children" :name="v1.id" :key="v1.id">{{ v1.name }}</menu-item>
                </submenu>
            </i-menu>
        </div>
        <div class="fixed"></div>
    </div>
    <div class="doc-right">
        <div class="top" ref="container" id="pub-top">
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
        <div class="btm" ref="container" id='pub-btm'>
            <div class="nav">
                <div class="left">
                    <img src="<?php echo htmlentities($res_url); ?>/image/user.jpg" class="image">
                    <span class="text name">{{ $store.state.pos.top.name }}</span><span class="text">&nbsp;/&nbsp;</span><span class="text en">{{ $store.state.pos.top.en }}</span>
                </div>
                <div class="right">
                    <breadcrumb>
                        <breadcrumb-item v-for="v in $store.state.pos.all" :key="v.id">{{ v.name }}</breadcrumb-item>
                    </breadcrumb>
                </div>
            </div>
            <div class="con">
                
<form @submit="submit" ref="form" data-id="<?php echo htmlentities($id); ?>" data-type="<?php echo htmlentities($type); ?>">
    <table class="input-tb">
        <tbody>
        <tr :class="error.name == '' ? '' : 'error'">
            <td>名称</td>
            <td>
                <input type="text" v-model="form.name" class="form-text">
                <span class="necessary">*</span>
                <span class="tip"></span>
                <span class="msg">{{ error.name }}</span>
            </td>
        </tr>
        <tr :class="error.code == '' ? '' : 'error'">
            <td>代码</td>
            <td>
                <input type="number" v-model="form.code" step='0' class="form-text">
                <span class="necessary hide">*</span>
                <span class="tip"></span>
                <span class="msg">{{ error.code }}</span>
            </td>
        </tr>
        <tr :class="error.weight == '' ? '' : 'error'">
            <td>权重</td>
            <td>
                <input type="number" v-model="form.weight" step='0' class="form-text">
                <span class="necessary hide">*</span>
                <span class="tip">默认：0</span>
                <span class="msg">{{ error.weight }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn-2">提交</button>
            </td>
        </tr>
        </tbody>
    </table>
</form>

            </div>
            <div class="logo"></div>
        </div>
    </div>
</div>

<!-- 加载层 -->
<div class="loading-container hide" id="pub-load-container">
    <div class="background"></div>
    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
    </div>
</div>

<script src="<?php echo htmlentities($plugin_url); ?>/SmallJs/SmallJs.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/_Loading/js/Loading.js?version=<?php echo htmlentities($version); ?>"></script>

<script src="<?php echo htmlentities($plugin_url); ?>/Vue/vue.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/Vue/vuex.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/JQuery/jquery-3.3.1.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/layer-v3.1.1/layer/layer.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($plugin_url); ?>/iview/iview.js?version=<?php echo htmlentities($version); ?>"></script>

<script src="<?php echo htmlentities($pub_url); ?>/js/tool.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/currency.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/globalVar.js?version=<?php echo htmlentities($version); ?>"></script>

<script src="<?php echo htmlentities($pub_url); ?>/js/public.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/docLeft.js?version=<?php echo htmlentities($version); ?>"></script>
<script src="<?php echo htmlentities($pub_url); ?>/js/topForDocRight.js?version=<?php echo htmlentities($version); ?>"></script>


<script src="<?php echo htmlentities($act_url); ?>/js/role.js?version=<?php echo htmlentities($version); ?>"></script>

</body>
</html>