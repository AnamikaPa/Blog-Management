<?php
	session_start();
	if(isset($_POST['title'])){
		echo $_POST['title'];
	}
	if(isset($_POST['desc'])){
		echo $_POST['desc'];	
	}
	echo $_SESSION['username'];
	echo $_SESSION["category"];
	
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
		
		//to store the info into bloggerInfo
		$abc = mysqli_query($conn,"SELECT * FROM BloggerInfo WHERE (BINARY USERNAME='$_SESSION[username]') or (BINARY EMAIL='$_SESSION[username]')");
		$def = mysqli_fetch_array($abc);
		
		$sql = mysqli_query($conn,"INSERT INTO BlogMaster(BLOGGER_ID,BLOG_TITLE,BLOG_DESC,BLOG_CATEGORY,BLOG_AUTHOR,BLOG_IS_ACTIVE,CREATION_DATE,UPDATED_DATE)
		VALUES ('$def[ID]','$_POST[title]','$_POST[desc]','$_SESSION[category]','$def[USERNAME]',0,CURDATE(),CURDATE())");
		
		$result = mysqli_query($conn,"SELECT * FROM BLOGMASTER where blog_id = ( select max(blog_id) from blogmaster)");
		$row = mysqli_fetch_array($result);
		
		$sqli = mysqli_query($conn,"INSERT INTO ADMINREQUEST(BLOG_ID,BLOGGER_ID,BLOG_TITLE,BLOG_DESC,BLOG_CATEGORY,BLOG_AUTHOR)
		VALUES ('$row[BLOG_ID]','$def[ID]','$_POST[title]','$_POST[desc]','$_SESSION[category]','$def[USERNAME]')");
		
		
		//to store the info into blog detail
		echo $row["BLOG_ID"];
		
				ECHO $image_name=$_FILES['image']['name'];
				ECHO $image_type=$_FILES['image']['type'];
				ECHO $image_size=$_FILES['image']['size'];
				ECHO $image_tmp_name=$_FILES['image']['tmp_name'];
				
				if($image_name=='' && $image_size==false){
					echo "<script> alert('plz apload an image'); </script>";
				}
				else{
					move_uploaded_file($image_tmp_name,"image/$image_name");
					echo "image Uploaded";
				}
		
		$rslt = mysqli_query($conn,"INSERT INTO blogdetail(BLOG_ID,IMAGE_NAME) VALUES('$row[BLOG_ID]','$image_name')");
		if($rslt){
			echo "image uploaded... :)";
		}
		$_SESSION["blog"]="yes";
		
		if ($sql && $sqli && $rslt) {
			?><H1 align="center" id="sub1">You successfully formed blog in.. :)</B></U></H1> <?php
		
		} else {
			echo htmlspecialchars (mysql_error ());
			?><H1 align="center" id="sub1">unable to form blog</B></U></H1> <?php
		}
			header("Location: user_page.php");

	}
?>