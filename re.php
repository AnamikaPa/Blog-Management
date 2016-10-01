<?php
	session_start();
	if(isset($_POST['submit'])){
		echo $_POST['re'];
		
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
		$abc = mysqli_query($conn,"SELECT * FROM Blogmaster WHERE BLOG_ID='$_POST[re]'");
		$row = mysqli_fetch_array($abc);
		
		$a = mysqli_query($conn,"UPDATE Blogmaster SET ADMIN_REVIEW='' WHERE BLOG_ID='$_POST[re]'");
		
		$b = mysqli_query($conn,"INSERT INTO ADMINREQUEST VALUES('$row[BLOG_ID]','$row[BLOGGER_ID]','$row[BLOG_TITLE]','$row[BLOG_DESC]','$row[BLOG_CATEGORY]','$row[BLOG_AUTHOR]')");
		
		if($abc && $a && $b){
			$_SESSION['re']="yes";
		}
		else{
			$_SESSION['re']="error";
		}
		header("Location: user_page.php");
	}
?>