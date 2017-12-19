Impressum
Jewish calendar calculation in PHP

Source code Copyright © by Ulrich and David Greve (2005) 
The code is freely usable for non-profit purposes when this Copyright notice is included.

Table Of Contents

Determining if a Jewish year is a leap year
Numbering of the Jewish months, converting a Jewish month number into a string
Converting Gregorian dates to Jewish dates
Converting Jewish dates to Gregorian dates
Getting the weekday of a Gregorian or Jewish date
Getting the number of days in a Gregorian or Jewish month
Sunrise, sunset, degrees below horizons, proportional hours (only PHP 5)
Calculating Israeli Daylight Savings Time
Calculating Jewish holidays
Calculating weekly torah sections
Determining if a Jewish year is a leap year

A Jewish year is a leap year if the year modulo 19 is either 0, 3, 6, 8, 11, 14 or 17. Therefore, an easy function can be written:

function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

$result = isJewishLeapYear(5765);
echo "<p>Is 5765 a leap year? ";
if ($result)
  echo "yes";
else
  echo "no";
echo "</p>\n";
$result = isJewishLeapYear(5766);
echo "<p>Is 5766 a leap year? ";
if ($result)
  echo "yes";
else
  echo "no";
echo "</p>\n";
Numbering of the Jewish months, converting a Jewish month number into a string

The Jewish months are numbered in the following way:

in PHP 5.5:

Name of Jewish month	Month number
Tishri	1
Heshvan	2
Kislev	3
Tevet	4
Shevat	5
Adar I (in leap years), unused in non-leap years	6
Adar (in non-leap years), Adar II (in leap years)	7
Nisan	8
Iyar	9
Sivan	10
Tammuz	11
Av	12
Elul	13
in PHP 5.4 or older:

Name of Jewish month	Month number
Tishri	1
Heshvan	2
Kislev	3
Tevet	4
Shevat	5
Adar (in non-leap years), Adar I (in leap years)	6
Adar II (in leap years), unused in non-leap years	7
Nisan	8
Iyar	9
Sivan	10
Tammuz	11
Av	12
Elul	13
When displaying a month name string, you should distinguish between leap years and non-leap years in order to correctly display the month name of Adar. The following function getJewishMonthName helps:

Code for PHP 5.5:

function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

function getJewishMonthName($jewishMonth, $jewishYear) {
  $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                "Shevat", "Adar I", "Adar II", "Nisan",
                                "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                   "Shevat", "", "Adar", "Nisan",
                                   "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  if (isJewishLeapYear($jewishYear))
    return $jewishMonthNamesLeap[$jewishMonth-1];
  else
    return $jewishMonthNamesNonLeap[$jewishMonth-1];
}

$monthStr = getJewishMonthName(6, 5765);
echo "<p>Month 6 in 5765: $monthStr</p>\n";
$monthStr = getJewishMonthName(6, 5766);
echo "<p>Month 6 in 5766: $monthStr</p>\n";
Code for PHP 5.4 or older:

function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

function getJewishMonthName($jewishMonth, $jewishYear) {
  $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                "Shevat", "Adar I", "Adar II", "Nisan",
                                "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                   "Shevat", "Adar", "", "Nisan",
                                   "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  if (isJewishLeapYear($jewishYear))
    return $jewishMonthNamesLeap[$jewishMonth-1];
  else
    return $jewishMonthNamesNonLeap[$jewishMonth-1];
}

$monthStr = getJewishMonthName(6, 5765);
echo "<p>Month 6 in 5765: $monthStr</p>\n";
$monthStr = getJewishMonthName(6, 5766);
echo "<p>Month 6 in 5766: $monthStr</p>\n";
Converting Gregorian dates to Jewish dates

In order to convert a Gregorian date to a Jewish date, use the gregoriantojd function to convert the Gregorian date into a Julian day number and the jdtojewish function to convert the Julian day number to a Jewish date.

The gregoriantojd function takes the month, day and year (in that order) of the Gregorian date and returns the corresponding Julian day number. Then you can pass the returned Julian day number to the jdtojewish function which returns a string of the form MM/DD/YYYY containing the Jewish month, day and year of the passed Julian day number.

Example:

for PHP 5.5:

function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

function getJewishMonthName($jewishMonth, $jewishYear) {
  $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                "Shevat", "Adar I", "Adar II", "Nisan",
                                "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                   "Shevat", "", "Adar", "Nisan",
                                   "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  if (isJewishLeapYear($jewishYear))
    return $jewishMonthNamesLeap[$jewishMonth-1];
  else
    return $jewishMonthNamesNonLeap[$jewishMonth-1];
}

$jdNumber = gregoriantojd(2, 25, 1996);
$jewishDate = jdtojewish($jdNumber);
list($jewishMonth, $jewishDay, $jewishYear) = explode('/', $jewishDate);
$jewishMonthName = getJewishMonthName($jewishMonth, $jewishYear);
echo "<p>The 25 February 1996 is the $jewishDay $jewishMonthName $jewishYear</p>\n";
for PHP 5.4 or older:

function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

function getJewishMonthName($jewishMonth, $jewishYear) {
  $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                "Shevat", "Adar I", "Adar II", "Nisan",
                                "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                   "Shevat", "Adar", "", "Nisan",
                                   "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  if (isJewishLeapYear($jewishYear))
    return $jewishMonthNamesLeap[$jewishMonth-1];
  else
    return $jewishMonthNamesNonLeap[$jewishMonth-1];
}

$jdNumber = gregoriantojd(25, 2, 1996);
$jewishDate = jdtojewish($jdNumber);
list($jewishMonth, $jewishDay, $jewishYear) = explode('/', $jewishDate);
$jewishMonthName = getJewishMonthName($jewishMonth, $jewishYear);
echo "<p>The 25 February 1996 is the $jewishDay $jewishMonthName $jewishYear</p>\n";
Converting Jewish dates to Gregorian dates

If converting a Jewish date to a Gregorian date, the function jewishtojd with parameters month, day and year has to be used to convert a Jewish date into a Julian day number. Then, the function jdtogregorian converts the Julian day number into a string of the form MM/DD/YYYY which contains the Gregorian month, day and year of the passed Julian day number.

Example:

$jdNumber = jewishtojd(2, 13, 5765);
$gregorianDate = jdtogregorian($jdNumber);
list($gregorianMonth, $gregorianDay, $gregorianYear) = explode('/', $gregorianDate);
$gregorianMonthNames = array("January", "February", "March", "April",
                             "May", "June", "July", "August", "September",
                             "October", "November", "December");
$gregorianMonthName = $gregorianMonthNames[$gregorianMonth-1];
echo "<p>The 13 Heshvan 5765 is the $gregorianDay $gregorianMonthName $gregorianYear</p>\n";
Getting the weekday of a Gregorian or Jewish date

Given a Julian day number, the weekday of a date can be easily determined by the jddayofweek function which takes the Julian day number and a mode, which determines how to return the weekday (as a number or as a string), as arguments.

In this example, mode 0 is used so that 0 is returned for Sunday, 1 is returned for Monday, and so on:

$jdNumber = gregoriantojd(5, 21, 1993);
$weekdayNo = jddayofweek($jdNumber, 0);
$weekdayNames = array("Sunday", "Monday", "Tuesday", "Wednesday",
                      "Thursday", "Friday", "Saturday");
$weekdayName = $weekdayNames[$weekdayNo];
echo "<p>The 21 May 1993 is a $weekdayName.</p>\n";
Getting the number of days in a Gregorian or Jewish month

The function cal_days_in_month returns the days in a specified month which occurs in the specified year. As the parameters, it takes the type of calendar (CAL_GREGORIAN or CAL_JEWISH), the month and the year.

Example:

$days = cal_days_in_month(CAL_GREGORIAN, 2, 2000);
echo "<p>Count of days in February 2000: $days</p>\n";
$days = cal_days_in_month(CAL_GREGORIAN, 2, 2001);
echo "<p>Count of days in February 2001: $days</p>\n";
$days = cal_days_in_month(CAL_JEWISH, 3, 5765);
echo "<p>Count of days in Kislev 5765: $days</p>\n";
$days = cal_days_in_month(CAL_JEWISH, 3, 5767);
echo "<p>Count of days in Kislev 5767: $days</p>\n";
Sunrise, sunset, degrees below horizons, proportional hours (only PHP 5)

In PHP 5, calculation of sunrise, sunset and degrees below horizon are possible with the following functions:

date_sunrise(timestamp, format, latitude, longitude, zenith, gmt_offset)
date_sunset(timestamp, format, latitude, longitude, zenith, gmt_offset)
They can calculate either sunrise, sunset or sunrise/sunset with degrees below horizon.

The date is given in timestamp which can be generated by the function mktime which takes an hour, minute, second, month, day and year (in that order) and returns a timestamp. Example: mktime(0, 0, 0, 5, 21, 1993)

The parameter format can be, for example, SUNFUNCS_RET_STRING which returns a string like 16:46. This string can be e.g. splitted into hours and minutes for further calculation.

The information about the location is given in the latitude, longitude and gmt_offset parameters. latitude specifies a latitude in the North when being positive and in the South when being negative. longitude specifies a longitude in the East when being positive and in the West when being negative. If specifying a latitude and longitude in degrees/minutes format, you have to apply the formula degrees+minutes/60 when passing the values to the function. gmt_offset is the timezone of the location, e.g. 1 means GMT+1.

With the value zenith, you can specify whether sunrise/sunset with or without degrees below horizon is calculated. When specifying 90+50/60, sunrise/sunset without degrees below horizon is calculated. If you want to calculate x degrees below horizon, specify 90+x as the parameter.

An example: The city of Pforzheim has latitude 48 degrees 54 minutes North, longitude 8 degrees 42 minutes East and time zone GMT+1. We want to calculate 18 minutes before sunset on Friday, 21 May 1993, and 45 minutes after sunset as well as 8.5 degrees below horizon on Saturday, 22 May 1993.

$timestamp = mktime(0, 0, 0, 5, 21, 1993);
$resultStr = date_sunset($timestamp, SUNFUNCS_RET_STRING, 48+54/60, 8+42/60, 90+50/60, 1);
list($resultHour, $resultMin) = explode(':', $resultStr);
$resultMin -= 18;
while ($resultMin < 0) {
  $resultMin += 60;
  $resultHour--;
}
echo "<p>18 minutes before sunset on 21 May 1993: $resultHour:$resultMin</p>\n";

$timestamp = mktime(0, 0, 0, 5, 22, 1993);
$resultStr = date_sunset($timestamp, SUNFUNCS_RET_STRING, 48+54/60, 8+42/60, 90+50/60, 1);
list($resultHour, $resultMin) = explode(':', $resultStr);
$resultMin += 45;
while ($resultMin >= 60) {
  $resultMin -= 60;
  $resultHour++;
}
echo "<p>45 minutes after sunset on 22 May 1993: $resultHour:$resultMin</p>\n";

