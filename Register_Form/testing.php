<?php
	
if(isset($_POST['submit'])){

	$path_of_storage = '/uploads/';
    $newftpdir = $_SESSION['SESS_ORDER_ID'];

    $conn_id = ftp_connect("nobleman.stag-innov8te.com");
    ftp_pasv($conn_id, true); 
    $login_result = ftp_login($conn_id, "nobleman@stag-innov8te.com", "KD;o7I)-oH]T");

    	//ftp_mksubdirs($conn_id,$path_of_storage,$newftpdir);

        $source_file = $_FILES['profile_img']['name'];
        $destination_file = "$path_of_storage".$source_file;
        $destination = "$path_of_storage";          

            // check connection
            if ((!$conn_id) || (!$login_result)) { 
                echo "FTP connection has failed!";
                exit; 
            } else {
                echo "Connected";
            }

            // upload the file
            $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY); 

            $name = $_FILES["profile_img"]["name"];
            move_uploaded_file($source_file, "$destination/$name");

    // check upload status
    if (!$upload) { 
    echo "FTP upload has failed! $destination_file";
    } else {
    echo "Uploaded $source_file as $destination_file";
    }

    // close the FTP stream 
    ftp_close($conn_id);       

}//end if


?>

<form action="testing.php" method="post" enctype="multipart/form-data">
	 <div class="divider"> 
      <label>Profile Image : </label>  
      <input type="file" name="profile_img" /> 
    </div>

    <input type="submit" name="submit" value="Submit" />
</form>