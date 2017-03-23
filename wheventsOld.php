<?PHP

/** @package 

        whevents.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 8/22/2003 12:01:56 AM
	Last change: FJC 7/24/2005 2:14:27 PM
*/ 
DEFINE ("INCLUDED", "yes");
//connect to the database server
 include("../cgi-bin//connect.inc");
 include("../cgi-bin//update_counter.inc");
 include("../cgi-bin//logact.inc");
 include("../cgi-bin//parse.inc");
 include("../cgi-bin/phpauction/includes/dates.inc.php");
include("whtw_banners_inc.php");
view();
?>
<HTML>
<HEAD >
   <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
   <META NAME="Frank J. Cauley" CONTENT="Current Events">
   <TITLE>What's Happening This Week</TITLE>
<META NAME="resource-type" CONTENT="document">
<meta name="keywords" content="clubs, singles, dance, sail, sailing, ski, skiing, travel, jazz, dixieland, symphony, golf, events, cultural, theater, music, health, PWP, Art, festivals, band, Bethany">


<style type="text/css">
<!--
tr.odd {
	background-color: #00FFFF;
}
tr.even {
	background-color: #FFFFFF;
}
.page_heading {
	font-family: "Times New Roman", Times, serif;
	font-size: 32px;
	color: #FF0000;
	text-decoration:underline
}

body,td,th {
	font-size: 14px;
	color: #000000;
}
body {
	background-color: #00FFFF;
}
.style1 {
	font-size: 18px;
	font-weight: bold;
}

