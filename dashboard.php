<?php
   session_start(); 
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
                                <a href="index.php" class="nav-item nav-link">Home</a>
                                    <div class="nav-item dropdown">
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
                           <a class="btn" href="user_credentials_register.php">Register</a>
                        <?php } ?>
                     </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Nav Bar End -->
            

            <!-- About Start -->
            <div class="about wow fadeInUp" data-wow-delay="0.1s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-2 profile-img">
                            <img class="image" src="<?php echo $image_src; ?>" alt="">
                        </div>
                        <div class="col-lg-6 about-client">
                            <h3><?php echo $user['client_name']; ?></h3>
                            <h6><?php echo $user['client_email_address']; ?></h6>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item font-weight-bold">
                                    <a class="nav-link active items" href="#">Dashboard</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a class="nav-link items" href="my_donations.php">My Donations</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a class="nav-link items" href="my_volunteer_activities.php">My Volunteer Activities</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a class="nav-link items" href="account.php">Account</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-5 justify-content-center">
                        <div class="col-lg-12">
                        <section class="wrapper1">
                  <div class="container-fostrap">
                     <div class="content">
                        <div class="container">
                           <div class="row">
                              <div class="col-lg-6 col-md-12 col-sm-12 wow fadeInUp">
                                 <div class="card main-card">
                                    <div class="card-body">
                                       <div class="card-title">
                                          <div class="rounded bg-dark-blue p-3"> Donation to Fundraises
                                          </div>
                                       </div>
                                       <?php
                                          $donation_info = mysqli_query($conn, "SELECT SUM(donation_amount) as _sum FROM `monetary_donation_info` WHERE `client_id`='$client_id' AND donation_status = 'Donated'");
                                          $info = mysqli_fetch_assoc($donation_info);

                                          $count_fundraises = mysqli_query($conn, "SELECT COUNT(donation_id) as _count FROM `monetary_donation_info` WHERE `client_id`='$client_id' AND donation_status = 'Donated'");
                                          $fundraises = mysqli_fetch_assoc($count_fundraises);

                                          $total = $info["_sum"];
                                          $count = $fundraises["_count"];
                                       ?>
                                       <div class="container">
                                          <div class="row mb-5 mt-4 font">
                                             <div class="col-lg-9 col-md-9 col-sm-9 col-7"> 
                                                <h3 class="card-text text-left">&#8369; <?=number_format($total);?>.00</h3> 
                                                <h6 class="card-text text-left">donated to <?=$count;?> fundraises</h6>                                                                      
                                                <p class="card-text font-size text-left">Find out which causes your peso have supported.</p>
                                             </div>
                                             <div class="col-lg-2 col-md-2 col-sm-2 col-5">
                                                <i class="flaticon-donate-1"></i>
                                             </div>
                                          </div>
                                       </div>
                                          <div class="card-read-more">
                                          <a href="campaigns_monetory.php" class="btn btn-success btn-block stretched-link">
                                             Donate Today
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-12 col-sm-12 wow fadeInUp">
                                 <div class="card main-card">
                                    <div class="card-body">
                                       <div class="card-title">
                                          <div class="rounded bg-dark-blue p-3"> Hours Voluntered
                                          </div>
                                       </div>
                                       <div class="container">
                                          <div class="row mb-5 mt-4 font">
                                             <div class="col-lg-9 col-md-9 col-sm-9 col-7">
                                                 <h3 class="card-text text-left">0</h3> 
                                                 <h6 class="card-text text-left">hours across 0 event opportunities</h6>                                     
                                                <p class="card-text font-size text-left">Find out which causes you have given your time to.</p>
                                             </div>
                                             <div class="col-lg-2 col-md-2 col-sm-2 col-5 justify-content-center">
                                                <i class="flaticon-volunteer-1"></i>
                                             </div>
                                          </div>
                                       </div>
                                          <div class="card-read-more">
                                          <a href="volunteer.php" class="btn btn-success btn-block stretched-link">
                                            Volunteer Now
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
                        </div>
                    </div>
                </div>
            </div>
            <!-- About End -->

            <!-- Footer Start -->
            <?php include("includes/footer.php") ?>
            <!-- Footer End -->

            <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
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

        <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
    </body>
</html>
