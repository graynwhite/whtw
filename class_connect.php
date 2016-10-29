<?php
/*
 * Created on December 19, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php
/** @package

        connect.inc
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 4/2/2003 11:38:46 AM
	Last change: FJC 8/18/2005 8:29:24 PM
*/    

            

	//connect to the database server
class connect_to_database
{	
public static function connect()
{
	$dbcnx = @mysql_connect("localhost","graynwhi_admin", "/PJ7t85e");
   
	if (!$dbcnx) {  
                      echo("<h1>Unable to connect to the database server at this time.</h1></p>");
		      echo("<P>For help, please send mail to the webmaster (webmaster@graynwhite.com), giving this error message and the time and date of the error.</p>"); 	
	           exit();
                      }
       //	 Select the cauleyfj  database
      	if (! @mysql_select_db("graynwhi_cauleyfj") ) {
      		echo("<p> <h1>Unable to locate   database at this time. Try again later.</h1></p>");
		echo("<P>For help, please send mail to the webmaster (webmaster@graynwhite.com), giving this error message and the time and date of the error.</p>"); 
      		
		exit();
		}  
	} 
}           
?>