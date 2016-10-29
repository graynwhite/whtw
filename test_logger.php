<?php
require_once("../phpClasses/Class_logger.php");
$log= new logger;
$file= site_root.DS.'whtw'.DS.errror_log;
$file='error_log';
			
		
		
		$report2 = $log->display_log($file);	
		$report = $log->clear_log($file);
			
			
			
			
			
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Error Log</title>
</head>

<body>
<div>
<p>This is the report</p>
<?php echo $report2; ?>


</div>
</body>
</html>