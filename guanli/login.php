<?php session_start();?>
<?php require_once("../common/include.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="./img/code.png" />
    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 100px;
        padding-bottom: 10px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
    <![endif]-->
  </head>
<body>
    <div class="container-fluid span6 offset3" >
                <form class="form-horizontal" action="#" method="post" target="_self">
                  <div class="control-group">
                    <label class="control-label" for="username">用户名：</label>
                    <div class="controls">
                      <input type="text" id="username" placeholder="username" name="username" required>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputPassword">密码：</label>
                    <div class="controls">
                      <input type="password" id="inputPassword" placeholder="Password" name="password" required>
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                           <button type="submit" class="btn  btn-primary login_btn">登陆</button>
                    </div>
                  </div>
                  <input type="hidden" name="login" value="ok"/>
                  </form>
                 </div><!--login-->
    </div><!--container-fluid-->
    <!--用户名、邮箱、密码、验证码都不能为空-->
    <div id="NOT_NULL" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">提示：</h3>
    </div>
    <div class="modal-body" style="padding-top:50px; padding-bottom:50px">
    <p class="text-warning text-center warn_text">#</p>
    </div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    </div>
    </div>
</body>
<script>
 $(".login_btn").click(function(){
      if($("#username").val()!=''&& $("#inputPassword").val()!=''){
          return true;
      }else {
    $(".warn_text").text("邮箱、密码都不能为空，是不是那个忘记填了呀？思密达~");
        $('#NOT_NULL').modal();
        return false;
      }
   });

  $(".vcode_img").click(function(){
    var url='../fun/vcode.php';
    $.get(url,{},function(data){
      $(".vcode_img").attr('src',data);
    });
  });
$(".vcode_img").click();
</script>
</html>
<?php
if($_POST['login'] == "ok"){
  
      //获取邮箱地址和密码
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //对特殊字符进行过滤
    $username = htmlspecialchars(trim($username));
    $password = htmlspecialchars(trim($password));
    
    //查询数据库，验证用户
    $mysql  =   new SaeMysql();   
    
    $sql      =   "SELECT * FROM `user` WHERE `username`='$username' AND `type`=0"; 
    $row      =   $mysql->getLine($sql);
    //print_r($row);
    if($row)
    {
      $username =   $row['username'];
      $pwd      =   $row['password'];

      $key      =   md5(md5($password)."qianshou");
      if($pwd == $key)
        {
          $login_message = "<a href=\"./manage.php\"><button class=\"btn btn-success btn-large\">登陆成功，点击进入管理</button>";
          $_SESSION['user_id']  =  $row['id'];
          $_SESSION['username'] =  $row['username'];
        }
      else
      {
          $login_message = "密码错误，如果你不是管理员，请速速离开， 小心管理员回来打你~";
      }
    }
	$login_message = "用户不存在，如果你不是管理员，请速速离开， 小心管理员回来打你~";
    $mysql->closeDb();  
?>
<script>
  $(".warn_text").html('<?php echo $login_message;?>');
  $('#NOT_NULL').modal();
</script>
<?php
  }
?>