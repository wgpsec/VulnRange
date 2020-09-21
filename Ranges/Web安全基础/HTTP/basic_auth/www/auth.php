<?php
if(!isset($_SERVER['PHP_AUTH_USER']))  
{  
    Header("WWW-Authenticate: Basic realm=\"My Realm\"");  
    Header("HTTP/1.0 401 Unauthorized");  
    echo "请输入认证信息";  
    exit;  
}elseif (!($_SERVER['PHP_AUTH_USER']=="admin" && $_SERVER['PHP_AUTH_PW']=="zxcvbnm")) {
	Header('WWW-Authenticate: Basic realm="User is admin"');
	Header("HTTP/1.0 401 Unauthorized");
	echo "认证信息错误";
	exit; 
}else{
	echo "flag{469087780e9cc7bb7a9e77bb841866ff}";
}
?> 