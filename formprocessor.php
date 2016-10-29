<?PHP

MakeHTMLtop("Form Series","Example Two");

empty($FirstPass) ?          # First pass if empty
  ShowForm() :               # Display the form if first pass
  $Errors = CheckResults($ErrorArray); # Check results if not first pass

($Errors) ? # Are there form processing errors?
  DisplayErrors($ErrorArray) : # Display Errors
  ShowResults();               # Display Results

exit; # All done

############################## Program Functions ##############################
# Function CheckResults #######################################################
function CheckResults(&$ErrorArray) {
  # Return 0 if no errors and 1 if there are errors
  global $FirstName, $LastName, $Gender, $City, $State,
  $Comments, $OperatingSystem, $FavoriteLanguage;
  $ErrorArray = array();
  $ErrorsPresent = 1; $NoErrors = 0;
 
  if (!$FirstName) $ErrorArray[] = "No first name entered";
  if (!$LastName)  $ErrorArray[] = "No last name entered";
  if (!$City)      $ErrorArray[] = "No city entered";
  if (!$Gender)    $ErrorArray[] = "Gender not selected";
  if (!$Comments)  $ErrorArray[] = "No comment entered";
  if (!$FavoriteLanguage) $ErrorArray[] = 
    "Your favorite language not selected";
  $OScount = count($OperatingSystem);
  if (!$OScount) $ErrorArray[] = "Select at least one Operating System";
  $ErrorCount = count($ErrorArray);
  return ($ErrorCount) ? $ErrorsPresent : $NoErrors ;
} # End of function CheckResults ##############################################

#Function DisplayErrors #######################################################
function DisplayErrors(&$ErrorArray) {
  
print<<<StartErrors
  <H2><FONT COLOR="BLUE">There were form entry errors</FONT></H1>
<TABLE>
<TR>
  <TD><B>
  <UL>
StartErrors;

    foreach ($ErrorArray as $Error) {
       echo "<LI>$Error\n";
    } # End of foreach ($ErrorArray as $Error)

print<<<StopErrors
</UL>
<H2><FONT COLOR="BLUE">
  Please fix errors on the form below and resubmit</FONT></H2></B></TD>
</TR>
</TABLE>
StopErrors;

ShowForm();

} # End of function DisplayErrors #############################################

# Function MakeCheckBoxes #####################################################
function MakeCheckBoxes($Name,$PromptsAndValues,$Selected) {
   $ArrayCount = count($PromptsAndValues);
   for($Index=0;$Index<$ArrayCount;$Index++) {
     $String .=<<<STRING
     $PromptsAndValues[$Index]: <INPUT TYPE="CHECKBOX" NAME="$Name
STRING;
     $String .= ($ArrayCount>1) ? "[$Index]" : "";
     $String .= '"';
     $String .= "\n    VALUE=\"$PromptsAndValues[$Index]\"";
     $String .= ($Selected[$Index]) ? " CHECKED>" : ">";
     $String .= "\n";
   } # End of for ($Index=0;$Index<count($PromptsAndValues);$Index++)
   return chop($String);
} # End of function MakeCheckBoxes ############################################

# Function MakeHTMLtop ########################################################
function MakeHTMLtop($Title,$Heading) {
print<<<HTMLtop
<HTML>
<HEAD>
  <TITLE>$Title - $Heading</TITLE>
</HEAD>
<BODY>
<B>
<CENTER>
<H1><FONT COLOR="RED">$Title</FONT> -
  <FONT COLOR="BLUE">$Heading</FONT></H1>
HTMLtop;
} # End of function MakeHTMLtop ###############################################

