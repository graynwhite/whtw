<?php
/** @package 

        newsletter_add
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 1/4/2005 12:43:01 AM
	Last change: FJC 2/13/2005 7:03:05 PM
*/
?>
<?php
 // include("./cgi-bin/common.php");

        include("../cgi-bin/connect.inc");
?>
</body></html>
<?php		
       // include("../cgi-bin/accescontrol.php");
if ( $_GET['action'] == "delete" ) {
            $sql = "delete from newsletters where  campaign = \"" . $_GET['campaign'] . "\"";

        $result = @mysql_query($sql);  
 	if (!$result) {
	}
exit;
}

  include("./my_newsletter_form_head.php");
 
if($_GET['submit'] =='submit'){

 $carray = explode("-",$_POST['new_date']);
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