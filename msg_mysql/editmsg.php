<?php
	session_start();
	$config = require('./config.inc.php');
	require('./mysql.class.php');
	include("./common.php");
?>

<?php
	header("Content-Type:text/html; charset=utf-8");

	$id = $_GET['id'];
	$session = $_GET['session'];
	//echo $id."::".$session;

	// $conn = mysql_connect("localhost","msg","217977") or die(mysql_error());
	// mysql_query("set names 'utf8'");
	// mysql_select_db("messages",$conn) or die(mysql_error());
	$db = new mysql($config['DB_HOST'],$config['DB_USER'],$config['DB_PASS'],$config['DB_NAME'],$config['DB_CHARSET']);
	$conn = $db->connect();


	if (!$_SESSION['uid']) {
		echo '<script>alert("请先登录.")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/login.php");
		exit();
	}

	if (isset($_POST['title']) && isset($_POST['content'])){
		$title = $_POST['title'];   //新的title
		$content = $_POST['content'];   //新的留言内容
		$title = filter($title);
		$content = filter($content);

		//$sqls = "update msg set title='$title',content='$content' where id='$id'";
		//$result = mysql_query($sqls);
		$arr = array("title" => $title,"content" => $content);
		$result = $db->update('msg',$arr,'id',$id);
		$row = mysql_fetch_assoc($result);
		mysql_close($conn);

		header("location: show.php");
		exit();
	} else if ($session === $_SESSION['session']) {
		// $sqls = "select title,content from msg where id='$id'";
		// $result = mysql_query($sqls);
		$result = $db->select('title,content','msg',"id='$id'");
		$row = mysql_fetch_assoc($result);

		echo "<center>";
		echo "<h3>修改留言</h3>";
		echo "<table border='0'>";
		echo "<form method='post'>";
		echo "<input type='hidden' name='title' value='{$id}'>";
		echo "<tr><td align='right'>title:</td><td><input type='text' name='title' value='".$row['title']."'></td></tr>";
		echo "<tr><td align='right'>content:</td><td><textarea name='content' cols='40' rows='6'>".$row['content']."</textarea></td><tr/>";
		echo "<tr><td colspan='2' align='center'><input type='submit' value='保存修改'/></td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</center>";
	} else {
		echo '<script>alert("非法操作.")</script>';
		header("refresh:0.1; url=http://127.0.0.1/php/msg_mysql/show.php");
		exit();
	}
	
	include("foot.php");
?>