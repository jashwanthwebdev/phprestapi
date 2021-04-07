<?php

ini_set('display_errors',1); 
//include header 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET");
header("Content-type: application/json; charset=utf-8");  

//includes
include('../config/db.php');
include('../classes/Register.php');  

//get connection
$dbcon = new DabaseConnection(); 
$conn = $dbcon->connect();   
 
//passing connection 
$Register = new Register($conn);  

if($_SERVER['REQUEST_METHOD'] == 'GET'){   

if(isset($_GET['id'])){
	$id = $_GET['id']; 
    $result = $Register->get_each_student($id);  
	 
	if(!empty($result)){  
		 
	 http_response_code(200);   
	echo json_encode(array("status"=>1,"data"=>$result));  
	}  
	else{ 
		
		http_response_code(400);  
	echo json_encode(array("status"=>0,"message"=>"No Records found")); 
	}
}else{
	http_response_code(404); 
	echo json_encode(array("status"=>0,"message"=>"Sorry Unable to retrive the data")); 
}
}else{
    http_response_code(505); 
	echo json_encode(array("status"=>0,"message"=>"Access Denied")); 
}    
 

?>