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
        <title>Action Plan</title>

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
                                    <h5 class="card-title">Data Action Plan</h5>
                                    <!-- <p class="card-description">Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>.</p> -->
                                    <a href="tambah_action_plan.php" class="btn btn-primary btn-user">Tambah Action Plan </a>
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Peta Strategi</th>
                                                        <th scope="col">Action Plan</th>
                                                        <th scope="col">Actions</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no = 1;
                                                $get_data = mysqli_query($conn, "SELECT * FROM action_plan JOIN peta_strategi ON peta_strategi.id_peta_strategi = action_plan.id_peta_strategi");
                                                while($display = mysqli_fetch_array($get_data)) {
                                                    $id = $display['id_action_plan'];
                                                    $nama = $display['nama_peta_strategi'];   
                                                    $sasaran = $display['hasil_action_plan'];   
                                                ?>
                                                    <td class="text-truncate"><?php echo $no ?></td>
                                                    <!-- <td class="text-truncate"><?php echo $perspektif ?></td> -->
                                                    <td class="text-truncate"><?php echo $nama ?></td>
                                                    <td><?php echo $sasaran ?></td>
                                                    <!-- <td class="text-truncate"><?php echo $indikator ?></td> -->
                                                    <td class="text-truncate">
                                                        <a href='ubah_action_plan.php?GetID=<?php echo $id ?>' style="text-decoration: none; list-style: none;"><input type='submit' value='Ubah' id='editbtn' class="btn btn-primary btn-user" ></a>
                                                        <a href='delete_action_plan.php?Del=<?php echo $id ?>' style="text-decoration: none; list-style: none;"><input type='submit' value='Hapus' id='delbtn' class="btn btn-primary btn-user" ></a>                       
                                                    </td>
                                                </tr>
                                                <?php
                                                $no++;
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php include'js.php' ?>
    </body>
</html>