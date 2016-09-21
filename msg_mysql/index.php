<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index</title>
</head>
<body>
	<?php
		if ($_SESSION) {
			header("Location: show.php");
			exit();
		}
	?>
	<center>
		<h3>index</h3>
		<form action="check.php" method="post">
		<table width="380" border="0" cellpadding="4">
			<tr>
				<td colspan="2" align="center">
					<a href="login.php">登录</a>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<a href="register.php">注册</a>
				</td>
			</tr>
		</table>
		</form>
	</center>
</body>
</html>