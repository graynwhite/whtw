<HTML>
<HEAD>
<TITLE>Monthly Calendar</TITLE>


<script language="javascript">
function bump(number)
{
 //alert("at bump");
 var workMonth = document.getElementById('calMonth');
 var newWeek=0;
 newWeek += workMonth;
 var bumpFactor = number;
 //workMonth = parseInt('workMonth.value');
 //workMonth.value += number;
 alert("New month is " + newWeek.value);
 var workYear = document.getElementById('calYear');
  alert("work year is " + workYear.value);
}
</script>
</HEAD>
<BODY>
<?php
/** @package

        calendar.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 06/22/2011 4:50:20 PM
	
*/
$Month = $_REQUEST['Month'];
$Year = $_REQUEST['Year'] . '-';
if(strlen($Month)==0)
{
$Month = date("m");
	if(strlen($Month)==1)
	{
		$Month= '0' . $Month;
	}
}
if(strlen($Year)==1)
{
  $Year = date("Y"). '-';
}

$submit= $_REQUEST['Submit'];
$PageTitle ="What's Happening This Month Calendar";
if ( $affil =="arch" ){
$PageTitle ="Archdiocese of Detroit Singles Calendar";
}
 include_once('php_select_year.php');

require("../header.php");
if ((!$Month) && (!$Year)) {
           $Month = date("m");
           $Year = date("Y"). '-';
}

// calculate the viewed month
$Timestamp = mktime(0,0,0,$Month,1,substr($Year,0,4));
$Monthname = date("F",$Timestamp);
$year_print = substr($Year,0,4);
$nextTimestamp = mktime(0,0,0,$Month+1,1,substr($Year,0,4));
$nextMonthName = date("F",$nextTimestamp);
$nextMonth = date("m",$nextTimestamp);
$nextYear = date("Y",$nextTimestamp);
$prevTimestamp = mktime(0,0,0,$Month-1,1,substr($Year,0,4));
$prevMonthName = date("F",$prevTimestamp);
$prevMonth=date("m",$prevTimestamp);
$prevYear = date("Y",$prevTimestamp);
?>
  <style type="text/css">
<!--
.returnmessage {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF0000;
	font-size: 24px;
}
-->
   </style>

<div align=center id=googleadsense>
  <p>
    <script type="text/javascript"><!--
google_ad_client = "pub-4877966866498226";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "image";
google_ad_channel = "calendarphp";
//-->
  </script>
    <script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
  </script>

