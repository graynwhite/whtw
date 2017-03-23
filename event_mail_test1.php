<?php
$genVercode = rand(10000,99999);
include_once($_SERVER['DOCUMENT_ROOT']. "/javascript/dateHandling.js");
require_once($_SERVER['DOCUMENT_ROOT'] ."/stylesheets/Forms.css");
require_once($_SERVER['DOCUMENT_ROOT'] ."/phpClasses/Class_publicist.php");
$pub = new publicist;
$sourceg = $_SERVER['REMOTE_ADDR'];
//echo "the source is " . $sourceg;
//exit;
?>
<!DOCTYPE html>
<html>
<head>
<title>Organization Event Input</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<script> src="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.3/jquery.mobile.js"</script>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.3/jquery.mobile.min.css"/>
	
	<style>
	.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}
	</style>
    <link rel="stylesheet" href="wide.css"/>
	
<script language="JavaScript" type="text/javascript">

function check_page(form){
	var Radio_state = "   ";
	re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	
	if (form.Orgname.value.length == 0){
		alert('Organization name must be entered.' + form.Orgname.value + 'was entered')
		
		form.Orgname.focus()
		return false
	}
	if (form.yourName.value.length == 0){
		alert('You must supply your name.')
		
		form.yourName.focus()
		return false
	}
	if (!re.test(form.Email.value)) {
		alert("Invalid email Address.")
		form.Email.focus()
		return false
	}
	if (form.From_date.value.length == 0){
		alert('The beginning , or event, date must be entered use the calendar icon.')
		form.From_date.focus()
		return false
		}
		var this_date=FormatDate(form.From_date.value)
		var today = new Date;
		
	if (this_date < today ){
			alert('The beginning date, event date, cannot be less than the current date!')
			form.From_date.focus()
			return false
		}
		
	    if (form.reserve_by.value.length > 0) {
			var reserve_date = FormatDate(form.reserve_by.value)
			if (reserve_date > this_date){
			alert('The reserve date should be blank or less that the event date')
			form.reserve_by.focus()
			return false
			}
		}
		if (form.to_date.value.length > 0) {
			var to_date = FormatDate(form.to_date.value)
			if (to_date < this_date){
			alert('The ending date should be blank, or greater than or equal to the begin date!')
			form.to_date.focus()
			return false
			}
		}
		if (form.place_name.value.length == 0){
		alert('Organization name must be entered.')
		
		form.place_name.focus()
		return false
		}
		if (form.activity.value.length == 0){
		alert('The event information  must be entered.')
		
		form.activity.focus()
		return false
	
		}
		if (form.EventTitle.value.length == 0){
		alert('The event Title   must be entered.')
		
		form.EventTitle.focus()
		return false
	
		}

  }    // end of check page
   
function clear_form(form){
form.reset();
}
/*function submit_page(form){
var foundError = false;
var Radio_state = "   ";

//
	
	

	
	if (!foundError) {
		form.submit()
	}*/
		
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



function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}


</script>


<style type="text/css">

.Required {
	color: #FF0000;
}
.fieldName {
	font-family: "Times New Roman", Times, serif;
	font-style: normal;
	font-weight: bold;
	color:#0000FF;
	font-size: 18px;
	width: 25%;
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
	font-size:11px;
	width: 215px;
	height: 200px;
}
body {
	background-color: #66FFFF;
}
.formNote {
	font-family: Arial, Helvetica, sans-serif;
	font-size: x-small;
	font-style: italic;
	font-weight: normal;
	color: #000000;
}

#formInput {
	font-family: "Times New Roman", Times, serif;
	font-size: large;
}
.important {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;

	color: #FF0000;
}
textarea {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	width: 100%;
}


