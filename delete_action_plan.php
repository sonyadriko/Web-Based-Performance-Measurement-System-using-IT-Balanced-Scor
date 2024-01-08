<?php 
	
	include 'koneksi.php';

	if (isset($_GET['Del'])) {
		// code...
		$id_datatraining = $_GET['Del'];
		$query = "DELETE FROM action_plan WHERE id_action_plan = '".$id_datatraining."'";
		$result = mysqli_query($conn, $query);

		if ($result) {
			// code...
			header("Location:action_plan.php");
		}else {
			echo "Please Check Again";
		}
	}
?>