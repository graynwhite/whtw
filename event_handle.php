
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/phpClasses/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/phpClasses/class_events.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/phpClasses/class_date_utility.php');
//require_once($_SERVER['DOCUMENT_ROOT']. '/phpClasses/convertPhp4GetPost.php');
$password= $_POST['password'];
if(trim($password) !="/FJ6r1n11M" and $_POST['operator'] != 'publicist'){
print("<html><body><h1> You are not authorized to use this function.</h1> </body></html>");
exit();
 }
//print_r($_POST);
$action = $_POST['action'];

/** @package

*/
class validate_event
{
public $foundError = false;
public	$Radio_state = "   ";
public	$re="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$";

function check_dow(){
$fromDayWork = explode('-',$_POST['from_date']);
$fromDayTimestamp=mktime(0,0,0,$fromDayWork[0],$fromDayWork[1],$fromDayWork[2]);
$comDow = date('D',fromDayTimestamp);
if ($_POST['dow']!=$comDow){
	print("The day of week that you selected does not agree with the computed day of week.");
	print ( "\n you selected  "  .$_POST[dow]); 
	print ("\n  however, the computed day of week is " . $comDow);
	print ( "\n  Change the selected day of week or change the date.");
	exit();
	}
	
	
	
}
}// end of class
class insertMultipleRecords
{
	public $begining_date; 
	public $begining_end_date;
	public $final_date;
	public $publication_interval;
	public  $julian_from_date=0;
	public  $julian_to_date=0;
	public $julian_final_date;
	public $date_parts;
	public $from_date;
	public $to_date;
	public $now_from;
	public $now_to;
	public $place;
	public $time_start;
	public $time_end;
	public $confirm;
	public $activity;
	public $media;
	
	function __construct($date_from,$date_to,$final_date,$place,$time_start,$time_end,$confirm,$activity,$media)
	{
		$this->begining_date = $date_from;
		$this->place=$place;
		$this->time_start = $time_start;
		$this->time_end = $time_end;
		$this->confirm=$confirm;
		$this->activity=$activity;
		$this->media=$media;
		$this->media .= "<br /> submitted by: " . $subName;
		$media = $this->media;
		print ("<br /> media is " . $media);
		$this->from_date = $date_from;
		$this->begining_end_date = $date_to;
		$this->to_date= $date_to;
		$this->final_date = $final_date;
		$this->publication_interval = 7;
		$this->date_parts= explode('-',$this->from_date);
		print "<br>";
		print_r($this->date_parts);
		$this->julian_from_date = mktime(0,0,0,$this->date_parts[1],$this->date_parts[2],$this->date_parts[0]);
		$this->date_parts= explode('-',$this->to_date);
		print "<br>";
		print_r( $this->date_parts);
		$this->julian_to_date = mktime(0,0,0,$this->date_parts[1],$this->date_parts[2],$this->date_parts[0]);
		$this->date_parts= explode('-',$this->final_date);
		print "<br>";
		print_r($this->date_parts);
		$this->julian_final_date = mktime(0,0,0,$this->date_parts[1],$this->date_parts[2],$this->date_parts[0]);
		

	}
	private function bumpDates()
	{
		//print "<br>entering bump dates ";
		$this->julian_from_date = $this->julian_from_date  + ($this->publication_interval *86400);
		$this->julian_to_date = $this->julian_to_date + ($this->publication_interval *86400);
		
		$this->now_from= date('Y',$this->julian_from_date) . '-' . date('m',$this->julian_from_date) . "-" . date('d',$this->julian_from_date);
		$this->now_to= date('Y',$this->julian_to_date) . '-' . date('m',$this->julian_to_date) . "-" . date('d',$this->julian_to_date);
		 
	}
    function generateEvents()
	{
		//print ("<br /> Events will be generated ");
		print ("<br /> An event will be generated for " . $this->begining_date . " to " .$this->begining_end_date);
		insertRecord($this->place,$this->begining_date,$this->time_start,$this->time_end,$this->begining_end_date,$this->begining_end_date,$this->confirm,$this->activity, $this->media);
		$this->bumpDates();
		
		while ($this->julian_to_date <= $this->julian_final_date)
		{
		print("<br /> Another event will be generated for " . $this->now_from . " to " .$this->now_to);
		insertRecord($this->place,$this->now_from,$this->time_start,$this->time_end,$this->now_to,$this->now_from,$this->confirm,$this->activity, $this->media);
		$this->bumpDates();
		} 
	}
}// end of class insert Multiple Records

function insertRecord($place,$date_from,$time_start,$time_end,$date_to,$resby,$confirm,$activity,$media)
{
global $conn;
 $sql= "
         insert into events
         SET Place = \"$place\",
         Event_org= \"" . $_POST['Org'] . "\",
		 Date_from =\"$date_from\",
         Time_start = \"$time_start\",
         Time_end = \"$time_end\",
        Date_to =\"$date_to\",
        Resby = \"$resby\",
        Activity = \"$activity\",
		media = \"$media\",
		Dow = \"" . $_POST['dow'] ."\",
        Price_members = \"" . $_POST['Price_Member'] ."\",
        Price_guests = \"" . $_POST['Non_Member_Price'] ."\",
        Event_open= \"" . $_POST['Event_type'] ."\",
		Event_title= \"" . $_POST['event_title'] ."\",
        Event_priority = \"" . $_POST['Event_priority'] ."\",
		SUBMITTED_BY=  \"" . $_POST['emailid'] .  "\",
		confirm= \"$confirm\" ";
		
		

          $result = mysqli_query($conn,$sql);
		  
          if (!$result) {
          echo("<p> Error in Insert a record    Email this information to cauleyfrank@gmail.com<br>" . mysqli_error($conn) . "\n" . $sql  ."</p>");
		  exit();
          }
		  
}

