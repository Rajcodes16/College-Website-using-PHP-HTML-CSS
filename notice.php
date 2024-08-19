<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `notices` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        // update data
        if(isset($_POST['add']))
        {
            $title = $_POST['title'];;
            $content = $_POST['content'];
            $notice_date = $_POST['notice_date']; 
            $status = $_POST['notice_status'];

            $uploadTo = "uploads/notices/"; 
            $allowFileType = array('pdf','doc');
            $fileName = $_FILES['notice_link']['name'];
            $tempPath=$_FILES["notice_link"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $notice_link = "uploads/notices/".$fileName;
                }else{ 
                    $notice_link = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $notice_link = $res_data['notice_link'];
            }
            
            $sql = "UPDATE notices SET `notice_link`='$notice_link', `title`='$title', `content`='$content', `notice_date`='$notice_date', `status`='$status' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='notices'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `notices` WHERE `id`=$id");
      echo "<script>window.location.href='notices'</script>"; exit();
    }  
  } else {
    // this is for add notices
    if(isset($_POST['add']))
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $notice_date = $_POST['notice_date']; 
        $status = $_POST['notice_status'];

        // upload banner
        $uploadTo = "uploads/notices/"; 
        $allowFileType = array('pdf','doc');
        $fileName = $_FILES['notice_link']['name'];
        $tempPath=$_FILES["notice_link"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $notice_link = "uploads/notices/".$fileName;
            }else{ 
                $notice_link = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $notice_link = '';
        }

        // insert notices
        $blog_sql = "INSERT INTO notices (`notice_link`, `title`, `content`, `notice_date`, `status`)
        VALUES ('$notice_link', '$title', '$content', '$notice_date', '$status')";
        if ($con->query($blog_sql) === TRUE) {
            echo "<script>window.location.href='notices'</script>"; exit();
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
                <h1 class="app-page-title">Notice</h1>
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
                                        <label for="setting-input-3" class="form-label">Content</label>
                                        <textarea class="ckeditor form-control egt8" name="content" id="content">
                                            <?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['content'] : "";?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Notice Date</label>
                                        <input type="date" style="width: 25%;" class="form-control" id="notice_date" name="notice_date" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['notice_date'] : date('Y-m-d');?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Notice Link</label><br>
                                        <input type="file" name="notice_link" id="notice_link"/>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if($res_data['status']=='Y')  { echo 'checked="checked"'; }?>>
                                            <input type="hidden" id="notice_status" name="notice_status" value="<?php echo $res_data['status'];?>">
                                        <?php } else {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="notice_status" name="notice_status" value="Y">
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
                $("#notice_status").val('Y')
            } else {
                $("#notice_status").val('N')
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".btnBlog").click(function() {
            var title = $("#title").val();
            var content = CKEDITOR.instances['content'].getData();
            var notice_link = $("#notice_link").val();
            
            if (title == "") {
                Swal.fire("Blog title must be required !!!");
                return false;
            }
            if (content == "") {
                Swal.fire("Content must be required !!!");
                return false;
            }
            
            $("#blogFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>