<?php
require_once("../phpClasses/Class_blog_links.php");
require_once('../cgi-bin/connect.inc');
$return ='';
$bl2 = new blog_links;
$field_names = array('orgid','contactName','contactTel','contactCell','contactEmail','releaseDate','epilouge','boilerplate');
$input_fields = explode("|",$_GET['dataToUpdate']);

for($i = 1;$i< count($input_fields);$i++)
{
	$return .= $bl2->insert_or_update_parameters($input_fields[0],$field_names[$i],$input_fields[$i]);
}
echo $return
?>