# Function MakeRadioButtons() #################################################
function MakeRadioButtons($Name,$Current,
   $Values=array(1,0),$Prompt=array("Yes","No")) {

/* This function returns a string containing a formatted set of radio
    buttons. There are two required parameters and two optional parameters.
    The first positional parameter the value used for the NAME= parameter.
    The second positional parameter is the current value of the bottom
    variable. Simply pass the variable containing the current value. The
    third parameter (optional) is an array of possible values. The default
    is (1,0). The last parameter (optional) is an array of prompts. The
    default is ("Yes","No"). The relative position in the array should
    correspond with the values array. If the function is called with:

    MakeRadioButtons("Gender","Male",array("M","F"),array("Male:","Female:"));
    the following would be returned:
    Male: <INPUT TYPE="RADIO" NAME="Gender" VALUE="M" Checked>
    Female: <INPUT TYPE="RADIO" NAME="Gender" VALUE="F">

    If the call was:
    MakeRadioButtons("Married","1") the returned string would be:
    Yes: <INPUT TYPE="RADIO" NAME="Married" VALUE="1" Checked>
    No: <INPUT TYPE="RADIO" NAME="Married" VALUE="0">
	Last change: FJC 10/29/2004 9:17:24 AM
*/

   for($Index=0;$Index<count($Prompt);$Index++) {
     $String .=<<<STRING
     $Prompt[$Index]: <INPUT TYPE="RADIO" NAME="$Name"
    VALUE="$Values[$Index]"
STRING;
     $String .= ($Prompt[$Index]==$Current) ? " Checked>" : ">";
     $String .= "\n";
   } # End of for ($Index=0;$Index<count($Name);$Index++)
   return chop($String);
} # End of function MakeRadioButtons ##########################################

# Function MakeStateDropMenu ##################################################
function MakeStateDropMenu($Name,$Selected="") {

/* This function build a select menu of US states, posessions, and APOs.
   There is one required parameter, the name used for the NAME parameter.
   There is one optional parameter, the name of the state to be used as
   a default. If the second parameter is not passed
*/

$DropMenu=<<<DropMenu
<SELECT NAME="$Name" SIZE="1">
  <OPTION VALUE="AL">Alabama</OPTION>
  <OPTION VALUE="AK">Alaska</OPTION>
  <OPTION VALUE="AS">American Samoa</OPTION>
  <OPTION VALUE="AZ">Arizona</OPTION>
  <OPTION VALUE="AR">Arkansas</OPTION>
  <OPTION VALUE="CA">California</OPTION>
  <OPTION VALUE="CO">Colorado</OPTION>
  <OPTION VALUE="CT">Connecticut</OPTION>
  <OPTION VALUE="DC">Washington D.C.</OPTION>
  <OPTION VALUE="DE">Delaware</OPTION>
  <OPTION VALUE="FL">Florida</OPTION>
  <OPTION VALUE="FM">Fed States of Micronesia</OPTION>
  <OPTION VALUE="GA">Georgia</OPTION>
  <OPTION VALUE="GU">Guam</OPTION>
  <OPTION VALUE="HI">Hawaii</OPTION>
  <OPTION VALUE="ID">Idaho</OPTION>
  <OPTION VALUE="IL">Illinois</OPTION>
  <OPTION VALUE="IN">Indiana</OPTION>
  <OPTION VALUE="IA">Iowa</OPTION>
  <OPTION VALUE="KS">Kansas</OPTION>
  <OPTION VALUE="KY">Kentucky</OPTION>
  <OPTION VALUE="LA">Louisiana</OPTION>
  <OPTION VALUE="ME">Maine</OPTION>
  <OPTION VALUE="MP">Marianas Pacific</OPTION>
  <OPTION VALUE="MH">Marshall Islands</OPTION>
  <OPTION VALUE="MD">Maryland</OPTION>
  <OPTION VALUE="MA">Massachusetts</OPTION>
  <OPTION VALUE="MI">Michigan</OPTION>
  <OPTION VALUE="MN">Minnesota</OPTION>
  <OPTION VALUE="MS">Mississippi</OPTION>
  <OPTION VALUE="MO">Missouri</OPTION>
  <OPTION VALUE="MT">Montana</OPTION>
  <OPTION VALUE="NE">Nebraska</OPTION>
  <OPTION VALUE="NV">Nevada</OPTION>
  <OPTION VALUE="NH">New Hampshire</OPTION>
  <OPTION VALUE="NJ">New Jersey</OPTION>
  <OPTION VALUE="NM">New Mexico</OPTION>
  <OPTION VALUE="NY">New York</OPTION>
  <OPTION VALUE="NC">North Carolina</OPTION>
  <OPTION VALUE="ND">North Dakota</OPTION>
  <OPTION VALUE="OH">Ohio</OPTION>
  <OPTION VALUE="OK">Oklahoma</OPTION>
  <OPTION VALUE="OR">Oregon</OPTION>
  <OPTION VALUE="PA">Pennsylvania</OPTION>
  <OPTION VALUE="PR">Puerto Rico</OPTION>
  <OPTION VALUE="RI">Rhode Island</OPTION>
  <OPTION VALUE="SC">South Carolina</OPTION>
  <OPTION VALUE="SD">South Dakota</OPTION>
  <OPTION VALUE="TN">Tennessee</OPTION>
  <OPTION VALUE="TX">Texas</OPTION>
  <OPTION VALUE="UT">Utah</OPTION>
  <OPTION VALUE="VT">Vermont</OPTION>
  <OPTION VALUE="VA">Virginia</OPTION>
  <OPTION VALUE="VI">Virgin Islands (U.S.)</OPTION>
  <OPTION VALUE="WA">Washington</OPTION>
  <OPTION VALUE="WV">West Virginia</OPTION>
  <OPTION VALUE="WI">Wisconsin</OPTION>
  <OPTION VALUE="WY">Wyoming</OPTION>
  <OPTION VALUE="AA">AA-APO/FPO</OPTION>
  <OPTION VALUE="AE">AE-APO/FPO</OPTION>
  <OPTION VALUE="AP">AP-APO/FPO</OPTION>
</SELECT>

DropMenu;
if ($Selected) {
  $DropMenu = preg_replace("|\"$Selected\">*|","\"$Selected\" SELECTED>",$DropMenu);
} # if ($Selected)
return $DropMenu;

} # End of function MakeStateDropMenu #########################################

