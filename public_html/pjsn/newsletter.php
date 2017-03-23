<?php
//echo("clearing");
//echo("<h1>starting</h1>");
$debugswitch=$_GET['debug']=='yes' ? 'yes':'no';
$split = $_GET['split']=='yes' ? "yes" : "no";
$sheldon = $_GET['sheldon'] == 'yes' ? "yes" : "no";
$edition=$_GET['edition']==''?"1": $_GET[edition];
echo ("<br />Edition is " . $edition);
$runtype=$_GET['runtype'];
echo ("<br />runtype is " . $runtype);
$emergency=$_GET['e'];
echo ("<br /> emergency is " . $emergency);
echo("<br />Debug is ". $debugswitch);
$split0 = $_SERVER['DOCUMENT_ROOT']."/newsletter/split0.php";
$split1 = $_SERVER['DOCUMENT_ROOT']."/newsletter/split1.php";
$split2 = $_SERVER['DOCUMENT_ROOT']."/newsletter/split2.php";
$split3 = $_SERVER['DOCUMENT_ROOT']."/newsletter/split3.php";
$split4 = $_SERVER['DOCUMENT_ROOT']."/newsletter/split4.php";
if($debugswitch=='yes')echo("<br/> split4 is " . $split4);
$sheldonAd = $_SERVER['DOCUMENT_ROOT']."/newsletter/sheldonAddEven.php";
$articles = $_SERVER['DOCUMENT_ROOT']."/newsletter/articles.php";
$adsenseMobile = $_SERVER['DOCUMENT_ROOT']."/newsletter/adsenseMobile.inc";
$topLinks =$_GET['runtype']=='mobile' ? $_SERVER['DOCUMENT_ROOT']."/newsletter/topLinksMobile.php" : $_SERVER['DOCUMENT_ROOT']."/newsletter/topLinks.php";
if($debugswitch=='yes')echo("<br /> toplinks is ".$topLinks);
$articlesEventsOnly = $_SERVER['DOCUMENT_ROOT']."/newsletter/articlesEventOnly.php";
$blogThisWeek = $_SERVER['DOCUMENT_ROOT']."/newsletter/blogThisWeek.php";
$letters = $_SERVER['DOCUMENT_ROOT']."/newsletter/letters.php";
$gotmustard = $_SERVER['DOCUMENT_ROOT']."/newsletter/gotmustard.php";
$advertising = $_SERVER['DOCUMENT_ROOT']."/newsletter/advertising.txt";
if($debugswitch=='yes')echo("<br />Advertising is ".$advertising);
$linksfile = $_SERVER['DOCUMENT_ROOT']."/newsletter/links.tpl";

$couponsfile = $_GET['coupon'] == 'no' ? $_SERVER['DOCUMENT_ROOT']."/newsletter/noCouponsFile.php" : $_SERVER['DOCUMENT_ROOT']."/newsletter/couponsFile.php" ;

$couponsfile = $runtype=="prod" ? $_SERVER['DOCUMENT_ROOT']."/newsletter/noCouponsFile.php" : $_SERVER['DOCUMENT_ROOT']."/newsletter/couponsFile.php" ;

$prolougefile = $_SERVER['DOCUMENT_ROOT']."/newsletter/prolouge.php";
$successChurch = $_SERVER['DOCUMENT_ROOT']."/newsletter/successInstitute.php";

if($emergency =='yes')
{
	$articles = "../newsletter/emergencyArticles.php";
	$letters = "../newsletter/emergencyLetters.php";
}

DEFINE('SMARTY_DIR','./phpgacl/admin/smarty/libs/');
if($debugswitch=='yes')echo("<br />Articles after emergency test is ".$articles);

require_once("../phpClasses/Class_blog_links.php");
if($debugswitch=='yes')echo("<br />After require class blog links");

$debug_tpl= '../libs/debug.tpl';
if($debugswitch=='yes')echo("<br />debug tpl is ".$debug_tpl);

