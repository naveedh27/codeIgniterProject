<?php

class Hello_model extends CI_Model{
	
	public function getProfile($name){
	
		return array("Fullname" => 
		$name." Heee","age"=>44);
	}

}

?>