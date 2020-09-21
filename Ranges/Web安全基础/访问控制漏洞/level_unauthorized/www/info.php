<?php 
	session_start();
	include("connect.inc.php");
	if ($_SESSION['login']==1) {
		$uid = $_GET['id'];
		$sql = "SELECT * FROM users WHERE id='$uid' ";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		if ($row['username']!='test') {
			echo "欢迎登录，你的用户名是：".$row['username'];
			echo "<br/>";
			echo "flag{e84671b1a94bf531e9988425ea2d4293}";
		}else{
			echo "欢迎登录，你的用户名是：".$row['username'];
			echo "<br/>";
			echo "Tips： 除了你其他人都能拿到flag";
		}
	}else{
		echo "请先登录";
	}
 ?>