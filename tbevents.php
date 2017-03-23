<?PHP
 
  include("../cgi-bin/logact.inc");
  include("../cgi-bin/parse.inc");
 
?>
<HTML>
<HEAD>
   <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
   <META NAME="Frank J. Cauley" CONTENT="Current Events">
   <meta name="keywords" content="Christian, Catholic, Bethany, Anulment,starting over, divorce, dance,family">

   <TITLE>Thunderbird Ski Club Events</TITLE>
   
   
   <style type="text/css">
<!--
tr.odd {
	background-color: #FFFFFF;
}
tr.even {
	background-color: #FFFF80;
}
.style1 {color: #0000FF}
body {
	background-color: #6599FF;
}
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
}
.style3 {color: #FF0000}
-->
   </style>
<center>   
<script type="text/javascript"><!--
google_ad_client = "pub-4877966866498226";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "image";
google_ad_channel = "tbevents";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>

</div>   
</HEAD>
<BODY TEXT="#000000" LINK="#0000EE" VLINK="#551A8B" ALINK="#FF0000">
<div align="center"><img src="http://www.peggyjostudio.net/E/tbirdLogo.jpg" width="300"  align="middle">&nbsp;
</div>
<H1 align="center">
<FONT FACE="ARIAL,HELVETICA"><FONT COLOR="#FF0000">Thunderbirds Ski Club</FONT></FONT></H1>
<P><A HREF="http://www.graypluswhite.com/whtw/whevents.php">Click here to find out what's happening this week</A>

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


<p>updated

  <?php

  echo( date(" F dS Y.") );

?>
</p>
<?php 
            
       //update_counter("ss/ssevents.htm.cnt");
       include("../cgi-bin/../cgi-bin/connect.inc");

        // request items from the events table
			$mysql_query = "Select * from events ";
			$mysql_query .= " where Event_org = \"tbird\" ";
			$mysql_query .= " and Date_from >= CURRENT_DATE() and needsReview = 0 "; 
            $mysql_query .= " ORDER BY DATE_from, Time_start  ";
			
			$result = mysql_query($mysql_query);
           if (!$result)
		   { 
                echo("<p>Error performing query Email this information to cauleyfrank@gmail.com" . mysql_error() . $mysql_query . "</p> ");
      
            exit();
                       }
            $sql_announce="Select * from announce where pub_date >= \"$today\" and exp_date <= \"$today\"
           and (pertains_to like \"%sail%\" or pertains_to like \"%fs%\") ";

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
	echo("<p><center> <a href='../announce.php'><strong>Click here for announcements</strong></center>
        </a></p>");
	} ?>



<TABLE BORDER WIDTH="100%" >
<TR VALIGN=BOTTOM>
<TH ALIGN=CENTER><B>Date</B></TH>



<TH ALIGN=CENTER><B>Time</B></TH>

<TH ALIGN=LEFT><B>Place</B></TH>

<TH ALIGN=LEFT><B>Event</B></TH>

<TH ALIGN=CENTER><B>Price Members</B></TH>

<TH ALIGN=CENTER><B>Price Guests</B></TH>
</TR>
<?
    // display lines
           while ($row = mysql_fetch_array($result)){
		   $even_odd =( "odd" != $even_odd) ? "odd" : "even";
           if ( $row["Event_org"]=="drya" || $row["Event_org"] =="abya"){
            $color="<font color=\"Blue\">";
        }else{
            $color="<font color=\"Black\">";
        }

           $fd=$row["Date_from"];
           $td=$row["Date_to"];
           $rd=$row["Resby"];
           $ds=parse_date($fd,$td,$rd);
           echo("<tr Class=\"$even_odd\"><td> $color $ds </font></td>");

          
           
           echo("<TD> $color" . $row["Time_start"]);
           if ($row["Time_end"]){
               echo("<br> to " . $row["Time_end"]);
               }
           echo("</font></td>\n");
           echo("<td> $color" . $row["Place"] ."</font></td>\n");
           echo("<td>$color" . "Title: " . $row['Event_title'] . "<br><br>" . $row["Activity"] . "</font></td>\n");
           echo("<td>$color" . $row["Price_members"] . "</font></td>\n");
            echo("<td>$color" . $row["Price_guests"] . "</font></td>\n");

           echo("</tr>\n");
           } // end of while  
 ?>

</TABLE>
<FONT COLOR="#FF0000"><B>
</B></FONT></FONT>
<script type="text/javascript"><!--
google_ad_client = "pub-4877966866498226";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "text";
google_ad_channel ="tbirdevents";
//--></script>
<div align=center>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<CENTER><FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000"><A HREF="mailto:cauleyfrank@gmail.com">or
request information via E-Mail</A></FONT></FONT></CENTER>

<CENTER>
</CENTER>

<CENTER>
</CENTER>


<CENTER><A HREF="http://www.graypluswhite.com/whtw/whevents.php"><FONT SIZE="+2"><B><I>Click here to find out what's happening this week.</I></B></FONT></A></CENTER>
<CENTER>
</CENTER>

<CENTER></CENTER>

</BODY>
</HTML>