<?php
/** @package 

        wheventst.php
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 1/5/2005 8:24:10 PM
	Last change: FJC 9/18/2005 10:27:29 PM
*/
?>
<?PHP
DEFINE ("INCLUDED", "yes");
include("../cgi-bin//connect.inc");
include("../cgi-bin/phpauction/includes/dates.inc.php");
include("whtw_banners_inc.php");
 	
 include("../cgi-bin//update_counter.inc");
 include("../cgi-bin//logact.inc");
 include("../cgi-bin//parse.inc");

	view();
 function print_month_heading($Monthname,$year_print){
print ("<TR BGCOLOR=BLUE><TD COLSPAN=7 ALIGN=CENTER><FONT COLOR=WHITE><B> $Monthname  $year_print</B></FONT></TD></TR>");
print ("<tr BGCOLOR=BLUE><td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Sun</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Mon</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Tue</FONT></B></TD> 
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Wed</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Thu</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Fri</FONT></B></TD>
         <td ALIGN=CENTER WIDTH=160<b><FONT COLOR=White>Sat</FONT></B></TD></TR>\n");
} // end of print_month_head

?>
<HTML>
<HEAD>
   <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
   <META NAME="Frank J. Cauley" CONTENT="Current Events">
   <META NAME="GENERATOR" CONTENT="Microsoft FrontPage 5.0">
   <TITLE>Whats Happening This Week</TITLE>
<META NAME="resource-type" CONTENT="document">


</HEAD>


<script language=javascript>
<!--

function setCookie(cookieName,cookieValue,cookiePath,cookieExpires){
        cookieValue=escape(cookieValue);
        if (cookieExpires==""){
                var nowDate = new Date();
                nowDate.setMonth(nowDate.getMonth() + 1);
                cookieExpires=nowDate.toGMTString();
        }
        if (cookiePath != ""){
                cookiePath= ";Path=" + cookiePath;

        }


        document.cookie = cookieName + "=" + cookieValue + ";expires=" + cookieExpires ;

}


function getCookie(name){

        var cookieString = document.cookie;

        var index = cookieString.indexOf(name + "=");
        if (index == -1){
                return null;
        }
        index = cookieString.indexOf("=", index) + 1;
        var endstr = cookieString.indexOf(";",index);
        if (endstr == -1){
                endstr=cookieString.length;
        }
        return unescape(cookieString.substring(index, endstr));
}

function doPopup(){

       var ezine = getCookie('popupshown');

          setCookie('popupshown', 'true', '','');
          
                
          if (ezine == null){
                commentWindow=window.open('comment.htm', 'ezineWin',"scrollbars=yes");
                commentWindow.focus();
          }
}

imageArray = new MakeArray(4);
imageArray[1] = "../whtw/banner1.gif";
imageArray[2] = "../whtw/banner2.gif";
imageArray[3] = "../whtw/banner3.gif";
imageArray[4] = "../whtw/banner4.gif";


function ChangeImage(){
    document.images[0].src = imageArray[ (Math.round ( 3 * Math.random()) +1)];
   
}

function random() {
	var curdate = new Date();
	var work = curdate.getTime() + curdate.getDate()
	return ( (work * 29 +1) % 1024) /1024
}	
function MakeArray(n){
	this.length = n;
	for (var i = n; i <= n; i++){
		this[i] = 0}
	return this
	}

	
// -->				
</script>

<BODY TEXT="#000000" BGCOLOR="#CCFF66" LINK="#0000EE" VLINK="#551A8B"
ALINK="#FF0000"  onUnload="doPopup()">

<!--IMG GOES HERE-->


<H1>
<FONT FACE="ARIAL,HELVETICA">
</FONT>
 
 
<FONT FACE="ARIAL,HELVETICA">
<FONT COLOR="#FF0000">What's Happening This Week</FONT></FONT></H1>
<P><FONT FACE="ARIAL, HELVETICA">

<CENTER>
  <font face="ARIAL, HELVETICA"><a href="http://www.graynwhite.com/whtw/calendar.php"><img src="../cgi-bin/whtw/ftrbtn.gif" width="100" height="30"></a></font><A HREF="event_mail.php"><IMG SRC="../cgi-bin/whtw/addbtn.gif" width="100" height="30"></A>
</CENTER>


<CENTER> 

<?php

  
           
       update_counter("../_private/whtw/whevents.htm.cnt");
      $this_year = date(Y);
      $this_day = date(d);
      $this_month=date(m);
      $this_very_day = $this_year . "-" . $this_month . "-" . $this_day;
      $today=$this_very_day;
      $one_week_hence=mktime(0,0,0,$this_month,$this_day,$this_year);
      $one_week_hence=$one_week_hence + 7*24*60*60;
      $this_year = date(Y,$one_week_hence);
      $this_day = date(d,$one_week_hence);
      $this_month=date(m,$one_week_hence);
      $one_week_from_now = $this_year . "-" . $this_month . "-" . $this_day;
      
?></center>
<!-- BEGIN: Constant Contact Standard Email List Button -->
<div align="center">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td><img src="http://img.constantcontact.com/ui/images/visitor/bevel_tl_yw.gif" width="6" height="6" alt=""></td>
<td background="http://img.constantcontact.com/ui/images/visitor/bevel_bg_top_yw.gif"> </td>
<td><img src="http://img.constantcontact.com/ui/images/visitor/bevel_tr_yw.gif" width="6" height="6" alt=""></td>
</tr>
<tr>
<td background="http://img.constantcontact.com/ui/images/visitor/bevel_bg_left_yw.gif"></td>
<td bgcolor="#ffe169"><a href="http://ui.constantcontact.com/d.jsp?m=1011148101198&p=oi" target="_blank" style="text-decoration:none; font-weight: bold;  font-family:Arial,Helvetica,sans-serif; font-size:20px; color:#330099;"><img src="http://img.constantcontact.com/ui/images/visitor/arrow1_blue.gif" alt="Email Newsletter icon, E-mail Newsletter icon, Email List icon, E-mail List icon" border="0" align="left">Join Email List</a></td>
<td background="http://img.constantcontact.com/ui/images/visitor/bevel_bg_right_yw.gif"></td>
</tr>
<tr>
<td><img src="http://img.constantcontact.com/ui/images/visitor/bevel_bl_yw.gif" width="6" height="6" alt=""></td>
<td background="http://img.constantcontact.com/ui/images/visitor/bevel_bg_bottom_yw.gif"> </td>
<td><img src="http://img.constantcontact.com/ui/images/visitor/bevel_br_yw.gif" width="6" height="6" alt=""></td>
</tr>
</table>
</div>
<!-- END: Constant Contact Standard Email List Button -->
<!-- Begin 8 week  calendar -->
<?php
// calculate the  begin date
Global $dateptr, $Timestamp, $TimestampEnd, $currentTimeStamp, $firstDayPrinted, $Month, $daytoday,$thisMon;
$Month = date("m");
$Year = date("Y");
$daytoday = date("d");
$Timestamp = mktime(0,0,0,$Month,$daytoday ,substr($Year,04));
$DayStart= date("w",$Timestamp);
$TimestampEnd =  mktime(0,0,0,$Month,$daytoday +30,substr($Year,04));
$Monthname = date("M",$Timestamp);
$Monthname2 = date("M",$TimestampEnd);
$dayend = date("d",$TimestampEnd);
$year_print = substr($Year,0,4);
$LastDay = date("d",mktime(0,0,0,$Month,$daytoday + 30,substr($Year,0,4)));
$dayptr=0;
$MonthStart = date ("w", $Timestamp);

// Make a table with the proper month
print ("<Table  Border WIDTH =\"40%\" ALIGN=CENTER>");


print_month_heading($Monthname,$year_print);
$Monthname_hold = $Monthname;

	
print("<h3>8 Week Calendar (scroll down to see current events)</h3>");
print("<TR BGCOLOR=White>");
$firstDayPrinted=False;
$StartDate = $DayStart-1;
$dateptr=0;
   for ($k =0; $k <= 7; $k++ ) {
    print("<TR BGCOLOR=White>");
    for ($i=0; $i <= 6; $i++) {
          if ($firstDayPrinted){$dateptr=$dateptr+1;}
		  $currentTimeStamp = mktime(0,0,0,$Month,$daytoday + $dateptr, substr($year,"04"));
		  $thisDow =date("w",$currentTimeStamp);
		  $thisMon = date("m",$currentTimeStamp);
		  $thisDom = date("d",$currentTimeStamp);
		  $thisMonthName= date("M",$currentTimeStamp);
		//  print("<p> dateptr is $dateptr thisdow = $thisDow thisDom = $thisDom i= $i k=$k $thisMonthName hold=$Monthname_hold </p>");
		  if ($thisMonthName != $Monthname_hold){
		  	print_month_heading($thisMonthName,$year_print);
			$Monthname_hold = $thisMonthName;
			print("<TR BGCOLOR=White>");
			for($z=0;$z<$thisDow;$z++){
				print("<td BGCOLOR=GREEN>&nbsp</TD>");
				}
		  }
		      
		 if ($dateptr == 0  && $i < $thisDow){
		 		  print("<td BGCOLOR=GREEN>&nbsp</TD>");
		 
		 }else{
		 		
		       $this_date = $Year  . "-" .  $thisMon  . "-" . $thisDom;
				
                  
               if ( !$affil ){
               print("<td ALIGN=LEFT VALIGN=TOP ><A HREF=\"/calday.php?DayQ=$this_date\">$thisDom</a></td>");
               }else{
                 print("<td ALIGN=LEFT VALIGN=TOP ><A HREF=\"/calday.php?DayQ=$this_date&affil=$affil\">$thisDom</a></td>");
            }
		     $firstDayPrinted=True;    
            } // end of not first time         
                        
            
			  
          
          } // end of one week $k< 7
    print ("</TR>\n");
   
   }// end of outer loop
print ("</table>\n");

print("<h3>Click on the day number to see the detail for that day</h3>");


$dbbegin= $Year . "-". $Month . "-" . $daytoday;

$yrend = date("Y",$TimestampEnd);
$dbend =  $yrend .  "-" . date("m",$TimestampEnd) . "-" . date("d",$TimestampEnd) ;

          
        if ( !$affil ){
        $sql = "SELECT T1.*, T2.Short_name FROM events as T1,
                orgs as T2 
        WHERE
             T1.Event_org = T2.Org_num
            && ( T1.Date_from >= \"$dbbegin\" )
            && T1.Date_from <= \"$dbend\"
            && T1.Event_open != \"N\"    
            order by Date_from  ";
     }else{
        $sql = "SELECT T1.*, T2.Short_name FROM events as T1,
                orgs as T2 
        WHERE
             T1.Event_org = T2.Org_num
            && T2.affil = \"$affil\"
            && ( T1.Date_from >= \"$dbbegin\" )
            && T1.Date_from <= \"$dbend\"
            && T1.Event_open != \"N\"    
            order by Date_from  ";
        }
      //  print("<br>$sql");
        // request items from the events table
           $result = @mysql_query($sql);
           if (!$result) {
                    echo("<p>Error performing query Email this information to webmaster@graynwhite.com" . mysql_error() . "</p> ");
      
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
           }// end of load event array

  $howmany =count($array_date);
//  print("<p>There are $howmany  events to display.</p>");

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
               print("<td ALIGN=LEFT VALIGN=TOP ><A HREF=\"/calday.php?DayQ=$this_date\">$StartDate</a>");
               }else{
                 print("<td ALIGN=LEFT VALIGN=TOP ><A HREF=\"/calday.php?DayQ=$this_date&affil=$affil\">$StartDate</a>");
            }
                     
                        for($l=0;$l<count($array_date);$l++) {
                           if ($this_date == $array_date[$l]) {
                            print("<br><small>$array_insert[$l]</small>");
                            } 
                        }
             //     for each row
             print("</td>");     
          } // end of one day
          } // end of one week $k< 7
    print ("</TR>\n");
   
}//
print ("</table>\n");



