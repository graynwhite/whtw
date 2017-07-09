<?PHP

require_once("../phpClasses/Class_evententry.php");
require_once("../phpClasses/Class_publicist.php");
$pub = new publicist;
$ee = new eventEntry;

//Open images directory
/*$dir = dir("_private");
$file_array = array();
//List xml files in _private directory
while (($file = $dir->read()) !== false)
{
	if(substr($file,-3,3)== 'xml' && (substr($file,0,5)== 'event' ||  substr($file,0,5) =='geven' ))
	{
	//echo "filename: " . $file . "<br />";
	$file_array[]=$file;
	}
}

$dir->close();
rsort($file_array);*/

$file_to_read = "../newsletter/" . $_GET['file'];
//print_r($file_array);
//$file_to_read = './_private/' .$file_array[0];
//$file_to_read = './_private/event20100311232948.xml';
//$simple = new simpleXml;
//$xml = $simple->simplexml_load_file($file_to_read) or die ("Unable to load XML file!");
$xml =  simplexml_load_file($file_to_read) or die("Unable to load file");
//print_r($xml);

// access XML data
$subName= $xml->subName;
//echo("<br>Subname is ". $subName);
$entryType=$xml->entryType;
$recurring=$xml->recurdesc;
$refferSrc = $xml->refferSrc;
$From_date=$xml->From_date;
$date_work = explode("-",$From_date);
//echo("<br>Date work is ".$date_work[0].'-'.$date_work[1]. '-'. $date_work[2]. " on line 42");
if(strlen($date_work[0])>2){
$From_date =$xml->From_date;

}else{
$From_date = $date_work[2] . "-" .  $date_work[0] . "-" . $date_work[1];
}
if($xml->to_date == ''){
	$date_to = $From_date;
}
else{
	$date_work2=$xml->to_date;
	$date_work2 = explode("-",$date_work2);
	if(strlen($date_work2[0])>2){
	$date_to=$xml->to_date;

	}else{
	$date_to=$date_work2[2]. "-" . $date_work2[0]. "-" . $date_work2[1];
	}
}
//echo("<br />Date to is ").$date_to ." on line 48";
if($xml->reserve_by == ''){
	$reserve_by = $From_date;
}else{
	$date_work3=$xml->reserve_by;
	$date_work3 = explode('-',$date_work3);
	if(strlen($date_work3[0])>2);
	
	$reserve_by=$xml->reserve_by;

	}
	


//print_r($xml);
$firstDay = $ee->get_dow($From_date,$From_date);
$computedDow = $ee->get_dow($From_date,$date_to);
$thisDayOfWeek = $subName=='Google Calendar' || $refferSrc == 'FlashEventEntry' ?  $computedDow . " or  " . $firstDay : $xml->Day_of_week ;

//echo '<br /> computed day of week is ' . $computedDow;
//echo '<br /> result  ' . $thisDayOfWeek;

$place_full = $xml->place_name . '. ' . $xml->place_address . ', ' . $xml->city . ', ' . $xml->state . '. ' . $xml->zip . ' '. $xml->place_phone . ' ' . $xml->place_url . ' ' . $xml->place_email ;
$timeStartWork=$xml->start_time;
if($timeStartWork!=" "){
	 	$timeStartConv=date("g:i A", strtotime($timeStartWork));
}else{$timeStartConv=" ";
}
$timeEndWork=$xml->to_time;
if($timeEndWork!=" "){
	 	$timeEndConv=date("g:i A", strtotime($timeEndWork));
}else{$timeEndConv=" ";
}
//$dom = new DOMDocument;
//$dom->prevservWhiteSpace = false;
//
//if (!$dom->load($file_to_read)) {
//    echo $file_to_read . " doesn't exist!\n";
//    return;
//}
//
//$subname = $dom->getElementsByTagName('subName');
//echo $subname;
	

?>




<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../javascript/typeAhead.css" rel="stylesheet" type="text/css" />
<link href="../event_input.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//ajax.googlens.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="../geocomplete/jquery.geocomplete.min.js"></script>

<script type="text/javascript" src="../markitup/markitup/jquery.markitup.js"></script>
<script type="text/javascript" src="../markitup/markitup/sets/html/set.js"></script>

<script src="../javascript/ajaxBasics.js" type="text/javascript"></script>
<script src="../javascript/typeAhead.js" type="text/javascript"></script>


<title>Process Remote Event Entry</title>
<script language="javascript">
var testString = '';


