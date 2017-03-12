<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:38:"application/admin\view\Index\main.html";i:1489306287;s:42:"application/admin/view/public\_header.html";i:1489306287;s:42:"application/admin/view/public\_footer.html";i:1489306287;}*/ ?>
 <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 基础表格</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="__ASSETS__/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="__ASSETS__/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="__ASSETS__/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="__ASSETS__/css/animate.css" rel="stylesheet">
    <link href="__ASSETS__/css/style.css?v=4.1.0" rel="stylesheet">
    <!-- 弹窗css -->
    <link href="__ASSETS__/css/sweetalert.css" rel="stylesheet">
</head>

<body class="gray-bg">
     <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><a href="">系统信息</a></h5>
                    </div>
                    
                       <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <tr>
                        <td style="width: 400px;">网站域名</td>
                        <td><?php echo $config['url']; ?></td>
                    </tr>
                    <tr>
                        <td>网站目录</td>
                        <td><?php echo $config['document_root']; ?></td>
                    </tr>
                    <tr>
                        <td>服务器操作系统</td>
                        <td><?php echo $config['server_os']; ?></td>
                    </tr>
                    <tr>
                        <td>服务器端口</td>
                        <td><?php echo $config['server_port']; ?></td>
                    </tr>
                    <tr>
                        <td>服务器IP</td>
                        <td><?php echo $config['server_ip']; ?></td>
                    </tr>
                    <tr>
                        <td>服务器环境</td>
                        <td><?php echo $config['server_soft']; ?></td>
                    </tr>
                    <tr>
                        <td>PHP版本</td>
                        <td><?php echo $config['php_version']; ?></td>
                    </tr>
                    <tr>
                        <td>MySQL版本</td>
                        <td><?php echo $config['mysql_version']; ?></td>
                    </tr>
                    <tr>
                        <td>最大上传限制</td>
                        <td><?php echo $config['max_upload_size']; ?></td>
                    </tr>
                        </table>

                      </div>
                </div>
            </div>
        </div>
    
 </div>

    <!-- 全局js -->
    <script src="__ASSETS__/js/jquery.min.js?v=2.1.4"></script>
    <script src="__ASSETS__/js/bootstrap.min.js?v=3.3.6"></script>
    <script src="__ASSETS__/js/jquery.form.js"></script>



    <!-- Peity -->
    <script src="__ASSETS__/js/plugins/peity/jquery.peity.min.js"></script>
    <!-- 弹窗js -->
     <script src="__ASSETS__/js/sweetalert.min.js"></script>
   

    <!-- 自定义js -->
    <script src="__ASSETS__/js/content.js?v=1.0.0"></script>

<script type="text/javascript">
                       
$("#ids").click(function(){

    if($('#ids').is(':checked')){

        $("[name='ids[]']").attr("checked",'true');//全选 
    }else{

        $("[name='ids[]']").removeAttr("checked");//全选 
    }
   
    });

$('a.js-ajax-del').bind('click', function (e) {
    var that = $(this),
        url = that.data('url');

        swal({   
            title: "您确定?",   
            text: "您将会删除一些数据！",   
            type: "warning",  
             showCancelButton: true,   
             closeOnConfirm: false,   
             showLoaderOnConfirm: true, 
         }, function(){   
            setTimeout(function(){     
                    common_ajax(url);
                 }, 1000); 
        });
        // swal({   
        //     title: "您确定?",   
        //     text: "您将会删除一些数据!",   
        //     type: "warning",   
        //     showCancelButton: true,   
        //     confirmButtonColor: "#DD6B55",   
        //     confirmButtonText: "确定，删掉他!",   
        //     closeOnConfirm: false }, 
        //     function(){   
        //         swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
        //     });
});


function common_ajax(url){
      $.ajax({
             type: "GET",
             url: url,
             dataType: "json",
             success: function(data){
                if(data == 1){
                    swal("删除成功"); 
                   window.location.reload();jh

                    
                }else{
                    swal("删除失败");  
                }
                
            },
            error:function(data){
                swal("访问失败");  
            }
         });
            
}

$('button.js-ajax-submit').bind('click', function (e) {
                e.preventDefault();
                /*var btn = $(this).find('button.js-ajax-submit'),
                        form = $(this);*/
                var btn = $(this),
                    form = btn.parents('form');
    
                    // console.log(form);
                    // var text = btn.text();
    
                    // //按钮文案、状态修改
                    // btn.text(text + '中...').attr('disabled', true).addClass('disabled');
                    // alert(form.attr('action'))
 
                form.ajaxSubmit({
                    url: btn.data('action') ? btn.data('action') : form.attr('action'),
                    //按钮上是否自定义提交地址(多按钮情况)
                    dataType: 'json',
                    beforeSubmit: function (arr, $form, options) {
                        var text = btn.text();
    
                        //按钮文案、状态修改
                        btn.text(text + '中...').attr('disabled', true).addClass('disabled');
                    },
                    success: function (data, statusText, xhr, $form) {
                        var text = btn.text();
    
                        //按钮文案、状态修改
                        console.log(data)
                       btn.removeClass('disabled').attr('disabled', false).text(text.replace('中...', '')).parent().find('span').remove(); 
                       if(data.status == 1){
                                 $('<span class="tips_error">' + data.content + '</span>').appendTo(btn.parent()).fadeIn('fast');
                       } 
                        if (data.url) {
                            //返回带跳转地址
                            if (window.parent.art) {
                                //iframe弹出页
                                window.parent.location.href = data.url;
                            } else {
                                window.location.href = data.url;
                            }
                        } 
                        // else {
                        //     if (window.parent.art) {
                        //         reloadPage(window.parent);
                        //     } else {
                        //         //刷新当前页
                        //         // reloadPage(window);
                        //     }
                        // } 
                    },
                     complete: function(XMLHttpRequest, textStatus){
                       //HideLoading();
                       var text = btn.text();
                       btn.removeClass('disabled').attr('disabled', false).text(text.replace('中...', ''));    
                    }
                });
            });




</script>




    
    

</body>

</html>




  