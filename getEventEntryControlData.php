<?php
require_once("../cgi-bin/connect.inc");
require_once($_SERVER['DOCUMENT_ROOT'] ."/stylesheets/Forms.css");
require_once($_SERVER['DOCUMENT_ROOT'] ."/phpClasses/Class_publicist.php");
$pub = new publicist;
$select_org=$_REQUEST["select_org"];
$sql="select * from entryControl where select_org = $select_org";
$result = mysql_query($sql);
if (!$result) {
  die("Invalid query: " . mysql_error());
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Get Event Entry Control Data</title>
</head>

<body>
The org we are looking for is <?echo $select_org ?>
<br />
<?echo $sql ?>
<br />

</body>
</html>