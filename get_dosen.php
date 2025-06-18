<?php
require 'koneksi.php';

if (isset($_GET['kd_cluster'])) {
    $kd_cluster = $_GET['kd_cluster'];

    // Query untuk mengambil dosen yang sesuai dengan cluster yang dipilih
    $queryDosen = mysqli_query($con, "SELECT * FROM dosen WHERE kd_cluster = '$kd_cluster'");

    // Generate HTML untuk dropdown dosen
    echo "<option value=''>Pilih Dosen</option>";
    while ($rowDosen = mysqli_fetch_assoc($queryDosen)) {
        echo "<option value='" . $rowDosen['kd_dosen'] . "'>" . $rowDosen['nama'] . "</option>";
    }
}
?>
