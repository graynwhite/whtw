<?php
/** @package 

        club_input
        
        Copyright()Gray and White Computing 2004
        
        Author: FRANK J CAULEY
        Created: FJC 10/26/2004 11:13:22 PM
	Last change: FJC 10/28/2004 10:57:53 AM
*/
?>
<?php


 include_once('php_select_year.php');


 ?>
<HTML>
<HEAD>

<TITLE>Club event input screen</TITLE>
<META NAME="generator" CONTENT="Microsoft FrontPage 5.0">
<Script language=Javascript>
<!--  Hide script from older browsers

function daysbetween(earlydate,laterdate){
	// returns number of days between two date objects
	var earlysecs=earlydate.getTime()
	var latersecs=laterdate.getTime()
	return Math.floor((((((latersecs-earlysecs)/1000)/60)/60)/24))
}

function convert_selection_to_date(cmx,cmd,cmy){
	// converts date selection to a date
	icmx=cmx.selectedIndex
	icmd=cmd.selectedIndex
	icmy=cmy.selectedIndex
	icmx_val=cmx.options[icmx].value
	
	icmx_val=icmx_val.substring(0,2)
	icmx_val=icmx_val-1
	icmd_val=cmd.options[icmd].value
	icmy_val=cmy.options[icmy].value
	icmy_val=icmy_val.substring(0,4)
	return new Date(icmy_val,icmx_val,icmd_val)


}

function assemble_date(mx,md,my){
	imx=mx.selectedIndex
	imd=md.selectedIndex
	imy=my.selectedIndex
	asmbld_date=my.options[imy].value  +  mx.options[imx].value + md.options[imd].value 
	return asmbld_date
}

