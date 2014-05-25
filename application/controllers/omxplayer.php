<?php 



	class Omxplayer extends CI_Controller{
		
		function start(){
			
			$file = str_replace(' ','\\ ' ,$_POST['param']);

//			$commands[] = ('rm -rf '.PIPE_FILE);
			$commands[] = ('mkfifo '.PIPE_FILE);
			$commands[] = ('omxplayer -ohdmi '.$file.' < '.PIPE_FILE . ' > /dev/null 2>/dev/null &' );

			
			foreach($commands as $command){
				print PHP_EOL.$command;
				shell_exec($command);
			}
			
			

			$this->sendControl('p');
			
		}
		
		function sendControl($in){

			print 'CMD: '.$in;
			if(file_exists(PIPE_FILE)){
				file_put_contents(PIPE_FILE, $in);
			}

		}
		
		function command(){
			
			$this->sendControl($_POST['param']);
			
		}
		
	}


?>