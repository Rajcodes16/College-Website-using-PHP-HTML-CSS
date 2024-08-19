<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `blogs` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        // update data
        if(isset($_POST['add']))
        {
            $blog_title = $_POST['blog_title'];
            $blog_content = $_POST['blog_content'];
            $blog_date = $_POST['blog_date'];
            $publisher = $_POST['publisher']; 
            $status = $_POST['blog_status'];

            $uploadTo = "uploads/blog/"; 
            $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
            $fileName = $_FILES['blog_img']['name'];
            $tempPath=$_FILES["blog_img"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $blog_img = "uploads/blog/".$fileName;
                }else{ 
                    $blog_img = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $blog_img = $res_data['blog_img'];
            }
            
            $sql = "UPDATE blogs SET `blog_img`='$blog_img', `blog_title`='$blog_title', `blog_content`='$blog_content', `blog_date`='$blog_date', `publisher`='$publisher', `status`='$status' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='blogs'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `blogs` WHERE `id`=$id");
      echo "<script>window.location.href='blogs'</script>"; exit();
    }  
  } else {
    // this is for add blogs
    if(isset($_POST['add']))
    {
        $blog_title = $_POST['blog_title'];
        $blog_content = $_POST['blog_content'];
        $blog_date = $_POST['blog_date'];
        $publisher = $_POST['publisher']; 
        $status = $_POST['blog_status'];

        // upload banner
        $uploadTo = "uploads/blog/"; 
        $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
        $fileName = $_FILES['blog_img']['name'];
        $tempPath=$_FILES["blog_img"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $blog_img = "uploads/blog/".$fileName;
            }else{ 
                $blog_img = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $blog_img = '';
        }

        // insert blogs
        $blog_sql = "INSERT INTO blogs (`blog_img`, `blog_title`, `blog_content`, `blog_date`, `publisher`, `status`)
        VALUES ('$blog_img', '$blog_title', '$blog_content', '$blog_date', '$publisher', '$status')";
        if ($con->query($blog_sql) === TRUE) {
            echo "<script>window.location.href='blogs'</script>"; exit();
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
                <h1 class="app-page-title">Blog</h1>
				<form id="blogFrm" class="settings-form" method="post" enctype="multipart/form-data">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Blog Title *</label>
                                        <input type="text" class="form-control" id="blog_title" name="blog_title" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['blog_title'] : "";?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Content</label>
                                        <textarea class="ckeditor form-control egt8" name="blog_content" id="blog_content">
                                            <?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['blog_content'] : "";?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Blog Date</label>
                                        <input type="date" style="width: 25%;" class="form-control" id="blog_date" name="blog_date" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['blog_date'] : date('Y-m-d');?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Featured Photo</label><br>
                                        <input type="file" name="blog_img" id="blog_img"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Publisher</label>
                                        <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['publisher'] : "";?>" onkeypress="return isLatterWithSpace(event);">
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if($res_data['status']=='Y')  { echo 'checked="checked"'; }?>>
                                            <input type="hidden" id="blog_status" name="blog_status" value="<?php echo $res_data['status'];?>">
                                        <?php } else {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="blog_status" name="blog_status" value="Y">
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
                $("#blog_status").val('Y')
            } else {
                $("#blog_status").val('N')
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".btnBlog").click(function() {
            var blog_title = $("#blog_title").val();
            var blog_content = CKEDITOR.instances['blog_content'].getData();
            var blog_img = $("#blog_img").val();
            var publisher = $("#publisher").val();
            
            if (blog_title == "") {
                Swal.fire("Blog title must be required !!!");
                return false;
            }
            if (blog_content == "") {
                Swal.fire("Content must be required !!!");
                return false;
            }
            if (publisher == "") {
                Swal.fire("Publisher must be required !!!");
                return false;
            }
            
            $("#blogFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>