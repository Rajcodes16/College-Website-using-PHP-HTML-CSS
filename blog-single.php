<?php 
include_once('includes/header.php');
// resent blog
$query_resent_blog = "SELECT * FROM `blogs` ORDER BY `blog_date` DESC LIMIT 3";
$result_resent_blog = mysqli_query($con, $query_resent_blog);
// get details
if(isset($_GET['prams'])){
  $params = $_GET['prams'];
  $getdata = mysqli_query($con,"SELECT * FROM `blogs` WHERE `id`='$params'");
  $blog_data = mysqli_fetch_array($getdata);

  $day = date('d', strtotime($blog_data['blog_date']));
  $monthName = date('F', strtotime($blog_data['blog_date']));
  $year = date('Y', strtotime($blog_data['blog_date']));
}
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="<?php echo ADMIN_URL.'/'.$blog_data['blog_img'];?>">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="blog">Our Blog</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Blog Details</li>
        </ul>
        <p class="text-lighten mb-0">A blog (a truncation of "weblog") is an informational website published on the World Wide Web consisting of discrete, often informal diary-style text entries (posts).</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- blog details -->
<section class="section-sm bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-4">
        <img src="images/blog/blog-single.jpg" alt="blog-thumb" class="img-fluid w-100">
      </div>
      <div class="col-12">
        <ul class="list-inline">
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light"><span class="font-weight-bold mr-2">Post:</span><?php echo $blog_data['publisher'];?></li>
          <li class="list-inline-item mr-4 mb-3 mb-md-0 text-light"><?php echo $monthName;?> <?php echo $day;?>, <?php echo $year;?></li>
        </ul>
      </div>
      <!-- border -->
      <div class="col-12 mt-4">
        <div class="border-bottom border-primary"></div>
      </div>
      <!-- blog contect -->
      <div class="col-12 mb-5">
        <h2><?php echo $blog_data['blog_title'];?></h2>
        <?php echo $blog_data['blog_content'];?>
      </div>
    </div>
  </div>
</section>
<!-- /blog details -->

<!-- recommended post -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Recommended</h2>
      </div>
    </div>
    <div class="row justify-content-center">
  <!-- blog post -->
  <?php if (mysqli_num_rows($result_resent_blog) > 0) {
    while($data_blog = mysqli_fetch_assoc($result_resent_blog)) {
    $day = date('d', strtotime($data_blog['blog_date']));
    $monthName = date('F', strtotime($data_blog['blog_date']));
    $year = date('Y', strtotime($data_blog['blog_date']));
  ?>
  <article class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
    <div class="card rounded-0 border-bottom border-primary border-top-0 border-left-0 border-right-0 hover-shadow">
      <img class="card-img-top rounded-0" src="<?php echo ADMIN_URL.'/'.$data_blog['blog_img'];?>" alt="Post thumb">
      <div class="card-body">
        <!-- post meta -->
        <ul class="list-inline mb-3">
          <!-- post date -->
          <li class="list-inline-item mr-3 ml-0"><?php echo $monthName;?> <?php echo $day;?>, <?php echo $year;?></li>
          <!-- author -->
          <li class="list-inline-item mr-3 ml-0">By <?php echo $data_blog['publisher'];?></li>
        </ul>
        <a href="<?php echo BASE_URL.'blog-single?prams='.$data_blog['id'];?>">
          <h4 class="card-title"><?php echo $data_blog['blog_title'];?></h4>
        </a>
        <p class="card-text"><?php echo substr(($data_blog['blog_content']),0,100);?></p>
        <a href="<?php echo BASE_URL.'blog-single?prams='.$data_blog['id'];?>" class="btn btn-primary btn-sm">read more</a>
      </div>
    </div>
  </article>
  <?php }
    }?>
</div>
  </div>
</section>
<!-- /recommended post -->
<?php include_once('includes/footer.php');?>
