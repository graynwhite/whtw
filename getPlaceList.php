<?php
require_once("../cgi-bin/connect.inc");
$name=$_REQUEST['name'];
if (strlen($name)< 4)
{
	$report =  " The value " . $name . " is too small";
	print $report;
	exit;
}
$sql="select * from places where place_name like \"$name%\" order by place_name ";
$result= mysql_query($sql);
$report = "";
if(!$result){
	trigger_error("not found" . mysql_error());
	}
	while ($row=mysql_fetch_array($result)){
	
	$report .= addslashes($row['place_name']) . "|" . addslashes($row['address'] ) ;
	$report .= "|" . addslashes($row['city']);
	$report .= "|" . addslashes($row['state']);
	$report .= "|" . addslashes($row['zip']);
	$report .= "|" . addslashes($row['phone']);
	$report .= "|" . addslashes($row['url']);
	$report .= "|" . addslashes($row['email']);
	$report .= "|" . addslashes($row['directions']);
	$report .= "|" . addslashes($row['place_num']);
	$report .= "|,";
	}
	print $report;
?>	