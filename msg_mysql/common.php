<?php
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