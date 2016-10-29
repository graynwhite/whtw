<?php
/** @package

        reservation_generate_page.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 7/3/2003 6:05:43 PM
        Last Change: FJC 7/3/2003 6:05:43 PM

	Last change: FJC 7/3/2003 6:24:17 PM
*/
$filename="../data.txt";
$filepointer = fopen($filename,"W");
fwrite ($filepointer,"this is the data")
fclose($filepointer);

?>
