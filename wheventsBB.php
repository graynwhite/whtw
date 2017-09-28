<meta name="keywords" content="Sailing,Skiing,Dancing,clubs,Golf,music,dateing,jazz, classical music, variety music,charity,southeatern Michigan">
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
 include("../cgi-bin/connect.inc");
 include("../cgi-bin/update_counter.inc");
 include("../cgi-bin/logact.inc");
 include("../cgi-bin/parse.inc");
 include("../phpauction/includes/dates.inc.php");
 include("whtw_banners_inc.php");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>What's happening this week</title>
<META NAME="resource-type" CONTENT="document">
<meta name="keywords" content="clubs, singles, dance, sail, sailing, ski, skiing, travel, jazz, dixieland, symphony, golf, events, cultural, theater, music, health, PWP, Art, festivals, band, Bethany">



<style type="text/css">
<!--
body {
	background-image: url(newwhathappening.gif);
}
linkToOrgs {
	background-color: #FFFF00;
}
-->
</style>
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
	background-color: #6B7973;
	background-image: url(newwhathappening.gif);
	background-repeat: no-repeat;
}
.style1 {
	font-size: 18px;
	font-weight: bold;
}
.style2 {color: #FFFF00}
.style3 {
	color: #FFFF00;
	font-weight: bold;
}
a:link {
	color: #FF0000;
}
a:visited {
	color: #FF00FF;
}
a:hover {
	color: #999999;
}
a:active {
	color: #FF00FF;
}
#googleadsense {
top:0;
}
-->
</style>
</head>
<body>

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

</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;  </p>
<div align=center id=googleadsense>
  <p>
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

</div>
<div align="center">
  <p>
    <!-- BEGIN: Constant Contact HTML for Send Page to Friend  -->
    <A HREF="http://ui.constantcontact.com/sa/fp.jsp?plat=i&p=f&m=osf4rwn6" class="style1"></A>
    <!-- END: Constant Contact HTML for Send Page to Friend  -->
</p>
  <p>&nbsp;  </p>
</div>


<table width="100%" border="0">
  <tr align="center" valign="top">
    <td width="25%" height="10"><div align="center"><a href="event_mail.php"><img src="img/addbtn.gif" width="100" height="30"></a></div></td>
    <td width="25%" ><a href="../TripsAndCruises.php"><img src="clubTripBtn.png" alt="Club Trips and Cruises" width="100" height="30" border="0"></a></td>
    <td width="25%" height="10" ><a href="calendar.php"><img src="img/ftrbtn.gif" width="100" height="30"></a></td>
    <td width="25%" height="10">
         <A HREF="http://ui.constantcontact.com/sa/fp.jsp?plat=i&p=f&m=osf4rwn6">
  <img src="img/sendFriend.gif"width="100" height="30"></A>  </td>
    <td width="25%" height="10"><a href="http://ui.constantcontact.com/d.jsp?m=1011148101198&p=oi" "><img src="img/joinEmail.gif" width="100" height="30"></a></td>
  </tr>
</table>
  <CENTER> 
    <span class="style2">
 
 
 updated
    
    <?php

  echo( date(" F dS Y.") );  
           
       //update_counter("../_private/whtw/whevents.htm.cnt");
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
    </span>
</center>
 </CENTER>

