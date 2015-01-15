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
		
	$sql      =   "SELECT `title` , `name` AS `type` , `code` , `comment` , `user_id`
					FROM `content` , `type`
					WHERE `content`.`id` ='$id'
					AND `content`.`type_id` = `type`.`id`"; 
	$row   =   $mysql->getLine($sql);	
	
	$title   =   htmlspecialchars(base64_decode($row['title']));
	$code    =   htmlspecialchars(base64_decode($row['code']));
	$comment =   htmlspecialchars(base64_decode($row['comment']));

	if($row['user_id']!=$_SESSION['user_id'])
	{
		$error_info = "您无权修改不属于您的文章";
?>
<script>
    $(".warn_text").html('<?php echo $error_info; ?>');
    $('#WARN_INFO').modal();
</script>
<?php
		exit();
	}
	$sql      =   "SELECT * FROM `type` ORDER BY `name`"; 
	$result   =   $mysql->getData($sql);	
?>
<form class="form-horizontal" method="post" action="#" target="_self">
    <div class="control-group">
        <label class="control-label" for="title">标题</label>
        <div class="controls">
          <input class="span10" type="text" id="title" name="title" placeholder="title" value="<?php echo $title?>" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="type">类型</label>
        <div class="controls">
			<select name="type_value" class="span4">
				<?php	
					foreach ($result as $row1)  
				    { 
				    	if($row['type']==$row1['name'])
				    	{
				    		echo "<option value=\"".$row1['id']."\"selected>".$row1['name']."</option>";
				    	}
				    	else
				    	{
				        	echo "<option value=\"".$row1['id']."\">".$row1['name']."</option>";
				    	}
				    }
				?>
			</select>	
        </div>
    </div>
       <div class="control-group">
        <label class="control-label" for="title">问题描述</label>
        <div class="controls">
          <textarea class="span10" name="comment" rows="5"><?php echo $comment;?></textarea>
        </div>
    </div>   
    <div class="control-group">
        <label class="control-label" for="title">代码</label>
        <div class="controls">
          <textarea class="span10" name="code" rows="15"><?php echo $code;?></textarea>
        </div>
    </div>
     <input type="hidden" name="update_sub" value="confirm"/> 
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary btn-large">提交</button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <button type="reset" class="btn btn-large">重置</button>
    </div>
</form>
<?php 
	if($_POST['update_sub'] == "confirm"){
		$title     =  $_POST['title'];
		$type_value =  $_POST['type_value'];
		$code      =  $_POST['code'];
		$comment   =  $_POST['comment'];
		
		$type_value  =  trim($type_value);

		$type_id   =  $type_value;
		$user_id   =  $_SESSION['user_id'];
		$title     =  base64_encode($title);
		$code      =  base64_encode($code);
		$comment   =  base64_encode($comment);
		$date      =  time();

		$sql = "UPDATE `content` SET `update_time`=$date,`title`='$title',`type_id`='$type_id',`code`='$code',`comment`='$comment' WHERE `id`='$id'";
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
		$mysql->closeDb();  
	}
?>