<?php
function compose_element($tab,$fieldName,$fieldValue)
{
	$this->text =$tab . "<" .$fieldName . "> " . $_POST[$fieldValue] . "</" . $fieldName . "> \n";
	return $this->text;
}

$xmltext = "<event> \n";
$xmltext .= "<type>New</type> \n";
$xmltext .= compose_element("\t ",'become_publicist','Sign_up');
$xmltext .= compose_element("\t ",'orgname','Orgname');
$xmltext .= compose_element("\t",'submitName','yourName');
$xmltext .= compose_element("\t ",'phone',"phone");
$xmltext .= compose_element("\t",'submitBy','EMAILID');
$xmltext .= compose_element("\t ",'From_date',"From_date");
$xmltext .= compose_element("\t ",'To_date',"to_date");
$xmltext .= compose_element("\t ",'reserve_by',"resby");
$xmltext .= compose_element("\t ",'From_date',"From_date");
$xmltext .= compose_element("\t ",'From_date',"From_date");
$xmltext .= compose_element("\t ",'From_date',"From_date");
$xmltext .= "<Place> \n";
$xmltext .= compose_element("\t ",'place_name',"place_name");
$xmltext .= compose_element("\t ",'place_address',"place_address");
$xmltext .= compose_element("\t ",'city',"city");
$xmltext .= compose_element("\t ",'state',"state");
$xmltext .= compose_element("\t ",'Zip',"Zip");
$xmltext .= compose_element("\t ",'place_phone',"phone");
$xmltext .= compose_element("\t ",'place_url',"url");
$xmltext .= compose_element("\t ",'place_email',"place_email");
$xmltext .= compose_element("\t ",'place_directions',"Place");
$xmltext .= "</Place>\n";
$xmltext .= compose_element("\t ",'activity',"activity");
$xmltext .= compose_element("\t ",'Price_members',"Price_members");
$xmltext .= compose_element("\t ",'Recurring_event',"recurring");
$xmltext .= compose_element("\t ",'Monday',"MON");
$xmltext .= compose_element("\t ",'Tuesday',"TUE");
$xmltext .= compose_element("\t ",'Wednesday',"WED");
$xmltext .= compose_element("\t ",'Thursday',"THU");
$xmltext .= compose_element("\t ",'Friday',"FRI");
$xmltext .= compose_element("\t ",'Saturday',"SAT");
$xmltext .= compose_element("\t ",'Sunday',"SUN");
$xmltext .= compose_element("\t ",'First_week',"first");
$xmltext .= compose_element("\t ",'Second_week',"second");
$xmltext .= compose_element("\t ",'Third_week',"third");
$xmltext .= compose_element("\t ",'Fourth_week',"fourth");
$xmltext .= compose_element("\t ",'Fifth_week',"fifth");
$xmltext .= compose_element("\t ",'Last_week',"last");
$xmltext .= compose_element("\t ",'Recur_begin_date',"recurbegin");
$xmltext .= compose_element("\t ",'Recur_end_date',"recurend");

echo $xmltext;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
