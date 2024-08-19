<?php include_once('includes/header.php');
// resent event
$query_resent_event = "SELECT * FROM `events` ORDER BY `date` DESC LIMIT 3";
$result_resent_event = mysqli_query($con, $query_resent_event);
// get details
if(isset($_GET['prams'])){
  $params = $_GET['prams'];
  $getdata = mysqli_query($con,"SELECT * FROM `events` WHERE `id`='$params'");
  $event_data = mysqli_fetch_array($getdata);

  $day = date('d', strtotime($event_data['date']));
  $month = date('m', strtotime($event_data['date']));
  $year = date('Y', strtotime($event_data['date']));
}
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.png">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="events.html">Upcoming Events</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Event Details</li>
        </ul>
        <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- event single -->
<section class="section-sm">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title"><?php echo $event_data['title'];?></h2>
      </div>
      <!-- event image -->
      <div class="col-12 mb-4">
        <img src="<?php echo ADMIN_URL.'/'.$event_data['event_picture'];?>" alt="event thumb" class="img-fluid w-100">
      </div>
    </div>
    <!-- event info -->
    <div class="row align-items-center mb-5">
      <div class="col-lg-9">
        <ul class="list-inline">
          <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
            <div class="d-flex align-items-center">
              <i class="ti-location-pin text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">LOCATION</h6>
                <p class="mb-0"><?php echo $event_data['location'];?></p>
              </div>
            </div>
          </li>
          <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
            <div class="d-flex align-items-center">
              <i class="ti-calendar text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">DATE</h6>
                <p class="mb-0"><?php echo $year;?>-<?php echo $month;?>-<?php echo $day;?></p>
              </div>
            </div>
          </li>
          <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
            <div class="d-flex align-items-center">
              <i class="ti-time text-primary icon-md mr-2"></i>
              <div class="text-left">
                <h6 class="mb-0">TIME</h6>
                <p class="mb-0"><?php echo $event_data['time'];?></p>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <!-- border -->
      <div class="col-12 mt-4 order-4">
        <div class="border-bottom border-primary"></div>
      </div>
    </div>
    <!-- event details -->
    <div class="row">
      <div class="col-12 mb-50">
        <h3>About Event</h3>
        <?php echo $event_data['description'];?>
      </div>
    </div>
  </div>
</section>
<!-- /event single -->

<!-- more event -->
<section class="section pt-0">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">More Events</h2>
      </div>
    </div>
    <div class="row justify-content-center">
    <?php if (mysqli_num_rows($result_resent_event) > 0) {
        while($data_event = mysqli_fetch_assoc($result_resent_event)) {
        $day = date('d', strtotime($data_event['date']));
        $monthName = date('F', strtotime($data_event['date']));
    ?>
    <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
      <div class="card border-0 rounded-0 hover-shadow">
        <div class="card-img position-relative">
          <img class="card-img-top rounded-0" src="<?php echo ADMIN_URL.'/'.$data_event['event_picture'];?>" alt="event thumb" style="width: 350px; height: 233px;">
          <div class="card-date"><span><?php echo $day;?></span><br><?php echo $monthName;?></div>
        </div>
        <div class="card-body">
          <!-- location -->
          <p><i class="ti-location-pin text-primary mr-2"></i><?php echo $data_event['location'];?></p>
          <a href="<?php echo BASE_URL.'event-single?prams='.$data_event['id'];?>"><h4 class="card-title"><?php echo $data_event['title'];?></h4></a>
        </div>
      </div>
    </div>
  <?php }
    }?>
</div>
  </div>
</section>
<!-- /more event -->
<?php include_once('includes/footer.php');?>
