<script>
	<?php
	session_start();
	
	if($_SESSION["logout"]=="logout"){
		?> alert("You have Sucessfully logged out");<?php
		$_SESSION["logout"] = "loggedin";
	}
	if($_SESSION["username"]=='') $_SESSION["username"] ="username";
	?>
</script>


<html>
	<head>
		<title> BLOG SITE</title>
		<link rel="stylesheet" type="text/css" href="main1.css">
	</head>
	
	<body>
		<div id="pink">
			<div id="header">
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id ="right">
					<a class="abc" href="all_blog.php">Explore Blogs</a>
					<a class="abc" href="contact.php">Contact Us</a>
					<?php
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
			<div id="middle">
			<h1> Create your blog for free </h1>
			<p>Think.com is the best place for your personal blog.</br>
			 Share your stories and connect with others.</p>
			<a href="get_started_click.php">Get Started</a> 
			</div>
		</div>
		<div id="thought">
			<p>"My old paper journals take up so much space and aren’t searchable or taggable." – Dave D.
			</p>
		</div>
		<br />
		<div id="speciality">
			<ul id="three">
				<li><img src="copy.png" class="a">
				<div >Multiple author support and custom user settings foster collaboration.</div>
				</li>
				<li><img src="horn.png" class="a">
				<div >Social features encourage rich interactions and help grow your audience.</div>
				</li>
			</ul>
		</div>
		<br /><br />
		<div id="grass">
			<P>EXTRAORDINARY THINGS are always hiding in places <br />People never THINK TO LOOK</p>
			<a href="all_blog.php" >Explore our Blogs</a>
		</div>
		<br />
		<div id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.623800701072!2d72.78290001417079!3d21.16736458592344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04dede93ea7d1%3A0x238a612304b01088!2sSardar+Vallabhbhai+National+Institute+of+Technology!5e0!3m2!1sen!2sin!4v1469644481263" width="96%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<br />
	<body>
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
?>
</script>
<?php
	if(isset($_SESSION["register"]) && $_SESSION["register"]=="yes"){
		?><script>alert("You had Successfully created your account :)");</script><?php
		$_SESSION["register"]="no";
	}
?>