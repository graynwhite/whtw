<?php
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/Class_Ire.php");



$ire = new IREclass;
$header = "Theater type events";
//echo "The header is " . $header;



//$activity = $actInfoArray[1];
//$title = $actInfoArray[0];
//$price_members = $actInfoArray[4];
//$price_guests = $actInfoArray[5];
//$ts= $actInfoArray[2];
//$te = $actInfoArray[3];

//$place = $ire->getSiteInfo("theaterVenues.xml","Royalty House");
//echo "place is " . $place;
//$theaterRadio = $ire->bldVenueRadio("theaterVenues.xml",80);
//echo '<p>Theater venues ' . $theaterRadio . "</p>"; 
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Theater input form</title>
<Script language=Javascript>
<!--  Hide script from older browsers

function check_page(form) {
   // set var radio_choice to false
var radio_choice = false;
var radio_choice2 = false;
// Loop from zero to the one minus the number of radio button selections
for (counter = 0; counter < form.event_type.length; counter++)
{
// If a radio button has been selected it will return true
// (If not it will return false)
if (form.event_type[counter].checked)
radio_choice = true; 
}

if (!radio_choice)
{
// If there were no selections made display an alert box 
alert("Please select an event type.")
return (false);
}
for (counter = 0; counter < form.site.length; counter++)
{
// If a radio button has been selected it will return true
// (If not it will return false)
if (form.site[counter].checked)
radio_choice2 = true; 
}

if (!radio_choice2)
{
// If there were no selections made display an alert box 
alert("Please select an event site.")
return (false);
}



return (true);
    
	
} 
//-->

</script>

<style type="text/css">
<!--
.entryHeader {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-style: italic;
	font-weight: bold;
	color: #0000FF;
}
.style1 {font-size: 24px}
.style2 {color: #000000}
-->
</style>
</head>

<body>
<p align="center"><img src="graynwhitebannereventMaint.jpg" alt="Gray and white logo" width="468" height="60"  align="middle"/></p>
<p class="entryHeader style1"><? echo $header ?> -EVENT ENTRY:</p>
<p>&nbsp;</p>
<form method="POST" action="http://www.graynwhite.com/whtw/theater_entry.php"
	onSubmit="return check_page(this)" name="theater">
  <p>Event or Performance
    <textarea name="activity" cols="120" rows="3" id="activity"></textarea>
</p>
  <p>	
    <?
$siteRadio = $ire->bldVenueRadio("theaterVenues.xml",80);
echo  $siteRadio;
?>
  </p>
  <p>&nbsp;
    </p>
  <p>
<? $fromDate = $ire->bldDateEntry("From ");
echo $fromDate;
$toDate = $ire->bldDateEntry("To ");
echo $toDate;
?>
&nbsp; Password
<input type="password" name="yourpswd" size="20"></p>
<input type="submit" value="Submit" name="B1"><input type="reset" value="Reset" name="B2"></p>
</form>
<p>&nbsp;</p>

</body>

</html>