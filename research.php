<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `research` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        // update data
        if(isset($_POST['add']))
        {
            $topic = $_POST['topic'];
            $description = $_POST['description']; 
            $status = $_POST['research_status'];

            $uploadTo = "uploads/research/"; 
            $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
            $fileName = $_FILES['image']['name'];
            $tempPath=$_FILES["image"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $image = "uploads/research/".$fileName;
                }else{ 
                    $image = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $image = $res_data['image'];
            }
            
            $sql = "UPDATE research SET `image`='$image', `topic`='$topic', `description`='$description', `status`='$status' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='researchs'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `research` WHERE `id`=$id");
      echo "<script>window.location.href='researchs'</script>"; exit();
    }  
  } else {
    // this is for add research
    if(isset($_POST['add']))
    {
        $topic = $_POST['topic'];
        $description = $_POST['description'];
        $status = $_POST['research_status'];

        // upload banner
        $uploadTo = "uploads/research/"; 
        $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
        $fileName = $_FILES['image']['name'];
        $tempPath=$_FILES["image"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $image = "uploads/research/".$fileName;
            }else{ 
                $image = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $image = '';
        }

        // insert research
        $blog_sql = "INSERT INTO research (`image`, `topic`, `description`, `status`)
        VALUES ('$image', '$topic', '$description', '$status')";
        if ($con->query($blog_sql) === TRUE) {
            echo "<script>window.location.href='researchs'</script>"; exit();
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
                <h1 class="app-page-title">Research</h1>
				<form id="blogFrm" class="settings-form" method="post" enctype="multipart/form-data">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Topic *</label>
                                        <input type="text" class="form-control" id="topic" name="topic" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['topic'] : "";?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Description</label>
                                        <textarea class="ckeditor form-control egt8" name="description" id="description">
                                            <?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['description'] : "";?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Image</label><br>
                                        <input type="file" name="image" id="image"/>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if($res_data['status']=='Y')  { echo 'checked="checked"'; }?>>
                                            <input type="hidden" id="research_status" name="research_status" value="<?php echo $res_data['status'];?>">
                                        <?php } else {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="research_status" name="research_status" value="Y">
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
                $("#research_status").val('Y')
            } else {
                $("#research_status").val('N')
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".btnBlog").click(function() {
            var topic = $("#topic").val();
            var description = CKEDITOR.instances['description'].getData();
            var image = $("#image").val();
            
            if (topic == "") {
                Swal.fire("Blog title must be required !!!");
                return false;
            }
            if (description == "") {
                Swal.fire("Content must be required !!!");
                return false;
            }
            
            $("#blogFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>