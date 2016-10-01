<html>
</html>

<?php
if(isset($_POST['submit'])){
	echo $_POST["Email_Name"];
	echo $_POST["Password"];
	
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

	$abc = mysqli_query($conn,"SELECT * FROM BloggerInfo WHERE (Binary USERNAME='$_POST[Email_Name]' or Binary EMAIL='$_POST[Email_Name]') and Binary PASSWORD='$_POST[Password]' limit 1");
	$admin = mysqli_query($conn,"SELECT * FROM ADMIN WHERE (Binary USERNAME='$_POST[Email_Name]' or Binary EMAIL='$_POST[Email_Name]') and Binary PASSWORD='$_POST[Password]' limit 1");
	
	if(mysqli_num_rows($abc)==1){
		session_start();
		$def = mysqli_fetch_array($abc);
		if($def['IS_ACTIVE']==0){
			$_SESSION["usernam"]= "active";
			echo "yes";
			echo $_SESSION["usernam"];
			header("Location: login.php");
		}
		else{
			$_SESSION["username"] = $def['USERNAME'];
			header("Location: main.php");
		}
	}
	else if(mysqli_num_rows($admin)==1){
		session_start();
		$adm = mysqli_fetch_array($admin);
		$_SESSION["username"]="Admin";
		header("Location: main.php");
	}
	else{
		session_start();
		$_SESSION["usernam"] = "usernam";
		header("Location: login.php");
	}
}
?>