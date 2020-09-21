<?php header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启 ?>
<?php 
echo "<h3>Input your name with GET <br>";
$str="echo \"Hello ".$_GET["name"]." \"; ";
eval($str);
echo "<h4 style='color:red;text-align:center'>The flag is in phpinfo()</h4>";
?>
<style type="text/css">
	body{
		background: black;
	}
	h3{
		text-align: center;
		margin-top: 10%;
		font-size: 33px;
		color: white;
	}
</style>