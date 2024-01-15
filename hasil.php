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

                            <form method="post" action="hasilscoresave.php">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Perspektif</th>
                                                <th scope="col">Peta Strategi</th>
                                                <th scope="col">Pembobotan</th>
                                                <th scope="col">Target</th>
                                                <th scope="col">Realisasi</th>
                                                <th scope="col">Hasil</th>
                                                <th scope="col">Action Plan</th>
                                                <!-- <th scope="col">Save</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $totalHasil = 0;
                                            $get_data = mysqli_query($conn, "SELECT * FROM peta_strategi JOIN perspektif ON perspektif.id_perspektif = peta_strategi.id_perspektif");
                                            while ($display = mysqli_fetch_array($get_data)) {
                                                $id = $display['id_peta_strategi'];
                                                $perspektif = $display['nama_perspektif'];
                                                $nama = $display['nama_peta_strategi'];
                                                $pembobotan = $display['pembobotan'];
                                                $target = $display['target'];
                                                $realisasi = $display['realisasi'];
                                                $convert_t = str_replace('.', '', $target);
                                                $convert_r = str_replace('.', '', $realisasi);
                                                $hasil = $convert_r / $convert_t * $pembobotan;
                                                $hasil3 = round($hasil, 1);
                                                $totalHasil += $hasil3;

                                                if ($hasil3 < $pembobotan) {
                                                    // Fetch action plan from the action_plan table
                                                    $actionPlanQuery = mysqli_query($conn, "SELECT hasil_action_plan FROM action_plan WHERE id_peta_strategi = $id");
                                                    $actionPlanResult = mysqli_fetch_assoc($actionPlanQuery);
                                            
                                                    // Display action plan or a default message
                                                    $actionPlan = ($actionPlanResult) ? $actionPlanResult['hasil_action_plan'] : "No action plan available.";
                                                } else {
                                                    $actionPlan = "No action plan needed.";
                                                }
                                            ?>
                                                <tr>
                                                    <td class="text-truncate"><?php echo $perspektif ?></td>
                                                    <td><?php echo $nama ?></td>
                                                    <td class="text-truncate"><?php echo $pembobotan ?></td>
                                                    <td class="text-truncate"><?php echo $target ?></td>
                                                    <td class="text-truncate"><?php echo $realisasi ?></td>
                                                    <td class="text-truncate"><?php echo $hasil3 ?></td>
                                                    <td><?php echo $actionPlan ?></td>
                                                    <!-- <td class="text-truncate"><input type="checkbox" name="idPetaStrategi[]" value="<?php echo $id; ?>"></td> -->
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <p style="font-weight:bold">Total Hasil: <?php echo $totalHasil; ?></p>
                                <!-- <button type="submit" name="saveButton" class="btn btn-primary">Save Data</button> -->
                                </div>
                            </form>
                            <div class="table-responsive">

                            </div>
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
