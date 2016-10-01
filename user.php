<?php
	session_start();
	if($_SESSION['username']=='Admin' ){
	
	$_SESSION['update']="no";
	$host='localhost';
	$user='root';
	$pass='';
	$db='blog';

	// Create connection
	$conn = new mysqli($host,$user,$pass,$db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$qry = "SELECT * FROM BLOGGERINFO WHERE IS_ACTIVE=1";
	$abc = mysqli_query($conn,$qry);
?>
<html>
	<head>
		<title>User Display</title>
		<link rel="stylesheet" type="text/css" href="users.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					<a class="abc" href="user_page.php">Home</a>
					<a class="abc" href="user_info.php">Account</a>
					<a class="abc" href="logout.php">Log Out</a>
				</div>
			</div>
			<div id="explore">
				Users Information
			</div>
			<div id="block">
				<table>
				<tr>
					<tH>Name</tH><tH>Email</tH><tH>Creation Date</tH><tH>Updated Date</tH>
				</tr>
				
				<?PHP while($row = mysqli_fetch_array($abc)){ ?>
					<tr>
						<td><?php echo $row['USERNAME'];?></td><td><?php echo $row['EMAIL']; ?></td>
						<td><?php echo $row['CREATION_DATE'];?></td><td><?php echo $row['UPDATED_DATE'];?></td>
						<td> 
							<form action="delete_user.php" method="post">
								<input type="hidden" value=<?php echo $row['USERNAME']?> name="user">
								<input id="button" type="submit" value="Delete" name="submit">
							</form>
						</td>
					</tr>
				<?php }?>
				</table>
			</div>
		</div>
	</body>
</html>
<script>
<?php
	if(isset($_SESSION["delete"]) && $_SESSION["delete"]=="yes"){
		?>alert("Successfully Deleted  :)"); <?php
		$_SESSION["delete"]="no";
	}
	if(isset($_SESSION["delete"]) && $_SESSION["delete"]=="yes"){
		?>alert("Error!"); <?php
		$_SESSION["delete"]="no";
	}
	}else{
		include "error_page.php";
	}
?>
</script>