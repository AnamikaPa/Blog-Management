<?php
	session_start();
	if($_SESSION['update']=="yes"){
		?><script>alert("You had Successfully Updated your Blog.. :)");</script><?php
		$_SESSION['update']="no";
	}
	
	if(isset($_POST['readmore'])){
	$_SESSION['id'] = $_POST['readmore'];
	}
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
	
	$qry = "SELECT * FROM BLOGMASTER WHERE BLOG_ID='$_SESSION[id]'";
	$abc = mysqli_query($conn,$qry);
	$row = mysqli_fetch_array($abc);
	
?>

<html>
	<head>
		<title>Read More</title>
		<link rel="stylesheet" type="text/css" href="read_more.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right"><?php
						if($_SESSION["username"] !="username" && $_SESSION["username"]!="Admin"){?>
							<a class="abc" href="user_page.php" title="Home"><?PHP echo "Welcome ".$_SESSION["username"]."!!";?></a>
							<a class="abc" href="logout.php">Log Out</a>
						<?php  }
						else if($_SESSION["username"] !="username" && $_SESSION["username"]=="Admin"){?>
							<a class="abc" href="admin.php" title="Home"><?PHP echo "Welcome ".$_SESSION["username"]."!!";?></a>
							<a class="abc" href="logout.php">Log Out</a>
						<?php  }
						else{ ?>
							<a class="abc" href="login.php">Sign In</a>
					<?php } ?>
				</div>
			</div>
			<div id="blog">
				<?PHP
					$ab = mysqli_query($conn,"SELECT * FROM BLOGDETAIL WHERE BLOG_ID='$row[BLOG_ID]'");	
					$de = mysqli_fetch_array($ab);
					$a = $de['IMAGE_NAME'];
					
					$admin = mysqli_query($conn,"SELECT * FROM ADMINREQUEST WHERE BLOG_ID='$row[BLOG_ID]'");
					
					
				?>
				<div id="cat"><?php echo $row['BLOG_CATEGORY']; ?></div>
				<div id="image">
					<?php echo "<img src='image/$a' align='center' height=300px >"?>
				</div>
				<div id="desc">
					<h2> <?php echo $row['BLOG_TITLE']; ?> </H2>
					<?php echo $row['BLOG_DESC']; ?>
					<br /><br /><hr />
					<div >
					<?php 
					if($_SESSION["username"] != "Admin" && $_SESSION["username"]!="username"){ ?>
						<form id="button" action="del_blog.php" method="post">
							<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="del">
							<input type="submit" value="Delete" name="submit">
						</form>
					<?php }
					if($_SESSION["username"] !="username" && $_SESSION['username']=="Admin" && mysqli_num_rows($admin)!=0){?>
						
						<form id="button" action="approve.php" method="post">
							<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="update" >
							<input type="submit" value="Approve" name="approve">
						</form>
						<form id="button" action="read_more.php" method="post">
							<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="update" >
							<input type="submit" value="Reject" name="rjct">
						</form>
						<?php 
							if(isset($_POST['rjct'])){?>
								<form id="text" action="approve.php" method="post">
									<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="update" >
									<input class="text" type="text" name="reason" placeholder="Reason for Rejection.">
									<input type="submit" value="Submit" name="reject">
								</form>
						<?PHP }?>
						
					<?php }
					else if($_SESSION["username"] !="username" && $row['BLOG_AUTHOR']==$_SESSION['username']){?>
					<form id="button" action="update.php" method="post">
						<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="update" >
						<input type="submit" value="Update" name="submit">
					</form>
					<?php }?>
					
					<?php if($row['ADMIN_REVIEW']!=''){ ?>
						<form id="button" action="re.php" method="post">
							<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="re" >
							<input type="submit" value="Resend to Admin" name="submit">
						</form>
						<div style="margin-left:20px; padding:10px; width:100%; height:30px">
							<b>Admin Review:</b> <?php echo $row['ADMIN_REVIEW']; ?>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php mysqli_close($conn);?>