$timestamp = mktime(0, 0, 0, 5, 22, 1993);
$resultStr = date_sunset($timestamp, SUNFUNCS_RET_STRING, 48+54/60, 8+42/60, 90+8.5, 1);
list($resultHour, $resultMin) = explode(':', $resultStr);
echo "<p>8.5 degrees below horizon after sunset on 22 May 1993: $resultHour:$resultMin</p>\n";
For calculating Zmanim, besides sunrise, sunset and degrees below horizon, also the calculation of proportional hours is needed. The time from sunrise to sunset is divided into 12 proportional hours. For example, Kriat Shema (GR"O) is calculated according to 3 proportional hours after sunrise. This can be calculated by the following function:

function getProportionalHours($startOfDay, $endOfDay, $proportionalHour) {
  list($startOfDayHour, $startOfDayMin) = explode(':', $startOfDay);
  list($endOfDayHour, $endOfDayMin) = explode(':', $endOfDay);
  $startOfDayInMinutesAfterMidnight = $startOfDayHour * 60 + $startOfDayMin;
  $endOfDayInMinutesAfterMidnight = $endOfDayHour * 60 + $endOfDayMin;
  $resultInMinutesAfterMidnight = (int) ($startOfDayInMinutesAfterMidnight +
        (($endOfDayInMinutesAfterMidnight-$startOfDayInMinutesAfterMidnight) * 
         $proportionalHour)/12);
  return array((int) ($resultInMinutesAfterMidnight/60),
               $resultInMinutesAfterMidnight%60);
}

$timestamp = mktime(0, 0, 0, 5, 21, 1993);
$sunrise = date_sunrise($timestamp, SUNFUNCS_RET_STRING, 48+54/60, 8+42/60, 90+50/60, 1);
$sunset = date_sunset($timestamp, SUNFUNCS_RET_STRING, 48+54/60, 8+42/60, 90+50/60, 1);
$result = getProportionalHours($sunrise, $sunset, 3);
echo "<p>Kriat Shema (GR\"O): $result[0]:$result[1]</p>";
Calculating Israeli Daylight Savings Time

Daylight Savings Time starts in Israel on the last Friday before 2nd of April and ends on the Sunday between Rosh Hashana and Yom Kippur. The following function isIsraeliDaylightSavingsTime checks for a Gregorian date whether Daylight Savings Time in Israel is in effect on that day or not.

for PHP 5.5:

function isIsraeliDaylightSavingsTime($month, $day, $year) {
  // Get Jewish year of Yom Kippur in the passed Gregorian year
  $jdCur = gregoriantojd(12, 31, $year);
  $jewishCur = jdtojewish($jdCur);
  list($jewishCurMonth, $jewishCurDay, $jewishCurYear) = explode("/", $jewishCur, 3);
  $jewishCurYearNum = intval($jewishCurYear);

  // Get Last Friday before 2nd of April
  $jdDSTBegin = gregoriantojd(4, 2, $year); // 2 April
  $jdDSTBegin--; // get the day before 2nd of April
  while (jddayofweek($jdDSTBegin, 0) != 5) // gets the weekday, 5 = Friday
    $jdDSTBegin--; // counts to the previous day until Friday

  // Get Sunday between Rosh Hashana and Yom Kippur
  // Take the first Sunday on or after 3rd of Tishri
  $jdDSTEnd = jewishtojd(1, 3, $jewishCurYearNum);
  while (jddayofweek($jdDSTEnd, 0) != 0) // gets the weekday, 0 = Sunday
    $jdDSTEnd++; // counts to the next day until Sunday

  // Check if the current date is between the start and end date ...
  $jdCurrent = gregoriantojd($month, $day, $year);
  if ($jdCurrent >= $jdDSTBegin && $jdCurrent < $jdDSTEnd)
    return true;
  else
    return false;
}

function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

function getJewishMonthName($jewishMonth, $jewishYear) {
  $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                "Shevat", "Adar I", "Adar II", "Nisan",
                                "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                   "Shevat", "", "Adar", "Nisan",
                                   "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  if (isJewishLeapYear($jewishYear))
    return $jewishMonthNamesLeap[$jewishMonth-1];
  else
    return $jewishMonthNamesNonLeap[$jewishMonth-1];
}

echo "<table border>\n";
echo "<tr><td>Weekday</td><td>Gregorian date</td>";
echo "<td>Jewish date</td><td>Israeli DST?</td></tr>\n";
$year = 2005;
for ($month = 1; $month <= 12; $month++) {
  $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
  for ($day = 1; $day <= $lastDay; $day++) {
    $result = isIsraeliDaylightSavingsTime($month, $day, $year);
    if ($result)
      $resultStr = "yes";
    else
      $resultStr = "no";

    $jdNumber = gregoriantojd($month, $day, $year);

    $weekdayNo = jddayofweek($jdNumber, 0);
    $weekdayNames = array("Sunday", "Monday", "Tuesday", "Wednesday",
                          "Thursday", "Friday", "Saturday");
    $weekdayName = $weekdayNames[$weekdayNo];

    $jewishDate = jdtojewish($jdNumber);
    list($jewishMonth, $jewishDay, $jewishYear) = explode('/', $jewishDate);
    $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                  "Shevat", "Adar I", "Adar II", "Nisan",
                                  "Iyar", "Sivan", "Tammuz", "Av", "Elul");
    $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                     "Shevat", "Adar", "", "Nisan",
                                     "Iyar", "Sivan", "Tammuz", "Av", "Elul");
    if (isJewishLeapYear($jewishYear))
      $jewishMonthName = $jewishMonthNamesLeap[$jewishMonth-1];
    else
      $jewishMonthName = $jewishMonthNamesNonLeap[$jewishMonth-1];
    echo "<tr><td>$weekdayName</td><td>$day/$month/$year</td>";
    echo "<td>$jewishDay $jewishMonthName $jewishYear</td>";
    echo "<td>$resultStr</td></tr>\n";
  }  
}
echo "</table>\n";
for PHP 5.4 or older:

function isIsraeliDaylightSavingsTime($month, $day, $year) {
  // Get Jewish year of Yom Kippur in the passed Gregorian year
  $jdCur = gregoriantojd(12, 31, $year);
  $jewishCur = jdtojewish($jdCur);
  list($jewishCurMonth, $jewishCurDay, $jewishCurYear) = explode("/", $jewishCur, 3);
  $jewishCurYearNum = intval($jewishCurYear);

  // Get Last Friday before 2nd of April
  $jdDSTBegin = gregoriantojd(4, 2, $year); // 2 April
  $jdDSTBegin--; // get the day before 2nd of April
  while (jddayofweek($jdDSTBegin, 0) != 5) // gets the weekday, 5 = Friday
    $jdDSTBegin--; // counts to the previous day until Friday

  // Get Sunday between Rosh Hashana and Yom Kippur
  // Take the first Sunday on or after 3rd of Tishri
  $jdDSTEnd = jewishtojd(1, 3, $jewishCurYearNum);
  while (jddayofweek($jdDSTEnd, 0) != 0) // gets the weekday, 0 = Sunday
    $jdDSTEnd++; // counts to the next day until Sunday

  // Check if the current date is between the start and end date ...
  $jdCurrent = gregoriantojd($month, $day, $year);
  if ($jdCurrent >= $jdDSTBegin && $jdCurrent < $jdDSTEnd)
    return true;
  else
    return false;
}

function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

function getJewishMonthName($jewishMonth, $jewishYear) {
  $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                "Shevat", "Adar I", "Adar II", "Nisan",
                                "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                   "Shevat", "Adar", "", "Nisan",
                                   "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  if (isJewishLeapYear($jewishYear))
    return $jewishMonthNamesLeap[$jewishMonth-1];
  else
    return $jewishMonthNamesNonLeap[$jewishMonth-1];
}

echo "<table border>\n";
echo "<tr><td>Weekday</td><td>Gregorian date</td>";
echo "<td>Jewish date</td><td>Israeli DST?</td></tr>\n";
$year = 2005;
for ($month = 1; $month <= 12; $month++) {
  $lastDay = cal_days_in_month(CAL_GREGORIAN, $month, $year);
  for ($day = 1; $day <= $lastDay; $day++) {
    $result = isIsraeliDaylightSavingsTime($month, $day, $year);
    if ($result)
      $resultStr = "yes";
    else
      $resultStr = "no";

    $jdNumber = gregoriantojd($month, $day, $year);

    $weekdayNo = jddayofweek($jdNumber, 0);
    $weekdayNames = array("Sunday", "Monday", "Tuesday", "Wednesday",
                          "Thursday", "Friday", "Saturday");
    $weekdayName = $weekdayNames[$weekdayNo];

    $jewishDate = jdtojewish($jdNumber);
    list($jewishMonth, $jewishDay, $jewishYear) = explode('/', $jewishDate);
    $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                  "Shevat", "Adar I", "Adar II", "Nisan",
                                  "Iyar", "Sivan", "Tammuz", "Av", "Elul");
    $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                     "Shevat", "Adar", "", "Nisan",
                                     "Iyar", "Sivan", "Tammuz", "Av", "Elul");
    if (isJewishLeapYear($jewishYear))
      $jewishMonthName = $jewishMonthNamesLeap[$jewishMonth-1];
    else
      $jewishMonthName = $jewishMonthNamesNonLeap[$jewishMonth-1];
    echo "<tr><td>$weekdayName</td><td>$day/$month/$year</td>";
    echo "<td>$jewishDay $jewishMonthName $jewishYear</td>";
    echo "<td>$resultStr</td></tr>\n";
  }  
}
echo "</table>\n";
Calculating Jewish holidays

A list of the holidays with their dates and remarks for calculation is available here.

In the following code holidays.inc, the function getJewishHoliday is implemented which gets the name of the holiday based on a Julian day number. The holidays are returned in a list since Shabbat Hagadol and Erev Pesach can fall together. The holidays.php page calculates a list of holidays in the specified Gregorian year using holidays.inc:

holidays.inc

for PHP 5.5:

<?php
function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

function getJewishMonthName($jewishMonth, $jewishYear) {
  $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                "Shevat", "Adar I", "Adar II", "Nisan",
                                "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                   "Shevat", "", "Adar", "Nisan",
                                   "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  if (isJewishLeapYear($jewishYear))
    return $jewishMonthNamesLeap[$jewishMonth-1];
  else
    return $jewishMonthNamesNonLeap[$jewishMonth-1];
}

