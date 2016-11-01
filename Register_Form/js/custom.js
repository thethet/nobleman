$(document).ready(function(){

	$('#otherinfo_next').click(function(){
		$("#other_info").hide();
		$("#payment_info").fadeIn('300');
	});


  
  $('#modulebtn_back').click(function(){
    $("#module_info").hide();
    $("#appli_particular").fadeIn('300');
  });

});


/* form validation */
function validateForm1()
{
    var std_name = document.forms["regfrm"]["std_name"].value;
    var nric = document.forms["regfrm"]["nric"].value;
    var mobile_contact = document.forms["regfrm"]["mobile_contact"].value;
    var email = document.forms["regfrm"]["email"].value;
    var local_address = document.forms["regfrm"]["local_address"].value;
    var postal_code = document.forms["regfrm"]["postal_code"].value;
   

    var emergency_contact_person = document.forms["regfrm"]["emergency_contact_person"].value;
    var emergency_contact_number = document.forms["regfrm"]["emergency_contact_number"].value;

    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

    var company = document.forms["regfrm"]["sponsor_yes"].checked;

    var foreign_std = document.forms["regfrm"]["foreign_std_yes"].checked;


    if (company == true) {
      var companyname = document.forms["regfrm"]["companyname"].value;
      var contactperson = document.forms["regfrm"]["contactperson"].value;
      var company_postalcode = document.forms["regfrm"]["company_postalcode"].value;
      var company_contact_no = document.forms["regfrm"]["company_contact_no"].value;
      var company_email = document.forms["regfrm"]["company_email"].value;      

      if (companyname == null || companyname == "") {
          $("#companyname_err").html("This field is required.").show();
      }else{
          $("#companyname_err").html("This field is required.").hide();
      }

      if (contactperson == null || contactperson == "") {
          $("#company_contactperson_err").html("This field is required.").show();
      }else{
          $("#company_contactperson_err").html("This field is required.").hide();
      }

      if (company_postalcode == null || company_postalcode == "") {
          $("#company_postalcode_err").html("This field is required.").show();
      }else{
          $("#company_postalcode_err").html("This field is required.").hide();
      }

      if (company_contact_no == null || company_contact_no == "") {
          $("#company_contact_no_err").html("This field is required.").show();
      }else{
          $("#company_contact_no_err").html("This field is required.").hide();
      }


      if (!re.test(company_email))
      {
          $("#company_email_err").html("Please enter a valid email address.").show();
      }else{
          $("#company_email_err").html("Please enter a valid email address.").hide();
      }


    }//end

    if(foreign_std == true) {
      var oversea_address = document.forms["regfrm"]["oversea_address"].value;
      var oversea_zipcode = document.forms["regfrm"]["oversea_zipcode"].value;
      var oversea_contact = document.forms["regfrm"]["oversea_contact"].value;

      if (oversea_address == null || oversea_address == "") {
          $("#oversea_address_err").html("This field is required.").show();
      }else{
          $("#oversea_address_err").html("This field is required.").hide();
      }

      if (oversea_zipcode == null || oversea_zipcode == "") {
          $("#oversea_zipcode_err").html("This field is required.").show();
      }else{
          $("#oversea_zipcode_err").html("This field is required.").hide();
      }

      if (oversea_contact == null || oversea_contact == "") {
          $("#oversea_contact_err").html("This field is required.").show();
      }else{
          $("#oversea_contact_err").html("This field is required.").hide();
      }

     
    }//end

 
    if (std_name == null || std_name == "") {
        $(".nameerror").html("This field is required.").show();
    }else{
    	$(".nameerror").html("This field is required.").hide();
    }

    if (nric == null || nric == "") {
        $(".nricerror").html("This field is required.").show();
    }else{
    	$(".nricerror").html("This field is required.").hide();
    }

    if (mobile_contact == null || mobile_contact == "") {
        $("#mobile_contact_err").html("This field is required.").show();
    }else{
        $("#mobile_contact_err").html("This field is required.").hide();
    }

    if (email == null || email == "") {
        $(".emailerror").html("This field is required.").show();
    }else{
    	  $(".emailerror").html("This field is required.").hide();
         // var email = $('#email').val();
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

        if (!re.test(email))
        {
            $(".emailerror").html("Please enter a valid email address.").show();
            return false;
        }else{
            $(".emailerror").html("Please enter a valid email address.").hide();
        }
    }


    if (local_address == null || local_address == "") {
        $(".local_address_err").html("This field is required.").show();
    }else{
        $(".local_address_err").html("This field is required.").hide();
    }

    if (postal_code == null || postal_code == "") {
        $("#postal_code_err").html("This field is required.").show();
    }else{
        $("#postal_code_err").html("This field is required.").hide();
    }
    
    if (emergency_contact_person == null || emergency_contact_person == "") {
        $(".emergency_contact_person_err").html("This field is required.").show();
    }else{
        $(".emergency_contact_person_err").html("This field is required.").hide();
    }

    if (emergency_contact_number == null || emergency_contact_number == "") {
        $(".emergency_contact_number_err").html("This field is required.").show();
    }else{
        $(".emergency_contact_number_err").html("This field is required.").hide();
    }
    

    if(company == true && foreign_std == true)
    {      
      if(std_name != "" && nric != "" && email != "" && emergency_contact_person != "" && emergency_contact_number != "" && companyname != "" && contactperson != "" && company_postalcode != "" && company_contact_no != "" && oversea_address != "" && oversea_zipcode != "" && oversea_contact != ""){
          $("#appli_particular").hide();
          $("#module_info").fadeIn('300');
          return true;
      }else{
        return false;
      }

    }else if (company == true && foreign_std == false) {
      if(std_name != "" && nric != "" && email != "" && emergency_contact_person != "" && emergency_contact_number != "" && companyname != "" && contactperson != "" && company_postalcode != "" && company_contact_no != ""){
          $("#appli_particular").hide();
          $("#module_info").fadeIn('300');
          return true;
      }
      else{     
        return false;
      }

    }else{
      if(std_name != "" && nric != "" && email != "" && local_address != "" && postal_code != "" && emergency_contact_person != "" && emergency_contact_number != ""){
         
           /**************************************************/
           var postData ={'email': email};
           $.ajax({
            type: "POST",
            dataType: "json",
            url: "checkemail.php",
            data: postData,
            cache: false,
            success: function(data)
            {
              if (data.message == 'already_email') {
                $("#email_already_err").html('Your email address is already registed in Nobleman!');   
                return false;
              }else{
                //alert('Success!');
                $("#appli_particular").hide();
                $("#module_info").fadeIn('300');
                return true;
              }
              
            }


           });
           /**************************************************/

/*
          $("#appli_particular").hide();
          $("#module_info").fadeIn('300');
          return true;*/
      }
      else{   
        return false;
      }

    }//end



}// End validateForm



