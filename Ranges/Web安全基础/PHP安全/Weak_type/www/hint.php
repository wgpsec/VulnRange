<?php
$num=$_GET['num'];
if(!is_numeric($num))
{
	echo $num;
	if($num==1)
		echo 'flag{**********}';
}
 ?>