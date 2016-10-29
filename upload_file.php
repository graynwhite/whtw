<?php
$upload_errors=array(
UPLOAD_ERROR_OK			=>	"No errors",
UPLOAD_ERROR_INT_SIZE	=>	"Larger than upload_max_filesize",
UPLOAD_ERROR_FORM_SIZE	=>	"Larger than form_max_filesize",
UPLOAD_ERROR_PARTIAL	=>	"Partial upload",
UPLOAD_ERROR_NO_FILE	=>	"No file",
UPLOAD_ERROR_NO_TMP_DIR	=>	"No temporary directory",
UPLOAD_ERROR_CANT_WRITE	=>	"Can't write to the disk",
UPLOAD_ERROR_EXTENSION	=>	"File upload stopped by extension" 
);
$upload_errors2=array(
"No errors","larger than upload_max_filesize","larger than form_max_filesize",
"Partial upload","No file", "deprecated","No temporary directory","can't write to disk",
"File upload stopped by extension"
);
if(isset($_POST['submit'])){
	$tmp_file=$_FILES['file_upload']['tmp_name'];
	$target_file=basename($_FILES['file_upload']['name']);
	$upload_dir="uploads";
	if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)){
		$message="File uploaded Successfully.";
	}else{
		$error= $_FILES['file_upload']['error'];
		$message=$upload_errors2[$error];
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload File</title>
</head>

<body>
<?php if(!empty($message)){ echo "<p>{$message}</p>";} ?>
<form action="upload_file.php" enctype="multipart/form-data" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
<input type="file" name="file_upload" />
<input type="submit" name="submit" value="upload" />
</form>

</body>
</html>