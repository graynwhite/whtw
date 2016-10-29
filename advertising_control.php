<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/phpClasses/Class_advertising.php");
$add = new advertising;
$json = $add->construct_jason();
echo $json;
$file= "adcontrol.txt";
$fp = fopen($file,'w');
fwrite($fp,$json);
fclose($fp);



/*$add->insertAdd($_POST['addName'],$_POST['text'],$_POST['priority'],$_POST['active'],$_POST['date_begin'],$_POST['date_end'],$_POST['week_1'],$_POST['week_2'],$_POST['week_3'],$_POST['week_4'],$_POST['week_5'] );*/

?>