<?php
	session_start();
	if(isset($_POST['done'])){
		echo $_POST['Username'];
		echo $_POST['Email'];
		echo $_POST['OPassword'];
		echo $_POST['Password'];
		echo $_POST['Cpassword'];
		
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
		
		if($_SESSION['username']=="Admin"){
			$abc = mysqli_query($conn,"Select * from Admin ");
			$abc = mysqli_fetch_array($abc);
			if($_POST['OPassword']!=''){
			$abc = mysqli_query($conn,"Select * from Admin where BINARY PASSWORD='$_POST[OPassword]'");
			if(mysqli_num_rows($abc)==0){
				echo "user";
				$_SESSION['usernam']="password";
				echo $_SESSION['usernam'];
				header("Location: user_info.php");
			}
			else{
				$def = mysqli_query($conn,"UPDATE Admin set USERNAME='$_POST[Username]',EMAIL='$_POST[Email]',PASSWORD='$_POST[Password]',UPDATED_DATE=CURDATE()");
				$_SESSION['register']="yes";
				header("Location: user_info.php");
			}
		}
		else{
			$def = mysqli_query($conn,"UPDATE BloggerInfo set USERNAME='$_POST[Username]',EMAIL='$_POST[Email]',UPDATED_DATE=CURDATE() ");
			$_SESSION['username']=$_POST['Username'];
			$_SESSION['register']="yes";
			header("Location: user_info.php");
		}
		}
		else{
		$ab= mysqli_query($conn,"SELECT * FROM BloggerInfo WHERE BINARY USERNAME='$_SESSION[username]' ");
		$a = mysqli_fetch_array($ab);
	
		echo "<br>".$a['USERNAME'];
		echo "<br>".$_SESSION['username'];
		echo "<br>".$_POST['Username'];
		
		if($_SESSION['username']!=$_POST['Username']){
			$abc = mysqli_query($conn,"Select * from BloggerInfo where BINARY USERNAME = '$_POST[Username]' or BINARY USERNAME='Admin' or BINARY USERNAME='username'");
			if(mysqli_num_rows($abc)!=0){
				echo "user";
				$_SESSION['usernam']="username";
				echo $_SESSION['usernam'];
				header("Location: user_info.php");
			}
		}
		
		if($a['EMAIL']!=$_POST['Email']){
			$abc = mysqli_query($conn,"Select * from BloggerInfo where BINARY EMAIL = '$_POST[Email]'");
			if(mysqli_num_rows($abc)!=0){
				echo "user";
				$_SESSION['usernam']="email";
				echo $_SESSION['usernam'];
				header("Location: user_info.php");
			}
		}
		
		if($_POST['OPassword']!=''){
			$abc = mysqli_query($conn,"Select * from BloggerInfo where BINARY USERNAME = '$_SESSION[username]' and  BINARY PASSWORD='$_POST[OPassword]'");
			if(mysqli_num_rows($abc)==0){
				echo "user";
				$_SESSION['usernam']="password";
				echo $_SESSION['usernam'];
				header("Location: user_info.php");
			}
			else{
				$def = mysqli_query($conn,"UPDATE BloggerInfo set USERNAME='$_POST[Username]',EMAIL='$_POST[Email]',PASSWORD='$_POST[Password]',UPDATED_DATE=CURDATE() where ID='$a[ID]'");
				$_SESSION['username']=$_POST['Username'];
				$_SESSION['register']="yes";
				header("Location: user_info.php");
			}
		}
		else{
			$def = mysqli_query($conn,"UPDATE BloggerInfo set USERNAME='$_POST[Username]',EMAIL='$_POST[Email]',UPDATED_DATE=CURDATE() where ID='$a[ID]'");
			$_SESSION['username']=$_POST['Username'];
			$_SESSION['register']="yes";
			header("Location: user_info.php");
		}
		}
		
	$conn->close();
	}
?>