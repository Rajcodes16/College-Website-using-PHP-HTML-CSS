<?php include_once('includes/header.php');
// resent course
$query_resent_course = "SELECT * FROM `courses` ORDER BY `course_date` DESC LIMIT 3";
$result_resent_course = mysqli_query($con, $query_resent_course);

if(isset($_GET['prams'])){
  $params = $_GET['prams'];
  $getdata = mysqli_query($con,"SELECT * FROM `teachers` WHERE `id`='$params'");
  $teacher_data = mysqli_fetch_array($getdata);
}
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.png">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="<?php echo BASE_URL.'teacher';?>">Our Teacher</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted"><?php echo $teacher_data['name'];?></li>
        </ul>
        <p class="text-lighten mb-0"><?php echo $teacher_data['designation'];?></p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- teacher details -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-md-5 mb-5">
        <img class="img-fluid w-100" src="<?php echo ADMIN_URL.'/'.$teacher_data['image'];?>" alt="teacher" style="width: 445px !important; height: 501px;">
      </div>
      <div class="col-md-6 mb-5">
        <h3><?php echo $teacher_data['name'];?></h3>
        <h6 class="text-color"><?php echo $teacher_data['designation'];?></h6>
        <p class="mb-5"><?php echo $teacher_data['bio'];?></p>
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h4 class="mb-4">CONTACT INFO:</h4>
            <ul class="list-unstyled">
              <li class="mb-3"><a class="text-color" href="mailto:<?php echo $teacher_data['email'];?>"><i class="ti-email mr-2"></i><?php echo $teacher_data['email'];?></a></li>
              <li class="mb-3"><a class="text-color" href="tel:+91<?php echo $teacher_data['phone'];?>"><i class="ti-mobile mr-2"></i>+91<?php echo $teacher_data['phone'];?></a></li>
              <li class="mb-3"><a class="text-color" href="//<?php echo $teacher_data['facebook'];?>"><i class="ti-facebook mr-2"></i><?php echo $teacher_data['facebook'];?></a></li>
              <li class="mb-3"><a class="text-color" href="//<?php echo $teacher_data['twitter'];?>"><i class="ti-twitter-alt mr-2"></i><?php echo $teacher_data['twitter'];?></a></li>
              <li class="mb-3"><a class="text-color" href="//<?php echo $teacher_data['instagram'];?>"><i class="ti-instagram mr-2"></i><?php echo $teacher_data['instagram'];?></a></li>
              <li class="mb-3"><a class="text-color" href="//<?php echo $teacher_data['linkedin'];?>"><i class="ti-linkedin mr-2"></i><?php echo $teacher_data['linkedin'];?></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-12">
        <h4 class="mb-4">BIOGRAPHY</h4>
        <p class="mb-5"><?php echo $teacher_data['about'];?></p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-12">
        <h4 class="mb-4">COURSES</h4>
      </div>
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
<!-- /teacher details -->
<?php include_once('includes/footer.php');?>
