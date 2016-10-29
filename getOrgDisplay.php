<?php
require_once("../cgi-bin/connect.inc");
$sql="select * from orgs order by Org_name";
$result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected. Please email this information to webmaster@graynwhite.com" . mysql_error() . "<br />" . $sql . " </p>");
	 		exit;

      		}

			
			$rt="<h2>Organizaition Listing</h2>";

	 while ($row = mysql_fetch_array($result)){
	 $rt.="<br />" . $row['Org_name']. ", <strong>" . $row['Org_num'] . "</strong>";
	 }
	 echo $rt;
?>
