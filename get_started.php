<?php
	session_start();
	if($_SESSION['username']!='username' && $_SESSION['username']!='Admin'){
?>
<html>
	<head>
		<title>Get Started</title>
		<link rel="stylesheet" type="text/css" href="get_started.css">
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
			<div id="upper">
				<h1>Create your blog today!</h1>
				<p>Think.com is the best place for your Blog</p>
			</div>
			<form action="get_started_next.php" method="post">
				<div id="login">
					<p align="center">What is your blog about?</p>
					<hr />
					<input type="submit" name="category" value="Business & Services"></input>
					<input type="submit" name="category" value="Health & Wellness"></input>
					<input type="submit" name="category" value="Art & Entertainment"></input>
					<input type="submit" name="category" value="Education & Organizations"></input>
					<input type="submit" name="category" value="Family,Home & Lifestyle"></input>
					<input type="submit" name="category" value="Writing & Books"></input>
					<input type="submit" name="category" value="Politics & Policy"></input>
				</div>
			</form>
			<div id="return"><a href="main.php" title="Are u Lost?">Return to Think.com</a>
			</div>
			<br />
		</div>
	</body>
</html>
<?php
	if(isset($_POST['Business_&_Services'])){
		$_SESSION["category"] = "Business & Services";
		echo "Business & Services";
	}
	else if(isset($_POST['Health_&_Wellness'])){
		$_SESSION["category"] = "Health & Wellness";
		echo "Health_&_Wellness";
	}
	else if(isset($_POST['Art_&_Entertainment'])){
		$_SESSION["category"] = "Art & Entertainment";
		echo "Art_&_Entertainment";
	}
	else if(isset($_POST['Education_&_Organizations'])){
		$_SESSION["category"] = "Education & Organizations";
		echo "Education_&_Organizations";
	}
	else if(isset($_POST['Family,Home_&_Lifestyle'])){
		$_SESSION["category"] = "Family,Home & Lifestyle";
		echo "Family,Home_&_Lifestyle";
	}
	else if(isset($_POST['Writing_&_Books'])){
		$_SESSION["category"] = "Writing & Books";
		echo "Writing_&_Books";
	}
	}else{
		include "error_page.php"; 	
	}
?>