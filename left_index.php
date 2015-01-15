<?php
	$type     =   intval(trim($_GET['type']));
	$mysql    =   new SaeMysql();   
		
	$sql      =   "SELECT `type`.`id`,`name`,count(*)  FROM `type`,`content` WHERE `content`.`type_id`=`type`.`id` GROUP BY `type_id`"; 
	$result   =   $mysql->getData($sql);
?>	
<ul class="nav nav-tabs nav-stacked">
<?php
	if($type == 0)
		echo "<li class=\"active\"><a href=\"./index.php\"><h5>所有代码</h5></a></li>";
	else
		echo "<li><a href=\"./index.php\"><h5>所有代码</h5></a></li>";
		
	foreach ($result as $row) {
		if($type == $row['id'])
			echo "<li class=\"active\"><a href=\"./index.php?type=".$row['id']."\"><h5>".$row['name']."</h5></a></li>";
		else
			echo "<li><a href=\"./index.php?type=".$row['id']."\"><h5>".$row['name']."</h5></a></li>";
	}
	$mysql->closeDb();  
?>
</ul>