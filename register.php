<script>
<?php
	session_start();
	if($_SESSION["username"]=="username"){
		?> alert("This Username is already in use.Try another one");<?php
	}
	if($_SESSION["email"]=="email"){
		?> alert("This Email is already in use.");<?php
	}
	session_destroy();
?>
</script>
<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="register.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
			</div>
			<form action="register.php" onsubmit="return validateForm(this)" method="post">
				<div id="login">
					<p>Username<br />
						<input type="text" name="Username" value="" required></input>
					</p>
					<p>Email address<br />
						<input type="text" name="Email" value="" required></input>
					</p>
					<p>Password<br />
						<input type="password" name="Password" title="Passwords must contain at least six characters, including uppercase, lowercase letters, numbers and special characters." value="" required></input>
					</p>
					<p>Confirm Password<br />
						<input type="password" name="Cpassword" value="" required></input>
					</p>
					<input class="button" name="submit" type="submit" value="Create Account"></input>
				</div>
			</form>
			<div id="return"><a href="main.php" title="Are u Lost?">Return to Think.com</a>
			</div>
		</div>
	</body>
</html>

<script type="text/javascript">
	function validateForm(form){

		re=/^\w+$/;
		if(!re.test(form.Username.value)){
			alert("Error: Username must contain only letters, numbers and underscores!");
			form.Username.focus();
			return false;
		}
		re=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(!re.test(form.Email.value)){
			alert("Error: You have entered an invalid email address");
			form.Email.focus();
			return false;
		}

		if(form.Password.value == form.Cpassword.value){
			if(form.Password.value.length < 6) {
       			alert("Error: Password must contain at least six characters!");
        		form.Password.focus();
        		return false;
        	}
        	re = /[0-9]/;
      		if(!re.test(form.Password.value)) {
        		alert("Error: password must contain at least one number (0-9)!");
        		form.Password.focus();
        		return false;
      		}
      		re = /[a-z]/;
      		if(!re.test(form.Password.value)) {
        		alert("Error: password must contain at least one lowercase letter (a-z)!");
        		form.Password.focus();
        		return false;
      		}
      		re = /[A-Z]/;
      		if(!re.test(form.Password.value)) {
        		alert("Error: password must contain at least one uppercase letter (A-Z)!");
        		form.Password.focus();
        		return false;
      		}
      		re = /[!@#$%^&*]/;
      		if(!re.test(form.Password.value)) {
        		alert("Error: password must contain at least one Special Charecter(!@#$%^&*)!");
        		form.Password.focus();
        		return false;
      		}
		}else{
			alert("Error: Please check that you've entered and confirmed your password!");
      		form.Password.focus();
      		return false;
		}

		return true;
	}
</script>

<?php
	
if(isset($_POST['submit'])){
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

	$abc = mysqli_query($conn,"SELECT * FROM BloggerInfo WHERE BINARY USERNAME='$_POST[Username]' or BINARY USERNAME='Admin' or BINARY USERNAME='username'");
	$def = mysqli_query($conn,"SELECT * FROM BloggerInfo WHERE BINARY EMAIL='$_POST[Email]'");
	if(mysqli_num_rows($abc)!=0){
		echo "this username is already in use";
		session_start();
		$_SESSION["username"] = "username";
		$_SESSION["email"] = "abc";
		header("Location: register.php");
	}else if(mysqli_num_rows($def)!=0){
		session_start();
		$_SESSION["email"] = "email";
		$_SESSION["username"] = "abc";
		header("Location: register.php");
	}
	else{
		$sql = "INSERT INTO BloggerInfo(USERNAME,EMAIL,PASSWORD,CREATION_DATE,IS_ACTIVE,UPDATED_DATE)
		VALUES ('$_POST[Username]','$_POST[Email]','$_POST[Password]',CURDATE(),1,CURDATE())";

		if ($conn->query($sql) === TRUE) {
			session_start();
			$_SESSION['register']="yes";
			$_SESSION['username']=$_POST['Username'];
			header("Location: main.php");
		} else {
			header("Location: register.php");
		}
	}
	$conn->close();
}

?>