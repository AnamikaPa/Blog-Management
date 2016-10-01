<?php
	session_start();
	
	echo $_SESSION['id']=$_POST['update'];
	
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
	echo $_POST['approve'];
	if(isset($_POST['approve'])){
		echo "approve";
		echo $_SESSION['id'];
		
		$qry = "SELECT * FROM ADMINREQUEST WHERE BLOG_ID='$_SESSION[id]'";
		$abc = mysqli_query($conn,$qry);
		$def = mysqli_fetch_array($abc);
	
		$query = mysqli_query($conn,"UPDATE BLOGMASTER SET BLOG_IS_ACTIVE=1 WHERE BLOG_TITLE='$def[BLOG_TITLE]' and BLOG_ID='$_SESSION[id]'");
		$query1 = mysqli_query($conn,"DELETE FROM ADMINREQUEST WHERE BLOG_ID='$_SESSION[id]'");
		$_SESSION['approve']="yes";
		
		header("Location: admin.php");
		
	}
	if(isset($_POST['reject'])){
		echo "reject";
		echo $_POST['reason'];
		
		$qry = "SELECT * FROM ADMINREQUEST WHERE BLOG_ID='$_SESSION[id]'";
		$abc = mysqli_query($conn,$qry);
		$def = mysqli_fetch_array($abc);
	
		$query = mysqli_query($conn,"UPDATE BLOGMASTER SET ADMIN_REVIEW='$_POST[reason]' WHERE BLOG_TITLE='$def[BLOG_TITLE]' and BLOG_ID='$_SESSION[id]'");
		$query1 = mysqli_query($conn,"DELETE FROM ADMINREQUEST WHERE BLOG_ID='$_SESSION[id]'");
		$_SESSION['reject']="yes";
		
		header("Location: admin.php");
	}
	
?>