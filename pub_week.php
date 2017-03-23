<?php
/** @package 

        pub_week
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 6/9/2005 4:59:02 PM
	Last change: FJC 8/9/2005 12:29:20 PM
*/
include_once("../cgi-bin//connect.inc");

function truncate_pubevents(){
    $sql_truncate = "truncate table pubevents";
    $result_truncate = @mysql_query($sql_truncate);
    if ( !$result_truncate ){
        print("<p> $sql_truncate" . mysql_error());
        exit;
        }
    }
function insert_item($title,$pub_activity,$pub_event_date){
    $pub_activity = htmlentities($pub_activity);
    $title=htmlentities($title);
    $insert_sql = "insert into pubevents
    set  event_date = \"$pub_event_date\",
                        activity = \"$pub_activity\",
                        title = \"$title\" ";

    $insert_result= @mysql_query($insert_sql);
    if ( !$insert_result ){
        print("<p> $insert_sql" . mysql_error());
        exit;
        }
    }
$PageTitle ="What's Happening This Week Calendar";
if ( $affil =="arch" ){
$PageTitle ="Archdiocese of Detroit Singles Calendar";
}
 include_once('php_select_year.php');

require("../cgi-bin/header.php");
$Month = date("m");
$Day= date("d");
$Year = date("Y");
$month_array=array('01' => 'January','02'=> 'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');

//$Timestamp = mktime(0,0,0,$Month,$Day,$Year);
$Monthname = date("F",$Timestamp);
for ($i=0;$i<7;$i++)
{
    $this_day = date("D",$Timestamp);
   // echo"$this_day" ;
    $Timestamp = mktime(0,0,0,$Month,$Day+$i,$Year);
    if ( $this_day == "Sun" ){
        break;
    }
}
$Month = date("m",$Timestamp);
$Day= date("d",$Timestamp);
$Year = date("Y",$Timestamp);
    $datebegin =$Year . "-" . $Month . "-" . $Day;
    $LastDay = mktime(0,0,0,$Month,$Day+8,$Year);
$Month = date("m",$LastDay);
$Day= date("d",$LastDay);
$Year = date("Y",$LastDay);
$dateend =$Year . "-" . $Month . "-" . $Day;
// print ("<p> from $datebegin to $dateend </P>");
//connect to the database server
            include("../cgi-bin/connect.inc");
     $sql = "SELECT T1.*, T2.Org_name FROM events as T1,
                orgs as T2 
        WHERE
             T1.Event_org = T2.Org_num
            && ( T1.Resby >= \"$datebegin\" )
            && T1.Resby <= \"$dateend\"
            && T1.Event_open != \"N\"    
            order by Resby  ";
             $result = @mysql_query($sql);
  if (!$result) {
                    echo("<p>Error performing query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p> ");
                    echo("<p> $sql </p>");
            exit();
           }
  if ( mysql_num_rows($result) < 1 ){
     echo("<p> No rows found in query Email this information to cauleyfrank@gmail.com </p> ");
                    echo("<p> $sql </p>");
            exit();
           }
  truncate_pubevents();
  While ($row=mysql_fetch_array($result))
    {
    $event_org_name = $row['Org_name'];
    $date_array =split("-",$row['Date_from']);
    $month_ptr = $date_array[1];
   
    $event_month = $month_array[$month_ptr];
    $title = $event_org_name .  " ". $row['Dow'] . " ". $event_month  ." ".$date_array[2];
    $pub_activity = $row['Activity'] ;
	if (strlen($row['Time_end']) < 1){
	$pub_activity .= " starts at " . $row['Time_start'] ;
	} else{
	$pub_activity .=   "From  " .  $row['Time_start'] ." to " . $row['Time_end'];
	}
	if ($row['Price_members'] == $row['Price_guests']){
	$pub_activity .= " Price " . $row['Price_members'] ;
	} else {
    $pub_activity .= " Member price " . $row['Price_members'] ." Guest Price  " . $row['Price_guests'];
	}
	if ($row['Resby'] != $row['Date_from'] ) {
    $pub_activity .= "Reserve by " .$row['Resby'];
	}
    $pub_event_date = $row['Resby'];
    print("<p align=\"center\"><b> " . $event_org_name . " ". $row['Dow'] . " ". $event_month  ." ".$date_array[2]. "</b></p>");
    print("<p align=\"left\"> " . $pub_activity . "&lt;br /&gt;&lt;br /&gt;</p>");
    print("<p align=\"left\">  &lt;b&gt; Location: &lt;/b&gt;" . $row['Place'] ."</p>");
   
	print("<p align=\"left\"> media data is " . $row['media'] . "</p>");
   
   
    insert_item($title,$pub_activity,$pub_event_date);
}



require("../footer.php");

?>

