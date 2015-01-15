<?php require_once("./fun/check_user.php");?>
<?php 
	if(!check_user())
	{
      echo "<a href=\"http://codecloud.sinaapp.com/login.php\">Please login first.</a>";
      exit();
	}
?>
<?php
	$type     =   intval(trim($_GET['type']));
	$mysql    =   new SaeMysql();   
		
	$id       =   $_SESSION['user_id'];
	$sql      =   "SELECT * FROM `user` WHERE `id`=$id";
	$u_row    =   $mysql->getLine($sql);
		
	$sql      =   "SELECT `type`.`id`,`name` , count( `type_id` ) AS `num` FROM `content` , `type` WHERE `content`.`type_id` = `type`.`id` AND `user_id`= '$id' GROUP BY `content`.`type_id`"; 
	$result   =   $mysql->getData($sql);
?>	
<div class="container" >
<p><img src="<?php echo $u_row['image'];?>" class="img-circle" width="160px"></p>
</div>
<ul class="nav nav-tabs nav-stacked">
<li>
	<a href="">用户名:
	<?php echo htmlspecialchars($u_row['username']);?>
    </a>
</li>
<li>
	<a href="">Email :<br/>
	<?php echo str_replace("@","#",$u_row['email']);?>
    </a>
</li>
<li>
	<a href="">座右铭：<br/>
	<?php echo htmlspecialchars($u_row['motto']);?>
    </a>
</li>
</ul>
<ul class="nav nav-tabs nav-stacked">
<?php
	if($type == 0)
		echo "<li class=\"active\"><a href=\"./index.php\"><h5>所有代码</h5></a></li>";
	else
		echo "<li><a href=\"./index.php\"><h5>所有代码</h5></a></li>";
	if($result)
	{
		foreach ($result as $row) {
			if($type == $row['id'])
				echo "<li class=\"active\"><a href=\"./user_index.php?type=".$row['id']."\"><h5>".$row['name']."</h5></a></li>";
			else
				echo "<li><a href=\"./user_index.php?type=".$row['id']."\"><h5>".$row['name']."</h5></a></li>";
		}
	}
	else
	{
		echo "当前没有数据可以查询";
	}
		

	$mysql->closeDb();  
?>
</ul>