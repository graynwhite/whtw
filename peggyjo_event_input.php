<?php
/** @package 

        peggyjo_event_input
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 9/8/2004 10:44:00 PM
	Last change: FJC 9/9/2005 4:16:34 PM
*/
?>
<?PHP
include("../cgi-bin//connect.inc");
require_once('../phpClasses/Class_eventschedules.php');
$E= new eventSchedule;
// if ( $yourpswd != "6r1n11" ){
//    echo("<p> You are not authorized to use this system</P>");
//    exit();
// }


 

$place ="Unknown";

switch($_POST['Venue'])
{
    case "dso" :
    $place = "Detroit Symphony Orchestra Max M. Fisher Music Center. 3711 Woodward ";
    $place .= "Detroit, Mich. 48201 Box office 313-676-5111";
	$org = 'dso';
    break;
	case "cmsd" :
	$place = "Seligman Performing Arts Center- Detroit Country Day School. 22305 W. 13 Mile Road  , Beverly Hills, MI. 48025.";
	$org="cmsd";
	break;
    case "allesee" :
    $place = "Detroit Symphony Orchestra Max M. Fisher Music Center- Allesee Hall. 3711 Woodward ";
    $place .= "Detroit, Mich. 48201 Box office 313-676-5111";
	$org= 'dso';
    break;
    case "mbox" :
    $place = "Detroit Symphony Orchestra Max M. Fisher Music Center 3711 Woodward ";
    $place .= " Music Box. ";
    $place .= " Detroit, Mich. 48201 Box office 313-676-5111";
	$org = 'dso';
    break;
    case "MT" :
    $place = "Masonic Temple Theater ";
    $place .= "Call Ticketmaster at (248)645-6666 <a href='www.ticketmaster.com'> or click here</a>";
	$org= 'mason';
    break;
    case "Bonstelle" :
    $place = "Bonstelle Theater. 3424 Woodward Ave, Detroit Mi. SE corner of Woodward & Eliot";
    $place .= " N of I-75 Fwy Detroit, Michigan 48201-2726 (313) 577-2960 ";
	$org= 'bonst';
    break;
    case "Hillberry" :
    $place = "Hilberry Theater. 4743 Cass Ave, Detroit, Michigan. SW corner of Cass & Hancock, S of Warren, W of Woodward";
    $place .= "  48201-1201 (313) 577-2972 ";
	$org = 'hillb';
    break;

    case "Baldwin" :
    $place = "Stagecrafters at the Baldwin Theater. 415 S Lafayette Ave, Royal Oak, MI. 48067";
    $place .= " On the Main Stage For tickets Call 248-541-6430";
	$org= 'stage';
    break;
	
case "Baldwin2" :
    $place = "Stagecrafters at the Baldwin Theater. 415 S Lafayette Ave Royal Oak, MI. 48067";
    $place .= " On the Second Stage For tickets Call 248-541-6430";
	$org = 'stage';
    break;
	
    case "Orchard" :
    $place = "OCC Ochard Ridge Campus Smith Theater. ";
    $place .= " For more information call 248-522-3518";
	$org = 'occ';
    break;
	
     case "RoyalOak" :
    $place = "OCC Royal Oak Campus Lila Jones-Johnson Theater. ";
    $place .= " For Ticket information call 248-246-2420, program information 248-246-2627";
	$org = 'occ';
    break;
	
    case "Auburn" :
    $place = "OCC Auburn Hills Campus Building F room 123. ";
    $place .= " For Ticket information call 248-232-4320, program information 248-232-4210";
	$org= 'occ';
    break;
	
     case "Highland" :
    $place = "OCC Highland Lakes Campus Student Center Arena. ";
    $place .= " For Ticket information call 248-942-3020, program information 248-942-3241";
	$org= 'occ';
    break;

     case "bbso" :
    $place = "Temple Beth El. 14 Mile and Telegraph Bloomfield Hills, MI.";
    $place .= " For Ticket information call 248-645-2276, program information 248-645-2276";
	$org = 'bbso';
    break;
	case "villagePlayers" :
     $place = "Village Players of Birmingham. 34660 Woodward Birmingham, Michigan.  48009";
	$place .- " Tickets 248-644-2075 playhouse 248-644-9667";
	$org = 'villp';
	break;
	  case "ridgedale" :
     $place = "Ridgedale Players. 205 W. Long Lake Rd, Troy, Mi. 48098";
    $place .= " Tickets 248-988-7049 Theater 248-689-6241 ";
	$org='ridg';
	break;
	case "meadowbrook" :
 
    $place = "Meadowbrook Theater on the campus of Oakland University. 207 Wilson Hall.";
	$place .- " Tickets (248) 377-3300 web site  http:www.mbtheatre.com";
	$org ='mdbrk';
	break;
} /* End of venue switch */
	switch($_POST['Venue2'])
{
	  case "hillAud" :
    $place = "Hill Auditorium. 825 N. University Ann Arbor, MI. 48109";
    $place .= " For Ticket information call 734-764-2538 ";
	$org = 'umth';
	 break;
	 
	  case "power" :
    $place = "Power Center. 105 S. State St Ann Arbor Mi. 48104 734-763-3333";
    $place .= " For Ticket information call 734-764-2538 ";
	$org = 'umth';
	 break;
	 
	  case "rackham" :
    $place = "Rackham Auditorium. 915 E. Washington, Ann Arbor Mi. 48109 734-647-3327";
    $place .= " For Ticket information call 734-764-2538 ";
	$org = 'umth';
	 break;
	 
	  case "michtheater" :
    $place = "Michigan Theater. 603 E. Liberty St Ann Arbor Mi. 48104 734-668-8397";
    $place .= " For Ticket information call 734-764-2538 ";
	$org = 'umth';
	 break;
	 
	  case "stFrancis" :
    $place = "St Francis of Assisi Church. 2250 E. Statium Blvd, Ann Arbor, MI. 48104 734-769-2550";
    $place .= " General Admission Venue  ";
	$org = 'umth';
	 break;
	 
	
	
	  case "wharton" :
 
    $place = "Wharton Center on the MSU Campus East Lansing 48824-1318";
    $place .= " Boxoffice  517.432.2000  ";
	$org= 'msuth';
	break;
	case "fairchild" ;
 
    $place = "Wharton Center on the MSU Campus East Lansing 48824-1318 Fairchild Theater";
    $place .= " Boxoffice  517.432.2000  ";
	$org= 'msuth';
	break;
	case "cobbhall" :
 
    $place = "Wharton Center on the MSU Campus East Lansing 48824-1318 Cobb Great Hall";
    $place .= " Boxoffice  517.432.2000  ";
	$org= 'msuth';
	break;
	case "pasant" :
 
    $place = "Wharton Center on the MSU Campus East Lansing 48824-1318 Pasant Theater";
    $place .= " Boxoffice  517.432.2000  ";
	$org= 'msuth';
	break;
	case "msuauditorium" :
 
    $place = "Wharton Center on the MSU Campus East Lansing 48824-1318 MSU Auditorium";
    $place .= " Boxoffice  517.432.2000  ";
	$org= 'msuth';
	break;
	
	
	
	
	
} //end of Venue2 switch