function clear_form(form){
	form.reset();
}
function check_page(form){
	var foundError = false;
	var Radio_state = "   ";
	re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	
	dayName = new Array ("SUN","MON","TUE","WED","THU","FRI","SAT");
	fromdate=convert_selection_to_date(form.From_mm,form.From_day,form.From_year)

	if (!re.test(form.emailid.value)) {
		alert("Invalid email Address")
		form.emailid.focus()
		return false
	}
	if (form.yourpswd.value==""){
		alert("Password must be submitted")
		form.yourpswd.focus()
		return false
		}
	if(form.Org.selectedIndex==0){
		alert("An organization must be selected");
		form.Org.focus()
		return false
	}

	event_date=assemble_date(form.From_mm,form.From_day,form.From_year)
	
	now = new Date();
	yy=now.getFullYear();
	mm=now.getMonth() +1;
	mm=mm.toString();
	dx=now.getDate();
	dx=dx.toString();
	if (mm.length<2){
		mm= "0" + mm;
	}
	if (dx.length<2){
		dx="0" + dx;
	}
	test_date = yy + "-" + mm + "-" + dx
	
	if (event_date < test_date){
		alert("Event start date " + event_date + " can not be earlier than today " + test_date )
		form.From_mm.focus()
		return false
	}
	
	if(form.From_mm.selectedIndex == null){
		alert("Event Start date not set")
		form.From_mm.focus()
		return false
	}
	
	if(form.To_mm.selectedIndex == 0){
	    if (form.To_day.selectedIndex != 0 ||  form.To_year.selectedIndex != 0){
	       alert("Event To date is not correct")
	       form.To_day.focus()
	       return false
	    }
	 } 
	 
	 //   test to date
	 if(form.To_mm.selectedIndex != 0){
	 
	 
	    if (form.To_day.selectedIndex == 0 || form.To_year.selectedIndex == 0){
	       alert("To Date not complete")
	       form.To_mm.focus()
	       return false
      	   }
		  
		  
	 	 todate=convert_selection_to_date(form.To_mm,form.To_day,form.To_year)
         days_between = daysbetween(fromdate,todate)
           
		if (days_between < 0  ) {
			alert("To date is less than from Date")
			form.To_mm.focus()
	        return false
	     }     // end of if
    
	     if (days_between>1 && form.action[1].checked){
	     	alert("Recurring events cannot be multi day events")
	     	form.To_mm.focus()
	     	return false
	     } // end of if


	   }  // end of test to date
	   
		// Test day of week selection
		i=form.Dow.selectedIndex
		if (i<7 && form.To_mm.selectedIndex !=0){
			alert("Day of week selection not correct")
			form.Dow.focus()
			return false
		}	
		if(form.To_mm.selectedIndex == 0 ){
			
			from_dow = dayName[fromdate.getDay()]
			
			if(form.Dow.options[i].value!=from_dow) {
				alert("This day is " + from_dow + "  " + fromdate + "  Change the selected date")
				form.Dow.focus()
				return false
			}	
		}   
 	
	if(form.Reserve_mm.selectedIndex == 0){
	    if (form.Reserve_day.selectedIndex != 0 || form.Reserve_year.selectedIndex != 0){
	       alert("Reserve date is not correct");
	       form.Reserve_mm.focus()
	       return false
	    } //end of if
	  
	 } // 
	 // check resetve date 
	 if(form.Reserve_mm.selectedIndex != 0){
	 
	    if (form.Reserve_day.selectedIndex == 0 ||form.Reserve_year.selectedIndex == 0){
	       alert("Reserve Date not complete");
	      	form.Reserve_mm.focus()
	      	return false
	      	}
	    
	    
	    fromdate=convert_selection_to_date(form.From_mm,form.From_day,form.From_year)
		reservedate=convert_selection_to_date(form.Reserve_mm,form.Reserve_day,form.Reserve_year)
		rdays_between = daysbetween(fromdate,reservedate)
		
		if(rdays_between > 0){
			alert("Reserve date should be less than the event date")
			form.Reserve_mm.focus()
			return false
		}
		
		if (rdays_between != 0 && form.action[1].checked){
	     	alert("Recurring events cannot have reserve dates")
	     	form.Reserve_mm.focus()
	     	return false

	 }
	 } // end of check reserve date	
	
	if(form.Start_Time_Hours.selectedIndex == 0){
	    if (form.Start_Time_Minutes.selectedIndex != 0 || form.Start_AMPM.selectedIndex != 0 ){
	       alert("Start Time not correct");
	       form.Start_Time_Hours.focus()
	       return false
	    }
	 } 
	 
	 if(form.Start_Time_Hours.selectedIndex != 0){
	    if (form.Start_Time_Minutes.selectedIndex == 0 || form.Start_AMPM.selectedIndex == 0){
	       alert("Start time not correct");
	       form.Start_Time_Hours.focus()
	       return false
	    }
	}
       
	if(form.To_Time_Hours.selectedIndex == 0){
	    if (form.To_Time_Minutes.selectedIndex != 0 || form.To_AMPM.selectedIndex != 0 ){
	       alert("To  Time not correct");
	       form.To_Time.focus()
	       return false
	    }
	 } 
	 
	 if(form.To_Time_Hours.selectedIndex != 0){
	    if (form.To_Time_Minutes.selectedIndex == 0 || form.To_AMPM.selectedIndex == 0){
	       alert("To Time not correct")
	       form.To_Time.focus()
	       return false
	  	  }
		}
	// check place 
	if (form.place.value == ""){
		alert("Place is blank")
		form.place.focus()
		return false
	}
	// check activity
	if (form.activity.value == ""){
		alert("Activity was left blank")
		form.activity.focus()
		return false
		}		
	// check recurring
	if (form.action[1].checked){
		fromdate=convert_selection_to_date(form.From_mm,form.From_day,form.From_year)
		recurstart=convert_selection_to_date(form.gen_from_mm,form.gen_from_day,form.gen_from_year)
		recurend=convert_selection_to_date(form.gen_to_mm,form.gen_to_day,form.gen_to_year)
		days_between = daysbetween(fromdate,recurstart)
		
		if (days_between<0){
			alert("Recurrring date start should be equal or greater than the event date")
			form.gen_from_mm.focus()
			return false
		}
		
		days_between=daysbetween(recurstart,recurend)
		
		if (days_between<1){
			alert("Recurring date end must be greateer than recurring date start")
			form.gen_to_mm.focus()
			return false
		}
		
		dowrcnt=-1
		for(i=0;i<form.DOWR.length;i++){
			if(form.DOWR[i].checked){
			dowrcnt++
			} // end of if
		} // end of for	
			
		if (dowrcnt==-1){
			alert("A day of the week must be selected for a recurring event")
			form.DOWR[0].focus()
			return false
			}
			
		weekcnt=-1
		for(i=0;i<form.week.length;i++){
			if(form.week[i].checked){
			weekcnt++
			} //end of if
		} // end of for
		
		if(weekcnt==-1){
			alert("At least one selection for week of the month must be checked")
			form.week[0].focus()
			return false
		}			
		
	return true
	}	// end of check recurring

	

}  // end of check_page