function getJewishHoliday($jdCurrent, $isDiaspora, $postponeShushanPurimOnSaturday) {
  $result = array();

  $TISHRI = 1;
  $HESHVAN = 2;
  $KISLEV = 3;
  $TEVET = 4;
  $SHEVAT = 5;
  $ADAR_I = 6;
  $ADAR_II = 7;
  $ADAR = 7;
  $NISAN = 8;
  $IYAR = 9;
  $SIVAN = 10;
  $TAMMUZ = 11;
  $AV = 12;
  $ELUL = 13;

	$SUNDAY = 0;
  $MONDAY = 1;
  $TUESDAY = 2;
  $WEDNESDAY = 3;
  $THURSDAY = 4;
  $FRIDAY = 5;
  $SATURDAY = 6;

  $jewishDate = jdtojewish($jdCurrent);
  list($jewishMonth, $jewishDay, $jewishYear) = explode('/', $jewishDate);

  // Holidays in Elul
  if ($jewishDay == 29 && $jewishMonth == $ELUL)
    $result[] = "Erev Rosh Hashanah";

  // Holidays in Tishri
  if ($jewishDay == 1 && $jewishMonth == $TISHRI)
    $result[] = "Rosh Hashanah I";
  if ($jewishDay == 2 && $jewishMonth == $TISHRI)
    $result[] = "Rosh Hashanah II";
  $jd = jewishtojd($TISHRI, 3, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 3 Tishri would fall on Saturday ...
    // ... postpone Tzom Gedaliah to Sunday
    if ($jewishDay == 4 && $jewishMonth == $TISHRI)
      $result[] = "Tzom Gedaliah";
  } else {
    if ($jewishDay == 3 && $jewishMonth == $TISHRI)
      $result[] = "Tzom Gedaliah";
  }
  if ($jewishDay == 9 && $jewishMonth == $TISHRI)
    $result[] = "Erev Yom Kippur";
  if ($jewishDay == 10 && $jewishMonth == $TISHRI)
    $result[] = "Yom Kippur";
  if ($jewishDay == 14 && $jewishMonth == $TISHRI)
    $result[] = "Erev Sukkot";
  if ($jewishDay == 15 && $jewishMonth == $TISHRI)
    $result[] = "Sukkot I";
  if ($jewishDay == 16 && $jewishMonth == $TISHRI && $isDiaspora)
    $result[] = "Sukkot II";
  if ($isDiaspora) {
    if ($jewishDay >= 17 && $jewishDay <= 20 && $jewishMonth == $TISHRI)
      $result[] = "Hol Hamoed Sukkot";
  } else {
    if ($jewishDay >= 16 && $jewishDay <= 20 && $jewishMonth == $TISHRI)
      $result[] = "Hol Hamoed Sukkot";
  }
  if ($jewishDay == 21 && $jewishMonth == $TISHRI)
    $result[] = "Hoshana Rabbah";
  if ($isDiaspora) {
    if ($jewishDay == 22 && $jewishMonth == $TISHRI)
      $result[] = "Shemini Azeret";
    if ($jewishDay == 23 && $jewishMonth == $TISHRI)
      $result[] = "Simchat Torah";
    if ($jewishDay == 24 && $jewishMonth == $TISHRI)
      $result[] = "Isru Chag";
  } else {
    if ($jewishDay == 22 && $jewishMonth == $TISHRI)
      $result[] = "Shemini Azeret/Simchat Torah";
    if ($jewishDay == 23 && $jewishMonth == $TISHRI)
      $result[] = "Isru Chag";
  }

  // Holidays in Kislev/Tevet
  $hanukkahStart = jewishtojd($KISLEV, 25, $jewishYear);
  $hanukkahNo = (int) ($jdCurrent-$hanukkahStart+1);
  if ($hanukkahNo == 1) $result[] = "Hanukkah I";
  if ($hanukkahNo == 2) $result[] = "Hanukkah II";
  if ($hanukkahNo == 3) $result[] = "Hanukkah III";
  if ($hanukkahNo == 4) $result[] = "Hanukkah IV";
  if ($hanukkahNo == 5) $result[] = "Hanukkah V";
  if ($hanukkahNo == 6) $result[] = "Hanukkah VI";
  if ($hanukkahNo == 7) $result[] = "Hanukkah VII";
  if ($hanukkahNo == 8) $result[] = "Hanukkah VIII";

  // Holidays in Tevet
  $jd = jewishtojd($TEVET, 10, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 10 Tevet would fall on Saturday ...
    // ... postpone Tzom Tevet to Sunday
    if ($jewishDay == 11 && $jewishMonth == $TEVET)
      $result[] = "Tzom Tevet";
  } else {
    if ($jewishDay == 10 && $jewishMonth == $TEVET)
      $result[] = "Tzom Tevet";
  }

  // Holidays in Shevat
  if ($jewishDay == 15 && $jewishMonth == $SHEVAT)
    $result[] = "Tu B'Shevat";

  // Holidays in Adar I
  if (isJewishLeapYear($jewishYear) && $jewishDay == 14 && $jewishMonth == $ADAR_I)
    $result[] = "Purim Katan";
  if (isJewishLeapYear($jewishYear) && $jewishDay == 15 && $jewishMonth == $ADAR_I)
    $result[] = "Shushan Purim Katan";

  // Holidays in Adar or Adar II
  if (isJewishLeapYear($jewishYear))
    $purimMonth = $ADAR_II;
  else
    $purimMonth = $ADAR;
  $jd = jewishtojd($purimMonth, 13, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 13 Adar or Adar II would fall on Saturday ...
    // ... move Ta'anit Esther to the preceding Thursday
    if ($jewishDay == 11 && $jewishMonth == $purimMonth)
      $result[] = "Ta'anith Esther";
  } else {
    if ($jewishDay == 13 && $jewishMonth == $purimMonth)
      $result[] = "Ta'anith Esther";
  }
  if ($jewishDay == 14 && $jewishMonth == $purimMonth)
    $result[] = "Purim";
  if ($postponeShushanPurimOnSaturday) {
    $jd = jewishtojd($purimMonth, 15, $jewishYear);
    $weekdayNo = jddayofweek($jd, 0);
    if ($weekdayNo == $SATURDAY) { // If the 15 Adar or Adar II would fall on Saturday ...
      // ... postpone Shushan Purim to Sunday
      if ($jewishDay == 16 && $jewishMonth == $purimMonth)
        $result[] = "Shushan Purim";
    } else {
      if ($jewishDay == 15 && $jewishMonth == $purimMonth)
        $result[] = "Shushan Purim";
    }
  } else {
    if ($jewishDay == 15 && $jewishMonth == $purimMonth)
      $result[] = "Shushan Purim";
  }

  // Holidays in Nisan
  $shabbatHagadolDay = 14;
  $jd = jewishtojd($NISAN, $shabbatHagadolDay, $jewishYear);
  while (jddayofweek($jd, 0) != $SATURDAY) {
    $jd--;
    $shabbatHagadolDay--;
  }
  if ($jewishDay == $shabbatHagadolDay && $jewishMonth == $NISAN)
    $result[] = "Shabbat Hagadol";
  if ($jewishDay == 14 && $jewishMonth == $NISAN)
    $result[] = "Erev Pesach";
  if ($jewishDay == 15 && $jewishMonth == $NISAN)
    $result[] = "Pesach I";
  if ($jewishDay == 16 && $jewishMonth == $NISAN && $isDiaspora)
    $result[] = "Pesach II";
  if ($isDiaspora) {
    if ($jewishDay >= 17 && $jewishDay <= 20 && $jewishMonth == $NISAN)
      $result[] = "Hol Hamoed Pesach";
  } else {
    if ($jewishDay >= 16 && $jewishDay <= 20 && $jewishMonth == $NISAN)
      $result[] = "Hol Hamoed Pesach";
  }
  if ($jewishDay == 21 && $jewishMonth == $NISAN)
    $result[] = "Pesach VII";
  if ($jewishDay == 22 && $jewishMonth == $NISAN && $isDiaspora)
    $result[] = "Pesach VIII";
  if ($isDiaspora) {
    if ($jewishDay == 23 && $jewishMonth == $NISAN)
      $result[] = "Isru Chag";
  } else {
    if ($jewishDay == 22 && $jewishMonth == $NISAN)
      $result[] = "Isru Chag";
  }

  $jd = jewishtojd($NISAN, 27, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $FRIDAY) { // If the 27 Nisan would fall on Friday ...
    // ... then Yom Hashoah falls on Thursday
    if ($jewishDay == 26 && $jewishMonth == $NISAN)
      $result[] = "Yom Hashoah";
  } else {
    if ($jewishYear >= 5757) { // Since 1997 (5757) ...
      if ($weekdayNo == $SUNDAY) { // If the 27 Nisan would fall on Friday ...
        // ... then Yom Hashoah falls on Thursday
        if ($jewishDay == 28 && $jewishMonth == $NISAN)
          $result[] = "Yom Hashoah";
      } else {
        if ($jewishDay == 27 && $jewishMonth == $NISAN)
          $result[] = "Yom Hashoah";
      }
    } else {
      if ($jewishDay == 27 && $jewishMonth == $NISAN)
        $result[] = "Yom Hashoah";
    }
  }

  // Holidays in Iyar

  $jd = jewishtojd($IYAR, 4, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);

  // If the 4 Iyar would fall on Friday or Thursday ...
  // ... then Yom Hazikaron falls on Wednesday and Yom Ha'Atzmaut on Thursday
  if ($weekdayNo == $FRIDAY) {
    if ($jewishDay == 2 && $jewishMonth == $IYAR)
      $result[] = "Yom Hazikaron";
    if ($jewishDay == 3 && $jewishMonth == $IYAR)
      $result[] = "Yom Ha'Atzmaut";
  } else {
    if ($weekdayNo == $THURSDAY) {
      if ($jewishDay == 3 && $jewishMonth == $IYAR)
        $result[] = "Yom Hazikaron";
      if ($jewishDay == 4 && $jewishMonth == $IYAR)
        $result[] = "Yom Ha'Atzmaut";
    } else {
      if ($jewishYear >= 5764) { // Since 2004 (5764) ...
        if ($weekdayNo == $SUNDAY) { // If the 4 Iyar would fall on Sunday ...
          // ... then Yom Hazicaron falls on Monday
          if ($jewishDay == 5 && $jewishMonth == $IYAR)
            $result[] = "Yom Hazikaron";
          if ($jewishDay == 6 && $jewishMonth == $IYAR)
            $result[] = "Yom Ha'Atzmaut";
        } else {
          if ($jewishDay == 4 && $jewishMonth == $IYAR)
            $result[] = "Yom Hazikaron";
          if ($jewishDay == 5 && $jewishMonth == $IYAR)
            $result[] = "Yom Ha'Atzmaut";
        }
      } else {
        if ($jewishDay == 4 && $jewishMonth == $IYAR)
          $result[] = "Yom Hazikaron";
        if ($jewishDay == 5 && $jewishMonth == $IYAR)
          $result[] = "Yom Ha'Atzmaut";
      }
    }
  }

  if ($jewishDay == 14 && $jewishMonth == $IYAR)
    $result[] = "Pesach Sheini";
  if ($jewishDay == 18 && $jewishMonth == $IYAR)
    $result[] = "Lag B'Omer";
  if ($jewishDay == 28 && $jewishMonth == $IYAR)
    $result[] = "Yom Yerushalayim";

  // Holidays in Sivan
  if ($jewishDay == 5 && $jewishMonth == $SIVAN)
    $result[] = "Erev Shavuot";
  if ($jewishDay == 6 && $jewishMonth == $SIVAN)
    $result[] = "Shavuot I";
  if ($jewishDay == 7 && $jewishMonth == $SIVAN && $isDiaspora)
    $result[] = "Shavuot II";
  if ($isDiaspora) {
    if ($jewishDay == 8 && $jewishMonth == $SIVAN)
      $result[] = "Isru Chag";
  } else {
    if ($jewishDay == 7 && $jewishMonth == $SIVAN)
      $result[] = "Isru Chag";
  }

  // Holidays in Tammuz
  $jd = jewishtojd($TAMMUZ, 17, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 17 Tammuz would fall on Saturday ...
    // ... postpone Tzom Tammuz to Sunday
    if ($jewishDay == 18 && $jewishMonth == $TAMMUZ)
      $result[] = "Tzom Tammuz";
  } else {
    if ($jewishDay == 17 && $jewishMonth == $TAMMUZ)
      $result[] = "Tzom Tammuz";
  }
  
  // Holidays in Av
  $jd = jewishtojd($AV, 9, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 9 Av would fall on Saturday ...
    // ... postpone Tisha B'Av to Sunday
    if ($jewishDay == 10 && $jewishMonth == $AV)
      $result[] = "Tisha B'Av";
  } else {
    if ($jewishDay == 9 && $jewishMonth == $AV)
      $result[] = "Tisha B'Av";
  }
  if ($jewishDay == 15 && $jewishMonth == $AV)
    $result[] = "Tu B'Av";

  return $result;
}
?>
for PHP 5.4 or older:

