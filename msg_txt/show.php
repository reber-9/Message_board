<?php
session_start();
ini_set('date.timezone', 'Asia/Shanghai');
include("users.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的留言板</title>
	<script>
		//定义一个询问是否要删除的js代码。
		function dodel(id){
			if(confirm("确定要删除吗？")){
				window.location='delmsg.php?id='+id;
			}
		}
		// function doedit(id){
		// 	if(confirm("确定要修改吗？")){
		// 		window.location='editmsg.php?id='+id;
		// 	}
		// }
	</script>
</head>
<body>
	<center>
		<h3>留言板</h3>
		<h4><a href="#001" title="去底部留言">↓↓↓↓↓</a></h4>

		<?php
			if ($_SESSION) {
				echo "Welcome:".$_SESSION['name']."<a href='logout.php'>(退出登录)</a><br />";
				//var_dump($_SESSION['name']);
			} else {
				echo "<a href='logout.php'>请登录</a>";
			}
		?>

		<hr>
		
		<table border="1" width="700">
			<tr>
				<th>留言人</th>
				<th>留言内容</th>
				<th>IP地址</th>
				<th>留言时间</th>
				<th>操作</th>
			</tr>
			<?php
				//获取留言信息，解析后输出到表格中。
				//1.从留言liuyan.txt信息文件中获取留言信息
					$info = file_get_contents("liuyan.txt");
					
				//2.取出留言内容最后的三个@@@符号
					$info = rtrim($info,"@");
				if(strlen($info)>6){
				//3.以@@@符号拆分留言信息为一条一条的。
				// （将留言信息以@@@的符号拆分成留言数组）
					$lylist = explode("@@@",$info);
					//var_dump($lylist);
				//4.遍历留言信息数组，对每条留言做再次解析
					foreach($lylist as $k=>$v){
						$ly = explode("##",$v);//将每条留言信息以##号拆分成每个留言字段
						echo "<tr>";
						echo "<td align='center' style='width:40px'>{$ly[0]}</td>";
						echo "<td style='width:100px'>{$ly[1]}</td>";
						echo "<td align='center' style='width:70px'>{$ly[2]}</td>";
						echo "<td align='center' style='width:100px'>".date("Y-m-d H:i:s",$ly[3]+6*3600)."</td>";
						if ($_SESSION && $ly[0] == $_SESSION['name']) {
							echo "<td align='center' style='width:60px'><a href='editmsg.php?id={$k}'>修改</a>&nbsp;&nbsp<a href='javascript:dodel({$k})'>删除</a></td>";
						} else {
							echo "<td align='center' style='width:60px'>修改&nbsp;&nbsp";
							echo "删除</td>";
						}
						echo "</tr>";
						//echo $v."<br/>";
					}
				//
				}
			?>
		</table>
		
		<br /><br />
		<a name="001" id="001"></a>
		<form action="msgadd.php" method="post">
			<table border="0">
				<tr>
					<td>
						<textarea name="content" rows="5" cols="30"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="添加留言"/>&nbsp;&nbsp;&nbsp;
						<input type="reset" value="重置"/>
					</td>
				</tr>
			</table>
		</form>

	</center>

<?php include("foot.php");?>