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
 if ( $_POST['yourpswd'] != "/FJ6r1n11M" ){
    echo("<p> You are not authorized to use this system</P>");
    exit();
}

print("$emonth $eday $eyear $dow<p>");
//$actInfoArray = $ire->getActInfo("artfestActivities.xml",$_POST['event_type']);
//	$activity = $actInfoArray[1];
//	$title = $actInfoArray[0];
//	$price_members = $actInfoArray[4];
//	$price_guests = $actInfoArray[5];
//	$ts= $actInfoArray[2];
//	$te = $actInfoArray[3];
$activity = htmlspecialchars($_POST['event_text']); 
$event_org = $_POST['org'];
$media = htmlspecialchars($_POST['media']);
$title=$_POST['title'];
$priority = $_POST['priority'];   
$place = $_POST['site'] == 'Other' ? htmlspecialchars($_POST['other_site_text']) : $ire->getSiteInfo("tripVenues.xml",$_POST['site']);
$contact = $ire->getContactInfo("tripOrgs.xml",trim($event_org));
//print ("<p> contact is " . $contact . "</p>");
$dateFrom = explode('-',$_POST['date_from']);
$emonth = $dateFrom[1];
$eday = $dateFrom[2];
$eyear=$dateFrom[0]; 
$timestamp=Mktime(0,0,0,$emonth,$eday,$eyear);
$dow = date("D",$timestamp);
$event_date = $_POST['date_from'];
$event_end = $_POST['date_to'] ;
$event_resby = $_POST['resby'] ;
$ts = $_POST['timeStart'];
$te = $_POST['timeEnd'];
$price_members=$price_guests=$_POST['price'];
if(isset($_POST['blogNumber'])&& strlen($_POST['blogNumber'])>0)
{

$activity .= "&lt;a href=&quot;http://www.peggyjostudio.net/wordpress/?p=" . trim($_POST['blogNumber']) . "&quot;&gt;All of the details are here  &lt;/a&gt";
$media .= "&lt;a href=&quot;http://www.peggyjostudio.net/wordpress/?p=" . trim($_POST['blogNumber']) . "&quot;&gt;All of the details are here  &lt;/a&gt";
}
if(isset($_POST['URL'])&& strlen($_POST['URL'])>0)
{

$activity .= "<a href=". $_POST['URL']. "\">Organization web site </a>";
$media .= "<a href=". $_POST['URL']. "\">Organization web site </a>";
}

if($contact !='')
{
	$activity .= "Contact: " . $contact;
	
	if (strlen($media)>0)
		{
			$media .= "Contact: " . $contact;
		}
}
//print("$place</p>");

//$event_date = $eyear ."-" . $emonth ."-" . $eday;
$confirm = $_POST[tripButton] == true ? 'T' : 'Y';
switch($_POST['Generate'])
{
case 'single':
if ($event_end > $event_date)
{
$dow='mul';

}
$ire->postEvent($place,$event_date,$event_end,$event_resby,$event_org,$ts,$te,$dow,$activity,$media,$price_members,$price_guests,$priority,$title,$confirm);
break;

case 'intervening':
$hold_date=$event_end;
$event_end=$event_date;
$ire->postEvent($place,$event_date,$event_end,$event_resby,$event_org,$ts,$te,$dow,$activity,$media,$price_members,$price_guests,$priority,$title,$confirm);
while($event_date < $hold_date)
{
	$bump_return = $ire->bumpSqlDate($event_date,1);
	$event_date =$bump_return[0];
	$event_end = $bump_return[0];
	$dow = $bump_return[1];
	$ire->postEvent($place,$event_date,$event_end,$event_resby,$event_org,$ts,$te,$dow,$activity,$media,$price_members,$price_guests,$priority,$title,$confirm);
}
//while($event_date < $hold_date)
//	{
//	
//	$event_end=$event_date;
//	$ire->postEvent($place,$event_date,$event_end,$event_resby,$event_org,$ts,$te,$dow,$activity,$media,$price_members,$price_guests);
//	$event_date = $ire->bumpSqlDate($event_date,1);
//	}
break;

case'multiDay':
$dow='mul';
$ire->postEvent($place,$event_date,$event_end,$event_resby,$event_org,$ts,$te,$dow,$activity,$media,$price_members,$price_guests,$priority,$title,$confirm);
break;
}

?>
