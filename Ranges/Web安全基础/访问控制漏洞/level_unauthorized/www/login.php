<?php 
	session_start();
	include("connect.inc.php");
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "SELECT * FROM users WHERE username='$username' AND password='$password' ";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		if ($row) {
			$_SESSION['login']=1;//说明登录成功
			header("Location:info.php/?id=".$row['id']);
		}else{
			echo "用户名或密码错误\n";
		}
	}
 ?>