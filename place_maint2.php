<?PHP
$mode_description = "Update/Change";
if ($mode == "delete"){
$mode_description="Delete";
}
include("../cgi-bin/connect.inc");
           $sql=(" select * from places where place_num= \"$place_num\" ");
           $result = (@mysql_query($sql));
           if (!$result){ 
              echo("<p>error performing query Email this information to webmaster@graynwhite.com" . mysql_error() . "</p> ");
           exit();
           }
		   $row=mysql_fetch_array($result);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Venue Update</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAJLfRdQsVrZepPXfVM9G3WBR6DpzCs03izTSiB4vimDCa5iEwxBTyNH_u51uoDYbGfbzzJrk7WOAJJQ"
      type="text/javascript"></script>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>

<body>

<script language="javascript">
function getlatlon(){
	var map = new GMap2(document.getElementById("map"));
	var geocoder = new GClientGeocoder();

	alert("Getting the Lat/Lon");
}

function parse_it(){
	document.form_place.location.value = document.form_place.place_name.value + " " 
									+ document.form_place.address.value;
	if (document.form_place.city.value !== "" )  {
				document.form_place.location.value += " " + document.form_place.city.value
	}	
	if (document.form_place.state.value  == "" && document.form_place.city.value !== "" ) {
			document.form_place.location.value  += " , MI "
	} else {
			document.form_place.location.value += ", " + document.form_place.state.value
	}
	if (document.form_place.zip.value !== "" ) {
		document.form_place.location.value += " " + document.form_place.zip.value 
	}		
	if (document.form_place.phone.value !== "" ) {
		document.form_place.location.value += " " + document.form_place.phone.value
	}		
	if (document.form_place.email.value !== "" ) {
		document.form_place.location.value += " " + document.form_place.email.value
	}
	if (document.form_place.url.value !== "" ) {
		document.form_place.location.value += " " + document.form_place.url.value
	}
	if (document.form_place.directions.value !== "" ) {
		document.form_place.location.value += " " + document.form_place.directions.value
	}											
}
</script>

<H1 align="center"><img src="./whtw/graynwhitebannereventMaint.jpg" width="468" height="60"></H1>
<H1>Place <?php echo($mode_description);?></H1>
<form id="form_place" name="form_place" method="post" action="place_update.php">
  <table width="107%" border="1">
    <tr>
      <td width="14%" bgcolor="#FFFFFF"><div align="right">Place Number
          <input name="place_num" type="text" id="place_num" value="<?print$row['place_num']?>" size="11" />
      </div></td>
      <td width="24%"><label>Parse
          <input name="ParseBox"  onclick="parse_it()" type="checkbox" id="ParseBox" value="checkbox" />
          <input name="mode" type="hidden" id="mode" value=<?=$mode?>> 
      Get lat/lon
      <input name="lat_lon" onClick="getlatlon()" type="checkbox" id="lat_lon" value="checkbox">
      </label></td>
      <td width="27%" bgcolor="#FFFFFF"><div align="right">
        <label></label>
      </div></td>
      <td width="30%"><div align="left"></div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="right">Location</div></td>
      <td colspan="3"><textarea name="location" cols="75" rows="2" id="location"><?=$row['location']?>
      </textarea></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="right">Place Name </div></td>
      <td><input name="place_name" type="text" id="place_name" value="<?=$row['place_name']?>" size="40" /></td>
      <td>Address 
      <input name="address" type="text" id="address" value="<?=$row['address']?>" size="24" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><div align="right">City</div></td>
      <td><input name="city" type="text" id="city" value="<?=$row['city']?>" size="24" maxlength="24" /></td>
      <td bgcolor="#FFFFFF"><p>
        State
            <input name="state" type="text" id="state" value="<?=$row['state']?>" size="2" maxlength="2" />
            <label>Zip
            <input name="zip" type="text" id="zip" value="<?=$row['zip']?>" size="9" maxlength="9" />
            </label>
      </p>        </td>
      <td width="30%"><label>Phone
          <input name="phone" type="text" id="phone" value="<?=$row['phone']?>" size="14" maxlength="14" />
      </label></td>
      <td width="1%">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td><label>Fax
          <input name="fax" type="text" id="fax" value="<?=$row['fax']?>" size="14" maxlength="14" />
      </label></td>
      <td><label>email
          <input name="email" type="text" id="email" value="<?=$row['email']?>" size="40" maxlength="40" />
      </label></td>
      <td bgcolor="#FFFFFF"><label>url
          <input name="url" type="text" id="url" value="<?=$row['url']?>" 
		  size="40" maxlength="80" />
      </label></td>
      <td>&nbsp;</td>
      <td width="4%">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td><label>Directions
          <textarea name="directions" cols="50" rows="5" id="directions">
		  <?=$row['directions']?>
          </textarea>
      </label></td>
      <td><label>Map
          <input name="map" type="text" id="map" value="<?=$row['map']?>" size="24" maxlength="24" />
      </label></td>
      <td bgcolor="#FFFFFF">
        �
        <p>
          <label>
<input type="radio" name="Venue_type" value="Restaurant">            
Restaurant</label>
          <br>
          <label>
            <input type="radio" name="Venue_type" value="Hall">
            Hall</label>
			<br>
		<label>
            <input type="radio" name="Venue_type" value="Theater">
            Theater</label>
          <br>
          <label>
            <input type="radio" name="Venue_type" value="Night Club">
            Night Club</label>
          <br>
          <label>
            <input type="radio" name="Venue_type" value="Ski Area">
            Ski Area</label>
          <br>
          <label>
            <input type="radio" name="Venue_type" value="Golf Club">
            Golf Club</label>
          <br>
          <label>
            <input type="radio" name="Venue_type" value="Yacht Club">
            Yacht Club</label>
          <br>
        </p></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td><label>Latitude
          
          <input name="lat" type="text" id="lat" value="<?=$row['latitude']?>" size="20" maxlength="20" />
      </label></td>
      <td><label>Longitude
          <input name="lng" type="text" id="lng" value="<?=$row['longitude']?>" size="20" maxlength="20" />
      </label></td>
      <td bgcolor="#FFFFFF">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div align="center">
    <input name="Submit" type="submit" value="Submit" />
  </div>
</form>
<H1>&nbsp;</H1>
<H1>&nbsp;</H1>
<H1>&nbsp;</H1>
</body>
</html>
