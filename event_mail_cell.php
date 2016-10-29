<?php
$genVercode = rand(10000,99999);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Organization Event Input</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../javascript/typeAhead.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="http://www.graynwhite.com/css/common.css" />
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<link rel="stylesheet" href="http://pjnews.mobi/peggyjo4.css"/>
	<script src="../javascript/ajaxBasics.js" type="text/javascript"></script>
	<script src="../javascript/typeAhead.js" type="text/javascript"></script>
	
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	<script src= "http://www.graynwhite.com/javascript/calendarDisplay.inc" language="javascript" type="text/javascript"></script>
	
	
<?php

$sourceg = $_SERVER['REMOTE_ADDR'];
//echo "the source is " . $sourceg;
//exit;
?>
<script language="JavaScript" type="text/javascript">
var toast=function(msg){
	$("<div class='ui-loader ui-overlay-shadow ui-body-e ui-corner-all'><h3>"+msg+"</h3></div>")
	.css({ display: "block", 
		opacity: 0.90, 
		position: "fixed",
		padding: "7px",
		"text-align": "center",
		width: "270px",
		left: ($(window).width() - 284)/2,
		top: $(window).height()/2 })
	.appendTo( $.mobile.pageContainer ).delay( 1500 )
	.fadeOut( 400, function(){
		$(this).remove();
	});
}


function check_page(form){
	var Radio_state = "   ";
	re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	console.log('at check page');
	if (form.Orgname.value.length == 0){
		console.log('Organization name must be entered.' + form.Orgname.value + 'was entered')
		
		form.Orgname.focus()
		return false
	}
	if (form.yourName.value.length == 0){
		console.log('You must supply your name.')
		
		form.yourName.focus()
		return false
	}
	if (!re.test(form.Email.value)) {
		console.log("Invalid email Address.")
		form.Email.focus()
		return false
	}
	if (form.From_date.value.length == 0){
		console.log('The beginning , or event, date must be entered use the calendar icon.')
		form.From_date.focus()
		return false
		}
		var this_date=FormatDate(form.From_date.value)
		var today = new Date;
		
		if (this_date < today ){
			console.log('The beginning date, event date, cannot be less than the current date!')
			form.From_date.focus()
			return false
		}
		
	    if (form.reserve_by.value.length > 0) {
			var reserve_date = FormatDate(form.reserve_by.value)
			if (reserve_date > this_date){
			console.log('The reserve date should be blank or less that the event date')
			form.reserve_by.focus()
			return false
			}
		}
		if (form.to_date.value.length > 0) {
			var to_date = FormatDate(form.to_date.value)
			if (to_date < this_date){
			consol.log('The ending date should be blank, or greater than or equal to the begin date!')
			form.to_date.focus()
			return false
			}
		}
		if (form.place_name.value.length == 0){
		console.log('Organization name must be entered.')
		
		form.place_name.focus()
		return false
		}
		if (form.activity.value.length == 0){
		consol.log('The event information  must be entered.')
		
		form.activity.focus()
		return false
	
		}
		if (form.EventTitle.value.length == 0){
		console.log('The event Title   must be entered.')
		
		form.EventTitle.focus()
		return false
	
		}
	return true
  }    // end of check page
   
function clear_form(form){
form.reset();
}
function submit_page(form){
var foundError = false;
var Radio_state = "   ";

//
	
	

	
	if (!foundError) {
		form.submit()
	}
}		
// Check for blank field
function isFieldBlank(theField) {
	if (theField.value.length == 0)
	     return true;
	else
	     return false;
    }	
// make array
function MakeArray(n){
	this.length = n;
	for (var i = 1;i <=n; i ++){
	 this[i] = 0}
	return this
 }	





</script>


<style type="text/css">
:invalid { 
  border-color: #e88;
  -webkit-box-shadow: 0 0 5px rgba(255, 0, 0, .8);
  -moz-box-shadow: 0 0 5px rgba(255, 0, 0, .8);
  -o-box-shadow: 0 0 5px rgba(255, 0, 0, .8);
  -ms-box-shadow: 0 0 5px rgba(255, 0, 0, .8);
  box-shadow:0 0 5px rgba(255, 0, 0, .8);
}

:required {
  border-color:
  #FF0000;
  -webkit-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -moz-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -o-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  -ms-box-shadow: 0 0 5px rgba(0, 0, 255, .5);
  box-shadow: 0 0 5px rgba(0, 0, 255, .5);
}

form {
  width:100%;
  margin: 20px auto;
}

.ReqStyle
 {
	color: #FF0000;
}
.fieldName {
	font-family: "Times New Roman", Times, serif;
	font-style: normal;
	font-weight: bold;
	color:#0000FF
}
.explanation {
	font-size: small;
	font-style: italic;
	font-weight: normal;
}
#calendar{
	display: none;
	position:absolute;
	top:236px;
	left:579px;
	border:1px solid #333;
	background:#fc3;
	padding: 10px;
	font-size:18px;
	width: 215px;
	height: 200px;
}
body {
	background-color: #999999;
}
.formNote {
	font-family: Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-style: italic;
	font-weight: normal;
	color: #000000;
}

</style>


</head>
<body>


<div data-role="page" id="page">
<div data-role="header" class="header"><h1>Event input</h1>
<img src="http://www.graynwhite.com/pjsn/pjbanner20130128.jpg" height="150px" align="right" hspace="3"/>
<p>Complete this form then an email will be sent to the Gray and White Webmaster requesting that this event be placed in the Gray and White Event Database.</p>
<p>The webmaster will review the information and  process it within a short time.</p>
<p>One can verify the insertion, after a few days, by referring to the monthly calendar.</p>
</div><!--End of header -->
<div data-role="content">