?>
<!-- End 60 day calendar -->

<?php 
   
	//connect to the database server
        //    include("../cgi-bin//connect.inc");

        $sql = "SELECT T1.*, T2.Org_name, T2.Org_url, T2.Org_link_text FROM events as T1,
                orgs as T2 
        WHERE
             ( T1.Event_org = T2.Org_num
            && ( T1.Resby < (DATE_ADD(CURRENT_DATE(),INTERVAL T1.Event_priority day)))
            && T1.Date_from >= Current_date()
            && T1.Event_open != \"N\") or
            ( T1.Event_org = T2.Org_num
            && ( T1.Resby < (DATE_ADD(CURRENT_DATE(),INTERVAL T1.Event_priority day)))
            && T1.Event_open = \"X\") 
            order by Date_from, Time_start  ";
     
        // request items from the events table
           $result = @mysql_query($sql);
           if (!$result) {
                    echo("<p>error performing query" . mysql_error() . "</p> ");
      
            exit();
                       }
           $sql_announce="Select * from announce where pub_date >= \"$today\" and exp_date >= \"$today\"
            and pertains_to = \"All\" ";


 			$result_announce = @mysql_query($sql_announce);

 			if (!$result_announce){
	print("<p> Announce query not run " . mysql_error() . "</p>");
	exit;
	}
	 # echo("<p> " . $sql_announce . "</p>");

             
      
?>
<?php 
    $row_announce=mysql_fetch_array($result_announce);
    if (mysql_num_rows($result_announce) > 0){
	echo("<p><center> <a href='../announce.php'><strong>Click here for announcements</strong></center></a></p>");
	} ?>

 
 <h3>Current Events:</h3>

<CENTER><I>Events in italics need advance registration or require advance notice.</I></CENTER>
<CENTER>Events in red have past their advance registration date. Check with the sponsoring organization for availability.</CENTER>
<TABLE BORDER WIDTH="100%" >
<TR VALIGN=BOTTOM>
<TH ALIGN=CENTER><B>ORG.</B></TH>
<TH ALIGN=CENTER><B>Date</B></TH>



<TH ALIGN=CENTER><B>Time</B></TH>

<TH ALIGN=LEFT><B>Place</B></TH>

<TH ALIGN=LEFT><B>Event</B></TH>

<TH ALIGN=CENTER><B>Price Members</B></TH>

<TH ALIGN=CENTER><B>Price Guests</B></TH>
<?

    // display lines
           while ($row = mysql_fetch_array($result)){
           $tbegin = "<TD>";
           $tend = "</TD>";

           if(($row["Resby"] < $this_very_day) and ($row["Event_open"] != "X")) {
                 $tbegin = $tbegin . "<Font color=RED>";
                 $tend = "</FONT>" . $tend ;
                 }
           if($row["Date_from"] > $one_week_from_now) {
                 $tbegin = $tbegin . "<i>";
                 $tend = "</i>" . $tend;
                 } 
            
           echo("<TR> $tbegin" . $row["Org_name"]  . "$tend");
           $fd=$row["Date_from"];
           $td=$row["Date_to"];
           $rd=$row["Resby"];
           $ds=parse_date($fd,$td,$rd);
           echo("$tbegin $ds $tend");
           


           echo("$tbegin" . $row["Time_start"]);
           if ($row["Time_end"]){
               echo("<br> to " . $row["Time_end"]);
               }
           echo("$tend\n");
           echo("$tbegin" . $row["Place"] ."$tend\n");
           echo("$tbegin" . $row["Activity"]);
       //  if ($row["Org_url"] < " " ) {
               echo("<br><a href='" . $row["Org_url"] ."'>". $row["Org_link_text"] .".</a>");
       //    }
           echo("$tend\n");
           echo("$tbegin" . $row["Price_members"] . "$tend\n");
            echo("$tbegin" . $row["Price_guests"] . "$tend\n");

           echo("</tr>\n");
           } // end of while  
 ?>
</table>
</font><font face="ARIAL, HELVETICA"><font color="#FF0000"><a href="http://click.linksynergy.com/fs-bin/stat?id=9aLN0L76PuM&offerid=9854.47&type=4&subid=0"><img border=0 alt="Lugg Tab 468x60" src="http://affiliate.landsend.com/banners/lugTab_D.gif" width="468" height="60"></a></font></font><FONT COLOR="#FF0000"><IMG border=0 width=1 height=1 alt=banner src="http://ad.linksynergy.com/fs-bin/show?id=9aLN0L76PuM&bids=9854.47&type=4&subid=0">
<CENTER>
  <FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000"><A HREF="event_mail.php">If you would like to enter information about some event or you would like to change information about an event click here</A></FONT></FONT>
</CENTER>
<CENTER>
  <B><FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000">Use the
  back function to return to Home Page</FONT></FONT></B>
</CENTER>


<CENTER>
  <FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000">to this web
  site</FONT></FONT>
</CENTER>


</BODY>
</HTML>
