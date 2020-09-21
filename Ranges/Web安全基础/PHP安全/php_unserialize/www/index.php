<?php
	header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
	highlight_file(__FILE__);
	//flag is in flag.php
	class demo {
		public $file;
		function __construct($filename = '') {
			$this -> file = $filename;
		}
		
		function readfile() {
			if (!empty($this->file)) 
			{
				return @file_get_contents($this->file);
			}
		}
	}

	isset($_GET['file']) && $g = $_GET['file'];
	if (!empty($g)) {
		$x = unserialize($g);
	}
	echo $x->readfile();
?>