</div>
<?php
// make a table with the proper month
print ("<Table Border=1 Cellpadding=3 CELLSPACING=0 ALIGN=CENTER>");
print ("<TR BGCOLOR=BLUE><TD COLSPAN=7 ALIGN=CENTER><FONT COLOR=WHITE><B>$Monthname $year_print</B></FONT></TD></TR>");
print ("<tr BGCOLOR=BLUE><TD>");
print ("<form action=\"calendarTest.php\" method=\"post\">\n");
print ("<input type=\"hidden\" name=\"Month\" value=\"$prevMonth\">\n");
print ("<input type=\"hidden\" name=\"Year\" value=\"$prevYear\">\n");
print ("<input type=\"Submit\" name=\"SUBMIT\" value=\"<< $prevMonthName $prevYear\">\n");
print ("</form> \n");
print ("</td><TD colspan=5 </td><td align=\"right\">\n");
print ("<form action=\"calendarTest.php\" method=\"post\">\n");
print ("<input type=\"hidden\" name=\"Month\" value=\"$nextMonth\">\n");
print ("<input type=\"hidden\" name=\"Year\" value=\"$nextYear\">\n");
print ("<input type=\"Submit\" name=\"SUBMIT\" value=\"$nextMonthName $nextYear >>\">\n");
print ("</form> \n");
print ("</td></tr>");
print ("<tr BGCOLOR=BLUE><td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Sun</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Mon</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Tue</FONT></B></TD> 
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Wed</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Thu</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Fri</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Sat</FONT></B></TD></TR>\n");
$MonthStart = date ("w", $Timestamp);
print("<p><span style=\"font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF0000;
	font-size: 24px;\">Click on the day number to see the detail for that day. ");
print("</span> The short organization codes are displayed when they have an event for that day. </p>");
if ($MonthStart == 0) {
   $MonthStart = 7;
}
$LastDay = date("d",mktime(0,0,0,$Month+1,0,substr($Year,0,4)));
$dbbegin= $Year  . $Month . "-01";
$dbend =  $Year  . $Month . "-" . $LastDay;
print ("<p> from $dbbegin to $dbend </P>");
print ("<input type=\"hidden\" id=\"calMonth\" value=\"$Month\">");
print ("<input type=\"hidden\" id=\"calYear\" value=\"$Year\">");
                   
	//connect to the database server
            include("../cgi-bin//connect.inc");
        if ( !$affil ){
        $sql = "SELECT T1.*, T2.Short_name FROM events as T1,
                orgs as T2 
        WHERE
             T1.Event_org = T2.Org_num && T2.publish_whtw = 'T'
            && ( T1.Date_from >= \"$dbbegin\" )
            && T1.Date_from <= \"$dbend\"
            && T1.Event_open != \"N\"    
            order by Date_from  ";
     }else{
        $sql = "SELECT T1.*, T2.Short_name FROM events as T1,
                orgs as T2 
        WHERE
             T1.Event_org = T2.Org_num && T2.publish_whtw = 'T'
            && T2.affil = \"$affil\"
            && ( T1.Date_from >= \"$dbbegin\" )
            && T1.Date_from <= \"$dbend\"
            && T1.Event_open != \"N\"    
            order by Date_from  ";
        }
        // print("<br>$sql");
        // request items from the events table
           $result = @mysql_query($sql);
           if (!$result) {
                    echo("<p>Error performing query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p> ");
      
            exit();
           }
 // load the event array
          $array_date = array(0=>"  ",1=>"  ");
          $array_insert= array(0=>" ",1=>"   ");
          $n=0;
          while ($row = mysql_fetch_array($result)){
           $array_date[$n]=$row["Date_from"];
           if ($row["Event_org"] == "HOL") {
           $array_insert[$n] = "<FONT COLOR=RED> " . substr($row["Place"],0,35). "</font>";
           } else {$array_insert[$n] = $row["Short_name"]; }
            $n++;// print("<p>$n</p>");
           }

  $howmany =count($array_date);
//  print("<p>There are $howmany  events to display.</p>");
$StartDate = -$MonthStart;

for ($k =1; $k <= 6; $k++ ) {
    print("<TR BGCOLOR=White>");
    for ($i=1; $i <= 7; $i++) {
         $StartDate++;
         $this_day = $StartDate;
         if (strlen($this_day)<"2"){ $this_day = "0" . $StartDate; }

     if (($StartDate <= 0) || ($StartDate  > $LastDay)) {
               print("<td BGCOLOR=GREEN>&nbsp</TD>");
            } elseif (($StartDate >= 1) && ($StartDate <= $LastDay   )) {
                       $this_date = $Year  . $Month . "-" . $this_day;
                     //  print("<br> $this_date");
               if ( !$affil ){
               print("<td ALIGN=LEFT VALIGN=TOP ><A HREF=\"calday.php?DayQ=$this_date\">$StartDate</a>");
               }else{
                 print("<td ALIGN=LEFT VALIGN=TOP ><A HREF=\"calday.php?DayQ=$this_date&affil=$affil\">$StartDate</a>");
            }
                     
                        for($l=0;$l<count($array_date);$l++) {
                           if ($this_date == $array_date[$l]) {
                            print("<br><small>$array_insert[$l]</small>");
                            } 
                        }
             //     for each row
             print("</td>");     
          }
          } // end of one week $k< 7
    print ("</TR>\n");
   
}
print ("</table>\n");

print ("<FORM ACTION=\"calendar.php\" METHOD=POST>\n");
print ("Select a new Month to view \n");
print ("<SELECT name = Month>
           <OPTION VALUE=01>January</OPTION>\n
           <OPTION VALUE=02>February</OPTION>\n
           <OPTION VALUE=03>March</OPTION>\n
           <OPTION VALUE=04>April</OPTION>\n
           <OPTION VALUE=05>May</OPTION>\n
           <OPTION VALUE=06>June</OPTION>\n
           <OPTION VALUE=07>July</OPTION>\n
           <OPTION VALUE=08>August</OPTION>\n
           <OPTION VALUE=09>September</OPTION>\n
           <OPTION VALUE=10>October</OPTION>\n
           <OPTION VALUE=11>November</OPTION>\n
           <OPTION VALUE=12>December</OPTION>\n
           </SELECT>\n");
            php_functions_gen_years('Year',True);
//print ("<SELECT Name=Year>
//
//           <OPTION VALUE=2003>2003</OPTION>\n
//            <OPTION VALUE=2004>2004</OPTION>\n
//            <OPTION VALUE=2005>2005</OPTION>\n
//             </SELECT>\n");
print ("<INPUT TYPE =\"Submit\" NAME=SUBMIT VALUE=\"Submit\">\n");
print ("</FORM>\n");

       
?>
<div align=center id=googleadsense>
  <p>
    <script type="text/javascript"><!--
google_ad_client = "pub-4877966866498226";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "image";
google_ad_channel = "calendarphp";
//-->
  </script>
    <script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
  </script>

</div>
</BODY>
</HTML>