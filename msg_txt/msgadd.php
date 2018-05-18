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
	<title>add msg</title>
</head>
<body>
	<?php
		if (!$_SESSION) {
			echo '<script>alert("请先登录.")</script>';
			header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
			exit();
		} else {
			//执行留言信息添加操作
			//1.获取要要添加的留言信息，并且补上其他辅助信息（ip地址、添加时间）
			$author = $_SESSION["name"];		//获取留言者
			$content = $_POST["content"];	//留言内容
			$author = htmlspecialchars($author);
			$content = htmlspecialchars($content);
			$ip = $_SERVER["REMOTE_ADDR"];  //IP地址
			$addtime = time();				//添加时间（时间戳）
				
			//2.拼装（组装）留言信息
				$info = file_get_contents("liuyan.txt");
				$info = rtrim($info, "@");
				$lylist = explode("@@@",$info);
				$ly = "{$author}##{$content}##{$ip}##{$addtime}@@@";

			//3.将留言信息追加到liuyan.txt文件中 
				$info = file_get_contents("liuyan.txt");//获取所有以前的留言
				file_put_contents("liuyan.txt",$info.$ly);
			//4.输出留言成功！
				echo '<script>alert("留言成功.")</script>';
				header("refresh:0.1; url=http://127.0.0.1/php/msg/show.php#001");
				exit();
			}
	?>
</body>
</html>