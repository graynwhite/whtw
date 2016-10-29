<?php
/** @package 

        holiday_input
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 11/22/2004 8:05:05 PM
	Last change: FJC 11/22/2004 8:13:09 PM
*/
?>



<?php

include("../cgi-bin/connect.inc");
 /*if ( $_POST['pass'] != "6r1n11" ){
    echo("<p> You are not authorized to use this system</P>");
    exit;
	*/
function decode_entities($act){
}
$SQL = "update events set Activity = decode_entities(Activity) where Event_number = 28841";
          
           
		   
             $result = @mysql_query($SQL);
          if (!$result) {
          echo("<p> Error in insert  Email this information to webmaster@graynwhite.com" . mysql_error() . "</p><p>" . $SQL . "</php>");
          }else{
            Print("Event changed<p>");
        }

?>
