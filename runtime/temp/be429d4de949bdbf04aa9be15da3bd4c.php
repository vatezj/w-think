<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:39:"application/admin\view\Index\index.html";i:1489306286;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title> W-think- 主页</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico"> <link href="__ASSETS__/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="__ASSETS__/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="__ASSETS__/css/animate.css" rel="stylesheet">
    <link href="__ASSETS__/css/style.css?v=4.1.0" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                    <span class="block m-t-xs" style="font-size:20px;">
                                        <i class="fa fa-area-chart"></i>
                                        <strong class="font-bold">W-think</strong>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="logo-element">W-think
                        </div>
                    </li>
                    <li>
                        <a class="J_menuItem" href="<?php echo url('main'); ?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                        </a>
                    </li>
 
                         <?php if(is_array($info) || $info instanceof \think\Collection): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                         <li>
                            <?php if($vo['son'] == 1): ?>  

                            <a class="J_menuItem" href="<?php echo url($vo['url']); ?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-label"><?php echo $vo['name']; ?></span>
                            </a>
                            <?php else: ?> 
                            <a href="#">
                                <i class="fa fa fa-bar-chart-o"></i>
                                <span class="nav-label"><?php echo $vo['name']; ?></span>
                                <span class="fa arrow"></span>
                            </a>
                                <ul class="nav nav-second-level">
                                    <?php if(is_array($vo['son']) || $vo['son'] instanceof \think\Collection): $i = 0; $__LIST__ = $vo['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cate): $mod = ($i % 2 );++$i;?>
                                         <li>
                                            <?php if($cate['son'] == 1): ?>  
                                            <a class="J_menuItem" href="<?php echo url($cate['url']); ?>">
                                            <i class="fa fa-home"></i>
                                            <span class="nav-label"><?php echo $cate['name']; ?></span>
                                            </a>
                                            <?php else: ?> 
                                            <a href="#">
                                                <i class="fa fa fa-bar-chart-o"></i>
                                                <span class="nav-label"><?php echo $cate['name']; ?></span>
                                                <span class="fa arrow"></span>
                                            </a>
                                                <ul class="nav nav-third-level">
                                                    <?php if(is_array($cate['son']) || $cate['son'] instanceof \think\Collection): $i = 0; $__LIST__ = $cate['son'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$catea): $mod = ($i % 2 );++$i;?>
                                                    
                                                        <li>
                                                           <a class="J_menuItem" href="<?php echo url($catea['url']); ?>">
                                            <i class="fa fa-home"></i>
                                            <span class="nav-label"><?php echo $catea['name']; ?></span>
                                            </a>
                                                        </li>
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </ul>
                                            <?php endif; ?>     
                                         </li>
                                       <!--  <li>
                                            <a class="J_menuItem" href="graph_flot.html"><?php echo $cate['name']; ?></a>
                                        </li> -->
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            <?php endif; ?>     
                         </li>
                         <?php endforeach; endif; else: echo "" ;endif; ?>

                    <li>
                        <a href="#">
                            <i class="fa fa fa-bar-chart-o"></i>
                            <span class="nav-label">设置</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                               <a href="#">菜单管理 <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a class="J_menuItem" href="<?php echo url('menu'); ?>"><i class="fa fa fa-bar-chart-o"></i>后台菜单</a>
                                    </li>
                                    <li>
                                         <a class="J_menuItem" href="agile_board.html">任务清单</a>
                                    </li>
                                </ul>
                            
                            </li>
                            <li>
                                <a class="J_menuItem" href="graph_flot.html">修改密码</a>
                            </li>
                        </ul>
                    </li>
                    

                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="#"><i class="fa fa-bars"></i> </a>
                       <!--  <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form> -->
                    </div>
                    <!-- onclick="ifrmid.window.location.reload()" -->
                    <ul class="nav navbar-top-links navbar-right">
                        <li onclick="javascript:refreshFrame();">  <a class="count-info" href="#"><i class="fa fa-refresh"></i></a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li class="m-t-xs">
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="__ASSETS__/img/a7.jpg">
                                        </a>
                                        <div class="media-body">
                                            <small class="pull-right">46小时前</small>
                                            <strong>小四</strong> 是不是只有我死了,你们才不骂爵迹
                                            <br>
                                            <small class="text-muted">3天前 2014.11.8</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="__ASSETS__/img/a4.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy">25小时前</small>
                                            <strong>二愣子</strong> 呵呵
                                            <br>
                                            <small class="text-muted">昨天</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="mailbox.html">
                                            <i class="fa fa-envelope"></i> <strong> 查看所有消息</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> 您有16条未读消息
                                            <span class="pull-right text-muted small">4分钟前</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="profile.html">
                                        <div>
                                            <i class="fa fa-qq fa-fw"></i> 3条新回复
                                            <span class="pull-right text-muted small">12分钟钱</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a class="J_menuItem" href="notifications.html">
                                            <strong>查看所有 </strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe id="J_iframe" width="100%" height="100%" src="<?php echo url('main'); ?>" frameborder="0" data-id="index_v1.html" seamless name="ifrmname"></iframe>
            </div>
        </div>
        <!--右侧部分结束-->
    </div>

    <!-- 全局js -->
    <script src="__ASSETS__/js/jquery.min.js?v=2.1.4"></script>
    <script src="__ASSETS__/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="__ASSETS__/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="__ASSETS__/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="__ASSETS__/js/plugins/layer/layer.min.js"></script>

    <!-- 自定义js -->
    <script src="__ASSETS__/js/hAdmin.js?v=4.1.0"></script>
    <script type="text/javascript" src="__ASSETS__/js/index.js"></script>
<!--     <script type="text/javascript">
    $("#refresh_wrapper").click(function(){
        var $current_iframe=$("#J_iframe iframe:visible");
            .window.location.reload()
       
       
    });
    </script> -->

    <!-- 第三方插件 -->
    <!-- <script src="__ASSETS__/js/plugins/pace/pace.min.js"></script> -->
    <script type="text/javascript">

function refreshFrame(){
    document.getElementById('J_iframe').contentWindow.location.reload(true);
}

</script>
</body>

</html>
