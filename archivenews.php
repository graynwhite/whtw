<?php
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
	  
//include_once("./cgi-bin/connect.inc");

$newslettersql = "select * from newsletters order by campaign Desc";
$newsresult = @mysql_query($newslettersql);
if ( !$newsresult ){

    echo("<p> The newsletter database could not be opened.  " . Mysql_error());
    exit;
}
?>
<html>
<?php include_once("http://www.peggyjostudio.net/pjtop.inc"); ?>
<style>
#otherleftstuff{
	visibility:hidden;
}
</style>
<body>

<?php

 echo("<div id=\"center\">");
 
echo "<h2> These archived newsletters contain the events and details as of the publication date and any changes are not included. If you are interested in seeing the current events for the next week that contain any changes after the publication please <a href=\"http://www.graynwhite.com/tweener.php\"> click here</a></h2>";

 echo("<table border=\"1\" ");
 echo("<tr><td colspan=\"5\"  align=\"center\">Archived Newsletters (Most recent is  first)</td></tr>");
 $row_count=0;
 while 
 ( $newsrow= @mysql_fetch_array($newsresult))
    {
    $news_url =  $newsrow['url'];
    $campaign=$newsrow['campaign'];

   if ( $row_count > 4 )
        { echo("</tr><tr>");
        $row_count=0;
        }
  $row_count= $row_count+1;
   echo("<td><a href=\"$news_url\">$campaign</a></td>");
    }

?>

    </table> <!--end of table of archive newsletters-->
	
<script type="text/javascript">

// Google Internal Site Search script- By JavaScriptKit.com (http://www.javascriptkit.com)
// For this and over 400+ free scripts, visit JavaScript Kit- http://www.javascriptkit.com/
// This notice must stay intact for use

//Enter domain of site to search.
var domainroot="www.peggyjostudio.net"

function Gsitesearch(curobj){
curobj.q.value="site:"+domainroot+" "+curobj.qfront.value
}

</script>


<form action="http://www.google.com/search" method="get" onSubmit="Gsitesearch(this)">

<p>Search Peggy Jo studio with JavaScript Kit:<br />
<input name="q" type="hidden" />
<input name="qfront" type="text" style="width: 180px" /> <input type="submit" value="Search" /></p>

</form>

<p style="font: normal 11px Arial">This free script provided by<br />
<a href="http://www.javascriptkit.com">JavaScript Kit</a></p>
	
<h2>Newsletter</h2>
		<p>Sign up to the Peggy Jo Studio Newsletter and you will be kept up to date on many events.</p>
		<form name="ccoptin" action="http://ccprod.roving.com/roving/d.jsp" target="_blank" method="post">
			<p><strong>Email Address:</strong></p>
			<p><input type="text" name="ea" class="textbox" />
                        <input type=hidden name="m" value="1011148101198">
                        <input type=hidden name="p" value="oi">
                        <input type="submit" value="Submit" class="button" /></p>
		</form>
</div> <!--end of table content-->
<?php include("http://www.peggyjostudio.net/pjnav.inc");?>

<p><a href="http://validator.w3.org/check/referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0!" height="31" width="88" /></a></p>


</div> <!--end of content-->
</div> <!--end of page -->
</body>

</html>


