<?php 

class Test extends MY_Controller {

	public function __construct(){
        parent::__construct();
    }	
    
    public function view($templateFileName){
    	$this->load->view(str_replace('.php', '', $templateFileName));
    }
    
}