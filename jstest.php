<?php
if (isset($_POST['jstest'])) {
  $nojs = FALSE;
  $nojs2= "No Javascript is not disabled";
  } else {
  // create a hidden form and submit it with javascript
  echo '<form name="jsform" id="jsform" method="post" style="display:none">';
  echo '<input name="jstest" type="text" value="true" />';
  echo '<script language="javascript">';
  echo 'document.jsform.submit();';
  echo '</script>';
  echo '</form>';
  // the variable below would be set only if the form wasn't submitted, hence JS is disabled
  $nojs = TRUE;
  $nojs2 = "Yes Javascript is disabled";
}
if ($nojs){
	die("Javascript is disabled in this browser");
  //JS is OFF, do the PHP stuff
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Javascript test</title>
</head>

<body>
<h2>Testing for javascript</h2>
<p>You do not have Javascript enabled in your brwser and the program you are requesting uses javascript.</p>
<p>Take steps to enable javascript or use a browser that has javascript enabled</p>
The value of Nojs2 is <? echo $nojs2 ?>
</body>
</html>