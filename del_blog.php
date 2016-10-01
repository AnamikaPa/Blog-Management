<?php
	session_start();
	if($_SESSION['username']=="Admin" || $_SESSION['username']!="username"){
		echo $_POST['del'];
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
		$d = mysqli_query($conn,"DELETE FROM ADMINREQUEST WHERE BLOG_ID='$_POST[del]'");
		$e = mysqli_query($conn,"DELETE FROM BLOGDETAIL WHERE BLOG_ID='$_POST[del]'");
		$qry = "DELETE FROM blogmaster WHERE BLOG_ID='$_POST[del]'";
		$abc = mysqli_query($conn,$qry);
		
		if($abc && $d && $e){
			$_SESSION['delete']="yes";
		}
		else{
			$_SESSION['delete']="error";
		}
			if($_SESSION['username']=="Admin")
				header("Location: all_blog.php");
			else header("Location: user_page.php");
	}
	else{
		include "error_page.php"; 	
	}
?>