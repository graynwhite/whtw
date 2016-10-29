<?php
DEFINE('SMARTY_DIR','../phpgacl/admin/smarty/libs/');
require_once(SMARTY_DIR. 'Smarty.class.php');
require_once('../../connect.php');
require_once("../../phpClasses/Class_evententry.php");
require_once("../phpClasses/class_events.php");
require_once("../_private/quotes.php");
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
	
$memberSubscribeButton = "<CENTER><FORM name=ccoptin 
                  action=http://ccprod.roving.com/roving/d.jsp method=post 
                  target=_blank><TABLE borderColor=black cellSpacing=0 cellPadding=3 
                  bgColor=lightyellow border=1 width=100%><TBODY><TR><TD align=middle><FONT face=Verdana,Arial,Helvetica 
                        size=2>Join the <B>Peggy Jo Studio Newsletter</B> mailing list </FONT></TD></TR><TR><TD align=middle><FONT face=Verdana,Arial,Helvetica 
                        size=2><B>Email:</B></FONT> <INPUT size=40 
                        name=ea></INPUT> <INPUT type=hidden value=1011148101198 
                        name=m></INPUT><INPUT type=hidden value=oi 
                        name=p></INPUT><INPUT type=submit value=Go name=go></INPUT> </TD></TR></TBODY></TABLE></FORM></CENTER>";
						
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
	$membershipButton= '';
	break;
	case "archive" :
	$thisHeader=$archiveHeader;
	$googleText= $archiveGoogle;
	$membershipButton= $memberSubscribeButton;
	break;
	case "print" :
	$thisHeader=$archiveHeader;
	$membershipButton= '';
	break;
	default :
	$thisHeader=$draftHeader;
	$googleText="";
	$membershipButton= '';
}

$modeHeader = "<table width=\"819\" border=\"2\" id=\"runHeader\" cellpadding=\"2\" cellspacing=\"0\"> ";	
$modeHeader .= $thisHeader;
$modeHeader .= "</table>";
/*If day is less than tuesday set the edition to -1 unless the edition is set in the command line*/

if(!isset($edition))
{
$edition = date("w") == 1  ? -1 :  0 ;
}
	


$smarty = new smarty;
$smarty->compile_check = True;
$smarty->debugging = True;
$smarty->assign('modeHeader',$modeHeader);
$smarty->assign('googleText',$googleText);
$smarty->assign('membershipButton',$membershipButton);
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
$events=$ev->get_events_for_day($date_returned['select1']);
$smarty->assign("eventsmon",$events);
$events=$ev->get_events_for_day($date_returned['select2']);
$smarty->assign("eventstue",$events);
$events=$ev->get_events_for_day($date_returned['select3']);
$smarty->assign("eventswed",$events);
$events=$ev->get_events_for_day($date_returned['select4']);
$smarty->assign("eventsthu",$events);
$events=$ev->get_events_for_day($date_returned['select5']);
$smarty->assign("eventsfri",$events);
$events=$ev->get_events_for_day($date_returned['select6']);
$smarty->assign("eventssat",$events);
$events=$ev->get_events_for_day($date_returned['select7']);
$smarty->assign("eventssun",$events);
$events=get_events_for_day($date_returned['select8'],true);
$smarty->assign("eventsfut",$events);
$smarty->display('newsletter.tpl');
?>