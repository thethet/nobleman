<?php
session_start();
$conn = mysql_connect("localhost","innov8te_noblema","LQp,vxX6~$5m");
if(!$conn){
die("Could not connect!" . mysql_error());
}
mysql_select_db("innov8te_nobleman", $conn);

$email = $_POST['email'];
$result_email_count = mysql_query("SELECT * FROM students WHERE email='".$email."' ");

$email_count = mysql_num_rows($result_email_count);

if($email_count != 0){
	header('Location: index.php?ct=1');
}else{
	$std_name = $_POST['std_name'];
	if(isset($_POST['gender'])){
	$gender = $_POST['gender'];
	}else{
	$gender = "";
	}

	if(isset($_FILES['profile_img'])){
	      $errors= array();
	      $file_name = $_FILES['profile_img']['name'];
	      $file_size =$_FILES['profile_img']['size'];
	      $file_tmp =$_FILES['profile_img']['tmp_name'];
	      $file_type=$_FILES['profile_img']['type'];
	      //$file_ext=strtolower(end(explode('.',$_FILES['profile_img']['name'])));      
	     
	      if(empty($errors)==true){
	         move_uploaded_file($file_tmp,"http://nobleman.stag-innov8te.com/uploads/".$file_name);
	         $profile_picture = $file_name;
	         //echo "Success";
	      }
	      else{
	         //print_r($errors);
	      }
	}else{
		$profile_picture = "default-img-200x200.png";
	}


	$nric = $_POST['nric'];
	$nationality = $_POST['nationality'];
	$dobd = $_POST['dobd'];
	$dobm = $_POST['dobm'];
	$doby = $_POST['doby'];
	$age = $_POST['age'];
	$race = $_POST['race'];
	$country_code = $_POST['country_code'];	
	$mobile_contact = $_POST['mobile_contact'];		
	$residential_contact = $_POST['residential_contact'];
	$email = $_POST['email'];
	$local_address = $_POST['local_address'];
	//$unit_no = $_POST['unit_no'];
	//$street_name = $_POST['street_name'];
	//$apartment_name = $_POST['apartment_name'];
	//$apartment_name = $_POST['residential_address'];
	$postal_code = $_POST['postal_code'];
	$occupation = $_POST['occupation'];
	$introlesson = $_POST['introlesson'];

	if(isset($_POST['floral_related'])){
	$floral_related = $_POST['floral_related'];
	}else{
	$floral_related = "";
	}
	$education = $_POST['education'];
	if ($education == 'Others') {
		$education = $_POST['edu_others'];
	}


	if(isset($_POST['sponsorship'])){
	$sponsorship = $_POST['sponsorship'];
	}else{
	$sponsorship = "";
	}

	date_default_timezone_set('Asia/Singapore');
	$date = date('Y-m-d h:i:s', time());
	$created_at	= $date;
	$updated_at = $date;
	$status = '0';

	$date_of_payment = "";

	/* For company information */
	$company_name = $_POST['companyname'];
	$contactperson = $_POST['contactperson'];
	$designation = $_POST['designation'];
	$company_address = $_POST['company_address'];
	$company_postalcode = $_POST['company_postalcode'];
	$company_contact_no = $_POST['company_contact_no'];
	$company_fax = $_POST['company_fax'];
	$company_email = $_POST['company_email'];
	$company_website = $_POST['company_website'];

	/* For oversea student */
	$foreign_std = $_POST['foreign_std'];
	$oversea_address = $_POST['oversea_address'];
	$oversea_zipcode = $_POST['oversea_zipcode'];
	$oversea_contact = $_POST['oversea_contact'];

	/* Emergency contact */
	$emergency_contact_person = $_POST['emergency_contact_person'];
	$emergency_contact_number = $_POST['emergency_contact_number'];

	/* Modules information */
	// $module_apply = $_POST['module_apply'];
	// $module_code = $_POST['module_code'];
	// $module_type = $_POST['module_type'];
	$module_fee = $_POST['module_fee'];

	if(isset($_POST['module_apply'])){
	$module_apply = $_POST['module_apply'];
	}else{
	$module_apply = "";
	}

	if(isset($_POST['module_code'])){
	$module_code = $_POST['module_code'];
	}else{
	$module_code = "";
	}

	if(isset($_POST['module_type'])){
	$module_type = $_POST['module_type'];
	}else{
	$module_type = "";
	}

	// if(isset($_POST['material'])){
	// $material = $_POST['material'];
	// }else{
	// $material = "";
	// }
	
	$total_no_lesson = $_POST['total_no_lesson'];
	$total_training_hour = $_POST['total_training_hour'];
	$module_duration = $_POST['module_duration'];
	// $commencement_date = $_POST['commencement_date'];
	$ecd = $_POST['ecd'];

	/* Others information */
	$exp_flower_design = $_POST['exp_flower_design'];
	$exp_detail = $_POST['exp_detail'];
	$enrollment_reason = $_POST['enrollment_reason'];
	$internet_site = $_POST['internet_site'];
	$news_directory = $_POST['news_directory'];
	$magazine = $_POST['magazine'];
	$friend_company = $_POST['friend_company'];
	$others = $_POST['others'];


	$payment_mode = $_POST['payment_mode'];

	if ($payment_mode == 'Paypal') {
		?>
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			document.getElementById('paypalfrm').submit();
		});
		</script>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypalfrm">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="info@noblemanschool.com.sg">
    <input type="hidden" name="item_name" value="Registration Fee">
    <input type="hidden" name="amount" value="<?php echo $module_fee; ?>">
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="currency_code" value="SGD">
    <!-- <input type="hidden" name="return" value="http://noblemanweb.stag-innov8te.com/paypal_success.php?status=1"> -->
    <?php 
    $arr = array(
    	   'std_name' => $std_name,
    	   'gender' => $gender,
    	   'profile_img' => $_FILES['profile_img'],
    	   'nric' => $nric,
    	   'nationality' => $nationality,
    	   'dobd' => $dobd,
    	   'dobm' => $dobm,
    	   'doby' => $doby,
    	   'age' => $age,
    	   'race' => $race,
    	   'country_code' => $country_code,    	   
    	   'mobile_contact' => $mobile_contact,
    	   'residential_contact' => $residential_contact,
    	   'email' => $email,
    	   'local_address' => $local_address,
    	   'postal_code' => $postal_code,    	   
    	   'occupation' => $occupation,
    	   'introlesson' => $introlesson,
    	   'floral_related' => $floral_related,
    	   'education' => $education,
    	   'sponsorship' => $sponsorship,
    	   'companyname' => $companyname,
    	   'contactperson' => $contactperson,
    	   'designation' => $designation,
    	   'company_address' => $company_address,
    	   'company_postalcode' => $company_postalcode,
    	   'company_contact_no' => $company_contact_no,
    	   'company_fax' => $company_fax,
    	   'company_email' => $company_email,
    	   'company_website' => $company_website,
    	   'foreign_std' => $foreign_std,
    	   'oversea_address' => $oversea_address,
    	   'oversea_zipcode' => $oversea_zipcode,
    	   'oversea_contact' => $oversea_contact,
    	   'emergency_contact_person' => $emergency_contact_person,
    	   'emergency_contact_number' => $emergency_contact_number,
    	   'module_fee' => $module_fee,
    	   'module_apply' => $module_apply,
    	   'module_code' => $module_code,
    	   'module_type' => $module_type,
    	   'total_no_lesson' => $total_no_lesson,
    	   'total_training_hour' => $total_training_hour,
    	   'module_duration' => $module_duration,
    	   'ecd' => $ecd,
    	   'exp_flower_design' => $exp_flower_design,
    	   'exp_detail' => $exp_detail,
    	   'enrollment_reason' => $enrollment_reason,
    	   'internet_site' => $internet_site,
    	   'news_directory' => $news_directory,
    	   'magazine' => $magazine,
    	   'friend_company' => $friend_company,
    	   'others' => $others,
    	   'payment_mode' => $payment_mode
    	);
	$data = http_build_query($arr);
    ?>
    <input type="hidden" name="return" value="http://noblemanweb.stag-innov8te.com/paypal_success.php?<?php echo $data; ?>">
    <input type="image" src="https://www.paypal.com/en_AU/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." id="paybut">
    <img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1" id="paybut">
