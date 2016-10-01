<?php
	session_start();
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

	//$qry = "UPDATE BLOGMASTER SET BLOG_TITLE='$_POST[title]',BLOG_DESC='$_POST[desc]' WHERE BLOG_ID='$_POST[ID]'";
	$qry = "UPDATE BLOGMASTER SET BLOG_TITLE='$_POST[title]',BLOG_DESC='$_POST[desc]',UPDATED_DATE=CURDATE() WHERE BLOG_ID='$_POST[ID]'";
	
	$abc = mysqli_query($conn,$qry);
	
	mysqli_close($conn);
	$_SESSION['update']="yes";
	header("Location: read_more.php");
	
	}
?>

