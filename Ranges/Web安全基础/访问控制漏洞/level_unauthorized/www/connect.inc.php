<?php

$dbuser ='root';
$dbpass ='root';
$dbname ="level-unauthorized";
$host = 'db-level-unauthorized:3306';

//error_reporting(0);
$conn = mysqli_connect($host,$dbuser,$dbpass,$dbname);

// 检查连接
if (!$conn)
{
    echo "Failed to connect to MySQL: " . mysqli_error($conn);
}

?>