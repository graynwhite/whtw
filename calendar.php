<?php
$affil=isset($_REQUEST['affil']) ? $_REQUEST['affil'] : "Gray";
?>
<HTML>
<HEAD>
 <meta name="viewport" content="width=device-width", initial-scale=1; user-scaleable=1;">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
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
  <style type="text/css">

.returnmessage {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF0000;
	font-size: 24px;
}
   </style>
   <script src="http://www.graypluswhite.com/gwanalytics.js"></script>
</HEAD>
<BODY>
<div id="main" data-role="page">
<div id="top" data_role="header"><h1>Gray and White Computing Event Calendar</h1></div>
<div id="content" data-role="content">
<?php
$currentMonth=date('m');
$currentYear=date('Y');									 
$Month = isset($_REQUEST['Month'])? $_REQUEST['Month'] : $currentMonth;
$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : $currentYear;;
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

$submit= isset($_REQUEST['Submit'])? $_REQUEST['Submit']: 'yes';
$PageTitle ="What's Happening This Month Calendar";
if ( $affil =="arch" ){
$PageTitle ="Archdiocese of Detroit Singles Calendar";
}
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


<?php
print("<p><span style=\"font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF0000;
	font-size: 24px;\">Click on the day number to see the detail for that day. ");
print("</span> Click on the day to see the expanded events </p>");
// make a table with the proper month
print ("<table border=\"1\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\" align=\"center\">");
print ("<TR BGCOLOR=BLUE><TD COLSPAN=7 ALIGN=CENTER><FONT COLOR=WHITE><B>$Monthname $year_print</B></FONT></TD></TR>");
print ("<tr BGCOLOR=BLUE><TD>");
print ("<form action=\"calendar.php\" method=\"post\">\n");
print ("<input type=\"hidden\" name=\"Month\" value=\"$prevMonth\">\n");
print ("<input type=\"hidden\" name=\"Year\" value=\"$prevYear\">\n");
print ("<input type=\"Submit\" name=\"SUBMIT\" value=\"<< $prevMonthName $prevYear\">\n");
print ("</form> \n");
print ("</td><TD colspan=5 </td><td align=\"right\">\n");
print ("<form action=\"calendar.php\" method=\"post\">\n");
print ("<input type=\"hidden\" name=\"Month\" value=\"$nextMonth\">\n");
print ("<input type=\"hidden\" name=\"Year\" value=\"$nextYear\">\n");
print ("<input type=\"Submit\" name=\"SUBMIT\" value=\"$nextMonthName $nextYear >>\">\n");
print ("</form> \n");
print ("</td></tr></table>");
print ("<table border=\"1\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\" align=\"center\">");
print ("<tr BGCOLOR=BLUE>");
print  ("<td ALIGN=CENTER width=\"14%\"<b><FONT COLOR=White>Sun</FONT></B></TD>
         <td ALIGN=CENTER width=\"14%\"<b><FONT COLOR=White>Mon</FONT></B></TD>
         <td ALIGN=CENTER width=\"14%\"<b><FONT COLOR=White>Tue</FONT></B></TD> 
         <td ALIGN=CENTER width=\"14%\"<b><FONT COLOR=White>Wed</FONT></B></TD>
         <td ALIGN=CENTER width=\"14%\"<b><FONT COLOR=White>Thu</FONT></B></TD>
         <td ALIGN=CENTER width=\"14%\"<b><FONT COLOR=White>Fri</FONT></B></TD>
         <td ALIGN=CENTER width=\"14%\"<b><FONT COLOR=White>Sat</FONT></B></TD></TR></table");
print ("<table border=\"1\" cellpadding=\"3\" cellspacing=\"0\" width=\"100%\" align=\"center\">");		 
$MonthStart = date ("w", $Timestamp);

if ($MonthStart == 0) {
   $MonthStart = 1;
}
$LastDay = date("d",mktime(0,0,0,$Month+1,0,substr($Year,0,4)));
$dbbegin= $Year  ."-". $Month .'-01';
$dbend =  $Year  ."-". $Month . "-" . $LastDay;
									 
print ("<input type=\"hidden\" id=\"calMonth\" value=\"$Month\">");
print ("<input type=\"hidden\" id=\"calYear\" value=\"$Year\">");
                   
	//connect to the database server
            include("../phpClasses/connect.php");
            
        if ( $affil=="Gray" ){
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
           $result = mysqli_query($conn,$sql);
           if (!$result) {
                    echo("<p>Error performing query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p> ");
      
            exit();
           }
 // load the event array
          //$array_date = array(0=>"  ",1=>"  ");
//          $array_insert= array(0=>" ",1=>"   ");
			$array_date=array();
			$array_insert=array();
          $n=0;
          while ($row = mysqli_fetch_assoc($result)){
		  //echo('<br /> date' . substr($row['Date_from'],8,2));
		  $array_date[]=substr($row['Date_from'],8,2);
		  $array_insert[]=$row['Short_name'];
		   }

  $howmany =count($array_date);
 print("<p>There are $howmany  events to display.</p>");
$StartDate = -$MonthStart;
//echo("<br /> start date is " . $StartDate); 
for ($k =1; $k <= 6; $k++ ) {
    print("<TR BGCOLOR=White>");
    for ($i=1; $i <= 7; $i++) {
         $StartDate++;
         $this_day = $StartDate;
         if (strlen($this_day)<"2"){ $this_day = "0" . $StartDate; }
//echo("<br /> start date is " . $StartDate . " k is " . $k . "i is " . $i); 
     if (($StartDate <= 0) || ($StartDate  > $LastDay)) {
               print("<td BGCOLOR=GREEN>&nbsp</td>");
            } elseif (($StartDate >= 1) && ($StartDate <= $LastDay   )) {
                       $this_date = $Year . "-". $Month . "-" . $this_day;
                     //  print("<br> $this_date");
               if ( !$affil ){
               print("<td ALIGN=LEFT VALIGN=TOP ><A HREF=\"../pjsn/dailyNews.php?eventDate=$this_date target='_blank'\">$StartDate</a>");
               }else{
                 print("<td ALIGN=LEFT VALIGN=TOP ><A HREF=\"../pjsn/dailyNews.php?eventDate=$this_date&affil=$affil target='_blank'\">$StartDate</a>");
            }
                     
                        for($l=0;$l<count($array_date);$l++) {
                           if ($this_day == $array_date[$l]) {
                            print("<br><small>" . $array_insert[$l]. "</small>");
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
           // php_functions_gen_years('Year',True);
//print ("<SELECT Name=Year>
//
//           <OPTION VALUE=2003>2003</OPTION>\n
//            <OPTION VALUE=2004>2004</OPTION>\n
//            <OPTION VALUE=2005>2005</OPTION>\n
//             </SELECT>\n");
print ("<INPUT TYPE =\"Submit\" NAME=SUBMIT VALUE=\"Submit\">\n");
print ("</FORM>\n");

       
?>
</div><!-- end of content -->
<div id="footer" data-role="footer"><h1>Monthly Calendar</h1></div>
</div><!-- End of Page -->
</BODY>
</HTML>