<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
define('INCLUDED', 1);

$include_path = "/c44/cauleyfj/phpauction/includes/"; 
include $include_path."settings.inc.php";
//include $include_path."messages.inc.php";
//include $include_path."languages.inc.php";

print "<br> cron setting is " . $SETTINGS['cron'] ;

$fp = fopen("http://www.bankofcanada.ca/fmd/exchange.htm","r");
		$x=0;$g=0;
		while(!feof($fp))
		{
			$buf = fgets($fp, 4096);
			if(eregi("U.S. Dollar",$buf)) $x=4;
			if(eregi("</PRE>",$buf)) $x=0;
			if(eregi("Venezuelan Bolivar",$buf)) $x=0;
			if($x==4)
			{
				
					$ime = explode("/",$buf);
					$s = explode(" ",$ime[1]);
					$r = array_reverse ($s);
					
					if(eregi("Euro de",$buf))
					{
						$ime[0]="European Monetary Union EURO";
						$s = explode(" ",$buf);
						$r = array_reverse ($s);
					}
					
					if($ime[0]<>"" and $r[0]<>"")
					//print_r($ime);
					//print_r($r);
					{
						$g++;
						if(eregi("U.S. Dollar",$buf)) {$koef = (float)$r[0];}
						$k = ((float)$r[0]/(float)$koef);
						if ($k <>0){
						$usd = 1/$k;
						}else{
						$usd=0;
						}				
						
						$res = mysql_query("SELECT * FROM PHPAUCTIONXL_rates WHERE sifra=\"$ime[0]\"") or exit("ERROR 42:".mysql_error());
						$num = mysql_num_rows($res);
						if($num == 0)
						{
							mysql_query("INSERT INTO PHPAUCTIONXL_rates VALUES(
		 			NULL,
		 			\"$ime[0]\",
					'',
					$usd,
					\"$ime[0]\")");
						}
						else
						mysql_query("UPDATE PHPAUCTIONXL_rates SET rate='$usd' WHERE sifra=\"$ime[0]\"");
					}
					
				}
			}
		
		fclose($fp);
		//mysql_query("UPDATE PHPAUCTIONXL_lastupdate SET last_update=NOW();");
	

print_r($SETTINGS);
//phpinfo();
?>
