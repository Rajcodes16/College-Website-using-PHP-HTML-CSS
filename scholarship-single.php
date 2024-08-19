
<?php include_once('includes/header.php');
// get details
if(isset($_GET['prams'])){
  $params = $_GET['prams'];
  $getdata = mysqli_query($con,"SELECT * FROM `schalership` WHERE `id`='$params'");
  $scholarship_data = mysqli_fetch_array($getdata);

  $day = date('d', strtotime($scholarship_data['start_date']));
  $monthName = date('F', strtotime($scholarship_data['start_date']));
  $year = date('Y', strtotime($scholarship_data['start_date']));
}
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.png">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="<?php echo BASE_URL.'scholarship';?>">Scholarship</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Scholarship Details</li>
        </ul>
        <p class="text-lighten mb-0">A scholarship is a form of financial aid awarded to students for further education.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- notice details -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex">
          <div class="text-center mr-4">
            <div class="p-4 bg-primary text-white">
                <span class="h2 d-block"><?php echo $day;?></span> <?php echo $monthName;?>,<?php echo $year;?>
            </div>
          </div>
          <!-- notice content -->
          <div>
            <h3 class="mb-4"><?php echo $scholarship_data['title'];?></h3>
            <?php echo $scholarship_data['description'];?>
            <a href="<?php echo ADMIN_URL.'/'.$scholarship_data['link'];?>" target="blank" class="btn btn-primary">Download</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /notice details -->
<?php include_once('includes/footer.php');?>
