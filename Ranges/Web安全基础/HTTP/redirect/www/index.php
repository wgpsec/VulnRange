<?php
	header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
	$url='noflag.php';
	header("Location: $url");
	echo "<center class='diy'>";
	echo "FLAG is in here!";
	echo "<!--flag{d12de682b391a20825af0fc89fc0ac56}-->";
	echo "</center>";

 ?>
 <style type="text/css">
 	.diy{
 		font-size: 30px;
 		color: red;
 	}
 </style>