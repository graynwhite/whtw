<?php
/** @package 

        club_entry
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 10/22/2004 8:31:28 PM
	Last change: FJC 10/28/2004 11:21:31 PM
*/
?>
<?php
include_once('../cgi-bin/checkpassword.php');
$a= checkpassword($yourpswd);
function GetFormData(&$Method,&$FormVariables) {
  # Determine if the form used the post or get method and return in $Method
  # Return the form's variables as an associative array containing the
  # set of Name - Value pairs.

  global $HTTP_POST_VARS, $HTTP_GET_VARS; 
  # POST or GET method used when submitting the form?
  $Method = (isset($HTTP_POST_VARS)) ? "Post" : "Get";
  # Load the $FormVariables associative array from appropriate array
  $FormVariables = ($Method == "Post") ?
       $HTTP_POST_VARS : # Post Method Used
       $HTTP_GET_VARS;   # Get Method Used
} # End of function GetFormData
print("<br> action is $action" );
if ( $To_year == " " ){
    $event_end_date = $event_date;
}else{
    $event_end_date = $To_year . $To_mm . $To_day;
}
if ( $Reserve_year == "" ){
    $event_rsv_date=$event_date;
}else{
    $event_rsv_date = $Reserve_year . $Reserve_mm . $reserve_day;
}
$event_name= trim($activity);
if ( strlen($reference )> 0 ){
    $event_name .= " <a href=\"" . trim($reference) . "\">More info here</a>";
}

if ( $action=='Recurring' ){


    print("<br> week is" . $FormVariables['week']);
    $array_weeks = array();
   $array_weeks = $m;
  //   $array_weeks = array("one","two","three");
    foreach($array_weeks as $value){
    echo("<br>week is $value");
}

 //   $day_start = Mktime(0,0,0,left($gen_from_mm,2), $gen_from_day, left($gen_from_year,4)};
 //   $day_end = Mktime(0,0,0,$gen_to_mm, $gen_to_day, $gen_to_year);
    for ($julthis=$day_start; $julthis<$day_end; $julthis++)
    {
        $this_month = date($julthis,'m');
        $this_day = date($julthis,'d');
        $this_year = date($julthis,'Y');
        $this_day_of_week= date($julthis,'d');
        if ( $this_day == $dowr ){
            foreach ($array_weeks as $key => $week){
                if (
                   ( ($week == 'First') and ($this_day < 8 ))||
                   ( ($week == 'Second') and (($this_day > 7) and ($this_day < 15))) ||
                   ( $week == 'Third' && (($this_day > 14) and ($this_day < 22))) ||
                   ( $week == 'Fourth' && (($this_day > 21) and ($this_day < 29))) ||
                   ( $week == 'Fifth' && (($this_day > 28) and ($this_day < 32))) ||
                   ( $week == 'Alternate'  && $alternateswitch == True)
                    ) { //post to events
                    print("<br>Posting $this_year $this_month $this_day");
                    $event_date = $this_year ."-".  $this_month . "-" . $this_day;
                    $event_end_date = $event_date;
                    $event_rsv_date = $event_date;
                    $sql = " insert into events
                                set Date_from = \"$event_date,
                                Event_org = \"$event_org\",
                                Time_start = \"$event_start\",
                                Time_end   = \"$event_end\",
                                Date_to    = \"$event_end_date\",
                                Resby      = \"$event_rsv_date\",
                                Dow        = \"$Dow\",
                                Place      = \"$event_place\",
                                Activity   = \"$event_name\",
                                Price_members = \"$Price_member\",
                                Price_guests  = \"$Price_guest\",
                                Event_open    = \"$event_type\",
                                Event_priority = \"$Event_priority\",
                                SUBMITTED_BY   = \"$Submitted_by\" ";
                     $result = @mysql_query($sql);
                        if (!$result) {
	 		echo("<p> Your  event inquiry  was rejected Email this information to cauleyfrank@gmail.com" . mysql_error() . " </p>");
	 		exit;
	 		}
                        if ( $week == 'Alternate' ){
                            if ( $alternateswitch == True ){
                                $alternateswitch = False;
                                }else{
                                 $alternateswitch = True;
                                }

                       } // end of week eq alternate
                 } // end of post to events

        }// end of foreach

    }// end of dowr
    } // end of loop
}// end of recurring
quit;
?>
