<?php 

	class Download extends MY_Controller{
		
		function start(){
			
			$magnet = $_POST['magnet'];
			
			
			print ('transmission-remote -n wttn:wttn -a "'.$magnet.'" -s');
			
		}
		
		function index(){
			
			$rows = false;
			
			if(isset($_POST['search'])){
			
				$search = $_POST['search'];
				
				$url = 'http://thepiratebay.se/search/'.rawurlencode($search).'/0/7/0';
	
				$html = file_get_contents($url);

				
				$start = '<table id="searchResult">';
				$end = '</table>';
				$tableParts  = explode($start,$html);
				
				if(!isset($tableParts[1])){
					print $html;
					die;
				}
				
				$tableParts = explode($end, $tableParts[1]);
				
				$table = $start . $tableParts[0] . $end;
				
				
				$table = str_replace("<a" , PHP_EOL ."<a",$table);
				$table = str_replace("</a>" ,  PHP_EOL . "</a>" . PHP_EOL ,$table);
				
				$magnetParts = explode('magnet:',$table);
				$hrefs = array();
				
				foreach($magnetParts as $part){
					
					$part = explode('"',$part);
					$hrefs[] = $part[0];
				}
				
				
				$magnets = array();
				
				foreach($hrefs as $i=>$magnet){
					
					if($i == 0){
						continue;
					}
					
					$magnet = 'magnet:'.$magnet;
					$key = md5($magnet);
					$magnets[] = $magnet;
					
					$table = str_replace($magnet,$key,$table);
					
				}
			
				
				$rows = array();
				$DOM = new DOMDocument;
			    $DOM->loadHTML($table);
			
			    $items = $DOM->getElementsByTagName('tr');

			    foreach ($items as $a=>$node){
			    
			    	
					if($a == 0){
						continue;
					}
					
			    	$row = array();
			        foreach ($node->childNodes as $i=>$element){
			        	$value = trim($element->nodeValue);
						
			        	if($i == 0){
				        	$row['type'] = trim(str_replace(array("\t",PHP_EOL),'',$value));
			        	}
			        	if($i == 2){
			        		
			        		$nameParts = explode(PHP_EOL, $value);
				        	$row['name'] = $nameParts[0];
			        	}
			        }
			        
			        $row['magnet'] = $magnets[$a-1];
			        
			        $rows[] = $row;
			    }
			    
				
				
			}
			
			$this->load->view('download',array('rows'=>$rows));
			
		}
		
	}


?>