<?php
$Event_number=$_GET['Event_number'];
$todays_date= date("Y". "-". "m" . "-" . "d");
//echo "Today's Date is " . $todays_date;
//echo "Event Number is " . $Event_number;
require_once("../cgi-bin/connect.inc");


$sql = "select * from events where Event_number = \"$Event_number\" and Event_open= \"Y\" order by Date_from, Time_start";
$result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected. Please email this information to webmaster@graynwhite.com" . mysql_error() . "<br />" . $sql . " </p>");
	 		exit;

      		}
	while($r = mysql_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);
		

?>

