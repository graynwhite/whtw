<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/cgi-bin/connect.inc");
define('CSV_PATH','C:/Users/Frank%20;Cauley/Downloads/');
$csv_file = CSV_PATH . "newsletters.csv"; // Name of your CSV file
$csvfile = fopen($csv_file, 'r');
$theData = fgets($csvfile);
$i = 0;
while (!feof($csvfile)){
$csv_data[] = fgets($csvfile, 1024);
$csv_array = explode(",", $csv_data[$i]);
$insert_csv = array();
$insert_csv['Campaign'] = $csv_array[0];
$insert_csv['url'] = $csv_array[1];
$query = "INSERT INTO newsletters(Campaign,url)
VALUES('','".$insert_csv['Campaign']."','".$insert_csv['url']."')";

$n=mysql_query($query, $connect );
$i++;
}
fclose($csvfile);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
