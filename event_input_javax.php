<?php
/** @package

        event_input_javax.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 5/4/2003 9:19:51 PM
	Last change: FJC 10/23/2005 3:57:19 PM
*/

include("../cgi-bin/connect.inc");
function get_select_org($select_org){
    $get_sql = "select * from entryControl where select_org =\"$select_org\" ";
    $get_result = mysql_query($get_sql);
    if ( !$get_result ){
        print("<br /> invalid search organization " . $get_sql );
        exit;
        }
        $row = mysql_fetch_array($get_result);
        $resultx = $row['select_phrase'];
        $resultx = html_entity_decode($resultx);
        return  $resultx;

}// end of get select_org function
function get_page_title($select_org){
    $get_sql = "select * from entryControl where select_org =\"$select_org\" ";
    $get_result = mysql_query($get_sql);
    if ( !$get_result ){
        print("<br /> invalid search organization " . $get_sql );
        exit;
        }
        $row = mysql_fetch_array($get_result);
        $resultx = $row['heading_text'];
        $resultx = html_entity_decode($resultx);

        return  $resultx;

}// end of get page title function

function get_post_credit($select_org){
    $get_sql = "select * from entryControl where select_org =\"$select_org\" ";
    $get_result = mysql_query($get_sql);
    if ( !$get_result ){
        print("<br /> invalid search organization " . $get_sql );
        exit;
        }
        $row = mysql_fetch_array($get_result);
        $resultx = $row['post_credit'];
        $resultx = html_entity_decode($resultx);

        return  $resultx;

}// end of get post credit

function get_allow_recurring($select_org){
    $get_sql = "select * from entryControl where select_org =\"$select_org\" ";
    $get_result = mysql_query($get_sql);
    if ( !$get_result ){
        print("<br /> invalid search organization " . $get_sql );
        exit;
        }
        $row = mysql_fetch_array($get_result);
        $resultx = $row['recurring_allowed'];
        $resultx = html_entity_decode($resultx);

        return  $resultx;

}// end of get allow recurring

function get_credit($select_org){
    $get_sql = "select * from entryControl where select_org =\"$select_org\" ";
    $get_result = mysql_query($get_sql);
    if ( !$get_result ){
        print("<br /> invalid search organization " . $get_sql );
        exit;
        }
        $row = mysql_fetch_array($get_result);
        $resultx = $row['credit'];
        $resultx = html_entity_decode($resultx);

        return  $resultx;

}// end of get post credit



    $page_title = "&nbsp;Post Club Event Information";
    $confirm=FALSE;
    $year_1 = date('Y');
    $year_2 = $year_1 +1;
    $year_3 = $year_1 +2;
    $this_month=date('m');
    $this_day = date('d');
    $this_year = date('Y');
    $timestamp = mktime(0,0,0, (int)$this_month ,(int)$this_day +3 ,(int)$this_year);

    $this_day = date('d',$timestamp);
    $this_month = date('m',$timestamp);;
    $this_year = date('Y',$timestamp);

    $months= array("January","February","March","April","May","June","July","August","September","October","November","December");
    for ($i=1;$i<13;++$i)
    {
     $i== $this_month  ? $sel="selected" : $sel="";

     $month_option[$i]= $sel . ">" . $months[$i-1];
   //  print("<br /> $month_option[$i]");

    }
    for ($j=1;$j<32;$j++)
    {
        $j==$this_day ? $sel="selected" :$sel="";
        $day_option[$j] = $sel .">" . $j;
  //      print("<br /> $day_option[$j]");



    }
    $sql = "select * from orgs";

    if ( isset($select_org) )  {
        $confirm=TRUE;
   $sql .= " " . get_select_org($select_org). " ";
   $page_title = get_page_title($select_org);
   $post_credit_value = get_post_credit($select_org);
   $credit_value = get_credit($select_org);
   $allow_recurring_value = get_allow_recurring($select_org);
    }

    $sql .= " order by Org_name ";
 //   print("<br /> " . $sql);
    $result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to cauleyfrank@gmail.com" . mysql_error() . " </p>");
	 		exit;
     		}
