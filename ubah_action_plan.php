<?php
 include 'koneksi.php';
 session_start();
  if (!isset($_SESSION['id_admin'])) {
      header("Location: login.php");
  }
  $queryPerspektif = mysqli_query($conn, "SELECT * FROM perspektif");
  $perspektifData = mysqli_fetch_all($queryPerspektif, MYSQLI_ASSOC);

  $id_data = $_GET['GetID'];
    $query = mysqli_query($conn, "SELECT * FROM action_plan join perspektif on action_plan.id_perspektif = perspektif.id_perspektif WHERE id_action_plan = '".$id_data."'");
    while($row = mysqli_fetch_assoc($query)){
        $id_p = $row['id_perspektif'];
        $nama_p = $row['nama_perspektif'];
        $peta = $row['peta_strategi'];
        $hasil = $row['hasil_action_plan'];
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
                            <h5 class="card-title">Tambah Data Action Plan</h5>
                            <form action="update_action_plan.php?id=<?php echo $id_data ?>" method="post">
                                <div class="mb-3">
                                    <label for="selectPerspektif" class="form-label">Perspektif</label>
                                    <!-- <select class="form-control" id="selectPerspektif" name="selectPerspektif">
                                        <?php
                                        foreach ($perspektifData as $alternatif) {
                                            echo '<option value="' . $alternatif['id_perspektif'] . '">' . $alternatif['nama_perspektif'] . '</option>';
                                        }
                                        ?>
                                    </select> -->
                                    <input type="text" class="form-control" id="selectPerspektif" name="selectPerspektif" value="<?php echo $nama_p?>" aria-describedby="selectPerspektif" readonly disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="inputPetaStrategi" class="form-label">Peta Strategi</label>
                                    <input type="text" class="form-control" id="inputPetaStrategi" name="inputPetaStrategi" value="<?php echo $peta?>" aria-describedby="inputPetaStrategi">
                                </div>

                                <div class="mb-3">
                                    <label for="inputActionPlan" class="form-label">Action Plan</label>
                                    <input type="text" class="form-control" id="inputActionPlan" name="inputActionPlan" value="<?php echo $hasil ?>" aria-describedby="inputActionPlan">
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
    $nama_peta = mysqli_real_escape_string($conn, $_POST['inputPetaStrategi']);
    $action_plan = mysqli_real_escape_string($conn, $_POST['inputActionPlan']);

    // Insert data into your_table_name table using prepared statements
    $insertData = $conn->prepare("INSERT INTO action_plan (id_perspektif, peta_strategi, hasil_action_plan) 
                                VALUES (?, ?, ?)");

    // Bind parameters
    $insertData->bind_param("sss", $id_perspektif, $nama_peta, $action_plan);

    // Execute the prepared statement
    $insertResult = $insertData->execute();

    if ($insertResult) {
        echo "<script>alert('Berhasil menambah data Action Plan.')</script>";
        echo "<script>window.location.href = 'action_plan.php';</script>";
    } else {
        // Handle the error
        echo "<script>alert('Gagal menambah data Action Plan.')</script>";
        echo "<script>console.error('Error: " . $insertData->error . "')</script>";
    }

    // Close the prepared statement
    $insertData->close();
}
?>
