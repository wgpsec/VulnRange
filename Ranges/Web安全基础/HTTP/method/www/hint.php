<?php 
	highlight_file(__FILE__);
	if ($_SERVER['REQUEST_METHOD']=='WINTRYSEC') {
		echo("flag{***********}");
	}else{
		echo $_SERVER['REQUEST_METHOD'];//使用超全局变量输出当前客户端请求的HTTP方法
	}
 ?>