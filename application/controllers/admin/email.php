<?php

class Email extends MY_Controller{

	public function __construct(){
		parent::__construct('admin');
		$this->load->model('GlobalvalueModel');
		$this->load->library('email');
	}
	
	public function simpleEmail(){
		$data = array();
		
		$this::loadViewSimpleEmail($data);
	}
	
	public function simpleEmail_sent(){
		$fromName 		= $this->input->post('fromName');
		$fromEmail		= $this->input->post('fromEmail');
		$subject 		= $this->input->post('subject');
		$body 			= $this->input->post('body');
		$emailFormat 	= $this->input->post('emailFormat');
		$recipientList	= $this->input->post('recipient');
		$recipientList =  explode("\n", $recipientList);
		
		foreach($recipientList as $recipient){
		
			$this->email->initialize(array(
					'protocol'  => 'smtp',
					'smtp_host' => 'smtp.sendgrid.net',
					'smtp_user' => 'azure_05c31c1024b3d00febba4041ac54c447@azure.com',
					'smtp_pass' => 'lcdj3x27',
					'smtp_port' => 587,
					'crlf' 		=> "\r\n",
					'newline' 	=> "\r\n",
					'mailtype' 	=> $emailFormat
			));
			
			$this->email->from($fromEmail, $fromName);
			$this->email->to($recipient);
			
			$this->email->subject($subject);
			$this->email->message($body);
			
			$this->email->send();
			echo $this->email->print_debugger();		
			
		}
	}
	
	
	
	
	
	private function loadViewSimpleEmail($data){
		$data['head']   = $this->load->view('admin/head',   '', TRUE);
		$data['header'] = $this->load->view('admin/header', '', TRUE);
		$data['footer'] = $this->load->view('admin/footer', '', TRUE);
		 
		$this->load->view('admin/email_simple', $data);
	}
}	
	