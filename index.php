<?php session_start(); 
include_once('includes/config.php');
// this is for login proccess
if(isset($_POST['login']))
{
  $username = $_POST['username'];
  $pass = md5($_POST['password']);
  
  $ret = mysqli_query($con,"SELECT * FROM account WHERE username='$username' and password='$pass'");
  $num = mysqli_fetch_array($ret);
  
  if($num>0)
  {
	$extra="home";
	$_SESSION['loginId'] = $num['id'];
	$_SESSION['loginName'] = $num['name'];
	$_SESSION['loginUsername'] = $num['username'];
	$_SESSION['loginRole'] = $num['role'];
	echo "<script>window.location.href='".$extra."'</script>"; exit();
  } else {
	echo "<script>alert('Invalid username or password');</script>";
	$extra="index";
	echo "<script>window.location.href='".$extra."'</script>"; exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kalna Polytechnic | Admin</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Master | Admin">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <link href="assets/css/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="<?php echo BASE_URL;?>"><img
                                class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-5">Welcome To Kalna Polytechnic</h2>
                    <div class="auth-form-container text-start">
                        <form id="loginFrm" class="auth-form login-form" method="post">
                            <div class="email mb-3">
                                <label class="sr-only" for="signin-email">Username</label>
                                <input id="username" name="username" type="text" class="form-control signin-email"
                                    value="" placeholder="Enter your Username" required="required">
                            </div>
                            <div class="password mb-3">
                                <label class="sr-only" for="signin-password">Password</label>
                                <input id="password" name="password" type="password"
                                    class="form-control signin-password" placeholder="Enter your Password" value=""
                                    required="required">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="login"
                                    class="btn app-btn-primary w-100 theme-btn mx-auto btnLogin">Proceed to
                                    login</button>
                            </div>
                        </form>

                        <div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link"
                                href="<?php echo BASE_URL.'register';?>">here</a>.</div>
                    </div>
                </div>

                <footer class="app-auth-footer">
                    <div class="container text-center py-3">
                        <small class="copyright">Designed and developed <span class="sr-only">love</span>
                            <i class="fas fa-heart" style="color: #fb866a;"></i> by
                            <a class="app-link" href="#" target="_blank">Kalna Polytechnic</a>
                        </small>
                    </div>
                </footer>
            </div>
        </div>
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder"></div>
        </div>
    </div>
    <!-- script on this file -->
    <script>
    $(document).ready(function() {
        $(".btnLogin").click(function() {
            var username = $("#username").val();
            var password = $("#password").val();

            if (username == "") {
                Swal.fire("Username must be required !!!");
                return false;
            }
            if (password == "") {
                Swal.fire("Password must be required !!!");
                return false;
            }
            $("#loginFrm").submit();
        });
    });
    </script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <script src="assets/js/mainvalidation.js"></script>
</body>

</html>