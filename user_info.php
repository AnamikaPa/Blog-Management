<?php
	session_start();
	if($_SESSION['username']!='username' ){
	
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
	if($_SESSION["username"]=="Admin"){
		$qry = "SELECT * FROM Admin ";
	}
	else
		$qry = "SELECT * FROM BLOGGERINFO WHERE USERNAME='$_SESSION[username]'";
	$abc = mysqli_query($conn,$qry);
	$row = mysqli_fetch_array($abc);
?>
<html>
	<head>
		<title>User Info Page</title>
		<link rel="stylesheet" type="text/css" href="user_info.css">
	</head>
	<body>
		<div id="pink">
			<div id="header">
				<a class="logo" href="main.php"></a>
				<img id ="left" src="logo.png" OnClick="main.php">
				<div id="right">
					<?php if($_SESSION['username']=="Admin"){ ?>		
					<a class="abc" href="admin.php">Home</a>
					<?php }else{ ?>		
					<a class="abc" href="user_page.php">Home</a>
					<?php } ?>
					<a class="abc" href="user_info.php">Account</a>
					<a class="abc" href="logout.php">Log Out</a>
				</div>
			</div>
			<div id="block">
				<h2>Personal Information </h2>
				<hr>
				<?PHP 
					if(!isset($_POST['edit'])){
						?> 
							<table>
								<tr>
								<td>UserName</td><td>: <?php echo $row['USERNAME'];?></td>
								</tr>
								<tr>
								<td>Email</td><td>: <?php echo $row['EMAIL'];?></td>
								</tr>
								<tr>
								<td>Creation Date</td><td>: <?php echo $row['CREATION_DATE'];?></td>
								</tr>
								<tr>
								<td>Updated Date</td><td>: <?php echo $row['UPDATED_DATE'];?></td>
								</tr>
							</table>
							<form action="user_info.php" method="post">
								<input id="button" type="submit" value="Edit Personal Info" name="edit">
							</form>
						<?php
					}
					else {
						?>
						<form action="edit.php" onsubmit="return validateForm(this)" method="post">
							<table>
								<tr>
								<td>UserName</td><td>: <input type="text" value=<?php echo $row['USERNAME'];?> name="Username" required></td>
								</tr>
								<tr>
								<td>Email</td><td>: <input type="text" value=<?php echo $row['EMAIL'];?> name="Email" required></td>
								</tr>
								<tr>
								<td>Password</td><td><input type="password" placeholder="Old Password" name="OPassword" ><br>
													   <input type="password" placeholder="New Password" name="Password" title="Passwords must contain at least six characters, including uppercase, lowercase letters, numbers and special characters."><br>
													   <input type="password" placeholder="Confirm New Password" name="Cpassword"><br>
								</td>
								</tr>
							</table>
							<input id="button" type="submit" value="Done Editing" name="done">
						</form>
						<?php
					}
					if ($_SESSION['username']!="Admin"){
					?>
					<form action="delete_user.php" method="post">
						<input type="hidden" value=<?php echo $row['USERNAME'];?> name="user">
						<input id="button" type="submit" value="Want to delete an account?" name="submit">
					</form>
					<?php } ?>
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
		
		if(form.OPassword.value!=''){
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
		}
		return true;
	}
<?php
		
		if(isset($_SESSION["usernam"]) && $_SESSION["usernam"]=="username"){
			?> alert("This UserName is already in Use.."); <?php
			$_SESSION["usernam"]='';
			$_POST['edit']='a';
		}
		if(isset($_SESSION["usernam"]) && $_SESSION["usernam"]=="email"){
			?> alert("This Email is already in use.."); <?php
			$_SESSION["usernam"]='';
			$_POST['edit']='a';
		}
		if(isset($_SESSION["usernam"]) && $_SESSION["usernam"]=="password"){
			?> alert("The Old Password you had entered is Wrong.."); <?php
			$_SESSION["usernam"]='';
			$_POST['edit']='a';
		}
		if(isset($_SESSION["register"]) && $_SESSION["register"]=="yes"){
			?> alert("Your personal info is successfully edited"); <?php
			$_SESSION["register"]="no";
		}
		}else{
		include "error_page.php"; 	
	}
	?>
</script>			
