<?php
define("APP_ROOT", $_SERVER['DOCUMENT_ROOT'].'/whtw
');
require_once "../gwsecurity/private/initialize.php";
/*
 * Created on Jan 10, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

function decode_entities($text) {
    $text= html_entity_decode($text,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    //$text= preg_replace_callback('/&#(\d+);/',"chr(\\1)",$text); #decimal notation
    //$text= preg_replace_callback('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",matches);  #hex notation
    return $text;
}


   $sql="select * from events where (Event_org = \"HOL\") or (Event_org=\"hol\") or (needsReview = \"1\") 
   order by Date_from ";
   $result = mysqli_query($conn,$sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to cauleyfrank@gmail.com <br />" . mysqli_error() . "<br />" . $sql . "</p>");
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
	<h1 align="center">Events That Need Attention</h1>
	</div>
	<div data-role="c"ontent">
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" width="100%">
  <tr>
    <th width="20%">
		<p align="center">From Date
   </p></th>
    <th width="20%">
		<p align="center">To Date</p></th>
    <th width="60%=">
		<p align="center">Place, Activity and Action</p></th>
    
  </tr>
  
  <?       while ($row = mysqli_fetch_assoc($result)){
  			
			$dispActivity= decode_entities($row['Activity']);
			$dispMedia=decode_entities($row['media']);
			$dispPlace=decode_entities($row['Place']);
			$row['Activity']=$dispActivity;
					
    ?>
	<tr>
    <td>	
	<?print $row['Date_from']?>&nbsp;
    <?print$row['Time_start']?>&nbsp;
    <?print$row['Time_end']?>&nbsp;&nbsp;
    <?print$row['Dow']?><br />MP&nbsp;
	<?print$row['Price_members']?>&nbsp;GP&nbsp;
	<?print$row['Price_guests']?>&nbsp;
   Priority&nbsp<?print$row['Event_priority']?>;
    </td>
     <td>
	 Id = <?print$row['Event_number']?><br>
	 To=<?print $row['Date_to']?>&nbsp;
	 Resv=<?print $row['Resby']?>&nbsp;
	 </td>
	 
      <td>Title: <?print $row['Event_title']?><br />
	  Place =<?print $dispPlace ?>&nbsp;
	  
      <br />Activity=<?print $dispActivity ?>&nbsp;
      <br />Media= <?print $dispMedia ?>
      <br /><a href="http://www.graypluswhite.com/whtw/event_maint.php?action=byitem&Event_number=<?print$row['Event_number']?>" target="_blank">
	  <input type="button" value="Select"/></a>
		
	</tr>
	<?php } ?>
 </table>
 
 	<div data-role="footer">
			<h1 align="center">Gray and white computing</h1>
	</div>
	</div> <!--End of content-->
</body>

</html>