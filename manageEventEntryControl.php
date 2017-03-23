<?php
require_once("../cgi-bin/connect.inc");
require_once($_SERVER['DOCUMENT_ROOT'] ."/stylesheets/Forms.css");
require_once($_SERVER['DOCUMENT_ROOT'] ."/phpClasses/Class_publicist.php");
$pub = new publicist;
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Event Entry Control</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" />
<link rel="stylesheet" href="http://www.graypluswhite.com/taxi/_css/taxi1.css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
<script src="../dough/Dough/dough.js"></script>	
	
</head>

<body>
<!-- ========================== -->
<div data-role=page id="mainPage" data-theme="b"/>
 
  <div data-role="header" class="header">
  <h1>Manage Event Entry Control </h1>
  <center>
  <img src="http://www.graypluswhite.com/whtw/graypluswhitebannereventMaint.jpg" alt="banner"/>
  </center>
  </div>
  
  <div data-role="content">
  
 <div id="loginArea">
        <label for "screenCode">Your Screen Code</label><br />
        <input type="text" title="Enter yYour screen Code" name="screenCode" id="screenCode" value="" placeholder="Enter Your screen Code"/>
        
        <label for "pWord">Your Password</label><br />
        <input type="password"  placeholder="Enter Password"
        title="Enter your password" name="pWord" id="pWord"/>
        <input type="button" id="loginButton" name="loginButton" value="Verify Login" />
  </div> <!--End of Login Area -->      
  
  <div id="controlArea">
 
  <b>This is the control area</b>
  <table>
  <tr>
  <td width="25%">Work with this screen code</td><td><input id="wrkID" /></td>
  </tr>
  
  <tr>
  <td width="25%">heading text</td><td><input id="wrkHeadText" /></td>
  </tr>
  
  <tr>
  <td width="25%">Password</td><td><input id="wrkPass" /></td>
  </tr>
  
  <tr>
  <td width="25%">Select Phrase</td><td><input id="wrkPhrase" /></td>
  </tr>
  
  <tr>
  <td width="25%">Update allowed?</td><td><input id="wrkUpdate" /></td>
  </tr>
  
  <tr>
  <td width="25%">Post Credit</td><td><input id="wrkpostCredit" /></td>
  </tr>
  
  <tr>
  <td width="25%">Credit</td><td><input id="wrkCredit" /></td>
  </tr>
  
   <tr>
  <td width="25%">Recurring Allowed</td><td><input id="wrkRecurr" /></td>
  </tr>
  <tr>
  
  
  <td width="25%">Email</td><td><input id="wrkEmail" /></td>
  </tr>
  
  
  
  <tr><td></td>
   <td ><input type="button" id="postButton" name="postButton" value="Post New Information"/>
  </td></tr>
  
  </table>
   </div> <!-- end of Control area -->
  </div> <!--end of content-->
  
<div data-role="footer"> <h1>Gray and White Computing</h1></div>
</div><!-- End of Page -->

</body>
<script>
	$(document).ready(function(){
	console.log("at document ready");
	$("#controlArea").hide();
	
	});
	
	$("#loginButton").click(function()
		{
		console.log("At login button clicked");
		$("#loginArea").hide();
		$("#controlArea").show();
		console.log("Control area should show");
		
		});
	$("#wrkID").dblclick(function(){
		console.log("Work Id double clicked");
		var so=$("#wrkID").val();
		var urlx="http://www.graypluswhite.com/whtw/getEventEntryControlData.php?select_org=" + so;
		console.log("looking for " + urlx);
		$.post(urlx,function(data){
			alert("data loaded" + data);
		});
			
	});
		
	
</script>
</html>