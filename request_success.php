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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

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
                                <a class="nav-link-2 dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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

                                    <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>"
                                        alt="<?php echo $user['client_name']; ?>">
                                </a>
                                <div class="dropdown-menu drop rounded dropdown-menu-right"
                                    aria-labelledby="userDropdown">
                                    <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>"
                                        alt="<?php echo $user['client_name']; ?>">
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
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                    <div class="border mt-3 rounded">
                    <?php 
                        require 'includes/connect.php';
                        if (isset($_SESSION['request_id'])) {
                            $request_id = $_SESSION['request_id'];
                        }

                            $get_req_info = mysqli_query($conn, "SELECT * FROM `request_info` WHERE `request_id`='$request_id'");
                            $info = mysqli_fetch_assoc($get_req_info);
                    ?>
                    <div class="p-5 mb-2 bg-warning rounded-top text-dark-blue text-center drop bg-white">
                        <h3 class="font-weight-bold">Hello, <?php echo $info['requester_name'];?></h3>
                        <p>Your request is now pending and will undergo department's approval. Please be patient.</p>
                        <a href="#ptn" class="btn btn-outline-primary"><i class="fas fa-arrow-alt-down"></i>See Points To Note Below</a>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12">
                            <div class="pl-4 pr-4">
                                <div class="card">
                                    <div class="card-header bg-dark-orange text-dark-blue">
                                        REQUEST INFO
                                    </div>
                                    <div class="card-body text-dark-blue">
                                        <h6 class="text-dark-blue">Your Name</h6>
                                        <p class="text-success"><?=$info['requester_name'];?></p>
                                        <h6 class="text-dark-blue">Request Date</h6>
                                        <p class="text-success"><?=$info['request_date'];?></p>
                                        <h6 class="text-dark-blue">Contact Number</h6>
                                        <p class="text-success"><?=$info['requester_contactnumber'];?></p>
                                        <h6 class="text-dark-blue">Your Barangay</h6>
                                        <p class="text-success"><?=$info['requester_barangay'];?></p>
                                        <h6 class="text-dark-blue">Status</h6>
                                        <p class="text-danger"><?=$info['request_status'];?></p>
                                        <h6 class="text-dark-blue">Your Request</h6>
                                        <p class="text-success"><?=$info['request_name'];?></p>
                                        <h6 class="text-dark-blue">Description of your request</h6>
                                        <p class="text-success text-justify"><?=$info['request_description'];?></p>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>


                        <div class="col-lg-12" id="ptn">
                            <div class="pl-4 pr-4">
                                <div class="card">
                                    <div class="card-header bg-dark-orange text-dark-blue">
                                        POINTS TO NOTE
                                    </div>
                                    <div class="card-body text-dark-blue">
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <p class="text-danger">Your request is now pending and will undergo further verification and validation before approval in accordance to the rules and guidelines followed by the department.</p>
                                                <p class="text-danger">Any moment from now, an email notification and text message will be sent to you with regards on other necessary documents need to be submitted to the office.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <div class="col-lg-12">
                            <div class="pl-4 pr-4">
                                <div class="card">
                                    <div class="card-body text-dark-blue">
                                        <h6 class="text-dark-blue">PRINT YOUR REQUEST INFO</h6>
                                        <button href="#" class="btn btn-warning" disabled> 
                                            <i class="fas fa-print"></i>  Print
                                       </button>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>

                        <div class="col-lg-12">
                            <div class="pl-4 pr-4">
                                <div class="card">
                                    <div class="card-header bg-dark-orange text-dark-blue">
                                        CONTACT INFO
                                    </div>
                                    <div class="card-body text-dark-blue">
                                        <p><i class="fa fa-fw text-orange fa-map-marker-alt"></i> Minglanilla, Cebu</p>
                                        <p><i class="fa fa-fw text-orange fa-phone-alt"></i> +639 3455 67890</p>
                                        <p><i class="fa fa-fw text-orange fa-envelope"></i> dswdmingla@gmail.com</p>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="pl-4 pr-4">
                                <div class="card">
                                    <div class="card-header bg-dark-orange text-dark-blue">
                                        <h6>TELL YOUR FRIENDS AND FAMILY</h6>
                                        <h6 class="f-size">MAKE GIVING A PART OF WHO WE ARE</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="footer-1">
                                            <div class="footer-contact">
                                                <div class="footer-social">
                                                    <a href=""><i class="fab fa-twitter"></i></a>
                                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                                    <a href=""><i class="fab fa-youtube"></i></a>
                                                    <a href=""><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="js/sweetalert.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

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