<?php
function isJewishLeapYear($year) {
  if ($year % 19 == 0 || $year % 19 == 3 || $year % 19 == 6 ||
      $year % 19 == 8 || $year % 19 == 11 || $year % 19 == 14 ||
      $year % 19 == 17)
    return true;
  else
    return false;
}

function getJewishMonthName($jewishMonth, $jewishYear) {
  $jewishMonthNamesLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                "Shevat", "Adar I", "Adar II", "Nisan",
                                "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  $jewishMonthNamesNonLeap = array("Tishri", "Heshvan", "Kislev", "Tevet",
                                   "Shevat", "Adar", "", "Nisan",
                                   "Iyar", "Sivan", "Tammuz", "Av", "Elul");
  if (isJewishLeapYear($jewishYear))
    return $jewishMonthNamesLeap[$jewishMonth-1];
  else
    return $jewishMonthNamesNonLeap[$jewishMonth-1];
}

function getJewishHoliday($jdCurrent, $isDiaspora, $postponeShushanPurimOnSaturday) {
  $result = array();

  $TISHRI = 1;
  $HESHVAN = 2;
  $KISLEV = 3;
  $TEVET = 4;
  $SHEVAT = 5;
  $ADAR = 6;
  $ADAR_I = 6;
  $ADAR_II = 7;
  $NISAN = 8;
  $IYAR = 9;
  $SIVAN = 10;
  $TAMMUZ = 11;
  $AV = 12;
  $ELUL = 13;

  $SUNDAY = 0;
  $MONDAY = 1;
  $TUESDAY = 2;
  $WEDNESDAY = 3;
  $THURSDAY = 4;
  $FRIDAY = 5;
  $SATURDAY = 6;

  $jewishDate = jdtojewish($jdCurrent);
  list($jewishMonth, $jewishDay, $jewishYear) = explode('/', $jewishDate);

  // Holidays in Elul
  if ($jewishDay == 29 && $jewishMonth == $ELUL)
    $result[] = "Erev Rosh Hashanah";

  // Holidays in Tishri
  if ($jewishDay == 1 && $jewishMonth == $TISHRI)
    $result[] = "Rosh Hashanah I";
  if ($jewishDay == 2 && $jewishMonth == $TISHRI)
    $result[] = "Rosh Hashanah II";
  $jd = jewishtojd($TISHRI, 3, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 3 Tishri would fall on Saturday ...
    // ... postpone Tzom Gedaliah to Sunday
    if ($jewishDay == 4 && $jewishMonth == $TISHRI)
      $result[] = "Tzom Gedaliah";
  } else {
    if ($jewishDay == 3 && $jewishMonth == $TISHRI)
      $result[] = "Tzom Gedaliah";
  }
  if ($jewishDay == 9 && $jewishMonth == $TISHRI)
    $result[] = "Erev Yom Kippur";
  if ($jewishDay == 10 && $jewishMonth == $TISHRI)
    $result[] = "Yom Kippur";
  if ($jewishDay == 14 && $jewishMonth == $TISHRI)
    $result[] = "Erev Sukkot";
  if ($jewishDay == 15 && $jewishMonth == $TISHRI)
    $result[] = "Sukkot I";
  if ($jewishDay == 16 && $jewishMonth == $TISHRI && $isDiaspora)
    $result[] = "Sukkot II";
  if ($isDiaspora) {
    if ($jewishDay >= 17 && $jewishDay <= 20 && $jewishMonth == $TISHRI)
      $result[] = "Hol Hamoed Sukkot";
  } else {
    if ($jewishDay >= 16 && $jewishDay <= 20 && $jewishMonth == $TISHRI)
      $result[] = "Hol Hamoed Sukkot";
  }
  if ($jewishDay == 21 && $jewishMonth == $TISHRI)
    $result[] = "Hoshana Rabbah";
  if ($isDiaspora) {
    if ($jewishDay == 22 && $jewishMonth == $TISHRI)
      $result[] = "Shemini Azeret";
    if ($jewishDay == 23 && $jewishMonth == $TISHRI)
      $result[] = "Simchat Torah";
    if ($jewishDay == 24 && $jewishMonth == $TISHRI)
      $result[] = "Isru Chag";
  } else {
    if ($jewishDay == 22 && $jewishMonth == $TISHRI)
      $result[] = "Shemini Azeret/Simchat Torah";
    if ($jewishDay == 23 && $jewishMonth == $TISHRI)
      $result[] = "Isru Chag";
  }

  // Holidays in Kislev/Tevet
  $hanukkahStart = jewishtojd($KISLEV, 25, $jewishYear);
  $hanukkahNo = (int) ($jdCurrent-$hanukkahStart+1);
  if ($hanukkahNo == 1) $result[] = "Hanukkah I";
  if ($hanukkahNo == 2) $result[] = "Hanukkah II";
  if ($hanukkahNo == 3) $result[] = "Hanukkah III";
  if ($hanukkahNo == 4) $result[] = "Hanukkah IV";
  if ($hanukkahNo == 5) $result[] = "Hanukkah V";
  if ($hanukkahNo == 6) $result[] = "Hanukkah VI";
  if ($hanukkahNo == 7) $result[] = "Hanukkah VII";
  if ($hanukkahNo == 8) $result[] = "Hanukkah VIII";

  // Holidays in Tevet
  $jd = jewishtojd($TEVET, 10, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 10 Tevet would fall on Saturday ...
    // ... postpone Tzom Tevet to Sunday
    if ($jewishDay == 11 && $jewishMonth == $TEVET)
      $result[] = "Tzom Tevet";
  } else {
    if ($jewishDay == 10 && $jewishMonth == $TEVET)
      $result[] = "Tzom Tevet";
  }

  // Holidays in Shevat
  if ($jewishDay == 15 && $jewishMonth == $SHEVAT)
    $result[] = "Tu B'Shevat";

  // Holidays in Adar I
  if (isJewishLeapYear($jewishYear) && $jewishDay == 14 && $jewishMonth == $ADAR_I)
    $result[] = "Purim Katan";
  if (isJewishLeapYear($jewishYear) && $jewishDay == 15 && $jewishMonth == $ADAR_I)
    $result[] = "Shushan Purim Katan";

  // Holidays in Adar or Adar II
  if (isJewishLeapYear($jewishYear))
    $purimMonth = $ADAR_II;
  else
    $purimMonth = $ADAR;
  $jd = jewishtojd($purimMonth, 13, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 13 Adar or Adar II would fall on Saturday ...
    // ... move Ta'anit Esther to the preceding Thursday
    if ($jewishDay == 11 && $jewishMonth == $purimMonth)
      $result[] = "Ta'anith Esther";
  } else {
    if ($jewishDay == 13 && $jewishMonth == $purimMonth)
      $result[] = "Ta'anith Esther";
  }
  if ($jewishDay == 14 && $jewishMonth == $purimMonth)
    $result[] = "Purim";
  if ($postponeShushanPurimOnSaturday) {
    $jd = jewishtojd($purimMonth, 15, $jewishYear);
    $weekdayNo = jddayofweek($jd, 0);
    if ($weekdayNo == $SATURDAY) { // If the 15 Adar or Adar II would fall on Saturday ...
      // ... postpone Shushan Purim to Sunday
      if ($jewishDay == 16 && $jewishMonth == $purimMonth)
        $result[] = "Shushan Purim";
    } else {
      if ($jewishDay == 15 && $jewishMonth == $purimMonth)
        $result[] = "Shushan Purim";
    }
  } else {
    if ($jewishDay == 15 && $jewishMonth == $purimMonth)
      $result[] = "Shushan Purim";
  }

  // Holidays in Nisan
  $shabbatHagadolDay = 14;
  $jd = jewishtojd($NISAN, $shabbatHagadolDay, $jewishYear);
  while (jddayofweek($jd, 0) != $SATURDAY) {
    $jd--;
    $shabbatHagadolDay--;
  }
  if ($jewishDay == $shabbatHagadolDay && $jewishMonth == $NISAN)
    $result[] = "Shabbat Hagadol";
  if ($jewishDay == 14 && $jewishMonth == $NISAN)
    $result[] = "Erev Pesach";
  if ($jewishDay == 15 && $jewishMonth == $NISAN)
    $result[] = "Pesach I";
  if ($jewishDay == 16 && $jewishMonth == $NISAN && $isDiaspora)
    $result[] = "Pesach II";
  if ($isDiaspora) {
    if ($jewishDay >= 17 && $jewishDay <= 20 && $jewishMonth == $NISAN)
      $result[] = "Hol Hamoed Pesach";
  } else {
    if ($jewishDay >= 16 && $jewishDay <= 20 && $jewishMonth == $NISAN)
      $result[] = "Hol Hamoed Pesach";
  }
  if ($jewishDay == 21 && $jewishMonth == $NISAN)
    $result[] = "Pesach VII";
  if ($jewishDay == 22 && $jewishMonth == $NISAN && $isDiaspora)
    $result[] = "Pesach VIII";
  if ($isDiaspora) {
    if ($jewishDay == 23 && $jewishMonth == $NISAN)
      $result[] = "Isru Chag";
  } else {
    if ($jewishDay == 22 && $jewishMonth == $NISAN)
      $result[] = "Isru Chag";
  }

  $jd = jewishtojd($NISAN, 27, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $FRIDAY) { // If the 27 Nisan would fall on Friday ...
    // ... then Yom Hashoah falls on Thursday
    if ($jewishDay == 26 && $jewishMonth == $NISAN)
      $result[] = "Yom Hashoah";
  } else {
    if ($jewishYear >= 5757) { // Since 1997 (5757) ...
      if ($weekdayNo == $SUNDAY) { // If the 27 Nisan would fall on Friday ...
        // ... then Yom Hashoah falls on Thursday
        if ($jewishDay == 28 && $jewishMonth == $NISAN)
          $result[] = "Yom Hashoah";
      } else {
        if ($jewishDay == 27 && $jewishMonth == $NISAN)
          $result[] = "Yom Hashoah";
      }
    } else {
      if ($jewishDay == 27 && $jewishMonth == $NISAN)
        $result[] = "Yom Hashoah";
    }
  }

  // Holidays in Iyar

  $jd = jewishtojd($IYAR, 4, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);

  // If the 4 Iyar would fall on Friday or Thursday ...
  // ... then Yom Hazikaron falls on Wednesday and Yom Ha'Atzmaut on Thursday
  if ($weekdayNo == $FRIDAY) {
    if ($jewishDay == 2 && $jewishMonth == $IYAR)
      $result[] = "Yom Hazikaron";
    if ($jewishDay == 3 && $jewishMonth == $IYAR)
      $result[] = "Yom Ha'Atzmaut";
  } else {
    if ($weekdayNo == $THURSDAY) {
      if ($jewishDay == 3 && $jewishMonth == $IYAR)
        $result[] = "Yom Hazikaron";
      if ($jewishDay == 4 && $jewishMonth == $IYAR)
        $result[] = "Yom Ha'Atzmaut";
    } else {
      if ($jewishYear >= 5764) { // Since 2004 (5764) ...
        if ($weekdayNo == $SUNDAY) { // If the 4 Iyar would fall on Sunday ...
          // ... then Yom Hazicaron falls on Monday
          if ($jewishDay == 5 && $jewishMonth == $IYAR)
            $result[] = "Yom Hazikaron";
          if ($jewishDay == 6 && $jewishMonth == $IYAR)
            $result[] = "Yom Ha'Atzmaut";
        } else {
          if ($jewishDay == 4 && $jewishMonth == $IYAR)
            $result[] = "Yom Hazikaron";
          if ($jewishDay == 5 && $jewishMonth == $IYAR)
            $result[] = "Yom Ha'Atzmaut";
        }
      } else {
        if ($jewishDay == 4 && $jewishMonth == $IYAR)
          $result[] = "Yom Hazikaron";
        if ($jewishDay == 5 && $jewishMonth == $IYAR)
          $result[] = "Yom Ha'Atzmaut";
      }
    }
  }

  if ($jewishDay == 14 && $jewishMonth == $IYAR)
    $result[] = "Pesach Sheini";
  if ($jewishDay == 18 && $jewishMonth == $IYAR)
    $result[] = "Lag B'Omer";
  if ($jewishDay == 28 && $jewishMonth == $IYAR)
    $result[] = "Yom Yerushalayim";

  // Holidays in Sivan
  if ($jewishDay == 5 && $jewishMonth == $SIVAN)
    $result[] = "Erev Shavuot";
  if ($jewishDay == 6 && $jewishMonth == $SIVAN)
    $result[] = "Shavuot I";
  if ($jewishDay == 7 && $jewishMonth == $SIVAN && $isDiaspora)
    $result[] = "Shavuot II";
  if ($isDiaspora) {
    if ($jewishDay == 8 && $jewishMonth == $SIVAN)
      $result[] = "Isru Chag";
  } else {
    if ($jewishDay == 7 && $jewishMonth == $SIVAN)
      $result[] = "Isru Chag";
  }

  // Holidays in Tammuz
  $jd = jewishtojd($TAMMUZ, 17, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 17 Tammuz would fall on Saturday ...
    // ... postpone Tzom Tammuz to Sunday
    if ($jewishDay == 18 && $jewishMonth == $TAMMUZ)
      $result[] = "Tzom Tammuz";
  } else {
    if ($jewishDay == 17 && $jewishMonth == $TAMMUZ)
      $result[] = "Tzom Tammuz";
  }
  
  // Holidays in Av
  $jd = jewishtojd($AV, 9, $jewishYear);
  $weekdayNo = jddayofweek($jd, 0);
  if ($weekdayNo == $SATURDAY) { // If the 9 Av would fall on Saturday ...
    // ... postpone Tisha B'Av to Sunday
    if ($jewishDay == 10 && $jewishMonth == $AV)
      $result[] = "Tisha B'Av";
  } else {
    if ($jewishDay == 9 && $jewishMonth == $AV)
      $result[] = "Tisha B'Av";
  }
  if ($jewishDay == 15 && $jewishMonth == $AV)
    $result[] = "Tu B'Av";

  return $result;
}
?>
holidays.php

