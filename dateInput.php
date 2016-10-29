
<!DOCTYPE html> 
<html> 
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1"> 
	<title>Dates for an event</title>
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" />
	<link rel="stylesheet" type="text/css" href="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.min.css" />
	<link rel="stylesheet" href="mobile.css"/> 

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script> 
<script type="text/javascript" src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>

<!-- Optional Mousewheel support: http://brandonaaron.net/code/mousewheel/docs -->
<!--<script type="text/javascript" src="PATH/TO/YOUR/COPY/OF/jquery.mousewheel.min.js"></script>-->

<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.core.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.calbox.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/latest/jqm-datebox.mode.datebox.min.js"></script>
<script type="text/javascript" src="http://dev.jtsage.com/cdn/datebox/i18n/jquery.mobile.datebox.i18n.en_US.utf8.js"></script>
	
</head> 
<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Gray and White Datepicker</h1>		
	</div>
	
	<div data-role="content">
		
		
		<form action="#" method="get">
			<div data-role="fieldcontain">
	     	    <label for="date">Event start date</label>
				<input name="dateStart" id="dateStart" type="text" data-role="datebox" data-options='{"mode":"calbox", "useNewStyle":true}' />
	     	   
			</div>	
			<div data-role="fieldcontain">
	     	    <label for="timeStart">Event start Time</label>
				<input name="timeStart" id="timeStart" type="text" data-role="datebox" data-options='{"mode":"timebox", "useNewStyle":true}' />
	     	   
			</div>
			</div>	
			<div data-role="fieldcontain">
	     	    <label for="timeEnd">Event End  Time (if applicable)</label>
				<input name="timeEnd" id="timeEnd" type="text" data-role="datebox" data-options='{"mode":"timebox", "useNewStyle":true}' />
	     	   
			</div>		
			<div data-role="fieldcontain">
	     	    <label for="dateEnd">Event End Date</label>
				<input name="dateEnd" id="dateEnd" type="text" data-role="datebox" data-options='{"mode":"calbox", "useNewStyle":true}' />
	     	    
			</div>	
			<div data-role="fieldcontain">
	     	    <label for="dateReserve">Event Reservation date</label>
	     	    <input name="datereserve" id="dateReserve" type="text" data-role="datebox" data-options='{"mode":"calbox", "useNewStyle":true}' />
			</div>		
		</form>
		
		
	</div>
	
</div>
		


</body>
</html>

