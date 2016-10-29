<?php
/** @package 

        formprocessorone
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 10/29/2004 9:34:31 AM
        Last Change: FJC 10/29/2004 9:34:31 AM
*/
?>
<HTML>
<HEAD>
  <TITLE>Form Series - Example One</TITLE>
</HEAD>
<BODY>
<B>
<H2>Form Series - Example One</H2>

<?PHP
  empty($FirstPass) ? # First pass if empty
    ShowForm() :      # Display the form
    ShowResults($FirstName,$LastName,nl2br($Comments)); 
  exit;
?>

<?PHP
function ShowResults ($First, $Last, $Answer) {
  global $HTTP_USER_AGENT;
  echo "Thanks $First $Last
  <BR>
    Your comment of
  <BR>
  <FONT COLOR=\"RED\" SIZE=\"+1\">
  $Answer
  </FONT>
  <BR>
  is appreciated.
  <P>
  Pleased to see you are using:
  <BR>
  <FONT COLOR=\"BLUE\" SIZE=\"+1\">
  $HTTP_USER_AGENT
  </FONT>
  <H2>Dump of GLOBALS Array</H2>
  <UL>\n";
  foreach ($GLOBALS as $Key=>$Value){
    echo "<LI>\$GLOBALS[\"$Key\"]=$Value\n";
  } # End of foreach ($GLOBALS as $Key=>$Value)
  echo "</UL>\n";
} # End of function ShowResults

function ShowForm() {
  global $PHP_SELF; # The path and name of this file
$HTML=<<<HTML
<FORM ACTION="$PHP_SELF">
  <INPUT TYPE="HIDDEN" NAME="FirstPass" VALUE="No">
  Your First Name: <INPUT TYPE="Text" NAME="FirstName">
  <BR>Your Last Name: <INPUT TYPE="Text" NAME="LastName">
  <BR>What do you think about PHP?
  <BR><TEXTAREA COLS="40" ROWS="4" NAME="Comments"></TEXTAREA>
  <BR><INPUT TYPE="Submit" VALUE="Submit Now">  
</FORM>
</B>
</BODY>
</HTML>
HTML;
echo $HTML;
} # End of function ShowForm
?>
