<?php
header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
$res=0;
if (isset($_GET['ip']) && $_GET['ip']) {
	$ip = $_GET['ip'];
	$m=[];
	if (!preg_match_all("/cat/", $ip, $m)) {
		$cmd = "ping -c 4 {$ip}";
		exec($cmd,$res);
	}else{
		$res=$m;
	}
	if ($res) {
    		print_r($res);
    	}
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>命令执行-过滤cat</title>
</head>
<body>

<form action="#" method="GET">
    <label>IP : </label><br>
    <input type="text" name="ip">
    <input type="submit" value="Ping">
</form>

</body>
</html>