# Function ShowForm() #########################################################
function ShowForm() {
  global $PHP_SELF; # The path and name of this file
  global $FirstName, $LastName, $Gender, $City, $State,
  $Comments, $OperatingSystem, $FavoriteLanguage;
  $Comments = stripslashes($Comments);

  $Selected = ($State) ? $State : "NJ";
  $StateDropMenu = MakeStateDropMenu("State",$Selected);
  $GenderButtons = 
    MakeRadioButtons("Gender","$Gender",array("Male","Female"),array("Male","Female"));
  $FavoriteLanguageButtons = 
    MakeRadioButtons("FavoriteLanguage","$FavoriteLanguage",
        array("PHP","Perl","C++","Other"),
        array("PHP","Perl","C++","Other"));
  $OperatingSystemBoxes = MakeCheckBoxes(
    "OperatingSystem",array("Unix","Linux","Windows 2000","Windows 9x","Other"),
     $OperatingSystem); # Last parameter is an array
#    array("Value1","Value2") if last parameter is an array of constants
#  $OneBox = MakeCheckBoxes("OneBox",array("Unix"),array("Unix"));

#<FORM ACTION="test.php" METHOD="POST">
$HTML=<<<HTML
<CENTER>

<FORM ACTION="process-form.php" METHOD="Get">
<INPUT TYPE="HIDDEN" NAME="FirstPass" VALUE="No">
<INPUT TYPE="HIDDEN" NAME="Recipient" VALUE="urb@usats.com">
<INPUT TYPE="HIDDEN" NAME="TextColor" VALUE="BLUE">
<INPUT TYPE="HIDDEN" NAME="ReturnLinkURL" VALUE="http://usats.com">
<INPUT TYPE="HIDDEN" NAME="ReturnLinkTitle" VALUE="ATS Home Page">
<INPUT TYPE="HIDDEN" NAME="Action" VALUE="T">
<INPUT TYPE="HIDDEN" NAME="Recipient" VALUE="urb@usats.com,w2dec@njdxa.org,
	   pkv@drvogel.com">
<TABLE>
<TR>
 <TD ALIGN="RIGHT"><B>First Name:</B></TD>
 <TD><INPUT TYPE="Text" NAME="FirstName" VALUE="$FirstName"></TD>
 <TD ALIGN="RIGHT"><B>Last Name:</B></TD>
 <TD><INPUT TYPE="Text" NAME="LastName" VALUE="$LastName"></TD>
</TR>
<TR>
 <TD ALIGN="RIGHT"><B>City:</B></TD>
 <TD><INPUT TYPE="Text" NAME="City" VALUE="$City"></TD>
 <TD ALIGN="RIGHT"><B>State:</B></TD>
 <TD>$StateDropMenu</TD>
</TR>
<TR>
 <TD COLSPAN="2" ALIGN="RIGHT"><B>Your Gender?</B11/13/00></TD>
 <TD COLSPAN="2"><B>$GenderButtons</B></TD>
</TR>
<TR>
  <TD COLSPAN="2" ALIGN="RIGHT"><B>
    Your favorite Web programming language?</B></TD>
  <TD COLSPAN="2"><B>$FavoriteLanguageButtons
    </B></TD>
</TR>
<TR>
  <TD COLSPAN="4" ALIGN="CENTER"><B><FONT COLOR="BLUE" SIZE="+1">
    What Operating Systems have you used? Check all that apply.</FONT><B></TD>
</TR>
<TR>
  <TD COLSPAN="4" ALIGN="CENTER"><B>
    $OperatingSystemBoxes
    <BR>
    $OneBox<B></TD>
</TR>
<TR>
  <TD COLSPAN="4" ALIGN="CENTER"><B><FONT COLOR="BLUE" SIZE="+1">
    What do you think are PHP strengths and weaknesses?</FONT><B></TD>
</TR>
<TR>
  <TD COLSPAN="4" ALIGN="CENTER">
  <TEXTAREA COLS="60" ROWS="4" NAME="Comments">$Comments</TEXTAREA></TD>
</TR>
<TR>
  <TD COLSPAN="4" ALIGN="CENTER">
  <INPUT TYPE="Submit" VALUE="Submit Now"></TD>
</TR>
</TABLE>
</FORM>
</CENTER>
</B>
</BODY>
</HTML>
HTML;
echo $HTML;
exit;
} # End of function ShowForm ##################################################

