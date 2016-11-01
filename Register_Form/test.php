<?php
	if(isset($_POST['submit'])){
		$val = $_POST['rtval'];
		//echo $val['username'];
		print_r($val);
	}

/*
	$data = array('email'=>'test@test.com',                        
                   'age'=>28);
	echo "<a href='page2.php?" . http_build_query($data) . "'>next page</a>";*/


?>