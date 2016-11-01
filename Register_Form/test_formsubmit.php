 <?php 
   /* $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
    $data = json_encode($arr);*/

   /* $postArray = array(
      "startDate" => 'gdfgfdg',
      "headline" => 'dgdfg'
      
    );*/ //you might need to process any other post fields you have..

    //$json = json_encode( $postArray );

    // make sure there were no problems
    //if( json_last_error() != JSON_ERROR_NONE ){
        //exit;  // do your error handling here instead of exiting
    // }
    //$file = 'entries.json';
    // write to file
    //   note: _server_ path, NOT "web address (url)"!
    //file_put_contents( $file, $json, FILE_APPEND);


   // $postArray = '100';





 $url = 'test.php';
 
//Initiate cURL.
$ch = curl_init($url);
 
//The JSON data.
$jsonData = array(
    'username' => 'MyUsername',
    'password' => 'MyPassword'
);
 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
 
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
 
//Execute the request
$result = curl_exec($ch);


?>
<form action="test.php" method="post" id="paypalfrm">
  <input type="hidden" name="rtval" value="test.php?<?php echo http_build_query($jsonData); ?>">
  <input type="submit" name="submit" value="Submit">
</form>