.style1 {color: #000000}
.style2 {font-size: small; font-style: italic; font-weight: normal; color: #000000; }
</style>


  
</head>
<body>
<div data-role="page" id="mainPage" data-theme="b" > 
<div data-role="header"  ><h1>Org. Event Info. Input</h1></div>
<div data-role="content">
<noscript>
 <h2>For full functionality of this site it is necessary to enable JavaScript.
 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
 instructions how to enable JavaScript in your web browser</a>.</h2>
</noscript>
<br /> 
  <img src="graypluswhitebannereventMaint.jpg" width="100%" height="60" /></h1>
<p class="explanation">The Gray and White Event Database is used to create multiple web site pages including the Peggy Jo Studio and the PJSN Press Release System. </p>
<!-- SitePal
<H1> SceneWizSc1127110Acc61468BodyStart
<script language='JavaScript' type="text/javascript" src="http://vhost.oddcast.com/vhost_embed_functions.php?acc=61468&js=1"></script><script language="JavaScript" type="text/javascript">AC_VHost_Embed_61468(100, 200, 'FFFFFF', 1, 1, 859241, 1127110, 0, 0, '88e94b1aea0380ee5f543dab526a0577', 6);</script>
 Scen-->
<!-- eWizSc1127110Acc61468BodyEnd&nbsp;</H1>-->
<?php 
if(isset($_GET['prg']))
{
?>
<div style="color:#0033FF">
<h2 > You have been routed here because you do not have javascript enabled and all of the editing help and safegaurds are disabled.</h2>
</div>
<?php	
}
?>
<form  action="../../emailControl/mailToWebmaster.php?org=eventinput" method="post" name='formInput' id='formInput'  onsubmit="return check_page(this)" >
  <p>
    <input type="hidden" name="Subject" value=" WHTW Entry" />
    <input type="hidden" name="Sender" value="+Email+" />
    <input type="hidden" name="recipient" value="cauleyfrank@gmail.com" />
    <input type="hidden" name="env_report" value="REMOTE_HOST,HTTP_USER_AGENT" />
    <input type="hidden" name="bgcolor" value="#ffffff" />
    <input type="hidden" name="text_color" value="#000000" />
	<input type="hidden" name="refferSrc"  value="<?echo $sourceg?>">
    <input type="hidden" name="return_link_url" value="http://graypluswhite.com/whtw" />
    <input type="hidden" name="return_link_title" value="If you want to make corrections or enter more events use the back button on your browser or click here to go back to the home page" />
    <span class="Required">fields marked with a red asterisk * are required. </span></p>
  <p class="explanation">
  This form will be eMailed to the webmaster for review and editing and will be placed in the Gray and White Event database as soon as possible.  </p>
  <p class="formNote">To  
  check the status of an event one can access the calendar of events at <a href="http://www.graypluswhite.com/whtw/calendar.php">http://www.graypluswhite.com/whtw/calendar.php</a> and clicking on the date. Initially the current month is presented but future months can be displayed by using the date box at the bottom of the form.  </p>
  <p class="formNote">This form uses javascript to help with the data entry. If you do not have javascript enabled go to <a href="https://www.google.com/adsense/support/bin/answer.py?hl=en&amp;answer=12654 ">https://www.google.com/adsense/support/bin/answer.py?hl=en&amp;answer=12654 </a>. You can disable it after using the form.  </p>
  <h1 class="important">Do not use all caps words anywhere, only capitilize where appropriate- press releases will not accept them!!! Enabling javascript will make this form work better!!! The left column of the form describes what information should be entered in the text boxes in the right column. </h1>
  <p class="explanation">&nbsp;</p>
  
  <table align = "left" border= "1" width = "100%" style="border-collapse: collapse" bordercolor="#111111" cellpadding="0" cellspacing="0">
    <tr >
      <td class="fieldName" width="25%">Sign me up as an Organizational Publicist. </td>
      <td>
          
          <input type="radio" name="Sign_up" value="Yes" />
          <span class="explanation">Yes</span>
          <br />
          <input name="Sign_up" type="radio" value="No" checked="checked" />
          <span class="explanation">No</span>      </td>
    </tr>
    <tr >
      <td><span class="fieldName">Entry Type: </span></td>
      <td>
        
	   <input name="radioEntryType" type="radio" id="typeNew" checked="checked" />
	   <span class="explanation">New</span><br />
       <input type="radio" name="radioEntryType" id="typechange" />
	   <span class="explanation">Change/overide(Send an email to cauleyfrank@gmail.com to explain change)</span><br />
       <input type="radio" name="radioEntryType" id="typedelete"value="delete" />
		<span class="explanation"> Delete  (send an email to cauleyfrank@gmail.com)</span>  
          </td>
    </tr>
    <tr >
      <td><span class="fieldName">Organization Name</span></td>
      <td><input name="Orgname" type="text" id="Orgname"  />
          <span class="Required">*</span></td>
    </tr>
    <tr>
      <td ><span class="fieldName">Your Name:</span></td>
      <td ><input name="yourName" type="text" id="yourName"  />
          <span class="Required">*</span> </td>
    </tr>
    <tr>
      <td class="fieldName">Your E-Mail Address</td>
      <td><input name="Email" id="Email" type ="text" />
          <span class="Required">*</span> </td>
    </tr>
    <tr><span style="border-bottom: thick" >
      <td class="fieldName"> Your phone Number</td>
      <td><input name="Yphone" type = "text"  /></td>
	  </span>    </tr>
    
    <tr>
      <td class="fieldName">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td><span class="fieldName">Title of Event </span><span class="explanation">(keep it short) <strong> Do not use all caps. </strong></span></td>
      <td><input name="EventTitle" type="text" id="EventTitle"  /><span class="Required">*</span></td>
    </tr>
    <tr>
      <td><span class="fieldName">Date of Event:</span><span class="explanation">This is the date of the event or the beginning date of a multiple day event.</span>
      </td>
      <td>
	 
	 <input type="text" id="datepicker"  name="dateStart" /> <span class="Required">*</span>   </td>
    </tr>
    <tr>
      <td><span class="fieldName">Reserve By:</span><span class="explanation">This is the reservation date if not applicable leave it as is </span> </td>
	   
      <td>
	  <input type="text" id="datepickerRes"  name="reserve_date" />  
	    </td>
    </tr>
   
         
   
    <tr>
      <td><p><span class="fieldName">To Date:</span>
      <span class="explanation">This for events that span multiple days. This is not to be used to describe recurring events. <br />
      This is the ending date of a multiple day event, such as a weekend or week, 
      leave as is  for single day events. It is not the end date of a recurring 
      event such as every Monday from a date to another date. Use the bottom of the form to let the webmaster know that this is a recurring event so that it can be replicated </span>.
      </td>
      <td>
	  <input type="text" id="datepickerTo"  name="dateEnd" />  
    </tr>
    <tr>
      <td><span class="fieldName">Start Time</span>
      <span class="explanation">The start time of the event if applicable.</span></td>
      <td>
          <input type="text" id="timeStart"  name="timeStart" >
		     
    </tr>
    <tr>
      <td>
      <span class="fieldName">End Time:</span>
      <span class="explanation">Ending time of the event or blank if not applicable. </span></td>
      <td>
         
            <input type="text" id="timeEnd"   name="to_time"/>
      </td>
    </tr>
    <tr>
      <td><span class="fieldName">Day of Week </span><span class="explanation">Day of the week or Weekend, Week, etc. This is so the system can verify that the date and day of week agree</span></td>
      <td>
          <input name="Day_of_week" type="text"  size="20" />
          <span class="Required">*</span></td>
    </tr>
 <tr>
      <td <span class="fieldName"><b><font size="4">Place</font></b> :</span><span class="explanation">Enter the place, including address, city
        and phone number  here. Google the place to find the address. <strong> Do not use all caps. </strong>
          <p>The separate fields allow Google to generate a map. Believe it or not everything does have a postal address.</span> </p></td>
      
     <tr><td> <span class="explanation">Place Name</span></td>
              <td><input type="text" name="place_name"  /><span class="Required">*</span></td></tr>
              <tr><td><span class="explanation">Address</span></td>
              <td><input type="text" name="place_address"  /></td></tr>
              
             <tr> <td><span class="explanation">City</span></td>
              <td><input type="text" name="city"  /></td></tr>
              <tr><td><span class="explanation">State</span></td>
              <td><input type="text" name="state" size="3" value ="MI" /></td></tr>
              <tr><td><span class="explanation">Postal Code</span></td>
              <td><input name="zip" type="text"  /></td></tr>
              <tr><td><span class="explanation">Phone</span></td>
              <td><input type="text" name="phone" size="14" /></td></tr>
              
              <tr><td><span class="explanation">URL</span></td>
              <td><input name="url" type="text"  /></td></tr>
              <tr><td><span class="explanation"> email</span></td>
              <td><input name="place_email" type="text" id="place_email" /></td></tr>
        
          <tr> <td><span class="explanation">Additional directions   ></span></td>
        
          <td><textarea name ="PlaceDirections"  id="PlaceDirections" ></textarea>
        </td>
    </tr>	
	
    <tr>
      <td class="explanation"><p><span class="fieldName">Media Input or Long version:</span><b><font size="4"> <span class="Required">*</span> </font></b> This is where you can give a  robust description of the event or trip. Do not repeat the time and place of the event.<strong> Do not use all caps. </strong></p>
          <p>If you are cutting and pasting from some other text, delete the time, place and date of the event from the text so that it is not redundant </p></td>
      <td><textarea name ="comments" 
	 ></textarea></td>
    </tr>

   
    <tr>
      <td><span class="fieldName"><b><font size="4">Event or Short version</font></b></span><b><font size="4"> <span class="Required">*</span> </font></b>:<span class="explanation">Describe the event here. Include a 
        person and phone number to contact if desired . This is a shortened version of the media input only the first 235 characters will be accepted. Do not repeat the Date, time or place. <strong> Do not use all caps. </strong></span></td>
      <td><textarea name ="activity" width="72%" id="activity"></textarea></td>
    </tr>
    <tr>
      <td><span class="fieldName">Price Members </span>:</td>
      <td><input type="text" name="Price_Member" size="20" maxlength="50" /></td>
    </tr>
    <tr>
      <td class="fieldName">Price Guests</td>
      <td><input type="text" name="Non_Member_Price" size="20" maxlength="50" /></td>
    </tr>
   
    <tr>
      <td><span class="explanation"><span class="fieldName">Recurring Event?</span> If  this event takes place on a regular basis, include this information so that the webmaster can replicate the event so that you do not have to enter it repeatably. If for some reason the event will not take place on one or more occasions, send an email to the cauleyfrank@gmail.com in order to delete those iterations. </span></td>
      <td> 
		
		Recurring Event 
		<input type="radio" name="recurring" value ="Yes" />
        Yes
        <input type="radio" name="recurring" value="No" checked="checked" />
        No<br />
        Day of week: Mon
        <input type="checkbox" name="Mon" value="ON" />
        Tue
        <input type="checkbox" name="TUE." value="ON" />
        Wed
        <input type="checkbox" name="Wed." value="ON" />
        Thu
        <input type="checkbox" name="Thu." value="ON" />
        Fri
        <input type="checkbox" name="Fri" value="ON" />
        Sat
        <input type="checkbox" name="sat." value="ON" />
        Sun
        <input type="checkbox" name="Sun." value="ON" />
        <br />
        Week of Month: 1st
        <input type="checkbox" name ="first" value="ON" />
        2nd
        <input type="checkbox" name="Second." value="ON" />
        3rd
        <input type="checkbox" name="Third." value="ON" />
        4th
        <input type="checkbox" name="fourth." value="ON" />
        5th
        <input type="checkbox" name="Fifth" value="ON" />
        last of the month
        <input name="Last" type="checkbox" id="Last" value="On" />
        <br />
        </td></tr>
        <tr><td><span class="explanation"> Enter the beginning date of this recurring event (The first time it occurs) in the form yyyy-mm-dd</span></td>
        <td><input type="text" name="recurbegin" id ='recurbegin' size="20" /></td></tr>
        <tr><td>
        To Date <span class="explanation"> Enter the date of the last time this recurring event will occur in the form yyyy-mm-dd</span></td>
        <td><input type ="text" name="recurend"  id='recurend' size="20" />
      </p></td>
    </tr>
            
    <tr>
      <td>&nbsp;</td>
      <td><center>
          <input type = "submit"  value="Submit Form" data-role="button" />
      </center></td>
    </tr>
  </table>
</form>
</div><!--End of content-->
<div data-role="footer" ><h1>Event Input Mail</div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>