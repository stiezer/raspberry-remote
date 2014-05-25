<?php 

	class MY_Controller extends CI_Controller{
		
		function __construct(){
			CI_Controller::__construct();
			
			
			
		}
		
		function putData($name,$data){
		
			$path = '/data/';
			$dir = DOC_ROOT . $path;
			$file = $dir . $name .'.json';
			
			file_put_contents($flie, $data);
		}
		
		function getData($name){
			
			$path = '/data/';
			$dir = DOC_ROOT . $path;
			$file = $dir . $name .'.json';
			
			if(!is_dir($dir)){
				mkdir($dir);
			}
			
			if(!file_exists($file)){
				$json = json_encode(array());
				file_put_contents($file, $json);
			}
			
			
			$json = file_get_contents($file);
			
			$data = json_decode($json,false);
			
			return $data;
		}
		
	}

?>