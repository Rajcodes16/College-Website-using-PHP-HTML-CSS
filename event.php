<?php include_once('includes/header.php');
if(isset($_GET['uid'])){
    $id = $_GET['uid'];
    if($_GET['type'] == 'edit'){
        $getdata = mysqli_query($con,"SELECT * FROM `events` WHERE `id`=$id");
        $res_data = mysqli_fetch_array($getdata);
        // update data
        if(isset($_POST['add']))
        {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $location = $_POST['location'];
            $status = $_POST['event_status'];

            $uploadTo = "uploads/event/"; 
            $allowFileType = array('jpg','png','jpeg','gif');
            $fileName = $_FILES['event_picture']['name'];
            $tempPath=$_FILES["event_picture"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
            if(!empty($fileName)){ 
            if(in_array($fileType, $allowFileType)){ 
                if(move_uploaded_file($tempPath,$originalPath)){ 
                    $event_picture = "uploads/event/".$fileName;
                }else{ 
                    $event_picture = '';
                } 
            }else{
                return $fileType." file type not allowed";
            }
            }else{  
                $event_picture = $res_data['event_picture'];
            }
            
            $sql = "UPDATE events SET `event_picture`='$event_picture', `title`='$title', `description`='$description', `location`='$location', `date`='$date', `time`='$time', `status`='$status' WHERE `id`=$id";
            if ($con->query($sql) === TRUE) {
                echo "<script>window.location.href='events'</script>"; exit();
            } else {
            echo "Error updating record: " . $con->error;
            }

            $con->close();
            
        }
    } else if($_GET['type'] == 'delete'){
      mysqli_query($con,"DELETE FROM `events` WHERE `id`=$id");
      echo "<script>window.location.href='events'</script>"; exit();
    }  
  } else {
    // this is for add events
    if(isset($_POST['add']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];
        $status = $_POST['event_status'];

        // upload banner
        $uploadTo = "uploads/event/"; 
        $allowFileType = array('jpg','png','jpeg','gif');
        $fileName = $_FILES['event_picture']['name'];
        $tempPath=$_FILES["event_picture"]["tmp_name"];
    
        $basename = basename($fileName);
        $originalPath = $uploadTo.$basename; 
        $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
        if(!empty($fileName)){ 
        if(in_array($fileType, $allowFileType)){ 
            if(move_uploaded_file($tempPath,$originalPath)){ 
                $event_picture = "uploads/event/".$fileName;
            }else{ 
                $event_picture = '';
            } 
        }else{
            return $fileType." file type not allowed";
        }
        }else{  
            $event_picture = '';
        }

        // insert events
        $blog_sql = "INSERT INTO events (`event_picture`, `title`, `description`, `location`, `date`, `time`, `status`)
        VALUES ('$event_picture', '$title', '$description', '$location', '$date', '$time', '$status')";
        if ($con->query($blog_sql) === TRUE) {
            echo "<script>window.location.href='events'</script>"; exit();
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
                <h1 class="app-page-title">Event</h1>
				<form id="eventFrm" class="settings-form" method="post" enctype="multipart/form-data">
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
                                        <textarea class="ckeditor form-control egt8" name="description" id="description">
                                            <?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['description'] : "";?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Date</label>
                                        <input type="date" style="width: 25%;" class="form-control" id="date" name="date" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['date'] : date('Y-m-d');?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Time</label>
                                        <input type="time" style="width: 25%;" class="form-control" id="time" name="time" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['time'] : date('H:i:s');?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Featured Photo</label><br>
                                        <input type="file" name="event_picture" id="event_picture"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" value="<?php echo isset($_GET['type']) && $_GET['type']=="edit" ? $res_data['location'] : "";?>" onkeypress="return isLatterWithSpace(event);">
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <label class="form-check-label" for="settings-switch-1">Active?</label>
                                        <?php if (isset($_GET['type']) && $_GET['type']=="edit") {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" <?php if($res_data['status']=='Y')  { echo 'checked="checked"'; }?>>
                                            <input type="hidden" id="event_status" name="event_status" value="<?php echo $res_data['status'];?>">
                                        <?php } else {?>
                                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                                            <input type="hidden" id="event_status" name="event_status" value="Y">
                                        <?php }?>
                                    </div>
                                    <button type="submit" name="add" class="btn app-btn-primary btnEvent">Submit</button>
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
        $(".btnEvent").click(function() {
            var title = $("#title").val();
            var description = CKEDITOR.instances['description'].getData();
            var event_picture = $("#event_picture").val();
            var time = $("#time").val();
            
            if (title == "") {
                Swal.fire("Blog title must be required !!!");
                return false;
            }
            if (description == "") {
                Swal.fire("Content must be required !!!");
                return false;
            }
            if (time == "") {
                Swal.fire("time must be required !!!");
                return false;
            }
            
            $("#eventFrm").submit();
        });
    });
    </script>
<?php include_once('includes/footer.php');?>