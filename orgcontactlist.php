<?php	
define("APP_ROOT", $_SERVER['DOCUMENT_ROOT'].'/whtw');
	require_once "../gwsecurity/private/initialize.php";
	$sql="select Org_name,contact_name,contact_name,contact_phone,contact_email from orgs where contact_name
		  !=' '  order by Org_name";
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
	$result=mysqli_query($conn,$sql);
?>
<!doctype html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>Organization Contact List</title>
</head>

<body>
	<h1>Organization Contact List</h1>
	<table width="100%" border="4" bordercolordark="#000000" cols="4" >
		<tr>
		<th width="30%">Org Name</th>
		<th width="20%">Contact name</th>
		<th width="20%">Phone</th>
		<th width="30%">Email</th>
		</tr>
		<?php while($row=mysqli_fetch_assoc($result)){ ?>
			<tr>
				<td><?php echo($row["Org_name"])?></td>
				<td><?php echo($row["contact_name"])?></td>
				<td><?php echo($row["contact_phone"])?></td>
				<td><?php echo($row["contact_email"])?></td>
			</tr>
		<?php }?>
	</table>
	
</body> 
	
</html>