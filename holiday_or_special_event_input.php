<?php

?>
<html>

<head>
<title>Holiday or Special Event Input</title>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/template.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="mobile.css"/>
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/jquery-1.8.2.min.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/languages/jquery.validationEngine-en.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/jquery.validationEngine.js"></script>
		<!--<script src="http://www.graypluswhite.com/dough/Dough/dough.min.js"></script> -->
		
	
</head>

<body>
<div data-role="page" theme="b">
<div data-role="header"><h1>Holiday, Trip or Special Event Input
<center><img src="graynwhitebannereventMaint.jpg" width="60%"  /></center></h1></div>
<form method="POST" action="holiday_input.php">
<table border="1" width="100%">
<tr>
<td width="25%">Date </td>
<td><input type="date" name="dateStart"  id="dateStart" size="24"></td>
</tr>
<tr>
<td width="25%">Venue</td>
<td width="75%"><input type="text" id="venue" name="venue" size="40"></td>
</tr>
<tr>
<td width="25%">Organization</td>
<td width="75%"><input type="text" id="organization" name="organization" size="40"></td>
</tr>
<tr>
<td width="25%">Description</td>
<td width="75%"><input type="text" name="holiday_description" size="40"></td>
</tr>
<tr>
<td>Image Code</td><td><input type="text" name="holimage" id="holimage" size="12
">
</td></tr>
<tr>
<td>Org Code</td><td><input type="text" name="orgnum" id="orgnum" size="6">
</td></tr>

<tr>
<td>Password</td><td><input type="password" name="pasx"id="pasx" value-"passx" size="15">
</td></tr>
<tr>
<td> 
Event Disclaimer</td> 
 <td> 
  <input type="text" name="disclaim"id="disclaim" value='None'>
  </td></tr>
<tr>
<td> 
Priority</td> 
 <td> 
  <input type="text" name="priority" id="priority" value='7'>
  </td></tr>

</table>
<p align="center">
<input type="submit" value="Post">
 <input type="reset" value="Reset"></p>
</form>
<div id="postreults">Results will appear here</div>
<div data-role="footer"><h1>&copy;Gray and White Computing</h1></div>
</div> <!-- end of page -->
</body>

</html>
