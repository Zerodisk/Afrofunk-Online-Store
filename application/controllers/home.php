<?php 

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('ProductModel');
	}
	
	public function index(){
		$data = array();
		$this->load->view('home', $data);
	}
	
}