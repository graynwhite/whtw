<?php
/** @package

        mspc_entry.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 9/5/2003 2:10:29 PM
	Last change: FJC 11/14/2004 1:18:36 PM
*/
include("../cgi-bin//connect.inc");
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/Class_Ire.php");
$ire = new IREclass;
 if ( $_POST['yourpswd'] != "6r1n11" ){
    echo("<p> You are not authorized to use this system</P>");
    exit();
}
$emonth = substr($_POST['From_mm'],0,2);
$eday = substr($_POST['From_day'],0,2);
$eyear=substr($_POST['From_year'],0,4);
$timestamp=Mktime(0,0,0,$emonth,$eday,$eyear);
$dow = date("D",$timestamp);
print("$emonth $eday $eyear $dow<p>");
$actInfoArray = $ire->getActInfo("kensActivities.xml",$_POST['event_type']);
	$activity = $actInfoArray[1];
	$title = $actInfoArray[0];
	$price_members = $actInfoArray[4];
	$price_guests = $actInfoArray[5];
	$ts= $actInfoArray[2];
	$te = $actInfoArray[3];
$activity = $_POST['other_event_text'] != "" ? $_POST['other_event_text'] :$activity;
$event_org = $_POST['org'];
$media = $_POST['media'];   
$place = $_POST['other_site_text'];

print("$place</p>");

$event_date = $eyear ."-" . $emonth ."-" . $eday;


$SQL = "  insert into events
           SET Place = \"$place\",
           Date_from = \"$event_date\",
           Date_to = \"$event_date\",
           Resby = \"$event_date\",
           Event_org = \"$event_org\",
           Time_start = \"$ts\",
           Time_end = \"$te\",
           DOW = \"$dow\",
           Activity=\"$activity\",
		   media = \"$media\",
           Price_members = \"$price_members\",
           Price_guests = \"$price_guests\",
           Event_open = \"Y\",
           Event_priority = \"7\",
           SUBMITTED_BY = \"kens_entry\"
           ";
             $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in insert  Email this information to webmaster@graynwhite.com" . mysql_error() ."<br>". $SQL . "</p>");
          }else{
            Print("Event posted<p>");
        }

?>