</form>

<?php }else{
	$payment_status = 0;

	$conn = mysql_connect("localhost","root","");
	if (!$conn)
	{
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("innov8te_nobleman", $conn);

	$role = 3;

	mysql_query("INSERT INTO users (show_id, email, created_at, updated_at, role, status) VALUES ('".$std_name."', '".$email."', '".$created_at."', '".$updated_at."', '".$role."', '".$status."') ");

	$get_userid_result = mysql_query("SELECT id FROM users WHERE email='".$email."' ");
	$get_userid_row = mysql_fetch_array($get_userid_result);
	$get_userid = $get_userid_row['id'];

	mysql_query("INSERT INTO students (user_id, name, profile_picture, gender, nric, nationality, dobd, dobm, doby, age, race, country_code, mobile_contact, residential_contact, email, local_address, postal_code, occupation, intro_lesson, floral_related, education, emergency_contact_person, emergency_contact_number, sponsorship, created_at, updated_at, payment_mode, payment_status, date_of_payment, status, company_name, contact_person, designation, company_address, company_postalcode, company_contact_no, company_fax, company_email, company_website, oversea_address, foreign_student, oversea_zipcode, oversea_contact, ecd, exp_flower_design, exp_detail, enrollment_reason, internet_site, news_directory, magazine, friend_company, others) 
				 VALUES ('".$get_userid."', '".$std_name."', '".$profile_picture."', '".$gender."', '".$nric."', '".$nationality."', '".$dobd."', '".$dobm."', '".$doby."', '".$age."', '".$race."', '".$country_code."', '".$mobile_contact."', '".$residential_contact."', '".$email."', '".$local_address."', '".$postal_code."', '".$occupation."', '".$introlesson."', '".$floral_related."', '".$education."', '".$emergency_contact_person."', '".$emergency_contact_number."', '".$sponsorship."', '".$created_at."', '".$updated_at."', '".$payment_mode."', '".$payment_status."', '".$date_of_payment."', '".$status."', '".$company_name."', '".$contactperson."', '".$designation."', '".$company_address."', '".$company_postalcode."', '".$company_contact_no."', '".$company_fax."', '".$company_email."', '".$company_website."', '".$oversea_address."', '".$foreign_std."', '".$oversea_zipcode."', '".$oversea_contact."', '".$ecd."', '".$exp_flower_design."', '".$exp_detail."', '".$enrollment_reason."', '".$internet_site."', '".$news_directory."', '".$magazine."', '".$friend_company."', '".$others."') ");

		

		$stdid_result = mysql_query("SELECT id FROM students WHERE email='".$email."' ");
		$stdid_result_row = mysql_fetch_array($stdid_result);
		$stdid = $stdid_result_row['id'];

		$module_status = 0;
		mysql_query("INSERT INTO student_course (student_id, course_id, status) VALUES ('".$stdid."', '".$module_apply."', '".$module_status."') ");


		/*************************************************************************************/		

		$result1 = mysql_query("SELECT * FROM students WHERE email='".$email."' ");
		$row1 = mysql_fetch_array($result1);

		$result2 = mysql_query("SELECT * FROM users WHERE email='".$email."' ");
		$row2 = mysql_fetch_array($result2);
		
		session_start();
		$_SESSION["pstd_id"] = $row1['id'];
		$_SESSION["puser_id"] = $row2['id'];
		

//mysql_close();

/****************************************************************************/

/* send email */	
//$to_email = "nan.kalayar@innov8te.com.sg";
$to_email = $email;
$subject = "Thanks for your registration from nobleman school";

$message_body = '<html><body>
				<h6>Thank you for your registration.</h6>
				</body></html>';
$nb_email = "nan.kalayar@innov8te.com.sg";	

$headers = 'From: '.$nb_email.'' . "\r\n" .
'Reply-To: '.$nb_email.'' . "\r\n" .
"Content-Type: text/html; charset=ISO-8859-1\r\n" .
'X-Mailer: PHP/' . phpversion();
   
mail($to_email, $subject, $message_body, $headers);

/* End send mail */

/****************************************************************************/

}//end paypal condition

}//End if

?>

<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="sus-wrapper">

	<div class="reg-success">
	
	<?php
		if($payment_mode == 'Bank Transfer'){ ?>
		<div id="frmtitle">
	      <div class="col-xs-12 col-sm-3 col-md-3 frmtitle-col">
	        <span class="tit-no ggcl">&#10004;</span>
	        <span class="tit-line ggcl"></span>
	        <h1>Applicant's Particulars</h1>
	      </div>

	      <div class="col-xs-12 col-sm-3 col-md-3 frmtitle-col">
	        <span class="tit-no ggcl">&#10004;</span>
	        <span class="tit-line ggcl"></span>
	        <h1>Module Information</h1>
	      </div>

	      <div class="col-xs-12 col-sm-3 col-md-3 frmtitle-col">
	        <span class="tit-no ggcl">&#10004;</span>
	        <span class="tit-line ggcl"></span>
	        <h1>Other Information</h1>
	      </div>

	      <div class="col-xs-12 col-sm-3 col-md-3 frmtitle-col">
	        <span class="tit-no ggcl">&#10004;</span>
	        <h1>Payment Summary</h1>
	      </div>
	    </div><!-- #frmtitle -->

	    <div class="row">
	    <div class="col-md-12 success-tit">
	    <h1>YOU HAVE COMPLETED THE REGISTRATION </h1>
	    <h1>THANK YOU!</h1>
	    </div>
	    </div>

		<?php	
			/*echo '<p>Please check your email for confirmation of your registration after payment have been received by us.</p>';
			echo 'Please trasnfer (<b class="btxt1">'.$module_fee.' S$</b>) to my personal bank account <b class="btxt"><u>1400384839</u></b>';
*/
			echo '<p>We will temporary reserve your slots. Kindly transfer your fee (Using FAST if transferring from
different bank) to the <b class="btxt"><u>UOB 145-3011-041</u></b> within 3 days to confirm your slot. Kindly notify us by
email to info@noblemanschool.com.sg upon successful transfer and retain your transaction receipt
for verification purpose.</p>';
	
			echo '<div style="margin-top:30px;">
					<a href="http://www.noblemanschool.com" class="backbtn">BACK</a>
					</div>';
		}

		if($payment_mode == 'Direct Payment'){ ?>
		<div id="frmtitle">
	      <div class="col-xs-12 col-sm-3 col-md-3 frmtitle-col">
	        <span class="tit-no ggcl">&#10004;</span>
	        <span class="tit-line ggcl"></span>
	        <h1>Applicant's Particulars</h1>
	      </div>

	      <div class="col-xs-12 col-sm-3 col-md-3 frmtitle-col">
	        <span class="tit-no ggcl">&#10004;</span>
	        <span class="tit-line ggcl"></span>
	        <h1>Module Information</h1>
	      </div>

	      <div class="col-xs-12 col-sm-3 col-md-3 frmtitle-col">
	        <span class="tit-no ggcl">&#10004;</span>
	        <span class="tit-line ggcl"></span>
	        <h1>Other Information</h1>
	      </div>

	      <div class="col-xs-12 col-sm-3 col-md-3 frmtitle-col">
	        <span class="tit-no ggcl">&#10004;</span>
	        <h1>Payment Summary</h1>
	      </div>
	    </div><!-- #frmtitle -->

	    <div class="row">
	    <div class="col-md-12 success-tit">
	    <h1>YOU HAVE COMPLETED THE REGISTRATION </h1>
	    <h1>THANK YOU!</h1>
	    </div>
	    </div>

		<?php	
			//echo '<p>Thank you for your registration.Please check your email.We will send through your email after finish confirm the payment.</p>';
			echo '<p>Please kindly make your way down to our school to make payment within 2 days after you registered otherwise your registration will not be considered.</p>';
			echo '
					<div style="margin-top:25px;margin-bottom:0px;">We are located at: </div> <br />

					Blk 10, North Bridge Road, #02-5107, <br />
					Singapore 190 010 <br />
					Tel: (+65) 6296 3977     Fax: (+65) 6291 3192.<br />

					
					<div style="margin-top:25px;margin-bottom:0px;">Our Operating Hours:- </div><br />

            		Monday, Wednesday, Friday                 :           11am - 6pm <br />

                    Tuesday, Thursday                         :           11am - 9pm <br />

                    Saturday                                  :           10am – 12pm <br />

                    Sunday & Public Holiday                   :           Closed <br />';

			echo '<div style="margin-top:30px;">
					<a href="http://www.noblemanschool.com" class="backbtn">BACK</a>
					</div>';
		}
	?>
	
	</div><!-- .reg-success -->
</div><!-- .sus-wrapper -->

</body>
</html>

