<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$telp = $_POST['telp'];

// menginput data ke database
mysqli_query($koneksi,"insert into petugas values('','$nama','$username','$password','$telp','petugas')");
// mengalihkan halaman kembali ke index.php
echo "<script>alert('Data has been Registered')</script>";
header("location:data_petugas.php");

?>