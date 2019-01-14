<?php /*a:2:{s:47:"D:\work\pay\application\pay\view\role\list.html";i:1547451107;s:52:"D:\work\pay\application\pay\view\Public\\public.html";i:1547454125;}*/ ?>
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

    
<link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/css/table/line.css?version=<?php echo htmlentities($version); ?>">
<link rel="stylesheet" href="<?php echo htmlentities($plugin_url); ?>/css/form/filter.css?version=<?php echo htmlentities($version); ?>">
<link rel="stylesheet" href="<?php echo htmlentities($pub_url); ?>/css/list.css?version=<?php echo htmlentities($version); ?>">
<link rel="stylesheet" href="<?php echo htmlentities($act_url); ?>/css/list.css?version=<?php echo htmlentities($version); ?>">


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
                
<div class="list">
    <div class="component-title">
        <div class="left">数据列表</div>
        <div class="right">
            <a>添加</a>
        </div>
    </div>
    <table class="line-tb">
        <thead>
        <tr>
            <th class="th-cbox"><input type="checkbox" @click="selectedAllEvent"></th>
            <th class="th-id">id</th>
            <th class="th-name">名称</th>
            <th class="th-number">权重</th>
            <th class="th-time">创建时间</th>
            <th class="th-opr">操作</th>
        </tr>
        </thead>
        <tbody ref="tbody">
        <tr v-for='v in data.data' :data-id="v.id" @click="selectedLineEvent" class="tr">
            <td><input type="checkbox" class="c-box"></td>
            <td>{{ v.id }}</td>
            <td>{{ v.name }}</td>
            <td>{{ v.weight }}</td>
            <td>{{ v.create_time }}</td>
            <td>
                <a class="btn-1" :href="genUrl('Role' , 'editView' , {id: v.id})">编辑</a>
                <button type="button" class="btn-1" @click="delEvent(v.id)">删除</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<div class="function">
    <span class="text">全局操作：</span>
    <button type="button" class="btn-1" @click="delSelectedEvent">删除选中项</button>
</div>
<div class="page">
    <Page :total="data.total" size="small" show-elevator show-total />
</div>

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


<script src="<?php echo htmlentities($act_url); ?>/js/list.js?version=<?php echo htmlentities($version); ?>"></script>

</body>
</html>