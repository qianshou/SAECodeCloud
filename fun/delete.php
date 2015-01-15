<?php 
	if(!$tag)
	{
      echo "<a href=\"http://codecloud.sinaapp.com/login.php\">Please login first.</a>";
      exit();
	}
?>
<?php
	$id  =  htmlspecialchars(trim($_GET['id']));
	$mysql    =   new SaeMysql();   
	$sql      =   "SELECT * FROM `content` WHERE `id`=$id"; 
	$row   =   $mysql->getLine($sql);				
	if($row['user_id']!=$_SESSION['user_id'])
	{
		$error_info = "您不能删除不属于您的文章";
?>
<script>
    $(".warn_text").html('<?php echo $error_info; ?>');
    $('#WARN_INFO').modal();
</script>
<?php
	}
	else
	{
		$sql = "DELETE FROM `content` WHERE `id`='$id'";
		$mysql->runSql($sql);    //执行插入数据的操作  
		  
		if($mysql->errno() != 0 && $debug == true)  
		{  
			echo "<br/>".$sql;
			die( "Error:" . $mysql->errmsg() );  
		}  
		else   
		{
?>
<script type="text/javascript">
	window.location="../user_index.php";
</script>
<?php				  
		}
	}
	$mysql->closeDb();  