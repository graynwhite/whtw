<?php
include("../cgi-bin//connect.inc");
 if ( $yourpswd != "6r1n11" ){
    echo("<p> You are not authorized to use this system</P>");
    exit();
}
$emonth = substr($From_mm,0,2);
$eday = substr($From_day,0,2);
$eyear=substr($From_year,0,4);
$timestamp=Mktime(0,0,0,$emonth,$eday,$eyear);
$dow = date("D",$timestamp);
$event_date = $eyear ."-" . $emonth ."-" . $eday;
$ts=$Start_Time_Hours . $Start_Time_Minutes . $Start_AMPM ;
$te= $To_Time_Hours  .  $To_Time_Minutes  . $To_AMPM ;
$place = $place_name . " " . $city . 


$SQL = "  insert into events
           SET Place = \"$place\",
           Date_from = \"$event_date\",
           Date_to = \"$event_date\",
           Resby = \"$event_date\",
           Event_org = \"$Org\",
           Time_start = \"$ts\",
           Time_end = \"$te\",
           DOW = \"$dow\",
           Activity=\"$activity\",
           Price_members = \"$price_members\",
           Price_guests = \"$price_guests\",
           Event_open = \"Y\",
           Event_priority = \"7\",
           SUBMITTED_BY = \"$emailid\"
           ";
             $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in insert  Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }else{
            Print("Event posted<p>");
        }

?>
