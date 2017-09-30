<?php
require_once("public_html/Class_connect.php");
$con = new connect_to_database;

class events {
var $edited_time = "";
/*
Field	Type	Null	Key	Default	Extra
Event_number	int(11)		PRI		auto_increment
Date_from	date	YES			
Event_org	varchar(5)	YES			
Time_start	varchar(10)	YES			
Time_end	varchar(10)	YES			
Date_to	date	YES			
Resby	date	YES			
Dow	char(3)	YES			
Place	varchar(255)	YES			
Activity	varchar(255)	YES			
Price_members	varchar(20)	YES			
Price_guests	varchar(20)	YES			
Event_open	char(1)	YES			
Event_priority	int(11)	YES			
SUBMITTED_BY	varchar(40)	YES			
confirm	char(1)	YES		Y	
needsReview	tinyint(1)	YES		0	
media	text	YES			
 */

public static function decode_entities($text) {
    $text= html_entity_decode($text,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    //$text= preg_replace_callback('/&#(\d+);/me',"chr(\\1)",$text); #decimal notation
    //$text= preg_replace_callback('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$text);  #hex notation
    return $text;
}
function clearquotes($textin)
{
	
	/*$textin = str_replace('"','&quot;',$textin);
	$textin = str_replace("'", "&apos;", $textin);
	$textin = str_replace("&","&amp;", $textin);
	*/
	$textin = str_replace('...','---',$textin);
	$textin = str_replace('&lsquo;' ,"'",$textin);
	$textin = str_replace('&quot;' ,'"',$textin);
	$textin = str_replace('&rsquo;',"'",$textin);
	$textin = str_replace('&ldquo;','"',$textin);
	$textin = str_replace('&rdquo;','"',$textin);
	$textin = str_replace('&laquo;','"',$textin);
	$textin = str_replace('&raquo;','"',$textin);
	
	$textin = str_replace('&reg;', '' ,$textin);
	$textin = str_replace('&#64;' , ' at ', $textin);
	$textin = str_replace('&#39;' , "'", $textin);
	
	
	
	
	return $textin;
}
function get_map($event)
{
	$map_text="<a href=\"http://www.graypluswhite.com/show_event.php?event=" .$event . "\">";
	$map_text .= "<img src=\"http://www.peggyjostudio.net/map_button.png\" alt=\"Get a Map\" /> </a>";
	return $map_text;
}
	
function get_events_for_day($day_date,$gt=false)

{
$insert_count=0;	
$ev = new events;
 $sql = "SELECT T1.*, T2.Org_name FROM events as T1,
                orgs as T2 
        WHERE
              ( T1.Event_org = T2.Org_num && T2.publish_pjsn = 'T' ";
            
			if ($gt)
			{
				$sql .= " && ( T1.Resby < (DATE_ADD(CURRENT_DATE(),INTERVAL T1.Event_priority day)))
				&& T1.Date_from >= \"$day_date\" ";
			} else{
            	$sql .= "&& T1.Date_from = \"$day_date\" ";
			}
			$sql  .= " && T1.Event_open != \"N\") 
			            order by Date_from, Time_start  ";
			
             $result = mysql_query($sql);
  if (!$result) {
                    trigger_error("<p>Error performing query Email this information to cauleyfrank@gmail.com" . $sql .  mysql_error() . "</p> ");
                   
           }
  if ( mysql_num_rows($result) < 1 ){
     trigger_error("<p> No rows found in query ". $sql . mysql_error() . "</p>");
	 }
$arrayname=array();
$i = 1;
while ($row =	mysql_fetch_assoc($result))
		$row['Activity']=$events::decode_entities($row['activity']);
		$row['media']=$events::decode_entities($row['media']);	
		$row['Place']=$events::decode_entities($row['Place']);		
		
{	
	if(strlen($row['Activity']) > strlen($row['media'])) //&& subs($row['media'],0,6)=='<br />'))
	{
	$row['media'] = $row['Activity'] . $row['media'];
	}
	if (strlen($row['media']) > 5)
	{
	$row['Activity'] = clearquotes($row['media']);
	}
	if ($row['Event_org']== "HOL")
	{
	$event_text="";
		$event_text .= "<h3>" .$row['Activity']. "</h3>";
		$event_text .= "Any events that are listed for this might not be taking place because of the holiday. Check with the organizer of the event before making your trip."; 
	
	if ($row['Resby'] != $row['Date_from'] ) 
	{
    $event_text .= " Reserve by " .$row['Resby'] . '.';
	}
    $pub_event_date = $row['Resby'];
	$event_text .= "<hr />";
	}elseif($row['Event_org'] == "psnad")
	{
	$event_text="";
	$event_text .= "<p style='padding:10px; background-color: white; text-align: center; font-weight: bold; font-style: italic;  font-size: 14pt; font-family: Verdana, serif; border: 5px solid blue'>". clearquotes($row['media']) . '</p>';
	
	}else
	{
	$event_text="";
	if(($row['Org_name'] == 'Other Events' || $row['Org_name'] == 'Charity Event') && strlen($row['Event_title'])>0)
		{
		$event_text= "<h3>" . $row['Event_title'] . "</h3>";
		} else
			{
		
			if (strlen($row['Event_title'])>0)
				{
				$event_text .= "<h3> " . $row['Event_title'] . " - " .  clearquotes($row['Org_name']);
				} else{
				$event_text .= "<h3> " .  clearquotes($row['Org_name']);
			}
		$event_text .=  "</h3>";
		}
	
	$dayofweek = $row['Dow'];	
	if($row['Dow'] == 'WK.')
	{
		$dayofweek = 'Week of ' ;
	}
	if($row['Dow'] == 'WE.')
	{
		$dayofweek = 'Week end  of ' ;
	}
	$dayofweek = $ee->getdayofweek($row['Date_from'],$row['Date_to']);		
	$event_text .=   $dayofweek . " " . $row['Date_from'] . " <br>";
	
	$event_text .=  html_entity_decode(clearquotes($row['Activity'])) . "<br>";
	$edited_time = $ev->edit_time($row['Time_start'],$row['Time_end'],$row['Dow']);
	if (strlen($edited_time) > 0 )
	{
		$event_text .= $edited_time ;
	}
	
	
	$edited_price = $ev->edit_price($row['Price_members'],$row['Price_guests'] );
	$event_text= $ev->checkForEndingPeriod($event_text);
	$event_text .= $edited_price . '.';
	
	$event_text .= "<span style=\"padding:10px; text-align: center; font-weight: bold; font-style: italic; font-size: 13pt ; font-family: Verdana, serif; \"> ";
	$event_text .= " <b>Location:</b> " . clearquotes($row['Place']) . "</span><br>";
	$event_text .= get_map($row['Event_number']);
	$submit_text= "";
	if ($row['SUBMITTED_BY'] != 'cauleyfj@graypluswhite.com' && strlen($row['SUBMITTED_BY'])>0)
		{
		/*print ("<p> submitted by is : " . $row['SUBMITTED_BY'] );*/
		$argument = $row['SUBMITTED_BY'];
		$ee = new eventEntry;
		$submit_text = $ee->get_submission_credit($argument);
		}
	$event_text .= $submit_text;
	if ($insert_count == 0)
	{
	$event_text .= "<span style=\"font-style:italic; font-size: 9pt ;\"> Please let them know that you saw the notice in the Peggy Jo Studio Newsletter</span></p>";
	$insert_count ++;
	}
	
	
	
	$event_text .= "<hr noshade size='3' />";
	}
	
	$arrayname[]=$event_text;
	
	
} 
return $arrayname;
} // end of function get_events_for_day(



 
function setRefreshActivity($event=0,$activity="Changed Data"){
	$sql = "update events set Activity = \"$activity\",
	confirm = \"N\"  where Event_number = $event ";
	$result = mysql_query($sql);
	if (!$result){
		trigger_error("Trouble with update " . $sql . "  " . mysql_error() );
		}	
		return true;
	}
function clearPersonal()
{
	$this->sql = "delete from events where Event_org = 'psnad'";
	$this->result = mysql_query($this->sql);
}
function insertPersonal($text,$date)

{$text2 = htmlentities($text);
	
	$sql = "insert into events set Event_org = \"psnad\",
								Date_from = \"$date\",
								Date_to = \"$date\",
								Resby = \"$date\",
								Time_start = \"12:00 PM\",
								Activity = \" \",
								media = \"$text2\",
								Event_open= \"y\",
								Place = \" \",
								SUBMITTED_BY = \"auto\",
								confirm= \"y\"";
	//print ("<br>" . $this->sql);
	$result = mysql_query($sql);
	if (!$result){
	trigger_error("Event query not run ". "<br>" . $sql . "<br>" . mysql_error());
	}
	
	return $result;						
								
								
								
								
}

function getTripsandCruises(){
	$this->sql="select * from events where confirm = 'T' order by Date_from";
	$this->result = mysql_query($this->sql);
	if (!$this-result){
	trigger_error("Event query not run " . mysql_error());
	}
	if (mysql_num_rows($this->result)<1 ){
	trigger_error("No rows found for any trips " . $sql . "\n " . mysql_error());
	}
	return $this-result;
}

function getEvent($event_number = 0){
	$sql= "Select * from events where event_number = \"$event_number\" ";
	$result = mysql_query($sql);
	if (!$result){
	trigger_error("Event query not run " . mysql_error());
	}
	if (mysql_num_rows($result)<1 ){
	trigger_error("No rows found for this event number " . $sql . "\n " . mysql_error());
	}
	$row = mysql_fetch_array($result);
	return $row;
}
public static function checkForEndingPeriod($field){
	$field = trim($field);
	if (substr($field,-1)== '.'  || substr($field,-2,2) == '. ' || substr($field,-3,3)== '.  ') {
			return $field;
			}
	$field = $field . '.';
	return $field;		
}	
public static function edit_price($memprice,$guestprice){
$price = "";
if (strlen($memprice) > 0)
{

//if (ereg("Menu",$memprice))
if (stripos($memprice,"menu"))
	{
	$price = " Order off menu ";
	return $price;
	}
	
	if ($memprice==$guestprice)
	{
	$price = " Price is " . $memprice;
	return $price;
	}else
	{
	$price = " Member Price is " . $memprice . " and guest price is " . $guestprice;
	return $price;
	}
	}
	return $price;
}
public static function edit_time($start_time,$end_time,$dow)
{
	
	//print ("<br /> lengtn of start time is " . strlen($start_time) . " end  " . strlen($end_time) );
	if(substr($start_time,0,1)== '0')
		{
		$start_time = substr($start_time,1,strlen($start_time)-1);
		}
	if(substr($end_time,0,1)== '0')
		{
		$end_time = substr($end_time,1,strlen($end_time)-1);
		}
	$edited_time = "Start time not  applicable ";
	if($dow == "WK." or $dow == "WKE" or $dow == "MOS")
	{
		return $edited_time;
	}
	if ( (!strpos($end_time,":")) && (!strpos($start_time,":")))
	//if (   ( !ereg(":",$end_time))  && (!ereg(":",$start_time)  )   )
		{
			$edited_time = "";
			return $edited_time;
		}
	if (!strpos($end_time,":"))	
	//if (!ereg(":",$end_time) )
	{
		$edited_time =" Starts at " . $start_time . '.';
		
	
	} else
	{
	$edited_time =   " From  " .  $start_time ." to " . $end_time . '.';
	}
	return $edited_time;
}
}

?>
