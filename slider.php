<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `slider` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        
        // update data
        if(isset($_POST['add']))
        {
            $heading = $_POST['heading'];
            $content = $_POST['content'];
            $status = $_POST['slider_status'];

            $uploadTo = "uploads/banner/"; 
            $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
            $fileName = $_FILES['slider_img']['name'];
            $tempPath=$_FILES["slider_img"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $slider_img = "uploads/banner/".$fileName;
                }else{ 
                    $slider_img = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $slider_img = $res_data['slider_img'];
            }
            
            $sql = "UPDATE `slider` SET `slider_img`='$slider_img', `heading`='$heading', `content`='$content', `status`='$status' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='sliders'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `slider` WHERE `id`=$id");
      echo "<script>window.location.href='sliders'</script>"; exit();
    }  
} else {
    if(isset($_POST['add']))
    {
        $heading = $_POST['heading'];
        $content = $_POST['content'];
        $status = $_POST['slider_status'];

        // upload banner
        $uploadTo = "uploads/banner/"; 
        $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
        $fileName = $_FILES['slider_img']['name'];
        $tempPath=$_FILES["slider_img"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $slider_img = "uploads/banner/".$fileName;
            }else{ 
                $slider_img = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $slider_img = '';
        }

        // insert slider
        $slider_sql = "INSERT INTO slider (`slider_img`, `heading`, `content`, `status`)
        VALUES ('$slider_img', '$heading', '$content', '$status')";
        if ($con->query($slider_sql) === TRUE) {
            echo "<script>window.location.href='sliders'</script>"; exit();
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
                <h1 class="app-page-title">Slider</h1>
				<form id="sliderFrm" class="settings-form" method="post" enctype="multipart/form-data">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Photo</label><br>
                                        <input type="file" name="slider_img" id="slider_img"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Heading *</label>
                                        <input type="text" class="form-control" id="heading" name="heading" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['heading'] : "";?>" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Content</label>
                                        <textarea class="ckeditor form-control egt8" id="content" name="content"><?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['content'] : "";?></textarea>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if($res_data['status']=='Y')  { echo 'checked="checked"'; }?>>
                                            <input type="hidden" id="slider_status" name="slider_status" value="<?php echo $res_data['status'];?>">
                                        <?php } else {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="slider_status" name="slider_status" value="Y">
                                        <?php }?>
                                    </div>
                                    <button type="submit" name="add" class="btn app-btn-primary btnSlider">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<!-- page jquery -->
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
<script>
    $(document).ready(function() {
        $('#status').on('change', function() {
            var checked = this.checked;
            if(checked == true){
                $("#slider_status").val('Y')
            } else {
                $("#slider_status").val('N')
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".btnSlider").click(function() {
            var heading = $("#heading").val();
            var content = $("#content").val();
            
            if (heading == "") {
                Swal.fire("Heading must be required !!!");
                return false;
            }
			if (content == "") {
                Swal.fire("Content must be required !!!");
                return false;
            }
            $("#sliderFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>