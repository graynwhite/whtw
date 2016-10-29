<?PHP
$fileToClear =  $_GET['file'];
echo 'Trying to delete this file ' .$fileToClear . "<br />";
$old = getcwd(); // Save the current directory
echo 'old path is ' . $old . "<br />";
chdir('../_private');
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
<title>Delete Remote Entry File</title>
<script language="javascript">
function checkForm()
{
//alert("at checkform"); 
if(document.form1.fileDeleted.value.match(/^geven/))
	{
	document.form1.action='manageRemote.php?prefix=g';
	}
return true
}
</script>	
</head>

<body>
<form  id="form1" name="form1" method="post" action="manageRemote.php">

  <p>
    <label>File Deleted
    <input name="fileDeleted" type="text" id="fileDeleted" value="<? echo  $fileToClear ?>"  size="60" maxlength="120"60 />
    </label>
  </p>
  <p>Manage Remote Entry Files
    <input type="submit" onc name="Submit" value="Submit" onclick="checkForm()"  />
    </p>
</form>
</body>
</html>
