<?PHP
//Open images directory
$dir = dir("_private");
$file_array = array();
//List xml files in _private directory
while (($file = $dir->read()) !== false)
{
	if(substr($file,-3,3)== 'xml' & substr($file,0,9)== 'recommend'){
	//echo "filename: " . $file . "<br />";
	$file_array[]=$file;
	}
}
//print_r($file_array);
$file_to_read = './_private/' .$file_array[0];
//$file_to_read = './_private/event20100311232948.xml';
//$simple = new simpleXml; 
//$xml = $simple->simplexml_load_file($file_to_read) or die ("Unable to load XML file!");
$xml =  simplexml_load_file($file_to_read) or die("Unable to load file");
//print_r($xml); 

// access XML data 
$subName= $xml->subName;
$date_work = explode('/',$xml->From_date);
$From_date = $date_work[2] . "-" .  $date_work[0] . "-" . $date_work[1];
if($xml->to_date == ''){
	$date_to = $From_date;
} 
else{
	$date_work2 = explode('/',$xml->to_date);
	$date_to=$date_work2[2]. "-" . $date_work2[0]. "-" . $date_work2[1];
	}
if($xml->reserve_by == ''){
	$reserve_by = $From_date;
} 
else{
	$date_work3 = explode('/',$xml->reserve_by);
	$reserve_by=$date_work3[2] . "-" .$date_work3[0]. "-".$date_work3[1];
	}

$place_full = $xml->place_name . '. ' . $xml->place_address . ', ' . $xml->city . ', ' . $xml->state . '. ' . $xml->zip . ' '. $xml->place_phone . ' ' . $xml->place_url . ' ' . $xml->place_email ;


//$dom = new DOMDocument;
//$dom->prevservWhiteSpace = false;
//
//if (!$dom->load($file_to_read)) {
//    echo $file_to_read . " doesn't exist!\n";
//    return;
//}
//
//$subname = $dom->getElementsByTagName('subName');
//echo $subname;

?> 





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Process Recommend A Friend</title>
<script language="javascript">

function clearLast()
{
var fileToClear = 'http://www.graypluswhite.com' + document.getElementById('fileToRead').value
	
	alert('file to clear is ' + fileToClear)
	unlink(fileToClear)
}		
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

</head>

<body>
<h2>Process Recomendation </h2>
<form action="http://www.graypluswhite.com/emailControl/mailToWebmaster.php?org=recommend2" method="post" name="reccommend" id="reccommend" title="Recommend a Friend Form">

	
   <input name="Email" type="hidden" value="cauleyfj@graypluswhite.com">
	
     <table width="927" border="1" >
	  	<tr>
		<td>Time Submitted</td>
		<td><input name="timeInvite" id="timeInvite" type="text" value="<?echo $xml->timeInvite ?>" size="64" /></td>
	  	<tr>
          <td width="328">Your First Name </td>
          <td width="544"><input name="recFirstName" type="text" id="recFirstName" size="40" maxlength="40" value="<? echo $xml->recFirstName ?>"></td>
        </tr>
        <tr>
          <td>Your Last Name </td>
          <td><input name="recLastName" type="text" id="recLastName" size="40" value="<? echo $xml->recLastName ?>"></td>
        </tr>
        <tr>
          <td>Your Email address </td>
          <td><input name="recEmail" type="text" id="recEmail" size="40" value="<? echo $xml->recEmail ?>"></td>
        </tr>
        <tr>
          <td>Use My Name in the invitation </td>
          <td><input name="rbUseName" type="text" value="<? echo $xml->rbUseName ?>" /> </td>
        </tr>
        <tr>
          <td>Your Gender </td>
          <td><input name="recGender" type="text" value="<? echo $xml->recGender ?>" /></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FF99FF"><label>Invitee's First Name </label>
              <input name="invFirst" type="text" id="invFirst" size="24" value="<? echo $xml->invFirst ?>">
          Last Name
          <input name="invLast" type="text" id="invLast" size="24" value="<? echo $xml->invLast ?>">
          Email
          <input name="invEmail" type="text" id="invEmail" value="<? echo $xml->invEmail ?>">
         </td>
        </tr>
        <tr>
          <td colspan="2" align="center"><label>
            <input type="submit" name="Submit" value="Submit">
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
  </table>
	  
</form>

</body>
<OBJECT ID="IntraLaunch" STYLE="display : none" WIDTH=1 HEIGHT=1    CODEBASE="http://intranet.net/menu/IntraLaunch.CAB#version=5,0,0,0"
   CLASSID="CLSID:0AE533FE-B805-4FD6-8AE1-A619FBEE7A23">
   <PARAM NAME="ImageLoc" VALUE="Null">
   <PARAM NAME="ImageSrc" VALUE="Null">
   <PARAM NAME="Run" VALUE="Null">
   <PARAM NAME="RunParms" VALUE="">
</OBJECT> 
</html>
