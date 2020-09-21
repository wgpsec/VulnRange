<?php 
	session_start();
	include("connect.inc.php");
	if ($_SESSION['login']==1) {
		$user = $_GET['username'];
		$sql = "SELECT * FROM users WHERE username='$user' ";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		if ($row['username']=='admin') {
			echo "欢迎登录管理员：".$row['username'];
			echo "<br/>";
			echo "flag{e79705b4631a844e1cc828b9b39a0a03}";
		}else{
			echo "欢迎登录：".$row['username'];
			echo "<br/>";
			echo "本页面只有管理员才能访问";
		}
	}else{
		echo "请先登录";
	}
 ?>