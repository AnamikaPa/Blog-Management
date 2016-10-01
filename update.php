<?php
	session_start();
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
	$_SESSION['id']=$_POST['update'];
	
	$qry = "SELECT * FROM BLOGMASTER WHERE BLOG_ID='$_SESSION[id]'";
	$abc = mysqli_query($conn,$qry);
	$row = mysqli_fetch_array($abc);
	$a = $row['BLOG_TITLE'];
	$b = $row['BLOG_DESC'];
?>

<html>
	<head>
		<title>Get Started</title>
		<link rel="stylesheet" type="text/css" href="update.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					<a class="abc" href="user_page.php"><?php echo $_SESSION["username"]?></a>
					<a class="abc" href="logout.php">Log Out</a>
				</div>
			</div>
			<div id="div">
				<form action="update_next.php" method="post">
					<P>Title:<BR />
					<input id="title" type="text" value="<?=$a?>" name="title" required>
					</P>
					<input type="hidden" value=<?php echo $_SESSION['id'];?> name='ID'>
					<P>
					Desc:<br />
					<textarea type="text" name="desc" required><?Php echo $b;?></textarea>
					</P>
					<input type="submit" id="button" value="Update" name="submit">
				</form>	
			</div>
		</div>
	</body>
</html>