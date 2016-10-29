<?php

?>
<html>

<head>
<title>Holiday/Special Event Input</title>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Holiday or special event input</title>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	<link rel="stylesheet" href="http://www.graynwhite.com/jqvaleng/css/template.css" />
	<link rel="stylesheet" href="http://www.graynwhite.com/jqvaleng/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="mobile.css"/>
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		<script src="http://www.graynwhite.com/jqvaleng/js/jquery-1.8.2.min.js"></script>
		<script src="http://www.graynwhite.com/jqvaleng/js/languages/jquery.validationEngine-en.js"></script>
		<script src="http://www.graynwhite.com/jqvaleng/js/jquery.validationEngine.js"></script>
		<script src="http://www.graynwhite.com/dough/Dough/dough.min.js"></script>
		
	
</head>

<body>
<div data-role="page">
<div data-role="header"><h1>Trip or Special Event Input</h1></div>
<form method="post" action="holiday_input.php">
<table border="1" width="100%">
<tr>
<td width="25%">Date Start</td>
<td><input type="date" name="dateStart"  id="datestart" size="24"></td>
</tr>
<tr>
<td width="25%">Date End</td>
<td><input type="date" name="dateEnd"  id="dateend" size="24"></td>
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
<td>Org Code</td><td><input type="text" name="org" id="org" size="6">
</td></tr>
<tr>
<tr>
<td>Password</td><td><input type="password" name="pasx" size="15">
</td></tr>
<tr>
<td> 
Event Disclaimer</td> 
 <td> 
  <input type="text" name="disclaim" value='None'>
  </td></tr>
<tr>
<td> 
Priority</td> 
 <td> 
  <input type="text" name="priority" value='7'>
  </td></tr>

</table>
<p align="center">
<input type="submit" value="Post"
 name="B1">
 <input type="reset" value="Reset" name="B2"></p>
</form>
<div id="postreults">Results will appear here</div>
<div data-role="footer"><h1>&copy;Gray and White Computing</h1></div>
</div> <!-- end of page -->
</body>

</html>
