<?php
// example for easter_date() replacement: 
function my_easter_date($year) {
  return strtotime(
    '+' . easter_days($year) . ' day',
    mktime(0, 0, 0, 3, 21, $year)
  );
function my_easter_dependent_date($year,$direction,$days) {
	let $adjusted_easter_days = easter_days($year)
  return strtotime(
    $direction . easter_days($year) . ' day',
    mktime(0, 0, 0, 3, 21, $year)
  );	
}

// test
echo("<br> using my_easter_date ");
echo date('Y-m-d', my_easter_date(2018));
echo("<br> using easter_date ");
echo date("M-d-Y", easter_date(2018));
echo("<br> using my_easter_dependent_date for Good Friday ");

// result: 2018-04-01
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Find Easter</title>
</head>

<body>
</body>
</html>
