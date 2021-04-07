<?php 
ini_set('display_errors',1); 
//include header 
header("Access-Control-Allow-Origin: *");  
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");  

//includes
include('../config/db.php');
include('../classes/Login.php'); 

require '../vendor/autoload.php';
use \Firebase\JWT\JWT; 

//get connection
$dbcon = new DabaseConnection(); 
$conn = $dbcon->connect();  

$login_check =  new Login($conn);     

if($_SERVER['REQUEST_METHOD'] == 'POST'){  

  $data =  json_decode(file_get_contents('php://input')); 
  if(!empty($data->email) && !empty($data->password)){  
  $login_check->email = $data->email;
    
   $login_data = $login_check->login_check();
   
   if(!empty($login_data)){
	    
	   $name = $login_data['name'];  
	   $password_hash = $login_data['password'];
	    
	   if(password_verify($data->password,$password_hash)){
		   
		     $iss = "localhost";
              $iat = time(); 
              $nbf = $iat ;   
              $exp = $iat + 1800000; 
              $aud = "myusers";  
              $user_arr_data = array(
                "id" => $login_data['tid'], 
                "name" => $login_data['name'],
                "email" => $login_data['email'],
                "role"=>$login_data['role']				
              );

              $secret_key = "appcare"; 

              $payload_info = array(
                "iss"=> $iss,
                "iat"=> $iat,
                "nbf"=> $nbf,
                "exp"=> $exp, 
                "aud"=> $aud,
                "data"=> $user_arr_data
              ); 
 
              $jwt_token = JWT::encode($payload_info, $secret_key, 'HS512');

              http_response_code(200);
              echo json_encode(array(
                "status" => 1,
                "jwt" => $jwt_token, 
                "message" => "User logged in successfully"
              ));
		   
	   }else{
		   http_response_code(404);
		   echo json_encode(array("status"=>0,"message"=>"Invalid Credientials")); 
	   }
	   
   }else{
	   http_response_code(500);
	   echo json_encode(array("status"=>0,"message"=>"sorry email not registered with us")); 
   }
}else{
	http_response_code(404);
	echo json_encode(array("status"=>0,"message"=>"All Fields are required")); 
}
}else{
	 
	http_response_code(505);
	echo json_encode(array("status"=>0,"message"=>"Access Denied")); 
	
}

?>