<form  action="../../emailControl/mailToWebmaster.php?org=eventinput" method="post" name='formInput' id='formInput'   >
  
  	<input type="hidden" name="cell_input" value="yes" />
    <input type="hidden" name="Subject" value=" WHTW Entry" />
    <input type="hidden" name="Sender" value="+Email+" />
    <input type="hidden" name="recipient" value="webmaster@graynwhite.com" />
    <input type="hidden" name="env_report" value="REMOTE_HOST,HTTP_USER_AGENT" />
    <input type="hidden" name="bgcolor" value="#ffffff" />
    <input type="hidden" name="text_color" value="#000000" />
	<input type="hidden" name="refferSrc"  value="<?echo $sourceg?>">
    <input type="hidden" name="return_link_url" value="http://graynwhite.com/whtw" />
    <input type="hidden" name="return_link_title" value="If you want to make corrections or enter more events use the back button on your browser or click here to go back to the home page" />
  
  
  <table align = "left" border= "1" width = "100%" style="border-collapse: collapse" bordercolor="#111111" cellpadding="0" cellspacing="0">
  
  <tr >
    <td class="fieldName">Your Name:</td>
    <td ><input name="yourName" type="text" id="yourName" size="40" maxlength="40" placeholder="Jane Doe" required x-moz-errormessage="You must input your name!"></td>
  </tr>
  <tr>
    <td class="fieldName">Your E-Mail Address</td>
    <td><input name="Email" id="Email" type ="email" placeholder="me@example.com" maxlength="45" reuired ></td>
  </tr>
  <tr>
    <td class="fieldName">Your phone Number</td>
    <td><input name="Yphone" type = "tel"  maxlength="20" ></td>
  </tr>
  <tr>
    <td class="fieldName">Date of Event:(mm/dd/yyyy)
	<span class="ReqStyle">*</span></td>
    <td><br />
	<div id="calendar">Content for  id calendar Goes Here</div> 
      <input name="dateStart" id="dateStart" type="date" size="20" maxlength="20"
	   
	  required >
     </td>      
  </tr>
  <tr>
    <td class="fieldName">Reserve By:(if applicable, mm/dd/YYYY) </td>
    <td><span class="explanation">
      <input name="dateRes" type="date" id="dateRes" size="20" maxlength="20" 
	 required >
    </span></td>
  </tr>
  
  <tr>
    <td><span class="fieldName">To Date:(if applicable, mm/dd/yyyy)</span></td>
    <td><input type="date" name="dateEnd" id='date_end' size="20"
	>
	</td>
	
  </tr>
  <tr>
    <td class="fieldName">Start Time:</td>
    <td><span class="explanation">
      <p>The start time of the event if applicable.</p></span>
	  <input type="time" name="timeStart" >
      </p>
        
  </tr>
  <tr>
  <td class="fieldName">End time:(if applicable)</td>
  	<td><span class="explanation">
    <p>The end time of the event if applicable.</p></span>
	  <input type="time" name="timeEnd" >
  </tr>
  <tr>
    <td class="fieldName">Day of Week
	 <span class="ReqStyle">*</span> </td>
    <td><span class="explanation">Day of the week or Weekend, Week, etc.
        </span>
      <input name="Day_of_week" type="text" required  >
       </td>
    <td class="explanation">&nbsp;</td>
    </tr>
  <tr>
    <td class="fieldName"><p>Media Input:(long description)
      </td>
    <td><textarea name ="comments" cols ="50" rows ="20"></textarea></td>
  </tr>
  <tr>
    <td><span class="fieldName">Title of Event </span>(keep it short) </td>
    <td ><input name="EventTitle" type="text" id="EventTitle"  maxlength="100" required></td>
  </tr>
  <tr>
    <td class="explanation"><p><span class="fieldName"><b><font size="4">Place:</font></b> :</span></p>
      </td>,
    <td ><p>Place Name<span class="ReqStyle">*</span>
        <input type="text" name="place_name" size="40" required > <br />
      Address
      <input type="text" name="place_address" size="24" />  
      <br/>
      City
      <input type="text" name="city" size="24" />
	  <br />
      State
  <input type="text" name="state" size="3" value ="MI" >
  <br />
      Postal Code
  <input name="zip" type="text" size="12" maxlength="12" >
  <br />
      Phone
  <input type="tel" name="phone" size="14" >
  <br/>
      URL
      <input name="url" type="url" size="40" maxlength="40" >
	  <br />
      email
  <input name="place_email" type="email" id="place_email" size="40" maxlength="40" >
    </p>
      <p>Additional directions </p>
      <p>
        <textarea name ="PlaceDirections" cols ="50" rows ="4" id="PlaceDirections" ></textarea>
      </p></td>
  </tr>
  <tr>
    <td><span class="fieldName"><b><font size="4">Event (short description)</font></b></span></td>
    <td ><textarea name ="activity" cols ="50" rows ="8" id="activity" required></textarea></td>
  </tr>
  <tr>
    <td><span class="fieldName">Price Members </span>:</td>
    <td><input type="text" name="Price_Member" size="20" maxlength="50">
	</td>
	</tr>
  <tr>
    <td><span class="fieldName">Price Non Members </span>:</td>
    <td><input type="text" name="Non_Member_Price" size="20" maxlength="50">
	</td>
	</tr>
	
   
 
  <tr>
    <td colspan = "2"><center>
      <input type = "submit" name="Submit" value="Submit Form">
    </center></td>
  </tr>
</table>
</form>
</div><!-- end of content -->
<div data-role="footer"><h1>Event input</h1></div>
</div><!-- End of page -->
</body>
</html>