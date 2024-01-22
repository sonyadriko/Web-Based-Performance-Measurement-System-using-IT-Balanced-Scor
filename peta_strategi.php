<?php
 include 'koneksi.php';
 session_start();
  if (!isset($_SESSION['id_admin'])) {
      header("Location: login.php");
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
                            <h5 class="card-title">Data Peta Strategi</h5>
                            <p class="card-description">Peta Strategi dalam Balanced Scorecard adalah alat manajemen strategis yang membantu organisasi memvisualisasikan dan mengomunikasikan strategi mereka.</p>
                            <a href="tambah_peta_strategi.php" class="btn btn-primary btn-user">Tambah Peta Strategi </a>
                            <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Nama Perspektif</th>  
                              <th scope="col">Peta Strategi</th>
                              <th scope="col">Sasaran Strategi</th>
                              <th scope="col">Indikator Kinerja</th>
                              <th scope="col">Pembobotan</th>
                              <th scope="col">Target</th>
                              <th scope="col">Ex Target</th>
                              <th scope="col">Action Plan</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php 
                            $no = 1;
                            $totalPembobotan = 0; // Inisialisasi total pembobotan
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
                                $totalPembobotan += $pembobotan; // Akumulasi total pembobotan
                            ?>
                                <td class="text-truncate"><?php echo $no ?></td>
                                <td class="text-truncate"><?php echo $perspektif ?></td>
                                <td class="text-truncate"><?php echo $nama ?></td>
                                <td class="text-truncate"><?php echo $sasaran ?></td>
                                <td class="text-truncate"><?php echo $indikator ?></td>
                                <td class="text-truncate"><?php echo $pembobotan ?></td>
                                <td class="text-truncate"><?php echo $target ?></td>
                                <td class="text-truncate"><?php echo $nilai_target ?></td>
                                <td class="text-truncate">
                                    <a href='ubah_peta.php?GetID=<?php echo $id ?>' style="text-decoration: none; list-style: none;"><input type='submit' value='Ubah' id='editbtn' class="btn btn-primary btn-user" ></a>
                                    <a href='delete_peta_strategi.php?Del=<?php echo $id ?>' style="text-decoration: none; list-style: none;"><input type='submit' value='Hapus' id='delbtn' class="btn btn-primary btn-user" ></a>                       
                                </td>
                            </tr>
                            <?php
                            $no++;
                                }
                            ?>
                          </tbody>
                        
                          </table>
                            </div>
                            <br>
                               <!-- Menampilkan total pembobotan di luar tabel -->
                            
                               <div>
                                    <?php
                                    if ($totalPembobotan != 100) {
                                        echo '<span style="color: red;">Bobot sekarang = ' . $totalPembobotan . ', Bobot harus 100</span>';
                                    } else {
                                        echo '<span style="color: green;">Total Pembobotan: ' . $totalPembobotan . '</span>';
                                    }
                                    ?>
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