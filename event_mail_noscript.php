<?php
$genVercode = rand(10000,99999);
?>
<!DOCTYPE html> 
<html>
<head>
<title>Organization Event Input</title>

<?php
include_once($_SERVER['DOCUMENT_ROOT']. "/javascript/dateHandling.js");
require_once($_SERVER['DOCUMENT_ROOT'] ."/stylesheets/Forms.css");
require_once($_SERVER['DOCUMENT_ROOT'] ."/phpClasses/Class_publicist.php");
$pub = new publicist;
$sourceg = $_SERVER['REMOTE_ADDR'];
//echo "the source is " . $sourceg;
//exit;
?>
<script language="JavaScript" type="text/javascript">

function check_page(form){
	var Radio_state = "   ";
	re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	
	if (form.Orgname.value.length == 0){
		//alert('Organization name must be entered.' + form.Orgname.value + 'was entered')
		
		form.Orgname.focus()
		return false
	}
	if (form.yourName.value.length == 0){
		//alert('You must supply your name.')
		
		form.yourName.focus()
		return false
	}
	if (!re.test(form.Email.value)) {
		//alert("Invalid email Address.")
		form.Email.focus()
		return false
	}
	
	
	//alert('from month is ' + form.From_mm.value);

	if (form.From_mm.value.length < 1){
		//alert('The beginning , or event, date must be entered.')
		form.From_mm.focus()
		return false
		}
		
		//alert('about to check date');
		var fromDate = form.From_year.value + '/' + form.From_mm.value + '/' + form.From_dd.value;
		//alert('from_date is ' + fromDate);
		var today = new Date();
		var this_month = today.getMonth()+ 1;
		//alert('this month ' + this_month);
		var this_day = today.getDate();
		if (today.getDate()<10){this_day='0' + this_day;}
		if (today.getMonth()< 9){this_month = '0' + this_month;}
			 
		var current_date = today.getFullYear() + '/' + this_month + '/' + this_day;
		//alert( 'from date ' + fromDate + ' todays date ' + current_date);
		if (fromDate < current_date ){
		//alert('The beginning date, event date, cannot be less than the current date!')
			form.From_mm.focus();
			return false
		}
		//alert("about to check reserve date");
	    if (!form.res_mm.value == 'N/A') {
			var resDate = form.res_year.value + '/' + form.res_mm.value + '/' + form.res_dd.value;
			//alert( 'from date ' + fromDate + ' Reserve Date ' + resDate);
			if (resDate > fromDate){
			//alert('The reserve date should be blank or less that the event date')
			form.res_mm.focus()
			return false
			}
		}
		//alert('about to check to date');
		if (!form.to_mm.value == 'N/A') {
			var toDate = form.to_mm.value + ', ' + form.to_dd.value + ' ' + to_year;
			
			if (to_date < fromDate){
			//alert('The ending date should be blank, or greater than or equal to the begin date!')
			form.to_mm.focus()
			return false
			}
		}
		//alert("about to check place name");
		if (form.place_name.value.length < 1){
		//alert('Place name name must be entered.')
		
		form.place_name.focus()
		return false
		}
		//alert("about to check activity");
		if (form.activity.value.length < 1){
		//alert('The event information  must be entered.')
		
		form.activity.focus()
		return false
	
		}
		//alert("about to check media");
		if (form.comments.value.length < 1){
		//alert('The media information  must be entered.')
		
		form.comments.focus()
		return false
	
		}
		//alert('about to check title'); 
		if (form.EventTitle.value.length == 0){
		//alert('The event Title   must be entered.')
		
		form.EventTitle.focus()
		return false
	
		}
		//alert('about to  check day of week title'); 
		if (form.day_of_week.value.length == 0){
		//alert('The day of week   must be entered.')
		
		form.day_of_week.focus()
		return false
	
		}

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
  } if (errors) //alert('The following error(s) occurred:\n'+errors);
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
}
.explanation {
	font-size: medium;
	font-style: italic;
	font-weight: bold;
	font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	color: #F4191D;
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
body{ background-color: #12FFFF;
}
	
.formNote {
	font-family: Arial, Helvetica, sans-serif;
	font-size: medium;
	font-style: italic;
	font-weight: normal;
	color: #000000;
}

#formInput {
	font-family: "Times New Roman", Times, serif;
	font-size: medium;
}
.important {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
	color: #F10808;
	font-style: italic;
}
.style1 {color: #000000}
.style2 {font-size: small; font-style: italic; font-weight: normal; color: #000000; }
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
<h1>Organization Event Information Input</h1>
<noscript>
 <h2>For full functionality of this site it is necessary to enable JavaScript.
 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
 instructions how to enable JavaScript in your web browser</a>.</h2>
</noscript>
<br /> 
  <img src="graypluswhitebannereventMaint.jpg" width="468" height="60" /></h1>
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
      <td class="fieldName">Sign me up as an Organizational Publicist. </td>
      <td>
          
          <input type="radio" name="Sign_up" value="Yes" />
          <span class="explanation">Yes</span>
          <br />
          <input name="Sign_up" type="radio" value="No" checked="checked" />
          <span class="explanation">No</span>      </td>
    </tr>
    <tr >
      <td><span class="fieldName">Entry Type: </span></td>
      <td><span class="explanation">
       
        <input name="radioEntryType" type="radio" value="new" checked="checked" />
          New Entry
        <br />
       
        <input type="radio" name="radioEntryType" value="change" />
          Change/Overide</label>
        (Send an email to cauleyfrank@gmail.com to explain change) <br />
       
        <input type="radio" name="radioEntryType" value="delete" />
          Delete
 (send an email to cauleyfrank@gmail.com)  </span></td>
    </tr>
    <tr >
      <td><span class="fieldName">Organization Name</span></td>
      <td><input name="Orgname" type="text" id="Orgname  size="40" size="60" maxlength="80" />
          <span class="Required">*</span></td>
    </tr>
    <tr>
      <td ><span class="fieldName">Your Name:</span></td>
      <td ><input name="yourName" type="text" id="yourName" size="40" maxlength="40" />
          <span class="Required">*</span> </td>
    </tr>
    <tr>
      <td class="fieldName">Your E-Mail Address</td>
      <td><input name="Email" id="Email" type ="text"  size="45" maxlength="45" />
          <span class="Required">*</span> </td>
    </tr>
    <tr><span style="border-bottom: thick" >
      <td class="fieldName"> Your phone Number</td>
      <td><input name="Yphone" type = "text" size="20" maxlength="20" /></td>
	  </span>    </tr>
    
    <tr>
      <td class="fieldName">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<tr>
      <td><span class="fieldName">Title of Event </span><span class="explanation">(keep it short) <strong> Do not use all caps. </strong></span></td>
      <td><input name="EventTitle" type="text" id="EventTitle" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td><span class="fieldName">Date of Event:</span><span class="explanation">This is the date of the event or the beginning date of a multiple day event.</span>
      </td>
      <td>
	 <?php 
	  $this_month=date(m);
    $this_day = date(d);
    $this_year = date(Y);
	 $pub->generateCalendar($this_month,$this_day,$this_year,'From',$start=1) ?>     </td>
    </tr>
    <tr>
      <td><span class="fieldName">Reserve By:</span><span class="explanation">This is the reservation date if not applicable leave it as is </span> </td>
	   <div id="calendar">Content for  id calendar Goes Here</div> 
      <td>
	  <?php
	  $pub->generateCalendar($this_month,$this_day,$this_year,"res",$start=0) 
	  ?>	  </td>
    </tr>
   
         
   
    <tr>
      <td><p><span class="fieldName">To Date:</span><span class="explanation">This for events that span multiple days. This is not to be used to describe recurring events. </span><br />
      This is the ending date of a multiple day event, such as a weekend, 
      leave as is  for single day events. It is not the end date of a recurring 
      event such as every monday from a date to another date. Use the bottom of the form to let the webmaster know that this is a recurring event so that it can be replicated </span>.
      </td>
      <td>
	  <?
	    $pub->generateCalendar($this_month,this_day,$this_year,"to",$start=0)
		 ?>	  </td>
    </tr>
    <tr>
      <td><span class="fieldName">Start Time</span>
      <span class="explanation">The start time of the event if applicable.</span></td>
      <td>
              <select name = "Start_Time_Hours" size = "1" >
              <option value = "   " selected="selected">N/A </option>
              <option value = "01:">01 </option>
              <option value = "02:">02 </option>
              <option value = "03:">03 </option>
              <option value = "04:">04 </option>
              <option value = "05:">05 </option>
              <option value = "06:">06 </option>
              <option value = "07:">07 </option>
              <option value = "08:">08 </option>
              <option value = "09:">09 </option>
              <option value = "10:">10 </option>
              <option value = "11:">11 </option>
              <option value = "12:">12 </option>
            </select>
            <span class="explanation">Hour</span><br />
            <select name = "Start_Time_Minutes" size = "1">
              <option value = "  " selected="selected">N/A </option>
              <option value = "00">00 </option>
              <option value = "15">15 </option>
              <option value = "30">30 </option>
              <option value = "45">45 </option>
            </select>
            <span class="explanation">Minutes</span><br />
            <select name= "Start_AMPM" size= "1">
              <option value = "   " selected="selected">N/A </option>
              <option value = " PM">PM </option>
              <option value = " AM">AM </option>
            </select>
            <span class="explanation">AM or PM</span></td>
    </tr>
    <tr>
      <td>
      <span class="fieldName">End Time:</span>
      <span class="explanation">Ending time of the event or blank if not applicable. </span></td>
      <td>
         
            <select name = "To_Time_Hours" size = "1" >
              <option value = "   " selected="selected">N/A </option>
              <option value = "01:">01 </option>
              <option value = "02:">02 </option>
              <option value = "03:">03 </option>
              <option value = "04:">04 </option>
              <option value = "05:">05 </option>
              <option value = "06:">06 </option>
              <option value = "07:">07 </option>
              <option value = "08:">08 </option>
              <option value = "09:">09 </option>
              <option value = "10:">10 </option>
              <option value = "11:">11 </option>
              <option value = "12:">12 </option>
            </select>
            <span class="explanation">Hour</span> <br />
            <select name = "To_Time_Minutes" size = "1">
              <option value = "  " selected="selected">N/A </option>
              <option value = "00">00 </option>
              <option value = "15">15 </option>
              <option value = "30">30 </option>
              <option value = "45">45 </option>
            </select>
            <span class="explanation">Minutes</span><br />
            <select name= "To_AMPM" size= "1">
              <option value = "   " selected="selected">N/A </option>
              <option value = " PM">PM </option>
              <option value = " AM">AM </option>
            </select>
            <span class="explanation">AM or PM</span> 
      </td>
    </tr>
    <tr>
      <td><span class="explanation"><span class="fieldName">Day of Week </span>:This is so the system can verify that the date and day of week agree</span></td>
      <td><span class="explanation">Day of the week or Weekend, Week, etc. </span>
          <input name="Day_of_week" type="text"  size="20" />
          <span class="Required">*</span></td>
    </tr>
 <tr>
      <td class="explanation"><p><span class="fieldName"><b><font size="4">Place</font></b> :</span>Enter the place, including address, city
        and phone number  here. Google the place to find the address. <strong> Do not use all caps. </strong></p>
          <p>The separate fields allow Google to generate a map. Believe it or not everything does have a postal address. </p></td>
      ,
      <td><p><span class="explanation">Place Name</span><span class="Required">*</span>
              <input type="text" name="place_name" size="40" />
              <span class="explanation">Address</span>
              <input type="text" name="place_address" size="24" />
              <br/>
              <span class="explanation">City</span>
              <input type="text" name="city" size="24" />
              <span class="explanation">State</span>
              <input type="text" name="state" size="3" value ="MI" />
              <span class="explanation">Postal Code</span>
              <input name="zip" type="text" size="12" maxlength="12" />
              <span class="explanation">Phone</span>
              <input type="text" name="phone" size="14" />
              <br/>
              <span class="explanation">URL</span>
              <input name="url" type="text" size="40" maxlength="40" />
              <span class="explanation"> email</span>
              <input name="place_email" type="text" id="place_email" size="40" maxlength="40" />
        </p>
          <p class="explanation">Additional directions   </p>
        <p>
          <textarea name ="PlaceDirections" cols ="100" rows ="2" id="PlaceDirections" ></textarea>
        </p></td>
    </tr>	
	
    <tr>
      <td class="explanation"><p><span class="fieldName">Media Input or Long version:</span><b><font size="4"> <span class="Required">*</span> </font></b> This is where you can give a  robust description of the event or trip. Do not repeat the time and place of the event.<strong> Do not use all caps. </strong></p>
          <p>If you are cutting and pasting from some other text, delete the time, place and date of the event from the text so that it is not redundant </p></td>
      <td><textarea name ="comments" cols ="100" rows ="10"></textarea></td>
    </tr>

   
    <tr>
      <td><span class="fieldName"><b><font size="4">Event or Short version</font></b></span><b><font size="4"> <span class="Required">*</span> </font></b>:<span class="explanation">Describe the event here. Include a 
        person and phone number to contact if desired . This is a shortened version of the media input only the first 235 characters will be accepted. Do not repeat the Date, time or place. <strong> Do not use all caps. </strong></span></td>
      <td><textarea name ="activity" cols ="100" rows ="4" id="activity"></textarea></td>
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
        <span class="explanation"> Enter the beginning date of this recurring event (The first time it occurs) in the form yyyy-mm-dd</span>
        <input type="text" name="recurbegin" id ='recurbegin' size="20" />
        <br />
        To Date <span class="explanation"> Enter the date of the last time this recurring event will occur in the form yyyy-mm-dd</span>
        <input type ="text" name="recurend"  id='recurend' size="20" />
      </p></td>
    </tr>
    <tr>
      <td class="fieldName">Anti Hacking Input </td>
      <td> <span><center><strong>CAPTCHA</strong></center><br/>
          <span class="explanation">(antispam code,to prevent program generated entries. ) </span>
          <table width="100%">
            <tr align="center">
              <td class="explanation">This is the security code
                <input type="text" size="8" maxlength="5" name="hiddengenvercode" id="hiddengenvercode" readonly value="<?=$genVercode ?>"/>              </td>
            </tr>
            <tr align="center">
              <td class="explanation">Enter the security code from box above here
                <input type="text" name="vercode" id="vercode" size="8" maxlength="5" />              </td>
            </tr>
        </table>		</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><center>
          <input type = "submit"  value="Submit Form" />
      </center></td>
    </tr>
  </table>
</form>
</body>

</html>