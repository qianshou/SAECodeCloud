<?php
	require_once("./fun/send_mail.php");
	if($_POST['login'] == "ok"){
	
	    //获取邮箱地址和密码
		$email    = $_POST['email'];
		$password = $_POST['password'];
		
		//对特殊字符进行过滤
		$email    = htmlspecialchars(trim($email));
		$password = htmlspecialchars(trim($password));
		
		//查询数据库，验证用户
		$mysql  =   new SaeMysql();   
		
		$sql      =   "SELECT * FROM `user` WHERE `email`='$email'"; 
		$row      =   $mysql->getLine($sql);
		//print_r($row);
		if($row)
		{
			$username =   $row['username'];
			$pwd      =   $row['password'];
			$valid    =   $row['valid'];
			$token    =   $row['token'];
			$key      =   md5(md5($password)."qianshou");
			if($pwd == $key)
				{
					if($valid==0)
					{
						$arr = explode("@",$email);
						$mail_addr = "mail.".$arr[1];
						send_email($username,$email,$token);
						$login_message = "您的账户还没有激活，系统已经向您的邮箱再次发送了激活邮件，请<a href=\"http://".$mail_addr."\">前往查看</a>。";
					}
					else
					{
						$login_message = "<a href=\"./user_index.php\"><button class=\"btn btn-success btn-large\">登陆成功，点击进入系统</button>";
						$_SESSION['user_id']  =  $row['id'];
 						$_SESSION['username'] =  $row['username'];
						$_SESSION['email']    =  $row['email'];
						$_SESSION['image']    =  $row['image'];
						$_SESSION['motto']    =  $row['motto'];
						$_SESSION['token']    =  $row['token']; 
					}
				}
			else
				$login_message = "用户名或密码错误";
		}
		else
		{
			$login_message = "用户不存在，<a href=\"http://codecloud.sinaapp.com/login.php\">点击此处注册</a>";
		}
		$mysql->closeDb();  
?>
<script>
	$(".warn_text").html('<?php echo $login_message;?>');
	$('#NOT_NULL').modal();
</script>
<?php
	}
?>