<?php

	class mysql {
		protected $host;
		protected $user;
		protected $pass;
		protected $dbname;
		protected $charset;

		function __construct($host,$user,$pass,$dbname,$charset)
		{
			$this->host = $host;
			$this->user = $user;
			$this->pass = $pass;
			$this->dbname = $dbname;
			$this->charset = $charset;
		}

		function connect()  //连接MySQL的函数
		{
			$conn = mysql_connect($this->host,$this->user,$this->pass) or die("Can't connect MySQL!");
			mysql_select_db($this->dbname) or die("select db error:".mysql_error());
			mysql_query("set names $this->charset");
			return $conn;
		}

		function select($column,$tab,$condition = '')   //查询函数
		{
			$condition = $condition ? ' where '.$condition : NULL;
			// $t = "select $column from $tab $condition";
			// echo $t;
			$result = mysql_query("select $column from $tab $condition");
			return $result;
		}

		function insert($tab,$arr)
		{
			$value = '';
			$column = '';
			foreach ($arr as $k => $v) {
				$column .= ",{$k}";
				$value .= ",'{$v}'";
			}
			$column = substr($column, 1);
			$value = substr($value, 1);
			//echo "insert into $tab($column) values($value)";
			mysql_query("insert into $tab($column) values($value)");
			$num = mysql_affected_rows();
			return $num;	//返回受影响行数
		}

		function update($tab,$arr,$colm,$value)
		{
			$sql = '';
			foreach ($arr as $k => $v) {
				$sql .= ", {$k}='$v'";
			}
			$sql = substr($sql, 1);
			echo "update $tab set $sql where $colm=$value";

			mysql_query("update $tab set $sql where $colm='$value'");
		}

		function delete($tab,$col,$value)
		{
			mysql_query("delete from $tab where $col='$value'");
			$num = mysql_affected_rows();
			return $num;	//返回受影响行数
		}

		function close($conn)
		{
			mysql_close($conn);
		}
	}



	// $column = 'user.username,msg.id,msg.uid,msg.title,msg.content,msg.ip,msg.date';
	// $db = new mysql("127.0.0.1","root","217977","messages","utf8");
	// $conn = $db->connect();
	// $result = $db->select($column,'user,msg','user.id=msg.uid order by msg.date');
	// $db->close($conn);
	
	// while ($row = mysql_fetch_row($result)) {
	// 	print_r($row);
	// 	echo "<br />";
	// }


	// $arr = array();
	// $arr[0] = "aaaa";
	// $arr[1] = "woshi content";
	// $db = new mysql("127.0.0.1","root","217977","messages","utf8");
	// $conn = $db->connect();
	// $db->insert("user","username,password",$arr);


	// $db = new mysql("127.0.0.1","root","217977","messages","utf8");
	// $conn = $db->connect();
	// $db->delete("msg","id","15");


	// $arr = array();
	// $arr['title'] = '1111111111';
	// $arr['content'] = 'this';
	// $db = new mysql("127.0.0.1","root","217977","messages","utf8");
	// $conn = $db->connect();
	// $db->update('msg',$arr,'id','19');

?>