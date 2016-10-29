<?php
require_once("../cgi-bin/connect.inc");
$Event_number=$_GET['event'];

$sql="select * from events  where Event_number = \"$Event_number\" ";
$result= mysql_query($sql);
$report = "";
if(mysql_error() != '')
{
	trigger_error("not found" . $sql . mysql_error());
	}
	while ($row=mysql_fetch_array($result)){
	
	$report .= addslashes($row['Event_number']) . "|" . addslashes($row['Date_from'] ) ;
	$report .= "|" . addslashes($row['Event_org']);
	$report .= "|" . addslashes($row['Event_title']);
	$report .= "|" . addslashes($row['Time_start']);
	$report .= "|" . addslashes($row['Time_end']);
	$report .= "|" . addslashes($row['Date_to']);
	$report .= "|" . addslashes($row['Resby']);
	$report .= "|" . addslashes($row['Dow']);
	$report .= "|" . addslashes($row['Place']);
	$report .= "|" . addslashes($row['Activity']);
	$report .= "|" . addslashes($row['Price_members']);
	$report .= "|" . addslashes($row['Price_guests']);
	$report .= "|" . addslashes($row['Event_open']);
	$report .= "|" . addslashes($row['Event_priority']);
	$report .= "|" . addslashes($row['SUBMITTED_BY']);
	$report .= "|" . addslashes($row['confirm']);
	$report .= "|" . addslashes($row['categories']);
	$report .= "|" . addslashes($row['needsReview']);
	$report .= "|" . addslashes($row['media']);
	$report .= "|";
	}
	print $report;
?>	
