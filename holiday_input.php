<?php
echo("begin");
print_r($_POST);
echo("<br>Array printed");

define('APP_ROOT', $_SERVER['DOCUMENT_ROOT'].'/whtw');
require_once "../gwsecurity/private/initialize.php";
if(isset($_POST["pasx"])){       
	print_r($_POST);
echo("<br>array printed");
printArray($_POST);
	function printArray($array){
     foreach ($array as $key => $value){
        echo "$key => $value";
        if(is_array($value)){ //If $value is an array, print it as well!
            printArray($value);
        }  
    } 
	}
	


$return_message='';
$break="\<br \/>";
$break="\n";


$return_message="Pass is " . $_POST["passx"];

 if (trim($_POST['pasx']) != MAINT_PASS ){
	 die("<br />Your are not authorized to use this syastem");
 }
}
	$return_message="Starting insert process";

$dateWork = $_POST['dateStart'];
$return_message.="<br /> Holiday date is ".$_POST['dateStart'];

$dateArray =explode("/",$dateWork);
$emonth=$dateArray[1];
$eday = $dateArray[2];
$eyear =$dateArray[0];
$priority=$_POST['priority'];
$timestamp=mktime(0,0,0,0,$emonth,$eday,$eyear);
$dow = date('D',$timestamp);
$event_date=$dateWork;
$place = $_POST['holiday_description'];
$activity=$_POST['holiday_description'];
$holimage=$_POST['holimage'];
$media=$_POST['holiday_description'];
if(strlen($holimage)>0){
$media = '<table><tr><td>'; 
$media .= "<img src=\"http://www.peggyjostudio.net/E/" . $holimage ."\"";
$media .= "alt='Holiday Logo' align='left' height='100'>";
$media .= $_POST['holiday_description'];	
$media .= "<h2>" .$place . "</h2>";
if($_POST['disclaim']=='Y'){
	$media .= "<h3>Regularly scheduled events may not take place on this day and the prior evening. Check with the sponsoring organization before travelling to the venue</h3>";
}
$media.="</td></tr></table>";
	
$media = htmlentities($media);
$activity=htmlentities($activity);
}else{
	$activity='  ';
}
//        $sql = "INSERT into events
//           SET Event_title = \"$place\",
//           Date_from = \"$event_date\",
//           Date_to = \"$event_date\",
//		   Resby = \"$event_date\",
//           Event_org = \"HOL\",
//           DOW = \"$dow\",
//           Activity=\"$activity\",
//		   media=\"$media\",
//           Price_members = \" \",
//           Price_guests = \" \",
//           Event_open = \"Y\",
//		   image=\"$holimage\",
//		   Event_priority = \"$priority\",
//           SUBMITTED_BY = \"holiday_entry\" ";
echo($sql);
		   
		  
		   $result = mysqli_query($conn,$sql);
		   if(mysqli_error($conn)!=''){
			   $return_message.="<br /> there was an error in execution";
			   $return_message.="br/>" . mysqli_error();
			   echo($return_messsage);
		   }

           
          if(!$result) {
		  $return_message.="<br />however something was wrong with the Sql";
		   $return_message.="<br />this is the sql";
		   $return_message.="<br />" .$sql;
			  echo($return_message);
          }else{
			  $return_message.="Event Posted";
			  echo($return_message);
        }
?>
