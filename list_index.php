<?php 
	$mysql    =   new SaeMysql();   
	$type     =   intval(trim($_GET['type']));
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
		$sql  =  "SELECT COUNT(*) as `num` FROM `content` WHERE `content`.`type_id`=$type";
	}
	else
	{
		$sql  =  "SELECT COUNT(*) as `num` FROM `content`";
	}
	$row      =  $mysql->getLine($sql);
	$number   =  $row['num'];		//总记录数

	$pages    =  intval($number/$limit);
	if($number%$limit) $pages++;	//得到总页数
	if($page<0 || $page>$pages-1)
	{
		//echo "page:".$page."<br/>pages:".$pages;
?>
<script>
	$(".warn_text").html('没有数据可以查询');
	$('#WARN_INFO').modal();
</script>
<?php		
		exit();
	}
	if($type)
	{
		$sql  = "SELECT `content`.`id` , `name` as `type` , `title`,`username` 
				FROM `content` , `type`,`user`
				WHERE `content`.`type_id` = $type AND `type`.`id`=$type AND `content`.`user_id`=`user`.`id` ORDER BY `content`.`id` DESC LIMIT $start,$limit"; 
	}
	else
	{
		 $sql = "SELECT `content`.`id` , `name` as `type` , `title`,`username`
				FROM `content` , `type`,`user` WHERE `content`.`user_id`=`user`.`id` AND `content`.`type_id`=`type`.`id`
				ORDER BY `content`.`id` DESC LIMIT $start,$limit"; 
	}
	$result   =   $mysql->getData($sql);	
	//分页功能			
?>
<table class="table table-hover">
<thead>
	<th>ID</th>
	<th>Title</th>
	<th>Type</th>
	<th>Author</th>
</thead>
<tbody>
	<?php
		$i = 0;
		foreach ($result as $row) {
			echo "<tr>";
			echo "<td class=\"span1\">".++$i."</td>";
			echo "<td class=\"span1\"><code>".$row['type']."</code></td>";
			echo "<td class=\"span8\"><a href=\"./index.php?cmd=show&id=".$row['id']."\">".base64_decode($row['title'])."</a></td>";
			echo "<td class=\"span2\"><code>".$row['username']."</code></td>";
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
	?>
</tbody>
</table>
<ul class="pager span10 offset1">
<li class="previous <?php if(!$previous) echo "disabled";?>">
<a href="./index.php<?php echo $previous;?>">前一页</a>
</li>
<li class="next <?php if(!$next) echo "disabled";?>">
<a href="./index.php<?php echo $next;?>">后一页</a>
</li>
</ul>