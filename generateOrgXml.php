<?PHP
require_once("../cgi-bin/connect.inc");
require_once("../phpClasses/Class_orgs.php");
require_once("../phpClasses/class_xml_parser.php");
function orgxml($name,$code)

{
	$cdataStart = "<![CDATA[";
	$cdataEnd = "]]>";
	$outstring="\t\t<org>\n";
	$outstring.="\t\t\t<orgName>" .$cdataStart. $name . $cdataEnd . "</orgName>\n";
	$outstring.="\t\t\t<orgCode>" . $code . "</orgCode>\n";
	$outstring.="\t\t</org>\n";
	return $outstring;
}

$xmlText="<?xml version=\"1.0\" encoding=\"utf-8\"?>";
$xmlText.= "\n\n<orgs> \n";
$query="select Org_num, Org_name from orgs order by Org_name";
$result=mysql_query($query);

while($row = mysql_fetch_array($result))
{
	$xmlText.=orgxml(trim($row['Org_name']),$row['Org_num']);
}

$xmlText .= orgxml("Other Events","Other");

$xmlText.= "\n</orgs>";
echo $xmlText;
$fp = fopen('../whtw/artFestivalOrgs.xml', 'w');
		    fwrite($fp, $xmlText);


fclose($fp);

?>
