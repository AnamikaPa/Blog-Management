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
	
	$qry = "SELECT * FROM CONTACT ";
	$abc = mysqli_query($conn,$qry);
?>
<html>
	<head>
		<title>Contact Display</title>
		<link rel="stylesheet" type="text/css" href="a_contact.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					<?php if($_SESSION['username']=="Admin"){ ?>		
					<a class="abc" href="admin.php">Home</a>
					<?php }else{ ?>		
					<a class="abc" href="user_page.php">Home</a>
					<?php } ?>
					<a class="abc" href="user_info.php">Account</a>
					<a class="abc" href="logout.php">Log Out</a>
				</div>
			</div>
			<div id="explore">
				Viewers Contacts
			</div>
			<div id="block">
				<table>
				<tr align="center">
					<?php if(mysqli_num_rows($abc)!=0){ ?><tH>Name</tH><tH>Email</tH><tH>Phone Number</tH><tH>Comment</tH>
					<?php }else{
						echo "No contacts yet !!";
					} ?>
				</tr>
				
				<?PHP while($row = mysqli_fetch_array($abc)){ ?>
					<tr>
						<td><?php echo $row['Name'];?></td><td><?php echo $row['Email']; ?></td>
						<td><?php echo $row['Number'];?></td><td><?php echo $row['Comment'];?></td>
						<td> 
							<form action="contact_del.php" method="post">
								<input type="hidden" value=<?php echo $row['ID']?> name="user">
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
	if(isset($_SESSION["delete"]) && $_SESSION["delete"]=="error"){
		?>alert("Error!"); <?php
		$_SESSION["delete"]="no";
	}
	}else{
		include "error_page.php";
	}
?>
</script>