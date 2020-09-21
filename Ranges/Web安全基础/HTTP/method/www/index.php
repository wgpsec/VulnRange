<?php
	header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
	highlight_file("hint.php");
	if ($_SERVER['REQUEST_METHOD']=='WINTRYSEC') {
		echo("flag{e8da3595066ced5d660b9d10d9e8a033}");
	}else{
		echo $_SERVER['REQUEST_METHOD'];
	}
 ?>
