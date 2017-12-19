<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Third monday</title>
</head>

<body>
</body>
</html>
<?php
   date_default_timezone_set('America/Detroit');

   $currmonth = date("n");
   $curryear = date("Y");
   $currthirdmon =  date("d", strtotime("third monday", mktime(0,0,0,$currmonth,1,$curryear)));

   if ($currthirdmon < date("d"))
   {
    $nextmeeting = date("l F d, Y", strtotime("third monday", mktime(0,0,0,$currmonth+1,1,$curryear)));
   }
   else
   {
     $nextmeeting = date("l F d, Y", strtotime("third monday", mktime(0,0,0,$currmonth,1,$curryear)));
   }

   print $nextmeeting;
?>