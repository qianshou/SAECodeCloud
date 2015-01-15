<?php require_once("head_nocheck.php");?>
<body >
<!--固定也页头部分-->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="row-fluid">
              <div class="span2 offset1">
             	 <a href="#" style="color:white;"><h4>代码云管理系统</h4></a>
              </div>
              <div class="span2 offset7">
              	<a href="" style="color:white;"><h4>Login&nbsp;&nbsp;<i class="icon-user icon-white"></i></h4></a>
              </div>
          </div>    		
        </div>
      </div>
    </div>
<!--固定也页头部分end-->
<?php 
	//从url获取数据
	$name  =  $_GET['name'];
	$type  =  $_GET['type'];
	$token =  $_GET['token'];
	
	//对数据进行过滤
	$name  =  htmlspecialchars(trim($name));
	$type  =  htmlspecialchars(trim($type));
	$token =  htmlspecialchars(trim($token));
	
	//合成邮箱地址
	$email = $name."@".$type;
	
	//从数据库取出数据
	$mysql  =   new SaeMysql();   
		
	$sql    =  "SELECT * FROM `user` WHERE `email`='$email' "; 

  $row =  $mysql->getLine($sql);

  $username    =  $row['username'];
  $regist_time =  $row['regist_time'];
  $password    =  $row['password'];

  $token_time  =  $row['token_time'];

  $key = md5($username.$regist_time.$password);

  if($key == $token )
  {
	
    if(time()<$token_time)
    {
      $sql   =   "UPDATE `user` SET `valid`=1 WHERE `email`='$email'";
      $mysql->runSql($sql);
      if($mysql->errno() != 0 && $debug == true)  
      {  
        echo "<br/>".$sql;
        die( "Error:" . $mysql->errmsg() );  
        $mysql->closeDb();  
      }  
      else   
      {  
        $active_message =  "您的账户已激活，请<a href=\"http://codecloud.sinaapp.com/login.php\">点击此处登陆</a>";
      }
    }
    else 
      $active_message =  "您的账户激活链接已经失效，请<a href=\"http://codecloud.sinaapp.com/login.php\">登陆</a>之后重新发送邮件";
  }
  else
    $active_message   =  "您输入的链接有误";
?>
<!--正文部分-->
<div class="container-fluid">
   <div class="row-fluid">
    <div id="ACTIVE" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
   </div><!--/row-->
</div><!--/.fluid-container-->
<!--正文部分结束-->
<?php require_once("footer.php");?>
<script>
	$(".warn_text").html('<?php echo $active_message; ?>');
	$('#ACTIVE').modal();
</script>
 </body>
</html>
