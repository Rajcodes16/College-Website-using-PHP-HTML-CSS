<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
        if(isset($_POST['add']))
        {
            // upload banner
            $uploadTo = "uploads/research/inimage/"; 
            $allowFileType = array('jpg','png','jpeg');
            $fileName = $_FILES['image']['name'];
            $tempPath=$_FILES["image"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $image = "uploads/research/inimage/".$fileName;
                }else{ 
                    $image = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $image = '';
            }
            
            $blog_sql = "INSERT INTO research_images (`research_id`, `image`)
            VALUES ('$id', '$image')";
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
                <h1 class="app-page-title">Research Image</h1>
				<form id="blogFrm" class="settings-form" method="post" enctype="multipart/form-data">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Image</label><br>
                                        <input type="file" name="image" id="image"/>
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
<script>
    $(document).ready(function() {
        $(".btnBlog").click(function() {
            var image = $("#image").val();
            
            if (image == "") {
                Swal.fire("Image must be required !!!");
                return false;
            }
            
            $("#blogFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>