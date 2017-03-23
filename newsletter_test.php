<?php
DEFINE('SMARTY_DIR','../phpgacl/admin/smarty/libs/');
require_once(SMARTY_DIR. 'Smarty.class.php');
require_once('../cgi-bin/connect.inc');
require_once("../phpClasses/Class_evententry.php");
require_once("../phpClasses/class_events.php");
require_once("./templates/quotes.php");
require_once("../phpClasses/Class_production_control.php");
$pc = new Class_production_control;
$ee = new eventEntry;
$ev = new events;
$archiveGoogle = "  <script type=\"text/javascript\">
<!--
google_ad_client = \"pub-4877966866498226\"; \n
//160x600, created 12/4/07 \n
google_ad_slot = \"7015812773\"; \n
google_ad_width = 160;\n
google_ad_height = 600;\n
//--></script>\n
<script type=\"text/javascript\" \n
src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n
</script>" ;
	

$date_returned= $ee->getNextWeekDay('Mon',$edition);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];

$pcstatus= $pc->getStatus($begin_date);	
if($pcstatus == 0)
{
	
	$pc->newEdition($begin_date);
	$pcstatus= $pc->getStatus($begin_date);	
}

$statusrow = mysql_fetch_array($pcstatus);
$statusHead = "Status  : "  ;
$statusHead .= " Quotes <input type=\"checkbox\"" ;
$statusHead .= $statusrow['quotesUpdated']==1 ? " checked >" : ">";
$statusHead .= " Articles <input type=\"checkbox\"";
$statusHead .= $statusrow['articlesUpdated']==1 ? " checked >" : ">";
$statusHead .= " Letters <input type=\"checkbox\"";
$statusHead .= $statusrow['lettersUpdated']==1 ? " checked >" : ">";
$statusHead .= " Banner <input type=\"checkbox\"";
$statusHead .= $statusrow['bannerUpdated']==1 ? " checked >" : ">";
$statusHead .= " Advertising Rotated  <input type=\"checkbox\"";
$statusHead .= $statusrow['advertisingRotated']==1 ? " checked >" : ">";
$statusHead .= " Personal Ads <input type=\"checkbox\"";
$statusHead .= $statusrow['personalAdvertising']==1 ? " checked >" : ">";

$prodHeader = "";
$draftHeader = "<tr align=\"center\"><td><strong><font color=\"#FF0000\" size=\"+3\">Draft      Draft Draft     Draft     Draft    Draft    Draft    Draft <br> </font></strong>" ;
$draftHeader .= $statusHead;
$draftHeader .= "</td></tr>";

$archiveHeader = "<tr align=\"center\"><td><strong><font color=\"#FF0000\" size=\"+1\">You can get this newsletter free every Monday Morning in your Email box.<br \/>
Go to http://www.peggyjostudio.net and sign up-- it is free</font></strong></td><tr>";
switch ($_GET['runtype']) 
{
  	case "prod":
	$thisHeader=$prodHeader;
	$googleText="";
	break;
	case "archive" :
	$thisHeader=$archiveHeader;
	$googleText= $archiveGoogle;
	break;
	case "print" :
	$thisHeader=$archiveHeader;
	break;
	default :
	$thisHeader=$draftHeader;
	$googleText="";
}

$modeHeader = "<table width=\"720\" border=\"2\" id=\"runHeader\" cellpadding=\"2\" cellspacing=\"0\"> ";	
$modeHeader .= $thisHeader;
$modeHeader .= "</table>";
/*If day is less than tuesday set the edition to -1 unless the edition is set in the command line*/

if(!isset($edition))
{
$edition = date("w") == 1  ? -1 :  0 ;
}
	
