<?php 
/*if(!$_COOKIE['pjinputrole']=='pjinfosupervisor'){
	 header('Location: login.php');
    exit;
	*/
//}
?>	
<!DOCTYPE html> 
<html> 
	<head>
    
	<title>pjinfo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<link rel="stylesheet" href="http://peggyjomobile.net/peggyjo4.css"/>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	
</head> 

<body> 
<!-- ========================== -->
<div id="demo"></div>
<!-- ========================== -->
<div data-role="page" id="mainPage" data-theme="b">
 
<div data-role="header" class="header"><h1>Pjinfo main Page</h1>
<img src="http://www.graypnwhite.com/pjsn/pjbanner20130128.jpg" height="180px" align="right" hspace="30"/>
</div>

<div data-role="content">
  


<ul>
<li><a href="#help" data-role="button">Help with this page</a></li>


<li><h3>From Your Cell Phone or Tablet</h3><li>
    <ul>
    <li><a href="http://www.graypluswhite.com/pjsn/newsletter.php" target="_blank" data-ajax="false"
    data-role="button">Draft of newsletter</a></li>
    <li><a href="http://www.graypluswhite.com/whtw/event_mail_mobile.php" target="_blank" data-ajax="false" data-role="button"> Enter an Event </a></li>
    <li><a href="http://www.graypluswhite.com/whtw/event_theater_mobile.php" 
    target="_blank" data-ajax="false" data-role="button" > Enter a Theater or trip Event </a></li>
     
     <li><a href="http://www.graypluswhite.com/whtw/holiday_or_special_event_input.php"
      target="_blank" data-ajax="false" data-role="button" > Enter a Holiday Event </a></li>
     
    
    <li><a href="http://www.graypluswhite.com/whtw/calendar.php" target="_blank" data-ajax="false" data-role="button">View the Monthly Calendar </a></li>
    <li><a href="http://www.graypluswhite.com/pjsn/productionStatus.php" target="_blank" data-ajax="false" data-role="button">Update production Status </a></li>
    <li><a href="http://www.graypluswhite.com/whtw/manageRemote.php" target="_blank" data-role="button"
       data-ajax="false">Process Remote</a></li>
   </ul>
<li><h3>From Your Desktop or Laptop</h3></li>
	
      <ul>
      <li><a href="http://www.graypluswhite.com/whtw/event_mail_mobile.php" target="_blank" data-ajax="false" data-role="button"> Enter an Event </a></li>
      <li><a href="http://www.graypluswhite.com/whtw/artFestival_entry_form.php" target="_blank" data-ajax="false" data-role="button" > Enter a Community or Google calendar event </a></li>
      <li><a href="http://www.graypluswhite.com/pjsn/newsletter.php" target="_blank" data-role="button">Work in process PJSN </a></li>
      <li><a href="http://www.graypluswhite.com/whtw/calendar.php" target="_blank" data-ajax="false" data-role="button">View the Monthly Calendar </a></li>
      <li><a href="http://www.peggyjostudio.net/processPhotos.php" target="_blank" data-ajax="false" data-role="button">Select Photo</a></li>

      <li><a href="http://peggyjomobile.net/post.php" target="_blank" data-ajax="false" data-role="button" >Signup for newsletter</a>
      <li><a href="http://www.peggyjostudio.net/signup.html" target="_blank" data-ajax="false" data-role="button">Change your newsletter Status</a></li>
      <li><a href="http://peggyjostudio.net/archivenews.php" target="_blank" data-ajax="false" data-role="button" >See past issues of the Newsletter</a></li>
      <li><a href="http://www.peggyjostudio.net/wordpress" target="_blank" data-ajax="false" data-role="button">Visit the PJSN Blog</a></li>
      <li><a href="http://www.peggyjostudio.net/faq.php" target="_blank" data-ajax="false" data-role="button">View Frequently Asked Questions</a></li>
      <li><a href="http://www.graypluswhite.com/whtw/club_event_maintenace1.php" target="_blank" data-ajax="false" data-role="button">Event Maintenance</a></li>
      <li><a href="http://www.peggyjostudio.net/recommend.php" target="_blank" data-ajax="false" data-role="button">Recommendation form</a></li>
      <li><a href="http://www.graypluswhite.com/whtw/placeAutocomplete.html" target="_blank" data-ajax="false" data-role="button">Find Place Address</a></li>
      <li><a href="http://www.peggyjostudio.net/newsletterPrep/getArchivedNewsletters.php" target="_blank" data-ajax="false" data-role="button">Generate archives</a></li>
      <li><a href="MedicineList.pdf" target="_blank"
       data-ajax="false" data-role="button">FJC Medication List</a></li>
       <li><a href="http://www.graypluswhite.com/crud/orgs" target="_blank" data-role="button"
       data-ajax="false">Maintain Orgs Database</a></li>
       <li><a href="http://www.graypluswhite.com/whtw/manageRemote.php" target="_blank" data-role="button"
       data-ajax="false">Manage Remote Entries</a></li>
		  <li><a href="http://www.graypluswhite.com/whtw/needattention.php"  target="_blank" data-role="button" data-ajax="false">Events that need attenton</a></li>
       <li><a href="http://www.graypluswhite.com/whtw/newsletter_admin.php" target="_brank" data-role="button"
       data-ajax="false">Add Archived Newsletter</a></li>
       <li><a href="http://www.graypluswhite.com/pjsn/closeWeek.html" target="_blank" data-role="button"
       data-ajax="false">Close Week</a></li>
      
      </ul>
