<?php
/** @package 

        pub_week_onecol
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        
	
*/

require_once("../cgi-bin/connect.inc");
require_once("../phpClasses/Class_evententry.php");
require_once("../phpClasses/class_events.php");
$ee = new eventEntry;
$ev = new events;
$person = $_GET['person'];


function compose_title($person,$date_returned){
	switch($person){
	case 'peggyjo' :
		$title = "Events for Peggy Jo Studio Newsletter " . $begin_date . " Edition " ;
		
		break;
	case 'ssorg' :
		$title = "Succesful Singles  Newsletter for " . $date_returned;
		break;	
	case 'bethe' :
		$title = "Bethany East Newsletter for " . $date_returned;
		break;
	default:
		$title = "Unknown " . $date_returned;
	}
	}
	
function checkForEndingPeriod($field){
	$field = trim($field);
	if (substr($field,-1)== '.'  || substr($field,-2,2) == '. ' || substr($field,-3,3)== '.  ') {
			return $field;
			}
	$field = $field . '.';
	return $field;		
}	
	
function insert_quote($count){
print ("<div id='pjquote'> This is a quote number $count </div>");
}

function convert_dow($day){
$newday = "Unknown";
Switch($day){
case "MON" :
case "Mon":
	$newday = "Monday";
	break;
case "TUE":
case "Tue":
	$newday = "Tuesday";
	break;
case "WED":
case"Wed" :
	$newday = "Wednesday";
	break;	
case "THU":
case "Thu" :
	$newday = "Thursday";
	break;	
case "FRI":
case "Fri":
	$newday = "Friday";
	break;
case "SAT":
case "Sat" :
	$newday = "Saturday";
	break;
case "SUN":
case "Sun":
	$newday = "Sunday";
	break;
case "WE.":
	$newday = "Weekend of ";
	break;
case "WK.":
	$newday = "Week of ";
	break;	
default:
	$newday = $day;
	break;
	
}
return $newday;
}
function get_place_name($place,$search_string,$place_string,$current_place){
	$pos2 = strpos($place,$search_string);
		if($pos2 != false) {
		$place_name = $place_string;
		}else{
		$place_name= $current_place;
		}
		return $place_name;
}


//-------------------------------------------------------------------------------------------------
$month_array=array('01' => 'January','02'=> 'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');




$date_returned = array();
// edition denotes the week to be composed. 0 the upcoming week, -1  the current week (used when 
//    working on monday morning ), -2 The previous issue =, 1 the next issue
//    $html denotes print presentation mode.
//	   $Quotes denotes whether quotations will be inserted
//    $

		
		
switch ($person) {
	case 'peggyjo' :
		
		$date_returned= $ee->getNextWeekDay('Mon',$edition);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$PageTitle ="Events for Peggy Jo Studio Newsletter " . $begin_date . " Edition" ;
		$multiple_orgs=true;
		$html=True;
		$Quotes=True;
		
			break;
	case 'ssorg' :
		
		$date_returned= $ee->getNextWeekDay('Mon',$edition);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$month_name = $date_returned['month_name'];
		$PageTitle =" Events for Succesfully Single " . $begin_date . " Edition" ;
		$multiple_orgs=false;
		$html=True;
		$Quotes=false;
		
			break;		
	case 'bethe':
		$date_returned=$ee->getNextMonth();
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$month_name = $date_returned['month_name'];
		$PageTitle =" Bethany East Newsletter " . $month_name ;
		$multiple_orgs = false;
		$html=True;
		$Quotes=False;
			
		break;	
	case 'bethx':
		$date_returned=$ee->getNextMonth();
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$month_name = $date_returned['month_name'];
		$PageTitle =" Bethany Newsletter " . $month_name ;
		$multiple_orgs = True;
		$html=True;
		$quotes=False;
			
		break;		
	default:
		$date_returned= $ee->getNextWeekDay('Mon',$edition);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$PageTitle ="Events for Peggy Jo Studio Newsletter " . $begin_date . " Edition" ;
		$multiple_orgs= true;
		$html=False;
		$quotes=false;
		
	
		break;	
} 
		




if ( $affil =="arch" ){
$PageTitle ="Archdiocese of Detroit Singles Calendar";
}
//----------------------------------------------------------------------------------------------
?>
<html>
<head>
<style type="text/css">
<!--
div.odd {
	background-color: #CCCCFF;
}
div.even {
	background-color: #FFFFFF;
}

#pjquote{
padding-top:0x;
padding-bottom: 0x;
text-align: center;
font-weight: bold;

