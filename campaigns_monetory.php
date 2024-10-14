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
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
      <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
      <link href="lib/animate/animate.min.css" rel="stylesheet">
      <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
      <link href="lib/slick/slick.css" rel="stylesheet">
      <link href="lib/slick/slick-theme.css" rel="stylesheet">
      <!-- Template Stylesheet -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
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
                           <a href="#" class="nav-link active dropdown-toggle" data-toggle="dropdown">Campaigns</a>
                           <div class="dropdown-menu rounded">
                              <a href="campaigns_monetory.php?login_id=<?php echo $_SESSION['login_id']; ?>" class="dropdown-item active">
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
         <!-- Page Header Start -->
         <div class="page-header">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <h2>Our Fundraises</h2>
                  </div>
                  <div class="col-12">
                     <a href="index.php">Home</a>
                     <a href="">Our Fundraises</a>
                  </div>
               </div>
            </div>
         </div>
         <!-- Page Header End -->
         <!-- Service Start -->
         <div class="service">
            <div class="container">
               <div class="section-header text-center">
                  <p>Our Fundraises</p>
                  <h2>Donate Today</h2>
               </div>
               <section class="wrapper1">
                  <div class="container-fostrap">
                     <div class="content">
                        <div class="container">
                           <div class="row">

                              <?php
                                 include('includes/connect.php');
                                 $query=mysqli_query($conn,"SELECT * FROM `campaigns_monetary`");
                                 while($row=mysqli_fetch_array($query)){

                                 $id = $row['fundraise_id'];
                                 $reg_date = $row['register_date'];
                                 $td = $row['fundraise_target_days'];
                                 $main = $row['fundraise_target_amount'];
                                 $donation_type = "Fundraise Donation";
                                 $amount=mysqli_query($conn,"SELECT SUM(donation_amount) as _sum FROM monetary_donation_info WHERE fundraise_id = $id AND donation_type = 'Fundraise Donation' AND donation_status = 'Donated'");
                                 $count=mysqli_query($conn,"SELECT COUNT(donation_amount) as _count FROM monetary_donation_info WHERE fundraise_id = $id AND donation_type = 'Fundraise Donation' AND donation_status = 'Donated'");
                                 $date=mysqli_query($conn,"SELECT DATE_ADD(register_date, INTERVAL $td DAY) as _date FROM campaigns_monetary WHERE fundraise_id = $id");
                                 $erow=mysqli_fetch_array($amount);
                                 $frow=mysqli_fetch_array($count);
                                 $drow=mysqli_fetch_array($date);

                                 $advance_date = $drow["_date"];

                                 $tg_date = mysqli_query($conn,"SELECT DATEDIFF('$advance_date', CURDATE()) as _mdate");
                                 $brow=mysqli_fetch_array($tg_date);

                                 $main_date = $brow["_mdate"];

                                 if($frow["_count"]>0){
                                    $total = $erow["_sum"];
                                    $counter = $frow["_count"];
                                    $percentage = ($total * 100) / $main;
                                 }else{
                                    $total = 0;
                                    $counter = 0;
                                    $percentage = 0;
                                 }

                              ?>
                              
                              <div class="col-xs-12 col-sm-12 col-md-4 wow fadeInUp">
                                 <div class="card1">
                                    <div class="img-card">
                                    <img src="includes/monetary_campaign/image_view.php?fundraise_id=<?php echo $row["fundraise_id"]; ?>">
                                    </div>
                                    <div class="size">
                                       <h3 class="span f-size">&#8369; <?php echo number_format($total);?>.00</h3>
                                       <p>raised from <?php echo $counter;?> donors</p>
                                       <div class="progress" style="margin-left:10px; margin-right:10px">
                                          <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated text-dark-blue" role="progressbar"
                                           style="width: <?php echo number_format($percentage); ?>%" aria-valuenow="<?php echo number_format($percentage); ?>"
                                            aria-valuemin="0" aria-valuemax="100"><?php echo number_format($percentage); ?>%</div>
                                       </div>
                                       <div class="row span">
                                          <div class="col"><?php echo number_format($percentage); ?>% of &#8369; <?php echo number_format($row['fundraise_target_amount']);?>.00</div>
                                          <div class="col amount-days"><?php echo $main_date; ?> more days</div>
                                       </div>
                                    </div>
                                    <div class="card-content">
                                       <div class="card-title">
                                          <div><?php echo $row['fundraise_title'];?>
                                          </div>
                                       </div>
                                       <p class="text-justify">
                                          <?php echo $row['fundraise_description'];?>
                                       </p>
                                    </div>
                                    <div class="card-read-more">
                                       <a href="#addnew<?php echo $row['fundraise_id'];?>" id="modal-1" data-toggle="modal" class="btn btn-success btn-block">
                                          Donate Today
                                       </a>
                                    </div>
                                    <div class="card-read-more">
                                    <form method="POST" action="learn_more_fundraise.php">
                                       <button type="submit" name="ln" value="<?php echo $row['fundraise_id'];?>" class="btn btn-primary btn-block">
                                       Learn More
                                       </button>
                                       </form>
                                    </div>
                                 </div>
                                 <?php include("includes/donate_modal.php"); ?>
                              <?php include("includes/cart_exist_modal.php"); ?>
                              </div>
                              <?php } 
                              ?> 
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
         </div>
         <!-- Service End -->
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

   </body>
</html>