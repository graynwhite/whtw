<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Test post</title>
<meta name="viewport" content="width=device-width, user-scalable=yes" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/template.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="mobile.css"/>
	
		
		
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/jquery-1.8.2.min.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/languages/jquery.validationEngine-en.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/jquery.validationEngine.js"></script>
		<!--<script src="http://www.graypluswhite.com/dough/Dough/dough.min.js"></script> -->
<script> 		
	$(document).ready(function(){
		console.log('Starting ready function');
	    $("#formInput").validationEngine('attach',{promptPosition : "topLeft:150,5"});
		$('#submit_form').click(function(e){
			 e.preventDefault();

			 //if invalid do nothing
			 if(!$("#formInput").validationEngine('validate')){
			 return false;
			  }
		})
	  var formvalues=$('#formInput').serialize();
	  $.ajax({
		type: "POST",
		url: "test_handle.php",
		data: formvalues,
		success: function () {
		  $('#returnmessage').html('<div id="message"></div>');
		  $('#message').html('<h5>Thank You !</h5>')
		  .append(data)
		  .append('<p>We have recieved your request. Please Check your mail for activation instructions. You will start recieving our newsletter once you have verified this email address.</p>')
		  .hide()
		  .fadeIn(1200);
		  }
	  	});
	  return false;
			});
	
	</script>	
<script>
		// Replace ending plus sign or  end of a string plus signs with blanks'
		function myTrim( x ) {
			return x.replace( /^\s+|\s+$/gm, '' );
		}
	</script>
</head>

<body>
<form  action="" method="post" id="formInput">
name:<input type="text" name="name" data-validation-engine="validate[required]" data-prompt-position"topLeft">
Occupation:<input type="text" name="occupation" data-validation-engine="validate[required]">
Email:<input type="email" name="email" id="email" data-validation-engine="validate[required,custom[email]]"
    data-errormessage-value-missing="Email is required!" 
    data-errormessage-custom-error="Let me give you a hint: someone@nowhere.com" 
    data-errormessage="This is the fall-back error message."/>
	</form>
<input type="button" id="submit_form" value="submit">
	
	<div id="returnmessage"></div>
</body>
</html>