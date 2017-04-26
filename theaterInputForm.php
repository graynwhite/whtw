<?php
$file_to_read="theaterVenues.xml";
$xml =  simplexml_load_file($file_to_read) or die("Unable to load file");

$listbox="<div data-role=\"fieldcontain\">
    <label for=\"selectmenu\" class=\"select\">Options:</label>
    <select name=\"selectmenu\" id=\"selectmenu\">";
	$listbox.="<option value=select a venue>select a venue</option>";
	$i=0;
	foreach($xml as $element):
	$placename=$xml->venue[$i]->venueName;
	$listbox .="<option value=". $placename . ">". $placename ."</option>/n" ;
	$i++;
	endforeach;
    $listbox.="</select></div>";  
?>

<!doctype html>
<html>
<head>

<title>Organization Event Input Mobile</title>
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
<link rel="stylesheet" href="wide.css"/>		
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
<meta name="viewport" content="width=device-width, user-scalable=yes" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/template.css" />
<link rel="stylesheet" href="http://www.graypluswhite.com/jqvaleng/css/validationEngine.jquery.css" />
<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
<script src="http://code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
<!--<script src="http://www.graypluswhite.com/jqvaleng/js/jquery-1.8.2.min.js"></script>-->
<script src="http://www.graypluswhite.com/jqvaleng/js/languages/jquery.validationEngine-en.js"></script>	
<script src="http://www.graypluswhite.com/jqvaleng/js/jquery.validationEngine.js"></script>
<script src="http://www.graypluswhite.com/dough/Dough/dough.min.js"></script>
<link rel="stylesheet" href="wide.css"/>

<title>Theater Event Entry</title>
	<script>
	$(document).ready(function(){

  jQuery("#formInput").validationEngine( );
});



</script>

</head>

<body>
<div data-role="page" id="page">
  <div data-role='header'>
<h1>Theater Event Information Input<br /> 
<img src="graynwhitebannereventMaint.jpg" width="100%"  /></h1>
</div>

  
  <div id="page" data-role="content">
  
  <form  action="theaterHandle.php" method="POST" name='formInput' id='formInput'>
  
<?php echo $listbox ?>

 
    <legend>Event Name</legend>
    <input type="text" name="eventName" id="eventName" 
     class="validate[required]"  val=" " 	  data-prompt-position="bottomLeft:140,5"
	  title="Enter the name of the production" >
  
  
   
  
  <legend>Starting date</legend>
    <input type="text" name="fdate" id="fdate"
   class="validate[required]"  
	  data-prompt-position="bottomLeft:140,5"
	  title="Enter date of the first performance" >

  
  <legend>Ending Date</legend>
  <input type="date" name="tdate" id="tdate"
   class="validate[required]"  
	  data-prompt-position="bottomLeft:140,5"
	  title="Enter the date of the last performance" >

   
    
    <legend>Password:</legend>
    <input type="password" name="passwordinput" id="passwordinput"  class="validate[required]"  
	  data-prompt-position="bottomLeft:140,5"
	  title="Enter the password" >
 
  
  
 
  
          <input type = "submit" name="Submit" value="Submit Form" >
      
     
   </form>
 
 </div> 
  <div id="ftr" data-role="footer">
    <h4>Gray and White Computing</h4>
  </div>
</div>

</body>
</html>