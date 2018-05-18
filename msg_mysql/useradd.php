<?php
/*
code by reber
email:1070018473@qq.com
*/
	session_start();
	header("Content-Type:text/html; charset=utf-8"); 
	$config = require('./config.inc.php');
	require('./mysql.class.php');
	include("./common.php");


	if (empty($_POST['r_username']) or empty($_POST['r_password']) or empty($_POST['r_repassword'])) {
		echo '<script>alert("用户名和密码不能为空")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/register.php");
		exit();
	}
	$name = $_POST['r_username'];
	$pass = $_POST['r_password'];
	$rpass = $_POST['r_repassword'];
	// $name = htmlspecialchars($name,ENT_QUOTES);
	// $pass = htmlspecialchars($pass,ENT_QUOTES);
	// $rpass = htmlspecialchars($rpass,ENT_QUOTES);
	$name = filter($name);
	$pass = filter($pass);
	$rpass = filter($rpass);
	//echo $name."<br />".$pass;

	if (checklen($name) >20){
		echo '<script>alert("用户名太长.")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/register.php");
		exit();
	}


	if ($pass !== $rpass) {
		echo '<script>alert("两次密码不同.")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/register.php");
		exit();
	}

	$db = new mysql($config['DB_HOST'],$config['DB_USER'],$config['DB_PASS'],$config['DB_NAME'],$config['DB_CHARSET']);
	$conn = $db->connect();
	//$sql = "select username from user where username='$name'";
	$result = $db->select('username','user',"username='$name'");
	$row = mysql_fetch_assoc($result);
	//$num = mysql_num_rows($result);
	//var_dump($num);

	if ($row['username']) {
		echo '<script>alert("用户名已被注册.")</script>';
		$db->close($conn);
		header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/register.php");
		exit();
	} else {
		//$sql = "insert into user(username,password) values($name,$pass)";
		//mysql_query($sql);
		$np =array();
		$np['username'] = $name;
		$np['password'] = md5(md5((string)$pass));
		$num = $db->insert('user',$np);
		//echo mysql_affected_rows();
		if ($num === 1) {
			echo '<script>alert("注册成功,请登录.")</script>';
			$db->close($conn);
			header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/login.php");
			exit();
		}
	}
?>