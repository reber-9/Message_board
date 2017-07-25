<?php
/*
code by reber
email:1070018473@qq.com
*/
session_start();
include("users.php");
?>

<?php
	header("Content-Type:text/html; charset=utf-8");
	if (isset($_SERVER['HTTP_REFERER'])) {
		if ($_SERVER['HTTP_REFERER'] === "http://127.0.0.1/php/msg/show.php") {
			if (!$_SESSION) {
				echo '<script>alert("请先登录.")</script>';
				header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
				exit();
			} else {
				//$tk = $_GET['tk'];
				//echo $tk;
				$id = $_GET['id'];
				echo $id;

			//2.从留言liuyan.txt信息文件中获取留言信息
				$info = file_get_contents("liuyan.txt");
				$info = rtrim($info,"@");
			
			//3.将留言信息以@@@的符号拆分成留言数组
				$lylist = explode("@@@",$info);
				unset($lylist[$id]);
			//4.重组留言

				$ninfo = implode("@@@",$lylist);
				file_put_contents("liuyan.txt",$ninfo."@@@");
				header("location: show.php");
				exit();
			}
		} else {
			header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
			exit();
		}
	} else {
		header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
		exit();
	}
?>
