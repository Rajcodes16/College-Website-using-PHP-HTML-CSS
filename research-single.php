
<?php include_once('includes/header.php');
// get details
if(isset($_GET['prams'])){
    $params = $_GET['prams'];
    $query_photo = "SELECT * FROM `research_images` WHERE `research_id`='$params'";
    $result_photo = mysqli_query($con, $query_photo);
}
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.png">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="<?php echo BASE_URL;?>">Home</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Research Gallery</li>
        </ul>
        <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- scholarship -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center" style="margin-top: 15px;">
    <?php if (mysqli_num_rows($result_photo) > 0) {
        while($data_photo = mysqli_fetch_assoc($result_photo)) {
    ?>
      <!-- scholarship item -->
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0" style="margin-bottom: 15px !important;">
        <div class="card rounded-0 hover-shadow border-top-0 border-left-0 border-right-0">
          <img class="card-img-top rounded-0" src="<?php echo ADMIN_URL.'/'.$data_photo['image'];?>" alt="scholarship-thumb" style="width: 350px; height: 262px;">
        </div>
      </div>
    <?php }
      }?>
    </div>
  </div>
</section>
<!-- /scholarship -->
<?php include_once('includes/footer.php');?>
