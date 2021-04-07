<?php

class DabaseConnection{
	
	private $hostname;
	private $username;
	private $password;
	private $dbname;
	private $conn;
	
	
	public function connect(){
		$this->hostname = 'localhost';
		$this->username = 'root';
		$this->password = '';
		$this->dbname   = 'appcare';
		
		$this->conn = new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
		if($this->conn->connect_errno){
			print_r('Sorry unable to connect database'.$this->conn->connect_error);
			exit;  
			// echo 'Sorry unable to connect database'.$this->conn->connect_error; 
			// exit;
			
		}else{ 
			 
			//echo 'connection established';
			return $this->conn;     
		}
		
		 
	} 
}
	//$dbcon = new DabaseConnection();
//	$dbcon->connect();  
	
	
	
	

?>