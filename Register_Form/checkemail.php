<?php
$conn = mysql_connect("localhost","root","");
if(!$conn){
die("Could not connect!" . mysql_error());
}
mysql_select_db("innov8te_nobleman", $conn);

$email = $_POST['email'];
$result_email_count = mysql_query("SELECT * FROM users WHERE email='".$email."' ");

$email_count = mysql_num_rows($result_email_count);

if($email_count != 0){
	$message = 'already_email';
}else{
	$message = '';
}


$data = array('message'=>$message);
echo json_encode($data);



?>