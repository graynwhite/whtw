<?PHP
$fileToClear =  $_GET['file'];
echo 'Trying to delete this file ' .$fileToClear . "<br />";
$old = getcwd(); // Save the current directory
echo 'old path is ' . $old . "<br />";
chdir('_private');
$new = getcwd();
    echo ' directory changed to ' . $new  . "<br />";
	
    $result = unlink($fileToClear);
	if($result == 1){
	echo ' File deleted  <br />';
	}else{
	echo ' File not deleted  <br />';
	}
    chdir($old); // Restore the old working directory    

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete reccomendation  Entry File</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="manageRecomendations.php">
  Manage Remote Reccommendation Files
  <input type="submit" name="Submit" value="Submit" />
</form>
</body>
</html>
