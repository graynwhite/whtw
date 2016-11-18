<?php
if (isset($_POST['jstest'])) {
  $nojs = FALSE;
  $nojs2= "No Javascript is not disabled";
  } else {
  // create a hidden form and submit it with javascript
  echo '<form name="jsform" id="jsform" method="post" style="display:none">';
  echo '<input name="jstest" type="text" value="true" />';
  echo '<script language="javascript">';
  echo 'document.jsform.submit();';
  echo '</script>';
  echo '</form>';
  // the variable below would be set only if the form wasn't submitted, hence JS is disabled
  $nojs = TRUE;
  $nojs2 = "Yes Javascript is disabled";
}
if ($nojs){
	die("<h2>To use this site it is necessary to enable JavaScript.<br />
 Here are the <a href=\"http://www.enable-javascript.com/\" target=\"_blank\">
 instructions on how to enable JavaScript in your web browser</a>.</h2>");
  //JS is OFF, do the PHP stuff
}

$genVercode = rand(10000,99999);
 
require_once($_SERVER['DOCUMENT_ROOT']."/_private/gonetopress.php");
//include_once($_SERVER['DOCUMENT_ROOT']. "/javascript/dateHandling.js");
//require_once($_SERVER['DOCUMENT_ROOT'] ."/stylesheets/Forms.css");
$sourceg = $_SERVER['REMOTE_ADDR'];
//echo "the source is " . $sourceg;
//exit;
$eventOrg=isset($_COOKIE["eventOrg"]) ? $_COOKIE["eventOrg"] : '';
$eventName=isset($_COOKIE["eventName"]) ? $_COOKIE["eventName"] : '';
$eventEmail=isset($_COOKIE["eventEmail"]) ? $_COOKIE["eventEmail"] : '';
$eventPhone=isset($_COOKIE["eventPhone"]) ? $_COOKIE["eventPhone"] : '';
?>
<!DOCTYPE html> 
<html><head>

	<title>Organization Event Input Mobile</title>
	<meta name="viewport" content="width=device-width, user-scalable=yes" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon"
 	type="image/vnd.microsoft.icon"
 	href="../gwlogo.gif" />
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	<link rel="stylesheet" href="http://www.graynwhite.com/jqvaleng/css/template.css" />
	<link rel="stylesheet" href="http://www.graynwhite.com/jqvaleng/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="mobile.css"/>
    
	
		
		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.js" type="text/
javascript"></script>
		<script src="js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>-->
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		<script src="http://www.graynwhite.com/jqvaleng/js/jquery-1.8.2.min.js"></script>
		<script src="http://www.graynwhite.com/jqvaleng/js/languages/jquery.validationEngine-en.js"></script>
		<script src="http://www.graynwhite.com/jqvaleng/js/jquery.validationEngine.js"></script>
		<script src="http://www.graynwhite.com/dough/Dough/dough.min.js"></script>
		
	<script>
	$(document).ready(function(){
	
	 
	   

  jQuery("#formInput").validationEngine(
  { 'custom_error_messages':
  {'#Orgname' :{
  			'required': {
  				'message': "This field must contain the name of the organization that you are representing for this event"
				}
				}
				}
				}
  );
});
</script>

<script>
//dates.compare(a,b)
//
//Returns a number:
//
//-1 if a < b
//0 if a = b
//1 if a > b
//NaN if a or b is an illegal date
//dates.inRange (d,start,end)
//
//Returns a boolean or NaN:
//
//true if d is between the start and end (inclusive)
//false if d is before start or after end.
//NaN if one or more of the dates are illegal.
//dates.convert
//
//Used by the other functions to convert their input to a date object. The input can be
//
//a date-object : The input is returned as is.
//an array: Interpreted as [year,month,day]. NOTE month is 0-11.
//a number : Interpreted as number of milliseconds since 1 Jan 1970 (a timestamp)
//a string : Several different formats is supported, like "YYYY/MM/DD", "MM/DD/YYYY", "Jan 31 2009" etc.
//an object: Interpreted as an object with year, month and date attributes. NOTE month is 0-11.
//


var dates = {
    convert:function(d) {
        // Converts the date in d to a date-object. The input can be:
        //   a date object: returned without modification
        //  an array      : Interpreted as [year,month,day]. NOTE: month is 0-11.
        //   a number     : Interpreted as number of milliseconds
        //                  since 1 Jan 1970 (a timestamp) 
        //   a string     : Any format supported by the javascript engine, like
        //                  "YYYY/MM/DD", "MM/DD/YYYY", "Jan 31 2009" etc.
        //  an object     : Interpreted as an object with year, month and date
        //                  attributes.  **NOTE** month is 0-11.
        return (
            d.constructor === Date ? d :
            d.constructor === Array ? new Date(d[0],d[1],d[2]) :
            d.constructor === Number ? new Date(d) :
            d.constructor === String ? new Date(d) :
            typeof d === "object" ? new Date(d.year,d.month,d.date) :
            NaN
        );
    },
    compare:function(a,b) {
        // Compare two dates (could be of any type supported by the convert
        // function above) and returns:
        //  -1 : if a < b
        //   0 : if a = b
        //   1 : if a > b
        // NaN : if a or b is an illegal date
        // NOTE: The code inside isFinite does an assignment (=).
        return (
            isFinite(a=this.convert(a).valueOf()) &&
            isFinite(b=this.convert(b).valueOf()) ?
            (a>b)-(a<b) :
            NaN
        );
    },
    inRange:function(d,start,end) {
        // Checks if date in d is between dates in start and end.
        // Returns a boolean or NaN:
        //    true  : if d is between start and end (inclusive)
        //    false : if d is before start or after end
        //    NaN   : if one or more of the dates is illegal.
        // NOTE: The code inside isFinite does an assignment (=).
       return (
            isFinite(d=this.convert(d).valueOf()) &&
            isFinite(start=this.convert(start).valueOf()) &&
            isFinite(end=this.convert(end).valueOf()) ?
            start <= d && d <= end :
            NaN
        );
    }
}
function checkEndDate()

{
	if(document.formInput.dateEnd.value == " ")
	{
		return;
	}
	var datestring= document.formInput.dateStart.value + " 00:00:00 ";
	var startDate = new Date(datestring);
	var datestring= document.formInput.dateEnd.value + " 00:00:00 ";
	var EndDate = new Date(datestring);
	var answer = dates.compare(startDate,EndDate);
	if (answer!='1'){
		
	}else{
		alert("The end date  must be a valid date and greater than the start date or blank.")
	}
}

function checkReserveDate()

{
	if(document.formInput.dateRes.value == " ")
	{
		return;
	}
	var datestring= document.formInput.dateStart.value + " 00:00:00 ";
	var startDate = new Date(datestring);
	var datestring= document.formInput.dateRes.value + " 00:00:00 ";
	var ResbyDate = new Date(datestring);
	var answer = dates.compare(startDate,ResbyDate);
	if (answer!='-1'){
		
	}else{
		alert("The reserve by date  must be a valid date and less than the start date or blank.")
	}
}
function checkStartDate()
{
	//alert("starting to check date");
	var today = new Date();
	var datestring= document.formInput.dateStart.value + " 00:00:00 ";
	var startDate = new Date(datestring);
	var answer = dates.compare(today,startDate);
	if (answer=='-1'){
		
	}else{
		alert("The event date or event start date must be a valid date and greater than todays date.")
	}
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;


}

</script>
 

<script src="http://www.graynwhite.com/gwanalytics.js"></script>
</head>
<body>

<div id="page1" data-role='page'>
<div data-role='header'>
<h1>Organization Event Information Input<br /> 
<img src="graynwhitebannereventMaint.jpg" width="100%"  /></h1>
</div>

<div id="pgcontent" data-role='content'>
<p>The Gray and White Event Database is used to create multiple web site pages including the Peggy Jo Studio Newsletter </p>
<p style="color:red; text-decoration:underline";><? echo $presstime ?></p>
<form  action="../../emailControl/fakeMailToWebmaster.php?org=eventinput" method="post" name='formInput' id='formInput'   >
  
    <input type="hidden" name="Subject" value=" WHTW Entry" />
    <input type="hidden" name="Sender" value="+Email+" />
    <input type="hidden" name="recipient" value="webmaster@graynwhite.com" />
    <input type="hidden" name="env_report" value="REMOTE_HOST,HTTP_USER_AGENT" />
    <input type="hidden" name="bgcolor" value="#ffffff" />
    <input type="hidden" name="text_color" value="#000000" />
	<input type="hidden" name="refferSrc"  value="<?echo $sourceg?>">
    <input type="hidden" name="return_link_url" value="http://graynwhite.com/whtw" />
    <input type="hidden" name="return_link_title" value="If you want to make corrections or enter more events use the back button on your browser or click here to go back to the home page" />
    <span class="Required">fields marked with a red asterisk * are required. </span></p>
  <p>
  This form will be eMailed to the webmaster for review and editing and will be placed in the Gray and White Event database as soon as possible.  </p>
  <p>To  
  check the status of an event one can access the calendar of events at <a href="http://www.graynwhite.com/whtw/calendar.php">http://www.graynwhite.com/whtw/calendar.php</a> and clicking on the date. Initially the current month is presented but future months can be displayed by using the date box at the bottom of the form.  </p>
  
  <h3 class="important">Do not use all caps words anywhere, only capitilize where appropriate- press releases will not accept them!!! Enabling javascript is required to use this form </h3>
 
  
     
   
   <div data-role='fieldcontain'>
   
   <fieldset data-role="controlgroup" data-type="horizontal">
    <legend>Entry Type:</legend>  
        <label for= "typenew">New</label>  
        <input name="radioEntryType" id="typenew" type="radio" value="new" checked="checked" />
		  
          
       <label for='typechange'>Change</label>
        <input type="radio" name="radioEntryType"  value="Change" id='typechange' />
        
		<label for ='typedelete'>Delete</label>
       	        <input type="radio" name="radioEntryType" value="Delete" id='typedelete'  />
     </fieldset>
	
	<p>Change/Delete 
        (Send an email to webmaster@graynwhite.com to explain change or delete)
	</p>
	
	</div> <!-- field contain -->
	
	
	 <fieldset>
	<legend>Your information</legend>	 
   
      <legend>Organization Name </legend>
      <input name="Orgname" type="text" id="Orgname"  class="validate[required]"  value="<?php echo $eventOrg ?>"
	  data-prompt-position="bottomLeft:140,5" 
      onBlur='setCookie("eventOrg",this.value,90)';
	   />
    	
	  
	   
      <legend>Your Name: </legend>
      <input name="yourName" type="text" id="yourName" class="validate[required]" 
	  data-prompt-position="bottomLeft:140,5" value="<?php echo $eventName ?>"
      onBlur='setCookie("eventName",this.value,90)' />
     
      <legend>Your E-Mail Address</legend>
      <input name="Email" id="Email" type ="email"  class="validate[required]" 
	  data-prompt-position="bottomLeft:140,5" value="<?php echo $eventEmail ?>"
      onBlur='setCookie("eventEmail",this.value,90)' />
         
    
	 <legend> Your phone Number</legend>
      <input name="Yphone" id="Yphone" type = "tel" value="<?php echo $eventPhone ?>"
      onBlur='setCookie("eventPhone",this.value,90)'  />
	</fieldset>
	
    <div style="border:thin">
     <fieldset>
	 
      <legend>Title of Event(keep it short do not use all caps) </legend>
      <input name="EventTitle" type="text" id="EventTitle" class="validate[required]"  
	  data-prompt-position="bottomLeft:140,5"/>
  		
		
      <legend>Date of Event:  Use the downarrow on the right to get a dropdown calendar or enter the
       date in the form mm/dd/yyy ( the system will convert it to yyyy-mm-dd )</legend>
	 
     <input name="dateStart" id="dateStart" type="date"  class="validate[required,checkStartDate()] text-input datepicker"
	 data-prompt-position="bottomLeft:140,5" 
	 title="The Date of Event is the date of the event  or the beginning date of a multiple day event. It must be greater than todays date.
      Enter the entire date including the year in the form of mm/dd/yyyy  if you see a  down arrow on the right, click, for a  pop up calendar."> 
	    
     <legend>Reserve By: If different than begin date.  Use the downarrow on the right
      to get a dropdown calendar or enter the date in the form mm/dd/yyyy </legend>
	 <input name="dateRes" id="reserve_date" type="date" class="validate[custom[date] text-input datepicker"
	 data-prompt-position="bottomLeft:140,5" title="Reserve By is the date
      that reservations are required.
       Leave blank if not applicable" onBlur="checkReserveDate()" /> 
	  
   
     <legend>End Date: If different than begin date . Use the downarrow on the right
      to get a dropdown calendar or directly in the form mm/dd/yyy </legend>
	 
	<input name="dateEnd" id="dateEnd" type="date"  class="validate[custom[date], text-input datepicker"
	  data-prompt-position="bottomLeft:140,5"
	  title="The End Date is for events that span multiple days.
      Leave blank if not applicable.
      This is not to be used to describe recurring events.
      This is the ending date of a multiple day event, such as a weekend, 
      leave as is  for single day events. 
      It is not the end date of a recurring 
      event such as every monday from a date
       to another date. Use the box at 
       the bottom of the form to
       let the webmaster know that this is a 
       recurring event so that it can be
        replicated.
        "  onBlur="checkEndDate()" />    

	  
		
   
      <legend>Start Time  (required but will be ignored for multi-day events). You can enter the start time
      directly in the form hh:mm (AM or PM). If you use the form timepicker, scroll the hour, minutes and AM or PM so that they are
      between the paralell horizontal blue lines.</legend>
      
	  <input name="timeStart" id="timeStart" type="time" placeholder="7:00 PM" class="validate[required]"
	  data-prompt-position="bottomLeft:140,5"  title="Enter time in twelve hour format include am or pm." /> 
               
      <legend>End Time: if applicable</legend>
     <input name="timeEnd" id="timeEnd" type="time"  val=" "
	 title="Day of week so the system can verify that the date and day of week agree
      		Day of the week or Weekend, Week, etc."  /> 
            
      		<legend>Day of Week </legend>
			
          <input name="Day_of_week" type="text"  val=" " class=validate[required] data-prompt-position="bottomLeft:140,5" /> 
         
		  </fieldset>
	</div>	  
		  <fieldset>
		  <legend> Place Information</legend>
		  <p>Enter the place, including address, city
        and phone number  here. Google the place to find the address.
        This field should contain <b>information about the ultimate destination</b>, not a preliminary meeting place.
         </p>
		<p>The separate fields allow Google to generate a map. Believe it or not everything does have a postal address.
        
         </p> 
         <legend>Place Name </legend>
              <input type="text" name="place_name" val=" "
               class="validate[required]"
               title="Such as Boyne Mountain or Emagine Theater. Not a parking lot where you will gather to board busses or a restaurant prior to the event."
                 data-prompt-position="bottomLeft:140,5"  />
		<legend>Place address (optional)</legend>	  
              <input type="text" name="place_address" id="place_address" val " " />
        <legend>City </legend>
              <input type="text" name="city" val=" " class="validate[required]"
			  data-prompt-position="bottomLeft:140,5" />
		<legend>State</legend>
              <input type="text" name="state"  value ="MI" />
		<legend>Postal Code (optional)</legend>
              <input name="zip" type="text" val=" " />
		<legend>Place Phone (optional)</legend
              ><input type="tel" name="phone" val="" />
         <legend>Web site URL (optional leave blank if you do not have a website)</legend>
              <input name="url"id="url" type="text"  val=""  />
		<legend>Place email (optional)</legend>
              <input name="place_email" type="email" id="place_email" class="validate[custom[email]]"
			  data-prompt-position="bottomLeft:140,5" />
        <legend>Additional directions</legend>
          <textarea name ="PlaceDirections" val=" "  id="PlaceDirections" ></textarea>
      </fieldset>
	  <fieldset>
	  <legend>What the event is about</legend>  
		<legend>Media Input or Long version:</legend>
		<p> This is where you can give a  full lengthy description of the event or trip. Do not repeat the time and place of the event.<strong> Do not use all caps. </strong>
        If there is a preliminary meeting place and you think it is neccessary to inform everyone, then place that information here. The text box will expand to accept your input.</p>
      <legend>Long description</legend>    
      <textarea name ="comments" id="comments"></textarea>
	 
    <legend>Event Activity or Short Version </legend>
	<P>Describe the event here. Include a 
        person and phone number to contact if desired .
         This is a shortened version of the media 
         input only the first 235 characters will be
          accepted. Do not repeat the Date, time or place. </p>
		
      <textarea name ="activity"  id="activity" class="validate[required,maxSize[235]]"
	  data-prompt-position="bottomLeft:140,5">  </textarea>
	  </fieldset>
	  
	  <fieldset>
	  <legend>How much does it cost?</legend>
	  <legend>Price for members</legend>
      <input type="text" name="Price_Member" id="Price_Member" val="" />
	</fieldset>
	<fieldset>
		<legend>Price Guests</legend>
        <input type="text" name="Non_Member_Price" val='' />
		</fieldset>
		
   <fieldset>
      <legend>Recurring Event</legend>
	   <p>If  this event takes place on a regular basis without changes, include this information so that the webmaster can replicate the event so that you do not have to enter it repeatably. If for some reason the event will not take place on one or more occasions, send an email to the webmaster@graynwhite.com in order to delete those specific events.</p>
  <p>If you have an event that occurs regularly, but there will be program additions and/or changes, do not classify it as a recurring event</p>    
		
				
        <legend>Description of Recurring Event</legend>
		 <textarea name ="recurComments" id="recurComments"
         title="If this event occurs on a regular basis
          and does not require updates to the description,
          use this box to let the webmaster know  what the schedule pattern is."
          </textarea>       
   		</fieldset>
      
      <center>
          <input type = "submit" name="Submit" value="Submit Form"
          title="If you do not get a confirmation message  after submitting this form,
            scroll up to find the error and submit again." />
      </center>
   
 </form>
</div> <!-- end of content -->
<div data-role="footer"><h1>Organization input</h1></div>
</div> <!-- End of page -->
</body>
</html>