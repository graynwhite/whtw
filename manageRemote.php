<?PHP
$filePrefix = isset($_GET['prefix']) ? $_GET['prefix'] : '';
$fileName =  $_GET['prefix'] == 'g' ? 'geven' : 'event';

//Open images directory
$dir = dir("../newsletter");
$file_array = array();
//List xml files in _private directory
while (($file = $dir->read()) !== false)
{
	if(substr($file,-3,3)== 'xml' & substr($file,0,5)== $fileName){
	//echo "filename: " . $file . "<br />";
	$file_array[]=$file;
	}
}

$dir->close();
rsort($file_array);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Remote Entry Files</title>
	<meta name="viewport" content="width=device-width, user-scalable=yes" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<!--<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	
	
	<link rel="stylesheet" href="../whtw/mobile.css"/>
-->	
		
		
		<!--<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>-->
		
		
</head>

<body>
<div data-role="page" id="mainpage">
<div data-role="header"><h2>Manage Remote Entry Files <?php echo $filePrefix ?> </h2></div>
<div data-role="content">
<table width="100%" height="28" border="1">
  <tr>
    <th width="36%" scope="col">File</th>
    <th width="32%" scope="col">Submitted</th>
	    <th width="29%" scope="col">Action</th>
  </tr>
  <?php
  foreach($file_array as $fileName)
  {
  	echo "<tr> \n";
	echo "<td> " . $fileName . "</td>\n";
	$submitted = substr($fileName,5,4) ."-" . substr($fileName,9,2) ."-" . substr($fileName,11,2) . " at " . substr($fileName,13,2) . ":". substr($fileName,15,2) . ":" . substr($fileName,17,2);
	echo "<td> " . $submitted . "</td >\n";
	
    echo "<td> <a href=\"deleteRemote.php?file=" .$fileName . "\"> Delete </a>  <a href=\"processRemote.php?file=$fileName\">Process</a><a href=\"viewRemote.php?file=" . $fileName . "\">View</a></td>";
    echo "</tr>";
   }
  ?>
</table>
</div><!-- end of Content -->
<div data-role="footer"><h1>Remote Entries</h1></div>
</div><!-- end of Page-->
</body>
</html>
