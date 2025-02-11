<?php 
session_start();
if($_SESSION['status']!="login"){
  header("location:log.php?pesan=belum_login");
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Community Complaint Service</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark text-white">
      <div class="container">
        <a href="index.php" class="navbar-brand">
          <img src="assets/dist/img/AdminLTELogo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 " style="opacity: .8">
          <span class="brand-text font-weight-light  text-white">Community Complaint Service</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="index.php" class="nav-link  text-white">Home</a>
            </li>
            <li class="nav-item">
              <a href="pengaduan.php" class="nav-link  text-white">Write Complaint</a>
            </li>
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link  text-white" onclick="return confirm('apa anda yakin?')" href="logout.php">
              <i class="fas fa-user"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-dark text-dark">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-white">Community Complaint Service</h1>
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
                  <h5 class="card-title m-0 text-white">Write Complaint</h5>
                </div>
                <div class="card-body text-dark bg-secondary ">
                  <table id="example" class="table table-bordered text-white">
                    <thead>
                      <tr>
                        <th style="width: 10px">No.</th>
                        <th style="width: 100px">Photo</th>
                        <th style="width: 200px">Complaint Date</th>
                        <th>Content of the Report</th>
                        <th>Status</th>
                        <th style="width: 100px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      include "koneksi.php";
                      $masyarakat    =mysqli_query($koneksi, "SELECT * FROM masyarakat where username='$_SESSION[username]'");
                      while($d = mysqli_fetch_array($masyarakat)){
                        $pengaduan    =mysqli_query($koneksi, "SELECT * FROM pengaduan where nik='$d[nik]'");
                        while($d_pengaduan = mysqli_fetch_array($pengaduan)){
                          ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><img src="upload/<?=$d_pengaduan['foto']?>" width="100"></td>
                            <td><?=$d_pengaduan['tgl_pengaduan']?></td>
                            <td><?=$d_pengaduan['isi_laporan']?></td>
                            
                            <td>
                              <?php if ($d_pengaduan['status'] == '0') { ?>
                                <span class="badge bg-warning">In Queue</span>
                              <?php } else if ($d_pengaduan['status'] == 'proses') { ?>
                                <span class="badge bg-primary">In Progress</span>
                              <?php } else { ?>
                                <span class="badge bg-success">Finish</span>
                              <?php } ?>
                            </td>
                            <td>
                              <a href="" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#modal-edit<?=$d_pengaduan['id_pengaduan']?>"><i class="fas fa-edit"></i></a>
                              <a onclick="hapus();"  class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                          <!-- script confirm delete   -->
                                <script>
                                  function hapus() {
                                    if (confirm("are you sure want to delete Report?, Data will be lost forever!")) {
                                      location.href = 'hapus_pengaduan.php?id_pengaduan=<?php echo $d_pengaduan['id_pengaduan']; ?>';
                                    }
                                  }
                                  </script>
                            </td>
                          </tr>

                          <div class="modal fade" id="modal-edit<?=$d_pengaduan['id_pengaduan']?>">
                            <div class="modal-dialog">
                              <div class="modal-content bg-dark">
                                <div class="modal-header">
                                  <h4 class="modal-title">Edit Complaint</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form method="post" action="update_pengaduan.php" enctype="multipart/form-data">
                                    <div class="card-body">
                                      <div class="form-group">
                                        <label>Content of the Report</label>
                                        <input type="text" name="id_pengaduan" value="<?=$d_pengaduan['id_pengaduan']?>" hidden>
                                        <input type="text" name="nik" value="<?=$d_pengaduan['nik']?>" hidden>
                                        <textarea class="form-control" name="isi_laporan" rows="3" placeholder="Enter ..."><?=$d_pengaduan['isi_laporan']?></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label>Complaint Picture</label>
                                        <img src="upload/<?=$d_pengaduan['foto']?>" width="100">
                                        <input type="file" name="foto" class="form-control">
                                        <i style="float: left;font-size: 11px;color: red">Ignore if you dont want to change picture</i>
                                      </div>
                                    </div>                                  
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-primary">Save Report</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </tbody>
                    </table>                  
                  </div>
                  <div class="card-footer">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-tambah">
                      Add Complaint
                    </button>
                  </div>
                </div>



                <?php
                include "koneksi.php";
                $masyarakat=mysqli_query($koneksi, "SELECT * FROM masyarakat where username='$_SESSION[username]'");
                while($d = mysqli_fetch_array($masyarakat)){
                  ?>
                  <div class="modal fade" id="modal-tambah">
                    <div class="modal-dialog">
                      <div class="modal-content bg-dark">
                        <div class="modal-header">
                          <h4 class="modal-title">Add Complaint</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body bg-dark">
                          <form method="post" action="simpan_pengaduan.php" enctype="multipart/form-data">
                            <div class="card-body">
                              <div class="form-group">
                                <label>Content of The Report</label>
                                <input type="text" name="nik" value="<?=$d['nik']?>" hidden>
                                <textarea class="form-control" name="isi_laporan" rows="3" placeholder="Enter ..."></textarea>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputFile">Upload Image</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" name="foto" class="form-control">
                                  </div>
                                </div>
                                <i style="float: left;font-size: 11px;color: white">Iimage must be in JPEG, JPG or PNG format. And maximum size 2mb.</i> 
                              </div>
                            </div>                            
                          </div>
                          <div class="modal-footer justify-content-between bg-dark">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Leave</button>
                            <button type="submit" class="btn btn-primary">Save Report</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php }}?>

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
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready(function () {
      $('#example').DataTable();
      });
    </script>
  </body>
  </html>
