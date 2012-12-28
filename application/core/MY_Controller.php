<?php

class MY_Controller extends CI_Controller{

	var $section;

	public function __construct($section = NULL){
        parent::__construct();
        date_default_timezone_set('Australia/NSW');
        
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


    /*
     * return main information required in header
     *   - category list for clothing
     *   - category list for accessories
     *   - list of brand
     */
	protected function getFrontendHeader($cat_id1 = NULL, $cat_id2 = NULL, $getBrand = FALSE){
		$this->load->model('CategoryModel');
				
		$header = array();
		$header['cat_clothing'] = array();
		$header['cat_accessories'] = array();
		$header['brands'] = array();
		
		if ($cat_id1 != NULL)
			$header['cat_clothing']    = $this->CategoryModel->getCategoryList($cat_id1);
		
		if ($cat_id2 != NULL)
			$header['cat_accessories'] = $this->CategoryModel->getCategoryList($cat_id2);
		
		if ($getBrand){
			$this->load->model('BrandModel');
			$header['brands']          = $this->BrandModel->getBrandList();
		}
		
		return $header;
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