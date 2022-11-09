<?php 
	include('db.php');
	session_start();
	$user_check=$_SESSION['email'];
	$ses_sql=mysqli_query($con,"SELECT email FROM patreg WHERE email='$user_check' ORDER BY pid");
	$row=mysqli_fetch_assoc($ses_sql);
	$login_session=$row['email'];
	if (!isset($login_session)) {
		header('Location:patient-login.php');
	}
?>