-->
</style>
<meta name="keywords" content="">
</HEAD>
<script type="text/javascript"><!--
google_ad_client = "pub-4877966866498226";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "image";
google_ad_channel = "whtwevents";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<script language=javascript type= type="text/javascript">
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

       var ezine = null;
	    ezine = getCookie('popupshowny');

          setCookie('popupshowny', 'true', '','');
          
                
          if (ezine == null){
                commentWindow=window.open('comment.htm', 'ezineWin',"scrollbars=yes");
                commentWindow.focus();
          }else{
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
<BODY LINK="#0000EE" VLINK="#551A8B"
ALINK="#FF0000"  onUnload="doPopup()">


<!--IMG GOES HERE-->

 
   
<meta name="keywords" content="skiing, dancing, sailing, golf, singles, bethany, PWP, theater, meetings, health, art, festivals, Michigan">
<div align="center" class="page_heading"><strong>What's Happening This Week </strong></div>
<div align="center">
  <!-- BEGIN: Constant Contact HTML for Send Page to Friend  -->
  <A HREF="http://ui.constantcontact.com/sa/fp.jsp?plat=i&p=f&m=osf4rwn6" class="style1">Send Page To a Friend</A>
  <!-- END: Constant Contact HTML for Send Page to Friend  -->
</div>
<p align="center"><A HREF="calendar.php">
<IMG SRC="../cgi-bin/whtw/ftrbtn.gif" width="100" height="30">
<A HREF="event_mail.php"><image SRC="../whtw/addbtn.gif" width="100" height="30">
</p>
<CENTER>
  <CENTER> 
    updated
    
    <?php

  echo( date(" F dS Y.") );  
           
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
      
?>
  </center>
  <!-- BEGIN: Constant Contact Standard Email List Button -->
</CENTER>
<div align="center">
<table border="0" cellpadding="0" cellspacing="0" >
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

<?php 
   
	

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

 
<FONT COLOR="#FF0000"><FONT SIZE=+2>CurrentEvents:</FONT></font></font>
<p>
  <CENTER>
    <font color="#FF0000" face="ARIAL, HELVETICA"><I>Events in italics need advance registration or require advance notice.</I></font> <br>
	
    <font color="#FF0000" face="ARIAL, HELVETICA">Events in red have past their advance registration date. Check with the sponsoring organization for</font><font color="#FF0000" face="ARIAL, HELVETICA">availability.</font>
        
  
<table border =4  width="1000" align="center" >
 <tr valign=BOTTOM>
    <th width="99" height="47" align=CENTER valign="middle" ><div align="center"><font color="#FF0000" face="ARIAL, HELVETICA"><b>Organization</b></font></div></th>
	<th width="68" align=CENTER valign="middle" ><div align="center"><font color="#FF0000" face="ARIAL, HELVETICA"><b>Date</b></font></div></th>
	<th width="47" align=CENTER valign="middle" ><div align="center"><font color="#FF0000" face="ARIAL, HELVETICA"><b>Time</b></font></div></th>
    <th width="268" align=CENTER valign="middle" ><div align="center"><font color="#FF0000" face="ARIAL, HELVETICA"><b>Place</b></font></div></th>
	 <th width="337" align=CENTER valign="middle" ><div align="center"><font color="#FF0000" face="ARIAL, HELVETICA"><b>Event</b></font></div></th>
   <th width="66" align=CENTER valign="middle" ><div align="center"><font color="#FF0000" face="ARIAL, HELVETICA"><b>Price Members</b></font></div></th> 	
		
    <th width="63" align=CENTER valign="middle" ><div align="center"><font color="#FF0000" face="ARIAL, HELVETICA"><b>Price Guests</b></font></div></th>
<?

    // display lines
           while ($row = mysql_fetch_array($result)){
		   $even_odd = ('odd' != $even_odd) ? 'odd' : 'even';
		   $row_class="$even_odd";
		   
           $tbegin = "<TD >";
           $tend = "</TD>";

           if(($row["Resby"] < $this_very_day) and ($row["Event_open"] != "X")) {
                 $tbegin = $tbegin . "<Font color=RED>";
                 $tend = "</FONT>" . $tend ;
                 }
           if($row["Date_from"] > $one_week_from_now) {
                 $tbegin = $tbegin . "<i>";
                 $tend = "</i>" . $tend;
                 } 
          
           echo("<tr class=\"$row_class\" > $tbegin" . $row["Org_name"]  . "$tend");
           $fd=$row["Date_from"];
           $td=$row["Date_to"];
           $rd=$row["Resby"];
           $ds=parse_date($fd,$td,$rd);
           echo("$tbegin $ds $tend");
           

		   $time_start = $row["Time_start"];
		   if (strlen($time_start) < 1) {
		   		$time_start= "  -";
				}	
           echo("$tbegin" . $time_start );
           if ($row["Time_end"]){
               echo("<br> to " . $row["Time_end"]);
               }
			  
           echo("$tend\n");
		   $place=$row["Place"];
		   $activity=$row["Activity"];
		   $place= html_entity_decode($place,ENT_COMPAT);
		   $activity=html_entity_decode($activity,ENT_COMPAT);
           echo("$tbegin" . $place ."$tend\n");
           echo("$tbegin" . $activity );
       //  if ($row["Org_url"] < " " ) {
               echo("<br><a href='" . $row["Org_url"] ."'>". $row["Org_link_text"] .".</a>");
       //    }
	   	   $price_members = strlen($row['Price_members']) > 0 ? $row['Price_members'] :	"-";
		   $price_guests = strlen($row['Price_guests']) >0  ? $row['Price_guests'] :	"-";
           echo("$tend\n");
           echo("$tbegin" . $price_members . "$tend\n");
            echo("$tbegin" . $price_guests . "$tend\n");

           echo("</tr>\n");
		  
           } // end of while  
 ?>
</table>

  <FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000"><A HREF="event_mail.php">If you would like to enter information about some event or you would like to change information about an event click here</A></FONT></FONT>

<script type="text/javascript"><!--
google_ad_client = "pub-4877966866498226";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "text";
//2007-05-31: WhatIsHappening
google_ad_channel = "5573910896";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


  <div align="center">
    <p><B><FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000">Use the
      back function to return to Home Page</FONT></FONT></B>
      
    <Font COLOR="#FF0000">Click on the organization names below to reach their home pages</FONT></p>
    <p align="center"><Font COLOR="#FF0000">.</FONT>
      
      <A HREF="http://www.graypluswhite.com/ss/"> Sailing Singles</A><br>
      
      <A HREF="http://www.graypluswhite.com/sg/">Somerset Singles Ski &amp; Golf Club</A><br>
      
      <A HREF="http://www.gmskiclub.org">GM Ski Club</A><br>
      
      
  <A HREF="http://www.skiwiskiclub.com">Skiwi Ski and Social Club</A></br>
 <a href="http://www.graypluswhite.com/bethany/bethevents.php">Bethany</a><br>
     <A HREF="http://www.a2skiclub.org/a2skiclub">Ann Arbor Ski Club</A><br>
	     <A HREF="http://www.tbirdskiclub.com">Ford Thunderbird Ski Club</A><br>
  <A HREF="http://www.msda.org">Michigan Swing Dance Association</A><br>    
    <a href="http://www.graypluswhite.com/bethany/bethevents.php">Bethany</a><br>
      <a href="http://click.linksynergy.com/fs-bin/stat?id=9aLN0L76PuM&offerid=7660&type=3&subid=0">Click here for Free Stuff</a>
      <IMG border=0 width=1 height=1 src="http://ad.linksynergy.com/fs-bin/show?id=9aLN0L76PuM&bids=7660&type=3&subid=0">
  <p>
    <CENTER>
      <FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000">You are vistor</FONT></FONT>
  </CENTER>
<CENTER>
  <p></p>
</CENTER>
<CENTER>
  <FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000">to this web
  site</FONT></FONT>
</CENTER>
</font></font>
<p align="center">
<!--webbot bot="HitCounter" u-custom i-image="0" i-resetvalue="0" PREVIEW="&lt;strong&gt;[Hit Counter]&lt;/strong&gt;" i-digits="4" startspan --><img src="../_vti_bin/fpcount.exe/C:/graypluswhite/?Page=whtw/whevents.php|Image=0|Digits=4" alt="Hit Counter"><!--webbot bot="HitCounter" i-checksum="56795" endspan --></p>


</BODY>
</HTML>