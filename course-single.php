
<?php include_once('includes/header.php');
// resent course
$query_resent_course = "SELECT * FROM `courses` ORDER BY `course_date` DESC LIMIT 3";
$result_resent_course = mysqli_query($con, $query_resent_course);
// get details
if(isset($_GET['prams'])){
  $params = $_GET['prams'];
  $getdata = mysqli_query($con,"SELECT * FROM `courses` WHERE `id`='$params'");
  $course_data = mysqli_fetch_array($getdata);
}
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.png">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="courses.html">Our Courses</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted"><?php echo $course_data['course_name'];?></li>
        </ul>
        <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- section -->
<section class="section-sm">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <!-- course thumb -->
        <img src="<?php echo ADMIN_URL.'/'.$course_data['course_picture'];?>" class="img-fluid w-100">
      </div>
    </div>
    <!-- course info -->
    <div class="row align-items-center mb-5">
      <div class="col-xl-3 order-1 col-sm-6 mb-4 mb-xl-0">
        <h2><?php echo $course_data['course_name'];?></h2>
      </div>
      <div class="col-xl-9 text-sm-right text-left order-sm-2 order-3 order-xl-3 col-sm-6 mb-4 mb-xl-0">
        <a href="<?php echo BASE_URL.'course-single?prams='.$course_data['id'];?>" class="btn btn-primary">Apply now</a>
      </div>
      <!-- border -->
      <div class="col-12 mt-4 order-4">
        <div class="border-bottom border-primary"></div>
      </div>
    </div>
    <!-- course details -->
    <div class="row">
      <div class="col-12 mb-4">
        <h3>About Course</h3>
        <?php echo $course_data['description'];?>
      </div>
    </div>
  </div>
</section>
<!-- /section -->

<!-- related course -->
<section class="section pt-0">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Related Course</h2>
      </div>
    </div>
    <div class="row justify-content-center">
    <?php if (mysqli_num_rows($result_resent_course) > 0) {
        while($data_courses = mysqli_fetch_assoc($result_resent_course)) {
    ?>
      <!-- course item -->
      <div class="col-lg-4 col-sm-6 mb-5">
        <div class="card p-0 border-primary rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="<?php echo ADMIN_URL.'/'.$data_courses['course_picture'];?>" alt="course thumb">
          <div class="card-body">
            <ul class="list-inline mb-2">
              <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i><?php echo date('d-m-Y',strtotime($data_courses['course_date']));?></li>
            </ul>
            <a href="<?php echo BASE_URL.'course-single?prams='.$data_courses['id'];?>">
              <h4 class="card-title"><a class="text-color" href="<?php echo BASE_URL.'course-single?prams='.$data_courses['id'];?>"><?php echo $data_courses['course_name'];?></a></h4>
            </a>
            <p class="card-text mb-4"><?php echo substr(($data_courses['description']),0,150);?>...</p>
            <a href="<?php echo BASE_URL.'course-single?prams='.$data_courses['id'];?>" class="btn btn-primary btn-sm">Apply now</a>
          </div>
        </div>
      </div>
    <?php }
    }?>
    </div>
  </div>
</section>
<!-- /related course -->
<?php include_once('includes/footer.php');?>
