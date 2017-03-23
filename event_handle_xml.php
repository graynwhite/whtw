<?php
/** @package

        event_handle.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 9/11/2003 1:37:51 AM
	Last change: FJC 6/9/2005 4:51:16 PM
*/


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
/*===============================================================================================*/ 
if ($operator != 'wp_post_event')
{
print "<html>";

print "<head>";
print "<Title>Club Event Maintenance update</title>";
print "</head>";

print "<body>";

print "<p><font size=\"7\"><b>Event Maintenance</b></font></p>";
print"<hr>";
}
/*print "operator is " . $operator;*/
require_once("../cgi-bin/connect.inc");
/*print "<br>loaded connect";*/
require_once("../phpClasses/dateClass.php");
/*print "<br>loaded dateClass";*/
require_once("../phpClasses/Class_orgs.php");
/*print "<br>loaded class_orgs";*/
/*===============================================================================================*/ 
if($operator == "wp_post_event")
{
$xmlfilename="../_private/wp_events.xml";
	
	if($dom = domxml_open_mem(file_get_contents('../_private/wp_events.xml')))
	{
	$Event = $dom->create_element('event');
	$submit = $dom->create_element('submitTime');
	$submit->set_content(date('Y-m-d H:i'));
	$Event->append_child($submit);
	
	$sign_up = $dom->create_element('sign_up');
	$sign_up->set_content($_POST['Sign_up'] );
	$Event->append_child($sign_up);
	
	$event_title = $dom->create_element('eventTitle');
	$event_title->set_content($_POST['eventTitle'] );
	$Event->append_child($event_title);
	
	$org_name = $dom->create_element('orgName');
	$org_name->set_content($_POST['Orgname'] );
	$Event->append_child($org_name);
	
	$sub_name = $dom->create_element('subName');
	$sub_name->set_content($_POST['yourName'] );
	$Event->append_child($sub_name);
	
	$sub_email = $dom->create_element('submitEmail');
	$sub_email->set_content($_POST['EMAILID'] );
	$Event->append_child($sub_email);
	
	$sub_phone = $dom->create_element('submitPhone');
	$sub_phone->set_content($_POST['Yphone'] );
	$Event->append_child($sub_email);
	
	$sub_from_date = $dom->create_element('From_date');
	$sub_from_date->set_content($_POST['From_date'] );
	$Event->append_child($sub_from_date);
	
	$sub_to_date = $dom->create_element('to_date');
	$sub_from_date->set_content($_POST['to_date'] );
	$Event->append_child($sub_to_date);
	
	$sub_reserve_date = $dom->create_element('reserve_by');
	$sub_reserve_date->set_content($_POST['reserve_by'] );
	$Event->append_child($sub_reserve_date);
	
	$sub_start_time = $dom->create_element('start_time');
	$sub_start_time->set_content([$_POST['Start_Time_Hours'] . ":" . $_POST['Start_Time_Minutes'] . " ". $_POST['Start_AMPM'] ); 
	$Event->append_child($sub_start_time);
	
	$sub_end_time = $dom->create_element('end_time');
	$sub_end_time->set_content([$_POST['To_Time_Hours'] . ":" . $_POST['To_Time_Minutes']." " . $_POST['To_AMPM'] );
	$Event->append_child($sub_end_time);
	
	$sub_day_of_week = $dom->create_element('dayOfWeek');
	$sub_day_of_week->set_content($_POST['sub_day_of_week'] );
	$Event->append_child($sub_day_of_week);
	
	$sub_comments = $dom->create_element('comments');
	$sub_comments->set_content($_POST['comments'] );
	$Event->append_child($sub_comments);
	
		$sub_place = $dom->create_element('place');
		
		$sub_place_name = $dom->create_element('place_name');
		$sub_place_name>set_content($_POST['place_name'] );
		$sub_place->append_child($sub_place_name);
		
		$sub_place_address = $dom->create_element('place_address');
		$sub_place_address>set_content($_POST['place_address'] );
		$sub_place->append_child($sub_place_address);
		
		$sub_place_city = $dom->create_element('city');
		$sub_place_city>set_content($_POST['city'] );
		$sub_place->append_child($sub_place_city);
		
		$sub_place_state = $dom->create_element('state');
		$sub_place_state>set_content($_POST['city'] );
		$sub_place->append_child($sub_place_state);
		
		$sub_place_zip = $dom->create_element('zip');
		$sub_place_zip>set_content($_POST['zip'] );
		$sub_place->append_child($sub_place_zip);
		
		$sub_place_phone = $dom->create_element('phone');
		$sub_place_phone>set_content($_POST['phone'] );
		$sub_place->append_child($sub_place_phone);
		
		$sub_place_url = $dom->create_element('url');
		$sub_place_url>set_content($_POST['url'] );
		$sub_place->append_child($sub_place_url);
		
		
		$sub_place_email = $dom->create_element('email');
		$sub_place_email>set_content($_POST['place_email'] );
		$sub_place->append_child($sub_place_email);
		
		$sub_place_directions = $dom->create_element('directions');
		$sub_place_directions>set_content($_POST['Directions'] );
		$sub_place->append_child($sub_place_directions);
		
	$Event->append_child($sub_place);
		
	$sub_activity = $dom->create_element('activity');
	$sub_activity>set_content($_POST['activity'] );
	$Event->append_child($sub_activity);	
	
	$sub_price_member = $dom->create_element('price_member');
	$sub_price_member>set_content($_POST['price_member'] );
	$Event->append_child($sub_price_member);
	
	$sub_price_non_member = $dom->create_element('price_non_member');
	$sub_price_non_member>set_content($_POST['Non_Member_Price'] );
	$Event->append_child($sub_price_non_member);	
	
	$sub_price_non_member = $dom->create_element('price_non_member');
	$sub_price_non_member>set_content($_POST['Non_Member_Price'] );
	$Event->append_child($sub_price_non_member);
	
		$sub_recurring = $dom->create_element('recurring');	
		
		$sub_isrecurring = $dom->create_element('isrecurring');
		$sub_isrecurring>set_content($_POST['recurring'] );
		$sub_recurring->append_child($sub_isrecurring);	
		
		$sub_isrecurring = $dom->create_element('isrecurring');
		$sub_isrecurring>set_content($_POST['recurring'] );
		$sub_recurring->append_child($sub_isrecurring);	
		
			$sub_day_of_week = $dom->create_element('day_of_week');
			
			$sub_mon = $dom->create_element('mon');
			$sub_mon>set_content($_POST['MON'] );
			$sub_day_of_week->append_child($sub_mon);
			
			$sub_tue = $dom->create_element('tue');
			$sub_tue>set_content($_POST['TUE'] );
			$sub_day_of_week->append_child($sub_tue);
			
			$sub_wed = $dom->create_element('wed');
			$sub_wed>set_content($_POST['WED'] );
			$sub_day_of_week->append_child($sub_wed);
			
			$sub_thu = $dom->create_element('thu');
			$sub_thu>set_content($_POST['THU'] );
			$sub_day_of_week->append_child($sub_thu);
			
			$sub_fri = $dom->create_element('fri');
			$sub_fri>set_content($_POST['FRI'] );
			$sub_day_of_week->append_child($sub_fri);
			
			$sub_sat = $dom->create_element('sat');
			$sub_sat>set_content($_POST['SAT'] );
			$sub_day_of_week->append_child($sub_sat);
			
			$sub_sun = $dom->create_element('sun');
			$sub_sun>set_content($_POST['SUN'] );
			$sub_day_of_week->append_child($sub_sun);
			
		$sub_recurring->append_child($sub_day_of_week);
			
			$sub_week_of_month = $dom->create_element('week_of_month');	
			
			$sub_first = $dom->create_element('first');
			$sub_first>set_content($_POST['First'] );
			$sub_week_of_month->append_child($sub_first);
			
			
			$sub_second = $dom->create_element('second');
			$sub_second>set_content($_POST['Second'] );
			$sub_week_of_month->append_child($sub_second);
			
			$sub_third = $dom->create_element('third');
			$sub_third>set_content($_POST['Third'] );
			$sub_week_of_month->append_child($sub_third);
			
			$sub_fourth = $dom->create_element('fourth');
			$sub_second>set_content($_POST['Fourth'] );
			$sub_week_of_month->append_child($sub_fourth);
			
			$sub_fifth = $dom->create_element('fifth');
			$sub_fifth>set_content($_POST['Fifth'] );
			$sub_week_of_month->append_child($sub_fifth);
			
			$sub_last = $dom->create_element('last');
			$sub_last>set_content($_POST['Last'] );
			$sub_week_of_month->append_child($sub_last);
			
		$sub_recurring->append_child($sub_week_of_month);
		
		
		$sub_recurr_begin = $dom->create_element('recurrbegin');
		$sub_recurr_begin>set_content($_POST['recurrBegin'] );
		$sub_recurring->append_child($sub_recurr_begin);
		
		$sub_recurr_end = $dom->create_element('recurrend');
		$sub_recurr_end>set_content($_POST['recurrEnd'] );
		$sub_recurring->append_child($sub_recurr_end);
		
	$Event->append_child($sub_recurring);

	$root = $dom->document_element();
	$root->append_child($Event);
	
	if ($fp = fopen($xmlfilename, 'w'))
		{
	fwrite($fp,$dom->dump_mem());
	fclose($fp);
	echo "file $xmlfilename updated";
		}else
		{
			echo "file $xmlfilename was not written";
	
		}
			
	quit;
	}else{
	$newxml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	$newxml .= "<events></events>";
	if ($fp = fopen($xmlfilename, 'w'))
		{
	fwrite($fp,$newxml);
	fclose($fp);
	echo "file established";
	quit;
	}
	}


	
}
/*===============================================================================================*/ 
if($operator == "Admin")
{
require_once("../cron.php");
print "<br>loaded cron ";
$bodyText = " Beginning of Bodytext<br>";
/*print_r($_POST);*/
print "<br>action is  " . $_POST['action'];
$action = $_POST['action'];
}
/*===============================================================================================*/ 
if (strtolower($action) == 'add')
{
 print("<p> Record will be inserted </p>");
 		$date_from = $_POST[From_year] . $_POST[From_mm] . $_POST[From_day];
		$date_to = $_POST[To_year] . $_POST[To_mm] . $_POST[To_day];
		$resby = $_POST[Reserve_year] . $_POST[Reserve_mm] . $_POST[Reserve_day];
		/*print "date to is " . $date_to . " date from is " . $date_from . "  reserve = " . $resby ."<br />" ;*/
		$date_to = $date_to == "        "   ? $date_from : $date_to;
		$resby = $resby == "         "  ? $date_from : $resby;
		
	/*	print "date to is " . $date_to . " date from is " . $date_from . "  resby  = " . $resby ."<br />" ;*/
		$time_start = $_POST[Start_Time_Hours] . $_POST[Start_Time_Minutes] .$_POST[Start_AMPM];
		$time_end = $_POST[To_Time_Hours] . $_POST[To_Time_Minutes] . $_POST[To_AMPM];
		$time_Start = $time_start == ' ' ? '7:00 PM' : $time_start;
		
		
		if ($confirm == 1)
		{
		$confirm= 'N';
		}else 
		{
		$confirm= 'Y';
		}
		
		if ($_POST[specialOption] == 'Trip')
		{
			$confirm= 'T';
		}
		if ($_POST[specialOption] == 'Reunion')
		{
			$confirm= 'R';
		}
		if ($_POST[specialOption] == 'Golf')
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
         $SQL= "
         insert into events
         SET Place = \"$place\",
         Event_org= \"$_POST[Org]\",
         Date_from =\"$date_from\",
         Time_start = \"$time_start\",
         Time_end= \"$time_end\",
        Date_to =\"$date_to\",
        Resby= \"$resby\",
        Dow = \"$_POST[Dow]\",
        Activity= \"$activity\",
		media = \"$media\",
        Price_members=\"$_POST[Price_Member]\",
        Price_guests = \"$_POST[Non_Member_Price]\",
        Event_open=\"$_POST[Event_type]\",
		Event_title= \"$event_title\",
        Event_priority=\"$_POST[Event_priority]\",
		SUBMITTED_BY= \"$_POST[emailid]   \",
		confirm= \"$confirm\" ";
		
		/*print "SQL is " . $SQL;*/

          $result = mysql_query($SQL);
		  
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }
		  if(mysql_affected_rows() < 1)
		  {
		  echo("no record added  " . $SQL  . mysql_error() . " Email this information to cauleyfrank@gmail.com");
		  }

          
}

/*===============================================================================================*/ 
 if ($action == 'referBack')
 {
 	  $SQL = " update events set media = \"$actionPhrase\" where Event_number  = \"$event_id\" ";
	$result = mysql_query($SQL);
	if (!$result){
		trigger_error("	Records not deleted " . " " . $sql . " " . mysql_error());
		exit;
		}
 
 }
   /*===============================================================================================*/ 
 if ($action == 'deleteAfterNumber')
 {
 	  $SQL = " delete from events where Event_org  = \"$Event_org\" && Event_number  > \"$actionPhrase\" ";
	$result = mysql_query($SQL);
	if (!$result){
		trigger_error("	Records not deleted " . " " . $sql . " " . mysql_error());
		exit;
		}
 
 }
  /*===============================================================================================*/ 
 if ($action == 'makeLower')
 {
 $place = strtolower($_POST['place']);
 $activity = strtolower($_POST['activity']);
 $media = strtolower($_POST['media']);
 }
 
 /*===============================================================================================*/
 if ($action == 'deleteAfterDate')
 {
 	  $SQL = " delete from events where Event_org  = \"$Event_org\" && Date_from > \"$actionPhrase\" ";
	$result = mysql_query($SQL);
	if (!$result){
		trigger_error("	Records not deleted " . " " . $sql . " " . mysql_error());
		exit;
		}
 
 }

 /*===============================================================================================*/
 if ($action == 'genprod')
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
		break;
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
 if ($action == "sameDateNextYear") {
 $bodyText = "<h3> Event will be changed to next years Date.</h3>";
 $dchange = new entryControlDate;
 $next_years_date = $dchange->makeSameDateNextYear($date_from);
 print "<br> Next years date is " . $next_years_date ;
 $sql= " 
         update events
     SET Place = \"$place\",
	 	 media = \"$media\",	
         Event_org =\"$Event_org\", 
         Date_from =\"$next_years_date\",
         Time_start = \"$time_start\",
         Time_end= \"$end_time\",
        Event_open = \"$event_type\", 
        Date_to =\"$next_years_date\",
        Resby= \"$next_years_date\",
        Dow = \"$dow\",
        Activity= \"$activity\",
		media = \"$media\",
        Price_members=\"$price_members\",
        Price_guests = \"$price_guests\",
        Event_open=\"$event_open\",
        Event_priority=\"$event_priority\",
		needsReview = 1 ,
		Event_title = \"$event_title\",
		SUBMITTED_BY= \"$_POST[submitted_by]\",
        confirm = \"Y\"
        where Event_number = \"$event_id\"
           ";  
		    $result = @mysql_query($sql);
          if (!$result) {
          echo("<p> Error in update  Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }  
 $bodyText  .= "<br> Rows affected = " . mysql_affected_rows(); 	  
	print $bodyText;
    print "<br>End of processing";
    exit;
 }
 /*===============================================================================================*/
 if ($action == "change" || $action== 'makeLower' ) {
  /*print "<br>at change routine";*/
  print "<br> Record will be changed ";
  $SQL= " 
         update events
     SET Place = \"$place\",
	 	 media = \"$media\",	
         Event_org =\"$Event_org\", 
         Date_from =\"$date_from\",
         Time_start = \"$time_start\",
         Time_end= \"$end_time\",
        Event_open = \"$event_type\", 
        Date_to =\"$date_to\",
        Resby= \"$resby\",
        Dow = \"$dow\",
        Activity= \"$activity\",
		Price_members=\"$price_members\",
        Price_guests = \"$price_guests\",
        Event_open=\"$event_open\",
        Event_priority=\"$event_priority\",
		Event_title = \"$event_title\",
		SUBMITTED_BY= \"$_POST[submitted_by]\",
        confirm = \"$confirm\"
        where Event_number = \"$event_id\"
           ";   
          $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in update  Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }
 }
 /*===============================================================================================*/
 if ($action == "copy"){
         print("<p> Record will be copied </p>");
         $SQL= "
         insert into events
         SET Place = \"$place\",
         Event_org= \"$Event_org\",
         Date_from =\"$date_from\",
         Time_start = \"$time_start\",
         Time_end= \"$time_end\",
        Date_to =\"$date_from\",
        Resby= \"$date_from\",
        Dow = \"$dow\",
        Activity= \"$activity\",
		media = \"$media\",
        Price_members=\"$price_members\",
        Price_guests = \"$price_guests\",
        Event_open=\"$event_open\",
		SUBMITTED_BY= \"$_POST[submitted_by]\",
		Event_title= \"$event_title\",
        Event_priority=\"$event_priority\" ";
//print ("<br>$SQL");
          $result = mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }
		  if ($mysql_affected_rows <1){
		  echo("<p> No record added   Email this information to cauleyfrank@gmail.com\n" . mysql_error() . "</p>");
		
;
		  }

          }
/*===============================================================================================*/		  
  if ( $action == "delete" ){
        print("<p> Record will be deleted </p>");
        $SQL = " delete from events where Event_number = \"$event_id\" ";

         $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }

}
/*===============================================================================================*/
 if ( $action == "deleteOld" ){
        print("<p> Old Records will be deleted </p>");
		$now_date = date("Y") . "-" . date("m") . "-" . date("d");
		
        $SQL = " delete from events where Event_org  = \"$Event_org\" && Date_from < \"$now_date\" ";

         $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }

}
/*===============================================================================================*/
 if ( $action == "clearOrg" ){
        print("<p> All records except unconfirmed records will be cleared. </p>");
		
		
        $SQL = " delete from events where Event_org  = \"$Event_org\" && confirm = \"Y\" ";

         $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in copy   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
          }

}
/*===============================================================================================*/
	// Does not delete non-confirmed events. Which are events submitted by organization publicists
	if ($action == "deleteByPhraseTest"){
	$bodyText = "<br> <h3>Delete by phrase test</h3> ";
	$sql = "select * from events  Where Event_org = \"$Event_org\"";
	$sql .= " && " . $phraseLocation . " like \"%" . $actionPhrase . "%\"";
	$sql .= " && confirm = \"Y\" ";
	$sql .= " order by Date_from ";
	print "<br> " . $sql;
	$result = mysql_query($sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	While ($row=mysql_fetch_array($result)){
	$bodyText .= "<br><br> " . $row['Date_from'] . " " . $row['Place'] . "<br> " . $row['Activity'] ;
	}
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
	/*===============================================================================================*/
	// Does not delete non-confirmed events. Which are events submitted by organization publicists
	if ($action == "deleteByPhraseActual"){
	$bodyText = "<br> <h3>Delete by phrase actual</h3> ";
	$sql = "delete from events  Where Event_org = \"$Event_org\"";
	$sql .= " && " . $phraseLocation . " like \"%" . $actionPhrase . "%\"";
	$sql .= " && confirm = \"Y\" ";
	$result = mysql_query($sql);
	if (!$result) {
          echo("<p> Error in Delete   Email this information to cauleyfrank@gmail.com" . mysql_error() . "<br>");
	 exit;
	 }
	$bodyText  .= "<br> Rows affected = " . mysql_affected_rows(); 	  
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
/*===============================================================================================*/
	if ($action == "updateByPhraseTest"){
	$bodyText = "<br> <h3>Update by phrase test</h3> ";
	$sql = "select * from events  Where Event_org = \"$Event_org\"";
	$sql .= " && " . $phraseLocation . " like \"%" . $actionPhrase . "%\"";
	$sql .= " order by Date_from ";
	print "<br> " . $sql;
	$result = mysql_query($sql);
	 if (!$result) {
          echo("<p> Error in select   Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>"
		  );
		  exit;
	}
	While ($row=mysql_fetch_array($result)){
	$bodyText .= "<br><br> " . $row['Date_from'] . " " . $row['Place'] . "<br> " . $row['Activity'] ;
	}
	
	print $bodyText;
    print "<br>End of processing";
    exit;
	}
/*===============================================================================================*/
	if ($action == "updateByPhraseActual"){
	if ($phraseLocation == 'Place')
		{
		$newphrase = $place;
		} elseif ($phraseLocation == 'media'){
		$newphrase = $media; 
		} else{
		$newphrase = $activity;
		}
	$bodyText = "<br> <h3>Update by phrase actual</h3> ";
	$sql = "update  events ";
	$sql .= " set " .  $phraseLocation . " =  \"$newphrase\" "; 
	$sql .= " Where Event_org = \"$Event_org\"";
	$sql .= " && " . $phraseLocation . " like \"%" . $actionPhrase . "%\"";
	print "<br> " . $sql;
	$result = mysql_query($sql);
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
	if ($action == "memberPrice"){
	if ($phraseLocation == 'Place')
		{
		$newphrase = $place;
		} elseif ($phraseLocation == 'media'){
		$newphrase = $media; 
		} else{
		$newphrase = $activity;
		}
	
	$bodyText = "<br> <h3>Update member Price</h3> ";
	$sql = "update  events ";
	$sql .= " set  Price_members = \"$_POST[newPrice]\" "	; 
	$sql .= " Where Event_org = \"$Event_org\"";
	$sql .= " && " . $phraseLocation . " like \"%" . $actionPhrase . "%\"";
	print "<br> " . $sql;
	$result = mysql_query($sql);
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
	if ($action == "guestPrice"){
	if ($phraseLocation == 'Place')
		{
		$newphrase = $place;
		} elseif ($phraseLocation == 'media'){
		$newphrase = $media; 
		} else{
		$newphrase = $activity;
		}
	
	$bodyText = "<br> <h3>Update Guest Price</h3> ";
	$sql = "update  events ";
	$sql .= " set  Price_guests = \"$_POST[newPrice]\" "	; 
	$sql .= " Where Event_org = \"$Event_org\"";
	$sql .= " && " . $phraseLocation . " like \"%" . $actionPhrase . "%\"";
	print "<br> " . $sql;
	$result = mysql_query($sql);
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
	if ($action == "changeTitle"){
	if ($phraseLocation == 'Place')
		{
		$newphrase = $place;
		} elseif ($phraseLocation == 'media'){
		$newphrase = $media; 
		} else{
		$newphrase = $activity;
		}
	
	$bodyText = "<br> <h3>Update Title </h3> ";
	$sql = "update  events ";
	$sql .= " set  Event_title  = \"$_POST[event_title]\" "	; 
	$sql .= " Where Event_org = \"$Event_org\"";
	$sql .= " && " . $phraseLocation . " like \"%" . $actionPhrase . "%\"";
	print "<br> " . $sql;
	$result = mysql_query($sql);
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
	if ($action == "changeTimeStart" || $action== "changeTimeEnd" || Action== "changeTimeReserve"){
	if ($phraseLocation == 'Place')
		{
		$newphrase = $place;
		} elseif ($phraseLocation == 'media'){
		$newphrase = $media; 
		} else{
		$newphrase = $activity;
		}
	
	$bodyText = "<br> <h3>Update Times </h3> ";
	$sql = "update  events ";
	if ($action == "changeTimeStart")
	{
		$sql .= " set Time_start = \"$_POST[newTime]\" " ;
		
	}
	if ($action == "changeTimeEnd")
	{
		$sql .= " set Time_end  = \"$_POST[newTime]\" " ;
		
	}
	if ($action == "changeTimeReserve")
	{
		$sql .= " set Resby = \"$_POST[newTime]\" " ;
		
	}
	$sql .= " Where Event_org = \"$Event_org\"";
	$sql .= " && " . $phraseLocation . " like \"%" . $actionPhrase . "%\"";
	print "<br> " . $sql;
	$result = mysql_query($sql);
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
  if ( $action == "makeRecuring"  ) {
  		print "Recuring started </br>";
  		$date_array = explode('-',$recurbegin);
		print_r($date_array);
        $gen_from_mm = $date_array[1];
        $gen_from_day =$date_array[2];
        $gen_from_year = $date_array[0];
		$date_start= mktime(0,0,0,$gen_from_mm,$gen_from_day + 1 ,$gen_from_year);
		if (isset($duration)){
			$date_end = mktime(0,0,0,$gen_from_mm,$gen_from_day + $duration ,$gen_from_year);
		}else{
		$date_array = explode('-',$recurend);
		
		$gen_to_mm = $date_array[1];
        $gen_to_day =$date_array[2];
        $gen_to_year = $date_array[0];
		$date_end = mktime(0,0,0,$gen_to_mm,$gen_to_day ,$gen_to_year);
		}
		/*print_r($date_array);
		print ("<br /> date start " . $date_start . " date_end " . $date_end  . " duration " . $duration) ;*/
        
        $alternateswitch="True";
   
               

        $bodyText = "dates added to the database<br />";
        $insertCount=0;
         
 		 for($julthis=$date_start; $julthis<$date_end; $julthis= $julthis + 24 * 60 * 60){
    
        $this_month= date('m',$julthis);
		$this_day = date('d',$julthis);
		$this_year = date('Y',$julthis);
		$this_day_of_week = date('D',$julthis);
        
        

     /* print "$this_year $this_month $this_day $this_day_of_week looking for $dow <br>";*/

       if (strtoupper($this_day_of_week) == strtoupper($dow )){
              
              
             
         
         /*  print "at $weeks<br>";*/
             if ( 
			 	(( $checkFirst == 'yes') and ($this_day < 8 )) or 
                ((  $checkSecond == 'yes') and ($this_day > 7) and ($this_day < 15)) or
                (( $checkThird == 'yes' ) and ($this_day > 14) and ($this_day < 22 )) or
                (( $checkFourth == 'yes') and( $this_day > 21) and ($this_day < 29 )) or
                ((  $checkFifth == 'yes') and ($this_day > 28) and ($this_day < 32 )) or
				((  $checkLast == 'yes') and ($this_day > 28) and ($this_day < 32 )) or
                (( $checkAlternate == 'yes') and ($alternateswitch == "True" ))
				)
                    {
                  $bodyText .= "Posting  $this_year $this_month  $this_day  $insertcount <br />";
                  $insertCount = $insertCount + 1;
                  
                 
  
               
                      $event_date = "$this_year";
                      $event_date .="-";
                      $event_date .="$this_month";
                      $event_date .="-";
                      $event_date .="$this_day";
                      $event_end_date = $event_date;
                      $event_rsv_date = $event_date;
                      $sql="
                        insert into events
						SET Place = \"$place\",
						Event_org= \"$Event_org\",
						Event_title = \"$event_title\",
						Date_from =\"$event_date\",
						Time_start = \"$time_start\",
						Time_end= \"$time_end\",
						Date_to =\"$event_date\",
						Resby= \"$event_date\",
						Dow = \"$dow\",
						Activity= \"$activity\",
						media = \"$media\",
						Price_members=\"$price_members\",
						Price_guests = \"$price_guests\",
						SUBMITTED_BY= \"$_POST[submitted_by]\",
						Event_open=\"$event_open\",
						confirm = \"Y\",
						Event_priority= \"$event_priority\" " ;
						  
                       $result = mysql_query($sql);
                        if (!$result) {
						echo("<p> Error in generation  Email this information to cauleyfrank@gmail.com" . mysql_error() . $sql ."</p>");
          }
                    } #end of post
					$insertcount ++;
                        
                        if ( $alternateswitch == "False" ){
                         $alternateswitch = "True";}
                        else {
                        $alternateswitch = "False";}
                       
           
          }   #end of day processing


        }#end of while date less than  end date
			     
                  print $bodyText;
                  print "end of job";
                 
                        exit;
}#end of recuuring
/*===============================================================================================*/
if($operator != "Admin" && $operator != 'wp_post_event')
{
print "<h2>Event Added to Database</h2>\n";
print " If you have another event to enter, use the back function to return to the form<br />";
print "and make the changes to the form and re-submit\n";
print "If you are finished click on the \"Quit\" button below\n";

 print "<form method=post action=\"/cgi-bin/contact\" method=\"post\" name=formInput\"\>\n";
 print "<input type=hidden name=\"Subject\" value=\"Publicist Entry\">\n";
 print "<input type=hidden name=\"Sender\" Value=+Email+>\n";
 print "<input type=hidden name=\"recipient\" value=\"cauleyfrank@gmail.com\">\n";
 print "<input type=hidden name=\"env_report\" value=\"REMOTE_HOST,HTTP_USER_AGENT\"\n>";
 print "<input type=hidden name=\"bgcolor\" value=\"#ffffff\">\n";
 print "<input type=hidden name=\"text_color\" value=\"#000000\">\n";
 print "<input type=hidden name=\"return_link_url\" value=\"http://graypluswhite.com/whtw/whevents.php\">\n";
print "<input type=hidden name=\"return_link_title\" value=\"If you want to make corrections or enter more events use the back button on your browser or click here to go back to the home page\">\n";
 
        print "<input type = submit value=\"Quit\"\>\n";
        print "</form>";


print "</body>";
print "</html>";
}
?>
