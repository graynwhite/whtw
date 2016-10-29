<?php
/*
 * Created on Jan 10, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php
$next_year_events = array('other');
include("../cgi-bin//connect.inc");
   $sql="select* from events where Event_org in('other','Dance','HOL','char','artf','artsc','fest','tns')   
   order by Date_from limit 300";
   $result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to webmaster@graynwhite.com" . mysql_error() . " </p>");
	 		exit;

      		}


?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Events for next year</title>
</head>

<body>

<p align="center"><img src="graynwhitebannereventMaint.jpg" width="468" height="60"></p>
<p align="center"><b><font size="5">Event list next year  events</font></b></p>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#000000" width="101%" id="AutoNumber1">
  <tr>
    <td width="12%">
    <p align="center">From Date</td>
    <td width="9%"><font color="#000000">function 
&nbsp;</font>
    <p align="center">To Date</td>
    <td width="28%">
    <p align="center">Place</td>
    <td width="36%">
    <p align="center">Activity</td>
    <td width="66%">
    <p align="center">Action</td>
  </tr>
  <tr>
  <?       while ($row = mysql_fetch_array($result)){

    ?>
    <td><?print$row['Event_org']?>&nbsp;&nbsp;&nbsp;<?print $row['Date_from']?>
    
    <?print$row['Time_start']?>&nbsp;
    <?print$row['Time_end']?>&nbsp;&nbsp;
    <?print$row['Dow']?></td>
     <td>Id = <?print$row['Event_number']?><br><?print $row['Date_to']?>&nbsp;</td>
      <td><?print$row['Place']?>&nbsp;</td>
       <td><?print$row['Activity']?>&nbsp;</td>

        <td><A href="event_maint.php?emailid=cauleyfj@graynwhite.com&yourpswd=6r1n11&Org=++++&From_mm=01-&From_day=01&From_year=2003-&action=byitem&Event_number=<?print$row['Event_number']?>&Submit=no">Select</a>    </TD>
 </TR>
 <?php } ?>
</table>

</body>

</html>