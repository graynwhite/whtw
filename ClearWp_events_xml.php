<?php
$wp_event_xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$wp_event_xml .= "<events>\n";
$wp_event_xml .= "</events>";
$xmlfilename="../_private/wp_events.xml";

if ($fp = fopen($xmlfilename, 'w'))
{
	fwrite($fp,$wp_event_xml);
	fclose($fp);
	echo "file $xmlfilename was cleared and written";
}else
{
	echo "file $xmlfilename was not written";
	
}
?>
