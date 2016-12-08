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
require_once("../../cgi-bin/connect.inc");

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

    $sql = "select * from newsletters  order by campaign ";
    $result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to webmaster@graynwhite.com" . mysql_error() . " </p>");
	 		exit;

      		}


?>
<h1> List of Newsletters</h1>

<form method=post action="my_newsletter_form_head.php">
  <input type="submit" value="Add New" name="submit">
  </form>



<table border="1" cellpadding="2" cellspacing="2">
<tr>
        <th align="center">Newsletter link</th>
        <th align=center>Url </th>
        <th align=center>Action </th>
</tr>
 <?       while ($row = mysql_fetch_array($result)){

    ?>
 <tr>
        <td><?=$row['campaign']?>&nbsp;</td>
        <td><?=$row['url']?>&nbsp;</td>
        <td><a href="newsletter_change.php?campaign=".<?=$row['campaign']?> | &submit=\"no\" >Change</a>
            <a href="newsletter_add.php?campaign=\"" . <?=$row['campaign']?>. "&action=Delete>Delete</a>
            </td>
<?php } ?>
 </tr>

</table>
</body>
</html>


