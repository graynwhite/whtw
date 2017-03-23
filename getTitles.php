<?php
$searchArg=$_GET['searchArg'];
$searchType=$_GET['searchType'];
$todays_date= date("Y". "-". "m" . "-" . "d");
require_once("../cgi-bin/connect.inc");

if($_GET['searchType'] == "Date"){
$sql = "select * from events where Date_from = \"$searchArg\" and Event_open= \"Y\" order by  Time_start";
}
if($_GET['searchType'] == "Organization"){
$sql = "select * from events where Event_org = \"$searchArg\" and Date_from >= \"$todays_date\" and Event_open = \"Y\" order by Date_from";
}
$result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected. Please email this information to cauleyfrank@gmail.com " . mysql_error() . "<br />" . $sql . " </p>");
	 		exit;

      		}


			
			$returnValues="";
			
			 while ($row = mysql_fetch_array($result)){
			 $event_title = $row['Event_title'];
			 $event_title = strlen($event_title)>0 ? $event_title : "No Title";			
			 			 $returnValues .= $event_title. " " . $row['Event_number']. " " . $row['Date_from'] ."<br />";
			 
			 }
			 $reunValues = strlen($returnValues)>0 ? $returnValues : "None found";
			 echo $returnValues;

?>

