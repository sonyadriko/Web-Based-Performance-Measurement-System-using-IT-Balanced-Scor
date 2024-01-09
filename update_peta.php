<?php 
    include 'koneksi.php';

    $id_data = $_GET['id'];
    $nama = $_POST['inputNamaPeta'];
    $sasaran = $_POST['inputSasaranStrategi'];
    $indikator = $_POST['inputIndikatorKinerja'];
    $pembobotan = $_POST['inputPembobotan'];
    $target = $_POST['inputTarget'];
    $nilai_target = $_POST['contohTarget'];

    // Assuming your table name is 'peta_strategi'
    $query = "UPDATE peta_strategi SET 
                nama_peta_strategi = '".$nama."', 
                sasaran_strategi = '".$sasaran."', 
                indikator_kinerja = '".$indikator."', 
                pembobotan = '".$pembobotan."', 
                target = '".$target."',
                nilai_target = '".$nilai_target."'
              WHERE id_peta_strategi = '".$id_data."'";

    $result = mysqli_query($conn, $query);

    if($result){
        header("Location: peta_strategi.php");
    } else {
        echo 'Update failed. Please check again.';
    }
?>
