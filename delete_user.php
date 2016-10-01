<?php
	session_start();
	if(isset($_POST['submit'])){
		echo $_POST['user'];
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
	
		$qry = "UPDATE BLOGGERINFO SET IS_ACTIVE=0,END_DATE=CURDATE() WHERE USERNAME='$_POST[user]' ";
		$abc = mysqli_query($conn,$qry);
		
		if($abc){
			echo "yes";
			$_SESSION["delete"]="yes";
		}
		else{
			echo "error";
			$_SESSION["delete"]="error";
		}
		if($_SESSION['username']=="Admin")
			header("Location: user.php");
		else{
			$_SESSION['username']="username";
			header("Location: main.php");
		}
	}
?>