/* form validation for module information */
function validateForm2()
{    
    var module = document.forms["regfrm"]["module_apply"].value;
    if (module == 0) {
        $(".moduleerror").html("Please choose the module.").show();
    }else{
        $(".moduleerror").html("Please choose the module.").hide();
    }

    if(module != 0 ){
      $("#appli_particular").fadeOut('300');
      $("#module_info").hide();
      $("#other_info").fadeIn('300');
      return true;
    }
    else{    	
    	return false;
	}

}// End validateForm2


function validateForm3()
{
  var payment_mode = document.forms["regfrm"]["payment_mode"].value;
  var agree = document.forms["regfrm"]["agree"].checked;

  if(payment_mode == 0){
    $(".paymerror").html("Please choose the payment mode.").show();
  }else{
    $(".paymerror").html("Please choose the payment mode.").hide();
  }

  if (payment_mode != 0) {
    if(agree == false){
      alert("Please check the agree for rules and regulation.");
      return false;
    }
    return true;
  }else{
    return false;
  }

}


/* For back button click event */
jQuery(document).ready(function($){
    $('body').on('click', '#back1', function(){
        $('#appli_particular').show();     
        $("#module_info").hide();   
    });

    /***********************************/

    $('body').on('click', '#back2', function(){
      $('#module_info').show();
      $("#other_info").hide();
    });

    /***********************************/

    $('body').on('click', '#back3', function(){
      $('#other_info').show();
      $("#payment_info").hide();
    });

    /***********************************/
    
});


/***********************************/

/* check the nationality */

function checkNationality()
{
  var nat = document.getElementById('nationality').value;

  if (nat == 'Singapore') {
    document.getElementById("foreign_std_no").checked = true;
    $("#foreignstdfrm").fadeOut('300');
  }else{
    document.getElementById("foreign_std_yes").checked = true;
    $("#foreignstdfrm").fadeIn('300');
  }

}