<html>
<head>
<title>Calculating Jewish holidays</title>
</head>
<body>

<?php
include('holidays.inc');

if (isSet($_REQUEST["year"])) {
  $prevYear = $_REQUEST["year"]-1;
  $nextYear = $_REQUEST["year"]+1;
  $israeldiaspora = $_REQUEST["israeldiaspora"];
  if (isSet($_REQUEST["postponeshushanpurimonsaturday"])) {
    $postponeShushanPurimOnSaturday = $_REQUEST["postponeshushanpurimonsaturday"];
  } else {
    $postponeShushanPurimOnSaturday = "";
  }
  echo "<p>\n";
  echo "<a href=\"holidays.php?year=$prevYear&israeldiaspora=$israeldiaspora&postponeshushanpurimonsaturday=$postponeShushanPurimOnSaturday\">Previous year</a>";
  echo "| ";
  echo "<a href=\"holidays.php?year=$nextYear&israeldiaspora=$israeldiaspora&postponeshushanpurimonsaturday=$postponeShushanPurimOnSaturday\">Next year</a>";
  echo "</p>\n";
}
?>

<form action="holidays.php" method="get">
<input type="text" name="year" value="<?php if (isSet($_REQUEST["year"])) echo $_REQUEST["year"]; ?>"/>
<br/>
<input type="radio" name="israeldiaspora" value="D"<?php if (isSet($_REQUEST["israeldiaspora"]) && $_REQUEST["israeldiaspora"] == "D") echo " checked"; ?>>Diaspora
<input type="radio" name="israeldiaspora" value="I"<?php if (isSet($_REQUEST["israeldiaspora"]) && $_REQUEST["israeldiaspora"] == "I") echo " checked"; ?>>Israel
<br/>
<input type="checkbox" name="postponeshushanpurimonsaturday" value="X"<?php if (isSet($_REQUEST["postponeshushanpurimonsaturday"]) && $_REQUEST["postponeshushanpurimonsaturday"] == "X") echo " checked"; ?>>
Postpone Shushan Purim to Sunday if falling on Saturday
<br/>
<input type="submit" value="Calculate">
</form>

<?php
if (isSet($_REQUEST["year"])) {
  if ($_REQUEST["israeldiaspora"] == "D")
    $isDiaspora = true;
  else
    $isDiaspora = false;
  if (isSet($_REQUEST["postponeshushanpurimonsaturday"]) && $_REQUEST["postponeshushanpurimonsaturday"] == "X")
    $postponeShushanPurimOnSaturday = true;
  else
    $postponeShushanPurimOnSaturday = false;
  echo "<table border>\n";
  echo "<tr><th>Weekday</th><th>Gregorian date</th><th>Jewish date</th><th>Holiday</th></tr>\n";
  $gyear = $_REQUEST["year"];
  $weekdayNames = array("Sunday", "Monday", "Tuesday", "Wednesday",
                        "Thursday", "Friday", "Saturday");
  for ($gmonth = 1; $gmonth <= 12; $gmonth++) {
    $lastGDay = cal_days_in_month(CAL_GREGORIAN, $gmonth, $gyear);
    for ($gday = 1; $gday <= $lastGDay; $gday++) {
      $jdCurrent = gregoriantojd($gmonth, $gday, $gyear);
      $weekdayNo = jddayofweek($jdCurrent, 0);
      $weekdayName = $weekdayNames[$weekdayNo];
      $jewishDate = jdtojewish($jdCurrent);
      list($jewishMonth, $jewishDay, $jewishYear) = explode('/', $jewishDate);
      $jewishMonthName = getJewishMonthName($jewishMonth, $jewishYear);
      $holidays = getJewishHoliday($jdCurrent, $isDiaspora, $postponeShushanPurimOnSaturday);
      if (count($holidays) > 0) {
        echo "<tr><td>$weekdayName</td><td>$gday/$gmonth/$gyear</td><td>$jewishDay $jewishMonthName $jewishYear</td><td>";
        for ($i = 0; $i < count($holidays); $i++) {
          if ($i > 0) echo "/";
          $holiday = $holidays[$i];
          echo "$holiday";
        }
        echo "</td></tr>\n";
      }
    }
  }
  echo "</table>\n";
}
?>

</body>
</html>
Calculating weekly torah sections

The function getTorahSections in torah.inc expects the Jewish month, day and year of the Shabbat and a boolean whether to calculate for diaspora (true) or Israel (false) and returns a string with the torah sections or an empty string if there are no torah sections on that day.

File torah.inc

<?php
$ID_BERESHITH                   = 0;
$ID_NOAH                        = 1;
$ID_LEHLEHA                     = 2;
$ID_VAYERA                      = 3;
$ID_HAYESARAH                   = 4;
$ID_TOLEDOTH                    = 5;
$ID_VAYETSE                     = 6;
$ID_VAYISHLAH                   = 7;
$ID_VAYESHEB                    = 8;
$ID_MIKKETS                     = 9;
$ID_VAYIGGASH                  = 10;
$ID_VAYHEE                     = 11;
$ID_SHEMOTH                    = 12;
$ID_VAERA                      = 13;
$ID_BO                         = 14;
$ID_BESHALLAH                  = 15;
$ID_YITHRO                     = 16;
$ID_MISHPATIM                  = 17;
$ID_TERUMAH                    = 18;
$ID_TETSAVVEH                  = 19;
$ID_KITISSA                    = 20;
$ID_VAYAKHEL                   = 21;
$ID_PEKUDE                     = 22;
$ID_VAYIKRA                    = 23;
$ID_TSAV                       = 24;
$ID_SHEMINI                    = 25;
$ID_TAZRIANG                   = 26;
$ID_METSORANG                  = 27;
$ID_AHAREMOTH                  = 28;
$ID_KEDOSHIM                   = 29;
$ID_EMOR                       = 30;
$ID_BEHAR                      = 31;
$ID_BEHUKKOTHAI                = 32;
$ID_BEMIDBAR                   = 33;
$ID_NASO                       = 34;
$ID_BEHAALOTEHA                = 35;
$ID_SHELAHLEHA                 = 36;
$ID_KORAH                      = 37;
$ID_HUKATH                     = 38;
$ID_BALAK                      = 39;
$ID_PINHAS                     = 40;
$ID_MATOTH                     = 41;
$ID_MASEH                      = 42;
$ID_DEBARIM                    = 43;
$ID_VAETHANAN                  = 44;
$ID_EKEB                       = 45;
$ID_REEH                       = 46;
$ID_SHOFETIM                   = 47;
$ID_KITETSE                    = 48;
$ID_KITABO                     = 49;
$ID_NITSABIM                   = 50;
$ID_VAYELEH                    = 51;
$ID_HAAZINU                    = 52;

