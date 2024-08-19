<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `video` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        
        // update data
        if(isset($_POST['add']))
        {
            $title = $_POST['title'];
            $video_link = $_POST['video_link'];

            $sql = "UPDATE `video` SET `title`='$title', `video_link`='$video_link' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='videos'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }
            $con->close();
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `video` WHERE `id`=$id");
      echo "<script>window.location.href='videos'</script>"; exit();
    }  
} else {
    if(isset($_POST['add']))
    {
        $title = $_POST['title'];
        $video_link = $_POST['video_link'];

        // insert photo
        $video_sql = "INSERT INTO video (`title`, `video_link`)
        VALUES ('$title', '$video_link')";

        if ($con->query($video_sql) === TRUE) {
            echo "<script>window.location.href='videos'</script>"; exit();
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
                <h1 class="app-page-title">Video</h1>
				<form id="videoFrm" class="settings-form" method="post">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['title'] : "";?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Video Link</label>
                                        <textarea class="form-control egt8" id="video_link" name="video_link"><?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['video_link'] : "";?></textarea>
                                    </div>
                                    <button type="submit" name="add" class="btn app-btn-primary btnVideo">Submit</button>
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
        $(".btnVideo").click(function() {
            var title = $("#title").val();
            var video_link = $("#video_link").val();

            if (title == "") {
                Swal.fire("Title must be required !!!");
                return false;
            }
            if (video_link == "") {
                Swal.fire("Video link must be required !!!");
                return false;
            }
            $("#videoFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>