// Check for blank field
function isFieldBlank(theField) {
	if (theField.value.length == 0){
	     return true;
	}
	     return false;
      
}	
// make array
function MakeArray(n){
	this.length = n;
	for (var i = 1;i <=n; i ++){
	 this[i] = 0}
	return this
}	

//-->

</script>


</HEAD>
<BODY>
<H1>&nbsp;Post <?=$orgname?>  Event Information</H1>

<Form onSubmit="return check_page(this)"
 action ="http://graynwhite.com/cgi-bin/club_entry_dbi_test.cgi"  name="FrontPage_Form1">
<Table Align = "left" Border= "1" Width = "903" height="954">
<TR><TD width="191" height="84">Action</td>
<td width="294" height="84">Add&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT TYPE="radio" NAME="action" VALUE="Add" CHECKED><BR>
Recurring<INPUT type="radio" NAME="action" Value="Recurring"></td>
<TR >
<td width="191" height="22">Your Identification: (email)</td>
<TD width="294" height="22">
 
	<input type="text" name="emailid" size="40" ></td>
<TD width="195" height="22" >Password</TD>
<TD width="195" height="22">	

<input type="password" name="yourpswd" size="8"></TR>
<TR>
<td width="191" height="23">Organization Name: </td>
<TD width="294" height="23"><?=$orgname?>
<input type="hidden" name = "Org" Value = "<?=$org?>"></td>
 </TR>
 
<TR>
<TD width="191" height="67">Date From :</TD>
<TD width="294" height="67">
	<SELECT NAME="From_mm" SIZE="1">
	<OPTION VALUE="01-" selected>January
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
	 <Option value= "01" selected>01
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
		
        <?php  php_functions_gen_years('From_year',True);?>

</td>
<TD width="195" height="67">To Date :</td>
<td width="195" height="67"> 
	<SELECT NAME="To_mm" SIZE="1">
	<OPTION VALUE="   " selected>N/A
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
	<Select NAME = "To_day" Size = "1">
	<Option Value = "  " selected>N/A
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
	<?php  php_functions_gen_years('To_year',False);?>


</td>
</tr>
<TR>
<TD width="191" height="67">Reserve By:</TD>
<TD width="294" height="67">
	 <SELECT NAME="Reserve_mm" SIZE="1">
         <OPTION VALUE="   " selected>N/A
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
	
	 <Select NAME = "Reserve_day" Size = "1" >
         <OPTION VALUE="   " selected>N/A
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
		
        <?php  php_functions_gen_years('Reserve_year',False);?>

