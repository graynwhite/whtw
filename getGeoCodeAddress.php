
<?php
 $address = "Royal Oak Manor 606 Williams  Royal Oak  Michigan"; 
// $address=$_GET['address'];

 $url="http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=". urlencode($address);
$data = @file_get_contents($url);
$jsondata = json_decode($data,true);
//print_r($jsondata);
var_dump($jsondata);

  $lat = $jsondata ['results'][0]['geometry']['location']['lat'];
  $lon = $jsondata ['results'][0]['geometry']['location']['lng'];
  $returnArray = array('latitude'=>$lat, "longitude"=>$lon); 
  //print_r($returnArray);
  echo json_encode($returnArray);
  

  
?>