$ID_SIMHATHTORAH               = 53;
$ID_SIMHATHTORAH_2             = 54;
$ID_SIMHATHTORAH_3             = 55;

$ID_ROSH_HODESH_SHABBAT        = 60;
$ID_SHEKALIM                   = 61;
$ID_ZAHOR                      = 62;
$ID_PARAH                      = 63;
$ID_HAHODESH                   = 64;
$ID_HAGGADOL                   = 65;
$ID_SHUVA                      = 66;

$ID_ROSH_HASHANAH_I            = 70;
$ID_ROSH_HASHANAH_II           = 71;
$ID_FAST_OF_GEDALIAH           = 72;
$ID_YOM_KIPPUR                 = 73;
$ID_SUCCOTH_I                  = 74;
$ID_SUCCOTH_II                 = 75;
$ID_SUCCOTH_III_NO_SHABBAT     = 76;
$ID_SUCCOTH_III                = 77;
$ID_SUCCOTH_IV                 = 78;
$ID_SUCCOTH_V_NO_SHABBAT       = 79;
$ID_SUCCOTH_V                  = 80;
$ID_SUCCOTH_VI_NO_SHABBAT      = 81;
$ID_SUCCOTH_VI                 = 82;
$ID_HOSHANAH_RABBAH            = 83;
$ID_HOL_HAMOED_SUCCOTH         = 84;
$ID_SHEMINI_AZERETH_1          = 85;
$ID_FAST_OF_ESTHER             = 86;
$ID_PURIM                      = 87;
$ID_FAST_OF_TEVET_10           = 88;
$ID_PESAH_I                    = 89;
$ID_HOL_HAMOED_PESAH           = 90;
$ID_PESAH_VII                  = 91;
$ID_PESAH_VIII                 = 92;
$ID_PESAH_VIII_NO_SHABBAT      = 93;
$ID_SHAVUOTH_I                 = 94;
$ID_SHAVUOTH_II_NO_SHABBAT     = 95; 
$ID_SHAVUOTH_II                = 96;
$ID_YOM_HAATZMAUT              = 97;
$ID_FAST_OF_TAMMUZ_17          = 98;
$ID_FAST_OF_TISHA_BAV          = 99;
$ID_CHANUKKAH_I               = 100;
$ID_CHANUKKAH_II              = 101;
$ID_CHANUKKAH_III             = 102;
$ID_CHANUKKAH_IV              = 103;
$ID_CHANUKKAH_V               = 104;
$ID_CHANUKKAH_VI              = 105;
$ID_CHANUKKAH_VI_ROSH_HODESH  = 106;
$ID_CHANUKKAH_VII             = 107;
$ID_CHANUKKAH_VII_ROSH_HODESH = 108;
$ID_CHANUKKAH_VIII            = 109;
$ID_SECOND_SHABBAT_CHANUKKAH  = 110;
$ID_ROSH_HODESH               = 111;
$ID_PESAH_II                  = 112;
$ID_PESAH_III                 = 113;
$ID_PESAH_IV                  = 114;
$ID_PESAH_IV_NOT_SUNDAY       = 115;
$ID_PESAH_IV_SUNDAY           = 116;
$ID_PESAH_V                   = 117;
$ID_PESAH_V_NOT_MONDAY        = 118;
$ID_PESAH_V_MONDAY            = 119;
$ID_PESAH_VI                  = 120;

$ID_SPECIAL_1                  = 150;
$ID_SPECIAL_2                  = 151;
$ID_SPECIAL_3                  = 152;
$ID_SPECIAL_4                  = 153;
$ID_SPECIAL_5                  = 154;
$ID_SPECIAL_6                  = 155;
$ID_SPECIAL_7                  = 156;
$ID_SPECIAL_8                  = 157;
$ID_SPECIAL_8A                 = 158;
$ID_SPECIAL_9                  = 159;
$ID_SPECIAL_10                 = 161;
$ID_SPECIAL_11                 = 162;
$ID_SPECIAL_12                 = 163;

$ID_SHEMINI_AZERETH_2          = 170;
$ID_SHEMINI_AZERETH_3          = 171;
$ID_SHEMINI_AZERETH            = 172;

$ID_MAX                        = 256;

$ID_NULL                       = 1000;

$torahSectionsA = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_PARAH,   $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_HAHODESH,  /* 22 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 25 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 29 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 40 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 48 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_YOM_KIPPUR,          $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 51 */

$torahSectionsB = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_ZAHOR,   $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_PARAH,   $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_HAHODESH,  /* 22 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 24 */
   $ID_PESAH_VII,           $ID_NULL,    $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 27 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 28 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 30 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 39 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 50 */

$torahSectionsCDiaspora = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_PARAH,   $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_HAHODESH,  /* 22 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 25 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 29 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_SHAVUOTH_II,         $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_HUKATH,              $ID_BALAK,   $ID_NULL,      /* 38 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 40 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 48 */
   $ID_ROSH_HASHANAH_I,     $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_SUCCOTH_I,           $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_SHEMINI_AZERETH,     $ID_NULL,    $ID_NULL);     /* 52 */

$torahSectionsCIsrael = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_PARAH,   $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_HAHODESH,  /* 22 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 25 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 29 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 40 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 48 */
   $ID_ROSH_HASHANAH_I,     $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_SUCCOTH_I,           $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_SHEMINI_AZERETH,     $ID_NULL,    $ID_NULL);     /* 52 */

$torahSectionsDDiaspora = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_PARAH,     /* 22 */
   $ID_VAYIKRA,             $ID_HAHODESH,$ID_NULL,      /* 23 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 24 */
   $ID_PESAH_I,             $ID_NULL,    $ID_NULL,      /* 25 */
   $ID_PESAH_VIII,          $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 29 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 40 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 51 */

$torahSectionsDIsrael = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_PARAH,     /* 22 */
   $ID_VAYIKRA,             $ID_HAHODESH,$ID_NULL,      /* 23 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 24 */
   $ID_PESAH_I,             $ID_NULL,    $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 27 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 28 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 40 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 51 */

$torahSectionsEDiaspora = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_PARAH,   $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_HAHODESH,  /* 22 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 24 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 29 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_SHAVUOTH_II,         $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_HUKATH,              $ID_BALAK,   $ID_NULL,      /* 38 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 40 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 48 */
   $ID_ROSH_HASHANAH_I,     $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_SUCCOTH_I,           $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_SHEMINI_AZERETH,     $ID_NULL,    $ID_NULL);     /* 52 */

$torahSectionsEIsrael = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_PARAH,   $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_HAHODESH,  /* 22 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 24 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 29 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_SHAVUOTH_II,         $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_HUKATH,              $ID_BALAK,   $ID_NULL,      /* 38 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 40 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 48 */
   $ID_ROSH_HASHANAH_I,     $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_SUCCOTH_I,           $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_SHEMINI_AZERETH,     $ID_NULL,    $ID_NULL);     /* 52 */

$torahSectionsF = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_SHEKALIM,$ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PARAH,   $ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_HAHODESH,$ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 25 */
   $ID_PESAH_VII,           $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 29 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 41 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 52 */

$torahSectionsG = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_SHEKALIM,$ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_ZAHOR,   $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_PARAH,   $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_PEKUDE,  $ID_HAHODESH,  /* 22 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_HAGGADOL,$ID_NULL,      /* 25 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 26 */
   $ID_SHEMINI,             $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_TAZRIANG,           $ID_METSORANG,$ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_KEDOSHIM,$ID_NULL,      /* 29 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_BEHAR,            $ID_BEHUKKOTHAI,$ID_NULL,      /* 31 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 40 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 48 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_YOM_KIPPUR,          $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 51 */

$torahSectionsHDiaspora = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,   $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_PARAH,   $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_HAHODESH,$ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_SHAVUOTH_II,         $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_HUKATH,              $ID_BALAK,   $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 43 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 51 */
   $ID_ROSH_HASHANAH_I,     $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_SUCCOTH_I,           $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_SHEMINI_AZERETH,     $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsHIsrael = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,   $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_PARAH,   $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_HAHODESH,$ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 43 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 51 */
   $ID_ROSH_HASHANAH_I,     $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_SUCCOTH_I,           $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_SHEMINI_AZERETH,     $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsI = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_NULL,    $ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_SHEKALIM,$ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,   $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_NULL,    $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_PARAH,   $ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_HAHODESH,$ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_NULL,    $ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_HAGGADOL,$ID_NULL,      /* 29 */
   $ID_PESAH_VII,           $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_MASEH,               $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsJ = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,   $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_PARAH,   $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_HAHODESH,$ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 43 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 51 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_YOM_KIPPUR,          $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 54 */

$torahSectionsKDiaspora = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,   $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_NULL,    $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_PARAH,   $ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_HAHODESH,$ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_PESAH_I,             $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_PESAH_VIII,          $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 44 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsKIsrael = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,   $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_NULL,    $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_PARAH,   $ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_HAHODESH,$ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_PESAH_I,             $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_MASEH,               $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsLDiaspora = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,  $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_NULL,    $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_PARAH,   $ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_HAHODESH,$ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_PESAH_I,             $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_PESAH_VIII,          $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 44 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsLIsrael = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,  $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_NULL,    $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_PARAH,   $ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_HAHODESH,$ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_PESAH_I,             $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_MASEH,               $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_NITSABIM,            $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_VAYELEH,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsM = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_NULL,    $ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_SHEKALIM,$ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_NULL,    $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_ZAHOR,   $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_PARAH,   $ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_HAHODESH,$ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_NULL,    $ID_NULL,      /* 28 */
   $ID_AHAREMOTH,           $ID_HAGGADOL,$ID_NULL,      /* 29 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_NULL,    $ID_NULL,      /* 43 */
   $ID_MASEH,               $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 51 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 52 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_YOM_KIPPUR,          $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_HOL_HAMOED_SUCCOTH,  $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsNDiaspora = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,   $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_PARAH,   $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_HAHODESH,$ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_SHAVUOTH_II,         $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_HUKATH,              $ID_BALAK,   $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 43 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 51 */
   $ID_ROSH_HASHANAH_I,     $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_SUCCOTH_I,           $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_SHEMINI_AZERETH,     $ID_NULL,    $ID_NULL);     /* 55 */

