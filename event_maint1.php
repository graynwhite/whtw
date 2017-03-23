<?php
/** @package

        event_maint1.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 7/7/2003 4:14:50 PM
	Last change: FJC 7/7/2003 5:46:09 PM
*/
include("../cgi-bin//connect.inc");
           $sql=(" select Org_name, Org_num from orgs order by Org_name");
           $result = (@mysql_query($sql));
           if (!$result){ 
              echo("<p>error performing query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p> ");
           exit();
           }
?>
<HTML>
<HEAD>
<TITLE>Club event Maintenance Screen</TITLE>
<META NAME="generator" CONTENT="Microsoft FrontPage 5.0">
<Script>
<!--
function clear_form(form){
form.reset();
}
function submit_page(form){
var foundError = false;
	

	if (!foundError) {
		form.submit()
	}	
}
//-->

</script>


</HEAD>
<BODY>
<H1 align="center"><img src="graypluswhitebannereventMaint.jpg" width="468" height="60"></H1>
<H1>Club Event Maintenance</H1>
<!--webbot BOT="GeneratedScript" PREVIEW=" " startspan --><script Language="JavaScript" Type="text/javascript"><!--
function FrontPage_Form1_Validator(theForm)
{

  if (theForm.emailid.value == "")
  {
    alert("Please enter a value for the \"emailid\" field.");
    theForm.emailid.focus();
    return (false);
  }

  if (theForm.yourpswd.value == "")
  {
    alert("Please enter a value for the \"yourpswd\" field.");
    theForm.yourpswd.focus();
    return (false);
  }

  if (theForm.yourpswd.value.length < 5)
  {
    alert("Please enter at least 5 characters in the \"yourpswd\" field.");
    theForm.yourpswd.focus();
    return (false);
  }

  if (theForm.yourpswd.value.length > 8)
  {
    alert("Please enter at most 8 characters in the \"yourpswd\" field.");
    theForm.yourpswd.focus();
    return (false);
  }
  return (true);
}
//--></script><!--webbot BOT="GeneratedScript" endspan --><Form action ="http://graypluswhite.com/whtw/event_maint.php" onSubmit="return FrontPage_Form1_Validator(this)" language="JavaScript" name="FrontPage_Form1">
<Table Align = "left" Border= "1" Width = "903" height="133">
<td width="186" height="1">Your Identification: (email)</td>
<TD width="309" height="1">
 
	<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="emailid" size="40"></td>
<TD width="193" height="1" >&nbsp;Password</TD>
<TD width="187" height="1">	
<!--webbot bot="Validation" b-value-required="TRUE" i-minimum-length="5" i-maximum-length="8" --><input type="password" name="yourpswd" size="8" maxlength="8"></td>

</TR>
<TR >
<td width="186" height="4">Organization Name: </td>
<TD width="309" height="4">
 
<SELECT NAME="Org" size="1" >
          <option value= "    " selected>Select an organization
<?
 while ($row = mysql_fetch_array($result)){
              print("<OPTION VALUE=\"" . $row["Org_num"] ."\">" . $row["Org_name"] ."\n");
           }
               print("<OPTION VALUE=</SELECT>\n");
?>

<TD width="396" height="4" colspan="2" > </TD>

</TR>
<TR>
<TD width="186" height="1">Date From :</TD>
<TD width="309" height="1">
	 <SELECT NAME="From_mm" SIZE="1">
	<OPTION VALUE="01-">January
	<OPTION VALUE="02-">February
	<OPTION VALUE="03-">March
	<OPTION VALUE="04-">April
	<OPTION VALUE="05-">May
	<OPTION VALUE="06-">June
	<OPTION VALUE="07-">July
	<OPTION VALUE="08-">August
	<OPTION VALUE="09-">September
	<OPTION VALUE="10-">October
	<OPTION VALUE="11-">November
	<OPTION VALUE="12-">December
	</SELECT><BR>
	
	 <Select NAME = "From_day" Size = "1" >
	 <Option value= "01">01
	 <Option value= "02">02
	 <Option value= "03">03
	 <Option value= "04">04
     <Option value= "05">05
	 <Option value= "06">06
	 <Option value= "07">07
	 <Option value= "08">08
	 <Option value= "09">09
	 <Option value= "10">10
     <Option value= "11">11
	 <Option value= "12">12	
	 <Option value= "13">13
     <Option value= "14">14
	 <Option value= "15">15	
	 <Option value= "16">16
     <Option value= "17">17
	 <Option value= "18">18	
	 <Option value= "19">19
     <Option value= "20">20
	 <Option value= "21">21
	 <Option value= "22">22
	 <Option value= "23">23	
	 <Option value= "24">24
	 <Option value= "25">25
	 <Option value= "26">26
	 <Option value= "27">27
	 <Option value= "28">28
	 <Option value= "29">29
	 <Option value= "30">30
	 <Option value= "31">31
	 </Select><BR>
		

	<SELECT NAME="From_year" SIZE="1" >
         <OPTION VALUE="2003-">2003
    <option value="2004-">2004</option>
    <option value="2005-">2005</option>
	</select>
</td>
<TD width="386" height="1" Span_COLS="2" colspan="2">
<input type="radio" value="byorgbydate" checked name="action">Select by Org and Date
<input type="radio" name="action" value="byitem">Select by #&nbsp;&nbsp; 
<p>Item Number&nbsp; <input type="text" name="Event_number" size="5">&nbsp;
<input type="radio" name="action" value="browse">Browse Organization</p>
<p><input type="radio" name="action" value="copy">Copy event with new date<p></td>
	
	<BR>
	&nbsp;</td>
</tr>
<TR><TD Colspan = "4" width="893">
<CENTER><input TYPE='button' NAME="Submit" VALUE="Submit Form" onclick ="submit_page(this.form)" ><input TYPE="Button"
 NAME = "Clear" VALUE = "Reset Form" 
onclick ="clear_form(this.form)"></CENTER></TD>
</TR>
</table>

	
</FORM>
</BODY>
</HTML>