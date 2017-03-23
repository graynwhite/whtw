<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
        <head>
          <title>Club Event Input Form</title>
        </head>

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
	asmbld_date=my.options[imy].value  +  md.options[imd].value  + mx.options[imx].value
	return asmbld_date
}

function clear_form(form){
	form.reset();
	return false
}
function check_page(form){
	var foundError = false;
	var Radio_state = "   ";
	re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	
	dayName = new Array ("SUN","MON","TUE","WED","THU","FRI","SAT");
	fromdate=convert_selection_to_date(form.From_mm,form.From_day,form.From_year)

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

	var event_date=assemble_date(form.From_mm,form.From_day,form.From_year)
	
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
		  }
		  if ( form.To_mm.selectedIndex != 0 ){
	 	 todate=convert_selection_to_date(form.To_mm,form.To_day,form.To_year)
         days_between = daysbetween(fromdate,todate)
           
		if (days_between < 0  ) {
			alert("To date is less than from Date")
			form.To_mm.focus()
	        return false
	     }     // end of if
    
	     


	   }  // end of test to date
	   
		// Test day of week selection
		i=form.Dow.selectedIndex
		if (i<7 && form.To_mm.selectedIndex !=0){
			alert("Day of week not set to weekend, week or month for an event \n"
			 + "Events with a from date and a to date are considered inclusive.\n"
			 + " To enter multiple single day events-\n"
			 +   " set all parts of the to date to n/a  then \n"
			 + " depress Submit, then use your  back \n"
			 + "button, change the date and submit again");
			form.To_mm.focus()
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
		form.place_name.focus()
		return false
	}
	 lengthOfPlace = form.place_name.value.length +
                        form.place_address.value.length +
                        form.city.value.length +
                        form.state.value.length +
                        form.state.value.length +
                        form.zip.value.length +
                        form.directions.value.length +
                        form.phone.value.length +
                        form.url.value.length +
                        form.place_email.value.length
        
            if ( lengthOfPlace > 255 ){
                reduceBy = 256-lengthOfPlace
                alertString = "The total length of the place field is too large \n"
                alertString = alertString + " reduce it by " + reduceBy + " positions"

                alert(alertString)
                form.directions.focus()
                return false
                }
	
	// check activity
	lengthOfActivity = form.activity.value.length +
                           form.activity_contact.value.length
        if ( form.insert_credit.value=="Y" && form.credit_inserted.value != "N"){
            lengthOfActivity = lengthOfActivity + form.credit_value.value.length +10
            }
       
        if ( lengthOfActivity > 255 ){
            reduceBy = 256 - lengthOfActivity
            alert("Activity too large reduce by " + reduceBy + " positions" )
            form.activity.focus()
            return false

            }
          if ( form.insert_credit.value == "Y" && form.credit_inserted.value == "N" ){
            form.activity.value = form.activity.value + " submitted by : " + form.credit_value.value
            form.credit_inserted.value = "Y"

            }	
	// check recurring
	
	

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
<H1>&nbsp;Post Club Event Information</H1>
<?PHP
if ($pswd != "6r1n11"){
        echo("<p>The password is not correct </p>");
        echo("<p>Use the back function to return to the previous page. </p>");
        exit();
}
        include("../cgi-bin//connect.inc");
        $sql =" Select T1.valid_org, T2.Org_name from core as T1,
                orgs as T2 where T1.email = \"$emailid\" and
                T1.valid_org = T2.Org_num order by T2.Org_name";
        $result=@mysql_query($sql);
        if(!$result){
               echo("<p>The Email Id submitted does not have any  </p>");
               echo("<p>assigned organizations  </p>");
               echo("<p>" . mysql_error() . " </p>");
               echo("<p>Use the back fucntion to return to the
               previous page Email this information to cauleyfrank@gmail.com </p>");
               exit();
        }
        if(mysql_num_rows($result) < 1){
                echo("<p>The Email Id submitted does not have any  </p>");
               echo("<p>assigned organizations  </p>");
               echo("<p>Use the back fucntion to return to the
               previous page  </p>");
               exit();


        }

?>
<Form onSubmit="return check_page(this)" action ="http://graypluswhite.com/cgi-bin/club_entry_dbi.cgi"  name="FrontPage_Form1">
<Table Align = "left" Border= "1" Width = "100%" height="954">
<TR><TD width="25%" height="84">Action</td>
<td width="75%"  colspan="3" height="84">Add&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT TYPE="radio" NAME="action" VALUE="Add" CHECKED><BR>
Recurring<INPUT type="radio" NAME="action" Value="Recurring">
<input type="Hidden" Name="emailid" value = "<?=$emailid?>">
<input type="HIDDEN" Name="yourpswd" value="<?=$pswd?>">
</td></TR>
<TR>
<td width="25%" height="23">Organization Name: </td>
<TD width="75%" colspan="3" height="23">
 
<SELECT NAME="Org" size="1" >
	<option value= "    " selected>Select an organization
<?PHP

while ($row = mysql_fetch_array($result)){
        echo("<OPTION VALUE=\"" . $row["valid_org"] . "\">" .$row[
        "Org_name"]);

}
?>
	<OPTION VALUE=</SELECT>  </select></td>

</TR>
<TR>
<TD width="25%" height="67">Date From :</TD>
<TD width="25%" height="67">
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
		

	<SELECT NAME="From_year" SIZE="1" >
   		<OPTION VALUE="2002-" selected>2002
         <OPTION VALUE="2003-">2003
         <OPTION VALUE="2004-">2004
		</Select>
</td>
<TD width="25%" height="67">To Date :</td>
<td width="25%" height="67">
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
	<SELECT NAME="To_year" SIZE="1" >
	<OPTION VALUE="   " selected>N/A
	<OPTION VALUE="2002-">2002
	<OPTION VALUE="2003-">2003
	<OPTION VALUE="2004-">2004

	</select>
</td>
</tr>
<TR>
<TD width="25%" height="67">Reserve By:</TD>
<TD width="25%" height="67">
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
		

	<SELECT NAME="Reserve_year" SIZE="1" >
	<OPTION VALUE="   " selected>N/A
      <OPTION VALUE="2002-">2002
      <OPTION VALUE="2003-">2003
	<OPTION VALUE="2004-">2004
	
	</select>
</td>
<TD  ColSpan = "2" width="50%" height="67"> <b>If advance reservations are necessary</B></TD>
</TR>
<TR>
<TD width="25%" height="69">Start Time</TD><TD width="25%" height="69">
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
<td width="25%" height="69">End Time:</TD><td width="25%" height="69">
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
<TR><td width="25%" height="23">Day of Week :</td><TD width="25%" height="23">
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
	</SELECT>
</td>
<td width="25%" height="22">Link</td>
<td width="25%" height="22"><input type="text" Name="link" size="40">Link</td>
<td>
</tr>
<TR><TD width="25%" height="68">Place :</TD>
  <TD COLSPAN="3" width="75%" height="68">
<textarea rows="3" name="place" cols="60" ></textarea></TD>
</TR>
<TR><TD width="25%" height="68">Event :</TD>
  <TD COLSPAN ="3" width="75%" height="68">
  <textarea rows="3" name="activity" cols="60"></textarea></TD>
</tr>
<TR><td width="25%" height="22">Price Members :</td><TD width="25%" height="22"><INPUT TYPE="text" NAME="Price_Member" SIZE="20" MAXLENGTH="50" ></TD>
<TD width="25%" height="22">Price Guests</TD><TD width="25%" height="22"><INPUT TYPE="text" NAME="Non_Member_Price" SIZE="20" MAXLENGTH="50" ></td>
</TR>
<TR>
<TD width="25%" height="90">Type of event, Open to the public or Private</td>
<TD width="25%" height="90"><input type="radio" Name="Event_type" Value="Y" checked>Open<BR>
<input type="radio" Name="Event_type" Value="N">Private<p>&nbsp;</p>
<p><BR>

</td>
<TD width="25%" height="90">Publish Priority number of days before reservation
date.</td>
<TD width="25%" height="90">
<INPUT type="radio" Name="Event_priority" Value="7" checked>7
<input type="radio" Name="Event_priority" Value="14">14
<input type="radio" Name="Event_priority" Value="21">21
<input type="radio" NAME="Event_priority" Value="28">28
<input type="radio" name="Event_priority" value="90">90
<input type="radio" name="Event_priority" value="120">120
<input type="radio" name="Event_priority" value="240">240<br>
</TD></TR>    
<TR><td COLSPAN = "4" width="100%" height="19">
<CENTER><B><I>Recurring Event Parameters</I></B></CENTER></TR>
<TR><td width="25%" height="69">Generate From Date</td>


<TD width="25%" height="69">     Month
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

	<SELECT NAME="gen_from_year" SIZE="1" >
         <OPTION VALUE="2002-">2002
    <option value="2003-">2003
    <option value="2004-">2004>
	</select>
</td>
<td width="25%" height="69">Generate To Date</td>
<TD width="25%" height="69">     Month
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

	<SELECT NAME="gen_to_year" SIZE="1" >
         <OPTION VALUE="2002-">2002
    <option value="2003-">2003</option>
    <option value="2004-">2004</option>
	</select>
</td>
</tr>
<tr>
<Td width="25%" height="147"> Day of week</td>
<Td width="25%" height="147"><input type="radio" Name="DOWR" Value="Mon">Monday<BR>
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





<tr><TD colspan = "4" width="100%" height="26">
<CENTER><input TYPE="submit" NAME="Submit" VALUE="Submit Form" size="20"  ><input TYPE="Button"
 NAME = "Clear" VALUE = "Reset Form" 
onclick ="clear_form(this.form)"></CENTER></TD>
</TR>
</table>

	
</FORM>



</BODY>
</HTML>