# Function ShowResults () #####################################################
function ShowResults () {
  global $HTTP_USER_AGENT, $FirstName, $LastName, $Gender, $City, $State,
  $Comments, $OperatingSystem, $FavoriteLanguage;
  $Comments = nl2br($Comments);
  $Comments = stripslashes($Comments);
  $OSchoices = join(", ",$OperatingSystem);

$FormResults=<<<FormResults
Thanks for your submission:
<P>
<TABLE>
<TR>
  <TD ALIGN="RIGHT"><B>Your Name: </B></TD>
  <TD><B><FONT COLOR="RED" SIZE="+1">$FirstName $LastName</FONT></B></TD>
</TR>
<TR>
  <TD ALIGN="RIGHT"><B>Your Address: </B></TD>
  <TD><B><FONT COLOR="RED" SIZE="+1">$City, $State</FONT></B></TD>
</TR>
<TR>
  <TD ALIGN="RIGHT"><B>Your Gender: </B></TD>
  <TD><B><FONT COLOR="RED" SIZE="+1">$Gender</B></FONT></TD>
</TR>
<TR>
  <TD ALIGN="RIGHT"><B>
    Favorite Programming Language: </B></TD>
    <TD><B><FONT COLOR="RED" SIZE="+1">$FavoriteLanguage</FONT></B></TD>
</TR>
<TR>
  <TD COLSPAN="2" ALIGN="CENTER"><B>Operating System Used: </B></TD>
</TR>
<TR>
  <TD COLSPAN="2" ALIGN="CENTER"><B><FONT COLOR="RED" SIZE="+1">
    $OSchoices</FONT></B></TD>
</TR>
<TR>
  <TD COLSPAN="2" ALIGN="CENTER"><B>Your Comments About PHP</B></TD>
</TR>
<TR>
  <TD COLSPAN="2" ALIGN="CENTER"><B>
<FONT COLOR="RED" SIZE="+1">
$Comments
</FONT>
<BR>
are appreciated.</B></TD>
</TR>
<TR>
  <TD COLSPAN="2" ALIGN="CENTER"><B>
Pleased to see you are using:
<BR>
<FONT COLOR="BLUE" SIZE="+1">
  $HTTP_USER_AGENT</FONT></B></TD>
</TR>
</TABLE>
FormResults;
print $FormResults;
} # End of function ShowResults ###############################################

?>