?>



<HTML>
<HEAD>


<TITLE>Club event input screen</TITLE>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<meta name="VI60_defaultClientScript" content="JavaScript">
	<script type="text/javascript" src="../markitup/markitup/jquery.js"></script>
	<script type="text/javascript" src="../markitup/markitup/jquery.markitup.js"></script>
	<script type="text/javascript" src="../markitup/markitup/sets/html/set.js"></script>
	<script type="text/javascript" >
   $(document).ready(function() {
      $(".markItUp").markItUp(mySettings);
   });

</script>
<Script language=Javascript>
<!--  Hide script from older browsers
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
	//showDebug()
	var foundError = false;
	var Radio_state = "   ";
	re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	
	dayName = new Array ("SUN","MON","TUE","WED","THU","FRI","SAT");
	fromdate=convert_selection_to_date(form.From_mm,form.From_day,form.From_year)

      //  debug("Form allow recurring value is " + form.allow_recurring.value)
     //  debug("Recurring checked is " + form.action[1].checked)
//		//alert("the value of allow recurring is " + form.allow_recurring.value );
//        if ( form.allow_recurring.value == "N" && form.action[1].checked ){
//            alert("Recurring events will not be generated. \n"
//			+ "If this is a recurring event, enter the first event in the series \n"
//			+ " then send a separate email to events\@graypluswhite.com and explain \n"
//			+ " the frequency and start and end date.");
//            form.action[0].focus()
//            return false
//            }

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


        //  if (form.action[1].checked){
//	     	alert("Recurring events cannot be multi day events")
//	     	form.To_mm.focus()
//	     	return false
//	     } // end of if
        }
        debug("end of test to date")
        // end of test to date

        debug("about to check dow")

	// Test day of week selection
		var i=form.Dow.selectedIndex
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
		
		//if (rdays_between != 0 && form.action[1].checked){
//	     	alert("Recurring events cannot have reserve dates")
//	     	form.Reserve_mm.focus()
//	     	return false
//
//	 }

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
                        form.email.value.length
        debug(" Length of place field is " + lengthOfPlace)
            if ( lengthOfPlace > 255 ){
                reduceBy = 256-lengthOfPlace
                alertString = "The total length of the place field is too large \n"
                alertString = alertString + " reduce it by " + reduceBy + " positions"

                alert(alertString)
                form.directions.focus()
                return false
                }
         //check activity
        lengthOfActivity = form.activity.value.length +
                           form.activity_contact.value.length;
		debug("Length of activity is " + lengthOfActivity)
		
        if ( lengthOfActivity > 255 ){
		reduceBy = 256-lengthOfActivity
                alertString = "The total length of the activity field is too large \n"
                alertString = alertString + " reduce it by " + reduceBy + " positions"

                alert(alertString)
				form.activity.focus()
				return false
		}
  		if((lengthOfActivity + form.media.value.length)<10)
		{
			alert("Both activity and media are blank!!");
			form.activity.focus();
			return false
		}
  
	return true


}  // end of check_page


