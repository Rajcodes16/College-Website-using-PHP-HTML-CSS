<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `courses` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        if(isset($_POST['add']))
        {
            $course_name = $_POST['course_name'];
            $description = $_POST['description'];
            $course_date = $_POST['course_date'];
            $status = $_POST['course_status'];

            $uploadTo = "uploads/course/"; 
            $allowFileType = array('jpg','png','jpeg','gif');
            $fileName = $_FILES['course_picture']['name'];
            $tempPath=$_FILES["course_picture"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $course_picture = "uploads/course/".$fileName;
                }else{ 
                    $course_picture = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $course_picture = $res_data['course_picture'];
            }
            
            $sql = "UPDATE courses SET `course_picture`='$course_picture', `course_name`='$course_name', `description`='$description', `course_date`='$course_date', `status`='$status' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='courses'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `courses` WHERE `id`=$id");
      echo "<script>window.location.href='courses'</script>"; exit();
    }  
  } else {
    // this is for add courses
    if(isset($_POST['add']))
    {
        $course_name = $_POST['course_name'];
        $description = $_POST['description'];
        $course_date = $_POST['course_date'];
        $status = $_POST['course_status'];

        // upload banner
        $uploadTo = "uploads/course/"; 
        $allowFileType = array('jpg','png','jpeg','gif');
        $fileName = $_FILES['course_picture']['name'];
        $tempPath=$_FILES["course_picture"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $course_picture = "uploads/course/".$fileName;
            }else{ 
                $course_picture = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $course_picture = '';
        }

        // insert courses
        $blog_sql = "INSERT INTO courses (`course_picture`, `course_name`, `description`, `course_date`, `status`)
        VALUES ('$course_picture', '$course_name', '$description', '$course_date', '$status')";
        if ($con->query($blog_sql) === TRUE) {
            echo "<script>window.location.href='courses'</script>"; exit();
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
                <h1 class="app-page-title">Course</h1>
				<form id="courseFrm" class="settings-form" method="post" enctype="multipart/form-data">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Course Name *</label>
                                        <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['course_name'] : "";?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Description</label>
                                        <textarea class="ckeditor form-control egt8" name="description" id="description">
                                            <?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['description'] : "";?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Date</label>
                                        <input type="date" style="width: 25%;" class="form-control" id="course_date" name="course_date" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['course_date'] : date('Y-m-d');?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Featured Photo</label><br>
                                        <input type="file" name="course_picture" id="course_picture"/>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if($res_data['status']=='Y')  { echo 'checked="checked"'; }?>>
                                            <input type="hidden" id="course_status" name="course_status" value="<?php echo $res_data['status'];?>">
                                        <?php } else {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="course_status" name="course_status" value="Y">
                                        <?php }?>
                                    </div>
                                    <button type="submit" name="add" class="btn app-btn-primary btnCourse">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

<!-- page jquery -->
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('#status').on('change', function() {
            var checked = this.checked;
            if(checked == true){
                $("#event_status").val('Y')
            } else {
                $("#event_status").val('N')
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".btnCourse").click(function() {
            var course_name = $("#course_name").val();
            var description = CKEDITOR.instances['description'].getData();
            var course_picture = $("#course_picture").val();
            var time = $("#time").val();
            
            if (course_name == "") {
                Swal.fire("Blog title must be required !!!");
                return false;
            }
            if (description == "") {
                Swal.fire("Content must be required !!!");
                return false;
            }
            
            $("#courseFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>