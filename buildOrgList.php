<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Build Org list</title>
</head>

<body>
<?PHP

require_once($_SERVER['DOCUMENT_ROOT']. "/phpClasses/connect.php");

$orglist="";


 $sql = "select * from orgs order by Org_name ";
$result = mysqli_query($conn,$sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to cauleyfrank@gmail.com" . " " . $sql . " " . mysql_error() . " </p>");
	 		exit;
     		}
else{
$orglist="<td width=\"191\" height=\"23\">Organization Name: </td>\n";
$orglist.="<td width=\"294\" height=\"23\" ><select name=\"Org\"  size=\"1\"  >";
$orglist.="<option value= \"    \" selected> Select an organization";
  
while ($row=mysqli_fetch_assoc($result)){
$orglist.="<option value= " .$row['Org_num']. ">" .$row['Org_name'] ."</opton>\n";
  }
  
$orglist.="</select></td >";
$fileToWrite=$_SERVER['DOCUMENT_ROOT'] ."/newsletter/orgList.inc";
$newfile=fopen($fileToWrite,"w");
fwrite($newfile,$orglist);
fclose($newfile);
echo("orglist.inc re-written");
}
?>
</body>
</html>