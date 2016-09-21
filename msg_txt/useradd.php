<?php
	session_start();
	include("users.php");
	header("Content-Type:text/html; charset=utf-8"); 
	

	if (empty($_POST['r_username']) or empty($_POST['r_password']) or empty($_POST['r_repassword'])) {
		echo '<script>alert("用户名和密码不能为空")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg/register.php");
		exit();
	}
	$name = $_POST['r_username'];
	$pass = $_POST['r_password'];
	$rpass = $_POST['r_repassword'];
	//echo $name."<br />".$pass;

	if ($pass !== $rpass) {
		echo '<script>alert("两次密码不同.")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg/register.php");
		exit();
	}

	$re = '/^[\w]{2,10}$/i';
	if (!preg_match($re, $name) or !preg_match($re,$pass)) {
		echo '<script>alert("用户名和密码应为数字、字母、下划线.")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg/register.php");
		exit();
	}

	if (array_key_exists($name, $users)) {
		echo '<script>alert("用户名已被注册.")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg/register.php");
		exit();
	}

	//存储用户信息
	$f_users = fopen("users.php", "r");
	$arr_users = array();
	while($str = fgets($f_users)) {
		array_push($arr_users, $str);
	}
	fclose($f_users);
	//var_dump($arr_users);
	
	$uid = count($users) + 1;
	$str = sprintf("\t\"%s\" => array(\"id\" => %d, \"pass\" => \"%s\"),\n", $name, $uid, $pass);
	$t1 = array_pop($arr_users);
	$t2 = array_pop($arr_users);
	array_push($arr_users, $str);
	array_push($arr_users, $t2);
	array_push($arr_users, $t1);
	//var_dump($arr_users);
	
	file_put_contents("users.php", $arr_users);

	
	echo '<script>alert("注册成功,请登录.")</script>';
	header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
	
?>