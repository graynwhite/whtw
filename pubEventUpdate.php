<?php
require_once("../cgi-bin/connect.inc");
require_once("../phpClasses/Class_blog_links.php");
$blog_links = new blog_links;
$fieldsToUpdate = $blog_links->
clearquotes($_GET['fields']);
$updateArray=explode('|',$fieldsToUpdate);
$Event_number = $updateArray[0];
$Date_from = $updateArray[1];
$Event_title = $updateArray[2];
$Time_start = $updateArray[3];
$Time_end = $updateArray[4];
$Date_to = $updateArray[5];
$Resby = $updateArray[6];
$Dow = $updateArray[7];
$Place = $updateArray[8];
$Activity = $updateArray[9];
$Price_members =$updateArray[10];
$Price_guests = $updateArray[11];
$Event_open = $updateArray[12];
$Event_priority = $updateArray[13];
$media = $updateArray[14];
$return_message = 'No action taken';
$sql = "update events set Date_from = \"$Date_from\",
					      Event_title = \"$Event_title\",
						  Time_start = \"$Time_start\",
						  Time_end = \"$Time_end\",
						  Date_to = \"$Date_to\",
						  Resby = \"$Resby\",
						  Dow = \"$Dow\",
						  Place = \"$Place\",
						  Activity = \"$Activity\",
						  Price_members = \"$Price_members\",
						  Price_guests = \"$Price_guests\",
						  Event_open = \"$Event_open\",
						  Event_priority = \"$Event_priority\",
						  media = \"$media\" where Event_number = \"$Event_number\" ";
		$result = mysql_query($sql);
		if(mysql_error() != '')
		{
			trigger_error("Sql Error \n " . $sql . "\n" .mysql_error());
			$return_message =  "record not updated" . $sql . "\n" . mysql_error() ;
			
		}else{
		$return_message = "event updated \n" . $sql;
		}
							  
print $return_message;
?>
