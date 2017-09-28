<?php
/** @package 

        newsletter_admin
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 2/13/2005 5:21:49 PM
	Last change: FJC 2/13/2005 7:06:04 PM
*/
?>
<?php
//require_once("../../cgi-bin/connect.inc");
define("APP_ROOT", $_SERVER['DOCUMENT_ROOT'].'/whtw');
require_once "../gwsecurity/private/initialize.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=utf8">

<head>

<title>Newsletter Maintenance Form</title>


</head>

<body>

<h1>Newsletter Maintenance Form</h1>

<?php

    $sql = "select * from newsletters  order by campaign DESC";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to cauleyfrank@gmail.com" . mysqli_error() . " </p>");
	 		exit;

      		}


?>
<h1> List of Newsletters</h1>

<form method=post action="my_newsletter_form_head.php">
  <input type="submit" value="Add New" name="submit">
  </form>
<?
$returnHtml="<table><tr>";
$returnHtml.="<th align=\"center\">Newsletter Link</th>";
$returnHtml.="<th align=\"center\">URL</th>";
$returnHtml.="<th align=\"center\">Action</th></tr>\n";
  while ($row = mysqli_fetch_assoc($result)){
  $currentCampaign=htmlentities($row["campaign"]);
  $returnHtml.="<tr><td>";
  $returnHtml.=$currentCampaign;
  $returnHtml.="</td><td>";
  $returnHtml.=htmlentities($row["url"]);
  $returnHtml.="</td><td>";
  $returnHtml.="<a href=\"newsletter_change.php";
  $returnHtml.="?campaign=";	  
  $returnHtml.=$currentCampaign;
  $returnHtml.="&submit=no\">Change</a>";
  $returnHtml.="|<a href=\"newsletter_add.php?campaign=";
  $returnHtml.="$currentCampaign"; $returnHtml.="&action=Delete\">Delete</a></td></tr>";
  } 
	
  $returnHtml.="</table>";
echo("$returnHtml");
?>


</body>
</html>


