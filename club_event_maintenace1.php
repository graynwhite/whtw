<?php
/** @package 

        club_event_maintenace1.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 9/12/2003 3:52:08 PM
	Last change: FJC 6/13/2005 11:21:27 PM
*/
 include("../phpClasses/connect.php");
 function get_select_org($select_org){
    $sql = "select * from entryControl where select_org =\"$select_org\" ";
    $result = mysqli_query($conn,$sql);
    if ( !$result ){
        print("<br /> invalid search organization " . $sql );
        exit;
        }
        $row = mysqli_fetch_assoc($result);
        $resultx = $row['select_phrase'];
        $resultx = html_entity_decode($resultx);
        return  $resultx;

}// end of get select_org function
function get_page_title($select_org){
    $sql = "select * from entryControl where select_org =\"$select_org\" ";
    $result = mysqli_query($conn,$sql);
    if ( !$result ){
        print("<br /> invalid search organization " . $sql );
        exit;
        }
        $row = mysqli_fetch_array($result);
        $resultx = $row['heading_text'];
        $resultx = html_entity_decode($resultx);

        return  $resultx;

}// end of get select_org function
 $page_title="Organization List";
 $sql = "select * from orgs ";
  if ( isset($select_org) )  {
        $confirm=TRUE;
   $sql .= " " . get_select_org($select_org). " ";
   $page_title = get_page_title($select_org);
    }
    $sql .= " order by Org_name ";

    $result = mysqli_query($conn,$sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to cauleyfrank@gmail.com" . mysql_error() . " </p>");
	 		exit;

      		}

?>
<html>

<head>
	<title>Club Event Maint.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/template.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="mobile.css"/>
	<link rel="icon"  	type="image/vnd.microsoft.icon" 	href="../gwlogo.gif" />
		
		
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	<script src="http://www.graypluswhite.com/jqvaleng/js/jquery-1.8.2.min.js"></script>
	
</head>

<body>
<div id="mainPage" data-role="page">
<div data-role="header">
<p align="center"><img src="graynwhitebannereventMaint.jpg" width="100%"></p>
<p align="center"><b><font size="6"><?print $page_title?></font></b></p>
</div><!--end of header -->
<div  data-role="content">
<p align="left"><font size="6"><b>Select the organization:</b></font></p>
<table border="2" cellpadding="1" cellspacing="1"  width="350px" >
   <tr>
        <th>Organization name</th>
        <th>Action </th>
</tr>
 <?       while ($row = mysqli_fetch_assoc($result)){

    ?>
 <tr>

        <td width="80%"><?print$row['Org_name']?>&nbsp;</td>
        <td width="20%"><a href="club_event_list.php?org=<?print$row['Org_num']?>" target="_blank">Select</a>
          
    </td>

 </tr>
 <?php } ?>

</table>
</div><!-- end of content -->
<div data-role="footer">
<p align="center"><font size="6"><b>Gray and White Computing</b></font></p>
</div><!-- end of footer -->
</div><!--End of mainPage -->
</body>

</html>