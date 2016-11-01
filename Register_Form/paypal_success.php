<?php
  session_start();
  $conn = mysql_connect("localhost","innov8te_noblema","LQp,vxX6~$5m");
  if(!$conn){
    die("Could not connect!" . mysql_error());
  }
  mysql_select_db("innov8te_nobleman", $conn);

  /**********************************************/

  $std_name = $_GET['std_name'];
  if(isset($_GET['gender'])){
  $gender = $_GET['gender'];
  }else{
  $gender = "";
  }
  if(isset($_FILES['profile_img'])){
        $errors= array();
        $file_name = $_FILES['profile_img']['name'];
        $file_size =$_FILES['profile_img']['size'];
        $file_tmp =$_FILES['profile_img']['tmp_name'];
        $file_type=$_FILES['profile_img']['type'];
       
        if(empty($errors)==true){
           move_uploaded_file($file_tmp,"http://nobleman.stag-innov8te.com/uploads/".$file_name);
           $profile_picture = $file_name;
        }
       
  }else{
    $profile_picture = "default-img-200x200.png";
  }

  $nric = $_GET['nric'];
  $nationality = $_GET['nationality'];
  $dobd = $_GET['dobd'];
  $dobm = $_GET['dobm'];
  $doby = $_GET['doby'];
  $age = $_GET['age'];
  $race = $_GET['race'];
  $country_code = $_GET['country_code'];
  $mobile_contact = $_GET['mobile_contact'];   
  $residential_contact = $_GET['residential_contact'];
  $email = $_GET['email'];
  $local_address = $_GET['local_address'];

  $postal_code = $_GET['postal_code'];
  $occupation = $_GET['occupation'];
  $introlesson = $_GET['introlesson'];
  if(isset($_GET['floral_related'])){
  $floral_related = $_GET['floral_related'];
  }else{
  $floral_related = "";
  }
  $education = $_GET['education'];
  if ($education == 'Others') {
    $education = $_GET['edu_others'];
  }

  if(isset($_GET['sponsorship'])){
  $sponsorship = $_GET['sponsorship'];
  }else{
  $sponsorship = "";
  }

  date_default_timezone_set('Asia/Singapore');
  $date = date('Y-m-d h:i:s', time());
  $created_at = $date;
  $updated_at = $date;
  //$status = '0';

  //$date_of_payment = "";

  /* For company information */
  $company_name = $_GET['companyname'];
  $contactperson = $_GET['contactperson'];
  $designation = $_GET['designation'];
  $company_address = $_GET['company_address'];
  $company_postalcode = $_GET['company_postalcode'];
  $company_contact_no = $_GET['company_contact_no'];
  $company_fax = $_GET['company_fax'];
  $company_email = $_GET['company_email'];
  $company_website = $_GET['company_website'];

  /* For oversea student */
  $foreign_std = $_GET['foreign_std'];
  $oversea_address = $_GET['oversea_address'];
  $oversea_zipcode = $_GET['oversea_zipcode'];
  $oversea_contact = $_GET['oversea_contact'];

  /* Emergency contact */
  $emergency_contact_person = $_GET['emergency_contact_person'];
  $emergency_contact_number = $_GET['emergency_contact_number'];

  $module_fee = $_GET['module_fee'];

  if(isset($_GET['module_apply'])){
  $module_apply = $_GET['module_apply'];
  }else{
  $module_apply = "";
  }

  if(isset($_GET['module_code'])){
  $module_code = $_GET['module_code'];
  }else{
  $module_code = "";
  }

  if(isset($_GET['module_type'])){
  $module_type = $_GET['module_type'];
  }else{
  $module_type = "";
  }

  $total_no_lesson = $_GET['total_no_lesson'];
  $total_training_hour = $_GET['total_training_hour'];
  $module_duration = $_GET['module_duration'];
  $ecd = $_GET['ecd'];

  /* Others information */
  $exp_flower_design = $_GET['exp_flower_design'];
  $exp_detail = $_GET['exp_detail'];
  $enrollment_reason = $_GET['enrollment_reason'];
  $internet_site = $_GET['internet_site'];
  $news_directory = $_GET['news_directory'];
  $magazine = $_GET['magazine'];
  $friend_company = $_GET['friend_company'];
  $others = $_GET['others'];

  $payment_mode = $_GET['payment_mode'];

  $role = 3;

  $status = 1;
  $payment_status = 1;
  date_default_timezone_set('Asia/Singapore');
  $date_of_payment = $date;   

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

    /* send email for activated account for paypal */
    $to_email = $email;
    $subject = "Thanks for your registration from nobleman school";

    $loginpassword = 'n@b$lm8n0std&';
    $message_body = '<html><body>
            <p>Hi '.$std_name.',</p>
            <P></p>
            <p>Thank you for your registration!Your account has been activated.</p>
            <p>Payment is successful.Your account credentials is as follow:</p>
            <P>Login email : '.$to_email.'</p>
            <P>Password : '.$loginpassword.'</p>
            <P></p>
            </body></html>';
    $nb_email = "nan.kalayar@innov8te.com.sg";  

      $headers = 'From: '.$nb_email.'' . "\r\n" .
      'Reply-To: '.$nb_email.'' . "\r\n" .
      "Content-Type: text/html; charset=ISO-8859-1\r\n" .
      'X-Mailer: PHP/' . phpversion();
     
    mail($to_email, $subject, $message_body, $headers);

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

  <div class="reg-success">  
    <p>We Have Sent You An Email For Your Successful Registration</p>
  </div><!-- .reg-success -->


</div><!-- .sus-wrapper -->

</body>
</html>