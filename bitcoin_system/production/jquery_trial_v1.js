
//Initializations ( flags )

var flag1 = 0, flag2 = 0, flag3 = 0, flag4 = 0, flag5 = 0, flag6 = 0;

	//Start the jquery code
	$(document).ready(function() {

	$('#first_form').submit(function(e) {
    e.preventDefault();
	
	//Take the values of the text boxes using IDs and val()
	var full_name = $('#Fullname').val();
	var email = $('#email').val();
	var confirm_email = $('#email2').val();
	var username = $('#Username').val();
	var password_main = $('#password').val();
	var confirm_password = $('#password2').val();
	
	//Regex for password strength
	var pattern = "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])";
	/*var pattern_upper = "(?=.*[A-Z])";
	var pattern_lower = "^(?=.*[a-z])";
	var pattern_number = "(?=.*[0-9])";
	var pattern_special = "(?=.*[!@#\$%\^&\*])";*/
	
	//Remove error messages after refreshing and clicking submit
	 $(".error").remove();
	 $(".error_text").remove();
	 $(".error_password_length").remove();
	 $(".error_password_pattern").remove();
	 /*$(".error_password_pattern_upper").remove();
	 $(".error_password_pattern_lower").remove();
	 $(".error_password_pattern_number").remove();
	 $(".error_password_pattern_special").remove();*/
	 
	//Check blank input for fullname
	if ( full_name.length < 1 ) {
      
		$('#label_fullname').after("<span class=error>!</span>");
		$('#Fullname').after('<br><span class=error_text>This field is required</span>');
		flag1 = flag1 + 1;
		//$('#Fullname').focus();
	}
	 
	//Check blank input for email
	if( email.length < 1 ) {
		 
		$('#label_email').after("<span class=error>!</span>");
		$('#email').after('<br><span class=error_text>This field is required</span>');
		flag2 = flag2 + 1;
		//$('#email').focus();
	}
	
	//Check if email is valid
	if( email.length > 1 ) {
		var regEx = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
      var validEmail = regEx.test(email);
      if (!validEmail) {
       // $('#email').after('<span class="error">Enter a valid email</span>');
	   
	   $('#label_email').after("<span class=error>!</span>");
		$('#email').after('<br><span class=error_text>Enter a valid email id</span>');
	  flag2 = flag2 + 1;
      }
	}
	
	//Check if email and confirm_email fields match
	if( !( email == confirm_email ) ) {
	
		$('#label_email').after("<span class=error>!</span>");
		$('#email').after('<br><span class=error_text>Emails did not match</span>');
		flag2 = flag2 + 1;
	}
	
	//Check blank input for confirm_email
	if( confirm_email.length < 1 ) {
		 
		$('#label_confirm_email').after("<span class=error>!</span>");
		$('#email2').after('<br><span class=error_text>This field is required</span>');
		flag3 = flag3 + 1;
		//$('#email2').focus();
	}
	
	//Check blank input for username
	if( username.length < 1 ) {
		 
		$('#label_username').after("<span class=error>!</span>");
		$('#Username').after('<br><span class=error_text>This field is required</span>');
		flag4 = flag4 + 1;
		//$('#Username').focus();
	}
	
	//Check blank input for password
	if( password_main.length < 1 ) {
		 
		$('#label_password').after("<span class=error>!</span>");
		$('#password').after('<br><span class=error_text>This field is required</span>');
		flag5 = flag5 + 1;
		//$('#password').focus();
	}
	
	if( password_main.length > 1 ) {
		
		//Check if password length is 8 characters or longer
		if( password_main.length < 8 ) {
			
			$('#label_password').after("<span class=error>!</span>");
			$('#password').after('<br><span class=error_password_length>Password must contain at least 8 characters</span>');
			flag5 = flag5 + 1;
		}
		
		//Added now
		else if( !( password_main.match( pattern ) ) ) {
			
			$('#label_password').after("<span class=error>!</span>");
			$('#password').after('<br><span class=error_password_pattern>Password must be a combination of letters,numbers and symbols</span>');
			flag5 = flag5 + 1;
		}
		
		
	}
	
	
	//Check blank input for confirm_password
	if( confirm_password.length < 1 ) {
		 
		$('#label_confirm_password').after("<span class=error>!</span>");
		$('#password2').after('<br><span class=error_text>This field is required</span>');
		flag6 = flag6 + 1;
		//$('#password2').focus();
	}
	
	//Check if password and confirm_password fields match
	if( !( password_main == confirm_password ) ) {
	
		$('#label_password').after("<span class=error>!</span>");
		$('#password').after('<br><span class=error_password_match>Passwords did not match</span>');
		flag5 = flag5 + 1;
	}
	
	
	if( flag1 == 1 ) {
		$('#Fullname').focus();
		
	}
	
	else if( flag2 > 1 ) {
		$('#email').focus();
		
	}
	
	/*else if( flag2 == 2 ) {
		$('#email').focus();
	}
	
	else if( flag2 == 3 ) {
		$('#email').focus();
	}*/
	
	else if( flag3 == 1 ) {
		$('#email3').focus();
		
	}
	
	else if( flag4 == 1 ) {
		$('#Username').focus();
		
	}
	
	else if( flag5 > 1 ) {
		$('#password').focus();
		
	}
	
	/*else if( flag5 == 2 ) {
		$('#password').focus();
		
	}*/
	
	else if( flag6 == 1 ) {
		$('#password2').focus();
		
	}
	
	if( flag1 == 1 && flag2 == 1 && flag3 == 1 && flag4 == 1 && flag5 == 1 && flag6 == 1 ) {
		$('#Fullname').focus();
		
	}
	
  });
  
 });