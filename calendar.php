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
<script>
function reloadWithQueryStringVars (queryStringVars) {
    var existingQueryVars = location.search ? location.search.substring(1).split("&") : [],
        currentUrl = location.search ? location.href.replace(location.search,"") : location.href,
        newQueryVars = {},
        newUrl = currentUrl + "?";
    if(existingQueryVars.length > 0) {
        for (var i = 0; i < existingQueryVars.length; i++) {
            var pair = existingQueryVars[i].split("=");
            newQueryVars[pair[0]] = pair[1];
        }
    }
    if(queryStringVars) {
        for (var queryStringVar in queryStringVars) {
            newQueryVars[queryStringVar] = queryStringVars[queryStringVar];
        }
    }
    if(newQueryVars) { 
        for (var newQueryVar in newQueryVars) {
            newUrl += newQueryVar + "=" + newQueryVars[newQueryVar] + "&";
        }
        newUrl = newUrl.substring(0, newUrl.length-1);
        window.location.href = newUrl;
    } else {
        window.location.href = location.href;
    }
}
	</script>	
<!-- Link logic follows -->
 <script>
$(document).ready(function(){	 
$("#linkBackOneMonth").click(function(){
	console.log("Back clicked");
	var d= new Date();
	var year = d.getFullYear();
	var thisMonth = d.getMonth();
	var prevMonth= thisMonth;
	if(prevMonth==0)
			{prevMonh=12;
			var prevYear=year-1;}
			else{
			prevYear=year;	
			}
	console.log("Previous month "+prevMonth);
	console.log("Previous Year"+prevYear);
	reloadWithQueryStringVars({"month": prevMonth,"year": prevYear});
	
});
$("#linkReset").click(function(){
	console.log("Reset clicked");
	var d= new Date();
	var year = d.getFullYear();
	var thisMonth = d.getMonth();
	thisMonth+=1;
	console.log("This month "+thisMonth);
	console.log("This Year " +year);
	reloadWithQueryStringVars({"month": thisMonth,"year": year});
	
});
$("#adjustMonths").click(function(){
	console.log("Adjust months clicked");
	var thisMonth= document.getElementById('viewMonth').value;
	var year = document.getElementById('viewYear').value;
	console.log("This month "+thisMonth);
	console.log("This Year " +year);
	reloadWithQueryStringVars({"month": thisMonth,"year": year});
});	
$("#linkFwdOneMonth").click(function(){
	console.log("Forward clicked");
	var d= new Date();
	var year = d.getFullYear();
	var thisMonth = d.getMonth();
	var nextMonth= thisMonth+2;
	if(nextMonth==13)
			{nextMonh=1;
			var nextYear=year +1;}
			else{
			nextYear=year;	
			}
	console.log("Next month "+nextMonth);
	console.log("Next year"+nextYear);
	reloadWithQueryStringVars({"month": nextMonth,"year": nextYear});
});
});
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
<div id="top" data-role="header">
  <h1>Gray and White Computing Event Calendar</h1></div>
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
<p>
This calendar is prepared from informaton contained in the Gray and White Event Database.	
	
The text that you see in the day boxes are the sponsoring organization  identification codes.
<span style="font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #FF0000;
	font-size: 24px;">Click on the day number to see the detail for that day. 
	</span>It might take more than one day to process event entries but before the weekly newsletter is published on Sunday, all entries would be processed. </p>
<table border="1" cellpadding="3" cellspacing="0" width="100%">
<tr style="bluerow">
	<td colspan=7><center><b><?php echo $Monthname," ", $Year ?></b></center></td>
	</tr>

<tr class="bluerow">
<td id="linkBackOneMonth" align="left">
<img src="../pjsnimages/arrowLeft.png" height="50px">
</td>
<td id="linkReset"><img src="../pjsnimages/arrowUp.png"
	align="center" height="50px"/>Reset to this month</td>
<td align="right" id="linkFwdOneMonth">

<input type="hidden" name="Month" value="$nextMonth">
<input type="hidden" name="Year" value="$nextYear">
<img src="../pjsnimages/arrowRight.png" height="50px">	
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
               print("<td bgcolor=\"green\" class=\"greenrow\">&nbsp;</td>");
            } elseif (($StartDate >= 1) && ($StartDate <= $LastDay   )) {
                       $this_date = $Year . "-". $Month . "-" . $this_day;
                     //  print("<br> $this_date");
               if ( !$affil ){
               print("<td class=\"whiterow\" ><a href=\"../pjsn/dailyNews.php?eventDate=$this_date target=\'_blank\'\">$StartDate</a>");
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

?>
	</table>
	<h3>See other events loaded into the databae only in the future.</h3>
	<h4>When this method is used, one can only work with one month. The back and forward arrows will limit one to the three months, this month last month and next month. </h4>
	<label for viewMonth>View this month number: </label>
	<input id='viewMonth' type="text" width='2' name="vewMonth">
	<label for 'viewYear'>In this year: </label>
	<input id='viewYear' type=text width='4'>
	<input name="newDate" id="adjustMonths" type="button" class="bluerow"  value="Change months">
	
</div><!-- end of content -->
<div id="footer" data-role="footer"><h1>Monthly Database Event Calendar</h1></div>
</div><!-- End of Page -->
</body>
</html>