<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `photo` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        
        // update data
        if(isset($_POST['add']))
        {
            $caption = $_POST['caption'];
            
            $uploadTo = "uploads/"; 
            $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
            $fileName = $_FILES['image']['name'];
            $tempPath=$_FILES["image"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $image = "uploads/".$fileName;
                }else{ 
                    $image = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $image = $res_data['photo_link'];
            }
            
            $sql = "UPDATE `photo` SET `caption`='$caption', `photo_link`='$image' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='photos'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `photo` WHERE `id`=$id");
      echo "<script>window.location.href='photos'</script>"; exit();
    }  
  } else {
    // this is for add blogs
    if(isset($_POST['add']))
    {
        $caption = $_POST['caption'];

        // upload banner
        $uploadTo = "uploads/"; 
        $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
        $fileName = $_FILES['image']['name'];
        $tempPath=$_FILES["image"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $image = "uploads/".$fileName;
            }else{ 
                $image = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $image = '';
        }

        // insert photo
        $img_sql = "INSERT INTO photo (`caption`, `photo_link`)
        VALUES ('$caption', '$image')";

        if ($con->query($img_sql) === TRUE) {
            echo "<script>window.location.href='photos'</script>"; exit();
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
                <h1 class="app-page-title">Photo</h1>
				<form id="picFrm" class="settings-form" method="post" enctype="multipart/form-data">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Caption</label>
                                        <input type="text" class="form-control" id="caption" name="caption" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['caption'] : "";?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Photo</label><br>
                                        <input type="file" name="image" id="image"/>
                                    </div>
                                    
                                    <button type="submit" name="add" class="btn app-btn-primary btnPic">Submit</button>
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
        $(".btnPic").click(function() {
            var caption = $("#caption").val();
           
            if (caption == "") {
                Swal.fire("Caption must be required !!!");
                return false;
            }
            $("#picFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>