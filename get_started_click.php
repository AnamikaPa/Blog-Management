<?php
	session_start();
	if($_SESSION["username"] !="username"){
		header("Location: get_started.php");
	}else{
		header("Location: login.php");
	}
?>