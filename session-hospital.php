<?php 
	include('db.php');
	session_start();
	$user_check=$_SESSION['dname'];
	$ses_sql=mysqli_query($con,"SELECT username FROM doctb WHERE username='$user_check' ORDER BY ID");
	$row=mysqli_fetch_assoc($ses_sql);
	$login_session=$row['username'];
	if (!isset($login_session)) {
		header('Location:login');
	}
?>