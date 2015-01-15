<?php session_start(); ?>
<?php require_once("./common/include.php");?>
<?php require_once("./fun/check_user.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <link rel="shortcut icon" href="./img/code.png" />
    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/docs.css" rel="stylesheet">
    <link href="google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="google-code-prettify/prettify.js"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 10px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
    <![endif]-->
  </head>
 <body onload="prettyPrint()">
<!--固定也页头部分-->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="row-fluid">
              <div class="span2 offset1">
             	 <a href="./index.php" style="color:white;"><h4>代码云管理系统</h4></a>
              </div>
              <div class="span2 offset7">
              	<h4>
                <?php 
					if(check_user())
					{
						echo "<a href=\"./user_index.php\" style=\"color:white;\">".$_SESSION['username'];
					}
					else
					{
						echo "<a href=\"./login.php\" style=\"color:white;\">登陆/注册";
					}
				?>
              	<i class="icon-user icon-white"></i>
                </a>
                </h4>
              </div>
          </div>    		
        </div>
      </div>
    </div>
<!--固定也页头部分end-->