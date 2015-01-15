<?php

function check_user()
{
	$username  =  $_SESSION['username'];
	$email     =  $_SESSION['email'];
	$token     =  $_SESSION['token'];
	if($username&&$email&&$token)
	{
		//查询数据库，验证用户
		$mysql  =   new SaeMysql();   
		
		$sql      =   "SELECT * FROM `user` WHERE `email`='$email'"; 
		$row      =   $mysql->getLine($sql);
		$key      =   $row['token'];
		if($key == $token)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
}
