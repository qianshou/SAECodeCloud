<?php
	require_once("./fun/send_mail.php");
	if($_POST['sub'] == "sub_confirm"){
		$username = $_POST['username'];
		$Email    = $_POST['Email'];
		$password = $_POST['password'];
		$vcode    = $_POST['vcode'];
		
		$username = htmlspecialchars(trim($username));
		$Email    = htmlspecialchars(trim($Email));
		$password = htmlspecialchars(trim($password));
		$vcode    = htmlspecialchars(trim($vcode));
		
		//检查邮箱格式
		$patton  =  "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/";
		preg_match($patton,$Email,$arr);
		if(!$arr)
		{
?>
	<script>
        $(".warn_text").text("邮箱格式不符合要求");
        $('#NOT_NULL').modal();
    </script>
<?php
			exit();
		}
		
		//检查验证码
		$vcode = strtolower($vcode);
		if($vcode != $_SESSION['vcode'])
		{
?>
	<script>
        $(".warn_text").text("验证码不正确");
        $('#NOT_NULL').modal();
    </script>
<?php
			exit();
		}
		//检测邮箱是否注册过
		$mysql  =   new SaeMysql();   
		
		$sql    =  "SELECT * FROM `user` WHERE `email`='$Email' "; 
		
		$result =  $mysql->getLine($sql); 
		
		if($result){
			$mail_warn = "该邮箱已经注册过，直接登录请<a href=\"http://codecloud.sinaapp.com/login.php\">戳这里</a>，找回密码请<a href=\"http://blog.csdn.net/qsyzb\">戳这里</a>。";
?>
	<script>
        $(".warn_text").html('<?php echo $mail_warn; ?>');
        $('#NOT_NULL').modal();
    </script>
<?php
			exit();
		}
		
		$type = 1;
		
		$password = md5(md5($password)."qianshou");
		
		$regist_time = time();
		
		$token = md5($username.$regist_time.$password);
		
		$token_time = $regist_time + 60*60*2;
		
		//插入用户数据，但此时为无效用户
		    
		$sql    =   "INSERT INTO `user`(`id`,`type`,`username`,`email`,`password`,`valid`,`token`,`regist_time`,`token_time`) 				                                 VALUES('','$type','$username','$Email','$password',0,'$token',$regist_time,$token_time)";  
		  
		$mysql->runSql($sql);    //执行插入数据的操作  
		  
		if($mysql->errno() != 0 && $debug == true)  
		{  
			echo "<br/>".$sql;
			die( "Error:" . $mysql->errmsg() );  
		}  
		else   
		{  
			//用户数据插入成功，接下来向用户邮箱发送邮件
			send_email($username,$Email,$token);			
		}
		$mysql->closeDb();  
	}
