<?php

$ct = curl_init();
curl_setopt($ct, CURLOPT_URL, "http://localhost/RestApiAppcare/v1/get_all_students_api.php");
curl_setopt($ct, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ct, CURLOPT_HEADER, FALSE); 
curl_setopt($ct, CURLOPT_HTTPHEADER, array("Accept: application/json")); 
$response = curl_exec($ct); 
curl_close($ct);        
$all_students = json_decode($response) ; 
//print_r($all_students->data);        
 
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>APP CARE TASK</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>APP CARE - JASHWANTH API TASK</h2> 
     
  <table class="table"> 
    <thead> 
      <tr>
        <th>Name</th>
        <th>Email</th> 
        <th>Mobile</th> 
      </tr> 
    </thead> 
    <tbody>
	<?php foreach($all_students->data as $student){ ?>
      <tr>
        <td><?php echo $student->name ?></td> 
        <td><?php echo $student->email ?></td>  
        <td><?php echo $student->mobile ?></td>
      </tr>
         
	<?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>