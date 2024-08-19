<?php include_once('includes/header.php');
// teacher
$query_teacher = "SELECT * FROM `teachers` WHERE `status`='Y' ORDER BY `id` DESC LIMIT 3";
$result_teacher = mysqli_query($con, $query_teacher);
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.png">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="<?php echo BASE_URL;?>">Home</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">About Us</li>
        </ul>
        <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- about -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <img class="img-fluid w-100 mb-4" src="images/about/about-page.jpg" alt="about image">
        <h3 class="section-title">Best Goverment Polytechnic In West Bengal.</h3>
            <p class="fst-italic">
              Kalna Polytechnic, established in 2002, is a government polytechnic college located in Kalna, Purba Bardhaman district, West Bengal.
            </p>
            <ul>
              <li>1. Three branches (DCE, DETCE, DCST) are available here.</li>
              <li>2. Hostel facility is available for girls only.</li>
              <li>3. College campus is also very nice surrounding with green environment and has a adequate area.</li>
            </ul>
            <p>
              Kalna polytechnic is a government polytechnic college.In this college study techniques are very unique.Each department has their own laboratory for performing the skills.Three branches of diploma engineering are taught here by experienced faculties,and also there is a government hostel for girls only.
            </p>
      </div>
    </div>
  </div>
</section>
<!-- /about -->

<!-- funfacts -->
<section class="section-sm bg-primary">
  <div class="container">
    <div class="row">
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="60">0</h2>
          <h5 class="text-white">TEACHERS</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="50">0</h2>
          <h5 class="text-white">COURSES</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="1000">0</h2>
          <h5 class="text-white">STUDENTS</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="3737">0</h2>
          <h5 class="text-white">SATISFIED CLIENT</h5>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /funfacts -->

<!-- success story -->
<section class="section bg-cover" data-background="images/backgrounds/success-story.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-sm-4 position-relative success-video">
        <a class="play-btn venobox" href="https://youtu.be/nA1Aqp0sPQo" data-vbtype="video">
          <i class="ti-control-play"></i>
        </a>
      </div>
      <div class="col-lg-6 col-sm-8">
        <div class="bg-white p-5">
          <h2 class="section-title">Success Stories</h2>
          <p>Kalna Polytechnic, established in 2002, is a government polytechnic college located in Kalna, Purba Bardhaman district, West Bengal.</p>
          <p>This polytechnic is affiliated to the West Bengal State Council of Technical Education (WBSCTE), and is recognised by the All India Council ForTechnical Education (AICTE), New Delhi. This polytechnic offers diploma courses in Computer Science & Technology (DCST), Electronics & Telecommunication (DETC) and Civil Engineering (DCE). It also has on site hostels for girls only. There are various facilities provided to the 
students like a playing field, lab equipment's, well maintained computer lab's, etc.
Our placement have made us proud.we have placed 90% students . placement of 2023 is running</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /success story -->

<!-- teachers -->
<section class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <h2 class="section-title">Our Teachers</h2>
        </div>
        <?php if (mysqli_num_rows($result_teacher) > 0) {
          while($data_teacher = mysqli_fetch_assoc($result_teacher)) {
      ?>
      <!-- teacher -->
      <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
        <div class="card border-0 rounded-0 hover-shadow">
        <img class="card-img-top rounded-0" src="<?php echo ADMIN_URL.'/'.$data_teacher['image'];?>" alt="teacher" style="width: 340px;height: 383px;">
          <div class="card-body">
            <a href="<?php echo BASE_URL.'teacher-single?prams='.$data_teacher['id'];?>">
              <h4 class="card-title"><?php echo $data_teacher['name'];?></h4>
            </a>
            <p><?php echo $data_teacher['designation'];?></p>
            <ul class="list-inline">
                <li class="list-inline-item"><a class="text-color" href="//<?php echo $data_teacher['facebook'];?>"><i class="ti-facebook"></i></a></li>
                <li class="list-inline-item"><a class="text-color" href="//<?php echo $data_teacher['twitter'];?>"><i class="ti-twitter-alt"></i></a></li>
                <li class="list-inline-item"><a class="text-color" href="//<?php echo $data_teacher['instagram'];?>"><i class="ti-instagram"></i></a></li>
                <li class="list-inline-item"><a class="text-color" href="//<?php echo $data_teacher['linkedin'];?>"><i class="ti-linkedin"></i></a></li>
              </ul>
          </div>
        </div>
      </div>
      <?php }
      }?>
        
      </div>
    </div>
  </section>
  <!-- /teachers -->
<?php include_once('includes/footer.php');?>