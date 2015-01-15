<?php 
	if(!$tag)
	{
      echo "<a href=\"http://codecloud.sinaapp.com/login.php\">Please login first.</a>";
      exit();
	}
?>
<?php
	$id  =  htmlspecialchars(trim($_GET['id']));

	$user_id = $_SESSION['user_id'];

	$mysql    =   new SaeMysql();   
		
	$sql      =   "SELECT `title` ,`update_time`, `name` AS `type` , `code` , `comment` , `user_id`,`username`
					FROM `content` , `type`,`user`
					WHERE `content`.`id` ='$id' AND `content`.`type_id` = `type`.`id` AND `content`.`user_id`=`user`.`id` AND `content`.`user_id`=$user_id"; 

	$row   =   $mysql->getLine($sql);	

	$title   =   htmlspecialchars(base64_decode($row['title']));
	$code    =   htmlspecialchars(base64_decode($row['code']));
	$comment =   htmlspecialchars(base64_decode($row['comment']));

	$date  =   date("Y-m-d",$row['update_time']);
?>
<div class="container-fluid">
<p class="span11 offset1"><h3><?php echo $title;?></h3></p>
<p>
<span class="span4">代码类型:<code><?php echo $row['type'];?></code></span>
<span class="span4">作者：<code><?php echo $row['username'];?></code></span>
<span class="span4">发布时间:<code><?php echo $date;?></code></span>
</p>
</div>
<hr/>
<div class="container-fluid" style="margin-top:20px;margin-bottom:20px;">
<p><strong>问题描述：</strong></p>
<?php echo nl2br($comment);?>
</div>

<div class="container-fluid" style="margin-top:20px;margin-bottom:20px;">
<p><strong>代码内容：</strong></p>
<pre class="prettyprint linenums ">
<?php echo $code;?>
</pre>
</div>

<?php
if($row['user_id']==$_SESSION['user_id']){
?>
<div class="container-fluid" style="margin-top:20px;margin-bottom:20px;">
<a  href="./user_index.php?cmd=edit&id=<?php echo $id;?>"><button class="btn btn-primary">修改代码</button></a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a  href="./user_index.php?cmd=delete&id=<?php echo $id;?>"><button class="btn btn-danger">删除代码</button></a>
</div>
<?php
 }
?>