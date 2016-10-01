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
	
	$qry = "SELECT * FROM BLOGMASTER WHERE BLOG_IS_ACTIVE=1 ORDER BY BLOG_ID desc";
	$abc = mysqli_query($conn,$qry);
?>

<html>
	<head>
		<title>All Blogs</title>
		<link rel="stylesheet" type="text/css" href="all_blog.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					<?php
						if($_SESSION["username"] !="username" && $_SESSION["username"]!="Admin"){?>
							<a class="abc" href="admin.php" title="Home">Home</a>
							<a class="abc" href="user_info.php">Account</a>
							<a class="abc" href="logout.php">Log Out</a>
						<?php  }
						else if($_SESSION["username"] !="username" && $_SESSION["username"]=="Admin"){?>
							<a class="abc" href="admin.php" title="Home"><?PHP echo "Welcome ".$_SESSION["username"]."!!";?></a>
							<a class="abc" href="logout.php">Log Out</a>
						<?php  }else{ ?>
							<a class="abc" href="login.php">Sign In</a>
					<?php } ?>
				</div>
			</div>
			<div id="explore">
				Explore * Dream * Discover
			</div>
			<?PHP		
				while($row = mysqli_fetch_array($abc)){ 
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
					<?php if($_SESSION["username"] =="Admin"){?>
					<form id="button" action="del_blog.php" method="post">
						<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="del">
						<input type="submit" value="Delete" name="submit">
					</form>
					<?php }?>
					<?php if($_SESSION["username"] !="username" && $row['BLOG_AUTHOR']==$_SESSION['username']){?>
					<form id="button" action="update.php">
						<input type="hidden" value=<?php echo $row['BLOG_ID'];?> >
						<input type="submit" value="Update" name="submit">
					</form>
					<?php }?>
					</div>
				</div>
			</div>
			<?PHP } ?>
		</div>
	</body>
</html>
<script>
<?php
	if(isset($_SESSION['delete']) && $_SESSION['delete']=="yes"){
		?>alert("Successfully Deleted  :)"); <?php
		$_SESSION['delete']="no";
	}if(isset($_SESSION['delete']) && $_SESSION['delete']=="error"){
		?>alert("Error! :("); <?php
		$_SESSION['delete']="no";
	}
?>
</script>