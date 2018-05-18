<?php
/*
code by reber
email:1070018473@qq.com
*/
	function filter($str)
	{
		$str = htmlspecialchars($str,ENT_QUOTES);
		return $str;
	}

	function checklen($str)
	{
		$len = strlen($str);
		return $len;
	}
?>