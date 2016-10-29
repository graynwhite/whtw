<?php
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/Class_Ire.php");



$ire = new IREclass;
$ire->setHeader('Art Fairs,Festivals and Comunity Events');
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



<!DOCTYPE html>
<html>
<head>
<title>Art,Festivals and Community Input</title>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="../geocomplete/jquery.geocomplete.min.js"></script>
<script type="text/javascript" src="../markitup/markitup/jquery.js"></script>
<script type="text/javascript" src="../markitup/markitup/jquery.markitup.js"></script>
<script type="text/javascript" src="../markitup/markitup/sets/html/set.js"></script>
<script type="text/javascript">
function copyDateFrom()
{
document.entry_form.date_to.value= document.entry_form.date_from.value;
document.entry_form.resby.value = document.entry_form.date_from.value;	
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
function UseFound()
{
var str=document.entry_form.geocomplete.value;
var n=str.search(",");

var place_work = str.substring(0,n);

place_work = place_work + ". " + document.entry_form.formatted_address.value;
n=place_work.search("MI,");
place_work=place_work.substring(0,n+2) + ".";
var lenPlace_work = place_work.length;
//alert("length of work place" + lenPlace_work);
var lenAvailable = 100 - lenPlace_work;
//alert("lenAvailable " +lenAvailable);

var website = document.entry_form.website.value;
//alert("length of website " + website.length);
if(website.length > 0 && website.length < lenAvailable){
place_work += " website is " + website;
}
document.entry_form.other_site_text.value = place_work;
}

</script>

<link rel="stylesheet" type="text/css" href="../markitup/markitup/skins/markitup/style.css" />
<link rel="stylesheet" type="text/css" href="../markitup/markitup/sets/html/style.css" />
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
body {
	background-color: #999999;
}
-->
</style>
</head>

<body>
<div class="map_canvas"></div>
<p align="center"><img src="graynwhitebannereventMaint.jpg" alt="Gray and white logo" width="468" height="60"  align="middle"/></p>
<p align="center"><span class="entryHeader style1"><? echo $header ?> -EVENT ENTRY:</span></p>
<form method="POST"   action="artFestivalEntry.php"
	name="entry_form">
	<input type="hidden" name="website"/>
<?php 
/*$orgRadio = $ire->bldOrgRadio("artFestivalOrgs.xml",80);
echo $orgRadio;*/
include_once($_SERVER['DOCUMENT_ROOT'].'/phpClasses/orgSelect.inc');
//$venueRadio = $ire->bldVenueRadio("theaterVenues.xml",350);
//echo $venueRadio;
?>
<p>Sites: </p>
<fieldset>
<input type="radio" value="Other" name="site" <label>Other</label>
</fieldset>
<?php
$original_date=$ire->bldDateEntryShort();
?>

<p>Media Input:
  <textarea name="media" class="markItUp"  id="media"></textarea>
</p>
<p>Note: if Site is &quot;Other&quot; then Site information must be completed conversely to specify site information site must be set to Other. </p>
<p>Title:
  <input name="title" type="text" id="title"  maxlength="60" />
</p>
<p>Event Description:
  <textarea rows="3" name="event_text" class="markItUp" cols="80"></textarea></p>
  <p>
  Place Name:<input name="geocomplete"; type="text" id="geocomplete" value="" size="80" />
	  <input id="find" type="button" value="find" /><input name="useFound" type="button" id="useFound" value="Use Found" onClick="UseFound()"/></p>
	  
 <p>Found Location:<input name="formatted_address" type="text" size="150" value=""/></p>
		
<p> Site description:
<textarea rows="3" name="other_site_text" id="other_site_text" cols="80"></textarea></p>
<p>Mail to Blog 
  <input name="checkMailToBlog" type="checkbox" id="checkMailToBlog" value="True" /> 
  Blog Post Address: 
  <input name="blogNumber" type="text" id="blogNumber" size="60" />
  <label>URL
  <input name="URL" type="text" id="URL" size="40" />
  </label>
</p>

<p>Generate: 
  <label>
<input name="Generate" type="radio" value="single" checked="checked" /> 
Single Event or Spanned date</label>
  
  <label>
<input type="radio" name="Generate" value="intervening" /> 
Intervening </label>
<label>
<input type="radio" name="Generate" value="multiDay" /> 
Multi Day Event </label>
    <label>
  <input type="radio" name="Generate" value="recurring" />
Recurring</label>
</p>
<p>Price:
  <input name="price" type="text" id="price" />
  <label>Priority
  <input name="priority" type="text" value="7" />
  </label>
  Confirm 
  <input type="text" name="confirm"  width="3" value="Y">
</p>
<p>
  <label>Time Start
  <input name="timeStart" type="text" id="timeStart" />
  </label>
  <label>Time End
  <input name="timeEnd" type="text" id="timeEnd" />
  </label>
</p>


  <label>Date From:
  <input name="date_from" type="text" id="date_from" size="12" value="<?=$original_date?>"  onblur="copyDateFrom()" onDblClick="copyDateFrom()" />
  </label>
  <label>Date To
  <input name="date_to" type="text" id="date_to" size="12" value="<?=$original_date?>"/>
  </label>
  <label>Reserve By:
  <input name="resby" type="text" id="resby" size="12" value="<?=$original_date?>"/>
  </label>
</p>
<p>
   <label>Password
   <input type="password" name="yourpswd" size="20"></label>
</p>
<p>
<input type="submit" value="Submit" name="B1"><input type="reset" value="Reset" name="B2"></p>
</form>
<p>&nbsp;</p>

</body>

</html>