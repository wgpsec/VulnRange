<?php 
	highlight_file(__FILE__);
	header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
	eval($_GET['wintrysec']);
	//flag 就在系统根目录，你能读到它吗？
 ?>