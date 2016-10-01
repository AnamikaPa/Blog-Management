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
	
		$qry = "DELETE FROM CONTACT WHERE ID ='$_POST[user]'";
		$abc = mysqli_query($conn,$qry);
		if($abc){
			$_SESSION['delete']="yes";
		}
		else{
			$_SESSION['delete']="error";
		}
		header("Location:a_contact.php");
	}

?>