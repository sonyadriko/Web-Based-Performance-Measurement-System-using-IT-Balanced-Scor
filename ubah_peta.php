<?php
 include 'koneksi.php';
 session_start();
  if (!isset($_SESSION['id_admin'])) {
      header("Location: login.php");
  }
  $queryPerspektif = mysqli_query($conn, "SELECT * FROM perspektif");
  $perspektifData = mysqli_fetch_all($queryPerspektif, MYSQLI_ASSOC);

  $id_data = $_GET['GetID'];
    $query = mysqli_query($conn, "SELECT * FROM peta_strategi join perspektif on peta_strategi.id_perspektif = perspektif.id_perspektif WHERE id_peta_strategi = '".$id_data."'");
    while($row = mysqli_fetch_assoc($query)){
        $id_p = $row['id_perspektif'];
        $nama_p = $row['nama_perspektif'];
        $nama = $row['nama_peta_strategi'];
        $sasaran = $row['sasaran_strategi'];
        $indikator = $row['indikator_kinerja'];
        $pembobotan = $row['pembobotan'];
        $target = $row['target'];
        $nilai_target = $row['nilai_target'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Title -->
        <title>Peta Strategi</title>
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
        <link href="assets/plugins/apexcharts/apexcharts.css" rel="stylesheet">      
        <!-- Theme Styles -->
        <link href="assets/css/main.min.css" rel="stylesheet">
        <link href="assets/css/custom.css" rel="stylesheet">

    </head>
    <body>

        <div class="page-container">
           <?php include'header.php' ?>
            <?php include'sidebar.php' ?>
            <div class="page-content">
              <div class="main-wrapper">
              <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Data Peta Strategi</h5>
                            <form action="update_peta.php?id=<?php echo $id_data ?>" method="post">
                                <div class="mb-3">
                                    <label for="selectPerspektif" class="form-label">Perspektif</label>
                                    <!-- <select class="form-control" id="selectPerspektif" name="selectPerspektif">
                                        <?php
                                        foreach ($perspektifData as $alternatif) {
                                            echo '<option value="' . $alternatif['id_perspektif'] . '">' . $alternatif['nama_perspektif'] . '</option>';
                                        }
                                        ?>
                                    </select> -->
                                    <input type="text" class="form-control" id="selectPerspektif" name="selectPerspektif" value="<?php echo $nama_p ?>" aria-describedby="inputNamaPeta" readonly disabled  >
                                </div>

                                <div class="mb-3">
                                    <label for="inputNamaPeta" class="form-label">Nama Peta Strategi</label>
                                    <input type="text" class="form-control" id="inputNamaPeta" name="inputNamaPeta" value="<?php echo $nama ?>" aria-describedby="inputNamaPeta">
                                </div>

                                <div class="mb-3">
                                    <label for="inputSasaranStrategi" class="form-label">Sasaran Strategi</label>
                                    <input type="text" class="form-control" id="inputSasaranStrategi" name="inputSasaranStrategi" value="<?php echo $sasaran ?>" aria-describedby="inputSasaranStrategi">
                                </div>

                                <div class="mb-3">
                                    <label for="inputIndikatorKinerja" class="form-label">Indikator Kinerja</label>
                                    <input type="text" class="form-control" id="inputIndikatorKinerja" name="inputIndikatorKinerja" value="<?php echo $indikator?>" aria-describedby="inputIndikatorKinerja">
                                </div>

                                <div class="mb-3">
                                    <label for="inputPembobotan" class="form-label">Pembobotan</label>
                                    <input type="text" class="form-control" id="inputPembobotan" name="inputPembobotan" value="<?php echo $pembobotan ?>" aria-describedby="inputPembobotan">
                                </div>

                                <div class="mb-3">
                                    <label for="inputTarget" class="form-label">Target</label>
                                    <input type="text" class="form-control" id="inputTarget" name="inputTarget" value="<?php echo $target?> " aria-describedby="inputTarget">
                                </div>

                                <div class="mb-3">
                                    <label for="contohTarget" class="form-label">Contoh Target</label>
                                    <input type="text" class="form-control" id="contohTarget" name="contohTarget" value="<?php echo $nilai_target?> " aria-describedby="inputTarget">
                                </div>

                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <!-- Javascripts -->
        
        <?php include'js.php' ?>
       
    </body>
</html>

<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id_perspektif = $_POST['selectPerspektif'];
    $nama_peta = mysqli_real_escape_string($conn, $_POST['inputNamaPeta']);
    $sasaran_strategi = mysqli_real_escape_string($conn, $_POST['inputSasaranStrategi']);
    $indikator_kinerja = mysqli_real_escape_string($conn, $_POST['inputIndikatorKinerja']);
    $pembobotan = mysqli_real_escape_string($conn, $_POST['inputPembobotan']);
    $target = mysqli_real_escape_string($conn, $_POST['inputTarget']);
    $nilai = mysqli_real_escape_string($conn, $_POST['contohTarget']);

    // Insert data into 'peta_strategi' table using prepared statements
    $insertData = $conn->prepare("INSERT INTO peta_strategi (id_peta_strategi, id_perspektif, nama_peta_strategi, sasaran_strategi, indikator_kinerja, pembobotan, target, nilai_target) 
                                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $insertData->bind_param("ssssss", $id_perspektif, $nama_peta, $sasaran_strategi, $indikator_kinerja, $pembobotan, $target, $nilai_target);

    // Execute the prepared statement
    $insertResult = $insertData->execute();

    if ($insertResult) {
        echo "<script>alert('Berhasil menambah data.')</script>";
        echo "<script>window.location.href = 'peta_strategi.php';</script>";
    } else {
        // Handle the error
        echo "<script>alert('Gagal menambah data.')</script>";
        echo "<script>console.error('Error: " . $insertData->error . "')</script>";
    }

    // Close the prepared statement
    $insertData->close();
}
?>
