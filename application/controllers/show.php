<?php 


	class Show extends MY_Controller{
		
		function __construct(){
			MY_Controller::__construct();
			
			$this->init();
		}
		
		function init(){
			
			$this->shows = $this->getData('shows');
			
		}
		
		function index(){
			
		}
		
	}

?>