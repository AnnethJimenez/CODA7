<?php
		$pid = $_GET['pid'];
		$con = mysqli_connect("localhost", "root", "", "hospitalms") or die("Error in Connection");
		$sql = "DELETE FROM patreg WHERE pid = '$pid'";
		mysqli_query($con, $sql);
		header("Location:patient?status=3");
?>