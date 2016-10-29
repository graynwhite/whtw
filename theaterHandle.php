
<?php
if($_POST['passwrd'] !='/FJ6r1n11M'){
	print "Password not valid";
	exit;
}
	
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/Class_Ire.php");
require_once($_SERVER['DOCUMENT_ROOT']."/cgi-bin/connect.inc");

$ire = new IREclass;

$confirm = $_POST[radioEntryType]=="Theater"? "Y" : "T";

$groupName = str_replace("+"," ",$_POST["selectmenu"]);
$event_date =  $_POST["dateStart"];
$event_end = $_POST["dateEnd"];
$event_title = $_POST["prodname"];
$event_activity = $ire->getSiteInfo("theaterVenues.xml",$groupName);
$event_media = $event_activity;
$event_place = $ire->getSiteVenue("theaterVenues.xml",$groupName);
if($confirm=="T"){
	$event_place=$event_title . ". " .$event_title;
}
$event_org = $ire->getSiteOrg("theaterVenues.xml",$groupName);


$html_text= "<br /> Starting date is " . $_POST["dateStart"];
$html_text .= "<br /> Ending  date is " . $_POST["dateEnd"];
$html_text .= "<br /> Theater group is " . ($_POST["selectmenu"]);
$html_text .= "<br /> Production is " . $_POST["prodname"];

$html_text .= "<br />" . $event_place;
$html_text .= "<br /> org is " . $event_org;

	$dow='mul';
	if(!isset($_POST['dateEnd']) || $_POST['dateStart']==$_POST['dateEnd'])
	{
		$dow=date('D',strtotime($_POST['dateStart']));
		
	}
$SQL = "  insert into events
           SET Place = \"$event_place\",
           Date_from = \"$event_date\",
           Date_to = \"$event_end\",
           Resby = \"$event_date\",
           Event_org = \"$event_org\",
           DOW = \"$dow\",
		   confirm= \"$confirm\",
           Activity=\"$event_activity\",
		   media = \"$event_media\",
           Event_open = \"Y\",
           Event_priority = \"35\",
		   Event_title = \"$event_title\",
           SUBMITTED_BY = \"calendarMobile\"
           ";
		   print ("<br />" . $SQL);
             $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in insert  Email this information to webmaster@graynwhite.com" . mysql_error() ."<br>". $SQL . "</p>");
          }else{
            Print("Event posted<p>");
        }

$html_text .= "<br /><br />" . $SQL;

 
?>
<html>
<head>
<title>Theater Handler</title>
 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<link rel="stylesheet" href="stylesheet.css"/>
    <link rel="stylesheet" href="mobile.css"/>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	
</head>
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Theater Handler</h1></div>
<div data-role="content">
<?php echo $html_text ?>
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Computing</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>
