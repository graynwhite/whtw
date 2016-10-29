<?php
/** @package

        calday.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 9/15/2003 3:53:29 PM
	Last change: FJC 9/15/2003 3:57:51 PM
*/
$DayQ=$_GET['DayQ'];
?>
<HTML>
<HEAD>
  <meta name="viewport" content="width=device-width; initial-scale=1; user-scalable=yes;">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	<title>Daily Calendar</title>
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
   <script src="http://www.graynwhite.com/gwanalytics.js"></script>
</HEAD>
<body>   
</div>
    <TITLE>What's Happening on This Day</TITLE>
   </HEAD>
   <body>
<?php 
	//connect to the database server
            include("../cgi-bin//connect.inc");
            $day_to_look_for = $DayQ;
        if ( !$affil ){
        $sql = "SELECT T1.*, T2.Org_name, T2.Org_url, T2.Org_link_text FROM events as T1,
                orgs as T2 
        WHERE
             T1.Event_org = T2.Org_num && T2.publish_whtw = 'T'
             && T1.Date_from = \"$day_to_look_for\"     
            order by Time_start  ";
        }else{
         $sql = "SELECT T1.*, T2.Org_name, T2.Org_url, T2.Org_link_text FROM events as T1,
                orgs as T2 
        WHERE
             T1.Event_org = T2.Org_num && T2.publish_whtw = 'T'
             && T2.affil = \"$affil\"
             && T1.Date_from = \"$day_to_look_for\"     
            order by Time_start  ";
        }
        // request items from the events table
           $result = @mysql_query($sql);
           if (!$result) {
                    echo("<p>Error performing query Email this information to webmaster@graynwhite.com" . mysql_error() . "</p> ");
      
            exit();
 }
 ?>
 
 <div id="main" data-role="page">
 <div id="header" data-role="header"><h1>Whats Happening on this day </h1></div>
 
 <div id="content" data-role="content">
 <p>Use the back button to return to the calendar. </p>
 <h2>Gray and White Computing Daily Calendar for <?php echo $DayQ ?> </h2>
 <FONT COLOR="#FF0000"><FONT SIZE=+2>CurrentEvents:</FONT>
<TABLE BORDER WIDTH="100%" >
<TR VALIGN=BOTTOM>
<TD ALIGN=CENTER width="5%"><B>ORG.</B></TD>
<TD ALIGN=CENTER width="5%"><B>Date</B></TD>
<TD ALIGN=LEFT width="25%"><B>Place</B></TD>
<TD ALIGN=LEFT width="25%"><B>Event</B></TD>

<?
    // display lines
           while ($row = mysql_fetch_array($result)){
           $tbegin = "<TD>";
           $tend = "</TD>";

           if($row["Resby"] < $this_very_day ) {
                 $tbegin = $tbegin . "<Font color=RED>";
                 $tend = "</FONT>" . $tend ;
                 }
           if($row["Date_from"] >$one_week_from_now) {
                 $tbegin = $tbegin . "<i>";
                 $tend = "</i>" . $tend;
                 } 
            
           echo("<TR>$tbegin" . $row["Org_name"]  . "$tend");
           echo("$tbegin" . $row["Date_from"] ."<br> to " . $row["Date_to"] .  "<br>");
           echo("Reserve by " . $row["Resby"] . "<br />");
           echo( $row["Dow"] . "<br />");
           echo($row["Time_start"]);
           if ($row["Time_end"]){
               echo("<br> to " . $row["Time_end"]);
               }
           echo("$tend  \n");
		   
         // $activity=$row["Activity"];
		// $activity=$row['media'];
		 // echo  "<br /> media length is" . strlen($row['media']);
		  $activity=strlen($row['media'])>5 ? $row['media'] : $row['Activity'];
		  
		  $place=$row["Place"];
		   $place= html_entity_decode($place,ENT_COMPAT);
		   $activity=html_entity_decode($activity,ENT_COMPAT);
           echo("$tbegin" . $place  . "$tend");
           echo("$tbegin" . $activity );
        // if ($row["Org_url"] > " " ) {
//         echo("<br><a href=\"" . $row["Org_url"] ."\">". $row["Org_link_text"] .".</a>");
//          }
			 
           echo("<br />");
		   $price_members = strlen($row['Price_members']) > 0 ? $row['Price_members'] :	"-";
		   $price_guests = strlen($row['Price_guests']) >0  ? $row['Price_guests'] :	"-";
           echo("<br /> Price members " .$price_members . "<br />");
            echo("Price guests " . $price_guests . "$tend\n");

           echo("</tr>\n"); 
           } // end of while  
 ?>
 </TR>
</table>


</div> <!-- end of content -->
<div id="footer" data-role="footer">
<h1>Use the back button to return to the Calendar</h1></div>
</div> <!-- end of page -->
</BODY>
</HTML>