function add_end($in,$endChar)
{
	$work = trim($in);
	/*print "work is " . $work . "<br>";
	print "in is " . $in . "<br>";
	print "EndChar is " . $endChar . "<br>";*/
	$last_character = substr($work,strlen($work)-1,1);
	if($last_character == $endChar)
	{
		$work = $work . ' ';
	}else
	{
		$work = $work . $endChar . ' ';
		
	}
	return $work;
	
}

print "<html>";

print "<head>";
print "<Title>Club Event Maintenance update</title>";
print "</head>";

print "<body>";

print "<p><font size=\"7\"><b>Event Maintenance</b></font></p>";
print"<hr>";
/*print "operator is " . $operator;*/
//require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/connect.php");
/*print "<br>loaded connect";*/
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/dateClass.php");
/*print "<br>loaded dateClass";*/
require_once($_SERVER['DOCUMENT_ROOT']."/phpClasses/Class_orgs.php");
/*print "<br>loaded class_orgs";*/
/*===============================================================================================*/ 
if($_POST['operator'] == "Admin")
{
//require_once("../../cron.php");
//print "<br>loaded cron ";
$bodyText = " Beginning of Bodytext<br>";
/*print_r($_POST);*/
$action = $_POST['action'];
print "<br>The action is  " . $_POST['action'];

}
/*===============================================================================================*/ 
if (strtolower($_POST['action']) == 'addremote')
{
 print("<p> Remotely submitted record will be inserted </p>");
 
 		$date_from = $_POST['From_date'] ;
		
		$date_to = $_POST['date_to'] ;
		
		$resby = $_POST['reserve_by'] ;
		$time_start = $_POST['time_start'] ;
		$time_end = $_POST['time_end'];
		$confirm=$_POST['confirm'];
		$place = htmlentities($_POST['place']);		
	
			
		print ("<br> place is " . $place);
		$activity = htmlentities($_POST['activity']) ;
		//if(strlen($_POST['activity_contact'])>0)
//			{
//			$activity .= "Contact: " . $_POST['activity_contact'];
//			}
		$media = htmlentities($_POST['media']);
		$media .= "<br /> Submitted by: " . $_POST['subName'];
		
			if(strlen($activity) <1)
			{
				$activity = $_POST['event_title'];	
			}
			
		insertRecord($place,$date_from,$time_start,$time_end,$date_to,$resby,$confirm,$activity, $media);	
}			
/*===============================================================================================*/ 
if (strtolower($_POST['action']) == 'add')
{
print ("<p> Record will be validated </p>");
/*$dowCorrect = checkDow();
If ($dowCorrect){
 print("<p> Record will be inserted </p>");
*/ 
 		$date_from = $_POST['From_year'] . $_POST['From_mm'] . $_POST['From_day'];
		$date_to = $_POST['To_year'] . $_POST['To_mm'] . $_POST['To_day'];
		$resby = $_POST['Reserve_year'] . $_POST['Reserve_mm'] . $_POST['Reserve_day'];
		/*print "date to is " . $date_to . " date from is " . $date_from . "  reserve = " . $resby ."<br />" ;*/
		$date_to = $date_to == "        "   ? $date_from : $date_to;
		$resby = $resby == "         "  ? $date_from : $resby;
		
	/*	print "date to is " . $date_to . " date from is " . $date_from . "  resby  = " . $resby ."<br />" ;*/
		$time_start = $_POST[Start_Time_Hours] . $_POST[Start_Time_Minutes] .$_POST[Start_AMPM];
		$time_end = $_POST['To_Time_Hours'] . $_POST['To_Time_Minutes'] . $_POST['To_AMPM'];
		
		if ($_POST['To_Time_Hours'] == '  ') $time_end= "    ";
		$time_Start = $time_start == ' ' ? '7:00 PM' : $time_start;
		$confirm='N';
		if ($_POST['operator'] == 'admin')  // this is a hidden field passed from calling prograsm
		{
		$confirm= 'Y';
		}else 
		{
		$confirm= 'N';
		}
		
		if ($_POST['specialOption'] == 'Trip')
		{
			$confirm= 'T';
		}
		if ($_POST['specialOption'] == 'Reunion')
		{
			$confirm= 'R';
		}
		if ($_POST['specialOption'] == 'Golf')
		{
			$confirm= 'G';
		}
		/*Start constructing the Place Field*/
				
		
		$place = add_end($_POST[place_name],'.');
		
	
		# if the address is present add it if it does not end with a comma add the comma
		if (strlen($_POST[place_address] > 0))
		{
			$place .= add_end($_POST[place_address],',');
		}
		# if the city  is present add it if it does not end with a comma add the comma
		if (strlen($_POST[city] ) > 0)
		{
			$place .= add_end($_POST[city],',') . $_POST[state] ;
		}
		# if the zip   is present add it if it does not end with a comma add the comma
		if (strlen($_POST[zip] ) > 0)
		{
			$place .= ' ' . $_POST[zip];
		}
		# if the phone number   is present add it if it does not end with a comma add the comma
		if (strlen($_POST[phone] ) > 0)
		{
			$place .= ' ' . $_POST[phone];
		}
		# if the url    is present add it if it does not end with a comma add the comma
		if (strlen($_POST[url] ) > 0)
		{
			$place .= ' web ' . $_POST[url];
		}
		# if the email    is present add it if it does not end with a comma add the comma
		if (strlen($_POST[place_email] ) > 0)
		{
			$place .= ' Email  ' . $_POST[place_email];
		}
		# if the Directions    is present add it if it does not end with a comma add the comma
		if (strlen($_POST[directions] ) > 0)
		{
			$place .= ' ' . add_end($_POST[directions],'.');
		}
		print ("<br> place is " . $place);
		$activity =  $_POST['activity'] ;
		if(strlen($_POST['activity_contact'])>0)
			{
			$activity .= "Contact: " . $_POST['activity_contact'];
			}
		$media = $_POST['media'];
		if(strlen($_POST['blogNumber'])> 1)
		{
			if($_POST['BlogEntryType'] == 'post')
			{
				$blogpointer = '?p=';
			}else{
				$blogpointer= '?page_id=';
			}
			
			if(strlen($activity) <1)
			{
				$activity = $_POST['event_title'];	
			}
			
			$activity .=  " &lt;a href=&quot;http://www.peggyjostudio.net/wordpress/" . $blogpointer .  $_POST['blogNumber'] . " &quot;&gt;All of the details are here  &lt;/a&gt; ";
			
			
			if (strlen($media)<1)
			{
				$media = $_POST['event_title'] ;
			}
			
			$media .= " &lt;a href=&quot;http://www.peggyjostudio.net/wordpress/". $blogpointer . $_POST['blogNumber'] . " &quot;&gt;All of the details are here  &lt;/a&gt; ";
		} 
		//print ("<br> the length of final end date is " . strlen($_POST['finalEndDate']));
		if(strlen($_POST['finalEndDate'])>1)
		{
		print "multiple entries will be generated";
		$A = new insertMultipleRecords($date_from,$date_to,$_POST['finalEndDate'],$place,$time_start,$time_end,$confirm,$activity,$media);
		$A->generateEvents();
		}else
		{insertRecord($place,$date_from,$time_start,$time_end,$date_to,$resby,$confirm,$activity, $media);
        }
//} // end of checkdow          
}
/*===============================================================================================*/  
  //print("<br> At blog reference and action is $action ");
 if (trim($_POST['action']) == "blog_reference")
 {
    //print("<br> In blog reference");
 	$_POST['activity']  .= " &lt;a href=&quot;http://www.peggyjostudio.net/wordpress/?p=" . trim($_POST['blog_number']) . "&quot;&gt;All of the details are here  &lt;/a&gt; ";
	$sql = "update events set Activity = \"" . $_POST['activity'] . "\" where Event_number = \"" . $_POST['event'] . "\" ";
	//print ( "<br>  sql  = " . $sql);
	$result = mysql_query($sql);
	if (!$result){
		trigger_error("	Record not updated  " . " " . $sql . " " . mysql_error());
		exit;
		}
	
 }
 
