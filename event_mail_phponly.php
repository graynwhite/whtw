<?php
$genVercode = rand(10000,99999);
?>
<HTML>
<HEAD>
<TITLE>Organization event input</TITLE>
<?php
include_once($_SERVER['DOCUMENT_ROOT']. "/javascript/calendarDisplay.inc");
?>
<Script language=Javascript>
<!--

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
	if (!re.test(form.EMAILID.value)) {
		alert("Invalid email Address.")
		form.EMAILID.focus()
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
function submit_page(form){
var foundError = false;
var Radio_state = "   ";
pass = new MakeArray(11);
pass[0]= "water";
pass[1]= "holes";
pass[2]= "mounds";
pass[3]= "east";
pass[4]= "west";
pass[5]= "hope";
pass[6]= "good";
pass[7]= "boats"; 
pass[8]= "nocars";
pass[9]= "bird";
pass[10]= "fjc719";

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
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}

//-->
</script>


<style type="text/css">
<!--
.Required {
	color: #FF0000;
}
.fieldName {
	font-family: "Times New Roman", Times, serif;
	font-style: normal;
	font-weight: bold;
	color: #000000;
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
-->
</style>
</HEAD>
<BODY>
<H1>Organization Event Information</H1>
<!-- SitePal
<H1> SceneWizSc1127110Acc61468BodyStart
<script language='JavaScript' type="text/javascript" src="http://vhost.oddcast.com/vhost_embed_functions.php?acc=61468&js=1"></script><script language="JavaScript" type="text/javascript">AC_VHost_Embed_61468(100, 200, 'FFFFFF', 1, 1, 859241, 1127110, 0, 0, '88e94b1aea0380ee5f543dab526a0577', 6);</script>
 Scen-->
<!-- eWizSc1127110Acc61468BodyEnd&nbsp;</H1>-->
 
<form  action="../../emailControl/mailToWebmaster.php?org=eventinput&phponly=true" method="post" name='formInput' id='formInput'  onSubmit="return check_page(this)" >
  <p>
    <input type=hidden name="Subject" value=" WHTW Entry">
    <input type=hidden name="Sender" Value=+Email+>
    <input type=hidden name="recipient" value="cauleyfrank@gmail.com">
    <input type=hidden name="env_report" value="REMOTE_HOST,HTTP_USER_AGENT">
    <input type=hidden name="bgcolor" value="#ffffff">
    <input type=hidden name="text_color" value="#000000">
    <input type=hidden name="return_link_url" value="http://graypluswhite.com/whtw">
    <input type=hidden name="return_link_title" value="If you want to make corrections or enter more events use the back button on your browser or click here to go back to the home page">
fields marked with a red asterisk <span class="Required">*</span> are required. 
  <table align = "left" border= "1" width = "105%" style="border-collapse: collapse" bordercolor="#111111" cellpadding="0" cellspacing="0">
  <tr >
    <td class="fieldName">Sign me up as an Organizational Publicist. </td>
    <td><p>
      <label>
        <input type="radio" name="Sign_up" value="Yes">
        Yes</label>
     
      <label>
        <input type="radio" name="Sign_up" value="No">
        No</label>
      <br>
    </p></td>
    <td class="fieldName">&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td width="18%" class="fieldName">Organization Name </td>
    <td width="38%"><input name="Orgname" type="text" id="Orgname  size="40" size="40" maxlength="40">
      <span class="Required">*</span></td>
    <td width="6%" class="fieldName"> Your Name:</td>
    <td width="37%" ><input name="yourName" type="Text" id="yourName" size="40" maxlength="40">
        <span class="Required">*</span> </td>
  </tr>
  <tr>
    <td class="fieldName">Your E-Mail Address</td>
    <td><input name="Email" id="Email" type ="text"  size="45" maxlength="45">
        <span class="Required">*</span> </td>
    <td class="fieldName"> Your phone Number</td>
    <td><input name="Yphone" type = "text" size="20" maxlength="20"></td>
  </tr>
  <tr>
    <td class="fieldName">Date From :</td>
    <td><span class="explanation">This is the date of the event or the beginning date of a multiple day event.  </span><br>
      <select name="From_mm" size="1">
        <option value="01-">January</option>
        <option value="02-">February</option>
        <option value="03-">March</option>
        <option value="04-">April</option>
        <option value="05-">May</option>
        <option value="06-">June</option>
        <option value="07-">July</option>
        <option value="08-">August</option>
        <option value="09-">September</option>
        <option value="10-">October</option>
        <option value="11-">November</option>
        <option value="12-">December</option>
      </select>
      <select name = "From_day" size = "1" >
        <option value="01">01
          <option value="02">02
          <option value="03">03
          <option value="04">04
          <option value="05">05
          <option value="06">06
          <option value="07">07
          <option value="08">08
          <option value="09">09
          <option value="10">10
          <option value="11">11
          <option value="12">12
          <option value="13">13
          <option value="14">14
          <option value="15">15
          <option value="16">16
          <option value="17">17
          <option value="18">18
          <option value="19">19
          <option value="20">20
          <option value="21">21
          <option value="22">22
          <option value="23">23
          <option value="24">24
          <option value="25">25
          <option value="26">26
          <option value="27">27
          <option value="28">28
          <option value="29">29
          <option value="30">30
          <option value="31">31
        </select>
      <select name="From_year" size="1" >
        <option value="<?echo $year_1?>-"><?echo $year_1?> </option>
        <option value="<?echo $year_2?>-"><?echo $year_2?> </option>
        <option value="<?echo$year_3?>-"><?echo$year_3?> </option>
      </select></td>
    <td class="fieldName">Reserve By: </td>
    <td><div id="calendar">Content for  id calendar Goes Here</div>      
      <p class="explanation">This is the reservation date if applicable leave it blank if no advance reservation is required otherwise enter the date. <br>
        <SELECT NAME="Reserve_mm" SIZE="1">
         <OPTION VALUE="   " selected>N/A
	<OPTION VALUE="01-">January
	<OPTION VALUE="02-">February
	<OPTION VALUE="03-">March
	<OPTION VALUE="04-">April
	<OPTION VALUE="05-">May
	<OPTION VALUE="06-">June
	<OPTION VALUE="07-">July
	<OPTION VALUE="08-">August
	<OPTION VALUE="09-">September
	<OPTION VALUE="10-">October
	<OPTION VALUE="11-">November
	<OPTION VALUE="12-">December
	</SELECT>
	
	 <Select NAME = "Reserve_day" Size = "1" >
         <OPTION VALUE="   " selected>N/A
	 <Option value= "01">01
	 <Option value= "02">02
	 <Option value= "03">03
	 <Option value= "04">04
     <Option value= "05">05
	 <Option value= "06">06
	 <Option value= "07">07
	 <Option value= "08">08
	 <Option value= "09">09
	 <Option value= "10">10
     <Option value= "11">11
	 <Option value= "12">12	
	 <Option value= "13">13
     <Option value= "14">14
	 <Option value= "15">15	
	 <Option value= "16">16
     <Option value= "17">17
	 <Option value= "18">18	
	 <Option value= "19">19
     <Option value= "20">20
	 <Option value= "21">21
	 <Option value= "22">22
	 <Option value= "23">23	
	 <Option value= "24">24
	 <Option value= "25">25
	 <Option value= "26">26
	 <Option value= "27">27
	 <Option value= "28">28
	 <Option value= "29">29
	 <Option value= "30">30
	 <Option value= "31">31
	 </Select>
		

	<SELECT NAME="Reserve_year" SIZE="1" >
	<OPTION VALUE="   " selected>N/A
	<OPTION VALUE="<?=$year_1?>-"> <?=$year_1?>
         <OPTION VALUE="<?=$year_2?>-"><?=$year_2?>
        <option value="<?=$year_3?>-"><?=$year_3?></option>
	</select></td>

  </tr>
  <tr>
    <td class="fieldName">To Date</td>
    <td><span class="explanation">This is the ending date of a multiple day event </span>leave blank for single day events<br>
      <SELECT NAME="To_mm" SIZE="1">
	<OPTION VALUE="   " selected>N/A
	<OPTION VALUE="01-">January
	<OPTION VALUE="02-">February
	<OPTION VALUE="03-">March
	<OPTION VALUE="04-">April
	<OPTION VALUE="05-">May
	<OPTION VALUE="06-">June
	<OPTION VALUE="07-">July
	<OPTION VALUE="08-">August
	<OPTION VALUE="09-">September
	<OPTION VALUE="10-">October
	<OPTION VALUE="11-">November
	<OPTION VALUE="12-">December
	</SELECT>

	<Select NAME = "To_day" Size = "1">
	<Option Value = "  " selected>N/A
	<Option value= "01">01
	 <Option value= "02">02
	 <Option value= "03">03
	 <Option value= "04">04
     <Option value= "05">05
	 <Option value= "06">06
	 <Option value= "07">07
	 <Option value= "08">08
	 <Option value= "09">09
	 <Option value= "10">10
     <Option value= "11">11
	 <Option value= "12">12	
	 <Option value= "13">13
     <Option value= "14">14
	 <Option value= "15">15	
	 <Option value= "16">16
     <Option value= "17">17
	 <Option value= "18">18	
	 <Option value= "19">19
     <Option value= "20">20
	 <Option value= "21">21
	 <Option value= "22">22
	 <Option value= "23">23	
	 <Option value= "24">24
	 <Option value= "25">25
	 <Option value= "26">26
	 <Option value= "27">27
	 <Option value= "28">28
	 <Option value= "29">29
	 <Option value= "30">30
	 <Option value= "31">31
	 </Select>
	 <select name="To_year" size="1" >
       <option value="   " selected>N/A
         <option value="<?=$year_1?>-">
       <?=$year_1?>
       <option value="<?=$year_2?>-">
         <?=$year_2?>
       <option value="<?=$year_3?>-">
         <?=$year_3?>
         </option>
     </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="111" class="fieldName">Start Time</td>
    <td><span class="explanation">
      The start time of the event if applicable.</span> <span class="Required">* </span></p>
      <p>
        <Select NAME = "Start_Time_Hours" SIZE = "1" >
              <OPTION VALUE = "   " selected>N/A
            <OPTION VALUE = "01:">01
            <OPTION VALUE = "02:">02
            <OPTION VALUE = "03:">03       
            <OPTION VALUE = "04:">04
            <OPTION VALUE = "05:">05
            <OPTION VALUE = "06:">06
            <OPTION VALUE = "07:">07
            <OPTION VALUE = "08:">08
            <OPTION VALUE = "09:">09
            <OPTION VALUE = "10:">10
            <OPTION VALUE = "11:">11
            <OPTION VALUE = "12:">12
          </SELECT>
        Hour<BR>
        <SELECT Name = "Start_Time_Minutes" SIZE = "1">
          <OPTION VALUE = "  " selected>N/A
            <Option Value = "00">00
            <OPTION VALUE = "15">15
            <OPTION VALUE = "30">30
            <OPTION VALUE = "45">45
          </SELECT>
        Minutes<BR>
        <SELECT NAME= "Start_AMPM" size= "1">
          <Option Value = "   " selected>N/A
            <Option Value = " PM">PM
            <Option Value = " AM">AM
          </Select>
      AM or PM</p></td>
    <td class="fieldName">End Time:</td>
    <td><p><span class="explanation">Ending time of the event or blank if not applicable. </span>.
      <p>    
        <Select NAME = "To_Time_Hours" SIZE = "1" >
          <OPTION VALUE = "   " selected>N/A
            <OPTION VALUE = "01:">01
            <OPTION VALUE = "02:">02
            <OPTION VALUE = "03:">03       
            <OPTION VALUE = "04:">04
            <OPTION VALUE = "05:">05
            <OPTION VALUE = "06:">06
            <OPTION VALUE = "07:">07
            <OPTION VALUE = "08:">08
            <OPTION VALUE = "09:">09
            <OPTION VALUE = "10:">10
            <OPTION VALUE = "11:">11
            <OPTION VALUE = "12:">12
          </SELECT>
        Hour <BR>
        <SELECT Name = "To_Time_Minutes" SIZE = "1">
          <OPTION VALUE = "  " selected>N/A
            <OPTION VALUE = "00">00
            <OPTION VALUE = "15">15
            <OPTION VALUE = "30">30
            <OPTION VALUE = "45">45
          </SELECT>
        Minutes<BR>
        <SELECT NAME= "To_AMPM" size= "1">
          <Option Value = "   " selected>N/A
            <Option Value = " PM">PM
            <Option Value = " AM">AM
          </Select>
        AM or PM    
      <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td><span class="fieldName">Day of Week</span> :</td>
    <td><span class="explanation">Day of the week or Weekend, Week, etc.
        </span>
      <input name="Day_of_week" type="TEXT"  size="20">
        <span class="Required">*</span></td>
    <td class="fieldName">&nbsp;</td>
    <td class="explanation">&nbsp;</td>
    </tr>
  <tr>
    <td class="fieldName">Comments: <span class="explanation">These will not appear in the event description but may appear in  news stories </span></td>
    <td colspan="3"><textarea name ="comments" cols ="100" rows ="7"></textarea></td>
  </tr>
  <tr>
    <td>Title of Event (keep it short) </td>
    <td colspan = "3"><input name="EventTitle" type="text" id="EventTitle" size="40"></td>
  </tr>
  <tr>
    <td><b><font size="4">Place</font></b> <span class="explanation">:Enter the place, including address 
      and phone number  here. (only the first 235 characters will be accepted) </span></td>
    <td colspan = "3"><p>Place Name<span class="Required">*</span>
        <input type="text" name="place_name" size="40">
      Address
      <input type="text" name="place_address" size="24">  
      <br/>
      City
      <input type="text" name="city" size="24">
      State
  <input type="text" name="state" size="3" value ="MI">
      Postal Code
  <input name="zip" type="text" size="12" maxlength="12">
      Phone
  <input type="text" name="phone" size="14">
  <br/>
      URL
      <input name="url" type="text" size="40" maxlength="40">
      email
  <input name="place_email" type="text" id="place_email" size="40" maxlength="40">
    </p>
      <p>Additional directions </p>
      <p>
        <textarea name ="PlaceDirections" cols ="100" rows ="2" id="PlaceDirections" ></textarea>
      </p></td>
  </tr>
  <tr>
    <td><b><font size="4">Event <span class="Required">*</span> </font></b>:<span class="explanation">Describe the event here. Include a 
      person and phone number to contact if desired </span></td>
    <td colspan ="3"><textarea name ="activity" cols ="100" rows ="4" id="activity"></textarea></td>
  </tr>
  <tr>
    <td>Price Members :</td>
    <td><input type="text" name="Price_Member" size="20" maxlength="50" ></td>
    <td>Price Guests</td>
    <td><input type="text" name="Non_Member_Price" size="20" maxlength="50" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan ="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><p><span class="fieldName">Recurring Event?</span><br>
      <input type="radio" name="recurring" value ="Yes">
      Yes<br>
      <input type="radio" name="recurring" value="No" checked>
      No<br>
      Day of week: Mon
      <input type="checkbox" name="Mon" value="ON">
      Tue
      <input type="checkbox" name="TUE." value="ON">
      Wed
      <input type="checkbox" name="Wed." value="ON">
      Thu
      <input type="checkbox" name="Thu." value="ON">
      Fri
      <input type="checkbox" name="Fri" value="ON">
      Sat
      <input type="checkbox" name="sat." value="ON">
      Sun
      <input type="checkbox" name="Sun." value="ON">
      <br>
      Week of Month: 1st
      <input type="checkbox" name ="first" value="ON">
      2nd
      <input type="checkbox" name="Second." value="ON">
      3rd
      <input type="checkbox" name="Third." value="ON">
      4th
      <input type="checkbox" name="fourth." value="ON">
      5th
      <input type="checkbox" name="Fifth" value="ON">
      last of the month
      <input name="Last" type="checkbox" id="Last" value="On">
      <br>
      Enter the beginning date of this recurring event (The first time it occurs)
      <input type=text name="recurbegin" id ='recurbegin' size="20">
      <br>
      To Date Enter the date of the last time this recurring event will occur      
      <input type =Text name="recurend"  id='recurend' size="20">
      </td>
	  
	   <p>&nbsp;</p></td>
  </tr>
  <tr><td colspan="4" align="center"><strong>CAPTCHA</strong><br/>
  (antispam code,to prevent program generated entiries. )
      <table width="100%"><tr align="center"><td>This is the security code <input type="text" size="8" maxlength="5" name="hiddengenvercode" id="hiddengenvercode" readonly="true" value="<?=$genVercode ?>"/></td></tr><tr align="center"><td>Enter the security code from box above here 
  <input type="text" name="vercode" id="vercode" size="8" maxlength="5"></td></tr></table>
  </td></tr>
  <tr>
    <td colspan = "4"><center>
      <input type = "submit" name="Submit" value="Submit Form"  >
    </center></td>
  </tr>
</table>
</FORM>
</BODY>
</HTML>