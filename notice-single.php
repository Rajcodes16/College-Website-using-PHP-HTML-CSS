
<?php include_once('includes/header.php');
// get details
if(isset($_GET['prams'])){
  $params = $_GET['prams'];
  $getdata = mysqli_query($con,"SELECT * FROM `notices` WHERE `id`='$params'");
  $notice_data = mysqli_fetch_array($getdata);

  $day = date('d', strtotime($notice_data['notice_date']));
  $monthName = date('F', strtotime($notice_data['notice_date']));
  $year = date('Y', strtotime($notice_data['notice_date']));
}
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.png">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="<?php echo BASE_URL.'notice';?>">Notice</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Notice Details</li>
        </ul>
        <p class="text-lighten mb-0">Notices are a means of formal communication targetted at a particular person or a group of persons. It is like a news item informing such person or persons of some important event.</p>
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
            <h3 class="mb-4"><?php echo $notice_data['title'];?></h3>
            <?php echo $notice_data['content'];?>
            <a href="<?php echo ADMIN_URL.'/'.$notice_data['notice_link'];?>" target="blank" class="btn btn-primary">Download</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /notice details -->
<?php include_once('includes/footer.php');?>
