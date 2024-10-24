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
<body class="hold-transition layout-top-nav bg-dark">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark ">
      <div class="container">
        <a href="beranda.php" class="navbar-brand">
          <img src="../assets/dist/img/AdminLTELogo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Community Complaint Service</span>
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
            <li class="nav-item">
              <a href="data_pengaduan.php" class="nav-link">Complaint Data</a>
            </li>
            <li class="nav-item">
              <a href="data_tanggapan.php" class="nav-link">Response Data</a>
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
                  <h5 class="card-title m-0">Response Data</h5>
                </div>
                <div class="card-body">
                  <table id="example" class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">No.</th>
                        <th style="width: 100px">Image</th>                        
                        <th>Content of Response</th>
                        <th style="width: 200px">Response Date</th>
                        <th>Staff Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      include "../koneksi.php";
                      $catatan    =mysqli_query($koneksi, "SELECT * FROM tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas where level='petugas'");
                      while($d = mysqli_fetch_array($catatan)){
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#modal-view-foto"><img src="../upload/<?=$d['foto']?>" width="150"></a><br>
                            <span class="text-danger text-center"></span>
                          </td>
                          <td><?=$d['tanggapan']?></td>
                          <td><?=$d['tgl_tanggapan']?></td>
                          <td><?=$d['nama_petugas']?></td>
                        </tr>
                        <div class="modal fade" id="modal-view-foto">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Image</h4>
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
                        <?php 
                      }
                      ?>
                    </tbody>
                  </table>                  
                </div>
              </div>

              <div class="modal fade" id="modal-edit">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Verification and Content Of Response</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="simpan_pengaduan">
                        <div class="card-body">
                          <div class="form-group">
                            <label>Verification</label>
                            <select class="form-control">
                              <option>Process</option>
                              <option>Finish</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Content Of Response</label>
                            <textarea class="form-control" name="laporan" rows="3" placeholder="Enter ..."></textarea>
                          </div>                          
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
                      <button type="button" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Add Complaint</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="simpan_pengaduan">
                        <div class="card-body">
                          <div class="form-group">
                            <label>Content Of Report</label>
                            <textarea class="form-control" name="laporan" rows="3" placeholder="Enter ..."></textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Upload Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
                      <button type="button" class="btn btn-primary">Save Complaint</button>
                    </div>
                  </div>
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
