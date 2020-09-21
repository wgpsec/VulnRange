<?php  
header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
echo "flag In the variable!";
error_reporting(0);
include "flag.php";
highlight_file(__file__);

if(isset($_GET['args']))
{
    $args = $_GET['args'];
    if(!preg_match("/^\w+$/",$args))
    {
        die("args error!");
    }
    eval("var_dump($$args);");
}
?>