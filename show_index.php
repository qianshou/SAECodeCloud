<?php
	$id  =  htmlspecialchars(trim($_GET['id']));

	$mysql    =   new SaeMysql();   
		
		
	$sql      =   "SELECT `title` ,`update_time`, `name` AS `type` , `code` , `comment` , `user_id`,`username`
					FROM `content` , `type`,`user`
					WHERE `content`.`id` ='$id' AND `content`.`type_id` = `type`.`id` AND `content`.`user_id`=`user`.`id`"; 
					
	$row   =   $mysql->getLine($sql);	

	$title   =   htmlspecialchars(base64_decode($row['title']));
	$code    =   htmlspecialchars(base64_decode($row['code']));
	$comment =   htmlspecialchars(base64_decode($row['comment']));
	$date   =   date("Y-m-d",$row['update_time']);
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
<div class="container-fluid" style="margin-top:20px;margin-bottom:20px;">
<!-- 多说评论框 start -->
	<div class="ds-thread" data-thread-key="请将此处替换成文章在你的站点中的ID" data-title="请替换成文章的标题" data-url="请替换成文章的网址"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"codecloudqs"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		 || document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- 多说公共JS代码 end -->

</div>

