
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
        <a href="assets/index2.html" class="h1">Register</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Community Complaint Service</p>

        <form action="simpan_daftar.php" method="post" onsubmit="return validnum()">
          <label>NIK</label>
          <div class="input-group mb-3">
            <input type="number" name="nik" id="nik" class="form-control" placeholder="NIK" onkeyup="return minnum()" required>
            <div class="input-group-append">
            </div>
          </div>
          <label>Full Name</label>
          <div class="input-group mb-3">
            <input type="text" name="nama" id="nama"  class="form-control" placeholder="Nama" required>
            <div class="input-group-append">
            </div>
          </div>
          <label>Username</label>
          <div class="input-group mb-3">
            <input type="text" name="username" id="username"class="form-control" placeholder="Username" required>
            <div class="input-group-append">
            </div>
          </div>
          <label>Password</label>
          <div class="input-group mb-3">
            <input type="password" name="password" id="password"class="form-control" placeholder="Password" onkeyup="return validatepw()" required>
            <div class="input-group-append">
            </div>
          </div>
          <!-- <h9>Password Must Contain :</h9> -->
          <div class="error">
                <ul>
                  <li id="length"> Atleast 8 Character</li>
                  <li id="upper"> Atleast one uppercase letter</li>
                  <li id="lower"> Atleast one lowercase letter</li>
                  <li id="number"> Atleast one number (0-9)</li>
                </ul>
          </div>
          <label> Confirm Password</label>
          <div class="input-group mb-3">
            <input type="password" name="pass" id="pass" class="form-control" placeholder=" Confirm Password" onkeyup="return conformpw()" required>
            <div class="input-group-append">
            </div>
          </div>
          <label>Phone Number</label>
          <div class="input-group mb-3">
            <input type="tel" name="telp" id="notelp" pattern="^[\x]?[\(]?[0-9]{2,4}[\)\s]?[-\s\.]?[0-9]{2,4}[-\s\.}?[0-9]{4}[-\s\.}?[0-9]{3,4}$" minlength="13" maxlength="17" class="form-control" placeholder="Format +62 XXX / 08XXXX">
            <div class="input-group-append">
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="log.php" class="text-center">already have an account?</a>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-info btn-block">Make Account</button>
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
  <script>
    function minnum(){
    var num = document.getElementById("password");
        if(num.value.length > input.maxlength){
        input.value.slice(0, input.maxlength)
        }
    }
  </script>
  <script>
    function validatepw() {
  var password = document.getElementById("password");
  var upper = document.getElementById("upper");
  var lower = document.getElementById("lower");
  var num = document.getElementById("number");
  var len = document.getElementById("length");

  if (password.value.match(/[0-9]/)) {
    num.style.color = 'lightgreen'

  } else {
    num.style.color = 'red'
  }

  if (password.value.match(/[A-Z]/)) {
    upper.style.color = 'lightgreen'

  } else {
    upper.style.color = 'red'
  }

  if (password.value.match(/[a-z]/)) {
    lower.style.color = 'lightgreen'

  } else {
    lower.style.color = 'red'
  }

  if (password.value.length > 8) {
    len.style.color = 'lightgreen'

  } else {
    len.style.color = 'red'
  }

}
  </script>
<script>
function conformpw(){
  var password = document.getElementById('password');
  var password2 = document.getElementById('pass');

   if(password.value.match(password2)){
  document.getElementById("upper").style.display = 'none';
  document.getElementById("lower")style.display = 'none';
  document.getElementById("number")style.display = 'none';
  document.getElementById("length")style.display = 'none';

   }else{
  document.getElementById("upper").style.display = 'block';
  document.getElementById("lower")style.display = 'block';
  document.getElementById("number")style.display = 'block';
  document.getElementById("length")style.display = 'block';
   }
}

</script>
<script>
  function validnum() {
  var num = document.getElementById("nik");
  var nama = document.getElementById("nama");
  var password = document.getElementById("password");

  if (num.value.length < 16 ){
    alert("NIK must be exactly 16 character!");
    return false
  }

  if (num.value.length > 16 ){
    alert("NIK must be exactly 16 character!");
    return false
  }

  if  (nama.value.match(/[0-9]/)){
    alert("A name should not have number!");
      return false
  }

  if (password.value.match(/[0-9]/)) {
  } else{
    alert("Password should contain atleast 1 number!");
    return false
  }

  if (password.value.match(/[A-Z]/)) {
  } else{
    alert("Password should contain atleast 1 uppercase letter");
    return false
  }

  if (password.value.match(/[a-z]/)) {
  }else{
    alert("Password should contain atleast 1 lowercase letter");
    return false
  }

  if (password.value.length < 8) {
    alert("Password should be atleast 8 character");
    return false
  } 

  return true;
}

</script>

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
