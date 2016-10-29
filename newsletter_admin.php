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
include("../cgi-bin//connect.inc");

?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Newsletter Maintenance Form</title>
<meta NAME="generator" CONTENT="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
</head>

<body>

<h1>Newsletter Maintenance Form</h1>

<?php

    $sql = "select * from newsletters  order by campaign";
    $result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to webmaster@graynwhite.com" . mysql_error() . " </p>");
	 		exit;

      		}


?>
<h1> List of Newsletters
 
</h1>
<form action="newsletter_add.php"  >
<Table border="1" cellpadding="2" cellspacing="2">

<tr>
        <th align="center">Newsletter link</th>
        <th align="center">Url </th>
        <th align="center">Action </th>
</tr>
<tr> <td colspan="3" align="center"><input type="submit" value="Add New" name="addorg"></td></tr>
 <?       while ($row = mysql_fetch_array($result)){

    ?>
 <tr>
        <td><?=$row['campaign']?>&nbsp;</td>
        <td><?=$row['url']?>&nbsp;</td>
        <td><A href="Newsletter_change.php?campaign=<?=$row['campaign']?>&Submit=no>">Change</a>
          |   <A href="newsletter_add.php?campaign=<?=$row['campaign']?>&action=delete">Delete</a>"
            </TD>

 </tr>
<?
        }
?>
</table>
<center>
</center>
</form>
<p>
<center><a HREF="<?=$return_path?>">Click here to go back to the control Page</a></center>
