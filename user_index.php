<?php require_once("head.php");?>
<!--弹出提示的模态对话框-->
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
<!--正文部分-->
<div class="container-fluid">
   <div class="row-fluid">
            <div class="span2 offset1 ">
			<?php require_once("left.php");?>	
            </div><!--/span-->
             <div class="span9">
             <?php 
                $tag = true;
                $cmd = $_GET['cmd'];
                switch ($cmd) {
                  case 'list':
                    require_once("./fun/list.php");
                    break;
                   case 'edit':
                    require_once("./fun/edit.php");
                    break;
                   case 'insert':
                    require_once("./fun/insert.php");
                    break;
                   case 'show':
                    require_once("./fun/show.php");
                    break;
                  case 'delete':
                    require_once("./fun/delete.php");
                    break;
                  case 'update_user':
                    require_once("./fun/update_user.php");
                    break;			
                  default:
                    require_once("./fun/list.php");
                    break;
                }
             ?>
             </div><!--/span-->
   </div><!--/row-->
</div><!--/.fluid-container-->
<!--正文部分结束-->
<?php require_once("footer.php");?>
 </body>
</html>
