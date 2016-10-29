<?php
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/Class_Ire.php");



$ire = new IREclass;
$ire->setHeader('Trip Event Entry');
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Trip Entry Form</title>
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js">

</script>
<script type="text/javascript">
function copyDateFrom()
{
document.entry_form.date_to.value= document.entry_form.date_from.value;
document.entry_form.resby.value = document.entry_form.date_from.value;	
}
</script>

<script type="text/javascript">
tinyMCE.init({
        // General options
		mode : "exact",
		elements: "media5",// Temporary fix elements was media
		theme : "advanced",
		plugins : "spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
       // Theme options
       theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
  theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
          theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
	        theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true, 
			       // Skin options 
				          skin : "o2k7",
						  skin_variant : "silver",
						  // Example content CSS (should be your site CSS)
						         // content_css : // "css/example.css", 
 // Drop lists for link/image/media/template dialog
         template_external_list_url : "../tinymce/jscripts/template_list.js",
		 external_link_list_url : "../tinymce/jscripts/link_list.js",
		  external_image_list_url : "../tinymce/jscripts/image_list.js",
          media_external_list_url : "../tinymce/jscripts/media_list.js",
		   // Replace values for the template plugin
				         template_replace_values : {
						                 username : "Some User",
										 staffid : "991234"        }});
// set the radio button with the given value as being checked
// do nothing if there are no radio buttons
// if the given value does not exist, all the radio buttons
// are reset to unchecked
function setCheckedValue(radioObj, newValue) {
	if(!radioObj)
		return;
	var radioLength = radioObj.length;
	if(radioLength == undefined) {
		radioObj.checked = (radioObj.value == newValue.toString());
		return;
	}
	for(var i = 0; i < radioLength; i++) {
		radioObj[i].checked = false;
		if(radioObj[i].value == newValue.toString()) {
			radioObj[i].checked = true;
		}
	}
}
										 
function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}
										 
function check_page(form)

{

var siteValue =  getCheckedValue(form.site);
if (form.other_site_text.value.length > 0 && siteValue!='Other')
{
alert ("Other Site not checked ");
form.site.focus;
return false;
}else{
return true
}
}										 
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
body {
	background-color: #999999;
}
-->
</style>
</head>

<body>
<p align="center"><img src="graynwhitebannereventMaint.jpg" alt="Gray and white logo" width="468" height="60"  align="middle"/></p>
<p align="center"><span class="entryHeader style1"><? echo $header ?> -EVENT ENTRY:</span></p>
<form method="POST" onSubmit="return check_page(this)"  action="tripEntry.php"
	name="entry_form">
<?php 
$orgRadio = $ire->bldOrgRadio("tripOrgs.xml",80);
echo $orgRadio;
$venueRadio = $ire->bldVenueRadio("tripVenues.xml",80);
echo $venueRadio;
$original_date=$ire->bldDateEntryShort();
?>

<p>Media Input:
  <textarea name="media" cols="120"  rows="10" id="media"></textarea>
</p>
<p>Note: if Site is &quot;Other&quot; then Site information must be completed conversely to specify site information site must be set to Other. </p>
<p>Title:
  <input name="title" type="text" id="title" size="60" maxlength="60" />
</p>
<p>Event Description:
  <textarea rows="3" name="event_text" cols="80"></textarea></p>
<p> Site description:
<textarea rows="3" name="other_site_text" id="other_site_text" cols="80"></textarea></p>
<p>Mail to Blog 
  <input name="checkMailToBlog" type="checkbox" id="checkMailToBlog" value="True" /> 
  Blog Post Number 
  <input name="blogNumber" type="text" id="blogNumber" size="10" />
  <label>URL
  <input name="URL" type="text" id="URL" size="40" />
  </label>
</p>
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
  <input name="date_from" type="text" id="date_from" size="12" value="<?=$original_date?>"  onblur="copyDateFrom()" ondblclick="copyDateFrom()" />
  </label>
  <label>Date To
  <input name="date_to" type="text" id="date_to" size="12" value="<?=$original_date?>"/>
  </label>
  <label>Reserve By:
  <input name="resby" type="text" id="resby" size="12" value="<?=$original_date?>"/>
  </label>
</p>
<p>
    Password
 
  
   <input type="password" name="yourpswd" size="20"> 
   Trip? 
   <label>
   <input name="TripButton" type="radio" value="True" />
   True</label>
   <label>
   <input name="tripButton" type="radio" value="False" checked="checked" />
   False</label>
</p>
<p>
<input type="submit" value="Submit" name="B1"><input type="reset" value="Reset" name="B2"></p>
</form>
<p>&nbsp;</p>

</body>

</html>