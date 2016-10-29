<?php
require_once('../cgi-bin/connect.inc');
require_once("../phpClasses/Class_evententry.php");
require_once("../phpClasses/class_events.php");
$ee = new eventEntry;
$ev = new events;
$date_returned= $ee->getNextWeekDay('Thu',$edition);
		$begin_date = $date_returned['date_begin'];
		$end_date = $date_returned['date_end'];
		$pubdate = $date_returned['pubdate'];

$weekOfMonth = $ee->getWeekOfTheMonth($begin_date);
//echo "week of the month is " . $weekOfMonth	;
$weekOfYear = $date_returned['wkOfYear'];
//echo "<br>Week of year is " . $weekOfYear;
$events=$bl2->get_events_for_day($date_returned['select1'],false);

$events='';
$events=$bl2->get_events_for_day($date_returned['select2'],false)
$events='';
$events=$bl2->get_events_for_day($date_returned['select3'],false);

$events='';
$events=$bl2->get_events_for_day($date_returned['select4'],false);

$events='';
$events=$bl2->get_events_for_day($date_returned['select5'],false,true);

$events='';
$events=$bl2->get_events_for_day($date_returned['select6'],false);
$events='';
$events=$bl2->get_events_for_day($date_returned['select7'],false);

$events='';
$events=$bl2->get_events_for_day($date_returned['select8'],true);


?>