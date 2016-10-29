<?php
$myfile = fopen("newUsers.txt", "r") or die("Unable to open file!");
echo fgets($myfile);
fclose($myfile);
?>
