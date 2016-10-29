
<?php
$select_org= isset($_GET['select_org']) ? $_GET['select_org'] : 'All';
$use_profile = isset($_GET['use_pofile']) ? $_GET['use_profile'] : 'false';
$operator = isset($_GET['operator']) ? $_GET['operator'] : 'publicist';
$confirm = $_GET['confirm'];
$dbg = $_GET['dbg'];
require_once("../cgi-bin/connect.inc");
require_once($_SERVER['DOCUMENT_ROOT'] ."/stylesheets/Forms.css");
require_once($_SERVER['DOCUMENT_ROOT'] ."/phpClasses/Class_publicist.php");
$pub = new publicist;

    $page_title = "Post Club Event Information";
    $confirm=FALSE;
    $year_1 = date(Y);
    $year_2 = $year_1 +1;
    $year_3 = $year_1 +2;
    $this_month=date(m);
    $this_day = date(d);
    $this_year = date(Y);
    $timestamp = mktime(0,0,0, (int)$this_month ,(int)$this_day +3 ,(int)$this_year);

    $this_day = date(d,$timestamp);
    $this_month = date(m,$timestamp);;
    $this_year = date(Y,$timestamp);

    $months= array("January","February","March","April","May","June","July","August","September","October","November","December");
    for ($i=1;$i<13;++$i)
    {
     $i== $this_month  ? $sel="selected" : $sel="";
     $month_option[$i]= $sel . ">" . $months[$i-1];
     //print("<br /> $month_option[$i]");

    }
    for ($j=1;$j<32;$j++)
    {
        $j==$this_day  ? $sel="selected" : $sel="";
        $day_option[$j] = $sel   .' >' . $j;
       // print("<br /> $day_option[$j]");



    }
    

    if ( isset($select_org) )  {
   $confirm=TRUE;
   $sql = " " . $pub->get_select_org($select_org). ' order by Org_name ';
   
   
   $page_title = $pub->get_page_title($select_org);
   $post_credit_value = $pub->get_post_credit($select_org);
   $credit_value = $pub->get_credit($select_org);
   $allow_recurring_value = $pub->get_allow_recurring($select_org);
   $allow_update_value = $pub->get_allow_update($select_org);
    }

   
 //   print("<br /> " . $sql);
    $result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to webmaster@graynwhite.com" . " " . $sql . " " . mysql_error() . " </p>");
	 		exit;
     		}
?>



<html xmlns="http://www.w3.org/1999/xhtml">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<HEAD>


<TITLE>Club event input screen</TITLE>

<meta name="VI60_defaultClientScript" content="JavaScript">
<script src="../javascript/ajaxBasics.js" type="text/javascript"></script>
<script src="../javascript/typeAhead.js" type="text/javascript"></script>
<link href="../javascript/typeAhead.css" rel="stylesheet" type="text/css" />
<link href="./event_input.css" rel="stylesheet" type="text/css" />


<Script language=Javascript>
function checkJavaScriptValidity() 

{

document.getElementById("jsEnabled").style.visibility = 'visible';

document.getElementById("jsDisabled").style.visibility = 'hidden';

}

function callForChange()
{   
for (var i=0; i < document.formInput.action.length; i++)
   {
   if (document.formInput.action[i].checked)
      {
      var rad_val = document.formInput.action[i].value;
      }
   }

	if(rad_val == 'makeChange')
	{
  		var ans = confirm("Do you want to change any events for this organization ?");
		if(!ans)
			{
			alert("Change the action selection from \"make a change \"to \"Add an event\" in the box above and then continue.");
			document.formInput,actiom.focus();
			}else
			{
			document.location.href="http://www.graynwhite.com/whtw/eventMaintenanceC.php?select_org=" + document.formInput.Org.value;	
			}
	}
 
	
}
  // Show the debug window
function showDebug() {
  window.top.debugWindow =window.open("","Debug","left=0,top=0,width=300,height=700,scrollbars=yes," + "status=yes,resizable=yes");
  window.top.debugWindow.opener = self;
  // open the document for writing
  window.top.debugWindow.document.open();
  window.top.debugWindow.document.write(
      "<HTML><HEAD><TITLE>Debug Window</TITLE></HEAD><BODY><PRE>\n");
}