print("<br> place is $place");
$activity = "<b><i>". $showtitle . " &nbsp;</i></b>";
$activity = $activity. $Description;
//$activity = htmlspecialchars($activity);
if ( strlen($price) > 0 ){
    $set_price = True;
    }else{
    $set_price = False;
}
$ts=$time_array[0];
$event_date = date_setup();

if ($Venue=='Baldwin')
{
$start_date_baldwin = $syear . '-' . $smonth . '-' . $sday;
	$end_date_baldwin = $tyear . '-' .$tmonth . '-' . $tday;
	print ("<br> baldwin start Date " . $start_date_baldwin);
	print ("<br> baldwin end  Date " . $end_date_baldwin);
	$performance = $E->stagecrafters($start_date_baldwin,$end_date_baldwin);
	foreach($performance as $P)
	{
		print("<br> " . $P['dow'] . " " . $P['date'] . " " . $P['time']);
		post_to_events($org,$P['date'],$place,$P['time'],$P['dow'],$activity,$price,$Venue,$media);
	}	
}
// Friday Saturday Sunday Processing
if ($friSatSun==True)
{
	While ($Timestamp < $toTimestamp) {
	switch ($dow){
		case "Fri" :
		$ts= "8:00 pm";
		post_to_events($org,$event_date,$place,$ts,$dow,$activity,$price,$Venue,$media);
		break;
		case "Sat" :
		$ts= "8:00 pm";
		post_to_events($org,$event_date,$place,$ts,$dow,$activity,$price,$Venue,$media);
		break;
		case "Sun" :
		$ts= "2:00 pm";
		post_to_events($org,$event_date,$place,$ts,$dow,$activity,$price,$Venue,$media);
		break;
		
		} // end of dow switch
		$event_date = bump_date(1);
		$dow = date("D",$Timestamp); 
	} // end of while  $Timestamp < $toTimestamp
	post_to_events($org,$event_date,$place,$ts,$dow,$activity,$price,$Venue,$media);
}



