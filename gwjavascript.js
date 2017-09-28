
<script language="javascript">
var testString = '';


//===================================================================================================
function acknowledge(){
	var recipientName = document.getElementById("subName");
	var recipientEmail = document.getElementById("emailid");
	var recipientAddress = recipientName.value + " <" + recipientEmail.value + "> ";
	var pubname = recipientName.value;
	var eventTitleField = document.getElementById("event_title");
	var orgField=document.getElementById("orgName");
	var orgName=orgField.value;
	var fromDateField=document.getElementById("From_date");
	var fromDate=fromDateField.value;
	var eventTitle=eventTitleField.value;
	var reserve_date = document.getElementById("reserve_by").value;
	var recipient = recipientEmail.value;
	
	$.ajax({
			type: 'POST',
			url: "acknowledgemailer.php",
			data: {pubname: pubname, title: eventTitle, fromDate: fromDate, reserve_date: reserve_date, recipient: recipient}
		})
		.done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			
			// Set the message text.
			$('#form-messages').text(response);
	
		})
		.fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			

			// Set the message text.
			if (data.responseText !== '') {
				$("#form-messages").text(data.responseText);
			} else {
				$("#form-messages").text('Oops! An error occured and your message could not be sent.');
			}
		});
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function saveIsp(){
var thisIsp=document.getElementById('sourceg');
alert("Isp to save is " + thisIsp.value);

}


 
//===========================================================================================
function regxMicrosoft(obj)
{

if (obj=='activity')
{
testString = document.formInput.activity.value;
}
if (obj=='media')
{
testString = document.formInput.media.value;
}

testString=testString.replace(/'/g,"'");
testString=testString.replace(/–/g,"--");
testString=testString.replace(/•/g,"*");
testString=testString.replace(/"/g,'"');
testString=testString.replace(/"/g,'"');
testString=testString.replace(/\\/g,'');
testString=testString.replace(/�/g,"'");
testString=testString.replace('...' , "---");
testString=testString.replace('Arrive Early...' , "Arrive Early---");
testString=testString.replace('Come Late...' , "Come Late---");
testString=testString.replace('Great...' , "Great---");
testString=testString.replace('Âs' , "'s");
testString=testString.replace('Â' , "'");
testString=testString.replace('ï¿½s',"'s");
testString=testString.replace("&#39;","'");
testString=testString.replace("&#151;","&#150;");
if (obj=='activity')
{
 document.formInput.activity.value = testString;
}
if (obj=='media')
{
 document.formInput.media.value = testString;
}
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
function copyTitle(){
//alert("at copyTitle");
document.formInput.activity.value= document.formInput.event_title.value;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function UseDefault()
{
document.formInput.place.value = document.formInput.defaultLocation.value;
}//===================================================================================================
function UseSubmitted()
{
document.formInput.place.value = document.formInput.submittedLocation.value;
}
//====================================================================================================	
function UseFound()
{
var str=document.formInput.geocomplete.value;
var n=str.search(",");

var place_work = str.substring(0,n);

place_work = place_work + ". " + document.formInput.formatted_address.value;
n=place_work.search("MI,");
place_work=place_work.substring(0,n+2) + ".";
var lenPlace_work = place_work.length;
//alert("length of work place" + lenPlace_work);
var lenAvailable = 100 - lenPlace_work;
//alert("lenAvailable " +lenAvailable);

var website = document.formInput.website.value;
//alert("length of website " + website.length);
if(website.length > 0 && website.length < lenAvailable){
place_work += " website is " + website;
}
document.formInput.place.value = place_work;
}
//==============================================================================
function CallForDirections()
{
 document.formInput.place.value="Call for Directions";
}
//==========================================================================================	
function CopyStart()
{
document.formInput.date_to.value = document.formInput.From_date.value;
var str=document.formInput.reserve_by.value;
if(str.charAt(0)=='A')
{
document.formInput.reserve_by.value = document.formInput.From_date.value;
}
}
//================================================================================================	
function UCWords(str){
  var arrStr = str.split(" ");
  var strOut = "";
  var i = 0;
  while (i < arrStr.length) {
     firstChar  = arrStr[i].substring(0,1);
     remainChar = arrStr[i].substring(1);
     firstChar  = firstChar.toUpperCase();
     remainChar = remainChar.toLowerCase();
     strOut += firstChar + remainChar + ' ';
     i++;
  }
  return strOut.substr(0,strOut.length - 1);
}

//========================================================================================================	
function processCAC()
{
var titleWork = document.formInput.event_title.value.toLowerCase();
//alert ("lowercase title is " + titleWork);
document.formInput.event_title.value= UCWords(titleWork);
document.formInput.date_to.value = document.formInput.From_date.value;

}
//=============================================================================================
function processWheelhouse()
{
	//alert("Default location is  " + document.formInput.defaultLocation.value);
	var titleLength = document.formInput.event_title.value.length;
	//alert("title length is " + titleLength);


	document.formInput.place.value = document.formInput.defaultLocation.value;

	if(document.formInput.activity.value.length < 2)
	{
	document.formInput.activity.value= document.formInput.event_title.value;
	document.formInput.time_start.value = document.formInput.event_title.value.substring(titleLength-4);
	document.formInput.time_end.value=' ';
	}
	if(document.formInput.media.value.length <2)
	{
	document.formInput.media.value= document.formInput.event_title.value;
	}

	document.formInput.date_to.value = document.formInput.From_date.value;
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
function checkForm(form)
{
//alert('at checkform');
if(document.formInput.Org.selectedIndex ==0)
	{
	alert ('Organization must be selected');

	document.formInput.Org.focus();
	return false
	}
if(document.formInput.Dow.value  == '')
	{
	alert ('Day of week not selected')
	document.formInput.Dow.focus()
	return false
	}
if(document.formInput.place.value.charAt(0) == ".")
	{
	alert('place is not correct')
	document.form.place.focus()
	return false
	}
return true;
}
//===================================================================================	
function clearLast()
{
var fileToClear = 'http://www.graypluswhite.com' + document.getElementById('fileToRead').value

	alert('file to clear is ' + fileToClear)
	unlink(fileToClear)
}
//===========================================================================================	
 function RemoveFile()
   {
     var fileToClear = 'http://www.graypluswhite.com' + document.getElementById('fileToRead').value
	 IntraLaunch.DeleteFile (fileToClear);

     // Check if gone
     var bDoesExist;
     bDoesExist = IntraLaunch.DoesFileExist(fileToClear);

     if (bDoesExist == "False")
     { alert ('File successfully remove'); }
     else
     { alert ('File could not be removed'); }
   }



</script>
