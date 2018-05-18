<!DOCTYPE html>
<html lang="en">
<head>
<!-- code by reber
email:1070018473@qq.com -->
	<meta charset="UTF-8">
	<title>注册</title>
</head>
<body>
	<center>
		<h3>注册</h3>
		<form action="useradd.php" method="post">
		<table width="380" border="0" cellpadding="4">
			<tr>
				<td align="right">名字：</td>
				<td><input type="text" name="r_username"/></td>
			</tr>
			<tr>
				<td align="right">密码：</td>
				<td><input type="password" name="r_password"/></td>
			</tr>
			<tr>
				<td align="right">确认密码：</td>
				<td><input type="password" name="r_repassword"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="注册"/>&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" value="重置"/>
				</td>
			</tr>
		</table>
		</form>
	</center>
	<?php include("foot.php");?>