<?php 
   
	

        $query = "SELECT T1.*, T2.Org_name, T2.Org_url, T2.Org_link_text, T2.publish_whtw FROM events as T1,
                orgs as T2 
        WHERE
             ( T1.Event_org = T2.Org_num && T2.publish_whtw = 'T'
            && ( T1.Resby < (DATE_ADD(CURRENT_DATE(),INTERVAL T1.Event_priority day)))
            && T1.Date_from >= Current_date()
            && T1.Event_open != \"N\") or
            ( T1.Event_org = T2.Org_num
            && ( T1.Resby < (DATE_ADD(CURRENT_DATE(),INTERVAL T1.Event_priority day)))
            && T1.Event_open = \"X\") 
			
            order by Date_from, Time_start  ";
     
        // request items from the events table
           $result = $db->query($query);
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

<CENTER>
    <div align="center"><span class="style2"><font face="ARIAL, HELVETICA"><I>Events in italics need advance registration or require advance notice.</I></font> <br>
      
        </span>
      <table border =4  width="950" align="center" >
        <tr valign=BOTTOM>
          <th width="99" height="47" align=CENTER valign="middle" ><div align="center" class="style2"><font face="ARIAL, HELVETICA"><b>Organization</b></font></div></th>
          <th width="68" align=CENTER valign="middle" ><div align="center" class="style2"><font face="ARIAL, HELVETICA"><b>Date</b></font></div></th>
          <th width="47" align=CENTER valign="middle" ><div align="center" class="style2"><font face="ARIAL, HELVETICA"><b>Time</b></font></div></th>
          <th width="268" align=CENTER valign="middle" ><div align="center" class="style2"><font face="ARIAL, HELVETICA"><b>Place</b></font></div></th>
          <th width="337" align=CENTER valign="middle" ><div align="center" class="style2"><font face="ARIAL, HELVETICA"><b>Event</b></font></div></th>
          <th width="66" align=CENTER valign="middle" ><div align="center" class="style3"><font face="ARIAL, HELVETICA">Price Members</font></div></th>
          <th width="63" align=CENTER valign="middle" ><div align="center" class="style2"><font face="ARIAL, HELVETICA"><b>Price Guests</b></font></div></th>
          <?

    // display lines
           while ($row = $result->fetch(PDO::FETCH_ASSOC)){
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
<span class="style2"><font face="ARIAL, HELVETICA">Events in red have past their advance registration date. Check with the sponsoring organization foravailability.</font></span>    </div>
<FONT FACE="ARIAL, HELVETICA"><span class="style2"><A HREF="../event_mail.php">If you would like to enter information about some event or you would like to change information about an event click here</A></span></FONT>

<span class="style2">
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
<p><span class="style2"><B><FONT FACE="ARIAL, HELVETICA">Use the
      back function to return to Home Page</FONT></B>
      
    Click on the organization names below to reach their home pages</span></p>
<table width="100%" border="0" style="background-color:yellow;/>
  <tr>
   <td width="25%"></td>
    
    <td width="25%"><div align="center"><a href="http://www.graypluswhite.com/ss/">Sailing Singles</a></div></td>
	  <td width="25%"><div align="center"><a href="http://www.graypluswhite.com/sg/index.php">Somerset Singles Ski & Golf</a></div></td>
	  <td width="25%"><div align="center"><a href="http://www.gmskiclub.org"">GM Ski club </a></div></td>
	  <td width="25%"><div align="center"><a href="http://www.skiwiskiclub.com">Skiwi Ski and Social Club </a></div></td>
    </tr>
  <tr>
    <td><div align="center"><a href="http://www.graypluswhite.com/bethany/bethevents.php">Bethany</a></div></td>
    <td><div align="center"><a href="http://www.a2skiclub.org/">Ann Arbor Ski Club</a></div></td>
    <td><div align="center"><a href="http://www.tbirdskiclub.com"> Thunderbird Ski Club</a></div></td>
    <td><div align="center"><a href="http://www.msda.org">Michigan Swing Dance Association</a></div></td>
  </tr>
  <tr>
    <td><div align="center"><a href="http://click.linksynergy.com/fs-bin/stat?id=9aLN0L76PuM&offerid=7660&type=3&subid=0">Click here for Free Stuff</a></div></td>
    <td><div align="center"><a href="http://www.peggyjostudio.net/archivenews.php">Peggy Jo Studio Newsletter</a> </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center"><Font COLOR="#FF0000">.</FONT><br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
      <a href="http://click.linksynergy.com/fs-bin/stat?id=9aLN0L76PuM&offerid=7660&type=3&subid=0"></a>
      <IMG border=0 width=1 height=1 src="http://ad.linksynergy.com/fs-bin/show?id=9aLN0L76PuM&bids=7660&type=3&subid=0">
<p>
    <CENTER>
      <!--webbot bot="HitCounter" i-checksum="56795" endspan -->
    </CENTER>
</body>
</html>
