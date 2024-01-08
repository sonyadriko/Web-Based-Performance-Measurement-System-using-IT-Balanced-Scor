<?php 
    include 'koneksi.php';

    $id_data = $_GET['id'];
    $peta = $_POST['inputPetaStrategi'];
    $hasil = $_POST['inputActionPlan'];
    // Assuming your table name is 'peta_strategi'
    $query = "UPDATE action_plan SET 
                peta_strategi = '".$peta."', 
                hasil_action_plan = '".$hasil."'
              WHERE id_action_plan = '".$id_data."'";

    $result = mysqli_query($conn, $query);

    if($result){
        header("Location: action_plan.php");
    } else {
        echo 'Update failed. Please check again.';
    }
?>
