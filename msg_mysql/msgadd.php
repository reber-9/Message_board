<?php
	session_start();
	$config = require('./config.inc.php');
	require('./mysql.class.php');
	include("./common.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>add msg</title>
</head>
<body>
	<?php
		if (!$_SESSION) {
			echo '<script>alert("请先登录.")</script>';
			header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/login.php");
			exit();
		} else {

			//1.获取要要添加的留言信息，并且补上其他辅助信息（ip地址、添加时间）
			$uid = $_SESSION['uid'];
			$title = $_POST['title'];  //留言标题
			$content = $_POST["content"];	//留言内容
			// $title = htmlspecialchars($title,ENT_QUOTES);
			// $content = htmlspecialchars($content,ENT_QUOTES);
			$title = filter($title);
			$content = filter($content);
			//$ip = $_SERVER["REMOTE_ADDR"];  //IP地址
			$ip = filter($_SERVER["REMOTE_ADDR"]);
			$time = time();				//添加时间（时间戳）
			//echo $uid.":".$title.":".$content.":".$ip.":".$time."<br />";


			// $conn = mysql_connect("localhost","msg","217977") or die("can not connect mysql!");
			// mysql_query("set names 'utf8'");
			// mysql_select_db("messages",$conn) or die("select db error:".mysql_error());
			$db = new mysql($config['DB_HOST'],$config['DB_USER'],$config['DB_PASS'],$config['DB_NAME'],$config['DB_CHARSET']);
			$conn = $db->connect();

			// $sql = "insert into msg(uid,title,content,ip,date) values('$uid','$title','$content','$ip','$time')";
			// $result = mysql_query($sql);
			$arr = array("uid" => $uid,"title" => $title,"content" => $content,"ip" => $ip,"date" => $time);
			$result = $db->insert('msg',$arr);

			if ($result) {
				$db->close($conn);
				echo '<script>alert("留言成功.")</script>';
				header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/show.php#001");
				exit();		
			} else {
				$db->close($conn);
				echo '<script>alert("留言失败.")</script>';
				echo "<script language='javascript'>window.history.back(-1);</script>";
				exit();
			}
		}
	?>
</body>
</html>