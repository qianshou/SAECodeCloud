<?php 
	if(!$tag)
	{
      echo "<a href=\"http://codecloud.sinaapp.com/login.php\">Please login first.</a>";
      exit();
	}
?>
<?php 
	$mysql    =   new SaeMysql();   
		
	$sql      =   "SELECT * FROM `type` ORDER BY `name`"; 
	$result   =   $mysql->getData($sql);				
?>
<form class="form-horizontal" method="post" action="#" target="_self">
    <div class="control-group">
        <label class="control-label" for="title">标题</label>
        <div class="controls">
          <input class="span10" type="text" id="title" name="title" placeholder="title" required>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="type">类型</label>
        <div class="controls">
			<select name="type_value" class="span4">
				<?php	
					foreach ($result as $row)  
				    {  
				        echo "<option value=\"".$row['id']."\">".$row['name']."</option>";
				    }
				?>
			</select>	
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="title">问题描述</label>
        <div class="controls">
          <textarea class="span10" name="comment" rows="5"  placeholder="Type your comment here……"></textarea>
        </div>
    </div>  
    <div class="control-group">
        <label class="control-label" for="title">内容</label>
        <div class="controls">
          <textarea class="span10" name="code" rows="15"  placeholder="Paste your code here……"></textarea>
        </div>
    </div> 
    <input type="hidden" name="insert_sub" value="confirm"/> 
	<div class="form-actions">
	    <button type="submit" class="btn btn-primary btn-large">提交</button>&nbsp;&nbsp;&nbsp;&nbsp;
	    <button type="reset" class="btn btn-large">重置</button>
    </div>
</form>
<?php 
	if($_POST['insert_sub'] == "confirm"){
		$title     =  $_POST['title'];
		$type_value =  $_POST['type_value'];
		$code      =  $_POST['code'];
		$comment   =  $_POST['comment'];
		
		$type_value  =  htmlspecialchars(trim($type_value));

		$type_id   =  $type_value;
		$user_id   =  $_SESSION['user_id'];
		$title     =  base64_encode($title);
		$code      =  base64_encode($code);
		$comment   =  base64_encode($comment);

		$date      = time();
		$sql = "INSERT INTO `content` VALUES('',$date,'$title',$type_id,$user_id,'$code','$comment')";
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