font-style: italic;
font-size: 12pt;
font-family: "Times New Roman", serif;
border: 3px solid red;
}
#classad{
padding-top:0px;
text-align: center;
font-weight: bold;
font-style: italic;
font-size: 12pt;
font-family: "Times New Roman", serif;
border: 2px solid blue;
}
#pjsource{
float:right;
text-align: right;
font-weight: bold;
font-style: italic;
font-size: 10pt;
font-family: "Times New Roman", serif;
}
#pjadd {
border: 2px solid black;
}
.style1 {
	color: #FF0000;
	font-weight: bold;
}
</style>

<title>Peggy Jo Newsletter edition </title>
</head>
<body>
<center><h1><?=$PageTitle?></h1></center>
<p>
  <?php
        if ($Quotes and !$for_sale){ // print out two quotes for the introduction section
  		for ($quote_count = 1; $quote_count < 3; $quote_count++ ){
		insert_quote($quote_count);
		}
	}
	
//connect to the database server
      $sql = "SELECT T1.*, T2.Org_name FROM events as T1,
                orgs as T2 
        WHERE
             T1.Event_org = T2.Org_num and T2.publish_pjsn = 'T'
            && ( T1.Resby >= \"$begin_date \")
            && T1.Resby <= \"$end_date\"
            && T1.Event_open != \"N\"  ";
			if ($person == 'bethe'){
				$sql .= " && T1.Event_org = \"Bethe\" ";
				}
			if ($person == 'ssorg'){
				$sql .= " && T1.Event_org = \"ssorg\" ";
				} 	 
			if ($person == 'bethx'){
				$sql .= " && T1.Event_org like \"%Beth%\" ";
				}  	 
            $sql .= "order by Date_from  ";
			
             $result = mysql_query($sql);
  if (!$result) {
                    trigger_error("<p>Error performing query Email this information to webmaster@graynwhite.com" . $sql .  mysql_error() . "</p> ");
                   
           }
  if ( mysql_num_rows($result) < 1 ){
     echo("<p> No rows found in query Email this information to webmaster@graynwhite.com </p> ");
                    echo("<p> $sql </p>");
            exit();
           }
  
  $day_heading_hold = "  ";
  $even_odd ='even';
  $day_class='even';
  
  
  
		
  While ($row=mysql_fetch_array($result))
    {
    $event_org_name = $row['Org_name'];
    $date_array =split("-",$row['Date_from']);
    $month_ptr = $date_array[1];
   
    $event_month = $month_array[$month_ptr];
	$place_name = $event_org_name;
	// Event Title 
	$print_event= true;
	$print_details= true;
	$multi_day = false;
	// set the print event indicator to true for each event
	if (strstr($row['Event_org'],"HOL")){
	
	$place_name = $row['Place'];
	$print_details = false;
	}
	if (strstr($row['Event_org'],"sucin")and $person != "peggyjo")  { // success Church
	$print_event = false;
	}
	if (strstr($newday,"Weekend of") or (strstr($newday,"Week of"))){
	// Change so that it appears in current day and does not break control
	$multi_day= true;
	$print_event = true;
	}
	if (strstr($row['Event_org'],"pjwm")){ // Peggy Jo Cultural Events
		
		$place_name = "Cultural Event";
		$place_name = get_place_name($row['Place'],"Wharton Center","Wharton Center at MSU",$place_name);
		$place_name = get_place_name($row['Place'],"Assisi","U o M Theater",$place_name);
		$place_name = get_place_name($row['Place'],"Baldwin","Stagecrafters",$place_name);
		$place_name = get_place_name($row['Place'],"205 W. Long Lake","Ridgedale Theater",$place_name);
		$place_name = get_place_name($row['Place'],"Campus Building F ","OCC Auburn Hills",$place_name);
		$place_name = get_place_name($row['Place'],"825 N. University","U of M Theater",$place_name);
		$place_name = get_place_name($row['Place'],"603 E. Liberty","U of M Theater",$place_name);
		$place_name = get_place_name($row['Place'],"915 E. Washington","U of M Theater",$place_name);
		$place_name = get_place_name($row['Place'],"Smith Theater","OCC Theater",$place_name);
		$place_name = get_place_name($row['Place'],"Beth El ","Birmingham-Bloomfield Symphony",$place_name);
		$place_name = get_place_name($row['Place'],"1526 Broadway","Detroit Opera Theater",$place_name);
		
	
	} // end of peggy Jo Org
	//
	$day_of_week = convert_dow($row['Dow']);
	$new_day_heading = "";
	$new_event_heading = "";
	//if ($multiple_orgs){ $new_day_heading="Events For ";}
    $new_day_heading = $multi_day ? $day_heading_hold  : $day_of_week  . " " . $event_month .  " " . $date_array[2] ;
	
	$new_event_heading = $day_of_week  . " " . $event_month .  " " . $date_array[2] ;
	if($multiple_orgs){
    $title = "<h4>" . $place_name  .  " ". $day_of_week . " ". $event_month  ." ".$date_array[2] . "</h4>";
	}else{
	$title = "";
	}
	
    $pub_activity = $row['Activity'] ;
	// replace activity with media data for publication.
	if(strlen($row['media']) > 4){
		$pub_activity= $row['media'];
		}
	$pub_activity = html_entity_decode($pub_activity,ENT_COMPAT);
	// check for period at the end of activity
	$pub_activity=checkForEndingPeriod($pub_activity);
	
	if (strlen($row['Time_end']) < 1){
	$pub_activity .= " Starts at " . $row['Time_start'] . '.';
	} else{
	$pub_activity .=   " From  " .  $row['Time_start'] ." to " . $row['Time_end'] . '.';
	}
	$edited_price =$ev->edit_price($row['Price_members'],$row['Price_guests'] );
	$pub_activity=checkForEndingPeriod($pub_activity);
	$pub_activity .= $edited_price . '.';
	if ($row['Resby'] != $row['Date_from'] ) {
    $pub_activity .= " Reserve by " .$row['Resby'] . '.';
	}
    $pub_event_date = $row['Resby'];
	//  start of print 
	
	if ($html and  $print_event ){
	    if (strcmp($new_day_heading,$day_heading_hold)){
			print("<hr noshade size=3>");
			print("</div><div class=\"$day_class\">");
	    	print("<h2>" . $new_day_heading . "</h2>");
			$even_odd = ('odd' != $even_odd) ? 'odd' : 'even';
		   	$day_class="$even_odd";
			$day_heading_hold = $new_day_heading;
				if ($even_odd == 'odd' and $Quotes and !$for_sale){
					
					insert_quote($quote_count);
					$quote_count +=1;
				}	
		
			
			}else{ 
		
			print("<hr noshade size=3 >");
		
		}
		if ($multiple_orgs){
		print(" <b> " . $place_name . " </b>  <font size='0'>(" . $new_event_heading . ")</font>  </p>"); }
		if( $print_details) {
		print("<p align=\"left\"> <b> Location: </b>" . $row['Place'] . "<br>");
		print("<br> " . $pub_activity . "<br>");
		}
	     }else {  // for not Peggy Jo
   if ($print_event == true){
   		if (strcmp($new_day_heading,$day_heading_hold)){
			print ("<hr noshade size=3>");
			print("<p> $new_day_heading </p>");
			$day_heading_hold = $new_day_heading;
			}else{
			
			print("&lt;hr noshade size=3 &gt;");
			
			}
	
		print("<p align=\"left\">	 &lt;h3&gt; " . $place_name . " &lt;/h3&gt;  &lt;font size='0'&gt(" . $new_event_heading . ")&lt;/font&gt;  </p>");
		
		if ($print_details){
		print("<p align=\"left\">  &lt;b&gt; Location: &lt;/b&gt;" . $row['Place'] ."&lt;br&gt;&lt;br&gt;</p>");
		print("<p align=\"left\"> " . $pub_activity . "&lt;br /&gt;&lt;br &gt;</p>");
	   }
   
	} // end of not Peggy Jo print 
	  
} // end of printline=true
} // end of while print loop
if ($for_sale){

?>
<hr size=3>
<table width="100%" border="3" bordercolor="#996699" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><strong>I would like to receive this abreviated version of the &quot;Peggy Jo Studio Newsletter&quot; each monday morning via U.S.Mail.</strong> </td>
  </tr>
  <tr>
    <td width="25%">13 weeks </td>
    <td width="75%"><p>$26</p>
    </td>
  </tr>
  <tr>
    <td>26 Weeks </td>
    <td>$47</td>
  </tr>
  <tr>
    <td>52 weeks </td>
    <td>$86</td>
  </tr>
  <tr>
    <td colspan="2"><p>Send this form and your Check made out to &quot; Peggy Jo Studio&quot; 
      to:<br>
       26406 York
    <br> 
    Huntington Woods, Mi 48070</p></td>
  </tr>
  <tr>
    <td height="20">Your Name : </td>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td height="20">Your Addtress: </td>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td height="20">City and State </td>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><span class="style1">You can sign up for the no-charge full version of this newsletter at www.peggyjostudio.net/archivenews.php </span></td>
  </tr>
</table>
<?php
} // end of if for sale
//require("../bottomx.php");

?>