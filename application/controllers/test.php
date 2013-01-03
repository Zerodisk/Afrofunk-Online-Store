<?php 

class Test extends MY_Controller {

	public function __construct(){
        parent::__construct();
    }	
    
    public function view($templateFileName){
    	$this->load->view(str_replace('.php', '', $templateFileName));
    }
    
    public function mybrowser(){    	
    	$this->load->library('user_agent');
    	
    	echo('my browser is: '.$this->agent->browser().'<br>');
    	echo('version is: '.$this->agent->version().'<br>');
    	echo('mobile is: '.$this->agent->mobile().'<br>');
    	echo('platform is: '.$this->agent->platform().'<br>');
    	echo('agent_string is: '.$this->agent->agent_string().'<br>');
    	echo('referrer is: '.$this->agent->referrer().'<br>');
    }
}