<?php
/*
code by reber
email:1070018473@qq.com
*/
	session_start();
	$config = require('./config.inc.php');
	require('./mysql.class.php');
?>

<?php
	header("Content-Type:text/html; charset=utf-8");
	if (isset($_SERVER['HTTP_REFERER'])) {
		if ($_SERVER['HTTP_REFERER'] === "http://127.0.0.1/php/msg_mysql/show.php") {
			if (!$_SESSION['uid']) {
				echo '<script>alert("请先登录.")</script>';
				header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/login.php");
				exit();
			} else {
				$id = $_GET['id'];
				//echo $id;

				$db = new mysql($config['DB_HOST'],$config['DB_USER'],$config['DB_PASS'],$config['DB_NAME'],$config['DB_CHARSET']);
				$conn = $db->connect();
				//$sql = "delete from msg where id='$id'";
				$num = $db->delete('msg','id',$id);
				//echo $num;
				if ($num) {
					$db->close();
					header("location: show.php#001");
					exit();
				} else {
					$db->close();
					echo '<script>alert("删除失败.")</script>';
					header("location: show.php#001");
					exit();
				}
			}
		} else {
			echo '<script>alert("非法操作.")</script>';
			header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/login.php");
			exit();
		}
	} else {
		header("location:show.php");
		exit();
	}
?>
