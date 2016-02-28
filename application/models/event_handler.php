<?php

class Event_handler extends CI_Model{
	
	
	private static $conn = 'false'; 		

	public function __construct(){
		parent::__construct();
		
		 $serverName = "127.0.0.1";
		 $username = "root";
		 $password = "";
		 $dbName = "event";
		
		if(self::$conn == 'false'){
			try {
				self::$conn = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
				// set the PDO error mode to exception
				self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
			catch(PDOException $e)
				{
				//echo "Connection failed: " . $e->getMessage();
				}
		}
		$db = self::$conn;		
	}
	
	public function getInit(){			
			$statement = self::$conn->prepare("select * from `eventlist` LIMIT 9");
			$statement->execute();
			$row = $statement->fetchAll(PDO::FETCH_ASSOC);			
			return $row;		
	}
	
	public function getNextSet($limit, $filter=""){			
			$from = 9 * $limit;
			$to = 9;
			if($filter != ""){
				$statement = self::$conn->prepare("select * from `eventlist` WHERE `eventVenue` like '%$filter%' ");
			}else{
				$statement = self::$conn->prepare("select * from `eventlist` LIMIT $from , $to"	);
			}
			$statement->execute();
			$row = $statement->fetchAll(PDO::FETCH_ASSOC);			
			return $row;		
	}
	
	public function getLocations($loc){			
			$statement = self::$conn->prepare("SELECT `eventVenue` FROM `eventlist` WHERE `eventVenue` like '%$loc%' GROUP BY eventVenue");
			$statement->execute();
			$row = $statement->fetchAll(PDO::FETCH_ASSOC);			
			return $row;		
	}
	
	public function getDataByLoc($location){			
			$statement = self::$conn->prepare("SELECT * FROM `eventlist` WHERE `eventVenue` = '$location'");
			$statement->execute();
			$row = $statement->fetchAll(PDO::FETCH_ASSOC);			
			return $row;		
	}
	
	public function getByCateg(){
			$statement = self::$conn->prepare("select * from `eventlist` Order by `Category` ASC");
			$statement->execute();
			$row = $statement->fetchAll(PDO::FETCH_ASSOC);			
			return $row;
	}
	
	public function getLocationList(){
			$statement = self::$conn->prepare("SELECT  `eventVenue` FROM  `eventlist` GROUP BY  `eventVenue`");
			$statement->execute();
			$row = $statement->fetchAll(PDO::FETCH_NUM);			
			return $row;
	}

}

?>