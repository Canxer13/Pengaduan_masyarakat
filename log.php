
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Community Complaint Service</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page bg-dark">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary bg-secondary">
      <div class="card-header text-center">
      <a href="login.php" class="h1 text-white">LOGIN</a>
        </div>
      <div class="card-body">
            <p class="login-box-msg">Community Complaint Service</p>
        <?php 
        if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){ ?>
        <div class="col-md-12">
          <div class="card bg-gradient-warning">
            <!-- /.card-header -->
            <div class="card-body text-center">
              Login Failed! Please check your username or password
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <?php } else if($_GET['pesan'] == "logout"){ ?>
        <div class="col-md-12">
          <div class="card bg-gradient-success">
            <!-- /.card-header -->
            <div class="card-body text-center">
              you have succesfully logout
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <?php }else if($_GET['pesan'] == "belum_login"){ ?>
        <div class="col-md-12">
          <div class="card bg-gradient-info">
            <!-- /.card-header -->
            <div class="card-body text-center">
              you must login to access the complaint page or you can make an account 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <?php } } ?>
        <br>
        <form action="cek_login_masyarakat.php" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3 ">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="daftar.php" class="text-center">Register</a>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-info btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
