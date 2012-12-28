<?php 

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('CategoryModel');
	}
	
	public function aboutus(){
		$data = array();
		$data['head']   = $this->load->view('head',   '', TRUE);
		
		$header = $this::getFrontendHeader(1, 2, TRUE);
		$data['header'] = $this->load->view('header', $header, TRUE);
		
		$data['footer'] = $this->load->view('footer', '', TRUE);
		
		$this->load->view('aboutus', $data);
	}
	
}