 <?PHP
class IREclass   //Iregular Recurring Events
{
private $orgHeader = "Metropolitan Single Professionals";

function setHeader($header)
{
	$this->orgHeader = $header;
}

function getHeader()
{	
return $this->orgHeader;
}
function bumpSqlDate($inDate,$days=1)
{
$this->date_array= explode('-',$inDate);
$this->work_date = mktime(0,0,0,$this->date_array[1],$this->date_array[2]+$days,$this->date_array[0]);
$this->return_date = date('Y',$this->work_date). '-'. date('m',$this->work_date). '-' . date('d',$this->work_date);
$this->new_dow = date('D',$this->work_date);

return array($this->return_date,$this->new_dow);
}
//-----------------------------------------------------------------
function postEvent($place,$event_date,$event_end,$event_resby,$event_org,$ts,$te,$dow,$activity,$media,$price_members,$price_guests,$priority,$title,$confirm)
{
$SQL = "  insert into events
           SET Place = \"$place\",
           Date_from = \"$event_date\",
           Date_to = \"$event_end\",
           Resby = \"$event_resby\",
           Event_org = \"$event_org\",
           Time_start = \"$ts\",
           Time_end = \"$te\",
           DOW = \"$dow\",
		   confirm= \"$confirm\",
           Activity=\"$activity\",
		   media = \"$media\",
           Price_members = \"$price_members\",
           Price_guests = \"$price_guests\",
           Event_open = \"Y\",
           Event_priority = \"$priority\",
		   Event_title = \"$title\",
           SUBMITTED_BY = \"artFest\"
           ";
		   //print ("<br />" . $SQL);
             $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in insert  Email this information to cauleyfrank@gmail.com" . mysql_error() ."<br>". $SQL . "</p>");
          }else{
            Print("Event posted<p>");
        }

}
//-----------------------------------------------------------------
function bldDateEntryShort()
{
	$year_1 = date(Y);
    $year_2 = $year_1 +1;
    $year_3 = $year_1 +2;
    $this_month=date(m);
    $this_day = date(d);
    $this_year = date(Y);
    $timestamp = mktime(0,0,0, (int)$this_month ,(int)$this_day +3 ,(int)$this_year);

    $this_day = date(d,$timestamp);
    $this_month = date(m,$timestamp);;
    $this_year = date(Y,$timestamp);
	return $this_year . "-" . $this_month . "-" . $this_day ;
}
//-----------------------------------------------------------------
function bldDateEntry($prefix,$break=false)
{
 	$year_1 = date(Y);
    $year_2 = $year_1 +1;
    $year_3 = $year_1 +2;
    $this_month=date(m);
    $this_day = date(d);
    $this_year = date(Y);
    $timestamp = mktime(0,0,0, (int)$this_month ,(int)$this_day +3 ,(int)$this_year);

    $this_day = date(d,$timestamp);
    $this_month = date(m,$timestamp);;
    $this_year = date(Y,$timestamp);

    $months= array("January","February","March","April","May","June","July","August","September","October","November","December");
    for ($i=01;$i<13;++$i)
    {
     $i== $this_month  ? $sel="selected" : $sel="";
     $month_option[$i]= $sel . ">" . $months[$i-1];
     //print("<br /> $month_option[$i]");

    }
    for ($j=01;$j<32;$j++)
    {
        $j==$this_day  ? $sel="selected" : $sel="";
        $day_option[$j] = $sel   .' >' . $j;
    }   // print("<br /> $day_option[$j]");



$dateWork='';
$dateWork = "Date " . $prefix . "&nbsp;&nbsp; : \n";
$dateWork .= "<SELECT NAME=\"" . $prefix . "_mm\" SIZE=\"1\ID=\"" .$prefix . "_mm\" onchange=\"copyFromDate()>\"\n";
$dateWork .= "<OPTION VALUE=\"01-\"". $month_option[1]. "\n";
$dateWork .= "<OPTION VALUE=\"02-\"" .$month_option[2]. "\n";
$dateWork .= "<OPTION VALUE=\"03-\"" .$month_option[3]. "\n";
$dateWork .= "<OPTION VALUE=\"04-\"" .$month_option[4]. "\n";
$dateWork .= "<OPTION VALUE=\"05-\"" .$month_option[5]. "\n";
$dateWork .= "<OPTION VALUE=\"06-\"" .$month_option[6]. "\n";
$dateWork .= "<OPTION VALUE=\"07-\"" .$month_option[7]. "\n";
$dateWork .= "<OPTION VALUE=\"08-\"" .$month_option[8]. "\n";
$dateWork .= "<OPTION VALUE=\"09-\"" .$month_option[9]. "\n";
$dateWork .= "<OPTION VALUE=\"10-\"" .$month_option[10]. "\n";
$dateWork .= "<OPTION VALUE=\"11-\"" .$month_option[11]. "\n";
$dateWork .= "<OPTION VALUE=\"12-\"" .$month_option[12]. "\n";	
$dateWork .= "</option>\n";
$dateWork .= "</SELECT>\n";
$dateWork .= $break ? "<br />" : "";
$dateWork .= "<Select NAME = \"". $prefix . "_day\" Size = \"1\" >";
$dateWork .= "<Option value= \"01\"" .$day_option[1] . "\n";
$dateWork .= "<Option value= \"02\"" .$day_option[2] . "\n";
$dateWork .= "<Option value= \"03\"" .$day_option[3] . "\n";
$dateWork .= "<Option value= \"04\"" .$day_option[4] . "\n";
$dateWork .= "<Option value= \"05\"" .$day_option[5] . "\n";
$dateWork .= "<Option value= \"06\"" .$day_option[6] . "\n";
$dateWork .= "<Option value= \"07\"" .$day_option[7] . "\n";
$dateWork .= "<Option value= \"08\"" .$day_option[8] . "\n";
$dateWork .= "<Option value= \"09\"" .$day_option[9] . "\n";
$dateWork .= "<Option value= \"10\"" .$day_option[10] . "\n";
$dateWork .= "<Option value= \"11\"" .$day_option[11] . "\n";
$dateWork .= "<Option value= \"12\"" .$day_option[12] . "\n";
$dateWork .= "<Option value= \"13\"" .$day_option[13] . "\n";
$dateWork .= "<Option value= \"14\"" .$day_option[14] . "\n";
$dateWork .= "<Option value= \"15\"" .$day_option[15] . "\n";
$dateWork .= "<Option value= \"16\"" .$day_option[16] . "\n";
$dateWork .= "<Option value= \"17\"" .$day_option[17] . "\n";
$dateWork .= "<Option value= \"18\"" .$day_option[18] . "\n";
$dateWork .= "<Option value= \"19\"" .$day_option[19] . "\n";
$dateWork .= "<Option value= \"20\"" .$day_option[20] . "\n";
$dateWork .= "<Option value= \"21\"" .$day_option[21] . "\n";
$dateWork .= "<Option value= \"22\"" .$day_option[22] . "\n";
$dateWork .= "<Option value= \"23\"" .$day_option[23] . "\n";
$dateWork .= "<Option value= \"24\"" .$day_option[24] . "\n";
$dateWork .= "<Option value= \"25\"" .$day_option[25] . "\n";
$dateWork .= "<Option value= \"26\"" .$day_option[26] . "\n";
$dateWork .= "<Option value= \"27\"" .$day_option[27] . "\n";
$dateWork .= "<Option value= \"28\"" .$day_option[28] . "\n";
$dateWork .= "<Option value= \"29\"" .$day_option[29] . "\n";
$dateWork .= "<Option value= \"30\"" .$day_option[30] . "\n";
$dateWork .= "<Option value= \"31\"" .$day_option[31] . "\n";
$dateWork .= "</Select>\n";
$dateWork .= $break ? "<br />" : "";
$dateWork .= "<select name=\"" . $prefix . "_year\" size=\"1\" >\n";
$dateWork .= "<OPTION VALUE=\"" .$year_1 . "-\" selected>". $year_1. "\n";
$dateWork .= "<OPTION VALUE=\"" . $year_2 . "-\">". $year_2. "\n";
$dateWork .= "<option value=\"" . $year_3 . "-\">" . $year_3 . "</option>\n";
$dateWork .= "</Select>\n";
return $dateWork;

}//end of bldDateEntry
//-----------------------------------------------------------------
function getContactInfo($xmlFile,$event_org)
{
$xml = simplexml_load_file($xmlFile) or die ("Unable to load file  " . $xmlFile);
//print_r($xml);
$contactReturn ='';
//print ("<br /> looking for " .  $event_org); 
foreach($xml as $con)
{
	
		//print("<br /> orgCode is " . $con->orgCode . " contact is " . $con->orgContact);
	if (trim($con->orgCode) == $event_org)
	{
			
		$contactReturn = $con->orgContact;
		print ("<br org code matched and return set to " .$contactReturn);
	}
}
return $contactReturn;
}
//-----------------------------------------------------------------
function bldActRadio($xmlFile,$llength)// Buld Activity radio buttons
{
$xml =  simplexml_load_file($xmlFile) or die("Unable to load file");
//print_r($xml);
$activityRadio="<p>event type: ";
$lineLengthAllowed=$llength;
$lineLengthUsed=0;
foreach($xml as $act)
{ 
$lineLengthUsed = $lineLengthUsed + strlen($act->activityName);
if($lineLengthUsed > $lineLengthAllowed)
	{
	$lineLengthUsed = 0;
	$activityRadio .= " <br> ";
	}
$activityRadio.="<input type=\"radio\" value=\"" . $act->activityName . "\"name=\"event_type\">" . $act->activityName ;

	
}
$activityRadio .= "<input type=\"radio\" value \" Other \"name=\"event_type\">Other";


return $activityRadio;
}
//-----------------------------------------------------------------
function bldVenueRadio($xmlFile,$allowed)// Build venue radio buttons
{
$lineLengthAllowed=$allowed;
$lineLengthUsed=0;
$xml =  simplexml_load_file($xmlFile) or die("Unable to load file");
$venueRadio="<p>Sites : </p>  <fieldset><br />";
foreach($xml as $site)
{
//echo "<br /> used " . $lineLengthUsed . " allowed " .$lineLengthAllowed;
$lineLengthUsed = $lineLengthUsed + strlen($site->venueName) + 5;
if($lineLengthUsed > $lineLengthAllowed)
	{
	$lineLengthUsed = 0;
	$venueRadio .= " <br> ";
	}
$venueRadio .= "<input type=\"radio\" value=\"" . $site->venueName . "\" name=\"site\" <label>" .$site->venueName .  "</label>";
}
$venueRadio .= "</fieldset>";
return $venueRadio;
}
//-----------------------------------------------------------------
function bldOrgRadio($xmlFile,$ll)// Build org radio buttons
{
$lineLengthAllowed=$ll;
$lineLengthUsed=0;
$xml =  simplexml_load_file($xmlFile) or die("Unable to load file");
$orgsRadio="<p>Orgs : ";
foreach($xml as $org) 
{
$lineLengthUsed = $lineLengthUsed + strlen($org->orgName);
if($lineLengthUsed > $lineLengthAllowed)
	{
	$lineLengthUsed = 0;
	$orgsRadio .= " <br> ";
	}
$orgsRadio .= "<input type=\"radio\" value=\"" . $org->orgCode . "\"name=\"org\">" . $org->orgName ;
}
return $orgsRadio;
}
//-----------------------------------------------------------------

