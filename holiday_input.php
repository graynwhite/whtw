<?php>

	print_r($_POST);
echo("array printed");
printArray($_POST);
	function printArray($array){
     foreach ($array as $key => $value){
        echo "$key => $value";
        if(is_array($value)){ //If $value is an array, print it as well!
            printArray($value);
        }  
    } 
	}
	exit();


$return_message='';
$break="\<br \/>";
$break="\n";
include("class_connect.php");
$con = new connect_to_database;
$con->connect();
$return_message="Pass is " . $_POST["passx"];

 if (trim($_POST['pasx']) != "/FJ6r1n11M" ){
	 $return_message.="<br />Your are not authorized to use this syastem";
	 exit;
	}else{
	$return_message="Starting insert process";

$dateWork = $_POST['holiday_date'];
$return_message.="<br /> Holiday date is ".$_POST['holiday_date'];

$dateArray =explode("/",$dateWork);
$emonth=$dateArray[1];
$eday = $dateArray[2];
$eyear =$dateArray[0];
$priority=$_POST[priority];
$timestamp=mktime(0,0,0,$emonth,$eday,$eyear);
$dow = date('D',$timestamp);
$event_date=$dateWork;
$place = $_POST[holiday_description];
$activity=$_POST[holiday_description];
$holimage=$_POST[holimage];

if(strlen($holimage)>0){
$activity = '<table><tr><td>'; 
$activity .= "<img src=\"http://www.peggyjostudio.net/E/" . $holimage ."\"";
$activity .= "alt='Holiday Logo' align='left' height='100'>";
$activity .= "<h2>" .$place . "</h2>";
if($_POST['disclaim']=='Y'){
	$activity .= "<h3>Regularly scheduled events may not take place on this day and the prior evening. Check with the sponsoring organization before travelling to the venue</h3>";
}
$activity.="</td></tr></table>";
$activity = htmlentities($activity);
$media=$activity;
}else{
	$activity='  ';
}
        $sql = "INSERT into events
           SET Event_title = \"$place\",
           Date_from = \"$event_date\",
           Date_to = \"$event_date\",
		   Resby = \"$event_date\",
           Event_org = \"HOL\",
           DOW = \"$dow\",
           Activity=\"$activity\",
		   media=\"$media\",
           Price_members = \" \",
           Price_guests = \" \",
           Event_open = \"Y\",
           Event_priority = \"$priority\",
           SUBMITTED_BY = \"holiday_entry\" ";
		   
		  
		   $result = @mysql_query($sql);
		   if(@mysql_error()!=''){
			   $return_message.="<br /> there was an error in execution";
			   $return_message.="br/>" . @mysql_error();
		   }

           
          if(!$result) {
		  $return_message.="<br />however something was wrong with the Sql";
		   $return_message.="<br />this is the sql";
		   $return_message.="<br />" .$sql;
          }else{
			  $return_message.="Event Posted";            
        }
}

?>
<!--<!doctype html>
<html>

<head>
<title>Holiday/Special Event Input Results</title>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Holiday or special event input</title>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/template.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="mobile.css"/>
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	<link	
	
</head>
<body>

The return message is <?php echo $return_message ?> 
</body>
</html>
-->