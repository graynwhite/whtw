<?php
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/Class_Ire.php");



$ire = new IREclass;
$ire->setHeader('Kensington Community Church Single\'s');
$header = $ire->getHeader();
//echo "The header is " . $header;



//$activity = $actInfoArray[1];
//$title = $actInfoArray[0];
//$price_members = $actInfoArray[4];
//$price_guests = $actInfoArray[5];
//$ts= $actInfoArray[2];
//$te = $actInfoArray[3];

//$place = $ire->getSiteInfo("mspVenues.xml","Royalty House");
//echo "place is " . $place;
//$theaterRadio = $ire->bldVenueRadio("theaterVenues.xml",80);
//echo '<p>Theater venues ' . $theaterRadio . "</p>"; 
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Kensington and Gm Input form</title>
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
-->
</style>
</head>

<body>
<p align="center"><img src="graynwhitebannereventMaint.jpg" alt="Gray and white logo" width="468" height="60"  align="middle"/></p>
<p class="entryHeader style1"><? echo $header ?> -EVENT ENTRY:</p>
<form method="POST" action="http://www.graynwhite.com/whtw/kens_entry.php"
	onSubmit="return check_page(this)" name="kens">
<?php 
$orgRadio = $ire->bldOrgRadio("kensOrgs.xml",80);
echo $orgRadio;
$activityRadio = $ire->bldActRadio("kensActivities.xml",80);
echo  $activityRadio;
?>
<p>event description:
  <textarea rows="3" name="other_event_text" cols="80"></textarea></p>
<p>Media Input:
  <textarea name="media" cols="120" rows="6" id="media"></textarea>
</p>
<p> Site description:
<textarea rows="3" name="other_site_text" cols="80"></textarea></p>



<!--<p>Site:&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="site" value="1"> 
Crowne Plaza Novi &nbsp;
<input type="radio" name="site" value="2">Marriott Hotel Livonia
<input type="radio" name="site" value="10">
Raddison Livonia
 <input type="radio" name="site" value="3">Gazebo Convention Center
<input type="radio" name="site" value="4">Northfield Hilton <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="site" value="5">&nbsp;&nbsp; Embassy Suites Hotel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="site" value="6">&nbsp; Lazy J Ranch&nbsp;&nbsp;&nbsp;
<input type="radio" name="site" value="7">Glen Oaks&nbsp;
<input type="radio" name="site" value="8">
Club Venetion
<input type="radio" name="site" value="9">
Sheraton Novi 
<label>
<input name="site" type="radio" value="11">
Royalty House</label>
<input name="site" type="radio" value="12">
Farmington Hills Manor <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="site" value="99">Other Site</p>-->

<p>Date: &nbsp;&nbsp;&nbsp; <SELECT NAME="From_mm" SIZE="1">
<OPTION VALUE="01-" selected>January
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
<Select NAME = "From_day" Size = "1" >
<Option value= "01" selected>01
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
<select name="From_year" size="1" >
  <option value="2009-" selected>2009</option>
  <option value="2010-">2010</option>
  <option value="2011-">2011</option>
</select>
&nbsp; Password
<input type="password" name="yourpswd" size="20"></p>
<input type="submit" value="Submit" name="B1"><input type="reset" value="Reset" name="B2"></p>
</form>
<p>&nbsp;</p>

</body>

</html>