</ul>

<div data-role="footer">
    <h1>Peggy Jo Studio Newsletter</h1>
  </div>


 </div><!-- end of content -->


</div> <!-- End of Page -->
<!-- ========================== -->

<div data-role="page" id ="help">
<div data-role="header" class="header"><h1>Pjinfo help</h1>
<img src="http://www.graypluswhite.com/pjsn/pjbanner20130128.jpg" height="180px" align="right" hspace="30"/></div>
<div data-role="content">
<h2>The Gray and White Event Database</h2>
<ul>
<li>Contains events submitted by organization that are:</li>
	<ul>
	<li>Non-Profit</li>
	<li>Social</li>
	<li>Cultural</li>
	<li>Health and Fitness</li>
	<li>Charitable</li>
	<li>Sponsored</li>
	<li>Business and Professional</li>
	
	</ul>
<li>Submitted</li>
	<ul>	
	<li> Directly via forms submitted by Organizational Publicists registered with Gray and White.</li>
	<li> Indirectly via the form discussed below.</li>
	<li> Indirectly via Google Calender</li>
	</ul>
</ul> 
<h2>The Purpose and Functions of this site:</h2>
<ol>
<li> Aid the people who work with the Peggy Jo Studio to perform functions that the general public does not need</li>
<ul>
	<li> Enter events into the Gray and White Event Database from a desktop or laptop</li>
	<li> Enter events into the Gray and White Event Database from a cell phone or tablet</li>
	<li> Access the monthly calender in order to verify that an event has been entered.</li>
	<li> Access the monthly calender to find a future date that would be advantageous to schedule and event. (Look for a good date)</li>
	<li> Signup to the newsletter and/or change status of a subscriber</li>
		<ul>
			<li>These functions are located here so that you can assist people who would like to sign up for the newsletter but are not well informed about the internet.</li>
			<li>You can also help them to change their email address by signing in with their old address, making the changes and then explain to them that they will receive an email message at their old email address asking them to verify that the change should be changed.
		</ul>
		
</ul>
	<li>Utilize cell phones and/or tablets.</li>
	<li>Contact the publisher and/or webmaster</li> 
</ol>
<h2>Monthly Calender Explained</h2>
<ul>
<li> When calendar is first accessed the, the current month will be displayed. The day number of the month is a link to the detail for that day. Displayed in the day are codes for the various organizations that have events scheduled for that day. If you are curious about  the organizations, click on the day number to view the details for that day. The organizations will be displayed on the detail view except when the event is classified as charity or other. Other, means that the event is scheduled by some organization that does not regularly submit information.</li>
</ul>
<h2>Explanation of "PJ" Sites and Application</h2>
<h3>pjEvents</h3>
<p>
pjEvents is an android application that people can download from the Google play store:
    it runs on the users cell phone and is activated by clicking on the icon on the cell phone.
    it opens a browser, accesses the internet and then opens the web page at  http://peggyjomobile.net.</p>

<h3>peggyjomobile.net</h3>
peggyjomobile.net is a web page for the general public. You can access it by opening your browser and entering "peggyjomobile.net" in the URL text box.
 It can be accessed on the desktop as well.
    at the present time it provides access to:
	<ul>
    <li>A menu of the days in the current week, when selected will display the events.</li>
    <li>A menu item for selected future events</li>
    <li>A list of upcoming events extracted from the event database. It is up to the minute data.</li>
    <li>A menu item to select additional functions, when selected, the previous version of the menu will be presented and will show the following menu items.</li>
    <ul>
        <li>A copy of the mobile version of the Peggy Jo Studio Newsletter sent out on Monday with the data as of the day it was sent.</li>
        <li>A link to a mobile web site that will accept input that is used to recommend a friend.</li>
        <li>A link to the Tri-County Business Exchange Mobile Web site.</li>
         <li>A link to a mobile Monthly Calendar</li>
         <li>Information on how to reach us.</li>
          <li>Information on how to get events into the Event database</li>
      </ul>
</ul>
<h3>pjinfo.us</h3>
pjinfo.us is a web page designed for insiders not the general public. It provides some mobile and desktop links
<ul>
<li>Links to mobile sites</li>
	<ul>
	<li>Mobile form to enter events into the database</li>
	<li>View Monthly calendar</li>
    <li>Update Production Control Status</li>
	</ul>
<li>Desktop links</li>
	<ul>
	<li>Enter an event</li>
	<li>Work in process version of the newsletter</li>
	<li>Monthly Calendar</li>
	<li>Sign up for the newsletter</li>
	<li>Change newsletter options</li>
	<li>See past issues of the newsletter</li>
	<li>Visit the blog</li>
	<li>View frequently asked questions</li>
	</ul>
<a href="#mainPage" data-role="button">Return to the main page</a>

<div data-role="footer"> <h1>Peggy Jo Studio Newsletter</h1></div>
<!-- End of content -->
</div><!-- End of Page -->



<!-- ++++++++++++++++++++++++++++++ -->

</body>

</html>
