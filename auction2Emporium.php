<?PHP
define("APP_ROOT", $_SERVER['DOCUMENT_ROOT'].'/whtw
');
require_once "../gwsecurity/private/initialize.php";


$result = mysql_query("Select * from PHPAUCTIONXL_auctions ");
	if (!$result) {trigger_error("problem with sql" . mysql_error($result));
	exit;
	}
	$bump_factor = 5;
	$dchange = new entryControlDate;
	$cat = new PHPAUCTIONXL_categories;
	$EntryDate = $dchange->get_post_date();
while($row = mysql_fetch_array($result))
{	
	print "<br> EntryDate is  " . $EntryDate;
	$RecordID = time() + $bump_factor;
	$bump_factor +=5;
 	print "<br> RecordID = " . $RecordID ;
	$product_name = $row['title'];
	$description = $row['description'];
	if ($row['pict_url'] == '')
	{
	$pic_main='';
	$pic_main_sm = '';
	}
		else 
		{
	
		if ($row['photo_uploaded'] == '0'){  // file uploaded
		
			$pic_main = $row['pict_url'];
			$pic_directory_source = "http://www.peggyjostudio.net/emporium/Images/";
			$pic_array = explode('/',$row['pict_url']);
			$ptr = count($pic_array) ;
			$pic_main_sm = "http://www.graypluswhite.com/phpauction/uploaded/thumbs/" . $pic_array[$ptr-1];
			$pic_image_source = $pic_array[$ptr-1];
			}
				else
				{
					$pic_directory_source = "http://www.graypluswhite.com/phpauction/uploaded/";
					$pic_main = "http://www.graypluswhite.com/phpauction/uploaded/" . $row['pict_url'] ;
					$pic_main_sm = "http://www.graypluswhite.com/phpauction/uploaded/thumbs/" .$row['pict_url'];
					
					$pic_image_source = $row['pict_url'];
					}
					$thumbDirectory = "../phpauction/uploaded/thumbs/";
			
			$name = $pic_main ;
			$filename = $thumbDirectory . $pic_image_source;
			print "<br> Creating thumbnail with "  . $name  . ", " .  $filename ;
			
			$pic_main_sx = $cat->createthumb($name,$filename,80,80);
		} // end of pict_url not blank
		
	$unit_price = $row['reserve_price'];
	$sku= $row['user'] . "-" . $row['category'] . '-' . $row['id'];
	$inventory=1;
	$categories = $cat->getCategoryNames($row['category']);
	$category = $categories[0];
	$subcategory = $categories[1];
	
	
	print "<br> product name  : " .$product_name;
	print "<br> unit price " . $unit_price;
	print "<br> category is " . $category;
	print "<br> sub category is " . $subcategory;
	print "<br> description is : " . $description;
	print "<br> pic_main is : " . $pic_main;
	print "<br> pic_main_sm is :". $pic_main_sm;
	print "<br> sku is : " . $sku;
	$sql2= "insert into paypal_products set EntryDate = \"$EntryDate\", 
					RecordID=\"$RecordID\",
					product_name = \"$product_name\",
					sku = \"$sku\",
					unit_price = \"$unit_price\",
					category = \"$category\",
					subcategory = \"$subcategory\",
					pic_main = \"$pic_main\",
					pic_main_sm = \"$pic_main_sm\",
					description = \"$description\",
					short_description = \"$description\",
					inventory = \"$inventory\" ";
	$resultpost = mysql_query($sql2);
	if (!$resultpost){
		trigger_error("	Record not added". mysql_error());
		exit;
		}			
	
	
} // end of while	
	
?>
