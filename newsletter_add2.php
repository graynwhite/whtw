<?php
/** @package 

        newsletter_add
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 1/4/2005 12:43:01 AM
	Last change: FJC 2/13/2005 7:03:05 PM
*/

//$campaign = $_REQUEST[campaign];
$newDate = $_REQUEST[new_date];
echo "this is the new date  " . $newDate . "<br />";
require_once($_SERVER['DOCUMENT_ROOT']. "/cgi-bin/connect.inc");

if ($_REQUEST[action] == 'newevent'){	
	 $carray = explode("-",$_REQUEST[new_date]);
    $campaign = "Newsletter ". $carray[0]. "/" . $carray[1] . "/" . $carray[2];
	 $url = "Events for week of " .$carray[1]. "-" . $carray[2] . "-" . $carray[0] . ".htm";
	  printf("<p> Newsletter = %s  url is %s ", $campaign, $url);
	  
	   $sql = "insert into newsletters set campaign = \"$campaign\",
                url=\"$url\" ";
		 $result = @mysql_query($sql);
		 if (!$result) {
		       echo("<p> Your inquiry  was rejected Email this information to webmaster@graynwhite.com" . mysql_error() ." </p>");
			
		
	 }		
}
?>
      






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<h1> Test new date is <?echo $newDate ?></h1>
campaign is <? echo $campaign ?>
<br />URL is <? echo $url ?>
</body>
</html>