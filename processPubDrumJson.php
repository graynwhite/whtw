
<?PHP
$pubdate=$_GET[pub];
$pubdate=$_GET[plus];
require_once("./phpClasses/Class_evententry.php");
require_once("./phpClasses/Class_blog_links.php");
require_once("./zendLibrary/ClassGdataCalendar.php");
$ee = new eventEntry;
$cal = new GdataCalendar;
$bl = new blog_links;
$file_to_read = "./_private/pubDrumJson.js";
$f=fopen($file_to_read,'r') or die("unable to open JSON file");
$jsonInput =fgets($f);
var_dump(json_decode($jsonInput));
exit;
$json_data =json_decode($jsonInput);
$eventCount=0;	
foreach($xml->Event as $event)
{
$dateFrom=substr($event->EventStart,0,10);
if($dateFrom>=$pubDate && $dateFrom <= $puDatePlus14){
		$dateWork=explode('-',$dateFrom);
		$dateFromXml = $dateWork[1] . "/" . $dateWork[2] . "/" . $dateWork[0];
		$dateTo = substr($event->EventEnd,0,10);
		$dateToXml = $dateWork[1] . "/" . $dateWork[2] . "/" . $dateWork[0];
		$dateWork= explode('-',$dateTo);
		$usera = $event->EventURL;
		$credit = $event->EventContactName . " via pubDrum ";
		$timeWork = $cal->convertGdataDate($event->EventStart);
		$timeStart= $timeWork[1];
		$timeWork = $cal->convertGdataDate($event->EventEnd);
		$timeTo = $timeWork[1];
		$lastEdit = substr($event->EventLastEdit,0,10);
		//if($dateFrom >= '2011-12-30' && $dateFrom <= '2012-12-30')
		
			echo "<br /> this is the date from " . $dateFrom;
			echo  "<br /> this is the event Name "  .$event->EventName;
			echo   "<br /> this is the event end " . $event->EventEnd;
			
				$cal->appendToXml("<event>");
				$cal->linebreakForXml();
				$cal->parseXml('refferSrc','gdataCalendar',false,1);
				$cal->parseXml('entryType','new',false,1);
				$cal->parseXml('subEmail','PubDrun feed',false,1);
				$cal->parseXml('subName',$credit,true,1);
				$cal->parseXml('orgName',$usera,true,1);
				$cal->parseXml('title',$event->EventTitle,true,1);
				$cal->parseXml('From_date',$dateFromXml,true,1);
				$cal->parseXml('to_date',$dateToXml,true,1);
				$cal->parseXml('reserve_by',$dateFrom,true,1);
				$cal->parseXml('start_time',$timeStart,true,1);
				$cal->parseXml('to_time',$timeTo,true,1);
				$cal->parseXml('Day_of_week',$event->PrettyDate,true,1);		
				$cal->parseXml('comments', $event->EventDesc,true,1);
				$cal->parseXml('place_name',$event->EventVenueName,true,1); 
				$cal->parseXml('place_address',$event->EventStreet ,true,1); 
				$cal->parseXml('city', $event->EventCity ,true,1);
				$cal->parseXml('state', $event->EventState ,true,1);
				$cal->parseXml('zip', $event->EventZip ,true,1);
				//$cal->parseXml('place_phone', $_POST['placePhone'] ,true,1);  
				//$cal->parseXml('place_url', $_POST['placeUrl'] ,true,1);
				//$cal->parseXml('place_email', $_POST['placeEmail'] ,true,1);    
				//$cal->parseXml('where',$bl->clearquotes((implode($event->where))) ,true,1);
				//$cal->parseXml('when',$bl->clearquotes((implode($event->when))) ,true,1);
				//$cal->parseXml('add_dir', $_POST['PostDirections']  ,true,1);
				$cal->parseXml('activity',$event->EventShortDesc ,true,1);
				$cal->parseXml('price_member', $_POST['priceMemb']  ,true,1);
				$cal->parseXml('price_guest', $_POST['priceGuest']  ,true,1);
				$cal->parseXml('defaultLocation', $defaultLocation  ,true,1);
				$cal->parseXml('recurring',  $_POST['recurring'] ,true,1);
				$cal->parseXml('recurBegin',   $_POST['recurbegin']   ,true,1);
				$cal->parseXml('recurend',   $_POST['recurend']   ,true,1);
					
				$cal->appendToXml("</event>");
				
		
				
					$filename = './_private/geven' . date('YmdHis') . $eventCount . '.xml';
					//print('filename is ' . $filename);
					$feof = fopen($filename,'w');
					$message = $cal->getXmlText();
					fwrite($feof,$message);
					fclose($feof);
					$eventCount ++;
					//$cal->showXmlText();
					echo "<br />" . $message;
					echo "<br /> XML file gevent" .date('YmdHis') . $eventCount . '.xml sent to webmaster' ;
					$cal->clearXmltext();
			
	}// end of date test 
}// end of for each
echo "<br /> end of processing";
exit;
?>
