<?php 
	if(!$tag)
	{
      echo "<a href=\"http://codecloud.sinaapp.com/login.php\">Please login first.</a>";
      exit();
	}
?>
<?php 
	$mysql    =   new SaeMysql();   
	$type     =   intval(trim($_GET['type']));
	$user_id  =   $_SESSION['user_id'];
	if(!isset($_GET['page']))
	{
		$page = 0;
	}
	else
	{
		$page =   intval(htmlspecialchars(trim($_GET['page'])));
	}
	
	$start    =  $page*$limit;

	if($type)
	{
		$sql  =  "SELECT COUNT(*) as `num` FROM `content` WHERE `content`.`type_id`=$type AND `user_id`=$user_id";
	}
	else
	{
		$sql  =  "SELECT COUNT(*) as `num` FROM `content` WHERE `user_id`=$user_id";
	}
	$row      =  $mysql->getLine($sql);
	$number   =  $row['num'];		//总记录数

	$pages    =  intval($number/$limit);
	if($number%$limit) $pages++;	//得到总页数
	if($page<0 || $page>$pages-1)
	{
		//echo "page:".$page."<br/>pages:".$pages;
		echo "没有数据可以查询";	
		exit();
	}
	if($type)
	{
		echo $sql  = "SELECT `content`.`id` , `name` as `type` , `title`,`username` 
				FROM `content` , `type`,`user`
				WHERE `content`.`type_id` = $type AND `type`.`id`=$type AND `content`.`user_id`=`user`.`id` AND `user`.`id`=$user_id ORDER BY `content`.`id` DESC LIMIT $start,$limit"; 
	}
	else
	{
		 $sql = "SELECT `content`.`id` , `name` as `type` , `title`,`username`
				FROM `content` , `type`,`user` WHERE `content`.`user_id`=`user`.`id` AND `content`.`type_id`=`type`.`id`  AND `user`.`id`=$user_id ORDER BY `content`.`id` DESC LIMIT $start,$limit"; 
	}
	$result   =   $mysql->getData($sql);	
	//分页功能			
?>
<table class="table table-hover">
<thead>
	<th>ID</th>
	<th>Title</th>
	<th>Type</th>
	<th>Edit</th>
	<th>Delete</th>
</thead>
<tbody>
	<?php
		$i = 0;
		if($result)
		{
			foreach ($result as $row) {
				echo "<tr>";
				echo "<td class=\"span1\">".++$i."</td>";
				echo "<td class=\"span1\"><code>".$row['type']."</code></td>";
				echo "<td class=\"span8\"><a href=\"./user_index.php?cmd=show&id=".$row['id']."\">".base64_decode($row['title'])."</a></td>";
				echo "<td class=\"span1\"><a href=\"./user_index.php?cmd=edit&id=".$row['id']."\"><i class=\"icon-edit\"></i></a></td>";
				echo "<td class=\"span1\"><a href=\"./user_index.php?cmd=delete&id=".$row['id']."\"><i class=\"icon-remove\"></i></td>";
				echo "</tr>";
			}
			if($page<=0)
				$previous = "";
			else
			{
				$new_page = $page-1;
				$previous = "?page=".$new_page;
			}
			if($page>=$pages-1 || $pages==1)
				$next = "";
			else
			{
				$new_page = $page+1;
				$next = "?page=".$new_page;
			}
			if($type)
			{
				if($previous!="")$previous = $previous."&type=".$type;
				if($next!="")    $next     = $next."&type=".$type;
			}
	//		echo "page:".$page."<br/>"."pages:".$pages."<br/>";
	//		echo "previous:".$previous."<br/>"."next:".$next."<br/>";
		}
		else
		{
			echo "没有数据可以查询";
		}
?>
</tbody>
</table>
<ul class="pager span10 offset1">
<li class="previous <?php if(!$previous) echo "disabled";?>">
<a href="./user_index.php<?php echo $previous;?>">前一页</a>
</li>
<li class="next <?php if(!$next) echo "disabled";?>">
<a href="./user_index.php<?php echo $next;?>">后一页</a>
</li>
</ul>