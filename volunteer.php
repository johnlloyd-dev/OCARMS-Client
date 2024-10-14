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
      <link href="css/sweetalert.css" rel="stylesheet">
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
                        <a href="volunteer.php" class="nav-item nav-link active">Volunteer</a>
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
                     <h2>Our Future Activities</h2>
                  </div>
                  <div class="col-12">
                     <a href="index.php">Home</a>
                     <a href="">Our Future Activities</a>
                  </div>
               </div>
            </div>
         </div>
         <!-- Page Header End -->
         <!-- Service Start -->
         <div class="service">
            <div class="container">
               <div class="section-header text-center">
                  <p>Our Future Activities</p>
                  <h2>Apply Today</h2>
               </div>
               <section class="wrapper1">
                  <div class="container-fostrap">
                     <div class="content">
                        <div class="container">
                           <div class="row">
                           <?php
                                 include('includes/connect.php');
                                 $query=mysqli_query($conn,"SELECT * FROM `volunteer_event` ORDER BY ve_id DESC");
                                 while($row=mysqli_fetch_array($query)){
                                 $eventID = $row['ve_id'];

                                 $count=mysqli_query($conn,"SELECT COUNT(vl_id) as _count FROM volunteer_info WHERE event_id = $eventID");
                                 $frow=mysqli_fetch_array($count);
                     
                                 $total = $row['ve_target_nov'] - $frow['_count'];
                                    ?>
                              <div class="col-lg-4 col-sm-12 wow fadeInUp">
                                 <div class="card1">
                                    <div class="img-card">
                                    <img src="includes/volunteer_activities/image_view.php?ve_id=<?php echo $row["ve_id"]; ?>">
                                    </div>
                                    <div class="card-content">
                                       <div class="size">
                                          <h5 class="text-warning">
                                             <?=$total; ?> 
                                             <text class="text-white f-size2">Openings</text>
                                          </h5>
                                       </div>
                                       <div class="card-title">
                                          <div> <?=$row['ve_name']; ?>
                                          </div>
                                       </div>
                                       <p class="text-justify">
                                       <?=$row['ve_about_event']; ?>
                                       </p>
                                       <div class="left">
                                          <i class="fas text-warning fa-fw fa-lg fa-calendar-day"></i> 
                                          <text class="f-size2 text-white"><?=date('l jS \of F Y', strtotime($row['ve_date'])); ?></text>
                                       </div>
                                       <div class="left">
                                          <i class="fas text-warning fa-fw fa-lg fa-clock"></i> 
                                          <text class="f-size2 text-white"><?=date('h : i A', strtotime($row['ve_time'])); ?></text>
                                       </div>
                                       <div class="left">
                                          <i class="fas text-warning fa-fw fa-lg fa-map-marker-alt"></i> 
                                          <text class="f-size2 text-white"><?=$row['ve_location']; ?></text>
                                       </div>
                                       <div class="left">
                                          <i class="fas text-warning fa-fw fa-lg fa-users"></i> 
                                          <text class="f-size2 text-white"><?=$row['ve_suitable_volunteer']; ?></text>
                                       </div>
                                    </div>
                                    <div class="card-read-more">
                                    <form method="POST" action="learn_more_event.php">
                                       <button type="submit" name="ln" value="<?php echo $row['ve_id'];?>" class="btn btn-primary btn-block">
                                       Learn More
                                       </button>
                                       </form>
                                    </div>
                                 </div>
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

      <script src="js/sweetalert.min.js"></script>

      <?php 
            if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
        ?>
        <script>
            swal({
            title: "<?php echo $_SESSION['status']; ?>",
            text: "<?php echo $_SESSION['text']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
            button: "Done"
            });
        </script>
        <?php
            unset($_SESSION['status']);
        }
        ?>
   </body>
</html>