</td>
<TD  ColSpan = "2" width="396" height="67"> <b>If advance reservations are necessary</B></TD>
</TR>
<TR>
<TD width="191" height="69">Start Time</TD><TD width="294" height="69">
	<Select NAME = "Start_Time_Hours" SIZE = "1" >
	<OPTION VALUE = "   " selected>N/A
	<OPTION VALUE = "01:">01
	<OPTION VALUE = "02:">02
	<OPTION VALUE = "03:">03       
	<OPTION VALUE = "04:">04
	<OPTION VALUE = "05:">05
	<OPTION VALUE = "06:">06
	<OPTION VALUE = "07:">07
	<OPTION VALUE = "08:">08
	<OPTION VALUE = "09:">09
	<OPTION VALUE = "10:">10
	<OPTION VALUE = "11:">11
	<OPTION VALUE = "12:">12
    </SELECT>Hours<BR>
	<SELECT Name = "Start_Time_Minutes" SIZE = "1">
	<OPTION VALUE = "  " selected>N/A
	<Option Value = "00">00
	<OPTION VALUE = "15">15
	<OPTION VALUE = "30">30
	<OPTION VALUE = "45">45
	</SELECT>Min<BR>
	<SELECT NAME= "Start_AMPM" size= "1">
	<Option Value = "   " selected>N/A
	<Option Value = " PM">PM
	<Option Value = " AM">AM
	</Select>
	
</td>
<td width="195" height="69">End Time:</TD><td width="195" height="69">
	<Select NAME = "To_Time_Hours" SIZE = "1" >
	<OPTION VALUE = "   " selected>N/A
	<OPTION VALUE = "01:">01
	<OPTION VALUE = "02:">02
	<OPTION VALUE = "03:">03       
	<OPTION VALUE = "04:">04
	<OPTION VALUE = "05:">05
	<OPTION VALUE = "06:">06
	<OPTION VALUE = "07:">07
	<OPTION VALUE = "08:">08
	<OPTION VALUE = "09:">09
	<OPTION VALUE = "10:">10
	<OPTION VALUE = "11:">11
	<OPTION VALUE = "12:">12
    </SELECT>Hour <BR>
	<SELECT Name = "To_Time_Minutes" SIZE = "1">
	<OPTION VALUE = "  " selected>N/A
	<OPTION VALUE = "00">00
	<OPTION VALUE = "15">15
	<OPTION VALUE = "30">30
	<OPTION VALUE = "45">45
	</SELECT>Min<BR>
	<SELECT NAME= "To_AMPM" size= "1">
	<Option Value = "   " selected>N/A
	<Option Value = " PM">PM
	<Option Value = " AM">AM
	</Select>
	
</td>
</tr>
<TR><td width="191" height="23">Day of Week :</td><TD width="294" height="23">
		<p align="left">
		<SELECT NAME="Dow" SIZE="1">
	<OPTION VALUE="MON">Monday
	<OPTION VALUE="TUE">Tuesday
	<OPTION VALUE="WED">Wednesday
	<OPTION VALUE="THU">Thursday
	<OPTION VALUE="FRI">Friday
	<OPTION VALUE="SAT">Saturday
	<OPTION VALUE="SUN">Sunday
	<OPTION VALUE="N/A">Not applicable
	<OPTION VALUE="WK.">Week
	<OPTION VALUE="WE.">Week End
	<OPTION VALUE="MOS">Month
	</SELECT>&nbsp;
</td>
<td>&nbsp;
</td>
<td>&nbsp;
</td>
</tr>
<TR><TD width="191" height="68">Place :</TD>
  <TD COLSPAN="3" width="696" height="68">
<textarea rows="3" name="place" cols="85" ></textarea></TD>
</TR>
<TR><TD width="191" height="68">Event :</TD>
  <TD COLSPAN ="3" width="696" height="68">
  <textarea rows="3" name="activity" cols="85"></textarea></TD>
</tr>
<TR><td width="191" height="22">Hyperlink</td><TD width="294" height="22">
  <input type="text" name="reference" size="40"></TD>
