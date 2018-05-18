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
			} else if(isset($_POST['content'])){
				//这里处理修改
				$msg = $_POST['content'];   //新的留言内容
				$id = $_POST['id'];

				$info = file_get_contents("liuyan.txt");
				$info = rtrim($info,"@");
				$lylist = explode("@@@",$info);
				$ly = explode("##",$lylist[$id]);
				$ly = "{$ly[0]}##{$msg}##{$ly[2]}##{$ly[3]}";
				echo $ly;
				$lylist[$id] = $ly;

				$ninfo = implode("@@@",$lylist);
				file_put_contents("liuyan.txt",$ninfo);
				header("location: show.php");
				exit();
			} else {
				$id = $_GET['id'];
				//echo $id."<br />";
		        $index = "";
				$info = file_get_contents("liuyan.txt");
				$info = rtrim($info,"@");
				$lylist = explode("@@@",$info);
				$lylist = explode("##",$lylist[$id]);//分割需要修改的那一条数据
				$msg = $lylist[1];   //需要修改的留言的内容

				echo "<center>";
				echo "<h3>修改留言</h3>";
				echo "<form action='editmsg.php' method='post'>";
				echo "<input type='hidden' name='id' value='{$id}'>";
				echo "<textarea name='content' cols='40' rows='6'>{$msg}</textarea>";
				echo "<br /><input type='submit' value='保存修改'/>";
				echo "</form>";
				echo "</center>";
			}
			include("foot.php");
		} else {
			header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
			exit();
		}
	} else {
		header("refresh:0.1; url=http://127.0.0.1/php/msg/login.php");
		exit();
	}

?>