// If the debug window exists, then write to it
function debug(text) {
  if (window.top.debugWindow && ! window.top.debugWindow.closed) {
   // $datetime_array = getdate();
  //  window.top.debugWindow.document.write("Current Time: "+$datetime_array{hours}+":"+$datetime_array{minutes}+"\n");
    window.top.debugWindow.document.write(text+"\n");
  }
}

// If the debug window exists, then close it
function hideDebug() {
  if (window.top.debugWindow && ! window.top.debugWindow.closed) {
    window.top.debugWindow.close();
    window.top.debugWindow = null;
  }
}

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
        return false
}
function check_page(form){
        
		// showDebug();
	
	
	var foundError = false;
	var Radio_state = "   ";
	re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	
	dayName = new Array ("SUN","MON","TUE","WED","THU","FRI","SAT");
	fromdate=convert_selection_to_date(form.From_mm,form.From_day,form.From_year)

        debug("Form allow recurring value is " + form.allow_recurring.value)
        if ( form.allow_recurring.value == "N" && form.action[1].checked ){
            alert("Recurring events will not be generated. \n"
			+ "If this is a recurring event, enter the first event in the series \n"
			+ " then send a separate email to events\@graynwhite.com and explain \n"
			+ " the frequency and start and end date.");
            form.action[0].focus()
            return false
            }

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
	if (form.event_title.value == '')
		{
		alert("The event title is now required.")
		form.event_title.focus();
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

	if (event_date < test_date)
	{
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
        debug("Event date and to date checked out " + event_date)

        if(form.To_mm.selectedIndex != 0){
	 
	 
	    if (form.To_day.selectedIndex == 0 || form.To_year.selectedIndex == 0){
	       alert("To Date not complete")
	       form.To_mm.focus()
	       return false
      	   }
        }
        debug("about to check out to date")

         if ( form.To_mm.selectedIndex != 0 ){
	 todate=convert_selection_to_date(form.To_mm,form.To_day,form.To_year)
         days_between = daysbetween(fromdate,todate)
           
		if (days_between < 0  ) {
			alert("To date is less than from Date")
			form.To_mm.focus()
	                return false
	     }     // end of if
		

          if (form.action[1].checked){
	     	alert("Recurring events cannot be multi day events")
	     	form.To_mm.focus()
	     	return false
	     } // end of if
        }
        debug("end of test to date")
        // end of test to date

        debug("about to check dow")

	// Test day of week selection
		var i=form.Dow.selectedIndex;
		debug("form dow index is " +i );
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
		debug("Check computed DOW and Selected DOW");
	             var from_dow = dayName[fromdate.getDay()];
				 debug("computed day is " + from_dow);
				 debug("Selected day of week is " + form.Dow.options[i].value);
				 debug("To_mm index is " + form.To_mm.selectedIndex );
                  if(form.Dow.options[i].value!=from_dow && form.To_mm.selectedIndex==0)
				  {
				  debug("Day of week not set correctly");
				  var alert_message = "The day of week that you selected does not agree with the computed day of week.";
				  
				  alert_message += "\n you selected  "   + form.Dow.options[i].value;
				  alert_message += "\n  however, the computed day of week is ";
				   alert_message += from_dow ;
				   alert_message += "\n  Change the selected day of week or change the date.";
				   debug("value of alert message is " + alert_message);
				alert(alert_message);
				
				
				form.Dow.focus() 
				return false
				}
			
        
        debug("about to check reserve date index is " + form.Reserve_mm.selectedIndex)

        if(form.Reserve_mm.selectedIndex == 0){
	    if (form.Reserve_day.selectedIndex != 0 || form.Reserve_year.selectedIndex != 0){
	       alert("Reserve date is not correct");
	       form.Reserve_mm.focus()
	       return false
	    } //end of if
	  
	 } // 
	 // check reserve date
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

          debug("Reserve date ok")
	 } // end of check reserve date

        debug("starting to check out start time")
	if(form.Start_Time_Hours.selectedIndex == 0){
	    if (form.Start_Time_Minutes.selectedIndex != 0 || form.Start_AMPM.selectedIndex != 0 ){
	       alert("Start Time not correct")
	       form.Start_Time_Hours.focus()
	       return false
	    }
	 } 
	 debug("Start date well formed")

	 if(form.Start_Time_Hours.selectedIndex != 0){
	    if (form.Start_Time_Minutes.selectedIndex == 0 || form.Start_AMPM.selectedIndex == 0){
	       alert("Start time not ampm correct");
	       form.Start_Time_Hours.focus()
	       return false
	    }
	}
         debug("Checking time to ")
	if(form.To_Time_Hours.selectedIndex == 0){
	    if (form.To_Time_Minutes.selectedIndex != 0 || form.To_AMPM.selectedIndex != 0 ){
	       alert("To  Time not correct");
	       form.To_Time.focus()
	       return false
	    }
	 } 
	 debug("Time to well formed")

	 if(form.To_Time_Hours.selectedIndex != 0){
	    if (form.To_Time_Minutes.selectedIndex == 0 || form.To_AMPM.selectedIndex == 0){
	       alert("To Time AMPM not correct")
	       form.To_Time.focus()
	       return false
	  	  }
		}

	// check place 
        debug("Starting to check out place")
	if (form.place_name.value == ""){
		alert("Place name  is blank")
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
        debug(" Length of place field is " + lengthOfPlace)
            if ( lengthOfPlace > 255 ){
                reduceBy = 256-lengthOfPlace
                alertString = "The total length of the place field is too large \n";
                alertString = alertString + " reduce it by " + reduceBy + " positions.";
				
                alert(alertString)
                form.directions.focus()
                return false
                }
        // check activity
		debug("Checking activity");
		
	if (form.activity.value == ""){
		alert("Event is blank")
		form.activity.focus()
		return false
	}
        lengthOfActivity = form.activity.value.length +
                           form.activity_contact.value.length
        if ( form.insert_credit.value=="Y" && form.credit_inserted.value != "N"){
            lengthOfActivity = lengthOfActivity + form.credit_value.value.length +10
            }
        debug("Length of activity is " + lengthOfActivity)
        if ( lengthOfActivity > 255 ){
            reduceBy = 256 - lengthOfActivity
            alertString = "Activity too large reduce by " + reduceBy + " positions" ;
			alertString += "\n Alternatively, you can copy and paste the activity into the";
				alertString += "\n media block before reducing the activiy length.";
				alert(alertString);
            form.activity.focus()
            return false
			}
			if ( lengthOfActivity < 20)
			{
			var cont= confirm("Activity is only " + lengthOfActivity + " positions long! Do you want to continue?"); 
			debug("value of continue is " + cont );
			if (cont == false)
				{
				form.activity.focus();
				return false;
				}
            }
          if ( form.insert_credit.value == "Y" && form.credit_inserted.value == "N" ){
            form.activity.value = form.activity.value + " submitted by : " + form.credit_value.value
            form.credit_inserted.value = "Y"

            }
            debug("activity is " + form.activity.value)
	// check recurring
        debug("at check recurring")

	if (form.action[1].checked){
		fromdate=convert_selection_to_date(form.From_mm,form.From_day,form.From_year)
		recurstart=convert_selection_to_date(form.gen_from_mm,form.gen_from_day,form.gen_from_year)
		recurend=convert_selection_to_date(form.gen_to_mm,form.gen_to_day,form.gen_to_year)
		days_between = daysbetween(fromdate,recurstart)
		
		if (days_between<0){
			alert("Recurrring date start should be equal to or greater than the event date")
			form.gen_from_mm.focus()
			return false
		}
		
		days_between=daysbetween(recurstart,recurend)
                recurring_days = days_between
		debug("days between Recur Start and Recur end is " + recurring_days )

		if (days_between<1){
			alert("Recurring date end must be greater than recurring date start")
			form.gen_to_mm.focus()
			return false
		}
		debug("Checking the number of days selected")
		dowrcnt=0
		for(i=0;i<form.DOWR.length;i++){
			if(form.DOWR[i].checked){
			dowrcnt++
			} // end of if
		} // end of for

		 debug("Day of week count is " + dowrcnt);

		if (dowrcnt==0){
			alert("A day of the week must be selected for a recurring event")
			form.DOWR[0].focus()
			return false
			}
                if (dowrcnt> 1){
			alert("Only one day of the week can  be selected for a recurring event")
			form.DOWR[0].focus()
			return false
			}
		weekcnt=0
		for(i=0;i<form.week.length;i++){
			if(form.week[i].checked){
			weekcnt++
			} //end of if
		} // end of for
		debug("Week Count is " + weekcnt);
		if(weekcnt==0){
			alert("At least one selection for week of the month must be checked")
			form.week[0].focus()
			return false
		}



		iterationsPerMonth = weekcnt * dowrcnt;
                debug("iterations per month  is " + iterationsPerMonth);
                noOfMonthsSelected = Math.round(recurring_days/30)
                debug("Number of months  selected is " + noOfMonthsSelected)
                numberOfEvents = noOfMonthsSelected *  iterationsPerMonth
                debug("Number of events to be generated is " + numberOfEvents)
                if ( numberOfEvents > 15 ){
                    alert("Too many Events Maximum of 15 you selected " + numberOfEvents)
                    form.gen_from_mm.focus()
                    return false
                    }
	}	// end of check recurring


        debug("at the end of check recurring")
	return true


}  // end of check_page

// Check for blank field
//function isFieldBlank(theField) {
//	if (theField.value.length == 0){
//	     return true;
//	}else{
//	     return false;
//
//}
//}
// make array
function MakeArray(n){
	this.length = n;
	for (var i = 1;i <=n; i ++){
	 this[i] = 0}
	return this
}	

//-->

</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="http://www.graynwhite.com/whtw/event_input.css" rel="stylesheet" type="text/css" />
</HEAD>
<noscript>
<meta HTTP-EQUIV="REFRESH" content="0; url=http://www.graynwhite.com/testForJavascript.php?prgName=Event Input&alt=../whtw/event_mail.php&prg=../whtw/event_input_javax_place.php?select_org=<?echo $select_org?>&operator=publicist">
</noscript>

<BODY  onload="checkJavaScriptValidity()">
<div id="jsEnabled" style="visibility:hidden">


</div>


<div id="jsDisabled">

JavaScript is disabled


</div>

<H1 align="center"><img src="graynwhitebannereventMaint.jpg" width="468" height="60"></H1>
<H1>  <?=$page_title?></H1>


<Form onSubmit="return check_page(this)" action ="http://graynwhite.com/whtw/event_handle_test.php"  name="formInput" method="post">
<Table Align = "left" Border= "1" Width = "903" height="954">
<input type="hidden" name="operator" id="operator" value="<?=$operator?>">
<input type="hidden" name="confirm" id="confirm" value="<?=$confirm?>">
<input type="hidden" name="select_org" id="select_org" value="<?=$select_org?>">
<input type="hidden" name="insert_credit" id="insert_credit" value="<?=$post_credit_value?>">
<input type="hidden" name="allow_recurring" id="allow_recurring" value="<?=$allow_recurring_value?>">
<input type="hidden" name="allow_update" id="allow_update" value="<?=$allow_update_value?>">
<input type="hidden" name="credit_inserted" id="credit_inserted" value="N">
<input type="hidden" name="credit_value" id="credit_value" value="<?=$credit_value?>">
<?
	if($operator == 'admin' ||  $allow_update_value == 'Y')
	{
	echo "<TR><TD width=\"191\" height=\"84\"  >Action</td>";
	echo "<td colspan=\"3\"  >";
	echo "Add an event <INPUT TYPE=\"radio\" NAME=\"action\" id=\"action\" value=\"Add\" CHECKED><BR>";
	echo "Add a recurring event<INPUT type=\"radio\" NAME=\"action\" id=\"action\" value=\"Recurring\"><br />";
	echo "Change an event<INPUT type=\"radio\" NAME=\"action\" id=\"action\" value=\"makeChange\"></td></TR >";
}else{
 echo "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"Add\">";
}
	
?>
<tr>
<td width="191" height="22">Your Identification: (email)</td>
<TD width="294" height="22">
 
	<input type="text" name="emailid" size="40" id="emailid" ></td>
<TD width="195" height="22" >Password</TD>
<TD width="195" height="22">	

<input type="password" name="yourpswd" size="8"></TR>
<TR >
<td width="191" height="23">Organization Name: </td>
<TD width="294" height="23" ><select name="Org" size="1"  onBlur="callForChange()">
  <option value= "    " selected>Select an organization
  <?php
while ($row=mysql_fetch_array($result)){
 ?>
  <option value="<?=$row['Org_num']?>">
  <?=$row['Org_name']?>
  <?
}
?>
</select></td >
<TD width="195" height="23" >Event Title </TD>
<TD width="195" height="23"><input name="event_title" type="text" id="event_title" size="50" maxlength="50"></td>
</TR>
<TR>
<TD width="191" height="67">Date From or Date of Event: </TD>
<TD width="294" height="67">
	 <SELECT NAME="From_mm" SIZE="1">
	<OPTION VALUE="01-"<?=$month_option[1]?>
	<OPTION VALUE="02-" <?=$month_option[2]?>
	<OPTION VALUE="03-" <?=$month_option[3]?>
	<OPTION VALUE="04-" <?=$month_option[4]?>
	<OPTION VALUE="05-" <?=$month_option[5]?>
	<OPTION VALUE="06-" <?=$month_option[6]?>
	<OPTION VALUE="07-" <?=$month_option[7]?>
	<OPTION VALUE="08-" <?=$month_option[8]?>
	<OPTION VALUE="09-" <?=$month_option[9]?>
	<OPTION VALUE="10-" <?=$month_option[10]?>
	<OPTION VALUE="11-" <?=$month_option[11]?>
	<OPTION VALUE="12-" <?=$month_option[12]?>
        </option>
	</SELECT><BR>
	
	 <Select NAME = "From_day" Size = "1" >
	 <Option value= "01" <?=$day_option[1]?>
	 <Option value= "02" <?=$day_option[2]?>
	 <Option value= "03" <?=$day_option[3]?>
	 <Option value= "04" <?=$day_option[4]?>
         <Option value= "05" <?=$day_option[5]?>
	 <Option value= "06" <?=$day_option[6]?>
	 <Option value= "07" <?=$day_option[7]?>
	 <Option value= "08" <?=$day_option[8]?>
	 <Option value= "09" <?=$day_option[9]?>
	 <Option value= "10" <?=$day_option[10]?>
         <Option value= "11" <?=$day_option[11]?>
	 <Option value= "12" <?=$day_option[12]?>
	 <Option value= "13" <?=$day_option[13]?>
         <Option value= "14" <?=$day_option[14]?>
	 <Option value= "15" <?=$day_option[15]?>
	 <Option value= "16" <?=$day_option[16]?>
         <Option value= "17" <?=$day_option[17]?>
	 <Option value= "18" <?=$day_option[18]?>
	 <Option value= "19" <?=$day_option[19]?>
         <Option value= "20" <?=$day_option[20]?>
	 <Option value= "21" <?=$day_option[21]?>
	 <Option value= "22" <?=$day_option[22]?>
	 <Option value= "23" <?=$day_option[23]?>
	 <Option value= "24" <?=$day_option[24]?>
	 <Option value= "25" <?=$day_option[25]?>
	 <Option value= "26" <?=$day_option[26]?>
	 <Option value= "27" <?=$day_option[27]?>
	 <Option value= "28" <?=$day_option[28]?>
	 <Option value= "29" <?=$day_option[29]?>
	 <Option value= "30" <?=$day_option[30]?>
	 <Option value= "31"  <?=$day_option[31]?>
	 </Select><BR>
		

	<SELECT NAME="From_year" SIZE="1" >
         <OPTION VALUE="<?=$year_1?>-" selected><?=$year_1?>
         <OPTION VALUE="<?=$year_2?>-"><?=$year_2?>
        <option value="<?=$year_3?>-"><?=$year_3?></option>
		</Select></td>
<TD width="195" height="67">To Date if a multiple day event:</td>
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
	<SELECT NAME="To_year" SIZE="1" >
	<OPTION VALUE="   " selected>N/A
	<OPTION VALUE="<?=$year_1?>-"> <?=$year_1?>
         <OPTION VALUE="<?=$year_2?>-"><?=$year_2?>
        <option value="<?=$year_3?>-"><?=$year_3?></option>
	</select></td>
</tr>
<?php
	if($operator=='admin')
	{
	?>
<TR>
  <TD height="67">&nbsp;</TD>
  <TD height="67"><label for="textfield">Blog number</label>
    <input type="text" name="blogNumber" id="blogNumber">
    <table width="200">
      <tr>
        <td><label>
<input name="BlogEntryType" type="radio" value="post" checked>          
Post</label></td>
      </tr>
      <tr>
        <td><label>
          <input type="radio" name="BlogEntryType" value="page">
          Page</label></td>
      </tr>
    </table>
    <br></td>
  <TD  ColSpan = "2" height="67"><label for="label">Final End Date</label>
    <input type="text" name="finalEndDate" id="label"></TD>
</TR>
<?php
	}
?> 
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
		

	<SELECT NAME="Reserve_year" SIZE="1" >
	<OPTION VALUE="   " selected>N/A
	<OPTION VALUE="<?=$year_1?>-"> <?=$year_1?>
         <OPTION VALUE="<?=$year_2?>-"><?=$year_2?>
        <option value="<?=$year_3?>-"><?=$year_3?></option>
	</select></td>
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
		  <select name="Dow" size="1">
            <option value="MON">Monday
            <option value="TUE">Tuesday
            <option value="WED">Wednesday
            <option value="THU">Thursday
            <option value="FRI">Friday
            <option value="SAT">Saturday
            <option value="SUN">Sunday
            <option value="N/A">Not applicable
            <option value="WK.">Week
            <option value="WE.">Week End
            <option value="mul">Multiple
            <option value="MOS">Month
          </select>
	    &nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<TR><TD width="191" height="68">Place :</TD>

  <TD COLSPAN="3" width="696" height="80">
  Place Name 
    <input name="place_name" type="text" class="formInputText" id="place_name" onDblClick="clearPlace()"onKeyUp="typeAhead(document.getElementById(this.id))"  size="40" >
    <?php
	if($operator=='admin')
	{
	?>
    <input name="place_number" type="hidden" id="place_number" value="0">
    <div id="results" class="popUp"> </div>
	<?php
	}
	?>
  Address 
  <input type="text"  class="formInputText" name="place_address" id="place_address" size="24" height="15px"><br/>
  City <input type="text" name="city" id="city" class="formInputText" size="24">
  State <input name="state" type="text" class="formInputText" id="state" value ="MI." size="5 " maxlength="5">
  Postal Code <input type="text" name="zip" class="formInputText"  id="zip" size="9">
  Phone <input type="text" name="phone" class="formInputText" id="phone" size="14">
  <br/>
  URL <input type="text" name="url" id="url" class="formInputText"  size="40">
  email <input type="text" name="place_email"  id="place_email"class="formInputText" size="40"><br/>
  Directions:<br/>
  <?php
  if($operator=='admin')
  {
  ?>
  <textarea rows="3" cols="85" class="formInputText" name="directions" id=
 "directions" onKeyUp="document.formInput.count_directions.value=document.formInput.directions.value.length-2;">
  </textarea>
  
  <span class="explanation">Action</span>
  <input name="maintain_button" type="button" id="maintain_button" onClick="maintain_places()"value="Add">
  Get posted Input <input name="getPostedButton" type="button" id="getPostedButton" onClick="getPosted()" value="Get Posted">
  <br/></td>
  <?php
  }else { ?>
 <textarea rows="3" cols="85" class="formInputText" name="directions" id=
 "directions" onKeyUp="document.formInput.count_directions.value=document.formInput.directions.value.length-2;">
  </textarea>
  <?php
  } 
  ?>
</TR>
<TR>
  <TD colspan="4">Event or activity information: This is the bare bones information. Make sure you specify a contact. <br>
    Do <strong>Not</strong> repeat the place, Time and date information in the Event or activity text box (The system will insert it) </TD>
</TR>

<TR><TD width="191"> Event or Activity :</TD>
  <TD COLSPAN ="3" width="696" >
  <textarea rows="3" name="activity" class="formInputText" cols="85"
   onKeyup="document.formInput.count_activity.value=document.formInput.activity.value.length -4;">

  </textarea><br/>

  Contact: 
  <input type="text" name="activity_contact"  id= "activity_contact" size="40"></TD>
</tr>
<TR>
  <TD colspan="4"><strong>Press Release Information:</strong> (This information is optional) <br>
The press isn't interested in helping you make your event a success. They are looking for a story that will be interesting to their readers and pleasing to the editors. Take your organization's ego out of it. Look at your event as a story. Take your natural inclination to sell, sell, sell out of it. Look at your story with a cold, objective eye. Just the facts. If the event benefits a charity say so but don't try to sell the charity.If you raised funds in the past say so. <br>
Write it in the third person . pretend that you are a reporter. <br>
Do <strong>Not</strong> repeat the place, Time and date information in the Media text box (The system will insert it) </TD>
</tr>
</TR>
<TR>
  <TD width="191">Press Release Data </TD>
  <TD COLSPAN ="3" width="696" >
  <textarea rows="6" name="media" cols="100"
   onKeyup="document.formInput.count_media.value=document.formInput.media.value.length -4;">

  </textarea><br/></tr>
<tr><td> Text lengths: Number of characters used </td>
<td>Directions max 220  <input type="text" name="count_directions" value="0" size="4" readonly></td>
<td>Activity  max 235  <input type="text" name="count_activity" value="0" size="4" readonly></td>
<td>Media Text  max 500  <input type="text" name="count_media" value="0" size="4" readonly></td>
<TR><td width="191" height="22">Hyperlink</td><TD width="294" height="22">
  <input type="text" name="reference" size="40"></TD>
<TD width="195" height="22">&nbsp;</TD><TD width="195" height="22">&nbsp;</td>
</TR>
<TR><td width="191" height="22">Price Members :</td><TD width="294" height="22"><INPUT TYPE="text" NAME="Price_Member" SIZE="20" MAXLENGTH="20" ></TD>
<TD width="195" height="22">Price Guests</TD><TD width="195" height="22"><INPUT TYPE="text" NAME="Non_Member_Price" SIZE="20" MAXLENGTH="20" ></td>
</TR>
<TR>
<TD width="191" height="90">Type of event, Open to the public or Private</td>
<TD width="294" height="90"><input type="radio" Name="Event_type" Value="Y" checked>
  Open (Guests are welcome) <BR>
<input type="radio" Name="Event_type" Value="N">
Private (Members Only)
<p>
  <?php
	if($operator=='admin')
	{
	?>
  <input name="specialOption" type="radio" value="no" id="specialOption" checked>  
Not Special
  <br> 
<input name="specialOption" type="radio" value="Trip" id="specialOption">  
Trip or Cruise
  <br>
  <input name="specialOption" type="radio" value="Reunion" id="specialOption">
  Reunion
    <br>
  <input name="specialOption" type="radio" value="Golf" id="specialOption">
  Somerset Golf
 </p>
 <?php
 }
 ?>
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
<input type="radio" name="Event_priority" value="240">240<br></TD></TR>    
<TR><td COLSPAN = "4" width="893" height="19">
<?php
	if($operator=='admin')
	{
	?>
<CENTER><B><I>Recurring Event Parameters</I></B></CENTER></TR>
<TR><td width="191" height="69">Generate From Date</td>


<TD width="294" height="69">     Month
	<SELECT NAME="gen_from_mm" SIZE="1">
	<OPTION VALUE="01-"<?=$month_option[1]?>
	<OPTION VALUE="02-"<?=$month_option[2]?>
	<OPTION VALUE="03-"<?=$month_option[3]?>
	<OPTION VALUE="04-"<?=$month_option[4]?>
	<OPTION VALUE="05-"<?=$month_option[5]?>
	<OPTION VALUE="06-"<?=$month_option[6]?>
	<OPTION VALUE="07-"<?=$month_option[7]?>
	<OPTION VALUE="08-"<?=$month_option[8]?>
	<OPTION VALUE="09-"<?=$month_option[9]?>
	<OPTION VALUE="10-"<?=$month_option[10]?>
	<OPTION VALUE="11-"<?=$month_option[11]?>
	<OPTION VALUE="12-"<?=$month_option[12]?>
	</SELECT><BR>
	  Day

         <Select NAME = "gen_from_day" Size = "1" >
	 <Option value= "01"<?=$day_option[1]?>
	 <Option value= "02"<?=$day_option[2]?>
	 <Option value= "03"<?=$day_option[3]?>
	 <Option value= "04"<?=$day_option[4]?>
         <Option value= "05"<?=$day_option[5]?>
	 <Option value= "06"<?=$day_option[6]?>
	 <Option value= "07"<?=$day_option[7]?>
	 <Option value= "08"<?=$day_option[8]?>
	 <Option value= "09"<?=$day_option[9]?>
	 <Option value= "10"<?=$day_option[10]?>
         <Option value= "11"<?=$day_option[11]?>
	 <Option value= "12"<?=$day_option[12]?>
	 <Option value= "13"<?=$day_option[13]?>
         <Option value= "14"<?=$day_option[14]?>
	 <Option value= "15"<?=$day_option[15]?>
	 <Option value= "16"<?=$day_option[16]?>
         <Option value= "17"<?=$day_option[17]?>
	 <Option value= "18"<?=$day_option[18]?>
	 <Option value= "19"<?=$day_option[19]?>
         <Option value= "20"<?=$day_option[20]?>
	 <Option value= "21"<?=$day_option[21]?>
	 <Option value= "22"<?=$day_option[22]?>
	 <Option value= "23"<?=$day_option[23]?>
	 <Option value= "24"<?=$day_option[24]?>
	 <Option value= "25"<?=$day_option[25]?>
	 <Option value= "26"<?=$day_option[26]?>
	 <Option value= "27"<?=$day_option[27]?>
	 <Option value= "28"<?=$day_option[28]?>
	 <Option value= "29"<?=$day_option[29]?>
	 <Option value= "30"<?=$day_option[30]?>
	 <Option value= "31"<?=$day_option[31]?>
	 </Select><BR>
	 Year	


    	<SELECT NAME="gen_from_year" SIZE="1" >
         <OPTION VALUE="<?=$year_1?>-" selected><?=$year_1?>
         <OPTION VALUE="<?=$year_2?>-"><?=$year_2?>
        <option value="<?=$year_3?>-"><?=$year_3?></option>
		</Select></td>
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


   <SELECT NAME="gen_to_year" SIZE="1" >
         <OPTION VALUE="<?=$year_1?>-" selected><?=$year_1?>
         <OPTION VALUE="<?=$year_2?>-"><?=$year_2?>
        <option value="<?=$year_3?>-"><?=$year_3?></option>
		</Select></td>
</tr>
<tr>
<Td width="191" height="147"> Day of week</td>
<Td width="294" height="147"><input type="radio" Name="DOWR" Value="Mon">Monday<BR>
<input type="radio" Name="DOWR" Value="Tue">Tuesday<BR>
<input type="radio" Name="DOWR" Value="Wed">Wednesday<BR>
<input type="radio" Name="DOWR" Value="Thu">Thursday<BR>
<input type="radio" Name="DOWR" Value="Fri">Friday<BR>
<input type="radio" Name="DOWR" Value="Sat">Saturday<BR>
<input type="radio" Name="DOWR" Value="Sun">Sunday<BR></Td>
<td width="195" height="147">Week of the Month</td>
<td width="195" height="147"><input type="checkbox" Name="week" value="First">First<BR>
<input type="checkbox" Name="week" value="Second">Second<BR>
<input type="checkbox" Name="week" value="Third">Third<BR>
<input type="checkbox" Name="week" value="Fourth">Fourth<BR>
<input type="checkbox" Name="week" value="Fifth">Fifth<BR>
<input type="checkbox" Name="week" value="Alternate">Alternate<BR></td>
</tr>




<?php
}
?>
<tr><TD colspan = "4" width="893" height="26">
<CENTER><input TYPE="submit" NAME="Submit" VALUE="Submit Form" size="20"  ><input TYPE="Button"
 NAME = "Clear" VALUE = "Reset Form" 
onclick ="clear_form(this.form)"></CENTER></TD>
</TR>
</table>

	
</FORM>



</BODY>
</HTML>