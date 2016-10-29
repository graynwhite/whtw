<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Input Handler</title>
</head>
<body>
<p align="center"><img src="graynwhitebannereventMaint.jpg" width="468" height="60"></p>
<p><font size="7"><b>Event Maintenance</b></font></p>
<hr>
<?PHP
	
	
  include("../cgi-bin//connect.inc");
  /* Function to evaluate the inputted password */
  function Evaluate_password($confirm,$password){
		if ($confirm=="N"){ // Correspondent input
		$sql = " select * from entryControl where select_org = \"$_POST[select_org]\" ";
		$result = mysql_query($sql);
		if (!$result) {
			print ("<p> Query not run " . $sql . mysql_error() );
			exit:
		$row = mysql_fetch_array($result);
		if ($row['special_pass'] == $password)	{
				$password = "6r1n11";
				}
		return $password;		
	}
	
   $confirm = $_POST[confirm];
   if ($confirm == 1) {
   	$confirm = "N"; )
	else{
	$confirm = "Y";
	}
   $subpass = evaluate_password($confirm,$subpass);
   if ($subpass <> "6r1n11") {
   		print("<p> You have entered an incorrect password. Use the browser back function and correct"</p>);
		exit;
		}
  $submitted_by = $_POST['emailid'};
  $reference = $_POST['reference'];
  $Event_type = $_POST[Event_type];
  $Event_priority = $_POST[Event_priority];
  $event_date = $_POST[From_year];
  $event_date .= $_POST[From_year];
  $event_date .= $_POST[From_mm] . $_POST[From_day];
  $event_org = $_POST[Org];
  $event_start= $_POST[Start_Time_Hours] . $_POST[Start_Time_Minutes] . $_POST[Start_AMPM];
  $event_end= $_POST[To_Time_Hours] . $_POST[To_Time_Minutes] . $_POST[To_AMPM];
  $week = $_POST[week];
  $select_org = $_POST[select_org];
 
  $place_address = $_POST[place_address];
  $place_name = $_POST[place_name];
  $city = $_POST[city];
  $state = $_POST[state];
  $zip = $_POST[zip];
  $phone = $_POST[phone];
  $directions = $_POST[directions];
  $activity_contact = $_POST[activity_contact];
  $url = $_POST[url];
  $email = $_POST[email];
  $event_place = $_POST[event_place];
  $event_place .= " " . $place_address . " " . $city . ", ";
  if ($city > "  "){
  		$event_place .= $state . " " . $phone;
	}
  if ($email > "  " ){
  		$event_place  .=  "email address is " . $email;
	}
  if ($url > "  " ) {
  		$event_place .= " web site is " . $url;
	}
   $event _place .= " " . $directions;
   
   if ($_POST[To_year] == "   "){
   		$event_end_date = $event_date;
		} else
		$event_end_date = $_POST[To_year] . $_POST[T0_mm] . $_POST[To_day];
		}
	if ($_POST[Reserve_date]== "   "){
		$event_rsv_date = $event_date;
		} else{
		$event_rsv_date = $_POST[Reserve_year] . $_POST[Reserv_mm] . $_POST[Reserve_day];
		}
	$event_dow = $_POST[Dow];
	$event_media = $_POST[media];
	$event_name = $_POST[activity];
	if ($_POST[activity_contact > "  "){
		$event_name .= "Contact: "	. $_POST[activity_contact];
		}
	if ($reference > "  "){
		$event_name .= "<A href =\'"  . $reference . " \' Click here for details </a>";
	$price_member = $_POST[Price_member];
	$Price_guest = $_POST[Non_Member_Price];
	$Dow = $_POST[Dow];
			
   	/* Check for Recurring Data  */
	
	if ($_POST[action] == "Recurring"){
		$gen_from_mm = $_POST[gen_from_mm];
		$gen_from_day = $_POST[gen_from_day];
		$gen_from_year = $_POST[gen_from_year];
		$gen_to_mm = $_POST[gen_to_mm];
		$gen_to_day = $_POST[gen_to_day];
		$gen_to_year = $_POST[gen_to_year];
		
  
						
?>
</body>
</html>
