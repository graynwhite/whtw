<?php
mb_http_input("utf-8");
mb_http_output("utf-8");
?>
<?
$select_org= $_GET['select_org'];
$operator= $_GET['operator'];
$confirm = $_GET['confirm'];
$dbg = $_GET['dbg'];
require_once("../cgi-bin/connect.inc");
require_once($_SERVER['DOCUMENT_ROOT'] ."/phpClasses/Class_publicist.php");
require_once($_SERVER['DOCUMENT_ROOT'] ."/phpClasses/Class_evententry.php");
$pub = new publicist;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="../javascript/ajaxBasics.js" type="text/javascript"></script>
<script src="../javascript/typeAhead.js" type="text/javascript"></script>
<link href="../javascript/pressReleaseControl.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#pagecontainer {
	width: 750px;
	height: 1020px;
	background-color: #CCCCCC;
}
#events {
	float: left;
	width: 350px;
	top: 155px;
	height: 750px;
}
#maint {
	float: right;
	height: 750px;
	width: 355px;
	left: 355px;
	top: 150px;
}

.popUpPub {
	position:absolute;
	font-size: .9em;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	background-color: #fff;
	display: none;
		left: 5px;
		top: 950px;
		padding: 8px;
	width: 500px;
	opacity: .8;
	border: solid 1px black
}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Publicist Event Maintenance</title>
</head>

<body onload="load_progressbar('http://www.peggyjostudio.net/E/rotatingArrows.gif')" >
<div  id="pagecontainer">
  <center>
    <img src="../gwlogo.jpg" height="100" />
  </center>
  <h1>Organization Publicist Event Maintenance</h1>
  <div id="events">
    <h2>Your Active Events: </h2>
    <h3>Select an event from below by highligting it and then double clicking the  &quot;Get Event&quot; button.</h3>
    <p>
      <select name="ActiveEvents" id="ActiveEvents" size="10" >
        <?php
  $pub= new publicist;
  $result = $pub->get_active_events($select_org);
  while($row=mysql_fetch_array($result))
  	{
	echo "<option value=". $row['Event_number'] . ">" . $row['Event_title'] . " " . $row['Date_from'] . "</option> \n";
	}
  ?>
      </select>
    </p>
    <input name="GetEvent" type="button" id="GetEvent" value="Get Event"  ondblclick="GetAnEvent()"/>
    
	<br />
    <p>
      <input name="pubResults" type="hidden" id="pubResults" " />
    </p>
    <p>
    <div id="pubfeedback" class="popUpPub"> </div>
    </p>
  </div>
  <!-- End of Events -->
  <div id="maint">
    <h2>Maintain:</h2>
	
    <table width="100%" border="2" id="maintTable">
      <tr>
        <td colspan="2"> Title
          <input name="Event_title" type="text" id="Event_title" size="50" maxlength="50" />
		  <input id="selected_org"  type="hidden" value="<?=$select_org?>" /></td>
      </tr>
      <tr>
        <td width="49%">Date From
          <input name="Date_from" type="text" id="Date_from" size="12" /></td>
        <td width="51%">Date To:
          <input name="Date_to" type="text" id="Date_to" size="12" /></td>
      </tr>
      <tr>
        <td> Reserve By:
          <input name="Resby" type="text" id="Resby" size="12" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Start Time:
          <input name="Time_start" type="text" id="Time_start" size="12" /></td>
        <td>To Time:
          <input name="Time_end" type="text" id="Time_end" size="12" /></td>
      </tr>
      <tr>
        <td> Day of week
          <input name="Dow" type="text" id="Dow" size="6" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Member Price
          <input name="Price_members" type="text" id="Price_members" size="8" /></td>
        <td>Guest Price
          <input name="Price_guests" type="text" id="Price_guests" size="8" /></td>
      </tr>
      <tr>
        <td>Open to the Public
          <input name="Event_open" type="text" id="Event_open" size="3" maxlength="3" /></td>
        <td>Priority
          <input name="Event_priority" type="text" id="Event_priority" size="3" /></td>
      </tr>
      <tr>
        <td colspan="2">Place:
          <textarea name="Place" cols="50" rows="5" id="Place"></textarea></td>
      </tr>
      <tr>
        <td colspan="2">Event
          <textarea name="Activity" cols="50" rows="5" id="Activity"></textarea></td>
      </tr>
      <tr>
        <td height="158" colspan="2">Media
          <textarea name="mediatext" cols="50" rows="5" id="mediatext"></textarea></td>
      </tr>
      <tr>
        <td height="48" colspan="2"><input name="Event_number" type="hidden" id="Event_number" value="" /></td>
      </tr>
    </table>
    <h3>After making the changes to the fields above double click on the &quot;update&quot; button
      <input type="button" value="update"  ondblclick="pubUpdate()"  />
    </h3>
    <p><strong>Return to Add a record screen</strong>
      <input name="returnToAdd" type="button" id="returnToAdd" value="OK" onclick="returnToAdd()" />
    </p>
  </div>
  <!--End of maintenance div-->
  <div id="getEventProgress">
  
  </div>
  
</div>
<!--End of Page container-->
</body>
</html>
