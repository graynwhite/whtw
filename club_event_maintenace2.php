<?php
/** @package 

        club_event_maintenace1.php
        
        Copyright(c) Gray and White Computing 2002
        
        Author: FRANK J CAULEY
        Created: FJC 9/12/2003 3:52:08 PM
	Last change: FJC 6/13/2005 11:21:27 PM
*/
require('../PHP-OAuth2/Client.php');
require('../PHP-OAuth2/GrantType/IGrantType.php');
require('../PHP-OAuth2/GrantType/AuthorizationCode.php');

const CLIENT_ID     = '148436498524338';
const CLIENT_SECRET = '17514882bf2caa40177950f7d5ca9145';

const REDIRECT_URI           = 'http://www.graypluswhite.com/whtw/club_event_maintenace2.php';
const AUTHORIZATION_ENDPOINT = 'https://graph.facebook.com/oauth/authorize';
const TOKEN_ENDPOINT         = 'https://graph.facebook.com/oauth/access_token';

$client = new OAuth2\Client(CLIENT_ID, CLIENT_SECRET);
if (!isset($_GET['code']))
{
    $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI);
    header('Location: ' . $auth_url);
    die('Redirect');
}
else
{
    $params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);
    $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);
    parse_str($response['result'], $info);
    $client->setAccessToken($info['access_token']);
    $response = $client->fetch('https://graph.facebook.com/me');
    var_dump($response, $response['result']);
}



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

}// end of get select_org function
 $page_title="Organization List";
 $sql = "select * from orgs ";
  if ( isset($select_org) )  {
        $confirm=TRUE;
   $sql .= " " . get_select_org($select_org). " ";
   $page_title = get_page_title($select_org);
    }
    $sql .= " order by Org_name ";

    $result = @mysql_query($sql);
    if (!$result) {
	 		echo("<p> Your inquiry  was rejected Email this information to cauleyfrank@gmail.com" . mysql_error() . " </p>");
	 		exit;

      		}

?>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" />
	<link rel="stylesheet" href="../taxi/taxi1.css">-->
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>

</head>

<body>
<div id="mainPage" data-role="page">
<div data-role="header">
<p align="center"><img src="graypluswhitebannereventMaint.jpg" width="100%" height="60"></p>
<p align="center"><b><font size="6"><?print $page_title?></font></b></p>
</div><!--end of header -->
<div data-role="content">
<p align="left"><font size="6"><b>Select the organization:</b></font></p>
<table border="2" cellpadding="1" cellspacing="1"  width="100%" >
   <tr>
        <th>Organization name</th>
        <th>Action </th>
</tr>
 <?       while ($row = mysql_fetch_array($result)){

    ?>
 <tr>

        <td><?print$row['Org_name']?>&nbsp;</td>
        <td><a href="club_event_list.php?org=<?print$row['Org_num']?>" target="_blank">Select</a>
          
    </td>

 </tr>
 <?php } ?>

</table>
</div><!-- end of content -->
<div data-role="footer">
<p align="center"><font size="6"><b>Gray and White Computing</b></font></p>
</div><!-- end of footer -->
</div><!--End of mainPage -->
</body>

</html>