/*===============================================================================================*/ 
 if ($_POST['action'] == 'blogit')
 {
 	$trow = $a->get_an_event($event);
	$message_text = '';
	$mail= new phpmailer();
	if (isset($_POST['blogAuthor'])){
	$message_text .= " author:" .$_POST['blogAuthor'] ;
	}
	if (isset($_POST['blogDelay'])){
	$message_text .= " delay:" .$_POST['blogDelay'] ;
	}
	if (isset($_POST['blogCategory'])){
	$message_text .= " Subject : " .$_POST['blogCategory'] . " " ;
	}
	$message_text .= ':start ' . $trow[0] . ' :end ' ;
	print("<br>This event will be sent to the blog<br>");
	print ("<br> $trow[0] <br><br>");
	$mail->Subject = $trow[3];
	$mail->From='cauleyfrank@gmail.com';
	$mail->FromName = 'Webmaster';
	$mail->Body = $message_text;
	$mail->ClearAddresses();
	$mail->AddAddress('cppgejm7@graypluswhite.com');
	$mail->AddAddress('cauleyfj@graypluswhite.com');
	 //set the subject of the message
	//print ("<br> " .$message_text );
	
	 if ( !$mail->Send() ){
							print ('<br>Mail failed sending to  Wordpress');
							print('<br> From webmaster');
							print('<br> Subject Sending to the blog');
							}else{
							print("<b>Mail sent successfully from the webmaster");  					
						   }
	exit;
}


