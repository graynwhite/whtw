<?php
/** @package 

        php_select_year
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 10/21/2004 3:18:53 PM
	Last change: FJC 10/21/2004 11:40:53 PM
*/
?>
<?PHP
function php_functions_gen_years($field_name,$na ){
    $year = date(Y);
    $na = $na;
    $select_statement = "<SELECT NAME=\"" . $field_name .  "\" SIZE=\"1\" >";
    if ( $na ){
     $select_statement .= "<OPTION VALUE=\"" .$year . "\" selected>" . $year;
    }else{
     $select_statement .= "<OPTION VALUE=\"    \" selected>N/A";
      $select_statement .= "<option value =\"" . $year . "\">" . $year;
    }

     $year= $year + 1;
     $select_statement .= "<option value =\"" . $year . "\">" . $year;
     $year= $year + 1;
     $select_statement .= "<option value =\"" . $year . "\">" . $year;
     $year= $year + 1;
     $select_statement .= "<option value =\"" . $year . "\">" . $year;
     $select_statement .= "</Select>";
        echo("$select_statement");


    }
 // end of function

?>
