<?php
/*
code by reber
email:1070018473@qq.com
*/
	session_start();
	$config = require('./config.inc.php');
	require('./mysql.class.php');
	include("./common.php");

	//echo $config['DB_TYPE'].$config['DB_HOST'].$config['DB_NAME'].$config['DB_USER'].$config['DB_PASS'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>checkpass</title>
</head>
<body>
	<?php
		$name = $_POST['log_name'];
		$pass = $_POST['log_pass'];
		$name = filter($name);
		$pass = filter($pass);
		$pass = md5(md5((string)$pass));


		if (empty($name) or empty($pass)) {
			echo '<script>alert("用户名和密码不能为空.")</script>';
			header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/login.php");
			exit();
		} else {
			$db = new mysql($config['DB_HOST'],$config['DB_USER'],$config['DB_PASS'],$config['DB_NAME'],$config['DB_CHARSET']);
			$conn = $db->connect();

			$result = $db->select('username','user',"username='$name'");
			$row = mysql_fetch_assoc($result);
			print_r($row);
			if (!$row['username']){
				echo '<script>alert("用户名不存在.")</script>';
				echo "<script language='javascript'>window.history.back(-1);</script>";
				exit();
			} else {
				// $sqlp = "select id,password from user where username='$name'";
				// $result = mysql_query($sqlp);
				// $row = mysql_fetch_row($result);
				$result = $db->select('id,password','user',"username='$name'");
				$row = mysql_fetch_assoc($result);

				if ($pass ===  $row['password']) {
					$_SESSION['name'] = $name;
					$_SESSION['uid'] = $row[id];
					//echo $_SESSION['name'].":::".$_SESSION['uid'];
					$db->close($conn);
					echo "<script language='javascript'>window.location.href='show.php';</script>";
					exit();
				} else {
					$db->close($conn);
					echo '<script>alert("密码错误.")</script>';
					echo "<script language='javascript'>window.history.back(-1);</script>";
					exit();
				}
			}
		}
	?>
</body>
</html>