<?php
include 'koneksi.php';

// Check if id_sesi is available (you need to replace this with your actual session variable or form data)
// $id_sesi = isset($_SESSION['id_sesi']) ? $_SESSION['id_sesi'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['saveButton'])) {
    // Save all rows without user selection

    // Prepare the statement outside the loop
    $queryInsert = "INSERT INTO hasil_hitung (id_sesi, hasil_1, hasil_2, hasil_3, hasil_4, hasil_5, hasil_6, hasil_7, hasil_8, hasil_9, hasil_10) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsert = mysqli_prepare($conn, $queryInsert);

    // Check if the statement preparation was successful
    if ($stmtInsert) {
        // Fetch the latest id_sesi from the database
        $queryLatestId = "SELECT MAX(id_sesi) AS max_id FROM hasil_hitung";
        $resultLatestId = mysqli_query($conn, $queryLatestId);
        $rowLatestId = mysqli_fetch_assoc($resultLatestId);

        // Determine the next id_sesi
        $id_sesi = $rowLatestId['max_id'] + 1;

        // Loop through the rows from the original query
        $get_data = mysqli_query($conn, "SELECT * FROM peta_strategi JOIN perspektif ON perspektif.id_perspektif = peta_strategi.id_perspektif");

        while ($display = mysqli_fetch_array($get_data)) {
            $pembobotan = $display['pembobotan'];
            $target = $display['target'];
            $realisasi = $display['realisasi'];
            $convert_t = str_replace('.', '', $target);
            $convert_r = str_replace('.', '', $realisasi);
            $hasil = round($convert_r / $convert_t * $pembobotan, 1);

            // Bind parameters and execute the statement inside the loop
            mysqli_stmt_bind_param($stmtInsert, 'ddddddddddd', $id_sesi, $hasil, $hasil, $hasil, $hasil, $hasil, $hasil, $hasil, $hasil, $hasil, $hasil);

            // Execute the statement
            if (mysqli_stmt_execute($stmtInsert)) {
                // Success
                echo "Data saved successfully";
            } else {
                // Error handling
                echo "Error saving data";
            }
        }

        // Close the statement outside the loop
        mysqli_stmt_close($stmtInsert);
    } else {
        // Handle statement preparation error
        echo "Error preparing the statement";
    }
}
?>
