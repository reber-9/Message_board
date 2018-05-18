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
	<title>登录</title>
</head>
<body>
	<?php
		if (isset($_SESSION['uid'])) {
			header("location:show.php");
		}
	?>
	<center>
		<h3>登录</h3>
		<form action="checkpass.php" method="post">
		<table width="380" border="0" cellpadding="4">
			<tr>
				<td align="right">用户名：</td>
				<td><input type="text" name="log_name"/></td>
			</tr>
			<tr>
				<td align="right">密码：</td>
				<td><input type="password" name="log_pass"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="登录"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="register.php">注册</a>
				</td>
			</tr>
		</table>
		</form>
	</center>
	<?php include("foot.php");?>