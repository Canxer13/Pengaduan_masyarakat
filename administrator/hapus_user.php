<?php 
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$nik = $_GET['nik'];

// menghapus data dari database
mysqli_query($koneksi,"DELETE FROM masyarakat WHERE nik='$nik'");
echo "<script>alert('Data has be erased.');window.location='data_use.php';</script>";
?>