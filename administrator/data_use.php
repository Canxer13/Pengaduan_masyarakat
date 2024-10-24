<?php 
session_start();

  // cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']==""){
  header("location:../login.php?info=login");
}

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Community Complaint Service</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark text-white">
      <div class="container">
        <a href="beranda.php" class="navbar-brand">
          <img src="../assets/dist/img/AdminLTELogo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-dark">Community Complaint Service</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="beranda.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Complaint Data</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="data_pengaduan.php">Complaint Data</a>
            <a class="dropdown-item" href="data_tanggapan.php">Response data</a>
            </li>
            <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          User & Staff Data
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="data_use.php">User Data</a>
          <a class="dropdown-item" href="data_petugas.php">Staff data</a>
            </li>
            <li class="nav-item">
              <a href="laporan.php" class="nav-link">Generate Report</a>
            </li>
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" onclick="return confirm('apa anda yakin?')" href="../logout2.php">
              <i class="fas fa-user"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-dark">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Community Complaint Service</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">

              <div class="card card-primary card-outline bg-secondary">
                <div class="card-header">
                  <h5 class="card-title m-0">Complaint Data</h5>
                </div>
                <div class="card-body">
                  <table id="example" class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">No.</th>                  
                        <th>NIK</th>
                        <th style="width: 200px">Full Name</th>
                        <th>Username</th>
                        <th>Phone number</th>
                        <th style="width: 150px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      include "../koneksi.php";
                      $user    =mysqli_query($koneksi, "SELECT * FROM masyarakat");
                      while($d = mysqli_fetch_array($user)){
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?=$d['nik']?></td>
                          <td><?=$d['nama']?></td>
                          <td><?=$d['username']?></td>
                          <td><?=$d['tlpn']?></td>
                          <td>
                            <a onclick="hapus();" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                          <!-- script confirm delete   -->
                          <script>
                                  function hapus() {
                                    if (confirm("are you sure want to delete Report?, Data will be lost forever!")) {
                                      location.href = 'hapus_user.php?nik=<?php echo $d['nik']; ?>';
                                    }
                                  }
                                  </script>
                          </td>
                        </tr>
                        <div class="modal fade" id="modal-view-foto">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Complaint photo</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="text-center">
                                  <img src="../upload/<?=$d['foto']?>" width="300">
                                </div><hr>
                                <div class="card-body">
                                  <div class="text-center">
                                    <?=$d['isi_laporan']?>
                                  </div>
                                </div>                                
                              </div>
                              <div class="modal-footer justify-content-between"> 
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Exit</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </tbody>
                  </table>                  
                </div>
              </div>
              
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer bg-dark">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
    $('#example').DataTable();
    });
  </script>
</body>
</html>
