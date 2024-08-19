<?php include_once('includes/header.php');
// update Logo
if(isset($_POST['logo_post']))
{
    $uploadTo = "uploads/logo/"; 
    $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
    $fileName = $_FILES['logo']['name'];
    $tempPath=$_FILES["logo"]["tmp_name"];
   
    $basename = basename($fileName);
    $originalPath = $uploadTo.$basename; 
    $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
    if(!empty($fileName)){ 
       if(in_array($fileType, $allowFileType)){ 
         if(move_uploaded_file($tempPath,$originalPath)){ 
            $logo = "uploads/logo/".$fileName;
          }else{ 
            $logo = $data_setting['logo'];
          } 
      }else{
         return $fileType." file type not allowed";
      }
    }else{  
        $logo = $data_setting['logo'];
    }
  
    $sql_logo = "UPDATE settings SET `logo`='$logo' WHERE `settingId` = $settingId ";
    if ($con->query($sql_logo) === TRUE) {
        echo "<script>window.location.href='settings'</script>"; exit();
    } else {
        echo "Error updating record: " . $con->error;
    }
    $con->close();

}
// update favicon
if(isset($_POST['fav_post']))
{
    $uploadTo = "uploads/logo/"; 
    $allowFileType = array('jpg','png','jpeg','gif','pdf','doc');
    $fileName = $_FILES['favicon']['name'];
    $tempPath=$_FILES["favicon"]["tmp_name"];
   
    $basename = basename($fileName);
    $originalPath = $uploadTo.$basename; 
    $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
    if(!empty($fileName)){ 
       if(in_array($fileType, $allowFileType)){ 
         if(move_uploaded_file($tempPath,$originalPath)){ 
            $favicon = "uploads/logo/".$fileName;
          }else{ 
            $favicon = $data_setting['favicon'];
          } 
      }else{
         return $fileType." file type not allowed";
      }
    }else{  
        $favicon = $data_setting['favicon'];
    }
  
    $sql_favicon = "UPDATE settings SET `favicon`='$favicon' WHERE `settingId` = $settingId ";
    if ($con->query($sql_favicon) === TRUE) {
        echo "<script>window.location.href='settings'</script>"; exit();
    } else {
        echo "Error updating record: " . $con->error;
    }
    $con->close();

}
// update general
if(isset($_POST['gen_post']))
{
    $website_name = $_POST['website_name'];
    $footer_aboutUs = $_POST['footer_aboutUs'];
    $footer_copyright = $_POST['footer_copyright'];
    $contact_address = $_POST['contact_address'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $contact_fax = $_POST['contact_fax']; 
    $contact_map_code = $_POST['contact_map_code'];
   
    $sql_gen = "UPDATE settings SET `website_name`='$website_name', `footer_aboutUs`='$footer_aboutUs', `footer_copyright`='$footer_copyright', `contact_address`='$contact_address',`contact_email`='$contact_email',`contact_phone`='$contact_phone',`contact_fax`='$contact_fax',`contact_map_code`='$contact_map_code' WHERE `settingId` = $settingId";
    if ($con->query($sql_gen) === TRUE) {
        echo "<script>window.location.href='settings'</script>"; exit();
    } else {
        echo "Error updating record: " . $con->error;
    }
    $con->close();
}
?>
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <h1 class="app-page-title">Settings</h1>
            <hr class="mb-4">
            <div class="row g-4 settings-section">
                <div class="col-12 col-md-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                        <div class="app-card-body">
                            <div class="tab">
                                <button class="tablinks" onclick="openSetting('Logo')">Logo</button>
                                <button class="tablinks" onclick="openSetting('Favicon')">Favicon</button>
                                <button class="tablinks" onclick="openSetting('General')">General Content</button>
                            </div>
                            <!-- for logo -->
                            <div id="Logo" class="tabcontent" style="display:block">
                                <form class="settings-form" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Previous Logo</label>
                                        <img src="<?php echo $data_setting['logo'];?>" style="height: 70px;" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">New Logo</label><br>
                                        <input type="file" name="logo" id="logo" />
                                    </div>
                                    <button type="submit" name="logo_post" class="btn app-btn-primary">Update Logo</button>
                                </form>
                            </div>
                            <!-- for favicon -->
                            <div id="Favicon" class="tabcontent" style="display:none">
                                <form class="settings-form" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Previous Favicon</label>
                                        <img src="<?php echo $data_setting['favicon'];?>" style="height: 30px;" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">New Favicon</label><br>
                                        <input type="file" name="favicon" id="favicon" />
                                    </div>
                                    <button type="submit" name="fav_post" class="btn app-btn-primary">Update
                                        Favicon</button>
                                </form>
                            </div>
                            <!-- general -->
                            <div id="General" class="tabcontent" style="display:none">
                                <form class="settings-form" method="post">
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Website Name</label>
                                        <input type="text" class="form-control" id="website_name" name="website_name"
                                            value="<?php echo $data_setting['website_name'];?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Footer - About Us</label>
                                        <textarea class="form-control egt8" id="footer_aboutUs" name="footer_aboutUs"><?php echo $data_setting['footer_aboutUs'];?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Footer - Copyright</label>
                                        <textarea class="form-control egt8" id="footer_copyright" name="footer_copyright"><?php echo $data_setting['footer_copyright'];?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Contact Address</label>
                                        <textarea class="form-control egt8" id="contact_address" name="contact_address"><?php echo $data_setting['contact_address'];?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Contact Email</label>
                                        <input type="text" class="form-control" id="contact_email" name="contact_email" value="<?php echo $data_setting['contact_email'];?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Contact Phone Number</label>
                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="<?php echo $data_setting['contact_phone'];?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Contact Fax Number</label>
                                        <input type="text" class="form-control" id="contact_fax" name="contact_fax" value="<?php echo $data_setting['contact_fax'];?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="setting-input-3" class="form-label">Contact Map iFrame</label>
                                        <textarea class="form-control egt8" id="contact_map_code" name="contact_map_code"><?php echo $data_setting['contact_map_code'];?></textarea>
                                    </div>
                                    <button type="submit" name="gen_post" class="btn app-btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- page jquery -->
<script>
    function openSetting(type) {
        var i;
        var x = document.getElementsByClassName("tabcontent");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
        }
        document.getElementById(type).style.display = "block";  
    }
</script>    
    <?php include_once('includes/footer.php');?>