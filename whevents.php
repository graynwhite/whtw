<?

DEFINE ("INCLUDED", "yes");
//connect to the database server
// Require_once('../cgi-bin/pdoconnect.php');
include ("../cgi-bin/connect.inc");
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
     
        
		   // Step 3: Send the query
            $result = mysql_query($query);
           if (!$result) {
                    echo("<p>error performing query" . mysql_error() . "</p> ");
      
            exit();
                       }
           $query_announce="Select * from announce where pub_date >= \"$today\" and exp_date >= \"$today\"
            and pertains_to = \"All\" ";

			// Step 3: Send the query
				$result_announce = mysql_query($query_announce);
 			

 			if (!$result_announce){
	print("<p> Announce query not run " . mysql_error() . "</p>");
	exit;
	}
	 # echo("<p> " . $sql_announce . "</p>");
	// Step 4: Iterate over the results

     
    if (mysql_num_rows($result_announce) > 0){
		while($row_announce = $result_announce->fetch(PDO::FETCH_ASSOC))
	echo("<p><center> <a href='../announce.php'><strong>Click here for announcements</strong></center></a></p>");
	}         
    
  
?>

<!doctype html>

<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->

<head>
<meta charset="utf-8">
<meta name="description" content="Upcoming events for the next seven days in Southeastern Michigan ">
<meta name="keywords" content="dance,ski,golf,clubs,christian,jewish,single,couples">

<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Whats Happening This week!</title>
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="whtwfluid.css" rel="stylesheet" type="text/css">
<link href="../gwbootstrap.css" rel="stylesheet" type="text/css">
<link  href="../normalize/normalize.css" rel="stylesheet">
<link href=
"//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet"> 
<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="respond.min.js"></script>
<script src="http://www.graypluswhite.com/gwanalytics.js"></script>
</head>
<body>
  <div id="header" class="fluid"><h1 style="text-align:center">Whats Happening This Week</h1>
  <h2 style="text-align:center">In Southeastern Michigan</h2></div>
  
  <div class="table table-responsive">
<table width="100%" border="0">
  <tr align="center" valign="top">
         
    <td  ><a href="../admin/TripsAndCruises.php"><span class="label label-info">Club Trips and Cruises</span></a></td>
    <td  height="10" ><a href="calendar.php"><span class="label label-info">Monthly Calendar</span></td>
    <td  height="10">
         <a href="http://pjnews.mobi">
      <span class="label label-info">Mobile Version</span></a></td>
  </tr>
</table>

<div class="text-center">
<p><span style="color:red; font-size:16px;">Events with a red background have past their advance registration date. Check with the sponsoring organization for availability.</span></p>
<p><span style="color:blue; font-size:16px">To get more information, on your smartphone, laptop or desktop, try the <a href="http://pjnews.mobi"><span class="label label-info">Mobile Version</span></a></p>
<p><span  style="color:green; font-size:18px">You can now reach this page from your tablet or smartphone.</span></p>
</div>

  
  <hr />
  <div class="fluid even">
  <div class="fluid orgname">Organization</div>
  <div class="fluid col-date">Date &amp; Time</div>
  <div class="fluid col-place">Location</div>
  <div class="fluid col-event">Event</div>
  <div class="fluid col-price"></div>
  </div>
  <div class="clearfix"></div>
  
<?php
// Step 4: Iterate over the results
while($row = mysql_fetch_array($result))
 {
		   $even_odd = ('fluid odd' != $even_odd) ? 'fluid odd' : 'fluid even';
		   $row_class="$even_odd";
		   
                     if(($row["Resby"] < $this_very_day) and ($row["Event_open"] != "X")) {
				$even_odd= "fluid past";		 
                 
                 }
           if($row["Date_from"] > $one_week_from_now) {
                 $tbegin = $tbegin . "<i>";
                 $tend = "</i>" . $tend;
                 } 
          echo ("<div class='$even_odd'>");
           echo("<div class='fluid orgname'>" . $row["Org_name"]  . "</div>");
		   
           $fd=$row["Date_from"];
           $td=$row["Date_to"];
           $rd=$row["Resby"];
           $ds=parse_date($fd,$td,$rd);
           echo("<div class=\"fluid col-date\"> $ds <br />");
           

		   $time_start = $row["Time_start"];
		   if (strlen($time_start) < 1) {
		   		$time_start= "  -";
				}	
           echo( $time_start );
           if ($row["Time_end"]){
               echo("<br> to " . $row["Time_end"]);
               }
			echo "</div>";   
			  
           
		   $place=$row["Place"];
		   $activity=$row["Activity"];
		   $place= html_entity_decode($place,ENT_COMPAT);
		   $activity=html_entity_decode($activity,ENT_COMPAT);
           echo("<div class=\"fluid col-place\">" . $place ."</div>\n");
           echo("<div class=\"fluid col-event\">" . $activity );
           echo("<br><a href='" . $row["Org_url"] ."'>". $row["Org_link_text"] .".</a>");
     		
	   	   $price_members = strlen($row['Price_members']) > 0 ? $row['Price_members'] :	"-";
		   $price_guests = strlen($row['Price_guests']) >0  ? $row['Price_guests'] :	"-";
		   
           	   if ($price_members != "-"){
				   
			   if($price_guests != "-"){
				   echo "Members: " . $price_members . "<br />";
				   echo "Guests: " . $price_guests;
			   }else{
				   echo $price_members;
			   }
			   
			   
			   
		   }
		   echo "</div>";
		  echo "<div class=\"fluid col-price\"></div>";
		  echo "</div>"; // end of even-odd
		  echo "<div class=\"clearfix\"></div>";
		   
           
           } // end of while 


?>        
</div>
 <div align="center">
<p><span class="style2"><B><FONT FACE="ARIAL, HELVETICA">Use the
      back function to return to Home Page</FONT></B>
      
    Click on the organization names below to reach their home pages</span></p>
<table width="100%" border="4" style="background-color:yellow;/>
  <tr>
   <td width="25%"></td>
    
    <td width="25%"><div align="center"><a href="http://www.graypluswhite.com/ss/"></a>
      <div align="center"><a href="http://www.peggyjostudio.net/archivenews.php">Peggy Jo Studio Newsletter</a> </div>
    </div></td>
	  <td width="25%"><div align="center"><a href="http://sssgc.net">Somerset Singles Ski & Golf</a></div></td>
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
    <td><div align="center"><a href="http://www.successfullysingles.org">Successfully Singles</a></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<div id="footer" class="fluid"><span style="text-align:center">&copy; 2003-2014 Peggy Jo Studio Newsletter</span></div>
  
  <script>
document.location.href="http://pjnews.mobi/weeklyNewsletter.html";
</script>
</body>
</html>
