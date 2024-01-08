<?php 
	
	include 'koneksi.php';

	if (isset($_GET['Del'])) {
		// code...
		$id_datatraining = $_GET['Del'];
		$query = "DELETE FROM peta_strategi WHERE id_peta_strategi = '".$id_datatraining."'";
		$result = mysqli_query($conn, $query);

		if ($result) {
			// code...
			header("Location:peta_strategi.php");
		}else {
			echo "Please Check Again";
		}
	}
?>