/*===============================================================================================*/ 
 if ($_POST['action']  == 'referBack')
 {
 	  $SQL = " update events set media = \"" . $_POST['actionPhrase'] . "\" where Event_number  = \"" .$_POST['event_id'] ."\" ";
	$result = mysql_query($SQL);
	if (!$result){
		trigger_error("	Records not deleted " . " " . $sql . " " . mysql_error());
		exit;
		}
 
 }
   /*===============================================================================================*/ 
 if ($_POST['action']  == 'deleteAfterNumber')
 {
 	  $SQL = " delete from events where Event_org  = \"" . $_POST['Event_org'] . "\" && Event_number  > \"" . $_POST['actionPhrase']. "\"";
	$result = mysqli_query($conn,$SQL);
	if (!$result){
		trigger_error("	Records not deleted " . " " . $SQL . " " . mysql_error());
		exit;
		}
 
 }
  /*===============================================================================================*/ 
 if ($_POST['action'] == 'makeLower')
 {
 if ($_POST['phraseLocation']== 'place')
 	{
 	$_POST['place'] = strtolower($_POST['place']);
	}
 if ($_POST['phraseLocation']== 'activity')
 	{
 	$_POST['activity'] = strtolower($_POST['activity']);
	}
 if ($_POST['phraseLocation']== 'media')
 	{
 	$_POST['media'] = strtolower($_POST['media']);
	}
 }
 
 /*===============================================================================================*/
 if ($_POST['action'] == 'deleteAfterDate')
 {
 	  $SQL = " delete from events where Event_org  = \"" .$_POST['Event_org'] ." \" && Date_from > \"" . $_POST['actionPhrase'] ."\" ";
	$result = mysql_query($SQL);
	if (!$result){
		trigger_error("	Records not deleted " . " " . $sql . " " . mysql_error());
		exit;
		}
 
 }

 /*===============================================================================================*/
 if ($_POST['action'] == 'genprod')
 {
 	$dchange = new entryControlDate;
	$dorg= new orgs;
	$Orgname = $dorg->getOrgName($Event_org);
	
	$EntryDate = $dchange->get_post_date();
	print "<br> EntryDate is  " . $EntryDate;
	$RecordID = time();
 	print "<br> RecordID = " . $RecordID ;
	$product_name = "Advanced Sale Ticket for an Event";
	$start_array = explode('-',$date_from);
		if (strlen($start_array[1])<2) {
			$start_array[1] = '0' . $start_array[1];
			}
		if (strlen($start_array[2])<2) {
			$start_array[2] = '0' . $start_array[2];
			}
	$sku = $Event_org . $start_array[0] . $start_array[1]. $start_array[2];
	print "<br> product name  : " .$product_name;
	print "<br> sku is : " . $sku;
	$findollar= '$';
	$dollar_sign_present = strpos($price_members,$findollar);
	print "<br> dollar sign found at " . $dollar_sign_present;
	
	if($dollar_sign_present === true || substr($price_members,0,1)=='$') {
	 $price_members = substr($price_members,1); 
	 }
	print "<br> price members " . $price_members;
	print "<br> discount percent  " . $discount_percent;
	$unit_price = $price_members * $discount_percent;
	if ($unit_price < 1.00){
		trigger_error("unit price is incorect" . $unit_price);
		exit();
		}
	print "<br> unit price " . $unit_price;
	print "<br> inventory is " . $inventory;
	$category = "Tickets";
	$description = '<b>' .$Orgname. "</b>" . "</br> Date of event " . $date_from . "</br>" . $activity . " </br></br>location is " . $place;
	print "<br> category is " . $category;
	print "<br> description is : " . $description;
	$sql= "insert into paypal_products set EntryDate = \"$Entry_date\", 
					RecordID=\"$RecordID\",
					product_name = \"$product_name\",
					sku = \"$sku\",
					unit_price = \"$unit_price\",
					category = \"$category\",
					subcategory = \"$subcategory\",
					description = \"$description\",
					subcategory = \"  \",
					inventory = \"$inventory\" ";
	$result = mysql_query($sql);
	if (!$result){
		trigger_error("	Record not added". mysql_error());
		}			
	exit;
 }
 /*===============================================================================================*/
 if ($_POST['action'] == "sameDateNextYear") {
 $bodyText = "<h3> Event will be changed to next years Date.</h3>";
 $dchange = new entryControlDate;
 $next_years_date = $dchange->makeSameDateNextYear($_POST['date_from']);
 print "<br> Next years date is " . $next_years_date ;
 $_POST['activity']=htmlentities($_POST['activity']);
 $sql= " update events
     SET Place = \"" .htmlentities($_POST['place']) ."\",
	 	 media = \"" . htmlentities($_POST['media']) . "\",	
         Event_org =\"" . $_POST['Event_org'] . "\", 
         Date_from =\"$next_years_date\",
         Time_start = \"" .$_POST['time_start']. "\",
         Time_end= \"" . $_POST['end_time']. "\",
        Event_open = \"" . 1 . "\", 
        Date_to =\"$next_years_date\",
        Resby= \"$next_years_date\",
        Dow = \"" . $_POST['dow'] . "\",
        Activity= \"" .htmlentities($_POST['activity']) . "\",
		media = \"" .htmlentities($_POST['media']) ."\",
        Price_members=\"" . $_POST['price_members'] ."\",
        Price_guests = \"" . $_POST['price_guests'] . "\",
        Event_open=\"" . $_POST['event_open'] . "\",
        Event_priority=\"" . $_POST['event_priority'] . "\",
		needsReview = 1 ,
		Event_title = \"" . $_POST['event_title'] . "\",
		SUBMITTED_BY= \"" . $_POST['submitted_by'] . "\",
        confirm = \"Y\"
        where Event_number = \"" . $_POST['event_id'] . "\"
           ";  
		    $result = mysqli_query($conn,$sql);
          if (!$result) {
          echo("<p> Error in update  Email this information to cauleyfrank@gmail.com <br />"  . $sql . "<br />".  mysqli_error($result) . "</p>");
          }  
 $bodyText  .= "<br> Rows affected = " . mysqli_affected_rows($conn); 	  
	print $bodyText;
    print "<br>End of processing";
    exit;
 }
 /*===============================================================================================*/
 if ($_POST['action'] == "sameExactDateNextYear") {
 $bodyText = "<h3> Event will be changed to next years Exact Date.</h3>";
 $dchange = new entryControlDate;
 $next_years_date = $dchange->makeSameExactDateNextYear($_POST['date_from']);
 print "<br> Next years date is " . $next_years_date[0] . " and the day of the week is " . $next_years_date[1]  ;
 $_POST['activity']=htmlentities($_POST['activity']);
 $sql= " update events
     SET Place = \"" .htmlentities($_POST['place']) ."\",
	 	 media = \"" . htmlentities($_POST['media']) . "\",	
         Event_org =\"" . $_POST['Event_org'] . "\", 
         Date_from =\"$next_years_date[0]\",
         Time_start = \"" .$_POST['time_start']. "\",
         Time_end= \"" . $_POST['end_time']. "\",
        Event_open =\"1\", 
        Date_to =\"$next_years_date[0]\",
        Resby= \"$next_years_date[0]\",
        Dow = \"$next_years_date[1]\",
        Activity= \"" .$_POST['activity'] . "\",
		media = \"" .$_POST['media'] ."\",
        Price_members=\"" . $_POST['price_members'] ."\",
        Price_guests = \"" . $_POST['price_guests'] . "\",
        Event_open=\"" . $_POST['event_open'] . "\",
        Event_priority=\"" . $_POST['event_priority'] . "\",
		needsReview = 1 ,
		Event_title = \"" . $_POST['event_title'] . "\",
		SUBMITTED_BY= \"" . $_POST['submitted_by'] . "\",
        confirm = \"Y\"
        where Event_number = \"" . $_POST['event_id'] . "\"
           ";  
		    $result = mysqli_query($GLOBALS['conn'],$sql);
          if (!$result) {
          echo("<p> Error in update  Email this information to cauleyfrank@gmail.com"  . $sql . mysqli_error($GLOBALS['conn']) . "</p>");
          }  
 $bodyText  .= "<br> Rows affected = " . mysqli_affected_rows($GLOBALS['conn']); 	  
	print $bodyText;
    print "<br>End of processing";
    exit;
 }
 /*===============================================================================================*/
 if ($_POST['action'] == "change" || $_POST['action'] == 'makeLower' ) {
 	global $conn;
 	/*if($_POST['Event_org']=='HOL'){
		$_POST['activity']=htmlentities($_POST['activity']);
	}*/
  /*print "<br>at change routine";*/
  print "<br> Record will be changed ";
  $sql= "  update events
     SET Place = \"" . htmlentities($_POST['place']) ."\",
	 	 media = \"" . htmlentities($_POST['media']) . "\",	
         Event_org =\"" . $_POST['Event_org'] . "\", 
         Date_from =\"" . $_POST['date_from'] . "\",
         Time_start = \"" . $_POST['time_start'] . "\",
         Time_end= \"" . $_POST['end_time'] ."\",
        Event_open = \"1\", 
        Date_to =\"" . $_POST['date_to'] . "\",
        Resby= \"" . $_POST['resby'] . "\",
        Dow = \"" . $_POST['dow'] . "\",
        Activity= \"" . htmlentities($_POST['activity']) . "\",
		Price_members=\"" . $_POST['price_members'] . "\",
        Price_guests = \"" . $_POST['price_guests'] . "\",
        Event_open=\"" . $_POST['event_open'] . "\",
        Event_priority=\"" . $_POST['event_priority'] . "\",
		Event_title = \"" . $_POST['event_title'] . "\",
		SUBMITTED_BY= \"" . $_POST['submitted_by'] . "\",
		needsReview= \"" . $_POST['needsReview'] . "\",
        confirm = \"" . $_POST['confirm'] . "\"
        where Event_number = \""  . $_POST['event_id'] . "\"
            ";   
          $result = mysqli_query($GLOBALS["conn"],$sql);
          if (!$result) {
          echo("<p> Error in update  Email this information to cauleyfrank@gmail.com" . "<br>" . $sql . mysqli_error() . "</p>");
		  exit;
          }
 }
 /*===============================================================================================*/
 if ($_POST['action'] == "copyHence"){
         print("<p> Record will be copied to a future date number of days hence " . $_POST['bumpDays'] . "</p>");
		 $dchange = new entryControlDate;
		 $newCopyToDate = $dchange->bumpDate($_POST['copyToDate'],$_POST['bumpDays']);
 		 $NewDow = $newCopyToDate[1];
		 $_POST['activity']=htmlentities($_POST['activity']);
         $SQL= "
         insert into events
         SET Place = \"" . htmlentities($_POST['place']). "\",
         Event_org= \"" . $_POST['Event_org']. "\",
		 
         Date_from =\"" . $newCopyToDate[0]  . "\",
         Time_start = \"" . $_POST['time_start'] . "\",
         Time_end= \"" . $_POST['time_end'] . "\",
        Date_to =\"" . $newCopyToDate[0]  . "\",
        Resby= \"" . $newCopyToDate[0]  . "\",
        Dow = \"" . $NewDow . "\",
        Activity= \"" . htmlentities($_POST['activity']) . "\",
		media = \"" . htmlentities($_POST['media']) . "\",
        Price_members=\"" . $_POST['price_members'] . "\",
        Price_guests = \"" . $_POST['price_guests'] . "\",
        Event_open=\"" . $_POST['event_open']. "\",
		SUBMITTED_BY= \"" . $_POST[submitted_by] . "\",
		Event_title= \"" . $_POST['event_title'] . "\",
        Event_priority=\"" . $_POST['event_priority'] . "\" ";
//print ("<br>$SQL");
          $result = mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }
}		  
		
 /*===============================================================================================*/
 if ($_POST['action'] == "copy"){
         print("<p> Record will be copied to " . $_POST['copyToDate'] . "</p>");
		 $_POST['activity']=htmlentities($_POST['activity']);
		 $_POST['media']=htmlentities($_POST['media']);
		 $dchange = new entryControlDate;
 		 $NewDow = $dchange->makeCopyDate($_POST['copyToDate']);
         $sql= "
         insert into events
         SET Place = \"" . $_POST['place']. "\",
         Event_org= \"" . $_POST['Event_org']. "\",
		 
         Date_from =\"" . $_POST['copyToDate'] . "\",
         Time_start = \"" . $_POST['time_start'] . "\",
         Time_end= \"" . $_POST['date_to'] . "\",
        Date_to =\"" . $_POST['copyToDate'] . "\",
        Resby= \"" . $_POST['copyToDate'] . "\",
        Dow = \"" . $NewDow . "\",
        Activity= \"" . $_POST['activity'] . "\",
		media = \"" . $_POST['media'] . "\",
        Price_members=\"" . $_POST['price_members'] . "\",
        Price_guests = \"" . $_POST['price_guests'] . "\",
        Event_open=\"" . $_POST['event_open']. "\",
		SUBMITTED_BY= \"" . $_POST['submitted_by'] . "\",
		Event_title= \"" . $_POST['event_title'] . "\",
        Event_priority=\"" . $_POST['event_priority'] . "\" ";
//print ("<br>$SQL");
          $result = mysqli_query($conn,$sql);
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }
}		  
		

