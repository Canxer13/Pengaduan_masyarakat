<?php 
// koneksi database
include 'koneksi.php';

// menangkap data id yang di kirim dari url
$id_pengaduan = $_GET['id_pengaduan'];
$status = mysqli_query($koneksi, "SELECT status FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
$pp = $status->fetch_array();

// menghapus data dari database
if ($pp['status'] == 0) {
    mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
    // mengalihkan halaman kembali ke index.php
    echo "<script>alert('Data has be erased.');window.location='pengaduan.php';</script>";
} else {
    echo "<script>alert('Data cant be erased because report has ben process or finish.');window.location='pengaduan.php';</script>";
}
?>