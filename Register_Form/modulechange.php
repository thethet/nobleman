<?php
$conn = mysql_connect("localhost","innov8te_noblema","LQp,vxX6~$5m");
if (!$conn)
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("innov8te_nobleman", $conn);

if($_POST['id'])
{  
	$id=$_POST['id'];
	
	$sql="SELECT * FROM courses WHERE id='".$id."' ";
    $result=mysql_query($sql) or die(mysql_error());

    $row = mysql_fetch_array($result);


    // while($row = mysql_fetch_array($result))
		  // {
		  // 	echo '<option value='.$row['id'].' id="mid">'.$row['module_name'].'</option>';
		  // }

	
$html1 = '
	<div class="divider"> 
      <label>Course Code : </label>
      <input type="text" name="module_code" id="module_code" readonly value="'.$row['course_code'].'" />
    </div> 

    <div class="divider">
      <label>Course Type : </label> 
      <input type="text" name="module_type" id="module_type" readonly value="'.$row['course_type'].'" />
    </div>

    <div class="divider"> 
      <label>Total Course Fee : </label>
      <input type="text" name="module_fee" id="module_fee" readonly value="'.$row['cost_of_course'].'" />
    </div>
    ';


  $html2 = '
	<div class="divider"> 
      <label>Total No. of Lesson : </label>
      <input type="text" name="total_no_lesson" id="total_no_lesson" readonly value="'.$row['no_of_lesson'].'" />
    </div> 

    <div class="divider">
      <label>Total Training Hours : </label> 
      <input type="text" name="total_training_hour" id="total_training_hour" readonly value="'.$row['no_hours_per_lesson'].'" />
    </div>

    <div class="divider"> 
      <label>Course Duration : </label>
      <input type="text" name="module_duration" id="module_duration" readonly value="'.$row['duration_of_course'].'" />
    </div>
    ';

    $data = array('html1'=>$html1, 'html2'=>$html2);
	  echo json_encode($data);

}
?>