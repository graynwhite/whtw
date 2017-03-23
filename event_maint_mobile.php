<?php
/** @package

        event_maint.php

        Copyright()Gray and White Computing 2004

        Author: FRANK J CAULEY
        Created: FJC 10/15/2004 10:45:06 AM
	Last change: FJC 10/23/2005 4:25:05 PM
*/
$action=$_GET['action'];
$Event_number=$_GET['Event_number'];
  include("../cgi-bin/connect.inc");
  require_once($_SERVER['DOCUMENT_ROOT'].'/phpClasses/dateClass.php');
/*=================================================================================================*/
  if ($action == "byitem"){
        $sql = " Select * from events where Event_number = \"$Event_number\"";
        $result = @mysql_query($sql);
         if(!$result){
                echo("<p>Could not execute query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
        exit();
         }
  } // end select by item number

//=============================================

  if ($action == "byorgbydate" ) {
  $from_date = $From_year  . $From_mm .  $From_day ;

  $sql = " SELECT * from events where Event_org = \"$Org\" and
           Date_from = \"$from_date\"";
    $result =  @mysql_query($sql);
    if (!$result) {
     echo("<p> Could not execute query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
     exit();
    }
}# end of select by org and date

if ( $action=="copy" ) {
    print("<p> copy operation</>");
    $from_date = $From_year  . $From_mm .  $From_day ;

  $sql = " SELECT * from events where Event_org = \"$Org\" and
           Date_from = \"$from_date\"";
    $result =  @mysql_query($sql);
    if (!$result) {
     echo("<p> Could not execute query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
     exit();
    }
    $row=mysql_fetch_array($result);

    $SQL = "
            insert into events
           SET Place = \"$row[8]\",
           Event_org = \"$row[2]\",
           Time_start = \"$row[3]\",
           Time_end = \"$row[4]\",
           Dow = \"$row[7]\",
           Activity=\"$row[9]\",
           Price_members = \"$row[10]\",
           Price_guests = \"$row[11]\",
           Event_open = \"$row[12]\",
           Event_priority = \"$row[13]\",
           SUBMITTED_BY = \"$row[14]\",
		   confirm = \$confirm\"
           ";

    print("<p>$SQL</>");
    $result =  @mysql_query($SQL);
    if (!$result) {
     echo("<p> Could not execute query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
     exit();
    }
    $sql= "select Max(Event_number) from events";
	 	$result = @mysql_query($sql);
                if (!$result) {
	 		echo("<p> The maximum event number was not found Email this information to cauleyfrank@gmail.com" . mysql_error() . " </p>");
	 		exit;
	 		}
    $sql = "Select * from events where Event_number = \"$event_number\"";
    $result = @mysql_query($sql);
        if (!$result) {
	 		echo("<p> Event number not found Email this information to cauleyfrank@gmail.com" . mysql_error() . " </p>");
	 		exit;
	 		}
 }# end of copy operation
/*=================================================================================================*/
if ( $action == "browse" ){
    $sql = " SELECT * from events  where Event_org = \"$Org\"
             order by Date_from,  Time_start";
    $result = @mysql_query($sql);
    if ( !$result ){
        echo("<p> Could not execute query Email this information to cauleyfrank@gmail.com". mysql_error() . "</p>");
        exit();
    }
    while ( $row= mysql_fetch_array($result) ){
    echo("$row[Event_number]  $row[Date_from] $row[Place] $row[Activity]<p>\n");
    }
      exit();
    }# end of browse by organization

    if(mysql_num_rows($result) < 1){
        echo("<p> No events found for $Org on $from_date " . mysql_error() . "</p>");
     exit();
    }



?>
<html>


<head>

<title>Event Maintenance</title>
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	
	
	<link rel="stylesheet" href="mobile.css"/>
	
		
		
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		
	<!--<script type="text/javascript" src="../markitup/markitup/jquery.js"></script>-->
	<script type="text/javascript" src="../markitup/markitup/jquery.markitup.js"></script>
	<script type="text/javascript" src="../markitup/markitup/sets/html/set.js"></script>
<link rel="stylesheet" type="text/css" href="../markitup/markitup/skins/markitup/style.css" />
<link rel="stylesheet" type="text/css" href="../markitup/markitup/sets/html/style.css" />	
	<script language=javascript>
function getSelText()
{
    var txt = '';
     if (window.getSelection)
    {
        txt = window.getSelection();
             }
    else if (document.getSelection)
    {
        txt = document.getSelection();
            }
    else if (document.selection)
    {
        txt = document.selection.createRange().text;
            }
    else return;
document.aform.selectedtext.value =  txt;
}
</script>

<script language="javascript">
$(document).ready(function(){
	$("#venue").dblclick(function() {
		var current_venue = $("#venue").val();
		var ans= confirm("the current value of venue is " + current_venue + " Do you want to look up the Address? ");
		if(ans==true){
			//$.post("getAddress.php",{current_venue: current_venue), function(data){
			alert("We will look up this address " + current_venue)
			}
	 });
 });

    function golf(){
        var activity= document.getElementById("activity");
        document.inputForm.media.value=activity.value;
        document.inputForm.confirm.value="G";
    }
	    function somer(){
        var activity= document.getElementById("activity");
        document.inputForm.media.value=activity.value;
        document.inputForm.confirm.value="Y";
    }
	function copyactivity(){
        var activity= document.getElementById("activity");
		var mediaHold = document.getElementById("media");
		activity.value += mediaHold.value;
		document.inputForm.media.value=activity.value;
        document.inputForm.confirm.value="Y";
    }
function insertImage()
{
var testString = '';
var filename = document.getElementById("eventCode");
var obj = document.getElementById("media");
alert(filename.value);
alert(obj.value);

testString = "<table><tr><td>\n<img src=\"http://www.peggyjostudio.net/emporium/_file_uploads_whtw/" + filename.value;
testString += "\"  align=\"left\" hspace=\"5\"height=\"100\" alt=\"icon\"/>\n";
testString += obj.value;
testString +="</tr></td></table>";

document.inputForm.media.value=testString;
}

function regxMicrosoft(obj)
{
testString = obj.value;

testString=testString.replace(/â€™/g,"'");
testString=testString.replace(/â€“/g,"--");
testString=testString.replace(/â€¢/g,"*");
testString=testString.replace(/â€œ/g,'"');
testString=testString.replace(/â€/g,'"');
testString=testString.replace(/\\/g,'');
testString=testString.replace(/â€/g,"'");
testString=testString.replace(/â€¢/g,"-");
testString=testString.replace(/\.\.\./,"---");
//excerpted from replaceWordCharacters.js 
 // smart single quotes and apostrophe
    testString = testString.replace(/[\u2018|\u2019|\u201A]/g, "\'");
    // smart double quotes
    testString = testString.replace(/[\u201C|\u201D|\u201E]/g, "\"");
    // ellipsis
    testString = testString.replace(/\u2026/g, "---"); //changed to dashes for constant contact originall thre dots
    // dashes
    testString = testString.replace(/[\u2013|\u2014]/g, "-");
    // circumflex
    testString = testString.replace(/\u02C6/g, "^");
    // open angle bracket
    testString = testString.replace(/\u2039/g, "<");
    // close angle bracket
    testString = testString.replace(/\u203A/g, ">");
    // spaces
    testString = testString.replace(/[\u02DC|\u00A0]/g, " ");
obj.value=testString;
}

function UCWords(str){
  strwork= str.value;
  var arrStr = strwork.split(" ");
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
  strOut =strOut.substr(0,strOut.length - 1);
  str.value=strOut;
}
</script>
<script type="text/javascript" >
   $(document).ready(function() {
      $(".markItUp").markItUp(mySettings);
   });

</script>

</head>
<body>
<p><font size="7"><b>Event Maintenance</b></font></p>
<hr>
<form action="http://www.graypluswhite.com/whtw/event_handle.php" method="post" name="inputForm" id="inputForm">
<input type="hidden" name="operator" id="operator" value="Admin">

  <p>
    <?PHP
 while ($row = mysql_fetch_array($result)){

 echo ("<input type=\"hidden\" name=\"event\" id=\"event\" value= \"$row[Event_number]\"><br>");
 echo("Organization Code <input type=\"text\" name=\"Event_org\" size = \"5\" value= \"$row[Event_org]\"><br>\n");
 echo("Event Title <input type=\"text\" name=\"event_title\" size = \"50\" value= \"$row[Event_title]\"><br>\n");
 echo("Event Identification <input type=\"text\" name=\"event_id\" size=\"3\" value = \"$row[Event_number]\"><br>\n");
 echo("Start date  <input type =\"text\" name = \"date_from\" size = \"12\" value = \"$row[Date_from]\"><br>\n");
 $recurbeginval=$row[Date_from];
 $copyToDateVal = $row[Date_from];
 $dchange = new entryControlDate;
 $recurbegincalc = $dchange->bumpDate($recurbeginval);
 $recurbeginval = $recurbegincalc[0];

 echo("End Date  <input type = \"text\" name = \"date_to\" size = \"12 \" value = \"$row[Date_to]\"><br>\n");
echo("Reserve Date  <input type = \"text\" name = \"resby\" size = \"12 \" value = \"$row[Resby]\"><br>\n");
echo("Start Time <input type = \"text\" name = \"time_start\" size = \"10\" value =\"$row[Time_start]\"><br>\n");
echo("End Time  <input type = \"text\" name = \"end_time\" size = \"10 \" value = \"$row[Time_end]\"><br>\n");
echo("Day of Week  <input type = \"text\" name = \"dow\" size = \"3\" value = \"$row[Dow]\"><br>\n");
echo("Event Open ? <input type = \"text\" name = \"event_open\" size = \"1\" value =\"$row[Event_open]\"><br>\n");
echo("Place<br> <textarea wrap cols = \"64\" rows = \"4\" name = \"place\" id=\"venue\" >$row[Place]</textarea><br>\n");
echo("Activity<br> <textarea class=\"markItUp\" style=\"width:100%;\" name = \"activity\" id=\"activity\" cols=\"64\" rows=\"4\" >$row[Activity]</textarea><br>\n");
echo("<input type=\"button\" id=\"editact\" value=\"Edit Activity\" onclick=\"regxMicrosoft(activity)\">");

//echo("<input type=\"button\" id=\"instab\" value=\"Insert Table\" onclick=\"insertTable(activity)\">");
echo("<input type=\"button\" id=\"isgolf\" value=\"Make it a Golf Activity\" onclick=\"golf()\">");
echo("<input type=\"button\" id=\"issomer\" value=\"Make it a Somerset Activity\" onclick=\"somer()\">");
echo("<input type=\"button\" id=\"iscopyact\" value=\"Copy Activity to Media\" onclick=\"copyactivity()\">");
echo("<br /><hr />");
echo("<legend>Media text</legend>");
echo("<div data-role=\"fieldcontain\">");
echo("<textarea  class=\"markItUp\" name =\"media\"
stlye=\"width:100%;\" id=\"media\" $row[media]></textarea></div><br>\n");

echo("<input type=\"button\" id=\"editmed\" value=\"Edit Media\" onclick=\"regxMicrosoft(media)\">");
echo("<input type=\"button\" id=\"editpar\" value=\"Highlight a Paragraph\" onclick=\"regxMicrosoft(media)\">");
echo("<br /><hr />");
echo("Price Members  <input type = \"text\" name = \"price_members\" size = \"20 \" value =\"$row[Price_members]\"><br>\n");
echo("Price Guests  <input type = \"text\" name = \"price_guests\" size = \"20\" value = \"$row[Price_guests]\"><br>");
echo("Priority  <input type = \"text\" name = \"event_priority\" size = \"5\" value =\"$row[Event_priority]\"><br>\n");
echo("Submitted by  <input type = \"text\" name = \"submitted_by\" id = \"submitted_by\" size = \"40 \" value =\"$row[SUBMITTED_BY]\"><br>\n");
echo("Confirm <input type = \"text\" name=\"confirm\" size = \"1\" value = \"$row[confirm]\"><br />\n");
echo("Needs Review <input type = \"text\" name=\"needsReview\" size = \"5\" value = \"$row[needsReview]\"><br />\n");
}
?>
  <fieldset data-role="controlgroup" data-type="horizontal">
    	<legend>Action</legend>
    
  <input type = "radio" name ="action" id="radio_change" value="change" checked>
    <label for="radio_change">Change</label>
    <input type ="radio" name = "action" id="radio_delete"value="delete" >
    <label for="radio_delete">Delete</label>
    <input type ="radio" name ="action" id="radio_copy" value="copy" >
    <label for="radio_copy">Copy to another date</label>
	
   	value
    <input name="copyToDate" type="text" id="copyToDate" value="<?print $copyToDateVal?>" size="12" maxlength="12">
    
    <input name="action" type="radio" id="radio_copyhence" value="copyHence">
    
    <label for="radio_copyhence">Days hence</label>
	<label for="bumpDays">Number of days</label>
    <input name="bumpDays" type="text" id="bumpDays" size="5" maxlength="5">
	</fieldset>
   <fieldset data-role="controlgroup" data-type="horizontal">
    <input name="action" type="radio"  id="radio_genprod" value="genprod">
    <label for="radio_genprod"> Generate Product  Percent</label>
	<label for="discount_percent">Discount Percent"</label>
    <input name="discount_percent" type="text" id="discount_percent" size="6" maxlength="6">
	
   <label for="inventory">Inventory Code</label>
    <input name="inventory" type="text" id="inventory" size="5" maxlength="5">
	
    <label for="subcategory">Sub Category</label>
    <input name="subcategory" type="text" id="subcategory" size="10" maxlength="10">
	
   
  <input name="action" type="radio" id="radio_samedatenextyear" value="sameDateNextYear">
  <label for="radio_samedatenextyear">Generate this event for the Same Date Next Year</label>
  

  <input name="action" type="radio" value="sameExactDateNextYear" id="radio_sameexact">
  <label for="radio_sameexact">Generate for the Same Exact Date Next Year</label>
  <input name="action" type="radio" value="deleteOld" id="radio_deleteOld">
  <label for="radio_deleteOld">Delete Old</label>
  <input name="action" type="radio" value="clearOrg" id="radio_clearOrg">
	<label for="radio_clearOrg">Clear Organization (confirmed only)</label>
    <input name="action" type="radio" value="makeLower" id="radio_makelower">
	<label for="radio_makelower">Make lower Case</label>

     <input name="action" type="radio" value="deleteAfterDate" id="radio_deleteAfterDate">
  	<label for="radio_deleteAfterDate">Delete after date</label>
   <input name="action" type="radio" value="deleteAfterNumber" id="radio_deleteAfterNumber">
  	<label for="radio_deleteAfterNumber">Delete after Event Number</label>
      <input name="action" type="radio" value="deleteByPhraseTest" id="radio_deleteByPhraseTest">
    <label for="radio_deleteByPhraseTest">Delete by phrase-test</label>
    <input name="action" type="radio" value="deleteByPhraseActual" id="radio_deleteByPhraseActual">
    <label for="radio_deleteByPhraseActual">Delete by phrase-actual</label>
  <input name="action" type="radio" value="updateByPhraseTest" id="radio_updateByPhraseTest">
    <label for="radio_updateByPhraseTest">Update by phrase Test</label>
    
  <input name="action" type="radio" value="updateByPhraseActual" id="radio_updateByPhraseActual">
    <label for="radio_updateByPhraseActual">Update by phrase actual</label>
    
    <input name="action" type="radio" value="memberPrice" id="radio_memberPrice">
    <label for="radio_memberPrice">Change Member Price</label>
    <input name="action" type="radio" value="guestPrice" id="radio_guestPrice">
    <label for="radio_guestPrice">Change Guest Price</label>
	 <label for="newPrice">New Price</label>
    <input name="newPrice" type="text" id="newPrice" size="7" maxlength="7">
	
    <input name="action" type="radio" value="changeTitle" id="radiobutton">
    <label for="radiobutton">Change Title</label>
    <br>
    <input name="action" type="radio" value="changeTimeStart" id="radio_changeTimeStart">
    <label for="radio_changeTimeStart">Change Start Time</label>
    <input name="action" type="radio" value="changeTimeEnd" id="radio_changeTimeEnd">
    <label for="radio_changeTimeEnd">Change End Time</label>
    <input name="action" type="radio" value="changeTimeReserve" id="radio_changeTimeReserve">
    <label for="radio_changeTimeReserve">Change Reserve By Time</label>
	<label for="newtime">New Time</label>
	    <input name="newTime" type="text" id="newTime" size="8" maxlength="8">
	
    
    <input name="action" type="radio" value="referBack" id="radio_referBack">
    <label for="radio_referBack">Refer Back</label>
    <input name="action" type="radio" value="changeDOW" id="radio_changeDOW">
    <label for="radio_changeDOW">Change day of Week from</label>
	<label for="oldDOW">Change from </label>
    <input name="oldDOW" type="text" id="oldDOW" size="4" maxlength="3">
	
    <label for="radio_newDOW"> Change to</label>
    <input name="newDOW" type="text" id="newDOW" size="4" maxlength="3" >
    
   <label for="actionPhrase">Action Phrase</label>
    <input name="actionPhrase" type="text" id="actionPhrase" size="40" maxlength="40">
	
	<fieldset data-role="controlgroup" data-type="horizontal">
    	<legend>Location of action Phrase</legend>
    
    <input name="phraseLocation" type="radio" value="Place" checked id="radio_phrasePlace">
    <label for="radio_phrasePlace">Phrase in Place</label>
	
    <input name="phraseLocation" type="radio" value="activity" id="phraseActivity" >
	<label for="phraseActivity">Phrase in Activity</label>
    
    <input name="phraseLocation"type="radio" value="media" id="phraseMedia">
	<label for="phraseMedia">Phrase in Media</label>
  </fieldset>>
  <p>
    <label for="eventCode">Event Code for Image </label>
    <input type="text" name="eventCode" id="eventCode" >
    <input type="button" name="Submit" value="Insert Image" onClick="insertImage()">
  </p>
  <p>
    
<input name="action" type="radio" value="blogit" id="radio_blogit">
<label for="radio_blogit">Blog_it</label>
    <label>Author
    <input name="blogAuthor" type="text" id="blogAuthor" size="20" maxlength="20">
</label>
    <label>Category(s)
    <input name="blogCategory" type="text" id="blogCategory" size="20" maxlength="60">
    </label>
    <label>Delay
    <input name="blogDelay" type="text" id="blogDelay" size="20" maxlength="20">
    </label>
    <br>
    <label>
<input name="action" type="radio" value="blog_reference">
Blog Reference</label>
    <label>Blog Number
    <input name="blog_number" type="text" id="blog_number" size="8" maxlength="8">
    </label>
    <br>


    <input name="action" type="radio" value="makeRecuring" id="radio_makeRecuring">
    <label for="radio_makeRecuring">Make Recurring</label>
	<fieldset data-role="controlgroup">
    	<legend>Duration of recurrance</legend>
    <input name="duration" type="radio" value="30" id="dur30" >
    <label for="dur30">30 days</label>
    <input name="duration" type="radio" value="60" id="dur60">
    <label for="dur60">60 days</label>
    <input name="duration" type="radio" value="90" id="dur90">
    <label for="dur90">90 days</label>
    <input name="duration" type="radio" value="365" id="dur365">
    <label for="dur365">Year </label>
	</fieldset>
  <table width="100%" height="177" border="1">
  <caption>
    Recurring Event Properties
  </caption>
  <tr>
    <td width="10%">Begin Date </td>
    <td width="40%%">
      <input name="recurbegin" type="text" id="recurbegin" value ="<?print $recurbeginval?>">
    </td>
    <td width="10%">End Date </td>
    <td width="40%">
      <input name="recurend" type="text" id="recurend">
    </td>
  </tr>
  <tr>
    <td>Day of Week </td>
    <td><legend>Day of Week</legend>
      <select name="dowr" size="1">
        <option value="1">Monday</option>
        <option value="2">Tuesday</option>
        <option value="3">Wednesday</option>
        <option value="4">Thursday</option>
        <option value="5">Friday</option>
        <option value="6">Saturday</option>
        <option value="0">Sunday</option>
        </select>
    </td>
    <td>Week of the Month </td>
    <td>
	<fieldset><legend>Select Week(s)</legend>
		<input name="checkSelect[]" type="checkbox" id="checkFirst" value="first">
		<label for = "checkFirst">First</label>
		<input name="checkSelect[]" type="checkbox" id="checkSecond" value="second">
		<label for = "checkSecond">Second</label>
      <input name="checkSelect[]" type="checkbox" id="checkThird" value="third">
      <label for = "checkThird">Third</label>
      <input name="checkSelect[]" type="checkbox" id="checkFourth" value="fourth">
      <label for ="checkFourth">Fourth</label>
      <input name="checkSelect[]" type="checkbox" id="checkFifth" value="fifth">
      <label for= "checkFifth">Fifth</label>
      <input name="checkSelect[]" type="checkbox" id="checkLast" value="last">
      <label for = "checkLast">Last</label>
      <input name="checkSelect[]" type="checkbox" id="checkAlternate" value="alternate">
      <label for = "checkAlternate">Alternate</label>
	 </fieldset>
	  </td>
  </tr>
</table>
</fieldset>	
<p>
	<label for="password">Enter Password</label>
	<input type="password" id="password" name="password">
  <input type ="submit" name= "submit" value="Submit Form">
</p>
</form>
<FORM name="isn">
Convert to first Letter uppercase
<INPUT TYPE="text" NAME="caps" id="caps" SIZE=40 VALUE="">
<INPUT TYPE="button" NAME="html1" VALUE=" convert " onClick="UCWords(caps)">

</FORM>
   
</body>

</html>

