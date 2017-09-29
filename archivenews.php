<?php
define("APP_ROOT", $_SERVER['DOCUMENT_ROOT'].'/whtw
');
require_once "../gwsecurity/private/initialize.php";
/** @package 

        archivenews
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 12/28/2004 2:08:58 PM
	Last change: FJC 7/24/2005 9:15:33 AM
*/
?>
<?php $page_title = "Peggy Jo Studio-Archived newsletters";
      $page_top_text = "Peggy Jo Studio Archived Newsletters";
define('WP_MEMORY_LIMIT', '96M');	  
	  

$sql = "select * from newsletters order by campaign Desc";

$result = mysqli_query($conn,$sql);
if ( !$result ){

    echo("<p> The newsletter database could not be opened.  " . Mysqli_error($result));
    exit;
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>Archived Newsletters</title>
<link rel="stylesheet" type="text/css" href="./css/pjstyles.css"
</head>
<body>
<div id="center">
<h2> These archived newsletters contain the events and details as of the publication date and any changes added after publication are not included. </h2>
<p>At the present time, we are not able to add any current archved publications.Some of the links might not work(Portions of the newsletter are no longer available)</p>
<table border="1" width="100%">;
<tr><td colspan="5"  align="center">Archived Newsletters (Most recent is  first)</td></tr>");
 <?php
 $row_count=0;
 while 
 ( $newsrow= @mysqli_fetch_array($result))
    {
	$campaign=$newsrow['campaign'];	
	$news_url="http://www.peggyjostudio.net/";
	$news_url.=$newsrow['url'];	
   
	
//echo("<br>campaign is:".$campaign);		
//echo("<br>news_url is :".$news_url);
       if ( $row_count > 4 )
        { echo("</tr><tr>");
		 $row_count=0;
        }
  $row_count++;
   echo("<td height=\"10\"><a href=\"$news_url\">$campaign</a></td>");
    }

?>

    </table> <!--end of table of archive newsletters-->
	


	
<h2>&nbsp;</h2>
</div> <!--end of table content-->
<?php include("pjnavcopy.php");?>
<p><a href="http://validator.w3.org/check/referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0!" height="31" width="88" /></a></p>


</div> <!--end of content-->
</div> <!--end of page -->
</body>

</html>


