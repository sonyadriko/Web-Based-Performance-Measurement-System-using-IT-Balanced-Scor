<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalPetaStrategi = $_POST['totalPetaStrategi'];

    var_dump($_POST['inputPetaStrategi']);
    var_dump($_POST['inputRealisasi']);

    for ($i = 0; $i < $totalPetaStrategi; $i++) {
        $petaStrategi = mysqli_real_escape_string($conn, $_POST['inputPetaStrategi'][$i]);
        $realisasi = mysqli_real_escape_string($conn, $_POST['inputRealisasi'][$i]);

        echo "Processing: Peta Strategi - $petaStrategi, Realisasi - $realisasi\n";

        $query = "UPDATE peta_strategi SET realisasi = '$realisasi' WHERE nama_peta_strategi = '$petaStrategi'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo 'Update failed: ' . mysqli_error($conn);
            exit();
        }
    }

    header("Location: index.php");
} else {
    echo 'Invalid request method.';
}
?>
