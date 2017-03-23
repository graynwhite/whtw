<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?PHP
$dataToUpdate = $_GET['dataToUpdate'];
include("../cgi-bin/connect.inc");
$data_input = explode("|",$dataToUpdate);
$mode= ($data_input[9] == '00') ? "add" : "change";
//echo "Mode is " . $mode . "<br>";
	switch ($mode) {
	case	"delete" :
			$sql= "delete from places where place_num = \"$place_num\" ";
			$result_description = "Record Deleted";
			break;
	case	"add" :
			$sql="insert into places";
			$sql .= " set 
		   address = \"$data_input[1]\",
		   city= \"$data_input[2]\",
		   state= \"$data_input[3]\",
		   zip = \"$data_input[4]\",
		   phone = \"$data_input[5]\",
		   place_name = \"$data_input[0]\",
		   directions = \"$data_input[8]\",
		   url = \"$data_input[6]\",
		   email = \"$data_input[7]\" ";
		   
		   $result_description = "Record Added";
		   break;	
		default:
		$sql= "update places ";
		$sql .= " set 
		   address = \"$data_input[1]\",
		   city= \"$data_input[2]\",
		   state= \"$data_input[3]\",
		   zip = \"$data_input[4]\",
		   phone = \"$data_input[5]\",
		   place_name = \"$data_input[0]\",
		   directions = \"$data_input[8]\",
		   url = \"$data_input[6]\",
		   email = \"$data_input[7]\" 
		   where place_num = \"$data_input[9]\" ";
		   
		   $result_description = "Record changed"; 
	} // end od switch
		//echo "<br>" . $sql;
		$result = mysql_query($sql);
		
		
           if (!$result){ 
              echo("<p>error performing query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p> ");
           exit();
           }
		echo $result_description;
		
          
?>


