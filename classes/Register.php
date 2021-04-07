<?php

class Register{
	
	public $name;
	public $email;
	public $password;
	public $mobile; 
	private $conn;
	private $table_name; 
	public function __construct($conn){
		
		$this->conn = $conn;
		$this->table_name = 'register_app';
		
	} 
	  
	public function check_email($email){
		
		$sql = mysqli_query($this->conn,"select * from ".$this->table_name . " where email = '$email' ");
		
		$data = mysqli_fetch_assoc($sql);
	   // print_r($data);     
	   return $data;       
		  
	}
	       
	public function insert_reg(){     
		$sql = mysqli_query($this->conn,"insert into ".$this->table_name." (id,name,email,password,mobile) values  ('','$this->name','$this->email','$this->password','$this->mobile')");
	
		if($sql){ 
			return true;
		}else{            
			return false;     
		}
		
	}
	 
	public function get_all_students(){ 
		$sql = mysqli_query($this->conn,"Select * from ".$this->table_name);
		//$data = mysqli_fetch_assoc($sql);   
		$result = array();
		while($data = mysqli_fetch_assoc($sql)){  
		$result[]= array("id"=>$data['id'],"name"=>$data['name'],"email"=>$data['email'],"password"=>$data['password'],"mobile"=>$data['mobile']); 
		}  
		return $result;    
	} 
	
	public function get_each_student($id){ 
		$sql = mysqli_query($this->conn,"Select * from ".$this->table_name. " where id = '$id' ");
		$result = mysqli_fetch_assoc($sql);    
		 
		return $result;   
	}
}


?>