<?
DEFINE ("INCLUDED", "yes");
//connect to the database server
 include("../cgi-bin/connect.inc");
 include("../cgi-bin/parse.inc");
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
	  
	   $sql = "SELECT T1.*, T2.Org_name, T2.Org_url, T2.Org_link_text, T2.publish_whtw FROM events as T1,
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

     $row_announce=mysql_fetch_array($result_announce);
    if (mysql_num_rows($result_announce) > 0){
	echo("<p><center> <a href='../announce.php'><strong>Click here for announcements</strong></center></a></p>");
	}         
    
  
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link  href="../normalize/normalize.css" rel="stylesheet">
<link href=
"//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
 
<meta name="Keywords" content="Michigan,Royal Oak,web,"Adobe Creative Cloud", hosting, design,maintenance,PHP, MySql,Unified Modeling Language,newsletter editing, preparation" /> 
<link href="../gwbootstrap.css" rel="stylesheet"> 
<title>Responsive Whats Happening This week</title>
</head>
`
<body>
<div class="text-center"><h1>Whats Happening This week</h1>
<h2>In Southeastern Michigan</h2>

</div>
<div class="table table-responsive">
<table width="100%" border="0">
  <tr align="center" valign="top">
         <td width="25%" height="18"><div align="center"><a href="event_mail.php"><span class="label label-info">Add or change an event</span></a></div></td>
    <td width="25%" ><a href="../admin/TripsAndCruises.php"><span class="label label-info">Club Trips and Cruises</span></a></td>
    <td width="25%" height="10" ><a href="calendar.php"><span class="label label-info">Monthly Calendar</span></td>
    <td width="25%" height="10">
         <a href="http://pjnews.mobi">
      <span class="label label-info">Mobile Version</span></a></td>
  </tr>
</table>

<div class="text-center">
<p><span style="color:red; font-size:16px;">Events in red have past their advance registration date. Check with the sponsoring organization for availability.</span></p>
<p><span style="color:blue; font-size:16px">To get more information, on your smartphone, laptop or desktop, try the <a href="http://pjnews.mobi"><span class="label label-info">Mobile Version</span></a></p>
<p><span style="color:green; font-size:18px">Scroll right to see entire page</span></p>
</div>

<div class="table-responsive"> 
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><span style="col-xs-1">Organization</span></th>
                <th><span style="col-xs-1">Date</span></th>
                <th><span style="col-xs-1">Time</span></th>
                <th><span style="col-xs-4">Place</span></th>
                <th><span style="col-xs-4">Event</span></th>
                <th><span style="col-xs-1">Price</span></th>
                
            </tr>
        </thead>
        <tbody>
<?php
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
           echo("$tbegin");
		   if ($price_members != "-"){
			   if($price_guests != "-"){
				   echo "Members: " . $price_members . "<br />";
				   echo "Guests: " . $price_guests;
			   }else{
				   echo $price_members;
			   }
			   echo "$tend\n";
		   }
            

           echo("</tr>\n");
		  
           } // end of while 


?>        
            
            </tr>
        </tbody>
    </table>
</div>
 <div align="center">
<p><span class="style2"><B><FONT FACE="ARIAL, HELVETICA">Use the
      back function to return to Home Page</FONT></B>
      
    Click on the organization names below to reach their home pages</span></p>
<table width="100%" border="4" style="background-color:yellow;/>
  <tr>
   <td width="25%"></td>
    
    <td width="25%"><div align="center"><a href="http://www.graynwhite.com/ss/"></a>
      <div align="center"><a href="http://www.peggyjostudio.net/archivenews.php">Peggy Jo Studio Newsletter</a> </div>
    </div></td>
	  <td width="25%"><div align="center"><a href="http://sssgc.net">Somerset Singles Ski & Golf</a></div></td>
	  <td width="25%"><div align="center"><a href="http://www.gmskiclub.org"">GM Ski club </a></div></td>
	  <td width="25%"><div align="center"><a href="http://www.skiwiskiclub.com">Skiwi Ski and Social Club </a></div></td>
    </tr>
  <tr>
    <td><div align="center"><a href="http://www.graynwhite.com/bethany/bethevents.php">Bethany</a></div></td>
    <td><div align="center"><a href="http://www.a2skiclub.org/">Ann Arbor Ski Club</a></div></td>
    <td><div align="center"><a href="http://www.tbirdskiclub.com"> Thunderbird Ski Club</a></div></td>
    <td><div align="center"><a href="http://www.msda.org">Michigan Swing Dance Association</a></div></td>
  </tr>
  <tr>
    <td><div align="center"><a href="http://click.linksynergy.com/fs-bin/stat?id=9aLN0L76PuM&offerid=7660&type=3&subid=0">Click here for Free Stuff</a></div></td>
    <td><div align="center"><a href="http://www.successfullysingles.org">Successfully Singles</a></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


</body>
</html>