function clearquotes($textin)
{
	
	/*$textin = str_replace('"','&quot;',$textin);
	$textin = str_replace("'", "&apos;", $textin);
	$textin = str_replace("&","&amp;", $textin);
	*/
	$textin = str_replace('&lsquo;' ,"&apos:",$textin);
	$textin = str_replace('&rsquo;',"&apos:",$textin);
	$textin = str_replace('&ldquo;','&quot;',$textin);
	$textin = str_replace('&rdquo;','&quot;',$textin);
	$textin = str_replace('&laquo;','&quot;',$textin);
	$textin = str_replace('&raquo;','&quot;',$textin);
	
	$textin = str_replace('&reg;', '' ,$textin);
	$textin = str_replace('&#64;' , ' at ', $textin);
	$textin = str_replace('&#39;' , '&apos;', $textin);
	
	
	
	return $textin;
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
{
	if(strlen($row['Activity']) > strlen($row['media'])) //&& substr($row['media'],0,6)=='<br />'))
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
		$event_text .= "<h3>" . clearquotes($row['Activity'] ). "</h3>";
	
	if ($row['Resby'] != $row['Date_from'] ) 
	{
    $event_text .= " Reserve by " .$row['Resby'] . '.';
	}
    $pub_event_date = $row['Resby'];
	$event_text .= "<hr />";
	}elseif($row['Event_org'] == "psnad")
	{
	$event_text="";
	$event_text .= "<p style='padding:10px; background-color: white; text-align: center; font-weight: bold; font-style: italic; font-size: 11pt; font-family: Verdana, serif; border: 5px solid blue'>". clearquotes($row['Activity']) . '</p>';
	
	}else
	{
	$event_text="";
	if(($row['Org_name'] == 'Other Events' || $row['Org_name'] == 'Charity Event') && strlen($row['Event_title'])>0)
		{
		$event_text= "<h3>" . $row['Event_title'] . "</h3>";
		} else
		{
		$event_text= "<h3>" . clearquotes($row['Org_name']) ;
			if (strlen($row['Event_title'])>0)
			{
			$event_text .= " " . $row['Event_title'] ;
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
	$event_text .=   $dayofweek . " " . $row['Date_from'] . " <br>";
	
	$event_text .=  clearquotes($row['Activity']) . "<br>";
	$edited_time = $ev->edit_time($row['Time_start'],$row['Time_end'],$row['Dow']);
	if (strlen($edited_time) > 0 )
	{
		$event_text .= $edited_time ;
	}
	
	
	$edited_price = $ev->edit_price($row['Price_members'],$row['Price_guests'] );
	$event_text= $ev->checkForEndingPeriod($event_text);
	$event_text .= $edited_price . '.';
	
	$event_text .= "<span style=\"padding:10px; text-align: center; font-weight: bold; font-style: italic; font-size: 13pt ; font-family: Verdana, serif; >\" ";
	$event_text .= " <b>Location:</b> " . clearquotes($row['Place']) . "</span><br>";
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

$smarty = new smarty;
$smarty->compile_check = true;
$smarty->debugging = False;
$smarty->assign('modeHeader',$modeHeader);
$smarty->assign('googleText',$googleText);
$smarty->assign('mondate',$date_returned['pubdate1']);
$smarty->assign('tuedate',$date_returned['pubdate2']);
$smarty->assign('weddate',$date_returned['pubdate3']);
$smarty->assign('thudate',$date_returned['pubdate4']);
$smarty->assign('fridate',$date_returned['pubdate5']);
$smarty->assign('satdate',$date_returned['pubdate6']);
$smarty->assign('sundate',$date_returned['pubdate7']);
$smarty->assign('weeks',$date_returned['weeks']);
$smarty->assign('year',$date_returned['years']);
$smarty->assign('plus_weeks',$date_returned['plus_weeks']);

$smarty->assign('bannerSource',$bannerSource);
$smarty->assign('subscribers',$subscribers);
$smarty->assign('quote1',$quote1);
$smarty->assign('quote2',$quote2);
$smarty->assign('quote3',$quote3);
$smarty->assign('quote4',$quote4);
$smarty->assign('quote5',$quote5);
$smarty->assign('quote6',$quote6);


$smarty->assign('pubdate',$pubdate);
$events=get_events_for_day($date_returned['select1']);
$smarty->assign("eventsmon",$events);
$events=get_events_for_day($date_returned['select2']);
$smarty->assign("eventstue",$events);
$events=get_events_for_day($date_returned['select3']);
$smarty->assign("eventswed",$events);
$events=get_events_for_day($date_returned['select4']);
$smarty->assign("eventsthu",$events);
$events=get_events_for_day($date_returned['select5']);
$smarty->assign("eventsfri",$events);
$events=get_events_for_day($date_returned['select6']);
$smarty->assign("eventssat",$events);
$events=get_events_for_day($date_returned['select7']);
$smarty->assign("eventssun",$events);
$events=get_events_for_day($date_returned['select8'],true);
$smarty->assign("eventsfut",$events);
$smarty->display('newsletter.tpl');
?>