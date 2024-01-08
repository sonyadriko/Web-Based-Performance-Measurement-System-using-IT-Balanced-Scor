<?php
 include 'koneksi.php';
 session_start();
  if (!isset($_SESSION['id_admin'])) {
      header("Location: login.php");
  }

  // Fungsi untuk mengelompokkan data
function groupData($data) {
    $groupedData = array();

    foreach ($data as $item) {
        $perspektif = $item['nama_perspektif'];
        $petaStrategi = $item['nama_peta_strategi'];
        $sasaran = $item['sasaran_strategi'];
        $indikator = $item['indikator_kinerja'];
        $pembobotan = $item['pembobotan'];
        $target = $item['target'];

        if (!isset($groupedData[$perspektif])) {
            $groupedData[$perspektif] = array();
        }

        $groupedData[$perspektif][] = array(
            'Peta Strategi' => $petaStrategi,
            'Sasaran Strategi' => $sasaran,
            'Indikator Kinerja' => $indikator,
            'Pembobotan' => $pembobotan,
            'Target' => $target
        );
        // $groupedData[$perspektif][] = $sasaran;
    }

    return $groupedData;
}

// Mengambil data dari database
$query = "SELECT * FROM peta_strategi JOIN perspektif ON perspektif.id_perspektif = peta_strategi.id_perspektif";
$result = mysqli_query($conn, $query);

// Mengubah hasil query menjadi array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Mengelompokkan data
$groupedData = groupData($data);
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

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                            <a href="hitung_kpi.php" class="btn btn-primary btn-user">Hitung KPI </a>
                            <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                            <tr>
                              <!-- <th scope="col">No</th> -->
                              <th scope="col">Perspektif</th>
                              <th scope="col">Peta Strategi</th>
                                <th scope="col">Sasaran Strategi</th>
                            <th scope="col">Indikator Kinerja</th>
                                <th scope="col">Pembobotan</th>
                              <th scope="col">Target</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($groupedData as $perspektif => $strategis): ?>
                <?php foreach ($strategis as $strategi): ?>
                    <tr>
                        <?php if ($strategi == reset($strategis)): ?>
                            <td rowspan="<?php echo count($strategis); ?>"><?php echo $perspektif; ?></td>
                        <?php endif; ?>
                        <td><?php echo $strategi['Peta Strategi']; ?></td>
                        <td><?php echo $strategi['Sasaran Strategi']; ?></td>
                        <td><?php echo $strategi['Indikator Kinerja']; ?></td>
                        <td><?php echo $strategi['Pembobotan']; ?></td>
                        <td><?php echo $strategi['Target']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
                          </tbody>
                        
                          </table>
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