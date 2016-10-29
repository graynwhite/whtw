<?
session_start();
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
     echo  '<strong>Incorrect verification code.</strong><br>';
} else {
     // add form data processing code here
	  <!--webbot bot="SaveResults" u-file="../_private/feedback.txt" s-format="TEXT/PRE" s-label-fields="TRUE" b-reverse-chronology="FALSE" s-email-format="TEXT/PRE" s-email-address="webmaster@graynwhite.com" b-email-label-fields="TRUE" b-email-subject-from-field="FALSE" s-email-subject="WHTW inquiry" s-builtin-fields="REMOTE_NAME REMOTE_USER HTTP_USER_AGENT" startspan -->
	 
<input TYPE="hidden" NAME="VTI-GROUP" VALUE="0">
<!--webbot bot="SaveResults" endspan i-checksum="43374" -->
<input type=hidden name="Subject" Value="WHTW feedback"><input type=hidden name="recipient" value="cauleyfj@graynwhite.com">
<input type=hidden name="env_report" value="REMOTE_HOST,HTTP_USER_AGENT">
<input type=hidden name="return_link_url" value="http://graynwhite.com/whtw/whevents.php">
     echo  '<strong>Verification successful.</strong><br>';
	 }
?>	 



