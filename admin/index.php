<?php session_start();
require_once("configs/db_config.php");
$base_url = "cpanel";
//require_once("library/classes/system_log.class.php");

if (isset($_POST["btnSignIn"])) {

  $username = trim($_POST["txtUsername"]);
  $password = trim($_POST["txtPassword"]);
  //echo $username," ",$password;
  //$result=$db->query("select u.id,u.username,r.name from {$tx}users u,{$tx}roles r where r.id=u.role_id and u.username='$username' and u.password='$password'");
  $result = $db->query("select u.id,u.full_name,u.password,u.email,u.photo,u.mobile,u.role_id,r.name role from {$tx}users u,{$tx}roles r where r.id=u.role_id and u.name='$username' and u.inactive=0");


  $user = $result->fetch_object();

  if ($user && password_verify($password, $user->password)) {

    $_SESSION["uid"] = $user->id;
    $_SESSION["uname"] = $user->full_name;
    $_SESSION["uphoto"] = $user->photo;
    $_SESSION["email"] = $user->email;
    $_SESSION["mobile"] = $user->mobile;
    $_SESSION["role_id"] = $user->role_id;
    $_SESSION["urole"] = $user->role;

    header("location:home");
  } else {
    echo "Incorrect username or password";
  }



  //  $now=date("Y-m-d H:i:s");
  //  $log=new System_log("","LOGIN","Successfully logged in user : $uid-$_username",$now);
  //  $log->save();



}

?>


<!-- LOGIN PAGE Signin signup  -->
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.in/rasket/admin/auth-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Nov 2024 03:35:39 GMT -->

<head>
  <!-- Title Meta -->
  <meta charset="utf-8" />
  <title>Sign In 2 | Shaan's Hotel - Responsive Admin Dashboard Template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A fully responsive premium admin dashboard template" />
  <meta name="author" content="Techzaa" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- Vendor css (Require in all Page) -->
  <link href="assets/css/vendor.min.css" rel="stylesheet" type="text/css" />

  <!-- Icons css (Require in all Page) -->
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

  <!-- App css (Require in all Page) -->
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

  <!-- Theme Config js (Require in all Page) -->
  <script src="assets/js/config.min.js"></script>

</head>

<body class="authentication-bg">

  <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-5">
          <div class="card auth-card">
            <div class="card-body px-3 py-5">
              <div class="mx-auto mb-4 text-center auth-logo">
                <a href="index.html" class="logo-dark">
                  <img src="assets/images/logo-sm.png" height="30" class="me-1" alt="logo sm">
                  <img src="assets/images/logo-dark.png" height="24" alt="logo dark">
                </a>

                <a href="index.html" class="logo-light">
                  <img src="assets/images/logo-sm.png" height="30" class="me-1" alt="logo sm">
                  <img src="assets/images/logo-light.png" height="24" alt="logo light">
                </a>
              </div>

              <h2 class="fw-bold text-center fs-18">Sign In</h2>
              <p class="text-muted text-center mt-1 mb-4">Enter your Username and password to access admin panel.</p>

              <div class="px-4">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="authentication-form">
                  <div class="mb-3">
                    <label class="form-label" for="example-email">Username</label>
                    <input type="text"  id="example-email" name="txtUsername" class="form-control" placeholder="Enter your email">
                  </div>
                  <div class="mb-3">
                    <a href="auth-password.html" class="float-end text-muted text-unline-dashed ms-1">Reset password</a>
                    <label class="form-label" for="example-password">Password</label>
                    <input type="text" name="txtPassword" id="example-password" class="form-control" placeholder="Enter your password">
                  </div>
                  <div class="mb-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="checkbox-signin">
                      <label class="form-check-label" for="checkbox-signin">Remember me</label>
                    </div>
                  </div>

                  <div class="mb-1 text-center d-grid">
                    <button class="btn btn-primary" type="submit" name="btnSignIn">Sign In</button>
                  </div>
                </form>

                <p class="mt-3 fw-semibold no-span">OR sign with</p>

                <div class="text-center">
                  <a href="javascript:void(0);" class="btn btn-light shadow-none"><i class='bx bxl-google fs-20'></i></a>
                  <a href="javascript:void(0);" class="btn btn-light shadow-none"><i class='bx bxl-facebook fs-20'></i></a>
                  <a href="javascript:void(0);" class="btn btn-light shadow-none"><i class='bx bxl-github fs-20'></i></a>
                </div>
              </div> <!-- end col -->
            </div> <!-- end card-body -->
          </div> <!-- end card -->

          <p class="mb-0 text-center">New here? <a href="auth-signup.html" class="text-reset fw-bold ms-1">Sign Up</a></p>

        </div> <!-- end col -->
      </div> <!-- end row -->
    </div>
  </div>

  <!-- Vendor Javascript (Require in all Page) -->
  <script src="<?=$base_url; ?>assets/js/vendor.js"></script>

  <!-- App Javascript (Require in all Page) -->
  <script src="<?=$base_url; ?>assets/js/app.js"></script>





  <script>
    $(function() {

      rememberStatus();

      $('#txtUsername').on("input", function() {
        remember();
      });

      $('#txtPassword').on("input", function() {
        remember();
      });

      $('#chkRemember').click(function() {
        remember();
      });

      function remember() {
        if ($('#chkRemember').is(':checked')) {
          // save username and password
          localStorage.username = $('#txtUsername').val().trim();
          localStorage.pass = $('#txtPassword').val().trim();
          localStorage.chkbox = $('#chkRemember').val();
        } else {
          localStorage.username = '';
          localStorage.pass = '';
          localStorage.chkbox = '';
        }
      }

      function rememberStatus() {
        if (localStorage.chkbox && localStorage.chkbox != '') {
          $('#chkRemember').attr('checked', 'checked');
          $('#txtUsername').val(localStorage.username);
          $('#txtPassword').val(localStorage.pass);
        } else {
          $('#chkRemember').removeAttr('checked');
          $('#txtUsername').val('');
          $('#txtPassword').val('');
        }
      }

    });
  </script>

</body>

<!-- Mirrored from travl.dexignlab.com/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 17 Nov 2024 03:20:41 GMT -->

</html>