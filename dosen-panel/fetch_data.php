<?php
require '../koneksi.php';

// Pastikan parameter 'status' dikirim melalui request
if (isset($_GET['status'])) {
    $status = $_GET['status'];

    // Query untuk mendapatkan data sesuai status
    $query = mysqli_query($con, "SELECT pendaftar_mahasiswa.*, mahasiswa.nama 
                                 FROM pendaftar_mahasiswa 
                                 INNER JOIN mahasiswa ON pendaftar_mahasiswa.nim = mahasiswa.nim
                                 WHERE pendaftar_mahasiswa.status_topik_riset = '$status'");

    $no = 1;
    while ($data = mysqli_fetch_array($query)) {
        $formattedDate = date('d F Y', strtotime($data['tanggal_daftar']));
        echo "
        <tr>
            <td>{$no}</td>
            <td>{$data['nim']}</td>
            <td>{$data['nama']}</td>
            <td>{$formattedDate}</td>
            <td>{$data['topik_riset']}</td>
            <td><span class='badge bg-warning text-dark'>{$data['status']}</span></td>
        </tr>";
        $no++;
    }
} else {
    echo "Parameter 'status' tidak ada.";
}
?>
