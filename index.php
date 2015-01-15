<?php require_once("head_nocheck.php");?>
<?php

  $cmd  =  htmlspecialchars(trim($_GET['cmd']));

	$mysql    =   new SaeMysql();   
	
	$sql      =   "SELECT `id`,`name` FROM  `type`  GROUP BY `id`"; 
	$result1   =   $mysql->getData($sql);

?>	
<div id="WARN_INFO" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">提示：</h3>
    </div>
    <div class="modal-body" style="padding-top:50px; padding-bottom:50px">
    <p class="text-warning text-center warn_text">#</p>
    </div>
    <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    </div>
</div>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2 offset1">
     <?php require_once("left_index.php");?>
    </div>
    <div class="span9">
    <?php
      switch ($cmd) {
        case 'show':
          require_once("show_index.php");
          break;
        
        default:
          require_once("list_index.php");
          break;
      }
	 ?>
    </div>
  </div>
</div>
<!--正文部分结束-->
	<?php require_once("footer.php");?>
</body>
</html>