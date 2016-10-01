<?php
	session_start();
	if($_SESSION['username']=='Admin'){
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
	
	$qry = "SELECT * FROM ADMINREQUEST ";
	$abc = mysqli_query($conn,$qry);
	
?>
<html>
	<head>
		<title>Admin Page</title>
		<link rel="stylesheet" type="text/css" href="admin1.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					<a class="abc" href="admin.php" title="Home">Home</a>
					<a class="abc" href="user.php"> User's Info </a>
					<a class="abc" href="a_contact.php">Visitor's Contact </a>
					<a class="abc" href="user_info.php">Account</a>
					<a class="abc" href="logout.php">Log Out</a>
				</div>
			</div>
			
			<?PHP		
				while($row = mysqli_fetch_array($abc)){ 
					$_SESSION['id']=$row['BLOG_ID'];
					$ab = mysqli_query($conn,"SELECT * FROM BLOGDETAIL WHERE BLOG_ID='$row[BLOG_ID]'");	
					$de = mysqli_fetch_array($ab);
					$a = $de['IMAGE_NAME']
				?>
			<div id="blog">
				<div id="author"><?php echo $row['BLOG_AUTHOR']; ?></div>
				<div id="cat"><?php echo $row['BLOG_CATEGORY']; ?></div>
				<div id="image">
					<?php echo "<img src='image/$a' align='center' height=300px >"?>
				</div>
				<div id="desc">
					<h2> <?php echo $row['BLOG_TITLE']; ?> </H2>
					<?php echo substr($row['BLOG_DESC'],0,800)."....."; ?>
					<br /><br /><hr />
					<div >
					<form id="button" action="read_more.php" method="post">
						<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="readmore" >
						<input type="submit" value="Read More>>>" name="submit">
					</form>
					<form id="button" action="approve.php" method="post">
						<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="update" >
						<input type="submit" value="Approve" name="approve">
					</form>
					<form id="button" action="read_more.php" method="post">
						<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="readmore" >
						<input type="submit" value="Reject" name="rjct">
					</form>
					
					</div>
				</div>
			</div>
			<?PHP } ?>
		</div>
	</body>
</html>
<script>
<?php
	if(isset($_SESSION['approve']) && $_SESSION['approve']=="yes"){
		?>alert("You had approved the blog :)");<?php
		$_SESSION['approve']="no";
	}
	if(isset($_SESSION['reject']) && $_SESSION['reject']=="yes"){
		?>alert("You had rejected the blog :)");<?php
		$_SESSION['reject']="no";
	}
	}else{
		include "error_page.php"; 	
	}
?>
</script>