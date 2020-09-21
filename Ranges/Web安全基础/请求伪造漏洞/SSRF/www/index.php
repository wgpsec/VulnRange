<?php 
header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
echo "<h3>Input url Whith GET Method!\n";  

function curl($url){                                                         
    $ch = curl_init();                                
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);//根据服务器返回 HTTP 头中的 "Location: " 重定向 
    curl_exec($ch);                              
    curl_close($ch);                                      
}                                                        
$url = $_GET['url'];                                                         
print "<br/>".$url;   
echo "<h3>Tips: FLAG is in /etc/flag.php";                                                                 
curl($url);
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
	h4{
		text-align: center;
		font-size: 20px;
		color: white;
	}
</style>