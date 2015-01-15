<?php
	session_start();
	require_once("../common/include.php");
	$vcode = new SaeVCode();
	if ($vcode === false && $debug == true)
	     var_dump($vcode->errno(), $vcode->errmsg());

	$_SESSION['vcode'] = strtolower($vcode->answer());
	$question  = $vcode->question();
	echo $question['img_url'];
	
	