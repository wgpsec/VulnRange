<?php 
	header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
	echo "<center class='diy'>";
	echo "你要通过认证才能拿到flag！";
	echo "<br/><br/>Here is your flag <a href='auth.php'>Get flag</a>";
	echo "</center>";
 ?>
 <style type="text/css">
 	.diy{
 		font-size: 30px;
 		color: red;
 	}
 </style>