function getActInfo($xmlFile,$actName)
{
$xml =  simplexml_load_file($xmlFile) or die("Unable to load file");
foreach($xml as $site)
{
echo "comparing " . $actName . " with " . $site->activityName  . "<br>";
if ($site->activityName== $actName)
	{
		$actInfo= array(htmlspecialchars($site->title),htmlspecialchars($site->description),htmlspecialchars($site->timeStart),htmlspecialchars($site->timeEnd),htmlspecialchars($site->priceMember,htmlspecialchars($site->priceGuest)));
		
	}
	if ($actName ==  "Other")
	{
		$actInfo = $_POST['event_text'];
		}
	
}
return $actInfo;
}// end of function getActnfo
//-----------------------------------------------------------------
function getSiteInfo($xmlFile,$siteName)
{
$xml =  simplexml_load_file($xmlFile) or die("Unable to load file");
foreach($xml as $site)
{

if ($site->venueName == $siteName)
	{
		$siteInfo= htmlspecialchars($site->venueAddress);
		$siteInfo .= "<br /> ". htmlspecialchars($site->contact);
		
		}
if ($siteName ==  "Other")
	{
		$siteInfo = $_POST['other_site_text'];
		}
	
}
	return $siteInfo;
}// end of function getsiteInfo
//-----------------------------------------------------------------
function getSiteOrg($xmlFile,$siteName)
{
$xml =  simplexml_load_file($xmlFile) or die("Unable to load file");
foreach($xml as $site)
{

if ($site->venueName == $siteName)
	{
		$siteOrg= htmlspecialchars($site->org);
		
		
		}
if ($siteName ==  "Other")
	{
		$siteOrg = $_POST['other_site_text'];
		}
	
}
	return $siteOrg;
}// end of function getsiteOrg
//-----------------------------------------------------------------
function getSiteVenue($xmlFile,$siteName)
{
$xml =  simplexml_load_file($xmlFile) or die("Unable to load file");
foreach($xml as $site)
{

if ($site->venueName == $siteName)
	{
		$siteInfo= htmlspecialchars($site->venueAddress);
		
		
		}
if ($siteName ==  "Other")
	{
		$siteInfo = $_POST['other_site_text'];
		}
	
}
	return $siteInfo;
}// end of function getsiteInfo

//-----------------------------------------------------------------

} // end of class IRE
?>