$torahSectionsNIsrael = array
  ($ID_BERESHITH,           $ID_NULL,    $ID_NULL,      /*  1 */
   $ID_NOAH,                $ID_NULL,    $ID_NULL,      /*  2 */
   $ID_LEHLEHA,             $ID_NULL,    $ID_NULL,      /*  3 */
   $ID_VAYERA,              $ID_NULL,    $ID_NULL,      /*  4 */
   $ID_HAYESARAH,           $ID_NULL,    $ID_NULL,      /*  5 */
   $ID_TOLEDOTH,            $ID_NULL,    $ID_NULL,      /*  6 */
   $ID_VAYETSE,             $ID_NULL,    $ID_NULL,      /*  7 */
   $ID_VAYISHLAH,           $ID_NULL,    $ID_NULL,      /*  8 */
   $ID_VAYESHEB,            $ID_NULL,    $ID_NULL,      /*  9 */
   $ID_MIKKETS,             $ID_NULL,    $ID_NULL,      /* 10 */
   $ID_VAYIGGASH,           $ID_NULL,    $ID_NULL,      /* 11 */
   $ID_VAYHEE,              $ID_NULL,    $ID_NULL,      /* 12 */
   $ID_SHEMOTH,             $ID_NULL,    $ID_NULL,      /* 13 */
   $ID_VAERA,               $ID_NULL,    $ID_NULL,      /* 14 */
   $ID_BO,                  $ID_NULL,    $ID_NULL,      /* 15 */
   $ID_BESHALLAH,           $ID_NULL,    $ID_NULL,      /* 16 */
   $ID_YITHRO,              $ID_NULL,    $ID_NULL,      /* 17 */
   $ID_MISHPATIM,           $ID_NULL,    $ID_NULL,      /* 18 */
   $ID_TERUMAH,             $ID_NULL,    $ID_NULL,      /* 19 */
   $ID_TETSAVVEH,           $ID_NULL,    $ID_NULL,      /* 20 */
   $ID_KITISSA,             $ID_NULL,    $ID_NULL,      /* 21 */
   $ID_VAYAKHEL,            $ID_SHEKALIM,$ID_NULL,      /* 22 */
   $ID_PEKUDE,              $ID_NULL,    $ID_NULL,      /* 23 */
   $ID_VAYIKRA,             $ID_ZAHOR,   $ID_NULL,      /* 24 */
   $ID_TSAV,                $ID_PARAH,   $ID_NULL,      /* 25 */
   $ID_SHEMINI,             $ID_HAHODESH,$ID_NULL,      /* 26 */
   $ID_TAZRIANG,            $ID_NULL,    $ID_NULL,      /* 27 */
   $ID_METSORANG,           $ID_HAGGADOL,$ID_NULL,      /* 28 */
   $ID_HOL_HAMOED_PESAH,    $ID_NULL,    $ID_NULL,      /* 29 */
   $ID_AHAREMOTH,           $ID_NULL,    $ID_NULL,      /* 30 */
   $ID_KEDOSHIM,            $ID_NULL,    $ID_NULL,      /* 31 */
   $ID_EMOR,                $ID_NULL,    $ID_NULL,      /* 32 */
   $ID_BEHAR,               $ID_NULL,    $ID_NULL,      /* 33 */
   $ID_BEHUKKOTHAI,         $ID_NULL,    $ID_NULL,      /* 34 */
   $ID_BEMIDBAR,            $ID_NULL,    $ID_NULL,      /* 35 */
   $ID_NASO,                $ID_NULL,    $ID_NULL,      /* 36 */
   $ID_BEHAALOTEHA,         $ID_NULL,    $ID_NULL,      /* 37 */
   $ID_SHELAHLEHA,          $ID_NULL,    $ID_NULL,      /* 38 */
   $ID_KORAH,               $ID_NULL,    $ID_NULL,      /* 39 */
   $ID_HUKATH,              $ID_NULL,    $ID_NULL,      /* 40 */
   $ID_BALAK,               $ID_NULL,    $ID_NULL,      /* 41 */
   $ID_PINHAS,              $ID_NULL,    $ID_NULL,      /* 42 */
   $ID_MATOTH,              $ID_MASEH,   $ID_NULL,      /* 43 */
   $ID_DEBARIM,             $ID_NULL,    $ID_NULL,      /* 44 */
   $ID_VAETHANAN,           $ID_NULL,    $ID_NULL,      /* 45 */
   $ID_EKEB,                $ID_NULL,    $ID_NULL,      /* 46 */
   $ID_REEH,                $ID_NULL,    $ID_NULL,      /* 47 */
   $ID_SHOFETIM,            $ID_NULL,    $ID_NULL,      /* 48 */
   $ID_KITETSE,             $ID_NULL,    $ID_NULL,      /* 49 */
   $ID_KITABO,              $ID_NULL,    $ID_NULL,      /* 50 */
   $ID_NITSABIM,            $ID_VAYELEH, $ID_NULL,      /* 51 */
   $ID_ROSH_HASHANAH_I,     $ID_NULL,    $ID_NULL,      /* 52 */
   $ID_HAAZINU,             $ID_NULL,    $ID_NULL,      /* 53 */
   $ID_SUCCOTH_I,           $ID_NULL,    $ID_NULL,      /* 54 */
   $ID_SHEMINI_AZERETH,     $ID_NULL,    $ID_NULL);     /* 55 */

function torahGetWeekday($absDate) {
  return jddayofweek($absDate, 0);
}

function torahHebrewLeapYear($year) {
  if (((($year*7)+1) % 19) < 7)
    return true;
  else
    return false;
}

function torahLastMonthOfHebrewYear($year) {
  if (torahHebrewLeapYear($year))
    return 13;
  else
    return 12;
}

function getYearType($year) {
  $rhWeekday = torahGetWeekday(jewishtojd(1, 1, $year));
  $lengthOfYear = jewishtojd(1, 1, $year+1) - jewishtojd(1, 1, $year);
  $pesWeekday = torahGetWeekday(jewishtojd(8, 15, $year));

  if (($rhWeekday == 1) && ($lengthOfYear == 353) && ($pesWeekday == 2)) return 1;
  if (($rhWeekday == 6) && ($lengthOfYear == 353) && ($pesWeekday == 0)) return 2;
  if (($rhWeekday == 2) && ($lengthOfYear == 354) && ($pesWeekday == 4)) return 3;
  if (($rhWeekday == 4) && ($lengthOfYear == 354) && ($pesWeekday == 6)) return 4;
  if (($rhWeekday == 1) && ($lengthOfYear == 355) && ($pesWeekday == 4)) return 5;
  if (($rhWeekday == 4) && ($lengthOfYear == 355) && ($pesWeekday == 0)) return 6;
  if (($rhWeekday == 6) && ($lengthOfYear == 355) && ($pesWeekday == 2)) return 7;

  if (($rhWeekday == 1) && ($lengthOfYear == 383) && ($pesWeekday == 4)) return 8;
  if (($rhWeekday == 4) && ($lengthOfYear == 383) && ($pesWeekday == 0)) return 9;
  if (($rhWeekday == 6) && ($lengthOfYear == 383) && ($pesWeekday == 2)) return 10;
  if (($rhWeekday == 2) && ($lengthOfYear == 384) && ($pesWeekday == 6)) return 11;
  if (($rhWeekday == 1) && ($lengthOfYear == 385) && ($pesWeekday == 6)) return 12;
  if (($rhWeekday == 4) && ($lengthOfYear == 385) && ($pesWeekday == 2)) return 13;
  if (($rhWeekday == 6) && ($lengthOfYear == 385) && ($pesWeekday == 4)) return 14;

  return 0;
}

function determineBereshith($year) {
  $simchatTorah = jewishtojd(1, 23, $year);
  while (torahGetWeekday($simchatTorah) != 6) {
    $simchatTorah++;
  }
  return ($simchatTorah);
}

function getTorahSectionName($section) {
  global $ID_BERESHITH, $ID_NOAH, $ID_LEHLEHA, $ID_VAYERA, $ID_HAYESARAH;
  global $ID_TOLEDOTH, $ID_VAYETSE, $ID_VAYISHLAH, $ID_VAYESHEB, $ID_MIKKETS;
  global $ID_VAYIGGASH, $ID_VAYHEE, $ID_SHEMOTH, $ID_VAERA, $ID_BO;
  global $ID_BESHALLAH, $ID_YITHRO, $ID_MISHPATIM, $ID_TERUMAH, $ID_TETSAVVEH;
  global $ID_KITISSA, $ID_VAYAKHEL, $ID_PEKUDE, $ID_VAYIKRA, $ID_TSAV;
  global $ID_SHEMINI, $ID_TAZRIANG, $ID_METSORANG, $ID_AHAREMOTH;
  global $ID_KEDOSHIM, $ID_EMOR, $ID_BEHAR, $ID_BEHUKKOTHAI, $ID_BEMIDBAR;
  global $ID_NASO, $ID_BEHAALOTEHA, $ID_SHELAHLEHA, $ID_KORAH, $ID_HUKATH;
  global $ID_BALAK, $ID_PINHAS, $ID_MATOTH, $ID_MASEH, $ID_DEBARIM;
  global $ID_VAETHANAN, $ID_EKEB, $ID_REEH, $ID_SHOFETIM, $ID_KITETSE;
  global $ID_KITABO, $ID_NITSABIM, $ID_VAYELEH, $ID_HAAZINU;
  global $ID_SHEKALIM, $ID_ZAHOR, $ID_PARAH, $ID_HAHODESH, $ID_SHUVA;

  if ($section == $ID_BERESHITH) return "Bereshith";
  if ($section == $ID_NOAH) return "Noah";
  if ($section == $ID_LEHLEHA) return "Le'h Leha";
  if ($section == $ID_VAYERA) return "Vayera";
  if ($section == $ID_HAYESARAH) return "Haye Sarah";
  if ($section == $ID_TOLEDOTH) return "Toledoth";
  if ($section == $ID_VAYETSE) return "Vayetse";
  if ($section == $ID_VAYISHLAH) return "Vayishlah";
  if ($section == $ID_VAYESHEB) return "Vayesheb";
  if ($section == $ID_MIKKETS) return "Mikkets";
  if ($section == $ID_VAYIGGASH) return "Vayiggash";
  if ($section == $ID_VAYHEE) return "Vayhee";
  if ($section == $ID_SHEMOTH) return "Shemoth";
  if ($section == $ID_VAERA) return "Vaera";
  if ($section == $ID_BO) return "Bo";
  if ($section == $ID_BESHALLAH) return "Beshallah, Shabbat Shirah";
  if ($section == $ID_YITHRO) return "Yithro";
  if ($section == $ID_MISHPATIM) return "Mishpatim";
  if ($section == $ID_TERUMAH) return "Terumah";
  if ($section == $ID_TETSAVVEH) return "Tetsavveh";
  if ($section == $ID_KITISSA) return "Ki Tissa";
  if ($section == $ID_VAYAKHEL) return "Vayakhel";
  if ($section == $ID_PEKUDE) return "Pekude";
  if ($section == $ID_VAYIKRA) return "Vayikra";
  if ($section == $ID_TSAV) return "Tsav";
  if ($section == $ID_SHEMINI) return "Shemini";
  if ($section == $ID_TAZRIANG) return "Tazria";
  if ($section == $ID_METSORANG) return "Metsora";
  if ($section == $ID_AHAREMOTH) return "Aharemoth";
  if ($section == $ID_KEDOSHIM) return "Kedoshim";
  if ($section == $ID_EMOR) return "Emor";
  if ($section == $ID_BEHAR) return "Behar";
  if ($section == $ID_BEHUKKOTHAI) return "Behukkothai";
  if ($section == $ID_BEMIDBAR) return "Bemidbar";
  if ($section == $ID_NASO) return "Naso";
  if ($section == $ID_BEHAALOTEHA) return "Behaaloteha";
  if ($section == $ID_SHELAHLEHA) return "Shelah Leha";
  if ($section == $ID_KORAH) return "Korah";
  if ($section == $ID_HUKATH) return "Hukath";
  if ($section == $ID_BALAK) return "Balak";
  if ($section == $ID_PINHAS) return "Pinhas";
  if ($section == $ID_MATOTH) return "Matoth";
  if ($section == $ID_MASEH) return "Maseh";
  if ($section == $ID_DEBARIM) return "Debarim, Shabbat Hazon";
  if ($section == $ID_VAETHANAN) return "Vaethanan, Shabbat Nahamu";
  if ($section == $ID_EKEB) return "Ekeb";
  if ($section == $ID_REEH) return "Reeh";
  if ($section == $ID_SHOFETIM) return "Shofetim";
  if ($section == $ID_KITETSE) return "Ki Tetse";
  if ($section == $ID_KITABO) return "Ki Tabo";
  if ($section == $ID_NITSABIM) return "Nitsabim";
  if ($section == $ID_VAYELEH) return "Vayeleh";
  if ($section == $ID_HAAZINU) return "Haazinu";

  if ($section == $ID_SHEKALIM) return "Shabbat Shekalim";
  if ($section == $ID_ZAHOR) return "Shabbat Za'hor";
  if ($section == $ID_PARAH) return "Shabbat Parah";
  if ($section == $ID_HAHODESH) return "Shabbat Hahodesh";
  if ($section == $ID_SHUVA) return "Shabbat Shuva";

  return "";
}

