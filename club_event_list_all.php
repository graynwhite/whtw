<?php
/** @package

        club_event_list.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 9/12/2003 4:30:16 PM
	Last change: FJC 7/13/2005 5:45:53 PM
*/
$org=$_GET['org'];

$affil=isset($_GET['affil'])? $_GET['affil'] : 'no';
$org_code = isset($_GET['affil'])? $affil : $org;
$select_parameter = isset($_GET['affil'])? "Affil = \"$affil\"" :  "org = \"$org\"";
require_once("../cgi-bin/connect.inc");
	$sql = "select * from events order  by Org_num ,Date_from, Time_start";
   
   $result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected. Please email this information to cauleyfrank@gmail.com" . mysql_error() . "<br />" . $sql . " </p>");
	 		exit;

      		}


?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Club Event List</title>
</head>

<body>

<p align="center"><img src="graypluswhitebannereventMaint.jpg" width="468" height="60"></p>
<p align="center"><b><font size="5">Event list for <?print $org_code?></font></b></p>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#000000" width="89%" id="AutoNumber1">
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
    <td><?print $row['Org_num']?>&nbsp
	<?print $row['Date_from']?>
      &nbsp;
    <?print$row['Time_start']?>&nbsp;
    <?print$row['Time_end']?>&nbsp;&nbsp;
    <?print$row['Dow']?><br />MP&nbsp;
	<?print$row['Price_members']?>&nbsp;GP&nbsp;
	<?print$row['Price_guests']?>&nbsp;</td>
     <td>Id = <?print$row['Event_number']?><br><?print $row['Date_to']?>&nbsp;</td>
      <td>Title: <?print $row['Event_title']?><br />
	  <?print$row['Place']?>&nbsp;</td>
       <td><?print$row['Activity']?>&nbsp;</td>

        <td><a href="event_maint.php?emailid=cauleyfj@graypluswhite.com&Org=++++&From_mm=01-&From_day=01&From_year=2003-&action=byitem&Event_number=<?print$row['Event_number']?>&Submit=no">Select</a> <a href="../show_event.php?event=<? print $row['Event_number']?>">Map</a></td>
 </tr>
 <?php } ?>
</table>

</body>

</html>