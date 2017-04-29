<?php
define("APP_ROOT", $_SERVER['DOCUMENT_ROOT'].'/whtw');
require_once "../gwsecurity/private/initialize.php";
?>
<!DOCTYPE html> 
<html>
<?php
$ptr = isset($_GET['ptr'])?$_GET['ptr']: 0;	
$add = new advertising;
$premier_array= array();
$premier_array =$add->selectAdd(1);
shuffle($premier_array);
print("<br />");
print_r($premier_array);

$secondary_array= array();
$secondary_array =$add->selectAdd(2);
print("<br />");

shuffle($secondary_array);
print_r($secondary_array);
$tertiary_array= array();
$tertiary_array =$add->selectAdd(3);
shuffle($tertiary_array);
print("<br />");
print_r($tertiary_array);


print ("<br /> now going to print the newsletter array");
$newsletter_array = array();
$newsletter_array = array_merge($premier_array,$secondary_array,$tertiary_array);
print("<br /> newsletter array <br />");
print_r($newsletter_array);

$html="<div style=\"font-weight:bold; font-size:16px; color:#003366; font-style:normal; font-family:'Times New Roman', Times, serif; width:185px\" 
                  >Please Patronize Our Sponsors.
				  </div>
				  
                  <div 
                  style=\"font-weight: normal; font-size: 12pt; color: #000000; font-style: normal; FONT-FAMILY: Verdana,Geneva,Arial,Helvetica,sans-serif; width:185px\" 
                  >Please let them know that you saw it in the Peggy Jo 
                  Studio Newsletter. </div>";

for ($i=0;$i<count($newsletter_array);$i++)
{
$html.=html_entity_decode($add->getAdd($newsletter_array[$i]));
}
print $html;

$file = $_SERVER['DOCUMENT_ROOT']."/newsletter/advertising.php";

$fp = fopen($file,"w") or die("Could not open ". $file);
		fwrite($fp,$html);
		fclose($fp);
	
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Select Advertising</title>
</head>

<body>
</body>
</html>
