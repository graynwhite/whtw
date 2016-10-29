<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Membership Form</title>
<link rel="stylesheet" type="text/css" href="../css/common.css"/>
<style type="text/css">
.error{background-color:#d33; color:white; padding:0.2em;}
</style>
</head>

<body>

<?php
//setupRequiredFields();
if ( isset($_POST['submitButton']))
{
	setupRequiredFields();
	processForm();
}else{
	displayForm($missingFields);
	}
	
function validateField($fieldName, $missingFields){
	if($missingFields){
	if ( in_array($fieldName,$missingFields)){
	echo 'class="error"' ;
	}else{ echo '';}
	}
	}
function setValue($fieldName){
	if ( isset($_POST[$fieldName])){
	echo $_POST[$fieldName];
	}else{
	echo '';}
	}
function setChecked($fieldName, $fieldValue){
	if ( isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue){
	echo ' checked="checked" ';
	}
	}
function setSelected($fieldName, $fieldValue){
	if ( isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue){
	echo ' selected="selected" ';
	}
	}
function setupRequiredFields(){
	$requiredFields= array("firstName", "lastName", "password1", "password2", "gender");
	$missingFields= array();
		foreach($requiredFields as $requiredField){
			if ( !isset($_POST[$requiredField])or (strlen($_POST[$requiredField])<1)){
				$missingFields[]=$requiredField;
				}
			}
			//print_r($missingFields);
	}
function processForm(){
	$requiredFields= array("firstName", "lastName", "password1", "password2", "gender");
	$missingFields= array();
		foreach($requiredFields as $requiredField){
			if ( !isset($_POST[$requiredField])or (strlen($_POST[$requiredField])<1)){
				$missingFields[]=$requiredField;
				}
			}
			//print_r($missingFields);
	if ($missingFields){
		displayForm($missingFields);
		}else{
		displayThanks();
		}		
	}
function displayForm($missingFields){
?>
<h1>Membership Form</h1>
	<?php if($missingFields){ ?>
	<p class=".error">There were some problems with the form you submitted. Please
	complete the fields highligted below and click Send Details to re-submit the form</p>
	<?php }else { ?>
	<p> Thanks for choosing Fields with an asterisk are required</p>
	<?php } ?>
	
<form action="registrationform.php" method="post">
	<div style="width:30em;">
<label for = "firstName"<?php validateField("firstName",$missingFields)?>
	>*First Name</label>
	<input type='text' name='firstName' id='firstName'
	value = "<?php setValue("firstName")?>" />
	
	<label for = "lastName"<?php validateField("lastName",
	$missingFields);?>>*Last name</label>
	<input type='text' name='lastName' id='lastName'
	value = "<?php setValue("lastName")?>" />
	
	<label for = "password1"<?php if ($missingFields){
	echo ' class="error"';} ?>
	>*Choose a password</label>
	<input type='password' name='password1' id='password1' />
	
	<label for= "password2"<?php if ($missingFields){
	echo ' class="error"';} ?>>*Retype Password</label>
	<input type='password' name='password2' id='password2' />
	
	<label for= "gender" <?php validateField("gender",$missingFields)?>>* Your gender</label>
	<label for "genderMale">Male</label>
	<input type='radio' name='gender' id='genderMale' value='M'
	<?php setChecked('gender','M') ?>/>
	<label for "genderFemale">Female</label>
	<input type='radio' name='gender' id='genderfemale' value='F'
	<?php setChecked('gender','F') ?>/>
	
	<label for "favoritewidget">What is your favorite widget/</label>
	<select name='favoritewidget' id='favoritewidget' size='1'>
		<option value='superWidget'<?php setSelected('favoriteWidget','superWidget');?>>The superwidget</option>
		<option value='megaWidget'<?php setSelected('favoriteWidget','megaWidget');?>>The megarwidget</option>
		<option value='wonderWidget'<?php setSelected('favoriteWidget','wonderWidget');?>>The wonderwidget</option>
		</select>
		
	<label for "newsletter">Do You Want to Receive Our Newsletter?</label>
	<input type="checkbox" name='newsletter' id 'newsletter' value'Yes'
	<?php setChecked('newsletter', 'Yes') ?> />
	
	<label for "comments" > Any comments? </label>
	<textarea name="comments" id="comments" $rows="4" cols="50">
	<?php setValue("comments") ?> </textarea>
	
	<div style="clear:both;">
	
	<input type="submit" name="submitButton" id="submitButton" value="Send Details" />
	
	<input type="reset" name='resetButton' id='resetButton' value='Reset form'
	style="margin-right:20px;"/>
	</div>
	
</div>
</form>
<?php }

function displaythanks(){
?>
<h1> Thank You for your application</h1>
<?php
}
?>	
	 	  	  			
</body>
</html>
