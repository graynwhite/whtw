<?php

/*
 * Created on Jan 10, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php
include("../cgi-bin//connect.inc");
   $sql="select * from events where (Event_org = \"HOL\") or (Event_org=\"hol\")  
   order by Date_from ";
   $result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to cauleyfrank@gmail.com" . mysql_error() . " </p>");
	 		exit;

      		}


?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<title>Events that need attention</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	</head>

<body>
<div data-role=header>
	<p align="center"><img src="graynwhitebannereventMaint.jpg" width="468" height="60"></p>
	<h1 align="center">Events that need attention</h1>
	</div>
	<div data-role=content>
<table border="1" cellpadding="0" cellspacing="0"  >
  <tr>
    <td width="12%">
		<p align="center">From Date</p></td>
    <td width="12%">
		<p align="center">To Date</p></td>
    <td width="32%=">
		<p align="center">Place</p></td>
    <td width="32%">
		<p align="center">Activity</p></td>
    <td width="12%">
		<p align="center">Action</p></td>
  </tr>
  <tr>
  <?       while ($row = mysql_fetch_array($result)){

    ?>
	  <td><?php echo $row['Event_org']?>
	  <?php echo $row['Date_from']?>&nbsp;
	  <?php echo $row['Time_start']?>&nbsp;
    <?php echo $row['Time_end']?>&nbsp;&nbsp;
    <?php echo $row['Dow']?>&nbsp;
	<?php echo $row['Event_number']?>&nbsp;</td>
     <td><?php echo $row['Date_to']?>&nbsp;</td>
      <td><?php echo $row['Place']?>&nbsp;</td>
       <td><?php echo $row['Activity']?>&nbsp;</td>
	  <td><a href="event_maint.php?action=byitem&Event_number=<?php echo['Event_number']?>">select</a></td>
	</tr>
 </table>
 
 	<div data-role="footer">
			<h1 align="center">Gray and white computing</h1>
	</div>
		

</body>

</html>