<TD width="195" height="22">&nbsp;</TD><TD width="195" height="22">&nbsp;</td>
</TR>
<TR><td width="191" height="22">Price Members :</td><TD width="294" height="22"><INPUT TYPE="text" NAME="Price_Member" SIZE="20" MAXLENGTH="50" ></TD>
<TD width="195" height="22">Price Guests</TD><TD width="195" height="22"><INPUT TYPE="text" NAME="Non_Member_Price" SIZE="20" MAXLENGTH="50" ></td>
</TR>
<TR>
<TD width="191" height="90">Type of event, Open to the public or Private</td>
<TD width="294" height="90"><input type="radio" Name="Event_type" Value="Y" checked>Open<BR>
<input type="radio" Name="Event_type" Value="N">Private<p>&nbsp;</p>
<p><BR>

</td>
<TD width="195" height="90">Publish Priority number of days before reservation 
date.</td>
<TD width="195" height="90">
<INPUT type="radio" Name="Event_priority" Value="7" checked>7
<input type="radio" Name="Event_priority" Value="14">14
<input type="radio" Name="Event_priority" Value="21">21
<input type="radio" NAME="Event_priority" Value="28">28
<input type="radio" name="Event_priority" value="90">90
<input type="radio" name="Event_priority" value="120">120
<input type="radio" name="Event_priority" value="240">240<br>
</TD></TR>    
<TR><td COLSPAN = "4" width="893" height="19">
<CENTER><B><I>Recurring Event Parameters</I></B></CENTER></TR>
<TR><td width="191" height="69">Generate From Date</td>


<TD width="294" height="69">     Month
	 <SELECT NAME="gen_from_mm" SIZE="1">
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
	  Day
	 <Select NAME = "gen_from_day" Size = "1" >
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
	 Year	
        <?php  php_functions_gen_years('gen_from_year',False);?>

</td>
<td width="195" height="69">Generate To Date</td>
<TD width="195" height="69">     Month
	 <SELECT NAME="gen_to_mm" SIZE="1">
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
	 Day
	 <Select NAME = "gen_to_day" Size = "1" >
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
	  Year	
         <?php  php_functions_gen_years('gen_to_year',False);?>

</td>
</tr>
<tr>
<Td width="191" height="147"> Day of week</td>
<Td width="294" height="147"><input type="radio" Name="DOWR" Value="Mon">Monday<BR>
<input type="radio" Name="DOWR" Value="Tue">Tuesday<BR>
<input type="radio" Name="DOWR" Value="Wed">Wednesday<BR>
<input type="radio" Name="DOWR" Value="Thu">Thursday<BR>
<input type="radio" Name="DOWR" Value="Fri">Friday<BR>
<input type="radio" Name="DOWR" Value="Sat">Saturday<BR>
<input type="radio" Name="DOWR" Value="Sun">Sunday<BR>
</Td>
<td width="195" height="147">Week of the Month</td>
<td width="195" height="147"><input type="checkbox" Name="week" value="First">First<BR>
<input type="checkbox" Name="week" value="Second">Second<BR>
<input type="checkbox" Name="week" value="Third">Third<BR>
<input type="checkbox" Name="week" value="Fourth">Fourth<BR>
<input type="checkbox" Name="week" value="Fifth">Fifth<BR>
<input type="checkbox" Name="week" value="Alternate">Alternate<BR></td>
</tr>





<tr><TD colspan = "4" width="893" height="26">
<CENTER><input TYPE="submit" NAME="Submit" VALUE="Submit Form" size="20"  ><input TYPE="Button"
 NAME = "Clear" VALUE = "Reset Form" 
onclick ="clear_form(this.form)"></CENTER></TD>
</TR>
</table>

	
</FORM>
<script language=javascript>

<!--  Hide script from older browsers

	FrontPage_Form1.emailid.focus()
	//-->

</script>	


</BODY>
<script>
document.location.href="event_mail_mobile.php";
</script>
</html>
</HTML>
