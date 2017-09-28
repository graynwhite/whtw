<?php
define("APP_ROOT", $_SERVER['DOCUMENT_ROOT'].'whtw');
require_once "../gwsecurity/private/initialize.php";
/** @package 

        newsletter_add
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 1/4/2005 12:43:01 AM
	Last change: FJC 2/13/2005 7:03:05 PM
*/
?>
<?php
 
?>
</body></html>
<?php		
       // include("../cgi-bin/accescontrol.php");
if ( $_REQUEST['action'] == "Delete" ) {
            $sql = "delete from newsletters where  campaign = \"" . $_REQUEST['campaign'] . "\"";

        $result = @mysqli_query($conn,$sql);  
 	if (!$result) {
		
	}else{ 
	echo("Newsletter Deleted");
		
	}

}

  include("./my_newsletter_form_head.php");
 
if($_REQUEST['submit'] =='submit'){

 $carray = explode("-",$_REQUEST['new_date']);
  $campaign = "Newsletter ". $carray[0]. "/" . $carray[1] . "/" . $carray[2];
  
  $url = "Events for week of " .$carray[1]. "-" . $carray[2] . "-" . $carray[0] . ".htm";
  printf("
</p>
<p> Newslettr = %s  url is %s ", $campaign, $url);
$sql = "insert into newsletters set campaign = \"$campaign\",url=\"$url\" ";
 $result = mysql_query($sql);
 	if (!$result) {
	        echo("
<p> Your inquiry  was rejected Email this information to cauleyfrank@gmail.com" . $sql . mysql_error() ." </p>
<p>");
  exit;
  }
 $last_id= mysql_insert_id();
 } 
?>