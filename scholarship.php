<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `schalership` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        // update data
        if(isset($_POST['add']))
        {
            $title = $_POST['title'];;
            $description = $_POST['description'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date']; 
            $status = $_POST['schalership_status'];

            $uploadTo = "uploads/schalership/"; 
            $allowFileType = array('pdf','doc');
            $fileName = $_FILES['link']['name'];
            $tempPath=$_FILES["link"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $link = "uploads/schalership/".$fileName;
                }else{ 
                    $link = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $link = $res_data['link'];
            }
            
            $sql = "UPDATE schalership SET `link`='$link', `title`='$title', `description`='$description', `start_date`='$start_date', `end_date`='$end_date', `status`='$status' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='scholarships'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `schalership` WHERE `id`=$id");
      echo "<script>window.location.href='scholarships'</script>"; exit();
    }  
  } else {
    // this is for add schalership
    if(isset($_POST['add']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date']; 
        $status = $_POST['schalership_status'];

        // upload banner
        $uploadTo = "uploads/schalership/"; 
        $allowFileType = array('pdf','doc');
        $fileName = $_FILES['link']['name'];
        $tempPath=$_FILES["link"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $link = "uploads/schalership/".$fileName;
            }else{ 
                $link = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $link = '';
        }

        // insert schalership
        $blog_sql = "INSERT INTO schalership (`link`, `title`, `description`, `start_date`, `end_date`, `status`)
        VALUES ('$link', '$title', '$description', '$start_date', '$end_date', '$status')";
        if ($con->query($blog_sql) === TRUE) {
            echo "<script>window.location.href='scholarships'</script>"; exit();
        } else {
            echo "<script>alert('Something went wrong...');</script>";
        }

        $con->close();
    }
  }
?>
    <div class="app-wrapper">
        <div class="app-description pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Scholarship</h1>
				<form id="blogFrm" class="settings-form" method="post" enctype="multipart/form-data">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Title *</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['title'] : "";?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">description</label>
                                        <textarea class="ckeditor form-control egt8" name="description" id="description">
                                            <?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['description'] : "";?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Start Date</label>
                                        <input type="date" style="width: 25%;" class="form-control" id="start_date" name="start_date" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['start_date'] : date('Y-m-d');?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">End Date</label>
                                        <input type="date" style="width: 25%;" class="form-control" id="end_date" name="end_date" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['end_date'] : date('Y-m-d');?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Link</label><br>
                                        <input type="file" name="link" id="link"/>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if($res_data['status']=='Y')  { echo 'checked="checked"'; }?>>
                                            <input type="hidden" id="schalership_status" name="schalership_status" value="<?php echo $res_data['status'];?>">
                                        <?php } else {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="schalership_status" name="schalership_status" value="Y">
                                        <?php }?>
                                    </div>
                                    <button type="submit" name="add" class="btn app-btn-primary btnBlog">Submit</button>
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
                $("#schalership_status").val('Y')
            } else {
                $("#schalership_status").val('N')
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".btnBlog").click(function() {
            var title = $("#title").val();
            var description = CKEDITOR.instances['description'].getData();
            var link = $("#link").val();
            
            if (title == "") {
                Swal.fire("Blog title must be required !!!");
                return false;
            }
            if (description == "") {
                Swal.fire("description must be required !!!");
                return false;
            }
            
            $("#blogFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>