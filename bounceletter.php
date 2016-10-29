<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bounce Letter Subscriber</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
{
$("#emailid").mousedown(function(){
	$("#returnMessage").val(' ');
});
	
$("#emailid").mouseenter(function(){
		
		var title = getSelectionText();
		$("#returnMessage").val(' ');
		$("#emailid").val(title);
		
	
	});
$("#firstName").mouseenter(function(){
		if($("#firstName").val()==''){
		var title = getSelectionText();
		$("#firstName").val(title);
		}
	
	});	
function getSelectionText() {
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        text = document.selection.createRange().text;
    }
    return text;
}	


function sendLetter(){
	console.log("at send letter");
	var recipientName = document.getElementById("firstName");
	console.log("first name " + recipientName.value);
	var recipientEmail = document.getElementById("emailid");
	console.log("emailid " + recipientEmail.value);
	
	$.ajax({
			type: 'POST',
			url: "bouncemailer.php",
			data: {pubname: recipientName.value, recipient: recipientEmail.value, reason: reason.value }
		}) 
		.done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			
			// Set the message text.
			$('#returnMessage').text(response);
			$('#emailid').val(' ');
			$('#firstName').val(' ');
	
		})
		.fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			

			// Set the message text.
			if (data.responseText !== '') {
				$("#returnMessage").text(data.responseText);
			} else {
				$("#returnMessage").text('Oops! An error occured and your message could not be sent.');
			}
		});
}
}
</script>
</head>

<body>

<div id="returnMessage"></div>
<br />

<form name="inputForm" action="" id="inputForm" method="post">
Email: <input type="email" name="eAddress" id="emailid"/><br />
First Name: <input type="text" name="firstName" id="firstName"/><br />
Reason: <select name="reason" id="reason" size="1"  >
<option value="Nonexistent" >Nonexistent</option>
<option value="Undeliverable" >Nondeliverable</option>
<option value="Blocked" >Blocked</option>
<option value="Other" >Other</option>
</select>
<input type="button" id="sendButton" value="Send" onClick="sendLetter()" />  

</form>

</body>
</html>