// Check for blank field
function isFieldBlank(theField) {
	if (theField.value.length == 0){
	     return true;
	}else{
	     return false;

	}
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
<style type="text/css">
<!--
.style1 {
	font-size: large;
	font-weight: bold;
	color:#FF0000;
	
}
-->
</style>
</HEAD>

<BODY>
<H1 align="center"><img src="whtw/graypluswhitebannereventMaint.jpg" width="468" height="60"></H1>

  <?=$page_title?>


<Form onSubmit="return check_page(this)" action ="http://www.graypluswhite.com/whtw/event_handle.php"  name="form" method="post">
<input type="hidden" name="action" id="action" value="add">
<Table Align = "left" Border= "1" Width = "731" height="1717">
<input type="hidden" name="confirm" id="confirm" value="<?=$confirm?>">
<input type="hidden" name="select_org" id="select_org" value="<?=$select_org?>">
<input type="hidden" name="insert_credit" id="insert_credit" value="<?=$post_credit_value?>">
<input type="hidden" name="allow_recurring" id="allow_recurring" value="<?=$allow_recurring_value?>">
<input type="hidden" name="credit_inserted" id="credit_inserted" value="N">
<input type="hidden" name="credit_value" id="credit_value" value="<?=$credit_value?>">
<TR >
<td width="103" height="22">Your Identification: (email)</td>
<TD width="257" height="22">
 
	<input type="text" name="emailid" size="40" ></td>
<TD width="126" height="22" >Password</TD>
<TD width="217" height="22">	

<input type="password" name="yourpswd" size="8"></TR>
<TR >
<td width="103" height="23">Organization Name: </td>
<TD width="257" height="23">
 
<SELECT NAME="Org" size="1" >
	<option value= "    " selected>Select an organization
<?php
while ($row=mysql_fetch_array($result)){
 ?>
 <OPTION VALUE="<?=$row['Org_num']?>"><?=$row['Org_name']?>
 <?
}
?>
	 </select></td>
<TD width="126" height="23" >Event Title </TD>
<TD width="217" height="23"><input name="event_title" type="text" id="event_title" size="30" maxlength="40"></td>
</TR>
<TR>
<TD width="103" height="67">Date From :</TD>
<TD width="257" height="67"><select name="From_mm" size="1">
  <option value="01-">01</option>
  <option value="02-">02</option>
  <option value="03-">03</option>
  <option value="04-">04</option>
  <option value="05-">05</option>
  <option value="06-">06</option>
  <option value="07-">07</option>
  <option value="08-">08</option>
  <option value="09-">09</option>
  <option value="10-">10</option>
  <option value="11-">11</option>
  <option value="12-">12</option>
</select>
  <BR>
  <select name = "From_day" size = "1" >
    <option value="01">01
    <option value="02">02
    <option value="03">03
    <option value="04">04
    <option value="05">05
    <option value="06">06
    <option value="07">07
    <option value="08">08
    <option value="09">09
    <option value="10">10
    <option value="11">11
    <option value="12">12
    <option value="13">13
    <option value="14">14
    <option value="15">15
    <option value="16">16
    <option value="17">17
    <option value="18">18
    <option value="19">19
    <option value="20">20
    <option value="21">21
    <option value="22">22
    <option value="23">23
    <option value="24">24
    <option value="25">25
    <option value="26">26
    <option value="27">27
    <option value="28">28
    <option value="29">29
    <option value="30">30
    <option value="31">31
    </select>
  <BR>
	 <select name="From_year" size="1" >
	   <option value="<?echo $year_1?>-"><?echo $year_1?> </option>
	   <option value="<?echo $year_2?>-"><?echo $year_2?> </option>
	   <option value="<?echo$year_3?>-"><?echo$year_3?> </option>
        </select></td>
<TD width="126" height="67">To Date :</td>
<td width="217" height="67"> 
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
	 <select name="To_year" size="1" >
       <option value="   " selected>N/A
         <option value="<?=$year_1?>-">
       <?=$year_1?>
       <option value="<?=$year_2?>-">
         <?=$year_2?>
       <option value="<?=$year_3?>-">
         <?=$year_3?>
         </option>
     </select></td>
</tr>
<TR>
<TD width="103" height="67">Reserve By:</TD>
<TD width="257" height="67">
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
<TD  ColSpan = "2" height="67"> <b>If advance reservations are necessary</b></TD>
</TR>
<TR>
<TD width="103" height="69">Start Time</TD><TD width="257" height="69">
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
<td width="126" height="69">End Time:</td><td width="217" height="69">
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
<TR><td width="103" height="23">Day of Week :</td><td width="257" height="23">
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
	</SELECT>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
  <td width="103" height="68"><strong>Place</strong> :Be specific supply all the information so that the readers can find the location using the various mapping programs. Address and zip code are important. </td>

  <td height="68" COLSPAN="3" valign="top">
  Place Name <input type="text" name="place_name" size="40">
  Address <input type="text" name="place_address" size="24"><br/>
  City <input type="text" name="city" size="24">
  State <input type="text" name="state" size="2" value ="MI">
  Postal Code <input type="text" name="zip" size="9">
  Phone <input type="text" name="phone" size="14">
   <br/>
  URL <input type="text" name="url" size="40">
  email <input type="text" name="email" size="40"><br/>
  Directions:<br/>
  <textarea rows="3" cols="85" name="directions"
  onKeyUp="document.form.count_directions.value=document.form.directions.value.length-2;">
  </textarea>
  <br/>
  Directions max 220
  <input type="text" name="count_directions" value="0" size="4" readonly></td>
</tr>
<tr>
  <td width="103" height="195"> <strong>Event or Activity</strong> :This is the text that is displayed on the what's happening this week page. Do not put more than 255 characters in this field. </TD>
  <td colspan ="3" valign="top" ><p>
    <textarea rows="4" class="markItUp" name="activity" cols="80"
   onKeyUp="document.form.count_activity.value=document.form.activity.value.length -4;">

    </textarea>
    <br/>
    
    Contact: 
    <input type="text" name="activity_contact" size="40">
  </p>
    <p>Activity  max 235
      <input type="text" name="count_activity" value="0" size="4" readonly>    
        </p></TD>
</tr>

<tr>
<td colspan="4"><strong>Press Release Information:</strong><br>
The press isn't interested in helping you make your event a success. They are looking for a story that will be interesting to their readers and pleasing to the edirors. Take your ego out of it. Look at your event as a story. Take your natural inclination to sell, sell, sell out of it. Look at your story with a cold, objective eye.<br>
Write it in the third person . pretend that you are a reporter. <br>
Do <strong>Not</strong> repeat the place, Time and date information in the Media text box (The system will insert it) </td>
</tr>
<tr>
  <td width="103"><strong>Media Text </strong>::This is the text that appears in the Peggy Jo Studio newsletter.It can be more verbose than the event information but use restraint Repeat any pertinent information from the activity box because both boxes will not displayed. If this box is blank, then the information in the event box will be used in the Peggy Jo Studio newsletter. If this box is not blank, only the information in this box will be displayed in the Peggy Jo Studio Newsletter </td>
  <td colspan ="3" valign="top" ><textarea name="media" class="markItUp"cols="100" rows="25" wrap="off"
   onKeyUp="document.form.count_media.value=document.form.media.value.length -4;">

  </textarea>
    <br/></tr>
<TR><td width="103" height="22">Price Members :</td><TD width="257" height="22"><INPUT TYPE="text" NAME="Price_Member" SIZE="20" MAXLENGTH="20" ></TD>
<TD width="126" height="22">Price Guests</TD><TD width="217" height="22"><INPUT TYPE="text" NAME="Non_Member_Price" SIZE="20" MAXLENGTH="20" ></td>
</tr>
<tr>
<td width="103" height="90">Type of event, Open to the public or Private</td>
<td width="257" height="90"><input type="radio" Name="Event_type" Value="Y" checked>Open<BR>
<input type="radio" Name="Event_type" Value="N">Private<p>&nbsp;</p>
<p><BR>
</td>
<td width="126" height="90">Publish Priority number of days before reservation 
date.</td>
<td width="217" height="90">
<input type="radio" name="Event_priority" value="7" checked>7
<input type="radio" name="Event_priority" value="14">14
<input type="radio" name="Event_priority" value="21">21
<input type="radio" name="Event_priority" value="28">28
<input type="radio" name="Event_priority" value="90">90
<br>
<input type="radio" name="Event_priority" value="120">120
<input type="radio" name="Event_priority" value="240">240<br></td></tr>  
<tr><td colspan = "4" height="19">
<center>
  <span class="style1">If this a recurring event, just enter it once and contact the webmaster at cauleyfrank@gmail.com to specify the recurring options.  </span>
</center></tr>






<tr><td colspan = "4" height="26">
<center><input type="submit" name="Submit" value="Submit Form" size="20"  ><input type="Button"
 name = "Clear" value = "Reset Form" 
onclick ="clear_form(this.form)"></CENTER></TD>
</tr>
</table>

	
</FORM>
<script language=javascript>

<!--  Hide script from older browsers

	form.emailid.focus()
	//-->

</script>	


</body>
</html>