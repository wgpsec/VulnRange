<?php

$dbuser ='root';
$dbpass ='root';
$dbname ="vertical-unauthorized";
$host = 'db-vertical-unauthorized:3306';

//error_reporting(0);
$conn = mysqli_connect($host,$dbuser,$dbpass,$dbname);

// 检查连接
if (!$conn)
{
    echo "Failed to connect to MySQL: " . mysqli_error($conn);
}

?>