<?php
		$id = $_GET['id'];

		$con = mysqli_connect("localhost", "root", "", "hospitalms") or die("Error in Connection");
		$sql = "DELETE FROM appointmenttb WHERE id = '$id'";
		mysqli_query($con, $sql);
		header("Location:doctor-panel?status=3")
	?>