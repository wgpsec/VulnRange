<?php
header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
highlight_file('./hint.php'); 
$num=$_GET['num'];
if(!is_numeric($num))
{
	echo $num;
	if($num==1)
		echo 'flag{fe2e9c3e6c7895c78e8b61a7e366b5ae}';
}
 ?>