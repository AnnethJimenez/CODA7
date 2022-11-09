<?php 
	include('db.php');
	session_start();
	$username=$_SESSION['username'];
	$ses_sql=mysqli_query($con,"SELECT username FROM admintb WHERE username='".$username."'");
	$row=mysqli_fetch_assoc($ses_sql);
	$login_session=$row['username'];
	if (!isset($login_session)) {
		header('Location:login');
	}
?>