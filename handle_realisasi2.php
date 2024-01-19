<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted realisasi values and corresponding id_peta_strategi values
    $realisasiValues = $_POST['inputRealisasi'];
    $idPetaStrategiValues = $_POST['idPetaStrategi'];

    // Loop through the values and update the database
    for ($i = 0; $i < count($realisasiValues); $i++) {
        $realisasi = mysqli_real_escape_string($conn, $realisasiValues[$i]);
        $idPetaStrategi = mysqli_real_escape_string($conn, $idPetaStrategiValues[$i]);

        // Update the realisasi in the database
        $updateQuery = "UPDATE peta_strategi SET realisasi = '$realisasi' WHERE id_peta_strategi = $idPetaStrategi";
        mysqli_query($conn, $updateQuery);
    }

    // Redirect or display a success message
    header("Location: hasil.php");
    exit();
}
?>
