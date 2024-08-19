<?php include_once('includes/header.php');

?>
<!-- page title -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.png">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="<?php echo BASE_URL;?>">Home</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Contact Us</li>
        </ul>
        <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- contact -->
<section class="section bg-gray">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="section-title">Contact Us</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-7 mb-4 mb-lg-0">
        <form action="/contact.html" method="POST">
          <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Your Name" required>
          <input type="email" class="form-control mb-3" id="mail" name="mail" placeholder="Your Email" required>
          <input type="text" class="form-control mb-3" id="subject" name="subject" placeholder="Subject" required>
          <textarea name="message" id="message" class="form-control mb-3" placeholder="Your Message" required></textarea>
          <button type="submit" value="send" class="btn btn-primary">SEND MESSAGE</button>
        </form>
      </div>
      <div class="col-lg-5">
        <p class="mb-5"><?php echo $data_setting['footer_aboutUs'];?></p>
        <a href="tel:<?php echo $data_setting['contact_phone'];?>" class="text-color h5 d-block"><?php echo $data_setting['contact_phone'];?></a>
        <a href="mailto:<?php echo $data_setting['contact_email'];?>" class="mb-5 text-color h5 d-block"><?php echo $data_setting['contact_email'];?></a>
        <p><?php echo $data_setting['contact_address'];?></p>
      </div>
    </div>
  </div>
</section>
<!-- /contact -->

<!-- gmap -->
<section class="section pt-0">
  <!-- Google Map -->
  <div>
    <div class="map">
      <iframe
        src="<?php echo $data_setting['contact_map_code'];?>"
        height="350" style="border:0;width: 100%;" allowfullscreen="" aria-hidden="false"
        tabindex="0"></iframe>
    </div>
  </div>
</section>
<!-- /gmap -->

<?php include_once('includes/footer.php');?>