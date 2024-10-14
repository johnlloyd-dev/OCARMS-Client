<?php
   session_start(); 
   ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>OCARMS - Online Calamity Assistance Requests and Monitoring System</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Construction Company Website Template" name="keywords">
        <meta content="Construction Company Website Template" name="description">

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
                                <a href="about.php" class="nav-item nav-link active">About</a>
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
            
            
            <!-- Page Header Start -->
            <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>About Us</h2>
                        </div>
                        <div class="col-12">
                            <a href="index.php">Home</a>
                            <a href="">About Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


            <!-- About Start -->
            <div class="about wow fadeInUp" data-wow-delay="0.1s">
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
    </body>
</html>
