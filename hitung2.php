<?php
 include 'koneksi.php';
 session_start();
  if (!isset($_SESSION['id_admin'])) {
      header("Location: login.php");
  }



// Mengambil data dari database
$query = "SELECT * FROM peta_strategi JOIN perspektif ON perspektif.id_perspektif = peta_strategi.id_perspektif";
$result = mysqli_query($conn, $query);

// Mengubah hasil query menjadi array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
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
                            <h5 class="card-title">Data Hitung KPI</h5>
                            <!-- <p class="card-description">Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>.</p> -->
                            <!-- <a href="hitung_kpi.php" class="btn btn-primary btn-user">Hitung KPI </a> -->

                          <form method="post" action="handle_realisasi2.php">

                            <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                            <tr>
                              <!-- <th scope="col">No</th> -->
                              <th scope="col">Perspektif</th>
                              <th scope="col">Peta Strategi</th>
                                <th scope="col">Pembobotan</th>
                              <th scope="col">Target</th>
                              <th scope="col">Nilai Target</th>
                              <th scope="col">Realisasi</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $no = 1;
                            // $get_data = mysqli_query($conn, "select * from peta_strategi JOIN perspektif.id_perspektif = peta_strategi.id_perspektif");
                            $get_data = mysqli_query($conn, "SELECT * FROM peta_strategi JOIN perspektif ON perspektif.id_perspektif = peta_strategi.id_perspektif");
                            while($display = mysqli_fetch_array($get_data)) {
                                $id = $display['id_peta_strategi'];
                                $perspektif = $display['nama_perspektif'];
                                $nama = $display['nama_peta_strategi'];   
                                $sasaran = $display['sasaran_strategi'];   
                                $indikator = $display['indikator_kinerja'];   
                                $pembobotan = $display['pembobotan'];   
                                $target = $display['target'];   
                                $nilai_target = $display['nilai_target'];   
                         
                            ?>
                                <!-- <td class="text-truncate"><?php echo $no ?></td> -->
                                <td class="text-truncate"><?php echo $perspektif ?></td>
                                <td ><?php echo $nama ?></td>
                                <td class="text-truncate"><?php echo $pembobotan ?></td>
                                <td class="text-truncate"><?php echo $target ?></td>
                                <td class="text-truncate"><?php echo $nilai_target ?></td>
                                <input type="hidden" name="idPetaStrategi[]" value="<?php echo $id; ?>">
                                <td>
                                    <input type="text" class="form-control" name="inputRealisasi[]" aria-describedby="inputRealisasi" required>
                                </td>
                              
                            </tr>
                            <?php
                            $no++;
                                }
                            ?>
                          </tbody>
                        
                          </table>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Realisasi</button>

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