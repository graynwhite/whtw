<!DOCTYPE html>
<html>

<head>


<title>Generic Text Edit</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="../markitup/markitup/skins/markitup/style.css" />
	<link rel="stylesheet" type="text/css" href="../markitup/markitup/sets/html/style.css" />
	<script type="text/javascript" src="../javascript/convertMsWord.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript" src="../markitup/markitup/jquery.markitup.js"></script>
	<script type="text/javascript" src="../markitup/markitup/sets/html/set.js"></script>
<script type="text/javascript" >
   $(document).ready(function() {
      $(".markItUp").markItUp(mySettings);
   });

</script>	
	
</head>

<body>
<div id="mainPage" data-role="page">
<div data-role="header">Generic Text Editor</div>
<div data-role="content">
  <textarea class="markItUp" wrap rows="20" cols="100" name="textfield" id="textfield">
  ccc
  </textarea>
  <br />
  <input type="button" id="btnEdit" value="Edit Text"  onClick="regxMicrosoft(textfield)"/>
</div> 
<!--End of content-->
<div data-role="footer">Gray and White Computing</div>
</div> <!--end of page-->
</body>
</html>
