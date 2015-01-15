<?php session_start();?>
<?php require_once("../common/include.php");?>
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
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 100px;
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
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/js/html5shiv.js"></script>
    <![endif]-->
  </head>
<body>
<div class="tabbable"> 
<ul class="nav nav-tabs">
<li class="active"><a href="#show_user" data-toggle="tab">查看用户</a></li>
<li class=""><a href="#create_user" data-toggle="tab">新建用户</a></li>
<li><a href="#tab2" data-toggle="tab">查看记录</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab1">
<p>I'm in Section 1.</p>
</div>
<div class="tab-pane" id="tab2">
<p>Howdy, I'm in Section 2.</p>
</div>
</div>
</div>