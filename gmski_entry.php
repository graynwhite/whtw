<?php
/** @package

        mspc_entry.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 9/5/2003 2:10:29 PM
	Last change: FJC 11/14/2004 1:18:36 PM
*/
include("../cgi-bin//connect.inc");
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
switch($_POST['event_type']){
    case "Single Mingle" :
    $activity = "Single Mingle Top 40 DJ, Cash Bar, Hors d'oeuvres (8:00-9:00)Dressy Casual (No jeans or Tennis Shoes) Non-Smoking";
    $price_members = "$6.00"; $price_Guests = "$12.00";
    break;
    case "Singles Coalition Dance" :
    $activity = "Singles Coalition Dance Top 40 DJ, Cash Bar, Hors d'oeuvres (8:00-9:00)Dressy (Men must wear a coat and tie) Non-Smoking";
    $price_members = "$15 in advance $20 at door";
    $price_guests = "$15 in advance $20 at door";
        break;
    case "Barn Dance" :
    $activity = "Barn Dance Top 40 DJ, Cash Bar, Non-Smoking";
    $price_members = "$18 in advance $20 at door";
    $price_guests = "$18 in advance $20 at door";
        break;
    case "finedine" :
    $activity = "Everyone is Welcome to Join US Fun & Fine Dining! We will meet in the lounge Anytime between 6:00 and 7:30pm for socializing with dinner afterwards.";
    $price_members = "Menu";
    $price_guests = "Menu";
    $ts = "6:00 pm";
     break;

        break;
    case "Other" :
    $activity = $_POST['other_event_text'];
    $price_members = " ";
    $price_guests =" ";
        break;    
}
print("$activity<P>");
switch($_POST['site']){
    case "1" :
    $place = "Crowne Plaza formerly(Double Tree Guest Suites). 27000 Sheraton Drive  Novi Rd, Novi, MI.  for directions only call 248-348-5000";

        break;
    case "2" :
    $place = "Marriott Hotel Livonia. 17100 Laurel Park Drive, Livonia, MI.  6 Mile at I-275,  exit 170 Drive for directions only 734-462-3100";

        break;
    case "3" :
    $place = "Gazebo Convention Center. 31104 Mound Rd, Warren, Mi.  at 13 Mile  for directions only call 586-979-6030";


        break;
    case "4" :
    $place = "Troy Hilton. 5500 Crooks Rd. Troy, Mi. at I-75 exit 72 for directions only call 248-879-2100";

        break;
    case "5" :
    $place = "Embassy Suites Hotel. Franklin Rd at Beck Road for directions only call 248-350-2000";

        break;
    case "6" :
    $place = "Lazy J Ranch 625 South Hickory Ridge Road at M-59 for directions only 248-887-1551";

        break;
    case "7" :
    $place = "Glen Oaks Country Club. 30500 W 13 Mile, Farmington Hills, Mi. 13 Mile Rd east of Orchard Lake Rd  for directions only 249-626-2600";
        break;
     case "8" :
    $place = "Club Venetion Banquet Center. 29310 John R, Madison Heights, Mi.  North of 12 mile. for directions only 248-399-6788";

        break;
     case "9" :
    $place = "Sheraton Hotel Novi. 21111 Haggerty Rd. Novi, Mi. North of 8 Mile Rd For directions only 248-349-4000";

        break;
      case "10" :
    $place = "Raddison, Livonia (Formerly Holiday Inn). 17123 Laurel Park Dr, Livonia, Mi.  N 6 Mile Road at I-275 734-464-1300";

        break; 
	case "11" :
    $place = "Royalty House Banquet Center.  8201 East 13 Mile Road,  Warren, Mi. on old 13 mile just east of Van Dyke";

        break;  	  
     case "99" :
     $place = $other_site_text;
        break;
 }
print("$place</p>");
if ( $_POST['event_type'] != "finedining" ){
$ts="8:00 pm";
}
$te="1:00 am";
$event_date = $eyear ."-" . $emonth ."-" . $eday;
$SQL = "  insert into events
           SET Place = \"$place\",
           Date_from = \"$event_date\",
           Date_to = \"$event_date\",
           Resby = \"$event_date\",
           Event_org = \"MSP\",
           Time_start = \"$ts\",
           Time_end = \"$te\",
           DOW = \"$dow\",
           Activity=\"$activity\",
           Price_members = \"$price_members\",
           Price_guests = \"$price_guests\",
           Event_open = \"Y\",
           Event_priority = \"7\",
           SUBMITTED_BY = \"gmski_entry\"
           ";
             $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in insert  Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }else{
            Print("Event posted<p>");
        }

?>