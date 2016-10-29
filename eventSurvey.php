<?php
include("../cgi-bin/connect.inc");
$sql="SELECT t1.Org_name,t1.Org_num, t1.contact_name,t1.contact_phone,t1.contact_email,MAX(t2.Date_from) as High_date
 from orgs as t1, events as t2 where t1.Org_num = t2.Event_org GROUP BY t1.Org_num";
/* $sql= "select org.Org_num, org.Org_name, org.contact_name, org.contact_phone, org.contact_email from orgs as org
 LEFT JOIN events 
  On events.Event_org = org.Org_num
  	LEFT JOIN
	(
	SELECT MAX(events.Date_from) 
	from events 
	group by events.Event_org
	)AS t1
 ";*/
 	
$result=mysql_query($sql);
 if (!$result) {
                    echo "<p>error performing query" . mysql_error(). " ". $sql;}


while ($row=mysql_fetch_array($result)){
	echo $row['Org_num'] . ", ". $row[Org_name]. ' ' . $row['High_date'] . ", " . $row['contact_name'] . ", " . $row['contact_email'] . ", ".$row[contact_phone];
	echo "<br />";
};
?>
