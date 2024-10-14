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
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
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
                                <a href="about.php" class="nav-item nav-link">About</a>
                            </div>
                            <div class="navbar-nav ml-auto">
                        <?php
                           require 'includes/connect.php';
                           if(isset($_SESSION['login_id']) || isset($_GET['login_id'])){
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
                            <h2>Event Page</h2>
                        </div>
                        <div class="col-12">
                            <a href="">Home</a>
                            <a href="">Event Page</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->

            <?php 
               if (isset($_GET['bulletin_id'])){
                  
                  $bulletin_id=$_GET['bulletin_id'];

               }elseif(isset($_SESSION['bulletin_id'])){

                  $bulletin_id=$_SESSION['bulletin_id']; 

               }
               
               include('includes/connect.php');
               $query=mysqli_query($conn,"SELECT * FROM `bulletin_events` WHERE be_id = $bulletin_id");
               $row=mysqli_fetch_array($query);
            ?>
            <!-- Single Post Start-->
            <div class="single">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="single-content wow fadeInUp">
                            <img src="includes/bulletin_events/image_view.php?be_id=<?php echo $row["be_id"]; ?>">
                                <h2><?=$row['be_title']?></h2>
                                <p><i><?=date("jS F, Y", strtotime($row['be_date']));?> - <?=date('h:i A', strtotime($row['be_time']));?></i></p>
                                <p class="text-justify">
                                    <?=$row['be_about']?>.
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="sidebar">
                                <!-- <div class="sidebar-widget wow fadeInUp">
                                    <div class="search-widget">
                                        <form>
                                            <input class="form-control" type="text" placeholder="Search Keyword">
                                            <button class="btn"><i class="fa fa-search"></i></button>
                                        </form>
                                    </div>
                                </div> -->

                                <div class="sidebar-widget wow fadeInUp">
                                    <h2 class="widget-title">Recent Post</h2>
                                    <div class="recent-post">
                                    <?php 
                                        include('includes/connect.php');
                                        $query=mysqli_query($conn,"SELECT * FROM `bulletin_events` ORDER BY be_id DESC LIMIT 5");
                                        while($row=mysqli_fetch_array($query)){
                                    ?>
                                        <div class="post-item">
                                            <div class="post-img">
                                            <img src="includes/bulletin_events/image_view.php?be_id=<?php echo $row["be_id"]; ?>">
                                            </div>
                                            <div class="post-text">
                                                <a href="bulletin_events.php?bulletin_id=<?=$row['be_id']; ?>"><?=$row['be_title']; ?></a>
                                            </div>
                                        </div>
                                        <?php } 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Post End-->   


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
