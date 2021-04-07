<?php

class Login{

	public $email;

	private $conn;

	public function __construct($conn){
		
		$this->conn = $conn;
	 
    } 

    public function login_check()
	{
		$sql = mysqli_query($this->conn,"select * from teachers_tb where email= '$this->email'"); 
		$data = mysqli_fetch_assoc($sql); 
		return $data;         
	}
	
	public function get_all_teachers(){    
		$sql = mysqli_query($this->conn,"Select * from teachers_tb");
		//$data = mysqli_fetch_assoc($sql);     
		$result = array();
		while($data = mysqli_fetch_assoc($sql)){  
		$result[]= array("id"=>$data['tid'],"name"=>$data['name'],"email"=>$data['email'],"password"=>$data['password'],"role"=>$data['role']); 
		}   
		return $result;  
	}
}
	
	
?>