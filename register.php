<?php include_once('includes/config.php');
if(isset($_POST['add']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = 'Staff';

// insert category
    $category_sql = "INSERT INTO `account` (`username`, `email`, `password`, `role`)
    VALUES ('$username', '$email', '$password', '$role')";

    if ($con->query($category_sql) === TRUE) {
        echo "<script>window.location.href='index'</script>"; exit();
    } else {
        echo "<script>alert('Something went wrong...');</script>";
    }

    $con->close();
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

<body class="app app-signup p-0">    	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="<?php echo BASE_URL;?>"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Register with Kalna Polytechnic</h2>					
	
					<div class="auth-form-container text-start mx-auto">
						<form id="registerFrm" class="auth-form auth-signup-form" method="post">         
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Username</label>
								<input id="username" name="username" type="text" class="form-control signup-name" placeholder="Username" value="">
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Email</label>
								<input id="email" name="email" type="email" class="form-control signup-email" placeholder="Email" value="" onkeyup="validate_email(this.value);">
								<span id="clientmailError"></span>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Password</label>
								<input id="password" name="password" type="password" class="form-control signup-password" placeholder="Create a password" value="">
							</div>
							<div class="extra mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="RememberPassword" checked>
									<label class="form-check-label" for="RememberPassword">
									I agree to Portal's <a href="#" class="app-link">Terms of Service</a> and <a href="#" class="app-link">Privacy Policy</a>.
									</label>
								</div>
							</div><!--//extra-->
							
							<div class="text-center">
								<button type="submit" name="add" class="btn app-btn-primary w-100 theme-btn mx-auto btnRegister submiton">Proceed to registered</button>
							</div>
						</form>
						
						<div class="auth-option text-center pt-5">Already have an account? <a class="text-link" href="<?php echo BASE_URL;?>" >Log in</a></div>
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
        $(".btnRegister").click(function() {
            var username = $("#username").val();
			var email = $("#email").val();
            var password = $("#password").val();

            if (username == "") {
                Swal.fire("Username must be required !!!");
                return false;
            }
			if (email == "") {
                Swal.fire("Email must be required !!!");
                return false;
            }
            if (password == "") {
                Swal.fire("Password must be required !!!");
                return false;
            }
            $("#registerFrm").submit();
        });
    });
    </script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <script src="assets/js/mainvalidation.js"></script>
</body>
</html> 

