<?php
	session_start();
	if($_SESSION['username']!='username' && $_SESSION['username']!='Admin'){
?>
<html>
	<head>
		<title>Get Started</title>
		<link rel="stylesheet" type="text/css" href="get_started_next.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					<a class="abc" href="user_page.php">Home</a>
					<a class="abc" href="user_info.php">Account</a>
					<a class="abc" href="logout.php">Log Out</a>
				</div>
			</div>
			<div id="login">	
				<form name="myForm" action="blog_making.php" method="post" enctype="multipart/form-data">
					<input type="text" name="title" placeholder="Title for Blog" required>
					<textarea type="text" name="desc" placeholder="Description" required></textarea>
					Upload an Image:
					<input type="file" name="image" accept="image/jpeg"id="image" required>
					<input class="button" name="submit" type="submit" value="SUBMIT">
				</form>
			</div>
		</div>
	</body>
</html>
<?php
	
	if(isset($_POST['category'])){
		$_SESSION["category"] = $_POST['category'];
	}
	}else{
		include "error_page.php"; 	
	}
?>