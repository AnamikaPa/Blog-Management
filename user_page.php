<?php
	session_start();
	if($_SESSION['username']!='username' && $_SESSION['username']!='Admin'){
	
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
	
	$qry = "SELECT * FROM BLOGMASTER WHERE BLOG_AUTHOR='$_SESSION[username]' ORDER BY BLOG_ID desc";
	$abc = mysqli_query($conn,$qry);
	
?>
<html>
	<head>
		<title>User Page</title>
		<link rel="stylesheet" type="text/css" href="user_page4.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					
					<?php if($_SESSION["username"]=="Admin"){?>
						<a class="abc" href="admin.php">Home</a>
					<?php }else{?>
						<a class="abc" href="user_page.php">Home</a>
					<?php }?>
					<a class="abc" href="user_info.php">Account</a>
					<a class="abc" href="logout.php">Log Out</a>
				</div>
			</div>
			<form action="get_started.php">
			<div id="get_started">
				<p align="center">Want to form a new Blog?</p>
					<input type="submit" value="Get Started">		
			</div>
			
			</form>
			<br /><br /><br /><br /><br /><br /><br />
			
			<?PHP
				if(mysqli_num_rows($abc)==0){

					?>
				<div id="no"><?php echo "No Blogs yet :(";?>
				<?php }
				else{
				while($row = mysqli_fetch_array($abc)){ 
					$ab = mysqli_query($conn,"SELECT * FROM BLOGDETAIL WHERE BLOG_ID='$row[BLOG_ID]' ");	
					$de = mysqli_fetch_array($ab);
					$a = $de['IMAGE_NAME'];
				?>	
			<div id="blog">
				<?php if($row['BLOG_IS_ACTIVE']==1){ ?>
					<div style="float:right; background-color:green; width:15px; height:15px"></div>
					<p style="float:right; position:relative;">Active</p>
				<?php }else { 
					if($row['ADMIN_REVIEW']==''){?>
					<div style="float:right; background-color:RED; width:15px; height:15px"></div>
					<p style="float:right; position:relative;">Not yet Approved by Admin</p>
					<?php }else{ ?>
					<div style="float:right; background-color:RED; width:15px; height:15px"></div>
					<p style="float:right; position:relative;">Rejected by Admin</p>
				<?php }} ?>
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
					<form id="button" action="update.php" method="post">
						<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="update">
						<input type="submit" value="Update" name="submit">
					</form>
					
					<form id="button" action="del_blog.php" method="post">
						<input type="hidden" value=<?php echo $row['BLOG_ID'];?> name="del" >
						<input type="submit" value="Delete" name="submit">
					</form>
					
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
				<?PHP } }?>
		</div>

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
	if(isset($_SESSION["re"]) && $_SESSION["re"]=="yes"){
		?>alert("Successfully sent to Admin  :)"); <?php
		$_SESSION["re"]="no";
	}
	if(isset($_SESSION["re"]) && $_SESSION["re"]=="error"){
		?>alert("Error!"); <?php
		$_SESSION["re"]="no";
	}
?>
</script>	
<?php
	if(isset($_SESSION["blog"]) && $_SESSION["blog"]=="yes"){
		?><script>alert("You blog had been sent to ADMIN for permission :)");</script><?php
		$_SESSION["blog"]="no";
	}
	}else{
		include "error_page.php"; 	
	}
?>
	</body>
</html>