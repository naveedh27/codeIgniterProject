<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->showView();
		$this->load->helper('url');
	}
	
	public function showView(){
		$this->load->model("Event_handler","DB");
		$container['loadSet'] = $this->DB->getInit();
		$this->load->view('home',$container);	
	}
	
	public function showCategory(){
		$this->load->model("Event_handler","DB");
		$dsArr = $this->DB->getByCateg();
		
		foreach($dsArr as $key => $value){
			$categArr[$value['Category']][] = $value;	
		}
		
		$container['categArr'] = $categArr;
		
		$this->load->view('categorizedHome',$container);	
	}
	
	public function getNext(){	
	 
		 $offset = isset($_GET['threshold'])?$_GET['threshold']:"";
		 $filter = isset($_GET['filter'])?$_GET['filter']:"";
		 
		 if (!is_numeric($offset) || empty($offset))
		 {
			 $this->badRequest();
		 }
		
		$this->load->model("Event_handler","DB");
		$eventArr = $this->DB->getNextSet($offset,$filter);
		
		if(empty($eventArr)){
			$eventArr = -1;
		}
		
		header('Content-Type: application/json');
		echo json_encode( $eventArr );
	}
	
	public function getVenue(){
		$venue = isset($_GET['loc'])?$_GET['loc']:"";
		
		if(!is_string($venue)|| empty($venue))
		{
			$this->badRequest();
		}
		
		$this->load->model("Event_handler","DB");
		$locArr = $this->DB->getLocations($venue);
		
		$opArr = array();
		
		if(empty($locArr)){
			$locArr = -1;
		}else{
			foreach($locArr as $key => $value){
				$opArr[] = $value['eventVenue'];
			}
		}
		
		header('Content-Type: application/json');
		echo json_encode( $opArr );		
	}
	
	public function getListByLoc(){
		$venue = isset($_GET['location'])?$_GET['location']:"";
		
		if(!is_string($venue)|| empty($venue))
		{
			$this->badRequest();
		}
		
		$this->load->model("Event_handler","DB");
		$locArr = $this->DB->getDataByLoc($venue);
		
		
		if(empty($locArr)){
			$locArr = -1;
		}
		
		header('Content-Type: application/json');
		echo json_encode( $locArr );		
	}
	
	public function getLocationList(){

		$this->load->model("Event_handler","DB");
		$locArr = $this->DB->getLocationList();
		
		$deArr = array();
		
		foreach($locArr as $value){
			$deArr[] = $value[0];
		}
			
		header('Content-Type: application/json');
		echo json_encode( $deArr );	
		exit;
	}
		
	public function badRequest(){		
		header('Content-Type: application/json');
		echo json_encode("Bad Request. Check Parameter");
		exit;
	}
	

}