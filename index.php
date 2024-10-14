<?php
   session_start();
   require_once realpath(__DIR__ . '/vendor/autoload.php');

   $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

   if(isset($_SESSION['login_id'])){
      $login_id = $_SESSION['login_id'];
   }else{
      $login_id = "";
   }
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>OCARMS - Online Calamity Assistance Requests and Monitoring System</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <!-- Favicon -->
      <link href="img/favicon.ico" rel="icon">
   <!-- Google Font -->
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
   <!-- CSS Libraries -->
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
   <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
   <link href="lib/animate/animate.min.css" rel="stylesheet">
   <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
   <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
   <link href="lib/slick/slick.css" rel="stylesheet">
   <link href="lib/slick/slick-theme.css" rel="stylesheet">
   <link rel="stylesheet" href="css/owl.carousel.min.css">
   <link rel="stylesheet" href="css/owl.theme.default.min.css">

   <!-- Template Stylesheet -->
   <link href="css/style.css?v=<?php echo date('s'); ?>" rel="stylesheet">
   <link href="css/custom.css?v=<?php echo date('s'); ?>" rel="stylesheet">
</head>

<body>
   <div class="wrapper">
      <!-- Top Bar Start -->
      <?php include('includes/topbar.php') ?>
      <!-- Top Bar End -->
      <!-- Nav Bar Start -->
      <div class="nav-bar">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
               <a href="#" class="navbar-brand">MENU</a>
               <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">

                  <div class="navbar-nav mr-auto">
                     <a href="index.php" class="nav-item nav-link active">Home</a>

                     <div class="nav-item dropdown animated--grow-in">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Campaigns</a>
                        <div class="dropdown-menu rounded">
                           <a href="campaigns_monetory.php" class="dropdown-item">
                              <i class="fas fa-dollar-sign fa-sm fa-fw mr-2 text-gray-200"></i>
                                 Monetory
                           </a>
                           <a href="campaigns_goods.php" class="dropdown-item">
                              <i class="fas fa-box fa-sm fa-fw mr-2 text-gray-200"></i>
                                 Goods
                           </a>
                        </div>
                     </div>
                     <a href="volunteer.php" class="nav-item nav-link">Volunteer</a>
                     <a href="request.php" class="nav-item nav-link">Request</a>
                     <a href="blog.php" class="nav-item nav-link">Bulletin/Events</a>
                     <a href="contact.php" class="nav-item nav-link">Contact</a>
                     <a href="about.php" class="nav-item nav-link">About</a>
                  </div>
                  <div class="navbar-nav ml-auto">
                     <?php
                        require 'includes/connect.php';
                        if(isset($_SESSION['login_id'])){
                        $id = $_SESSION['login_id'];

                        $get_user = mysqli_query($conn, "SELECT * FROM `client_information` WHERE `google_id`='$id'");
                        $user = mysqli_fetch_assoc($get_user);

                        $client_id = $user['client_id'];

                        $amount_query=mysqli_query($conn,"SELECT SUM(donation_amount) as _sum FROM monetary_donation_info WHERE client_id = $client_id AND donation_type = 'Fundraise Donation' AND donation_status = 'Carted'");
                        $row_amount=mysqli_fetch_array($amount_query);
                        $total_2 = $row_amount["_sum"]
                     ?>
                                             <a class="mr-2 d-none d-lg-inline small text-user text-orange" href="donate_cart.php">
                           <i class="fas fa-cart-plus fa-lg fa-fw mr-2 text-gray-400"></i><?php echo $total_2;?>
                        </a>
                     <div class="nav-item dropdown animated--grow-in no-arrow">
                        <a class="nav-link-2 dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?php
                                 $img = $user['image_name'];
                                 $disp_img = $user['client_image'];
                                 if($img == "null.jpg" && $disp_img == null){
                                    $image_src = "img/Logo.png";
                                 }else if($img != "null.jpg" && $img != "" && $disp_img != null){
                                    $image_src = "includes/client_credentials/image_view.php?google_id=$id";
                                 }else if($img == "" && $disp_img != null){
                                    $image_src = $user['client_image'];
                                 }
                              ?>
                           <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>" alt="<?php echo $user['client_name']; ?>">
                        </a>
                        <div class="dropdown-menu drop rounded dropdown-menu-right" aria-labelledby="userDropdown">
                           <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>" alt="<?php echo $user['client_name']; ?>">
                           <p class="text-center"><?php echo $user['client_name']; ?></p>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="account.php">
                              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                              My Account
                           </a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="includes/logout.php">
                              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                              Signout
                           </a>
                        </div>
                     </div>
                     <?php } else { ?>
                        <a class="btn" href="user_credentials_register.php?l=3">Register</a>
                      <?php } ?>
                  </div>
               </div>
            </nav>
         </div>
      </div>
      <!-- Nav Bar End -->
      <!-- Carousel Start -->
      <div id="carousel" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img src="img/carousel-1.jpg" alt="Carousel Image">
               <div class="carousel-caption">
                  <p class="animated fadeInRight">Be a Benefactor</p>
                  <h1 class="animated fadeInLeft">For Victims of Calamities</h1>
                  <button type="submit" class="btn animated fadeInUp">Donate Today</button>
               </div>
            </div>
            <div class="carousel-item">
               <img src="img/carousel-2.png" alt="Carousel Image">
               <div class="carousel-caption">
                  <p class="animated fadeInRight">Be a Volunteer</p>
                  <h1 class="animated fadeInLeft">And Help Save Lives</h1>
                  <a class="btn animated fadeInUp" href="volunteer.php">Apply Today</a>
               </div>
            </div>
            <div class="carousel-item">
               <img src="img/carousel-3.jpg" alt="Carousel Image">
               <div class="carousel-caption">
                  <p class="animated fadeInRight">Be a Benefeciary</p>
                  <h1 class="animated fadeInLeft">Let Us Help You Recover</h1>
                  <a class="btn animated fadeInUp" href="request.php">Request Today</a>
               </div>
            </div>
         </div>
         <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
      <!-- Carousel End -->
      <!-- Feature Start-->
      <div class="feature wow fadeInUp" data-wow-delay="0.1s">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-lg-4 col-md-12">
                  <div class="feature-item">
                     <div class="feature-icon">
                        <i class="flaticon-donate-1"></i>
                     </div>
                     <div class="feature-text">
                        <h3>Donate</h3>
                        <p>Explore non-profits in DSWD, Minglanilla and donate to the causes you're passionate about!</p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-12">
                  <div class="feature-item">
                     <div class="feature-icon">
                        <i class="flaticon-volunteer-1"></i>
                     </div>
                     <div class="feature-text">
                        <h3>Volunteer</h3>
                        <p>Find a volunteer activity that you're interested in, to use the skills you have, right here
                           in DSWD, Minglanilla!</p>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-12">
                  <div class="feature-item">
                     <div class="feature-icon">
                        <i class="flaticon-request-1"></i>
                     </div>
                     <div class="feature-text">
                        <h3>Request</h3>
                        <p>Identify your needs and request them in this website affiliated with the DSWD Minglanilla
                           Office!</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Feature End-->
      <!-- About Start -->
      <div class="about wow fadeInUp" data-wow-delay="0.1s" id="about-minglanilla">
         <div class="container">
            <div class="row align-items-center">
               <div class="col-lg-5 col-md-6">
                  <div class="about-img">
                     <img src="img/dswd-logo-1.png" alt="Image">
                  </div>
               </div>
               <div class="col-lg-7 col-md-6">
                  <div class="section-header text-left">
                     <p>Welcome to DSWD Minglanilla</p>
                     <h2>Minglanilla, Cebu</h2>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- About End -->
      <!-- Fact Start -->
      <?php
         $count1=mysqli_query($conn,"SELECT COUNT(fundraise_id) as _count1 FROM campaigns_monetary");
         $row1=mysqli_fetch_array($count1);
         $counter1 = $row1["_count1"];

         $count3=mysqli_query($conn,"SELECT COUNT(id) as _count3 FROM payments");
         $row3=mysqli_fetch_array($count3);
         $counter3 = $row3["_count3"];

         $count4=mysqli_query($conn,"SELECT COUNT(donation_id) as _count4 FROM goods_donation WHERE donation_status = 'Received'");
         $row4=mysqli_fetch_array($count4);
         $counter4 = $row4["_count4"];

         $count5=mysqli_query($conn,"SELECT COUNT(request_id ) as _count5 FROM request_info WHERE request_status = 'Approved'");
         $row5=mysqli_fetch_array($count5);
         $counter5 = $row5["_count5"];

         $count2=mysqli_query($conn,"SELECT COUNT(vl_id) as _count2 FROM volunteer_info");
         $row2=mysqli_fetch_array($count2);
         $counter2 = $row2["_count2"];
      ?>
      <div class="fact">
         <div class="container-fluid">
            <div class="row counters">
               <div class="col-md-6 fact-left wow slideInLeft">
                  <div class="row">
                     <div class="col-6">
                        <div class="fact-icon">
                           <i class="flaticon-fundraise"></i>
                        </div>
                        <div class="fact-text">
                           <h2 data-toggle="counter-up"><?=$counter1;?></h2>
                           <p>Registered Fundraises Supported</p>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="fact-icon">
                           <i class="flaticon-donate"></i>
                        </div>
                        <div class="fact-text">
                           <h2 data-toggle="counter-up"><?=$counter3+$counter4;?></h2>
                           <p>Donors Making Difference</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 fact-right wow slideInRight">
                  <div class="row">
                     <div class="col-6">
                        <div class="fact-icon">
                           <i class="flaticon-beneficiary"></i>
                        </div>
                        <div class="fact-text">
                           <h2 data-toggle="counter-up"><?=$counter5;?></h2>
                           <p>Approved Requests</p>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="fact-icon">
                           <i class="flaticon-volunteer"></i>
                        </div>
                        <div class="fact-text">
                           <h2 data-toggle="counter-up"><?=$counter2;?></h2>
                           <p>Volunteer Signups</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Fact End -->

      <!-- FAQs Start -->
      <div class="faqs">
         <div class="container">
            <div class="section-header text-center">
               <p>Frequently Asked Question</p>
               <h2>You May Ask</h2>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div id="accordion-1">
                     <div class="card wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseOne">
                              What does OCARMS stands for?
                           </a>
                        </div>
                        <div id="collapseOne" class="collapse" data-parent="#accordion-1">
                           <div class="card-body">
                              OCARMS stands for "Online Calamity Assistance Requests and Monitoring System". This website is regulated by the DSWD office of Minglanilla, Cebu.
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseTwo">
                              What can we do in this website?
                           </a>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion-1">
                           <div class="card-body">
                              <ul>
                                 <li>You can either donate money and goods assistance or apply as a volunteer for the upcoming departmental activities.</li>
                                 <li>For the residents of Minglanilla, you can request assistance from the DSWD office of the municipality through this website.</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInLeft" data-wow-delay="0.3s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseThree">
                              How to donate money or cash?
                           </a>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion-1">
                           <div class="card-body">
                              For monetary donations, you can either choose a fundraise and donate any amount you want through PayPal, GCash, PayMaya, and other digital payment methods or donate directly to the DSWD office of Minglanilla. 
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInLeft" data-wow-delay="0.4s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseFour">
                              How to donate goods?
                           </a>
                        </div>
                        <div id="collapseFour" class="collapse" data-parent="#accordion-1">
                           <div class="card-body">
                              For goods donations, you can either donate through this website by providing goods details and location for pickup or just put your goods donations in the dropbox provided by the office located just inside the office building. For international donors, directly contact the DSWD office of Minglanilla. Contact information is provided on the contact page.
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInLeft" data-wow-delay="0.5s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseFive">
                              How to apply as volunteer?
                           </a>
                        </div>
                        <div id="collapseFive" class="collapse" data-parent="#accordion-1">
                           <div class="card-body">
                              All activities are displayed on the volunteer page of this website. Just choose any of the activities applicable and suitable for you, provide your personal information, and wait for the department to contact you to verify your application.  
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div id="accordion-2">
                     <div class="card wow fadeInRight" data-wow-delay="0.1s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseSix">
                              How to request assistance?
                           </a>
                        </div>
                        <div id="collapseSix" class="collapse" data-parent="#accordion-2">
                           <div class="card-body">
                              On the request page, enter your personal and request information and wait for the department to contact you to validate your request before approval.
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInRight" data-wow-delay="0.2s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseSeven">
                              What are the requirements for requesting assistance?
                           </a>
                        </div>
                        <div id="collapseSeven" class="collapse" data-parent="#accordion-2">
                           <div class="card-body">
                              You must be a bona fide resident of Minglanilla. You must also have to provide a clear scan of certificate of indigency and residency signed by your barangay captain.
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInRight" data-wow-delay="0.3s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseEight">
                              How long does my request be approved?
                           </a>
                        </div>
                        <div id="collapseEight" class="collapse" data-parent="#accordion-2">
                           <div class="card-body">
                              It depends on what day you submitted your request. Office days are Monday to Friday so expect a delay of your request during Saturdays and Sundays.
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInRight" data-wow-delay="0.4s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseNine">
                              What benefit/s can I get after donating?
                           </a>
                        </div>
                        <div id="collapseNine" class="collapse" data-parent="#accordion-2">
                           <div class="card-body">
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi.
                              Curabitur facilisis ornare velit non.
                           </div>
                        </div>
                     </div>
                     <div class="card wow fadeInRight" data-wow-delay="0.5s">
                        <div class="card-header">
                           <a class="card-link collapsed" data-toggle="collapse" href="#collapseTen">
                              What benefit/s can I get after joining an activity?
                           </a>
                        </div>
                        <div id="collapseTen" class="collapse" data-parent="#accordion-2">
                           <div class="card-body">
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi.
                              Curabitur facilisis ornare velit non.
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- FAQs End -->
      <!-- Blog Start -->
      <div class="blog" id="latest-bulletin">
         <div class="container">
            <div class="section-header text-center">
               <p>Latest Events</p>
               <h2>Latest From The Events</h2>
            </div>
            <div class="row">
                  <?php 
                     include('includes/connect.php');
                     $query1=mysqli_query($conn,"SELECT * FROM `bulletin_events` ORDER BY be_id DESC LIMIT 3");
                     while($frow=mysqli_fetch_array($query1)){
                  ?>
               <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                  <div class="blog-item">
                     <div class="blog-img">
                        <img src="includes/bulletin_events/image_view.php?be_id=<?php echo $frow["be_id"]; ?>">
                     </div>
                     <div class="blog-title">
                        <h3><?=$frow['be_title']?></h3>
                        <a class="btn" href="bulletin_events.php?bulletin_id=<?=$frow['be_id']; ?>">+</a>
                     </div>
                     <div class="blog-text">
                        <p class="text-justify text-about">
                           <?=$frow['be_about']?>
                        </p>
                     </div>
                  </div>
               </div>
               <?php } 
               ?>
            </div>
         </div>
      </div>
      <!-- Blog End -->
      <!-- Footer Start -->
      <?php include("includes/footer.php") ?>
      <!-- Footer End -->
      <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
   </div>
   <!-- JavaScript Libraries -->
   <script src="js/jquery-3.4.1.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="lib/easing/easing.min.js"></script>
   <script src="lib/wow/wow.min.js"></script>
   <script src="lib/owlcarousel/owl.carousel.min.js"></script>
   <script src="lib/isotope/isotope.pkgd.min.js"></script>
   <script src="lib/lightbox/js/lightbox.min.js"></script>
   <script src="lib/waypoints/waypoints.min.js"></script>
   <script src="lib/counterup/counterup.min.js"></script>
   <script src="lib/slick/slick.min.js"></script>
   <!-- Template Javascript -->
   <script src="js/main.js"></script>
   <script src="js/owl.carousel.min.js"></script>
   <script src="js/script.js"></script>

   <script>
      $('.dropdown-toggle').dropdown();
   </script>

</body>
</html>