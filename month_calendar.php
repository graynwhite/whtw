<?php
/** @package 

        month_calendar
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 2/12/2005 1:36:45 PM
	Last change: FJC 2/12/2005 1:55:57 PM
*/
?>
<?php
 include("../cgi-bin//connect.inc");
  include("../cgi-bin//parse.inc");
 $month_end = "2005-04_01";
 $month_begin = "2005-03-01";
 $sql = "SELECT T1.*, T2.Org_name, T2.Org_url, T2.Org_link_text FROM events as T1,
                orgs as T2 
        WHERE
             ( T1.Event_org = T2.Org_num
            &&  T1.Resby < \"$month_end\"
            && T1.Date_from >= \"$month_begin\"
            && T1.Event_open != \"N\") or

            ( T1.Event_org = T2.Org_num
            && T1.Resby < \"$month_end\"
            && T1.Event_open = \"X\") 
            order by Date_from, Time_start  ";
     
        // request items from the events table
           $result = @mysql_query($sql);
           if (!$result) {
                    echo("<p>error performing query" . mysql_error() . "</p> ");
                    exit;
                }

?>
 <FONT COLOR="#FF0000"><FONT SIZE=+2>CurrentEvents:</FONT>
<p>
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
<a href="http://click.linksynergy.com/fs-bin/stat?id=9aLN0L76PuM&offerid=9854.47&type=4&subid=0">
<IMG border=0 alt="Lugg Tab 468x60" src="http://affiliate.landsend.com/banners/lugTab_D.gif" width="468" height="60"></a><IMG border=0 width=1 height=1 alt=banner src="http://ad.linksynergy.com/fs-bin/show?id=9aLN0L76PuM&bids=9854.47&type=4&subid=0">
<CENTER><FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000"><A HREF="event_mail.php">If you would like to enter information about some event or you would like to change information about an event click here</A></FONT></FONT></CENTER>

<CENTER><B><FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000">Use the
back function to return to Home Page</FONT></FONT></B></CENTER>
<CENTER><Font COLOR="#FF0000">Click on the organization names below to reach their home pages.</FONT></CENTER>
<CENTER><A HREF="http://www.graynwhite.com/ss/"> Sailing Singles</A></CENTER>
<CENTER><A HREF="http://www.graynwhite.com/sg/">Somerset Singles Ski & Golf Club</A></CENTER>
<CENTER><A HREF="http://www.gmskiclub.org">GM Ski Club</A></CENTER>
<CENTER><A HREF="http://www.skiwiskiclub.com">Skiwi Ski and Social Club</A></CENTER>

<CENTER><A HREF="http://www.a2skiclub.org/a2skiclub">Ann Arbor Ski Club</CENTER>
<CENTER><A HREF="http://www.tbirdskiclub.com">Ford Thunderbird Ski Club</CENTER>
<CENTER><A HREF="http://www.msda.org">Michigan Swing Dance Association</CENTER>
<CENTER>
<a href="http://click.linksynergy.com/fs-bin/stat?id=9aLN0L76PuM&offerid=7660&type=3&subid=0">Click here for Free Stuff</a>
<IMG border=0 width=1 height=1 src="http://ad.linksynergy.com/fs-bin/show?id=9aLN0L76PuM&bids=7660&type=3&subid=0">
</CENTER>

<CENTER><FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000">You are vistor</FONT></FONT></CENTER>


<CENTER>
<p></p>
</CENTER>

<CENTER><FONT FACE="ARIAL, HELVETICA"><FONT COLOR="#FF0000">to this web
site</FONT></FONT></CENTER>

</font></font>
<p align="center">
<!--webbot bot="HitCounter" u-custom i-image="0" i-resetvalue="0" PREVIEW="&lt;strong&gt;[Hit Counter]&lt;/strong&gt;" i-digits="4" startspan --><img src="../cgi-bin/_vti_bin/fpcount.exec?page=whtw/month_calendar.php|Image=0|Digits=4" alt="Hit Counter"><!--webbot bot="HitCounter" i-checksum="14556" endspan --></p>

</h1>

</h1>

</h1>

</BODY>
</HTML>   
