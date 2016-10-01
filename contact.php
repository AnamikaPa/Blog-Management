<?php
	session_start();
	
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
	
?>
<html>
	<head>
		<title>Contact Us</title>
		<link rel="stylesheet" type="text/css" href="contact.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					<a class="abc" href="main.php">Back</a>
				</div>
			</div>
			<div id="explore">
				Contact Us
			</div>
	
			
			<form name="myForm" onsubmit="return validateForm(this)" action="contact.php" method="post">
				<div id="login">
					<p>Name*:<br /> 
						<input type="text" name="Name" placeholder="Name" required></input>
					</p>
					<p>Email*:<br />
						<input type="text" name="Email" placeholder="Email" required></input>
					</p>
					<p>Phone Number:<br />
						<input type="number" name="p_number" placeholder="Phone Number" ></input>
					</p>
					<p>Comment:<br />
						<textarea name="comment" required></textarea>
					</p>
					<input class="button" type="submit" name="submit" value="Submit"></input>
				</div>
			</form>
			<div id="block2">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.623800701072!2d72.78290001417079!3d21.16736458592344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04dede93ea7d1%3A0x238a612304b01088!2sSardar+Vallabhbhai+National+Institute+of+Technology!5e0!3m2!1sen!2sin!4v1469644481263" width="96%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	function validateForm(form){
		
		re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(!re.test(form.Email.value)){
			alert("Error: You have entered an invalid email address");
			form.Email.focus();
			return false;
		}
		alert("Successfully Submitted  :)");
		return true;
	}
</script>
<?php
if(isset($_POST["submit"])){
	
	$qry = "INSERT INTO CONTACT VALUES('','$_POST[Name]','$_POST[Email]','$_POST[p_number]','$_POST[comment]')";
	$abc = mysqli_query($conn,$qry);
	header("Location: main.php");
}
?>