<?php
/*
code by reber
email:1070018473@qq.com
*/
session_start();
include("users.php");
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
		$name = htmlspecialchars($name);
		$pass = htmlspecialchars($pass);
		//echo $name."::::".$pass."<br />";

		if (empty($name) or empty($pass)) {
			echo '<script>alert("用户名和密码不能为空.")</script>';
			header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
			exit();
		} else {
			if (!array_key_exists($name, $users)) {
				echo '<script>alert("用户名不存在.")</script>';
				header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
				exit();
			} else {
				if ($pass !== $users[$name]['pass']) {
					echo '<script>alert("密码错误.")</script>';
					header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
					exit();
				} else {
					$_SESSION['name'] = $name;
					$_SESSION['pass'] = $pass;
					$_SESSION['uid'] = $users[$name]['id'];
					header("Location: show.php");
					exit();
				}
			}
		}
	?>
</body>
</html>
