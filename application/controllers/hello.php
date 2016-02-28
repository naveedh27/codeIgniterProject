<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hello extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		
		//echo "This is init;;";
	}
	
	public function index(){
		echo "This is index function";
		$this->one();
	}
	
	public function one($na=""){
		
		
		
		$this->load->model("hello_model","model");
		
		$profile = $this->model->getProfile($_GET['ho']);
		

		
		$data = $profile;
		$this->load->view('one',$data);	
			
	}
	
	public function two(){
		echo "This is default";
	}

}