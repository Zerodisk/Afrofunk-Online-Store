<?php

class MY_Controller extends CI_Controller{

	var $section;

	public function __construct($section = NULL){
        parent::__construct();
        
        switch ($section){
        	case 'admin':
        		$this->load->library('session');
        			 
        		if (!$this->session->userdata('isAdminLogined')){
        			header('Location: '.base_url().'admin/login');
        		}
        		break;
        	 default:
        	 	$section = 'public';  //assume as public internet access
        		break;
        }
        
        $this->section = $section;
    }	





	/******************* for testing ******************/
	protected function writeSegment(){
		echo('<br>number of segment is: '.$this->uri->total_segments().' and index start from 1');
		echo('<br><br>');
		
		for ($i = 0; $i <= $this->uri->total_segments(); $i++){
			echo('url index of '.$i.' = '.$this->uri->segment($i));
			echo('<br>');
		}

		echo('<br><br>');
		foreach ($this->uri->segment_array() as $segment)
		{
			echo $segment;
			echo '<br />';
		}
	}
}