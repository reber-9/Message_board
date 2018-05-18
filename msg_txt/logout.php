<?php
/*
code by reber
email:1070018473@qq.com
*/
	session_start();
	session_destroy();
	header("location: login.php");
	exit();
?>