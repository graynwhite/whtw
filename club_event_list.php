<?php
/** @package

        club_event_list.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 9/12/2003 4:30:16 PM
	Last change: FJC 7/13/2005 5:45:53 PM
*/
$org=$_GET['org'];
$dateSearch=$_GET['dateSearch'];
$dateSearch=isset($_GET['dateSearch'])? $_GET['dateSearch'] : 'no';
$affil=isset($_GET['affil'])? $_GET['affil'] : 'no';
$org_code = isset($_GET['affil'])? $affil : $org;

$select_parameter = isset($_GET['affil'])? "Affil = \"$affil\"" :  "Event_org = \"$org\"";

$select_parameter = isset($_GET['dateSearch'])? "Date_from = \"$dateSearch\"" : "Event_org    = \"$org\"";
if(!isset($_GET['org']) && !isset($_GET['affil']) && !isset($_GET['dateSearch'])){
	$select_parameter="Event_org=\"other\"";
} 
function decode_entities($text) {
    $text= html_entity_decode($text,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    //$text= preg_replace_callback('/&#(\d+);/',"chr(\\1)",$text); #decimal notation
    //$text= preg_replace_callback('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",matches);  #hex notation
    return $text;
}
require_once("../phpClasses/connect.php");
	$sql = "select * from events where ";
	$sql .= $select_parameter;
	$sql .= "order by Date_from, Time_start";
   
   $result = mysqli_query($conn,$sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected. Please email this information to cauleyfrank@gmail.com" . mysql_error() . "<br />" . $sql . " </p>");
	 		exit;

      		}

preg_replace_
?>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	<link rel="stylesheet" href="http://www.grayplusswhite.com/jqvaleng/css/template.css" />
	<link rel="stylesheet" href="http://www.grayplusswhite.com/jqvaleng/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="mobile.css"/>
	
		
		
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/jquery-1.8.2.min.js"></script>
<title>Club Event List</title>
</head>

<body>
<div id="mainPage" data-role="page">
<div data-role="header">
<p align="center"><img src="graynwhitebannereventMaint.jpg" width="100%" ></p>
<p align="center"><b><font size="6">Event list for <?print $org_code?></font></b></p>
</div><!-- end of header -->
<div data-role="content">
<table border="1" cellpadding="0" cellspacing="0"  bordercolor="#000000" " width="100%" >
  <tr>
    <th width="12%">
    <p align="center">From Date</p></th>
    <th width="12%"> 
    <p align="center">To Date</p></th>
    <th width="76%">
    <p align="center">Place/Activity</p></th>
  
  </tr>
 
  <?       while ($row = mysqli_fetch_assoc($result)){
  			//if($row['Event_org']=='HOL'){
			$dispActivity= decode_entities($row['Activity']);
			$dispMedia=decode_entities($row['media']);
			$dispPlace=decode_entities($row['Place']);
			//$row['Activity']=$dispActivity;
			//}		
    ?>
	<tr>
    <td>
    From:&nbsp;	
	<?print $row['Date_from']?>
      &nbsp;
    <?print$row['Time_start']?>&nbsp;
    <?print$row['Time_end']?>&nbsp;&nbsp;
    <?print$row['Dow']?><br />MP&nbsp;
	<?print$row['Price_members']?>&nbsp;GP&nbsp;
	<?print$row['Price_guests']?>&nbspPriority&nbsp;
    <?print$row['Event_priority']?>
    </td>
     <td>
	 Id = <?print$row['Event_number']?><br>
	 To=<?print $row['Date_to']?>&nbsp;
	 Resv=<?print $row['Resby']?>&nbsp;
	 </td>
	 
      <td>Title: <?print $row['Event_title']?><br />
	  Place =<?print $dispPlace ?>&nbsp;
	  
      <br />Activity=<?print $dispActivity ?>&nbsp;<br />Media= <?print $dispMedia ?> <br />
		<a href="http://www.graypluswhite.com/whtw/event_maint.php?action=byitem&Event_number=<?print$row['Event_number']?>" target="_blank"><input type="button" value="Select"></a>

 </tr>

 <?php } ?>
 
</table>
</div><!-- end of content -->
</div><!-- end of Main Page -->
</body>

</html>