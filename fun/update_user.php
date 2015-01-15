<?php 
  if(!$tag)
  {
      echo "<a href=\"http://codecloud.sinaapp.com/login.php\">Please login first.</a>";
      exit();
  }
?>
<div class="container span10 offset1" style="margin-top:50px">
<form class="form-horizontal"  action="#" method="post" target="_self" enctype="multipart/form-data">
    <div class="control-group">
        <label class="control-label" for="username">用户名</label>
        <div class="controls">
          <input type="text" id="username" name="username" placeholder="username" class="span8">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="password">密码</label>
        <div class="controls">
          <input type="password" id="password" name="password" placeholder="Password"  class="span8">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="motto">座右铭</label>
        <div class="controls">
          <input type="text" id="motto" name="motto" placeholder="写一句激励自己的话吧"  class="span8">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="image">上传头像</label>
        <div class="controls">
          <input type="file" id="image" name="image"  class="span4">
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
               <button type="submit" class="btn btn-large btn-primary reg_submit_btn" name="reg_btn">确&nbsp;&nbsp;&nbsp;&nbsp;认</button>
        </div>
      </div>
      <input type="hidden" name="update_user_sub" value="sub_confirm"/>
</form>
</div>
<?php
  $mysql    =   new SaeMysql();  

  if($_POST['update_user_sub'] == "sub_confirm"){
    $username   =  $_POST['username'];
    $user_id    =  $_SESSION['user_id'];
    $password   =  $_POST['password'];
    $motto      =  $_POST['motto'];

    $username   =  trim($username);
    $password   =  trim($password);
    $motto      =  trim($motto);

    if($username)
    {
      $sql = "UPDATE `user` SET `username`='$username' WHERE `id`=$user_id";
      $mysql->runSql($sql);
    }
	if($mysql->errno() != 0 && $debug == true)  
	{  
		echo "<br/>".$sql;
		die( "Error:" . $mysql->errmsg() );  
	}  
		
    if($password)
    {
      $pwd = md5(md5($password)."qianshou");
      $sql = "UPDATE `user` SET `password`='$pwd' WHERE `id`=$user_id";
      $mysql->runSql($sql);
    }
	if($mysql->errno() != 0 && $debug == true)  
	{  
		echo "<br/>".$sql;
		die( "Error:" . $mysql->errmsg() );  
	}  
	
    if($motto)
    {
      $sql = "UPDATE `user` SET `motto`='$motto' WHERE `id`=$user_id";
      $mysql->runSql($sql);
    }
	if($mysql->errno() != 0 && $debug == true)  
	{  
		echo "<br/>".$sql;
		die( "Error:" . $mysql->errmsg() );  
	}  

  if($_FILES['image']['name']!="")
  {
  //执行上传头像操作
   if ($_FILES["image"]["error"] > 0 && $debug == true)  
      {  
        echo "Error: " . $_FILES["image"]["error"] . "<br />";  
      }  
    else  
      { //文件成功上传到SAE的临时服务器中  
           $file_name = $_FILES["image"]["name"];  
           $type =  $_FILES["image"]["type"];  
           $size =  ($_FILES["image"]["size"] / 1024)." Kb";  
           $temp_stored = $_FILES["image"]["tmp_name"];  
             
           $valid_type = "..image/pjpeg,image/gif,image/jpeg,image/bmp,image/png";  
           if(strpos($valid_type,$type))  
           {//上传的是图片文件  
                $s = new SaeStorage();  
                $src_name = $temp_stored;  
                $arr =  explode(".",$file_name); 
				        $des_name = time().".".$arr[1]; 
				
                $s->upload( 'codecloud' , "$des_name" , "$src_name" );  
                $url = $s->getUrl( 'codecloud' , "$des_name" ); 
                echo $sql = "UPDATE `user` SET `image`='$url' WHERE `id`=$user_id";  
                $mysql->runSql($sql);
                  if($mysql->errno() != 0 && $debug == true)  
                  {  
                    echo "<br/>".$sql;
                    die( "Error:" . $mysql->errmsg() );  
                  } 
                  else
                  {
                    echo "<script>window.location=\"./user_index.php\"</script>";
                  } 

           }  
           else  
           {  
                echo $error_info = $type."is invalid";    
           }   
  		}
  	}
}
$mysql->closeDb();  