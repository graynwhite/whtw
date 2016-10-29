<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/phpClasses/Class_advertising.php");
$add = new advertising;
$add->insertAdd($_POST['addName'],$_POST['text'],$_POST['priority'],$_POST['active'],$_POST['date_begin'],$_POST['date_end'],$_POST['week_1'],$_POST['week_2'],$_POST['week_3'],$_POST['week_4'],$_POST['week_5'] );

?>