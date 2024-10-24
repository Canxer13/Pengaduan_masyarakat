<?php 
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$id = $_GET['id_petugas'];

// menghapus data dari database
mysqli_query($koneksi,"DELETE FROM petugas WHERE id_petugas='$id'");
echo "<script>alert('Data has be erased.');window.location='data_petugas.php';</script>";
?>