for ($i=0; $i < 7; $i++)
{
	
if ( strlen($time_array[$i] )>0 )
	{
    $dow = $day_array[$i];
    $ts=$time_array[$i];
	$event_end=$event_date;
	post_to_events($org,$event_date,$place,$ts,$dow,$activity,$price,$Venue,$media);
	} 
	$event_date=bump_date(1); 
}// end for loop

function post_to_events($org,$event_date,$place,$ts,$dow,$activity,$price,$Venue,$media)
{
    if ( $Venue == "Hillberry" ){
        switch ( $dow )
        {
            case "Fri":
            $price = "$28.00";
                break;
            case "Sat" :
            $price="$28.00";
                break;
            default :
            $price = "$20-$28";
                break;
        }// end of switch
    }// end of venue = hillberry
        
    if ( strlen($price)>0 ){
        $price_members = $price;
        $price_guests = $price;
    }
$SQL = "  insert into events

           SET Place = \"$place\",
		   Date_from = \"$event_date\",
           Date_to = \"$event_date\",
           Resby = \"$event_date\",
           Event_org = \"$org\",
           Time_start = \"$ts\",
           DOW = \"$dow\",
           Activity=\"$activity\",
		   media = \"$media\",
           Price_members = \"$price_members\",
           Price_guests = \"$price_guests\",
           Event_open = \"Y\",
           Event_priority = \"7\",
           SUBMITTED_BY = \"peggyjo_entry\"
           ";
           print("$SQL<p>");
           $result = mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in insert  Email this information to webmaster@graynwhite.com" . mysql_error() . "</p>");
          }else{
            Print("Event posted<p>");
        }
}// end of function


function date_setup()
{
print("<br>Start date is " .$_POST['Start_Date']);
print("<br>End date is " .  $_POST['end_date'] );
$date_array = explode("/",$_POST['Start_Date']);
$to_date_array = explode("/",$_POST['end_date']);
Global $time_array,$day_array;
$time_array = Array($_POST['Time1'],$_POST['Time2'],$_POST['Time3'],$_POST['Time4'],$_POST['Time5'],$_POST['Time6'],$_POST['Time7']);
$day_array = Array($_POST['day1'],$_POST['day2'],$_POST['day3'],$_POST['day4'],$_POST['day5'],$_POST['day6'],$_POST['day7']);

 $smonth = $date_array[0];
if ( strlen($smonth)<2 ){
    $smonth = "0" . $smonth;
}

$sday= $date_array[1];
if ( strlen($sday)<2 ){
    $sday= "0" . $sday;
}
$syear=$date_array[2];

$tmonth = $to_date_array[0];
if (strlen($tmonth)<2){
	$tmonth = "0" . $tmonth;
	}
$tday = $to_date_array[1];
if (strlen($tday)<2){
	$tday = "0" . $tday;
	}
$tyear=$to_date_array[2];
Global $toTimestamp;
Global $Timestamp;
$toTimestamp = Mktime(0,0,0,$tmonth,$tday,$tyear);	
$Timestamp=Mktime(0,0,0,$smonth,$sday,$syear);
$dow = date("D",$Timestamp);
$event_date = $syear . "-" . $smonth . "-" . $sday ;
return $event_date;

}
function bump_date($number_days)
{
		Global $Timestamp;
        $newTimestamp = mktime(0,0,0,date('m',$Timestamp),date('d',$Timestamp) + $number_days , date('Y',$Timestamp));
		$Timestamp = $newTimestamp;
   		 $syear = date("Y",$Timestamp);
    	$smonth = date("m",$Timestamp);
   		 $sday= date("d",$Timestamp);
    	$event_date = $syear ."-" . $smonth ."-" . $sday;
    	return $event_date;
}//end of function

?>
