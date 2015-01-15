<?php
function send_email($username,$Email,$token){
		$arr = explode("@",$Email);
		$active_url = "http://codecloud.sinaapp.com/active.php?type=".$arr[1]."&name=".$arr[0]."&token=".$token;
		
		$title      =   $username."您好";  
		$content    =   "<p>".$username."您好：</p><p>这是一封来自<a href='http://codecloud.sinaapp.com'>CodeCloud</a>的用户激活邮件</p><p style=\"color:red\">如果您注册了该用户，请点击该链接激活账户：</p>  
							<p><a href=\"".$active_url."\">".$active_url."</a></p><p>若您没有注册该用户，可直接忽略该邮件</p>";  
				  
		$my_main_address    =   "qianshou.php@gmail.com";  
		$my_mail_password   =   "xuyanmin521";  
		$to_mail_address    =   $Email;  
		  
		$mail = new SaeMail();  
		
		$mail->setOpt(array("content_type"=>"HTML")); //设定发送的内容为html格式  
		$ret = $mail->quickSend( $to_mail_address , $title , $content , $my_main_address , $my_mail_password );  
		  
		//发送失败时输出错误码和错误信息  
		if ($ret === false )
		{  
		?>
<script>
	$(".warn_text").html('邮件发送失败，请重试。若多次邮件发送失败，请联系可爱的<a href=\"http://blog.csdn.net/qsyzb\">管理员</a>');
	$('#NOT_NULL').modal();
</script>
<?php        
			if($debug == true) 
			var_dump($mail->errno(), $mail->errmsg()); 
		}
		else   
		{  
			$mail_addr = "mail.".$arr[1];
			$mail_confirm = "<a href=\"http://".$mail_addr."\">邮件已发送，点击进入邮箱查看</a>";
			?>
<script>
	$(".warn_text").html('<?php echo $mail_confirm;?>');
	$('#NOT_NULL').modal();
</script>
<?php            
		}  
		$mail->clean(); // 清理内容，以便下次使用  
}
?>
	