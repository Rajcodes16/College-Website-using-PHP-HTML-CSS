<?php include_once('includes/header.php');
// update profile
if(isset($_POST['update_profile']))
{
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // upload banner
    $uploadTo = "uploads/"; 
    $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
    $fileName = $_FILES['profileImg']['name'];
    $tempPath=$_FILES["profileImg"]["tmp_name"];

    $basename = basename($fileName);
    $originalPath = $uploadTo.$basename; 
    $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
    if(!empty($fileName)){ 
    if(in_array($fileType, $allowFileType)){ 
        if(move_uploaded_file($tempPath,$originalPath)){ 
            $profileImg = "uploads/".$fileName;
        }else{ 
            $profileImg = '';
        } 
    }else{
        return $fileType." file type not allowed";
    }
    }else{  
        $profileImg = $data_login['profileImg'];;
    }
  
    // update social
    $sql = "UPDATE `account` SET `name`='$name',`profileImg`='$profileImg',`phone`='$phone',`email`='$email',`username`='$username' WHERE `id`=$loginId";
    if ($con->query($sql) === TRUE) {
        echo "<script>window.location.href='account'</script>"; exit();
    } else {
        echo "Error updating record: " . $con->error;
    }

    $con->close();
}
// update password
if(isset($_POST['update_password']))
{
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);

    if($password != $confirm_password){
        $message = "Passwords do not match";
    } else{
        // update social
        $sql = "UPDATE `account` SET `password`='$password' WHERE `id`=$loginId";
        if ($con->query($sql) === TRUE) {
            echo "<script>window.location.href='account'</script>"; exit();
        } else {
            echo "Error updating record: " . $con->error;
        }
        $con->close();
    }
}
?>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">My Account</h1>
            <div class="row gy-4">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Profile</h4>
                                </div>
                            </div>
                        </div>
                        <form id="profileFrm" method="post" enctype="multipart/form-data" class="width100">
                            <div class="app-card-body px-4 w-100">
                                <div class="item border-bottom py-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <div class="item-label mb-2"><strong>Photo</strong></div>
                                            <div class="item-data">
                                                <?php if($data_login['profileImg'] !=''){?>
                                                    <img class="profile-image border-radius30" src="<?php echo BASE_URL.$data_login['profileImg'];?>" alt="user profile">
                                                <?php } else {?>
                                                    <img class="profile-image border-radius30" src="assets/images/users/user-1.jpg" alt="user profile">
                                                <?php }?>
                                                
                                            </div>
                                        </div>
                                        <div class="col text-end">
                                            <input type="file" name="profileImg" id="profileImg"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="item border-bottom py-3">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Username</strong></div>
                                        <div class="item-data">
                                            <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($data_login['username']) ? $data_login['username'] : "";?>">
                                        </div>
                                    </div> 
                                </div>
                                <div class="item border-bottom py-3">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Name</strong></div>
                                        <div class="item-data">
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($data_login['name']) ? $data_login['name'] : "";?>" onkeypress="return isLatterWithSpace(event);">
                                        </div>
                                    </div> 
                                </div>
                                <div class="item border-bottom py-3">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Email</strong></div>
                                        <div class="item-data">
                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($data_login['email']) ? $data_login['email'] : "";?>" onkeyup="validate_email(this.value);">
                                            <span id="clientmailError"></span> 
                                        </div>
                                    </div>
                                </div>
                                <div class="item border-bottom py-3">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Phone</strong></div>
                                        <div class="item-data">
                                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($data_login['phone']) ? $data_login['phone'] : "";?>" onkeypress="return isNumber(event);">  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="app-card-footer p-4 mt-auto">
                                <button type="submit" name="update_profile" class="btn app-btn-primary btnProfile">Manage Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shield-check"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z" />
                                            <path fill-rule="evenodd"
                                                d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Security</h4>
                                </div>
                            </div>
                        </div>
                        <form id="passFrm" method="post" class="width100">
                            <div class="app-card-body px-4 w-100">
                                <div class="item border-bottom py-3">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>New Password</strong></div>
                                        <div class="item-data">
                                            <input type="password" class="form-control" id="password" name="password" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="item border-bottom py-3">
                                    <div class="col-auto">
                                        <div class="item-label"><strong>Confirm Password</strong></div>
                                        <div class="item-data">
                                            <div class="message red"><?php if(!empty($message)) { echo $message; } ?></div>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="app-card-footer p-4 mt-auto">
                                <button type="submit" name="update_password" class="btn app-btn-primary btnPass">Manage Security</button>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
<!-- page jquery -->
<script>
    $(document).ready(function() {
        $(".btnProfile").click(function() {
            var username = $("#username").val();
            var name = $("#name").val();
			var email = $("#email").val();
            var phone = $("#phone").val();
           
            if (username == "") {
                Swal.fire("Username must be required !!!");
                return false;
            }
            if (name == "") {
                Swal.fire("Name must be required !!!");
                return false;
            }
            if (email == "") {
                Swal.fire("Email address must be required !!!");
                return false;
            }
            if (phone == "") {
                Swal.fire("Phone number must be required !!!");
                return false;
            }
            $("#profileFrm").submit();
        });
    });
    </script>
<script>
    $(document).ready(function() {
        $(".btnPass").click(function() {
            var password = $("#password").val();
            var confirm_password = $("#confirm_password").val();
           
            if (password == "") {
                Swal.fire("Password must be required !!!");
                return false;
            }
            if (confirm_password == "") {
                Swal.fire("Confirm Password must be required !!!");
                return false;
            }
            $("#passFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>