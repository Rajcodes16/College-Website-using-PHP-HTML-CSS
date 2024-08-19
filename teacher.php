<?php include_once('includes/header.php');
// this is for add blogs
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `teachers` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        
        // update data
        if(isset($_POST['add']))
        {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $designation = $_POST['designation'];
            $department = $_POST['department'];
            $facebook = $_POST['facebook'];
            $twitter = $_POST['twitter'];
            $linkedin = $_POST['linkedin'];
            $instagram = $_POST['instagram'];
            $bio = $_POST['bio'];
            $about = $_POST['about'];
            $status = $_POST['teacher_status'];

            $uploadTo = "uploads/teachers/"; 
            $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
            $fileName = $_FILES['teacher_img']['name'];
            $tempPath=$_FILES["teacher_img"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $teacher_img = "uploads/teachers/".$fileName;
                }else{ 
                    $teacher_img = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $teacher_img = $res_data['image'];
            }
            
            $sql = "UPDATE teachers SET `image`='$teacher_img', `name`='$name', `phone`='$phone', `email`='$email', `designation`='$designation', `department`='$department', `facebook`='$facebook', `twitter`='$twitter', `linkedin`='$linkedin', `instagram`='$instagram', `bio`='$bio', `about`='$about', `status`='$status' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='teachers'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `teachers` WHERE `id`=$id");
      echo "<script>window.location.href='teachers'</script>"; exit();
    }  
  } else {
    // this is for add blogs
    if(isset($_POST['add']))
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $designation = $_POST['designation'];
        $department = $_POST['department'];
        $facebook = $_POST['facebook'];
        $twitter = $_POST['twitter'];
        $linkedin = $_POST['linkedin'];
        $instagram = $_POST['instagram'];
        $bio = $_POST['bio'];
        $about = $_POST['about'];
        $status = $_POST['teacher_status'];

        // upload img
        $uploadTo = "uploads/teachers/"; 
        $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
        $fileName = $_FILES['teacher_img']['name'];
        $tempPath=$_FILES["teacher_img"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $teacher_img = "uploads/teachers/".$fileName;
            }else{ 
                $teacher_img = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $teacher_img = '';
        }

        // insert teachers
        $teachers_sql = "INSERT INTO teachers (`image`, `name`, `phone`, `email`, `designation`, `department`, `facebook`, `twitter`, `linkedin`, `instagram`, `bio`, `about`, `status`)
        VALUES ('$teacher_img', '$name', '$phone', '$email', '$designation', '$department', '$facebook', '$twitter', '$linkedin', '$instagram', '$bio', '$about', '$status')";
        
        if ($con->query($teachers_sql) === TRUE) {
            echo "<script>window.location.href='teachers'</script>"; exit();
        } else {
            echo "<script>alert('Something went wrong...');</script>";
        }

        $con->close();
    }
  }
?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Teacher</h1>
				<form id="teacherFrm" class="settings-form" method="post" enctype="multipart/form-data">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['name'] : "";?>" onkeypress="return isLatterWithSpace(event);">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Photo</label><br>
                                        <input type="file" name="teacher_img" id="teacher_img"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Phone *</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['phone'] : "";?>" onkeypress="return isNumber(event);">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Email Address *</label>
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['email'] : "";?>" onkeyup="validate_email(this.value);">
                                        <span id="clientmailError"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Designation</label>
                                        <input type="text" class="form-control" id="designation" name="designation" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['designation'] : "";?>" onkeypress="return isLatterWithSpace(event);">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Department</label>
                                        <select id="department" name="department" class="form-control">
                                            <option value="">Select department...</option>
                                            <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                                <option value="civil"<?php if($res_data['department']=='civil') echo 'selected="selected"'; ?>>civil</option>
                                                <option value="electronics and telecommunication"<?php if($res_data['department']=='electronics and telecommunication') echo 'selected="selected"'; ?>>electronics and telecommunication</option>
                                                <option value="computer science and technology"<?php if($res_data['department']=='computer science and technology') echo 'selected="selected"'; ?>>computer science and technology</option>
                                                <option value="others teachers"<?php if($res_data['department']=='others teachers') echo 'selected="selected"'; ?>>others teachers</option>
                                                <option value="staffs"<?php if($res_data['department']=='staffs') echo 'selected="selected"'; ?>>staffs</option>
                                            <?php } else {?>
                                                <option value="civil">civil</option>
                                                <option value="electronics and telecommunication">electronics and telecommunication</option>
                                                <option value="computer science and technology">computer science and technology</option>
                                                <option value="others teachers">others teachers</option>
                                                <option value="staffs">staffs</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['facebook'] : "";?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Twitter</label>
                                        <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['twitter'] : "";?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['linkedin'] : "";?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['instagram'] : "";?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Bio</label>
                                        <textarea class="form-control egt8" id="bio" name="bio"><?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['bio'] : "";?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">About</label>
                                        <textarea class="form-control egt8" id="about" name="about"><?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['about'] : "";?></textarea>
                                    </div>
                                    
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if($res_data['status']=='Y')  { echo 'checked="checked"'; }?>>
                                            <input type="hidden" id="teacher_status" name="teacher_status" value="<?php echo $res_data['status'];?>">
                                        <?php } else {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="teacher_status" name="teacher_status" value="Y">
                                        <?php }?>
                                    </div>
                                    <button type="submit" name="add" class="btn app-btn-primary btnTeacher">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<!-- page jquery -->
<script>
    $(document).ready(function() {
        $('#status').on('change', function() {
            var checked = this.checked;
            if(checked == true){
                $("#teacher_status").val('Y')
            } else {
                $("#teacher_status").val('N')
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".btnTeacher").click(function() {
            var name = $("#name").val();
            var teacher_img = $("#teacher_img").val();
            var phone = $("#phone").val();
            var email = $("#email").val();
            var designation = $("#designation").val();
            var department = $("#department").val();
            
            if (name == "") {
                Swal.fire("Name must be required !!!");
                return false;
            }
            if (teacher_img == "") {
                Swal.fire("Profile image must be required !!!");
                return false;
            }
			if (phone == "") {
                Swal.fire("Phone must be required !!!");
                return false;
            }
            if (email == "") {
                Swal.fire("Email must be required !!!");
                return false;
            }
            if (designation == "") {
                Swal.fire("Designation must be required !!!");
                return false;
            }
            if (department == "") {
                Swal.fire("Department must be required !!!");
                return false;
            }
            $("#teacherFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>