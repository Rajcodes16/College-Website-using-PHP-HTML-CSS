<?php include_once('includes/header.php');
// this is get blog category
$query = "SELECT * FROM `social_media` WHERE `id` = 1;";
$result = mysqli_query($con, $query);
$social_data = mysqli_fetch_array($result);

// update
if(isset($_POST['update']))
{
  $facebook = $_POST['facebook'];
  $twitter = $_POST['twitter'];
  $linkedIn = $_POST['linkedIn'];
  $google_plus = $_POST['google_plus'];
  $youtube = $_POST['youtube'];
  $instagram = $_POST['instagram']; 
  $whatsapp = $_POST['whatsapp'];
  
// update social
    $sql = "UPDATE social_media SET `facebook`='$facebook',`twitter`='$twitter',`linkedIn`='$linkedIn',`google_plus`='$google_plus',`youtube`='$youtube',`instagram`='$instagram',`whatsapp`='$whatsapp' WHERE `id`=1";
    if ($con->query($sql) === TRUE) {
        echo "<script>window.location.href='social_media'</script>"; exit();
    } else {
    echo "Error updating record: " . $con->error;
    }

    $con->close();
}
?>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <h1 class="app-page-title">Social Media</h1>
				<form class="settings-form" method="post">
                    <hr class="mb-4">
                    <div class="row g-4 settings-section">
                        <div class="col-12 col-md-12">
                            <div class="app-card app-card-settings shadow-sm p-4">
                                <div class="app-card-body">
                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Facebook</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook" value="<?= $social_data['facebook'];?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Twitter</label>
                                        <input type="text" class="form-control" id="twitter" name="twitter" value="<?= $social_data['twitter'];?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">LinkedIn</label>
                                        <input type="text" class="form-control" id="linkedIn" name="linkedIn" value="<?= $social_data['linkedIn'];?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Google Plus</label>
                                        <input type="text" class="form-control" id="google_plus" name="google_plus" value="<?= $social_data['google_plus'];?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">YouTube</label>
                                        <input type="text" class="form-control" id="youtube" name="youtube" value="<?= $social_data['youtube'];?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">Instagram</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram" value="<?= $social_data['instagram'];?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="setting-input-1" class="form-label">WhatsApp</label>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?= $social_data['whatsapp'];?>">
                                    </div>

                                    <button type="submit" name="update" class="btn app-btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
<!-- page jquery -->
<?php include_once('includes/footer.php');?>