function getTorahSections($hebrewMonth, $hebrewDay, $hebrewYear, $isDiaspora) {
  global $ID_NULL, $ID_SHUVA;
  global $torahSectionsA, $torahSectionsB;
  global $torahSectionsCDiaspora, $torahSectionsCIsrael;
  global $torahSectionsDDiaspora, $torahSectionsDIsrael;
  global $torahSectionsEDiaspora, $torahSectionsEIsrael;
  global $torahSectionsF, $torahSectionsG;
  global $torahSectionsHDiaspora, $torahSectionsHIsrael;
  global $torahSectionsI, $torahSectionsJ;
  global $torahSectionsKDiaspora, $torahSectionsKIsrael;
  global $torahSectionsLDiaspora, $torahSectionsLIsrael;
  global $torahSectionsM;
  global $torahSectionsNDiaspora, $torahSectionsNIsrael;

  $shuvahDate = jewishtojd(1, 1, $hebrewYear)+1;
  while (torahGetWeekday($shuvahDate) != 6) {
    $shuvahDate++;
  }

  $torahDate = jewishtojd($hebrewMonth, $hebrewDay, $hebrewYear);
  if (torahGetWeekday($torahDate) == 6) {
    $bereshithDate = determineBereshith($hebrewYear);
    if ($torahDate < $bereshithDate)
      $referenceYear = $hebrewYear-1;
    else
      $referenceYear = $hebrewYear;

    $yearType = getYearType($referenceYear);
    $bereshithDate = determineBereshith($referenceYear);
    $torahWeekNo = ($torahDate-$bereshithDate)/7;

    $returnTorahSection = "";
    $idTorah1 = $ID_NULL;
    $idTorah2 = $ID_NULL;
    $idTorah3 = $ID_NULL;
/*
allgemein: A, B, F, G, I, J, M
Israel/Diaspora: C, D, E, H, K, L, N
*/

    switch ($yearType) {
      case 1: /* A */
        $idTorah1 = $torahSectionsA[$torahWeekNo * 3 + 0];
        $idTorah2 = $torahSectionsA[$torahWeekNo * 3 + 1];
        $idTorah3 = $torahSectionsA[$torahWeekNo * 3 + 2];
	break;
      case 2: /* B */
        $idTorah1 = $torahSectionsB[$torahWeekNo * 3 + 0];
        $idTorah2 = $torahSectionsB[$torahWeekNo * 3 + 1];
        $idTorah3 = $torahSectionsB[$torahWeekNo * 3 + 2];
	break;
      case 3: /* C */
	if ($isDiaspora) {
          $idTorah1 = $torahSectionsCDiaspora[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsCDiaspora[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsCDiaspora[$torahWeekNo * 3 + 2];
	} else {
          $idTorah1 = $torahSectionsCIsrael[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsCIsrael[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsCIsrael[$torahWeekNo * 3 + 2];
	}
	break;
      case 4: /* D */
	if ($isDiaspora) {
          $idTorah1 = $torahSectionsDDiaspora[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsDDiaspora[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsDDiaspora[$torahWeekNo * 3 + 2];
	} else {
          $idTorah1 = $torahSectionsDIsrael[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsDIsrael[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsDIsrael[$torahWeekNo * 3 + 2];
	}
	break;
      case 5: /* E */
	if ($isDiaspora) {
          $idTorah1 = $torahSectionsEDiaspora[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsEDiaspora[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsEDiaspora[$torahWeekNo * 3 + 2];
	} else {
          $idTorah1 = $torahSectionsEIsrael[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsEIsrael[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsEIsrael[$torahWeekNo * 3 + 2];
	}
	break;
      case 6: /* F */
        $idTorah1 = $torahSectionsF[$torahWeekNo * 3 + 0];
        $idTorah2 = $torahSectionsF[$torahWeekNo * 3 + 1];
        $idTorah3 = $torahSectionsF[$torahWeekNo * 3 + 2];
	break;
      case 7: /* G */
        $idTorah1 = $torahSectionsG[$torahWeekNo * 3 + 0];
        $idTorah2 = $torahSectionsG[$torahWeekNo * 3 + 1];
        $idTorah3 = $torahSectionsG[$torahWeekNo * 3 + 2];
	break;
      case 8: /* H */
	if ($isDiaspora) {
          $idTorah1 = $torahSectionsHDiaspora[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsHDiaspora[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsHDiaspora[$torahWeekNo * 3 + 2];
	} else {
          $idTorah1 = $torahSectionsHIsrael[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsHIsrael[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsHIsrael[$torahWeekNo * 3 + 2];
	}
	break;
      case 9: /* I */
        $idTorah1 = $torahSectionsI[$torahWeekNo * 3 + 0];
        $idTorah2 = $torahSectionsI[$torahWeekNo * 3 + 1];
        $idTorah3 = $torahSectionsI[$torahWeekNo * 3 + 2];
	break;
      case 10: /* J */
        $idTorah1 = $torahSectionsJ[$torahWeekNo * 3 + 0];
        $idTorah2 = $torahSectionsJ[$torahWeekNo * 3 + 1];
        $idTorah3 = $torahSectionsJ[$torahWeekNo * 3 + 2];
	break;
      case 11: /* K */
	if ($isDiaspora) {
          $idTorah1 = $torahSectionsKDiaspora[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsKDiaspora[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsKDiaspora[$torahWeekNo * 3 + 2];
	} else {
          $idTorah1 = $torahSectionsKIsrael[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsKIsrael[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsKIsrael[$torahWeekNo * 3 + 2];
	}
	break;
      case 12: /* L */
	if ($isDiaspora) {
          $idTorah1 = $torahSectionsLDiaspora[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsLDiaspora[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsLDiaspora[$torahWeekNo * 3 + 2];
	} else {
          $idTorah1 = $torahSectionsLIsrael[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsLIsrael[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsLIsrael[$torahWeekNo * 3 + 2];
	}
	break;
      case 13: /* M */
        $idTorah1 = $torahSectionsM[$torahWeekNo * 3 + 0];
        $idTorah2 = $torahSectionsM[$torahWeekNo * 3 + 1];
        $idTorah3 = $torahSectionsM[$torahWeekNo * 3 + 2];
	break;
      case 14: /* N */
	if ($isDiaspora) {
          $idTorah1 = $torahSectionsNDiaspora[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsNDiaspora[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsNDiaspora[$torahWeekNo * 3 + 2];
	} else {
          $idTorah1 = $torahSectionsNIsrael[$torahWeekNo * 3 + 0];
          $idTorah2 = $torahSectionsNIsrael[$torahWeekNo * 3 + 1];
          $idTorah3 = $torahSectionsNIsrael[$torahWeekNo * 3 + 2];
	}
	break;
    }

    if ($idTorah1 != $ID_NULL) {
      $torahSection = getTorahSectionName($idTorah1);
      if ($torahSection != "") {
	if ($returnTorahSection != "")
	  $returnTorahSection = $returnTorahSection . ", ";
	$returnTorahSection = $returnTorahSection . $torahSection;
      }
    }
    if ($idTorah2 != $ID_NULL) {
      $torahSection = getTorahSectionName($idTorah2);
      if ($torahSection != "") {
	if ($returnTorahSection != "")
	  $returnTorahSection = $returnTorahSection . ", ";
	$returnTorahSection = $returnTorahSection . $torahSection;
      }
    }
    if ($idTorah3 != $ID_NULL) {
      $torahSection = getTorahSectionName($idTorah3);
      if ($torahSection != "") {
	if ($returnTorahSection != "")
	  $returnTorahSection = $returnTorahSection . ", ";
	$returnTorahSection = $returnTorahSection . $torahSection;
      }
    }
    if ($torahDate == $shuvahDate) {
      if ($returnTorahSection != "")
	$returnTorahSection = $returnTorahSection . ", ";
      $returnTorahSection = $returnTorahSection . getTorahSectionName($ID_SHUVA);
    }

    return ($returnTorahSection);
  } else {
    return "";
  }
}
?>
Example of use: file sample.php

<html>
<body>

<form name="torahform" action="sample.php">
Day: <input type="text" name="day" size="2">
Month: <input type="text" name="month" size="2">
Year: <input type="text" name="year" size="4">
<input type="checkbox" name="diaspora" value="X">Diaspora
<input type="submit" value="Show name of torah section(s)">
</form>

<?php
include('torah.inc');

if (isSet($_REQUEST["day"]) && isSet($_REQUEST["month"]) && isSet($_REQUEST["year"])) {
  $paramDay = intval($_REQUEST["day"]);
  $paramMonth = intval($_REQUEST["month"]);
  $paramYear = intval($_REQUEST["year"]);
  if ($_REQUEST["diaspora"] == "X") {
    $isDiaspora = true;
  } else {
    $isDiaspora = false;
  }
  echo "<p>$paramDay.$paramMonth.$paramYear, diaspora = $isDiaspora</p>\n";
  $str = getTorahSections($paramMonth, $paramDay, $paramYear, $isDiaspora);
  if ($str != "") {
    echo "<p>Torah section(s): $str</p>\n";
  } else {
    echo "<p>No torah sections on that day</p>\n";
  }
}
?>

</body>
</html>
Valid XHTML 1.1
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>