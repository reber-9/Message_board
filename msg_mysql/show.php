<?php
/*
code by reber
email:1070018473@qq.com
*/
	session_start();
	ini_set('date.timezone', 'Asia/Shanghai');
	$config = require('./config.inc.php');
	require('./mysql.class.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的留言板</title>
</head>
<body>
	<center>
		<h3>留言板</h3>
		<h4><a href="#001" title="去底部留言">↓↓↓↓↓</a></h4>

		<?php
			if ($_SESSION['uid']) {
				echo "Welcome:".$_SESSION['name']."<a href='logout.php'>(退出登录)</a><br />";
				//var_dump($_SESSION['name']);
			} else {
				echo "<a href='logout.php'>请登录</a>";
			}
		?>

		<hr>
		
		<table border="1" width="700">
			<tr>
				<th>author</th>
				<th>title</th>
				<th>content</th>
				<th>IP</th>
				<th>date</th>
				<th>operation</th>
			</tr>
			<?php
				$db = new mysql($config['DB_HOST'],$config['DB_USER'],$config['DB_PASS'],$config['DB_NAME'],$config['DB_CHARSET']);
				$conn = $db->connect();
				//$sql = "select user.username,msg.id,msg.uid,msg.title,msg.content,msg.ip,msg.date from user,msg where user.id=msg.uid order by msg.date";
				$column = "user.username,msg.id,msg.uid,msg.title,msg.content,msg.ip,msg.date";
				//$result = mysql_query($sql);
				$result = $db->select($column,'user,msg','user.id=msg.uid order by msg.date');

				$_SESSION['session'] = md5(time().rand(100,999));
				//echo $_SESSION['session'];

				while ($row = mysql_fetch_assoc($result)) {
					//print_r($row);
					echo "<tr>";
						echo "<td>";
							echo $row['username'];
						echo "</td>";
						echo "<td>";
							echo $row['title'];
						echo "</td>";
						echo "<td width:'100px'>";
							echo $row['content'];
						echo "</td>";
						echo "<td>";
							echo $row['ip'];
						echo "</td>";
						echo "<td width='25%'>";
							echo date("Y-m-d H:i:s",$row['date']);
						echo "</td>";
						echo "<td width='10%'>";
							if ($_SESSION && $row['uid']===$_SESSION['uid']) {
								echo "<a href=\"editmsg.php?id={$row['id']}&session={$_SESSION['session']}\">edit</a>";
								echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								echo "<a href='delmsg.php?id=".$row['id']."'>del</a>";	
							} else {
								echo "edit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;del";
							}
						echo "</td>";
					echo "</tr>";
				}
				mysql_close($conn);
			?>
		</table>
		
		<br /><br />
		<a name="001" id="001"></a>
		<form action="msgadd.php" method="post">
			<table border="0">
				<tr>
					<td>
						<input tyep="text" name="title" align="center">
					</td>
				</tr>
				<tr>
					<td>
						<textarea name="content" rows="5" cols="30"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="添加留言"/>&nbsp;&nbsp;&nbsp;
						<input type="reset" value="重置"/>
					</td>
				</tr>
			</table>
		</form>

	</center>

<?php include("foot.php");?>