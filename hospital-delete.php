	<?php
		$id = $_GET['id'];
		$con = mysqli_connect("localhost", "root", "", "hospitalms") or die("Error in Connection");
		$sql = "DELETE FROM doctb WHERE id = '$id'";
		mysqli_query($con, $sql);
		header("Location:admin-panel1?status=3")
	?>