require_once("connect.php");
if($debugswitch=='yes')echo("<br />After require connect.php");
if($debugswitch=='yes')echo("<br />Going to require class_events.php");

require_once("../phpClasses/class_events.php");
if($debugswitch=='yes')echo("<br />After require class_events.php");

require_once("../phpClasses/Class_evententry.php");
if($debugswitch=='yes')echo("<br />After require Class_evententry.php");


require_once("../newsletter/quotes.php");
if($debugswitch=='yes')echo("<br />After require quotes");
//require_once("../phpClasses/Class_production_control.php");
//$pc = new Class_production_control;
$ee = new eventEntry;
$ev = new events;


$archiveGoogle = "




`
";

if($debugswitch=='yes')echo("<br />ArchiveGoogle is " .$archiveGoogle);

$mobileGoogle =
"
";
if($debugswitch=='yes')echo("<br /> Mobile google before blanking is ".$mobileGoogle);
$mobileGoogle= " "; // added to adds from mobile
$memberSubscribeButton =" <center><form 
				name=\"ccoptin\"
                  action=\"http://ccprod.roving.com/roving/d.jsp\" method=\"post\"
                  target=\"_blank\">
				  <table bordercolor=\"black\"  cellspacing=\"0\" cellpadding=\"3\"
                  bgColor=\"lightyellow\" border=\"1\" width=\"100%\"><tbody><tr><td align=\"middle\"><font face=\"Verdana,Arial,Helvetica\"
                        size=\"2\">Join the <b>Peggy Jo Studio Newsletter</b> mailing list </font></td></tr><tr><td align=\"middle\"><font face=\"Verdana,Arial,Helvetica\"
                        size=\"2\"><b>Email:</></font> <input size=\"40\"
                        name=ea></input> <input type=hidden value=1011148101198
                        name=m></input><input type=hidden value=oi
                        name=p></input><input type=submit value=Go name=go></input>
						 </td></tr></tbody></table></form></center>";
if($debugswitch=='yes')echo("<br /> Member subscribe button is  ".$memberSubscribeButton);

$ee->set_begin_publishing_date("May 30, 2003");
$date_returned= $ee->getNextWeekDay('Mon',$edition);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];
if($debugswitch=='yes')echo("<br />Begin date is ". $begin_date ." End Date is ". $end_date . "publication date is ".$pubdate);

if($runtype=='daily'){
	$begin_date = date("Y" . "-" . "m" . "-" . "d");
}
	$T=mktime(0,0,0,date('n'),date('j'),date('Y'));
	$T+=1*24*60*60;
	 
	$tomorrow = date("Y",$T) . "-" . date("m",$T) . "-" . date("d",$T );
	//echo "<br /> tbegin date changed to " . $begin_date;
	//echo "<br /> tomorrow is  " . $tomorrow;

$weekOfMonth = $ee->getWeekOfTheMonth($begin_date);
if($debugswitch=='yes')echo "<br />week of the month is " . $weekOfMonth	;
$yearsWorked=$date_returned['years'];
if($debugswitch=='yes')echo "<br />Years worked is " .$yearsWorked;
$weekOfYear = $date_returned['plus_weeks'];
if($debugswitch=='yes')echo "<br>Week of year is " . $weekOfYear;

$sheldonAd = "../newsletter/sheldonAddEven.php";
if($debugswitch=='yes')echo "<br />Date array follows <br />";
if($debugswitch=='yes')print_r($date_returned);
if($debugswitch=='yes')echo("<br /> date array above");

$progressValue=0;
$draftColor="#FF0000";
$valuesArray=array(10,2,2,2,10,2,2,5);

//$statusrow = mysql_fetch_array($pcstatus);
$statusHead = "Status :  "  ;

for($i=1;$i<9;$i++){
	
	
	$progressValue= $statusrow[$i]==1 ? $progressValue=$progressValue + $valuesArray[$i] : $progressValue;
	if($debugswitch=='yes')
	{echo("I is " . $i ."progress value is " . $progressValue . "\\");
	}
}
switch ($progressValue){
	
	case "25";
	$draftColor= "#00ff00";
	break;
	case "23";
	$draftColor= "#0099cc";
	break;
	case "21";
	$draftColor= "#2200bb";
	break;
	case "19";
	$draftColor= "#3300aa";
	break;
	case "17";
	$draftColor= "#440099";
	break;
	case "15";
	$draftColor= "#550088";
	break;
	case "13";
	$draftColor= "#660077";
	break;
	case "11";
	$draftColor= "#770066";
	break;
	case "9";
	$draftColor= "#660055";
	break;
	case "7";
	$draftColor= "#770044";
	break;
	case "5";
	$draftColor= "#880033";
	break;
	case "4";
	$draftColor= "#990022";
	break;
	case "2";
	$draftColor= "#aa0011";
	break;
	case "0";
	$draftColor= "#ff0000";
	break;
}
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/Class_blog_links.php");
	$bl2 = new blog_links;
if($debugswitch="yes")echo("<br />After getting blog links");

$events='';

/*
-++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
Set up the banner that runs across the top of the newsletter with either the words Draft in 
big red letters or a blank line depending upon the type or run.
*/
$statusHead .= " Quotes  <input type=\"checkbox\"" ;
$statusHead .= $statusrow['quotesUpdated']==1 ? " checked >" : ">";
$statusHead .= " Articles <input type=\"checkbox\"";
$statusHead .= $statusrow['articlesUpdated']==1 ? " checked >" : ">";
$statusHead .= " Letters <input type=\"checkbox\"";
$statusHead .= $statusrow['lettersUpdated']==1 ? " checked >" : ">";
$statusHead .= " Banner <input type=\"checkbox\"";
$statusHead .= $statusrow['bannerUpdated']==1 ? " checked >" : ">";
$statusHead .= " Advertising  <input type=\"checkbox\"";
$statusHead .= $statusrow['advertisingRotated']==1 ? " checked >" : ">";
$statusHead .= " Wide Ads <input type=\"checkbox\"";
$statusHead .= $statusrow['personalAdvertising']==1 ? " checked >" : ">";
$statusHead .= " Blog Links <input type=\"checkbox\"";
$statusHead .= $statusrow['blogLinks']==1 ? " checked >" : ">";
$statusHead .= " Google Calendar <input type=\"checkbox\"";
$statusHead .= $statusrow['googleProcessed']==1 ? " checked >" : ">";


$prodHeader = "";
$draftHeader = "<tr align=\"center\"><td><strong><font color=\"$draftColor\" size=\"+3\">Draft     Draft Draft     Draft     Draft    Draft    Draft    Draft <br> </font></strong>" ;
$draftHeader .= $statusHead;
$draftHeader .= "</td></tr>";
if($debugswitch=='yes')echo("<br />Draft header is ".$draftHeader);

$archiveHeader = "<tr align=\"center\"><td><strong><font color=\"#FF0000\" size=\"+1\">You can get this newsletter free every Monday Morning in your Email box.<br \/>
Use the sign up form below - it is free</font></strong></td><tr>";

$eventsOnlyHeader = "<tr align=\"center\"><td><strong><font color=\"#FF0000\" size=\"+1\"></font></strong></td><tr>";

if($debugswitch=='yes')echo("<br />Ready to produce header ");
switch ($_GET['runtype'])
{
  	case "daily":
	$thisHeader=$prodHeader;
	$googleText="";
	$membershipButton= '';
	$bl2->set_show_maps(false);
	$bl2->set_show_edit(false);
	break;
	
	case "prod":

	$thisHeader=$prodHeader;
	$googleText="";
	$membershipButton= '';
	$bl2->set_show_maps(false);
	$bl2->set_show_edit(false);
	break;

	case "eventsOnly":
	$thisHeader=$eventsOnlyHeader;
	$googleText= "";
	$membershipButton= "";
	break;

	case "mobile" :
	$thisHeader=$archiveHeader;
	$googleText= $mobileGoogle;
	$membershipButton= $memberSubscribeButton;
	$bl2->set_show_maps(false);
	$bl2->set_show_edit(false);
	
	break;

	case "archive" :
	$thisHeader=$archiveHeader;
	$googleText= $archiveGoogle;
	$membershipButton= $memberSubscribeButton;
	$bl2->set_show_maps(false);
	$bl2->set_show_edit(false);
	break;

	case "advance":
	$thisHeader = $draftHeader;
	$googleText= $archiveGoogle;
	$membershipButton= '';
	break;

	case "print" :
	$googleText="";
	$thisHeader=$archiveHeader;
	$membershipButton= '';
	$bl2->set_show_maps(false);
	$bl2->set_show_edit(false);
	break;
	
	case "edit" :
	$thisHeader=$draftHeader;
	$googleText=" ";
	$membershipButton= ' ';
	$bl2->set_show_edit(true);
	break;
	
	default :
	$thisHeader=$draftHeader;
	$googleText="";
	$membershipButton= '';
	$bl2->set_show_edit(false);
}

$modeHeader = "<table width=\"810\" border=\"2\" id=\"runHeader\" cellpadding=\"2\" cellspacing=\"0\"> ";
$modeHeader .= $thisHeader;
$modeHeader .= "</table>";
if($debugswitch=='yes')echo("<br />Mode header is " .$modeHeader);
/*
End of header logic
-++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

/*If day is less than tuesday set the edition to -1 unless the edition is set in the command line*/

if(!isset($edition))
{$edition = date("w") == 1  ? -1 :  0 ;
}

if ($runtype=="daily")$edition= -1;

if($debugswitch=='yes')echo "edition being set to -1";


//ini_set('display_errors',1);
error_reporting(E_ALL);


echo("<br />Ready to work with smarty");
$debug_tpl = "../libs/debug.tpl";
echo("<br />assigned value to debug_tpl which is  ".$debug_tpl);
require_once("../libs/Smarty.class.php");
$smarty = new smarty;
echo("<br />After new smarty");
$smarty->compile_check = True;
$smarty->debugging = False;
$smarty->assign("debug_tpl",$debug_tpl);
echo("<br />After assigning debug tpl");
$smarty->assign('bannerBackgroundColor',$bannerBackgroundColor);
$smarty->assign('modeHeader',$modeHeader);
$smarty->assign('googleText',$googleText);
echo("<br />After googletext assigned");
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
echo("<br /> After plus weeks assigned");
$smarty->assign('bannerSource',$bannerSource);
$smarty->assign('bannerSourceLeft',$bannerSourceLeft);
$smarty->assign('subscribers',$subscribers);
$smarty->assign('quote1',$quote1);
$smarty->assign('quote2',$quote2);
$smarty->assign('quote3',$quote3);
$smarty->assign('quote4',$quote4);
$smarty->assign('quote5',$quote5);
$smarty->assign('quote6',$quote6);
$smarty->assign('split0',$split0);
$smarty->assign('split1',$split1);
$smarty->assign('split2',$split2);
$smarty->assign('split3',$split3);
$smarty->assign('split4',$split4);
$smarty->assign('pubdate',$pubdate);
if($debugswitch="yes")echo("<br />After assigning pubdate");
$show=True;
			$showMaps= isSet($_GET['maps']) ? $_GET['maps'] : false;
			$showMaps==true ? $bl2->set_show_maps(true) : $bl2->set_show_maps(false);
			$bl2->set_show_bethany_links($show);
			$bl2->set_show_blogs($show);
			$bl2->set_show_pj_message($show);
			$bl2->set_show_media($show);
if($runtype == 'eventsOnly' or $runtype == 'mobile' or $runtype == 'daily')
	{
	$bl2->set_show_advertising(false);
	}else{
	$bl2->set_show_advertising=(true);
	}
if($debugswitch="yes"){
echo("<br />Before getting events for Monday");
echo("<br />Date for Monday is ".$date_returned['select1']);
}

$events=$bl2->get_events_for_day($date_returned['select1'],false,false);
if ($debugswitch="yes")echo("<br />Events for Monday are ".$events);
$smarty->assign("eventsmon",$events);
$events='';
$events=$bl2->get_events_for_day($date_returned['select2'],false,false);
$smarty->assign("eventstue",$events);
$events='';
$events=$bl2->get_events_for_day($date_returned['select3'],false,false);
$smarty->assign("eventswed",$events);
$events='';
$events=$bl2->get_events_for_day($date_returned['select4'],false,false);
$smarty->assign("eventsthu",$events);
$events='';
$events=$bl2->get_events_for_day($date_returned['select5'],false,true);
$smarty->assign("eventsfri",$events);
$events='';
$events=$bl2->get_events_for_day($date_returned['select6'],false,false);
$smarty->assign("eventssat",$events);
$events='';
$events=$bl2->get_events_for_day($date_returned['select7'],false,false);
$smarty->assign("eventssun",$events);
$events='';
$events=$bl2->get_events_for_day($date_returned['select8'],true,false);
$smarty->assign("eventsfut",$events);
$events='';
$events=$bl2->get_events_for_day($begin_date,false);
$smarty->assign("dailyevents",$events);
$events=$bl2->get_events_for_day($tomorrow,false);
$smarty->assign("tomorrowevents",$events);
$smarty->assign("tueThuSatColor",$tueThuSatColor);
$smarty->assign("articles",$articles);
$smarty->assign("topLinks",$topLinks);
$smarty->assign("gotmustard",$gotmustard);
$smarty->assign("articlesEventsOnly",$articlesEventsOnly);
$smarty->assign("blogThisWeek",$blogThisWeek);
$smarty->assign("letters",$letters);
$smarty->assign("adsenseMobile",$adsenseMobile);
$smarty->assign("advertising",$advertising);
$smarty->assign("linksfile",$linksfile);
$smarty->assign("couponsfile",$couponsfile);
$smarty->assign("prolougefile",$prolougefile);
$smarty->assign("successChurch",$successChurch);
$smarty->assign("sheldonAd",$sheldonAd);
echo("Ready to publish");
echo("Runtype is " .$runtype);
echo("Sheldon is " . $sheldon);
if ($sheldon == 'yes')
	{
	{$smarty->display($_SERVER['DOCUMENT_ROOT'].'/templates/newsletterSheldon.tpl');}
	}
	switch($runtype){
	case "daily":
			//$smarty->display($_SERVER['DOCUMENT_ROOT'].'/templates/dailynews.tpl');
			$output = $smarty->fetch($_SERVER['DOCUMENT_ROOT'].'/templates/dailynews.tpl');
			//$outputf="http://www.graypluswhite.com/facebook/pjsntoday/content.php";
			$outputf= "../facebook/pjsntoday/content.php";
			
			file_put_contents($outputf,$output);
			echo $output; 
			break;
	case "eventsOnly" :
			$smarty->display($_SERVER['DOCUMENT_ROOT'].'/templates/eventsOnly.tpl');
			break;
	case "mobile"     :
			$smarty->display($_SERVER['DOCUMENT_ROOT'].'/templates/newslettermobile.tpl');
			break;
	default:
//echo("Split is " . $split);
    if ($split == "yes"){
        $smarty->display($_SERVER['DOCUMENT_ROOT']."/templates/newsletter2split.tpl");
    }
			//echo("ready to display newsletter2.tpl");
			$smarty->display($_SERVER['DOCUMENT_ROOT']."/templates/newsletter2.tpl");

    }
?>
