<?php
require_once("../phpClasses/Class_Ire.php");
$ire = new IREclass;
$ire->setHeader('Art Fairs,Festivals, Community Events and Google Calendar');
$header = $ire->getHeader();
//echo "The header is " . $header;
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>Art,Festivals and Community Input</title>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script> src="../markitup/package.json"></script>
		
<link rel="stylesheet" type="text/css" href="../markitup/markitup/markitup.css" />
<link rel="stylesheet" type="text/css" href="../markitup/markitup/html.css" />

<script src="../geocomplete/jquery.geocomplete.min.js"></script>


<script type="text/javascript" src="../markitup/markitup/jquery.markitup.js"></script>
<script type="text/javascript" src="../markitup/markitup/sets/html/set.js"></script>

<script language="javascript">
$(document).ready(function()	{
   $('#html').markItUp(myHtmlSettings);
});
</script>



<script type="text/javascript">
	

function testit(){
alert("attest");
}

function acknowledge(){
	
	var recipientName = document.getElementById("subName");
	var recipientEmail = document.getElementById("emailid");
	var recipientAddress = recipientName.value + " <" + recipientEmail.value + "> ";
	var pubname = recipientName.value;
	var eventTitleField = document.getElementById("event_title");
	var fromDateField=document.getElementById("date_from");
	var fromDate=fromDateField.value;
	var eventTitle=eventTitleField.value;
	var reserve_date = document.getElementById("resby").value;
	var recipient = recipientEmail.value;
	var source=document.getElementById("eventSource").value;

	
	$.ajax({
			type: 'POST',
			url: "acknowledgemailer.php",
			data: {pubname: pubname, title: eventTitle, fromDate: fromDate, reserve_date: reserve_date, recipient: recipient, event_source: source }
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
	 var eventMouseEnterCount = 0;
	function getSelectionText() {
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        text = document.selection.createRange().text;
    }
    return text;
}
 	$("#event_text").mouseenter(function(){
		eventMouseEnterCount ++;
		console.log("enter Count " + eventMouseEnterCount);
		if(eventMouseEnterCount < 4){
		var title = getSelectionText();
		var existing = $("#event_text").val();
		
		var eventNow= existing + "<br />" + title;
		
		$("#event_text").val(eventNow);
		}
	
	});
 
 
	$("#emailid").mouseenter(function(){
		//$("#media").css({backgroundColor: 'red'});
		if($("#emailid").val()==''){
		var title = getSelectionText();
		$("#emailid").val(title);
		}
	
	});

	$("#subName").mouseenter(function(){
		//$("#media").css({backgroundColor: 'red'});
		if($("#subName").val()==''){
		var title = getSelectionText();
		$("#subName").val(title);
		}
	
	});

		
	$("#event_title").mouseenter(function(){
		//$("#media").css({backgroundColor: 'red'});
		if($("#event_title").val()==''){
		var title = getSelectionText();
		$("#event_title").val(title);
		var newtitle = "<h2>" + title + "</h2>";
		$("#event_text").val(newtitle);
		}
	
	});
	
	$("#other_site_text").mouseenter(function(){
		if($("#other_site_text").val()==''){
		var selectedText = getSelectionText();
		$("#other_site_text").val(selectedText);
		}
	
	});
	$("#timeStart").mouseenter(function(){
		if($("#timeStart").val()==''){
		var selectedText = getSelectionText();
		$("#timeStart").val(selectedText);
		}
	
	});
			
	$("#cleanupbutton").click(function(){
		console.log("At cleanup click");
		var mediawork = $('#media').val();
		var res;
		console.log("media is " + mediawork);
		
		mediawork=mediawork.replace("Where?","");
		mediawork=mediawork.replace("Where","");
		mediawork=mediawork.replace("When?","");
		mediawork=mediawork.replace("When","");
		mediawork=mediawork.replace("map","");
		mediawork=mediawork.replace("Description","");
		mediawork=mediawork.replace("Calendar","");
		mediawork=mediawork.replace("My Meetups","");
		//mediawork=mediawork.replace(/^\s*[\r\n]/gm, "<br>");
		console.log("media after replace " + mediawork);
		
		$("#media").val(mediawork);
		
		
	});
	function nl2br(value) {
  		return value.replace(/\n/g, "<br />");
}
		
	$("#breakbutton").click(function(){
		 console.log("At break button click");
		var mediawork=$('#media').val();
		var mediaworkbr=nl2br(mediawork)
		  $("#media").val(mediaworkbr);
	});
	
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


<link rel="stylesheet" type="text/css" href="markitup/style.css" />
<link rel="stylesheet" type="text/css" href="html/style.css" />

<style type="text/css">

.entryHeader {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-style: italic;
	font-weight: bold;
	color: #0000FF;
	width: 0%;
}
	
.style1 {
	font-size: 24px;
	width: 80%;
}
body {
	background-color: #999999;
	}

</style>


<!-- 
Using the HTML5 <time> element allows to express a human-readable date or a timestamp in a web page, and annotate it with a machine-readable date/time value that can be extracted and processed by applications.
While date/time information items have to be formated as strings in a human-readable form on web pages, preferably in localized form based on the settings of the user's browser, it's not a good idea to store date/time values in this form. Rather, we use instances of the pre-defined JavaScript class Date for representing and storing date/time values. In this form, the pre-defined functions toISOString() and toLocaleDateString() can be used for turning Date values into ISO standard date/time strings (of the form "2015-01-27") or to localized date/time strings (like "27.1.2015"). Notice that, for simplicity, we have omitted the time part of the date/time strings.

In summary, a date/time value is expressed in three different forms:

Internally, for storage and computations, as a Date value.

Internally, for annotating localized date/time strings, or externally, for displaying a date/time value in a standard form, as an ISO standard date/time string, e.g., with the help of toISOString().

Externally, for displaying a date/time value in a localized form, as a localized date/time string, e.g., with the help of toLocaleDateString().

When a date/time value is to be included in a web page, we can use the element that allows to display a human-readable representation (typically a localized date/time string) that is annotated with a standard (machine-readable) form of the date/time value.

We illustrate the use of the element with the following example of a web page that includes two elements: one for displaying a fixed date, and another (initially empty) element for displaying the date of today, which is computed with the help of a JavaScript function. In both cases, we use the datetime attribute for annotating the displayed human-readable date with the corresponding machine-readable representation.

 Collapse | Copy Code
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta charset="UTF-8" />
 <title>Using the HTML5 Time Element</title>
 <script>
function assignDate() {
  var dateEl = document.getElementById("today");
  var today = new Date();
  dateEl.textContent = today.toLocaleDateString();
  dateEl.setAttribute("datetime", today.toISOString());
}
window.addEventListener("load", assignDate);
 </script>
</head>
<body>
 <h1>HTML5 Time Element</h1>
 <p>HTML 2.0 was published on 
    <time datetime="1995-11-24">24.11.1995</time>.</p>
 <p>Today is <time id="today" datetime=""></time>.</p>
</body>
</html> 
After this web page is loaded, the JavaScript function assignDate() is executed. It computes today's date as a Date value and assigns the ISO standard representation to the element's datetime attribute and the localized representation as the text content of the element.

Read more about web engineering on web-engineering.info.

 -->

<script>
function scrollUp(){
	scrollTo(0,0);
	}
	
function assignDate() {
  var dateEl = document.getElementById("date_from");
  var today = new Date();
  dateEl.textContent = today.toLocaleDateString();
  dateEl.setAttribute("datetime", today.toISOString());
}
window.addEventListener("load", assignDate);*/
 </script>
</head>

<body>

<div data-role="page" theme="b">

<div data-role = "header" >

<p align="center" ><img src="graynwhitebannereventMaint.jpg" alt="Gray and white logo" width="30%"  align="middle"/></p>
<p align="center"><span class="entryHeader style1"><? echo $header ?> -EVENT ENTRY:</p>
</div>

<div data-role="content" width="100%">

<form method="POST"  action="artFestivalEntry.php"
	name="entry_form">
    <a id="topOfPage" ></a>

	<input type="hidden" name="website"/>
<?php
$orglist="";	
include_once("../phpClasses/orgSelect.php");	
//$orgRadio = $ire->bldOrgRadio();


	echo $orglist;
//$orgRadio=	

//$venueRadio = $ire->bldVenueRadio("theaterVenues.xml",80);
//echo $venueRadio;
$original_date=$ire->bldDateEntryShort();
?>

<p>Media Input:
  <textarea name="media" id="html" class="markItUp" cols="100%"  rows="10"></textarea><br/>
  <input type="button" id="breakbutton" value="Break lines"/>
  <input type="button" id="cleanupbutton" value="Clean up Calendar"/>
  
</p>
<p>Note: if Site is &quot;Other&quot; then Site information must be completed conversely to specify site information site must be set to Other. </p>
<p>Title:
  <input name="title" type="text" id="event_title" size="60" maxlength="60" />
</p>
<p>Event Description:
  <textarea rows="3" name="event_text" id="event_text" class="markItUp" cols="100%"></textarea></p>
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
  <label>URL</label>
  <input name="URL" type="text" id="URL" size="40" />
  
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
  <label>Single Event or Spanned date</label>
<input name="Generate" type="radio" value="single" checked="checked" /> 

  
  <label>Intervening </label>
<input type="radio" name="Generate" value="intervening" /> 

<label>Multi Day Event </label>
<input type="radio" name="Generate" value="multiDay" /> 

    <label>Recurring</label>
  <input type="radio" name="Generate" value="recurring" />

</p>
<p>Price:
  <input name="price" type="text" id="price" />
  <label>Priority</label>
  <input name="priority" type="text" value="7" />
  
  Confirm Y=Confirmed,T=Confirmed Trip,G=Confirmed Golf 
  <input type="text" name="confirm"  width="5" value="Y">
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
   Password
 
  
     <input type="password" name="yourpswd" size="20">

<input type="submit" value="Submit" name="B1"><input type="reset" value="Reset" name="B2">
<input type="button" value="Scroll up" name="scrollup" onClick="scrollUp()">

</p>
</form>
<div id="form-messages"></div>
<form id="ackForm" name="ackForm" method="post">
Name of person submitting event<input name="subname" id="subName" type="text"/><br />
Email <input name="email" id="emailid" type="text" /><br />
Source of input: <input name="eventSource" id="eventSource"/><br />
<input type="button" value="Send Acknowledge Letter" onClick="acknowledge()" >
<!--<input type="button" value="acknowledge" name="acknowledge" id="acknowledgebutton" onClick="testit()"/> -->
</form>
</div> <!-- End of content -->
<div data-role="footer"><p align="center"><img src="graynwhitebannereventMaint.jpg" alt="Gray and white logo" width="30%" align="middle"/></p>
</div>
	</div> <!-- end of page -->
</body>

</html>