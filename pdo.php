<?php
Require_once('../cgi-bin/pdoconnect.php');

 
// Step 2: Construct a query
$query = "SELECT * FROM events WHERE Date_from =". $db->quote("2014-11-06");
 
// Step 3: Send the query
$result = $db->query($query);
 
// Step 4: Iterate over the results
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
	
    var_dump($row);
	echo "<br />";
	echo "<hr />";
}
 
// Step 5: Free used resources
$result->closeCursor();
$db = null;
?>