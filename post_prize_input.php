<?php
$tab="\t";
date_default_timezone_set("America/Detroit");
$current_time = date('Y-m-d H:i:s');

$filename=$_SERVER['DOCUMENT_ROOT']."/_private/prizeinput.txt";
$prize_entry=$_POST[myemail] . $tab . $_POST[firstname] . $tab . $_POST[lastname]. $tab. $_POST[signupans] .$tab . $current_time . "\n";
$fp=fopen($filename,"a");
$write=fwrite($fp,$prize_entry);
$close=fclose($fp);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Post prize Input</title>
</head>

<body>
</body>
</html>