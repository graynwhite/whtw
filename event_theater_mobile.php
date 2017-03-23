<?php
$file_to_read="theaterVenues.xml";
$xml =  simplexml_load_file($file_to_read) or die("Unable to load file");

$listbox="<div data-role=\"fieldcontain\">
    <label for=\"selectmenu\" class=\"select\">Options:</label>
    <select name=\"selectmenu\" id=\"selectmenu\">";
	$listbox.="<option value=select a venue or trip sponsor>Select a theater venue or trip sponsor</option>";
	
	foreach($xml as $element):
	$groupName=urlencode($element->venueName);
	$groupNameRaw=$element->venueName;
	
	$listbox .="<option value=". $groupName . ">". $groupNameRaw ."</option>/n" ;
	
	endforeach;
	$listbox.="</select></div>";
	
	
	
	$file_to_read="tripSponsors.xml";
	$xml =  simplexml_load_file($file_to_read) or die("Unable to load file");
	
	$tripbox="<div data-role=\"fieldcontain\">
	<label for=\"tripmenu\" class=\"select\">Options:</label>
	<select name=\"tripmenu\" id=\"tripmenu\">";
	$tripbox.="<option value=select a sponsor>select a sponsor</option>/n";
	
	foreach($xml as $element):
	$tripName=urlencode($element->sponsorname);
	$tripNameRaw=$element->sponsorname;
	
	$tripbox .="<option value=". $tripName . ">". $tripNameRaw ."</option>/n" ;
	
	endforeach; 
	$tripbox.="</selct></div>";
	
?>
<!DOCTYPE html> 
<html><head>

	<title>Theater Event Input Mobile</title>
	<meta name="viewport" content="width=device-width, user-scalable=yes" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/template.css" />
	<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/validationEngine.jquery.css" />
	<link rel="stylesheet" href="mobile.css"/>
	
		
		
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/jquery-1.8.2.min.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/languages/jquery.validationEngine-en.js"></script>
		<script src="http://www.graypluswhite.com/jqvaleng/js/jquery.validationEngine.js"></script>
		<script src="http://www.graypluswhite.com/dough/Dough/dough.min.js"></script>
<script>		
	$(document).ready(function(){
  jQuery("#formInput").validationEngine(
  { 'custom_error_messages':
  {'#Orgname' :{
  			'required': {
  				'message': "This field must contain the name of the organization that you are representing for this event"
				}
				}
				}
				}
  );
});
</script>

</head>
<body>

<div id="page1" data-role='page'>
<div data-role="header">
<h1>Theater/Trip Event Information Input</h1>
<img src="graypluswhitebannereventMaint.jpg" width="100%"  />
</div>

<div id="pgcontent" data-role='content'>


<form  action="theaterHandle.php" method="post" name='formInput' id='formInput'   >
   
  <?php echo $listbox ?>
  	
	 <fieldset data-role="controlgroup" data-type="horizontal">
    <legend>Entry Type:</legend>  
        <label for= "typeTheater">Theater</label>  
        <input name="radioEntryType" id="typeTheater" type="radio" value="Theater" checked="checked" />
		          
       <label for='typeTrip'>Trip</label>
        <input type="radio" name="radioEntryType"  value="Trip" id='typeTrip' />
        		  
     </fieldset>  
	   
    <legend>Theater Production name  or Trip Site Name</legend>
    <input name="prodname" type="text" value="   " class="validate[required]"
    data-prompt-position="bottomLeft:140,5" >  		
		
      <legend>Date of Event or Date Start of multi day event: <span style="color:#FF0000;">*</span></legend>
	       <input name="dateStart" id="dateStart" type="date"  class="validate[required,custom[date],future[now]] text-input datepicker"
	 data-prompt-position="bottomLeft:140,5" 
	 />
       <legend>End Date of multi day event: </legend>
	 	
	   <input name="dateEnd" id="dateEnd" type="date"  class="validate[required,custom[date],future[#dateStart] text-input datepicker"
	  data-prompt-position="bottomLeft:140,5"
	   />
	 
      
	 <fieldset data-role="controlgroup" data-type="horizontal">
    <legend>Entry Duration:</legend>  
        <label for= "durSpan">Span</label>  
        <input name="radioEntryDur" id="durSpan" type="radio" value="mul" checked="checked" />

        
		           
       <label for='durSingle'>Single</label>
        <input type="radio" name="radioEntryDur"  value="Single" id='durSingle' />
        
        <label for='durWkEnd'>Weekend</label>
        <input type="radio" name="radioEntryDur"  value="Weekend" id='durWkEnd' />
        
        <label for='durWeek'>Week</label>
        <input type="radio" name="radioEntryDur"  value="Week" id='durWeek' />
      		  
     </fieldset>    
    	

    Password: <input name="passwrd" id="passwrd" type="password" 
      class="validate[required]" data-prompt-position="bottomLeft:140,5" /> 
         
	 
      	 
          <input type="submit" name="Submit" value="Submit Form" />
      </p>
  </form>
</div> <!-- end of content -->
<div data-role="footer"><h1>&copy;Gray and White Computing</h1></div>
</div> <!-- End of page -->
</body>
</html>