/*===============================================================================================*/		  
  if ( $_POST['action'] == "delete" ){
        print("<p> Record will be deleted </p>");
        $sql = " delete from events where Event_number = \"" . $_POST['event_id'] . "\" ";

         $result = @mysqli_query($conn,$sql);
          if (!$result) {
          echo("<p> Error in delete   Email this information to cauleyfrank@gmail.com" . mysqli_error() . "</p>");
          }

}
/*===============================================================================================*/
 if ( $_POST['action'] == "deleteOld" ){
        print("<p> Old Records will be deleted </p>");
		$now_date = date("Y") . "-" . date("m") . "-" . date("d");
		
        $sql = " delete from events where Event_org  = \"" . $_POST['Event_org'] . "\" && Date_from < \"$now_date\" && Date_to < \"$now_date\" ";
	 		
         $result = @mysqli_query($conn,$sql);
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }

}
/*===============================================================================================*/
 if ( $_POST['action'] == "clearOrg" ){
        print("<p> All records except unconfirmed records will be cleared. </p>");
		
		
        $sql = " delete from events where Event_org  = \"" . $_POST['Event_org'] . "\" && confirm = \"Y\" ";

         $result = @mysqli_query($sql);
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }

}
/*===============================================================================================*/
	// Does not delete non-confirmed events. Which are events submitted by organization publicists
	if ($_POST['action'] == "deleteByPhraseTest"){
	$bodyText = "<br> <h3>Delete by phrase test</h3> ";
	$sql = "select * from events  Where Event_org = \"" . $_POST['Event_org'] . "\"";
	$sql .= " && " . $_POST['phraseLocation']  . " like \"%" . $_POST['actionPhrase'] . "%\"";
	$sql .= " && confirm = \"Y\" ";
	$sql .= " order by Date_from ";
	print "<br> " . $sql;
	$result = mysqli_query($conn,$sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	while ($row=mysql_fetch_assoc($result)){
	$bodyText .= "<br><br> " . $row['Date_from'] . " " . $row['Place'] . "<br> " . $row['Activity'] ;
	}
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
	/*===============================================================================================*/
	// Does not delete non-confirmed events. Which are events submitted by organization publicists
	if ($_POST['action'] == "deleteByPhraseActual"){
	$bodyText = "<br> <h3>Delete by phrase actual</h3> ";
	$sql = "delete from events  Where Event_org = \"" .$_POST['Event_org'] . "\"";
	$sql .= " && " . $_POST['phraseLocation'] . " like \"%" . $_POST['actionPhrase'] . "%\"";
	$sql .= " && confirm = \"Y\" ";
	$result = mysqli_query($conn,$sql);
	if (!$result) {
          echo("<p> Error in Delete   Email this information to cauleyfrank@gmail.com" . mysql_error() . "<br>");
	 exit;
	 }
	$bodyText  .= "<br> Rows affected = " . mysqli_affected_rows(); 	  
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
/*===============================================================================================*/
	if ($_POST['action'] == "updateByPhraseTest"){
	$bodyText = "<br> <h3>Update by phrase test</h3> ";
	$sql = "select * from events  Where Event_org = \"" . $_POST['Event_org'] . "\"";
	$sql .= " && " . $_POST['phraseLocation'] . " like \"%" . $_POST['actionPhrase'] . "%\"";
	$sql .= " order by Date_from ";
	print "<br> " . $sql;
	$result = mysqli_query($conn,$sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	while ($row=mysqli_fetch_assoc($result)){
	$bodyText .= "<br><br> " . $row['Date_from'] . " " . $row['Place'] . "<br> " . $row['Activity'] ;
	}
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
/*===============================================================================================*/
 if ( $_POST['action'] == "changeDOW" ){
 	$bodyText = "<br> <h3>Change Day of Week</h3> ";
	$sql = "update  events ";
	$sql .= " set  Dow = \"" . $_POST['newDOW'] . "\" "; 
	$sql .= " Where Event_org = \"" . $_POST['Event_org'] . "\"";
	$sql .= " && Dow = \"" . $_POST['oldDOW'] . "\"";
	print "<br> " . $sql;
	$result = mysqli_query($conn,$sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
		  }
 
 }	
/*===============================================================================================*/
	if ($_POST['action'] == "updateByPhraseActual"){
	if ($_POST['phraseLocation'] == 'Place')
		{
		$newphrase = $_POST['place'];
		} elseif ($_POST['phraseLocation'] == 'media'){
		$newphrase = $_POST['media']; 
		} else{
		$newphrase = $_POST['activity'];
		}
	$bodyText = "<br> <h3>Update by phrase actual</h3> ";
	$sql = "update  events ";
	$sql .= " set " .  $_POST['phraseLocation'] . " = \" $newphrase\" "; 
	$sql .= " Where Event_org = \"" . $_POST['Event_org'] . "\"";
	$sql .= " && " . $_POST['phraseLocation'] . " like \"%" . $_POST['actionPhrase'] . "%\"";
	print "<br> " . $sql;
	$result = mysqli_query($conn,$sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
/*===============================================================================================*/
	if ($_POST['action'] == "memberPrice"){
	if ($_POST['phraseLocation'] == 'Place')
		{
		$newphrase = $_POST['place'];
		} elseif ($_POST['phraseLocation'] == 'media'){
		$newphrase = $_POST['media']; 
		} else{
		$newphrase = $_POST['activity'];
		}
	
	$bodyText = "<br> <h3>Update member Price</h3> ";
	$sql = "update  events ";
	$sql .= " set  Price_members = \"$_POST[newPrice]\" "	; 
	$sql .= " Where Event_org = \"" .$_POST['Event_org'] ."\"";
	$sql .= " && " . $_POST['phraseLocation'] . " like \"%" . $_POST['actionPhrase'] . "%\"";
	print "<br> " . $sql;
	$result = mysqli_query($conn,$sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
/*===============================================================================================*/
	if ($_POST['action'] == "guestPrice"){
	if ($_POST['phraseLocation'] == 'Place')
		{
		$newphrase = $_POST['place'];
		} elseif ($_POST['phraseLocation'] == 'media'){
		$newphrase = $_POST['media']; 
		} else{
		$newphrase = $_POST['activity'];
		}
	
	$bodyText = "<br> <h3>Update Guest Price</h3> ";
	$sql = "update  events ";
	$sql .= " set  Price_guests = \"$_POST[newPrice]\" "	; 
	$sql .= " Where Event_org = \"" . $_POST['Event_org']. "\"";
	$sql .= " && " . $_POST['phraseLocation'] . " like \"%" . $_POST['actionPhrase'] . "%\"";
	print "<br> " . $sql;
	$result = mysqli_query($conn,$sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
/*===============================================================================================*/
	if ($_POST['action'] == "changeTitle"){
	if ($_POST['phraseLocation'] == 'Place')
		{
		$newphrase = $_POST['place'];
		} elseif ($_POST['phraseLocation'] == 'media'){
		$newphrase = $_POST['media']; 
		} else{
		$newphrase = $_POST['activity'];
		}
	
	$bodyText = "<br> <h3>Update Title </h3> ";
	$sql = "update  events ";
	$sql .= " set  Event_title  = \"$_POST[event_title]\" "	; 
	$sql .= " Where Event_org = \"" . $_POST['Event_org'] . "\"";
	$sql .= " && " . $_POST['phraseLocation'] . " like \"%" . $_POST['actionPhrase'] . "%\"";
	print "<br> " . $sql;
	$result = mysqli_query($conn,$sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}	
/*===============================================================================================*/
	if ($_POST['action'] == "changeTimeStart" || $_POST['action'] == "changeTimeEnd" || $_POST['action'] == "changeTimeReserve"){
	if ($_POST['phraseLocation'] == 'Place')
		{
		$newphrase = $_POST['place'];
		} elseif ($_POST['phraseLocation'] == 'media'){
		$newphrase = $_POST['media']; 
		} else{
		$newphrase = $_POST['activity'];
		}
	
	$bodyText = "<br> <h3>Update Times </h3> ";
	$sql = "update  events ";
	if ($_POST['action'] == "changeTimeStart")
	{
		$sql .= " set Time_start = \"$_POST[newTime]\" " ;
		
	}
	if ($_POST['action'] == "changeTimeEnd")
	{
		$sql .= " set Time_end  = \"$_POST[newTime]\" " ;
		
	}
	if ($_POST['action'] == "changeTimeReserve")
	{
		$sql .= " set Resby = \"$_POST[newTime]\" " ;
		
	}
	$sql .= " Where Event_org = \"" . $_POST['Event_org'] . "\"";
	$sql .= " && " . $_POST['phraseLocation'] . " like \"%" . $_POST['actionPhrase'] . "%\"";
	print "<br> " . $sql;
	$result = mysqli_query($conn,$sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}									
/*===============================================================================================*/
  if ( $_POST['action'] == "makeRecuring"  ) {
  		print "<br />Recurring started </br>";
  		$date_array = explode('-',$_POST['recurbegin']);
		
		$gen_from_mm = $date_array[1];
        $gen_from_day =$date_array[2];
        $gen_from_year = $date_array[0];
		$date_start= mktime(0,0,0,$gen_from_mm ,$gen_from_day + 1 , $gen_from_year);
		if (isset($_POST['duration'])){
			$date_end = mktime(0,0,0,$gen_from_mm,$gen_from_day + $_POST['duration'] ,$gen_from_year);
		}else{
		$date_array = explode('-',$_POST['recurend']);
		print_r($date_array);
		
		$gen_to_mm = $date_array[1];
        $gen_to_day =$date_array[2];
        $gen_to_year = $date_array[0];
		$date_end = mktime(0,0,0,$gen_to_mm ,$gen_to_day,$gen_to_year);
		}
		/*print_r($date_array);
		print ("<br /> date start " . $date_start . " date_end " . $date_end  . " duration " . $duration) ;*/
        
        $alternateswitch="True";
   
               

        $bodyText = "dates added to the database<br />";
        $insertCount=0;
         $du = new date_utility;
		 
 		 for($julthis=$date_start; $julthis<$date_end; $julthis= $julthis + 24 * 60 * 60)
		 {
    	$this_month= date('m',$julthis);
		$this_day = date('d',$julthis);
		$this_year = date('Y',$julthis);
		$this_day_of_week = date('D',$julthis);
		$this_month_last_date = $du->getDaysThismonth($this_month);
		
     /* print "$this_year $this_month $this_day $this_day_of_week looking for $dow <br>";*/
		if(!$_POST['dow'])
		{ echo "Day of Week not set";
		exit;
		}
			 $insertcount=0;
			 
		//print("<br /> comparing " . $this_day_of_week . " to " . $_POST['dow'] );
       if (strtoupper($this_day_of_week) == strtoupper($_POST['dow'] ) ){
	   		//print("<br /> comparing " . $this_day . " to " . $_POST['checkSelect[0]']);
		   if(!isset($_POST['checkSelect']))
			  {print("<br> checkSelect not set");
			  exit();}
           if ( 
			 	(( in_array('first',$_POST['checkSelect'])) and ($this_day < 8 )) or 
                (( in_array('second',$_POST['checkSelect'])) and ($this_day > 7) and ($this_day < 15)) or
                (( in_array('third',$_POST['checkSelect'])) and ($this_day > 14) and ($this_day < 22 )) or
                (( in_array('fourth',$_POST['checkSelect'])) and( $this_day > 21) and ($this_day < 29 )) or
                (( in_array('fifth',$_POST['checkSelect'])) and ($this_day > 28) and ($this_day < 32 )) or
				(( in_array('last',$_POST['checkSelect'])) and ($this_day > $this_month_last_date -7) and ($this_day 		<= $this_month_last_date )) or
                ((in_array('alternate',$_POST['checkSelect'])) and ($alternateswitch == "True" ))
				)
				{
                  $bodyText .= "Posting  $this_year $this_month  $this_day  $insertCount <br />";
                  $insertCount ++;
                  $event_date = "$this_year";
                  $event_date .="-";
                  $event_date .="$this_month";
                  $event_date .="-";
                  $event_date .="$this_day";
                  $event_end_date = $event_date;
                  $event_rsv_date = $event_date;
                  $sql="
                        insert into events
						SET Place = \"" . $_POST['place'] . "\",
						Event_org= \"" . $_POST['Event_org'] . "\",
						Event_title = \"" . $_POST['event_title']. "\",
						Date_from =\"$event_date\",
						Time_start = \"" . $_POST['time_start']. "\",
						Time_end= \"" . $_POST['date_to']. "\",
						Date_to =\"$event_date']\",
						Resby= \"$event_date\",
						Dow = \"" . $_POST['dow']. "\",
						Activity= \"" . $_POST['activity']. "\",
						media = \"" .$_POST['media'] . "\",
						Price_members=\"" . $_POST['price_members'] . "\",
						Price_guests = \"" . $_POST['price_guests'] . "\",
						SUBMITTED_BY= \"" . $_POST['submitted_by'] . "\",
						Event_open=\"" . $_POST['event_open']. "\",
						confirm = \"Y\",
						Event_priority= \"" . $_POST['event_priority'] . "\" " ;
						  
                       $result = mysqli_query($conn,$sql);
                        if (!$result) {
						echo("<p> Error in generation  Email this information to cauleyfrank@gmail.com" . mysqli_error($conn) . $sql ."</p>");
          }
                     #end of post
					$insertcount ++;
                        
                        if ( $alternateswitch == "False" ){
                         $alternateswitch = "True";}
                        else {
                        $alternateswitch = "False";
						}
                       
           } //end of post
          }   #end of day processing


        }#end of while date less than  end date
			     
                  print $bodyText;
                  print "end of job";
                 
                        exit;
}#end of recuuring
print ("<br> $action has been processed ");
/*===============================================================================================*/
if($_POST['operator'] != "Admin")
{
print "<h2>Event Added to Database</h2>\n";
print " If you have another event to enter, use the back function to return to the form<br />";
print "and make the changes to the form and re-submit\n";
}
print "</body>";
print "</html>";
?>
 