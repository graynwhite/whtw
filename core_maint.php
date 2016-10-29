
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Coresponent Maintenance Form</title>

</head>

<body>

<h1>Corespondent Maintenance Form</h1>
<?PHP
	if (isset($additem)):
?>	
	

<form method="POST" action="<?=$PHP_SELF?>" method="post">

  <P>Email address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="email" size="40"></p>
  <p>Organization ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="valid_org" size="5"></p>

  <p align="center"><input type="submit" value="Submit" name="submit"></p>
</form>
<?
   else:
   include("../cgi-bin//connect.inc");
   
   if ($submit == "Submit") {
   $sql="insert into core
          set email = \"$email\",
          valid_org = \"$valid_org\"
          ";
          if (@mysql_query($sql)) {
          	echo("<p> Corespondent has been added </p>");
          } else {
          	echo("<p> Corespondent was not Added " . mysql_error() . "</p>");
          	}
 }
 if (isset($deleteitem)){
        $sql="DELETE from core where i_number = \"$deleteitem\"";
        if (@mysql_query($sql)){
                echo("<p>The item was deleted</P>");
                }else{
                echo("<P> Error deleteing item" . mysql_error() . "</P>
                ");
                }
 }
		echo("<p> Here are all the Coresponents on file</P>");
		$result = @mysql_query(" SELECT * FROM core order by
                email");
		if (!$result){
			echo("<P>Error performing query Email this information to webmaster@graynwhite.com: " . mysql_error() . "</p>");
			exit;
			}
		while ($row = mysql_fetch_array($result)){
                        $itemid=$row["i_number"];
			echo("<p>". $row["email"] . "  " . $row["valid_org"] .
                         "  <a href='$PHP_SELF?deleteitem=$itemid'>
                         delete this item</a></p>");
                       }
                        echo("<P><a href=\"$PHP_SELF?additem=1\">Add</a></P>");
                        endif;
?>

</body>

</html>