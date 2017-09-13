<?php
define("APP_ROOT", $_SERVER['DOCUMENT_ROOT'].'/whtw');
require_once "../gwsecurity/private/initialize.php";
// $affil is set to Gray unless it is requested in a call to this program as a paameter
$affil=isset($_REQUEST['affil']) ? $_REQUEST['affil'] : "Gray";
$Year=isset($_REQUEST['year'])? $_REQUEST['year'] : date("Y");
$Month=isset($_REQUEST['month']) ? $_REQUEST['month']: date('m');
	
if ($Month == 0) {
   $Month = 1;
}
// calculate the viewed month
$Timestamp = mktime(0,0,0,$Month,1,substr($Year,0,4));
$Monthname = date("F",$Timestamp);
$dowk=date("w",$Timestamp);
echo("day of week is " . $dowk);
$year_print = substr($Year,0,4);
$nextTimestamp = mktime(0,0,0,$Month+1,1,substr($Year,0,4));
$nextMonthName = date("F",$nextTimestamp);
$nextMonth = date("m",$nextTimestamp);
$nextYear = date("Y",$nextTimestamp);
$prevTimestamp = mktime(0,0,0,$Month-1,1,substr($Year,0,4));
$prevMonthName = date("F",$prevTimestamp);
$prevMonth=date("m",$prevTimestamp);
$prevYear = date("Y",$prevTimestamp);
$LastDay = date("d",mktime(0,0,0,$Month+1,0,substr($Year,0,4)));

$dbbegin= $Year  ."-". $Month .'-01';
$dbend =  $Year  ."-". $Month . "-" . $LastDay;
								 
$Month = isset($_REQUEST['Month'])? $_REQUEST['Month'] : $Month;
$Year = isset($_REQUEST['Year']) ? $_REQUEST['Year'] : $Year;;
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

?>
<html>
<head>
 <meta name="viewport" content="width=device-width"  initial-scale=1 user-scaleable=1/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
<title>Monthly Calendar</title>


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
   
.bluerow
{
	background-color: #0000FF;
	color: white;
	font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
	font-size: 14;
	text-align: center;
}
 .bluerow td{
	align-content: center;
	width: 14%;
	-webkit-box-shadow: 0px 0px #F9F5F6;
	box-shadow: 0px 0px #F9F5F6;
	color: #FFFFFF;
}
.whiterow
{
	background-color: #ffffff;
	color: #000000;
	font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
	font-size: 11;
	text-align: left;
	-webkit-box-shadow: 0px 0px #000000;
	box-shadow: 0px 0px #000000;
}
	  .whiterow td{align-content: left;
	  	 width: 14%}	  
.greenrow
{
	background-color: #00ff00;
	color: white;
	font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
	font-size: 11;
	text-align: center;
	
}
	  .greenrow td{
		  align-content: center;
		  width: 14%
	  }
  </style>
   
   <script src="http://www.graypluswhite.com/gwanalytics.js"></script>
</head>
<body>
<div id="main" data-role="page">
<div id="top" data-role="header"><h1>Gray and White Computing Event Calendar</h1></div>
<div id="content" data-role="content">
<?php	
$PageTitle ="What's Happening This Month Calendar";
if ( $affil =="arch" ){
$PageTitle ="Archdiocese of Detroit Singles Calendar";
}
 if ((!$Month) && (!$Year)) {
           $Month = date("m");
           $Year = date("Y"). '-';
}


?>

<p><span style="font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF0000;
	font-size: 24px;">Click on the day number to see the detail for that day. 
</span>  </p>
<table border="1" cellpadding="3" cellspacing="0" width="100%">
<tr style="bluerow">
	<td colspan=7><center><b><?php echo $Monthname," ", $Year ?></b></center></td>
	</tr>

<tr class="bluerow">
<td id="linkBackOneMonth" align="left">
<<	<?php echo $prevMonthName ,' ', $prevYear?>
</td>
<td> </td>
<td align="right">

<input type="hidden" name="Month" value="$nextMonth">
<input type="hidden" name="Year" value="$nextYear">
<?php echo $nextMonthName, " ", $nextYear ?>>>	
</td></tr></table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" align="center">
<tr class="bluerow">
	<td>Sun</td>
  	<td>Mon</td>
  	<td>Tue</td>
  	<td>Wed</td>
  	<td>Thu</td>
   	<td>Fri</td>
   	<td>Sat</td>
    </tr></table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" align="center">

									 
<input type="hidden" id="calMonth" value="$Month">
<input type="hidden" id="calYear" value="$Year">
<?php 
            
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
 //print("<p>There are $howmany  events to display.</p>");
	$StartDate =-$dowk;
//echo("<br /> start date is " . $StartDate); 
for ($k =1; $k <= 6; $k++ ) {
    print("<tr bgcolor=\"white\" width=\"14%\">");
    for ($i=1; $i <= 7; $i++) {
         $StartDate++;
         $this_day = $StartDate;
         if (strlen($this_day)<"2"){ $this_day = "0" . $StartDate; }
//echo("<br /> start date is " . $StartDate . " k is " . $k . "i is " . $i); 
     if (($StartDate <= 0) || ($StartDate  > $LastDay)) {
               print("<td class=\"greenrow\">&nbsp;</td>");
            } elseif (($StartDate >= 1) && ($StartDate <= $LastDay   )) {
                       $this_date = $Year . "-". $Month . "-" . $this_day;
                     //  print("<br> $this_date");
               if ( !$affil ){
               print("<td align=\"left\" valign=\"top\" ><a href=\"../pjsn/dailyNews.php?eventDate=$this_date target=\'_blank\'\">$StartDate</a>");
               }else{
                 print("<td aliign=\"left\" valign=\"top\" ><a href=\"../pjsn/dailyNews.php?eventDate=$this_date&affil=$affil target=\'_blank\'\">$StartDate</a>");
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
    print ("</tr>\n");
   
}
print ("</table>\n");

print ("<form action=\"calendar.php\" method=\"post\">\n");
print ("Select a new Month to view \n");
print ("<select name = Month>
           <option value=01>January</option>\n
           <option value=02>February</option>\n
           <option value=03>March</option>\n
           <option value=04>April</option>\n
           <option value=05>May</option>\n
           <option value=06>June</option>\n
           <option value=07>July</option>\n
           <option value=08>August</option>\n
           <option value=09>September</option>\n
           <option value=10>October</option>\n
           <option value=11>November</option>\n
           <option value=12>December</option>\n
           </SELECT>\n");
//php_functions_gen_years('Year',True);
//print ("<SELECT Name=Year>
//
//           <OPTION value=2003>2003</OPTION>\n
//            <OPTION value=2004>2004</OPTION>\n
//            <OPTION value=2005>2005</OPTION>\n
//             </SELECT>\n");
print ("<input type =\"Submit\" name=\"SUBMIT\" value=\"Submit\">\n");
print ("</form>\n");

       
?>

</div><!-- end of content -->
<div id="footer" data-role="footer"><h1>Monthly Calendar</h1></div>
</div><!-- End of Page -->
</body>
</html>