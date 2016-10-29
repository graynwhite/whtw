<?#//v.3.0.0
if(!defined('INCLUDED'))
	exit("Access denied");




#// ====================
#// Banners functions **
#// ====================

if(!function_exists(view)) {
	Function view() {
		global $SETTINGS;
		global $HTTPS;
		unset($BANNERSARRAY);
		unset($THISBANNER);

		$query = "SELECT * FROM PHPAUCTIONXL_bannerssettings";
		$res_settings = mysql_query($query);
		$BANNERSETTINGS = mysql_fetch_array($res_settings);

		#// First try to retrieve banners according the filters

		#// ================================================================
		#// Categories filter
		#// ================================================================
		
		if(strstr($_SERVER['SCRIPT_FILENAME'],"browse.php")) {
			$query = "SELECT * FROM PHPAUCTIONXL_bannerscategories WHERE category=".intval($GLOBALS['id']);
			$res = mysql_query($query);
			if($res && @mysql_num_rows($res) > 0) {
				#// We have at least one banners to show
				while($row = mysql_fetch_array($res)) {
					$BANNERSARRAY[] = $row;
				}

				#// Pick a random element
				srand ((float) microtime() * 10000000);
				if(is_array($BANNERSARRAY)) {
					$RAND_IDX = array_rand($BANNERSARRAY);
					$BANNERTOSHOW = $BANNERSARRAY[$RAND_IDX][banner];
				}
			}
			
		}
		#// ================================================================
		#// Keywords filter
		#// ================================================================
		elseif(strstr($_SERVER['SCRIPT_FILENAME'], 'item.php') || basename($_SERVER['SCRIPT_FILENAME']) == 'bidhistory.php') {
			$query = "SELECT *
			         FROM PHPAUCTIONXL_bannerskeywords
			         WHERE
			         INSTR('".$GLOBALS['title']."', keyword) OR
			         INSTR('".$GLOBALS['description']."', keyword)";
			$res = mysql_query($query);
			if($res && @mysql_num_rows($res) > 0) {
				#// We have at least one banners to show
				while($row = mysql_fetch_array($res)) {
					$BANNERSARRAY[] = $row;
				}
			}
			$query = "SELECT * FROM PHPAUCTIONXL_bannerscategories WHERE category=".$GLOBALS['category'];
			$res = mysql_query($query);
			if($res && @mysql_num_rows($res) > 0) {
				#// We have at least one banners to show
				while($row = mysql_fetch_array($res)) {
					$BANNERSARRAY[] = $row;
				}
			}
			#// Pick a random element
			srand ((float) microtime() * 10000000);
			if(is_array($BANNERSARRAY)) {
				$RAND_IDX = array_rand($BANNERSARRAY);
				$BANNERTOSHOW = $BANNERSARRAY[$RAND_IDX][banner];
			}
		}


		#// We cannot apply filters in this page - let's retrieve a random banner
		if(empty($BANNERTOSHOW)) {
			$query = "SELECT * FROM PHPAUCTIONXL_banners ";
			if($BANNERSETTINGS[sizetype] == 'fix') {
				$query .= " WHERE width=$BANNERSETTINGS[width] AND height=$BANNERSETTINGS[height] ";
			} else {
				$query .= " WHERE 1";
			}

			$query .= " AND ((views < purchased AND purchased > 0) OR (purchased = 0))";
			$res = mysql_query($query);

			if($res && @mysql_num_rows($res) > 0) {
				$C = 0;

				#// We have at least one banners to show

				while($row = mysql_fetch_array($res)) {
					$C = @mysql_num_rows(mysql_query("SELECT banner FROM PHPAUCTIONXL_bannerscategories WHERE banner=$row[id]"));
					$CC = @mysql_num_rows(mysql_query("SELECT banner FROM PHPAUCTIONXL_bannerskeywords WHERE banner=$row[id]"));

					if($C == 0 && $CC == 0) {
						$BANNERSARRAY[] = $row;
					}
				}
			}

			#// Pick a random element
			srand ((float) microtime() * 10000000);
			if(is_array($BANNERSARRAY)) {
				$RAND_IDX = array_rand($BANNERSARRAY);
				$BANNERTOSHOW = $BANNERSARRAY[$RAND_IDX][id];
			}
		}



		#// ========================================================================================================================
		#// Display banner
		#// ========================================================================================================================
		if(isset($BANNERTOSHOW)) {
			$query = "SELECT * FROM PHPAUCTIONXL_banners WHERE id=$BANNERTOSHOW";
			$ress = @mysql_query($query);
			if($ress) {
				$THISBANNER = mysql_fetch_array($ress);
				if($THISBANNER[type] == 'swf') {
					if($HTTPS == "on" || $HTTPS == "1")
						$codebase="https://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0";
					else
						$codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
				?>

						  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="<?echo($codebase)?>" width="468" height="60">
						  <param name=movie value="<?echo($SETTINGS['siteurl'].$GLOBALS['uploaded_path'].'banners/'.$THISBANNER[user].'/'.$THISBANNER[name])?>" />
						  <param name=quality value=high />
							<embed src="<?echo($SETTINGS['siteurl'].$GLOBALS['uploaded_path'].'banners/'.$THISBANNER[user].'/'.$THISBANNER[name])?>" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="<?echo($THISBANNER[width])?>" height="<?echo($THISBANNER[height])?>"> </embed>
						  </object>
				   <?
			   } else {
			   if(strstr($_SERVER["PATH_TRANSLATED"],"stores")) {
				   $UPLD = "uploaded/";
				   //$UPLD = "../../uploaded/";
			   }
			   else {
				   $UPLD = $GLOBALS['uploaded_path'];
			   }
			   ?>
			   <a href="../<?echo($SETTINGS['siteurl'])?>clickthrough.php?banner=<?echo($THISBANNER['id'])?>&url=<?echo($THISBANNER['url'])?>" target="_blank"> <img border=0 alt="<?echo($THISBANNER['alt'])?>" src="../<?echo($SETTINGS['siteurl'].$UPLD)?>banners/<?echo($THISBANNER['user'])?>/<?echo($THISBANNER['name'])?>" /></a>
					   <?
				   }
				   if(!empty($THISBANNER[sponsortext])) {
					   ?>
					   <br />
					   <a href="../<?echo($SETTINGS['siteurl'])?>clickthrough.php?banner=<?echo($THISBANNER['id'])?>&url=<?echo($THISBANNER['url'])?>" target="_blank">
							   <?echo($THISBANNER['sponsortext'])?>
								  </a>
								  <?
							  }
							  #// Update views
							  @mysql_query("UPDATE PHPAUCTIONXL_banners set views=views+1 WHERE id=".$THISBANNER['id']);
			}
		}
		#// ========================================================================================================================

	}
}
?>