//===================================================================================================
function acknowledge(){
	var recipientName = document.getElementById("subName");
	var recipientEmail = document.getElementById("emailid");
	var recipientAddress = recipientName.value + " <" + recipientEmail.value + "> ";
	var pubname = recipientName.value;
	var eventTitleField = document.getElementById("event_title");
	var orgField=document.getElementById("orgName");
	var orgName=orgField.value;
	var fromDateField=document.getElementById("From_date");
	var fromDate=fromDateField.value;
	var eventTitle=eventTitleField.value;
	var reserve_date = document.getElementById("reserve_by").value;
	var recipient = recipientEmail.value;
	
	$.ajax({
			type: 'POST',
			url: "acknowledgemailer.php",
			data: {pubname: pubname, title: eventTitle, fromDate: fromDate, reserve_date: reserve_date, recipient: recipient}
		})
		.done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			
			// Set the message text.
			$('#form-messages').text(response);
	
		})
		.fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			

			// Set the message text.
			if (data.responseText !== '') {
				$("#form-messages").text(data.responseText);
			} else {
				$("#form-messages").text('Oops! An error occured and your message could not be sent.');
			}
		});
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function saveIsp(){
var thisIsp=document.getElementById('sourceg');
alert("Isp to save is " + thisIsp.value);

}


 
//===========================================================================================
function regxMicrosoft(obj)
{

if (obj=='activity')
{
testString = document.formInput.activity.value;
}
if (obj=='media')
{
testString = document.formInput.media.value;
}

testString=testString.replace(/’/g,"'");
testString=testString.replace(/–/g,"--");
testString=testString.replace(/•/g,"*");
testString=testString.replace(/“/g,'"');
testString=testString.replace(/”/g,'"');
testString=testString.replace(/\\/g,'');
testString=testString.replace(/�/g,"'");
testString=testString.replace('...' , "---");
testString=testString.replace('Arrive Early...' , "Arrive Early---");
testString=testString.replace('Come Late...' , "Come Late---");
testString=testString.replace('Great...' , "Great---");
testString=testString.replace('Âs' , "'s");
testString=testString.replace('Â' , "'");
testString=testString.replace('ï¿½s',"'s");
testString=testString.replace("&#39;","'");
testString=testString.replace("&#151;","&#150;");
if (obj=='activity')
{
 document.formInput.activity.value = testString;
}
if (obj=='media')
{
 document.formInput.media.value = testString;
}
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
function copyTitle(){
//alert("at copyTitle");
document.formInput.activity.value= document.formInput.event_title.value;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function UseDefault()
{
document.formInput.place.value = document.formInput.defaultLocation.value;
}//===================================================================================================
function UseSubmitted()
{
document.formInput.place.value = document.formInput.submittedLocation.value;
}
//====================================================================================================	
function UseFound()
{
var str=document.formInput.geocomplete.value;
var n=str.search(",");

var place_work = str.substring(0,n);

place_work = place_work + ". " + document.formInput.formatted_address.value;
n=place_work.search("MI,");
place_work=place_work.substring(0,n+2) + ".";
var lenPlace_work = place_work.length;
//alert("length of work place" + lenPlace_work);
var lenAvailable = 100 - lenPlace_work;
//alert("lenAvailable " +lenAvailable);

var website = document.formInput.website.value;
//alert("length of website " + website.length);
if(website.length > 0 && website.length < lenAvailable){
place_work += " website is " + website;
}
document.formInput.place.value = place_work;
}
//==============================================================================
function CallForDirections()
{
 document.formInput.place.value="Call for Directions";
}
//==========================================================================================	
function CopyStart()
{
document.formInput.date_to.value = document.formInput.From_date.value;
var str=document.formInput.reserve_by.value;
if(str.charAt(0)=='A')
{
document.formInput.reserve_by.value = document.formInput.From_date.value;
}
}
//================================================================================================	
function UCWords(str){
  var arrStr = str.split(" ");
  var strOut = "";
  var i = 0;
  while (i < arrStr.length) {
     firstChar  = arrStr[i].substring(0,1);
     remainChar = arrStr[i].substring(1);
     firstChar  = firstChar.toUpperCase();
     remainChar = remainChar.toLowerCase();
     strOut += firstChar + remainChar + ' ';
     i++;
  }
  return strOut.substr(0,strOut.length - 1);
}

//========================================================================================================	
function processCAC()
{
var titleWork = document.formInput.event_title.value.toLowerCase();
//alert ("lowercase title is " + titleWork);
document.formInput.event_title.value= UCWords(titleWork);
document.formInput.date_to.value = document.formInput.From_date.value;

}
//=============================================================================================
function processWheelhouse()
{
	//alert("Default location is  " + document.formInput.defaultLocation.value);
	var titleLength = document.formInput.event_title.value.length;
	//alert("title length is " + titleLength);


	document.formInput.place.value = document.formInput.defaultLocation.value;

	if(document.formInput.activity.value.length < 2)
	{
	document.formInput.activity.value= document.formInput.event_title.value;
	document.formInput.time_start.value = document.formInput.event_title.value.substring(titleLength-4);
	document.formInput.time_end.value=' ';
	}
	if(document.formInput.media.value.length <2)
	{
	document.formInput.media.value= document.formInput.event_title.value;
	}

	document.formInput.date_to.value = document.formInput.From_date.value;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
function checkForm(form)
{
//alert('at checkform');
if(document.formInput.Org.selectedIndex ==0)
	{
	alert ('Organization must be selected');

	document.formInput.Org.focus();
	return false
	}
if(document.formInput.Dow.value  == '')
	{
	alert ('Day of week not selected')
	document.formInput.Dow.focus()
	return false
	}
if(document.formInput.place.value.charAt(0) == ".")
	{
	alert('place is not correct')
	document.form.place.focus()
	return false
	}
return true;
}
//===================================================================================	
function clearLast()
{
var fileToClear = 'http://www.graypluswhite.com' + document.getElementById('fileToRead').value

	alert('file to clear is ' + fileToClear)
	unlink(fileToClear)
}
//===========================================================================================	
 function RemoveFile()
   {
     var fileToClear = 'http://www.graypluswhite.com' + document.getElementById('fileToRead').value
	 IntraLaunch.DeleteFile (fileToClear);

     // Check if gone
     var bDoesExist;
     bDoesExist = IntraLaunch.DoesFileExist(fileToClear);

     if (bDoesExist == "False")
     { alert ('File successfully remove'); }
     else
     { alert ('File could not be removed'); }
   }



</script>

<script type="text/javascript" >
   $(document).ready(function() {
      $(".markItUp").markItUp(mySettings);
   });
   
    $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
      });
</script>

<link rel="stylesheet" type="text/css" href="../markitup/markitup/skins/markitup/style.css" />
<link rel="stylesheet" type="text/css" href="../markitup/markitup/sets/html/style.css" />
 <style type="text/css" media="screen">
      .map_canvas { float: left; }
      form { width: 300px; float: left; }
      fieldset { width: 320px; margin-top: 20px}
      fieldset label { display: block; margin: 0.5em 0 0em; }
      fieldset input { width: 95%; }
    </style>
</head>

<body>
<div class="map_canvas"></div>
`<form onSubmit="return checkForm()" id="formInput" name="formInput"  method="post" action="event_handle.php">
<input type="hidden" name="action" id="action" value="addremote" />
<input type="hidden" name="operator" id="operator" value="admin" />
<input type="hidden" name="fileToRead" id="fileToRead" value="<? echo $file_to_read ?>"/>
    <table width="100%" border="1">
  	<tr>
      <td width="199">Source </td>
      <td width="323"><input name="sourceg" type="text" id="sourceg" value="<? echo $refferSrc ?>" size="30" />
      <input name="deletbtn" type="button" id="deletbtn"  ondblclick="saveIsp()" value="Save ISP" o /></td>
  	</tr>
	<tr>
      <td width="199">Entry type </td>
      <td width="323"><input name="entryType" type="text" id="entryType" value="<? echo $entryType ?>" size="30" />    </td>
  	</tr>

    <tr>
      <td width="199">Submitted By: </td>
      <td width="323"><input name="subName" type="text" id="subName" value="<? echo $subName ?>" size="80" /></td>
    </tr>
    <tr>
      <td>Email Address: </td>
      <td><input name="emailid" type="text" id="emailid" value="<? echo $xml->subEmail ?>" size="80" /></td>
    </tr>
    <tr>
      <td>Phone:</td>
      <td><input name="phone" type="text"	id="phone" value="<? echo $xml->phone ?>" size="40" /></td>
    </tr>
    <tr>
      <td>Organization:</td>
      <td><input name="orgName" type="text" id="orgName" value="<? echo $xml->orgName?>" size="80" /></td>
    </tr>
	<tr>
	<?PHP require_once($_SERVER['DOCUMENT_ROOT'] . "/newsletter/orgList.inc")?>
	</tr>

    <tr>
      <td>Event Title: </td>
      <td><input name="event_title" type="text" id="event_title" value="<? echo $xml->title?>" size="80" /></td>
    </tr>
    <tr>
      <td>Start Date: </td>
      <td><input name="From_date" type="text" id="From_date" value="<? echo $From_date?>" size="24" /></td>
    </tr>
    <tr>
      <td>Start Time: </td>
      <td><input name="time_start" id="time_start" type="text" value="<? echo $timeStartConv ?>" /></td>
    </tr>
    <tr>
      <td>End Date: </td>
      <td><input name="date_to" id="date_to" type="text" value="<? echo $date_to?>" />
      <input name="copyStart" type="button" id="copyStart" value="Copy Start" onClick="CopyStart()" />      </td>
    </tr>
    <tr>
      <td>End Time: </td>
      <td><input name="time_end" id="time_end" type="text" value="<? echo $timeEndConv?>" /></td>
    </tr>
    <tr>
      <td>Reserve By Date: </td>
      <td><input name="reserve_by" id="reserve_by" type="text" value="<? echo $reserve_by?>" /></td>
    </tr>
    <tr>
      <td>Day Of Week</td>

      <td><input name="Day_of_week" type="text" id="Day_of_week" value="<? echo  $thisDayOfWeek?>" />
	  Edited Day of Week <input name="dow" type="text" id="dow" size="4" />	  </td>
    </tr>
	  <tr>
    <td>Place Name: </td>
      <td><input name="geocomplete"; type="text" id="geocomplete" value="<? echo $xml->place_name?>" size="80" />
	  <input id="find" type="button" value="find" /></td>
    </tr>
	<tr><td>
	Found Location</td><td>
        <input name="formatted_address" type="text" size="150" value=""></td>
		</tr>
    <tr>
      <td>Place Address: </td>
      <td><input name="place_address" id="place_address" type="text" value="<? echo $xml->place_address?>" /></td>
    </tr>
    <tr>
      <td>Place City: </td>
      <td><input name="city" id="city" type="text" value="<? echo $xml->city?>" /></td>
    </tr>
    <tr>
      <td>Place State </td>
      <td><input name="state" type="text" id="state" size="4" /></td>
    </tr>
    <tr>
      <td>Place Zip </td>
      <td><input name="zip" id="zip" type="zip" value="<? echo $xml->zip?>" /></td>
    </tr>
    <tr>
      <td>Place URL: </td>
      <td><input name="url" type="text" id="url" value="<? echo $xml->place_url?>" size="80" /></td>
    </tr>
    <tr>
      <td>Place Email </td>
      <td><input name="place_email" type="text" id="place_email" value="<? echo $xml->place_email?>" size="50" /></td>
    </tr>
	<tr>
      <td>Place Website </td>
      <td><input name="website" type="text" id="website" value="" size="80" /></td>
    </tr>
    <tr>
      <td>Place Phone: </td>
      <td><input name="place_phone" type="text" id="place_phone" value="<? echo $xml->place_phone?>" size="50" /></td>
    </tr>
	<tr>
	  <td>Additional Directions </td>
	  <td><input name="directions" type="text" id="directions" size="80" /></td>
    </tr>
	<tr>
<td>Submitted location</td>
<td>

 <input name="submittedLocation" type="text" id="submittedLocation" value="<? echo $xml->where?>" size="80" /></td>
</tr>
	
	<tr>
	  <td>Default Location </td>
	  <td><input name="defaultLocation" type="text" id="defaultLocation" size="100"  value="<? echo $xml->defaultLocation ?>"/></td>
    </tr>
	<tr>
	<td>Place work</td>

	<td><input name="place_name2" type="text" class="formInputText" id="place_name2" onDblClick="clearPlace()" onKeyUp="typeAhead(document.getElementById(this.id))"   size="40" />
	  <input name="place_number"  type="text" id="place_number" value="0">
    <div id="results" class="popUp"> </div>

    <input name="maintain_button" type="button" id="maintain_button" value="Add"  onClick="maintain_places()" /></td>
	</tr>
	<tr>
	<tr>
	  <td>Gdata Where </td>
	  <td><input name="callForDir" type="button" id="callForDir" value="Call for Directions" onClick="CallForDirections()" />
      
      <input name="useDefault" type="button" id="useDefault" value="Use Default" onClick="UseDefault()" />
	  <input name="useSubmitted" type="button" id="useSubmitted" value="Use Submitted" onClick="UseSubmitted()"/>
	  <input name="useFound" type="button" id="useFound" value="Use Found" onClick="UseFound()"/></td>
    </tr>
	  <td>Gdata When </td>
	  <td><input name="when" type="text" id="when" value="<? echo $xml->when ?>" size="50" /></td>
    </tr>
	<tr>
      <td>Place Full </td>
      <td><textarea name="place" cols="80" rows="3" id="place"><? echo $place_full?></textarea></td>
    </tr>
    <tr>
      <td>Activity:</td>
      <td><textarea name="activity" class="markItUp" cols="80" rows="3" id="activity">
	  <? echo nl2br(htmlentities($xml->activity))?></textarea>
      <input name="Edit" type="button" id="Edit" value="Edit" onClick="regxMicrosoft('activity')" />
      <input type="button" name="Submit2" value="Copy Title" onClick="copyTitle()" /></td>
    </tr>
    <tr>
      <td>Media:</td>
      <td><textarea name="media" class="markItUp" cols="80" rows="5" id="media">
	  <? echo nl2br(htmlentities($xml->comments))?></textarea>
      <input name="edMedia" type="button" id="edMedia" value="Edit" onClick="regxMicrosoft('media')" /></td>
    </tr>
    <tr>
      <td>Price Members </td>
      <td><input name="Price_Member" id="Price_Member" type="text" value="<? echo $xml->price_member?>" /></td>
    </tr>
    <tr>
      <td>Price Guests </td>
      <td><input name="Non_Member_Price" type="text" id="Non_Member_Price" value="<? echo $xml->price_guest?>" /></td>
    </tr>

  <tr>
      <td>Priority </td>
      <td><input name="Event_priority" type="text" id="Event_priority" value="7" size="3" /></td>
    </tr>
  <tr>
      <td>Open Event </td>
      <td><input name="Event_type" type="text" id="Event_type" value="Y" size="3" /></td>
    </tr>
	<tr>
      <td>Confirm Code </td>
      <td><input name="confirm" type="text" id="confirm" value="Y" size="3" />
      G = golf T= Trip R=reunion </td>
    </tr>
	<tr>
	  <td>Recurring</td>
	  <td><input name="recurring" type="text" value="<? echo $xml->recurring ?>" /></td>
    </tr>
	<tr>
	  <td>Recur Begin</td>
	  <td><input name="recurbegin" type="text" value="<? echo $xml->recurbegin ?>" /></td>
    </tr>
	<tr>
	  <td>Recur End</td>
	  <td><input name="recurend" type="text" value="<? echo $xml->recurend ?>" /></td>
    </tr>
	<tr>
      <td>Recurring Comments:</td>
      <?php
		$recurComments = $xml->recurring . "<br> Starting on ". $xml->recurbegin . " and ending on ". $xml->recurend;
		?>
	
      <td><textarea name="recurComments" cols="80" class="markItUp" rows="3" id="recurComments"><? $recurComments?></textarea>
      <input name="Edit" type="button" id="Edit" value="Edit" onClick="regxMicrosoft('recurComments')" />    </tr>
	<tr>
	  <td>Password</td>
	  <td><input type="password" name="password"></td>    
	  </tr>
      <tr align="center">
      <td colspan="2"><div id="form-messages">Email response will be here</div></td>
      </tr>
	<tr align="center">
	<td colspan="2"><input name="Submit" type="submit" value="Submit"  />
    <input type="button" value="Acknowledge" onClick="acknowledge()" />
	  <a href=manageRemote.php><input name="btnClear" type="button" id="btnClear" value="Clear" /></a></td></tr>

</form>
<table><tr><td>
<FORM name="isn">
Convert to lowercase
<INPUT TYPE="text" NAME="caps" SIZE=40 VALUE="">
<INPUT TYPE="button" NAME="html1" VALUE=" convert " onClick="capsLc()">
<input name="WheelHouse" type="button" id="WheelHouse" value="WheelHouse" onClick="processWheelhouse()" />
<input name="CAC" type="button" id="CAC" value="CAC" onClick="processCAC()" />
</FORM>
</tr></td>
</table>

</body>

</html>
