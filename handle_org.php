<?PHP
    include("../cgi-bin//connect.inc");
   if ( $Submit == "Submit") {
   $sql="update  orgs
          set Org_generate = '$Org_generate',
          Org_name = '$Org_name',
          Short_name = '$Short_name',
          Org_url = '$Org_url',
          Org_link_text = '$Org_link_text'
          where Org_num = '$Org_num'
          ";
          if (@mysql_query($sql)) {
          	echo("<p> Update was performed </p>");
          } else {
          	echo("<p>Update was not performed " . mysql_error() . "</p>");
          	}
          }	
?>	
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Organization Maintenance Form</title>
<meta NAME="generator" CONTENT="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
</head>
<body>
<h1>Organization Maintenance Form</h1>

<?PHP
  
   echo("<p> Looking for $changeorg </p>");
   $result = @mysql_query(" SELECT * FROM orgs where Org_num =  \"$changeorg\"  " );
		if (!$result){
		  echo("<P>Error performing query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p>");
                     	exit;
			}
	     if   ($row = mysql_fetch_array($result)){
                   
           echo("<form method=\"POST\" action=\"$PHP_SELF\">\n");
           echo("<p>Organization ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"Org_num\" size=\"5\" value=\"");
           echo($row["Org_num"] . "\"></p>\n");
           echo("<p>Generate HTML&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
           echo("<input type=\"text\" name=\"Org_generate\" size=\"1\" value=\"" . $row["Org_generate"] ."\"></p>\n");
           echo("<p>Organization Name&nbsp; <input type=\"text\" name=\"Org_name\" size=\"48\" value=\"" . $row["Org_name"]. "\"></p>\n");
           echo("<p>Short Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
           echo(" <input type=\"text\" name=\"Short_name\" size=\"16\" value=\"" . $row["Short_name"] . "\"></p>\n");
           echo("<p>URL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
           echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");   
           echo(" <input type=\"text\" name=\"Org_url\" size=\"48\" value=\"" .$row["Org_url"] . "\"></p>\n");
           echo("<p>Link Text&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
           echo("<input type=\"text\" name=\"Org_link_text\" size=\"20\" value=\"" .$row["Org_link_text"] . "\"></p>\n");
           echo("<p align=\"center\"><input type=\"submit\" value=\"Submit\" name=\"Submit\"></p>\n");           
           echo("</form>");    
            }
?>
</body>

</html>	


 

	
