<?php 
   session_start(); 
   if(isset($_POST['ln'])){
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
        <link href="css/divider.css?v=<?php echo date('s'); ?>" rel="stylesheet">
        <link href="css/ln.css?v=<?php echo date('s'); ?>" rel="stylesheet">
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
                           <a class="btn" href="user_credentials_register.php?l=3">Register</a>
                        <?php } ?>
                     </div>
               </div>
            </nav>
         </div>
      </div>
            <!-- Nav Bar End -->
            <?php
               include('includes/connect.php');
               $ln = $_POST['ln'];
               $query=mysqli_query($conn,"SELECT * FROM volunteer_event WHERE ve_id =$ln");
               $row=mysqli_fetch_array($query);
               $count=mysqli_query($conn,"SELECT COUNT(vl_id) as _count FROM volunteer_info WHERE event_id = $ln");
               $frow=mysqli_fetch_array($count);

               $total = $row['ve_target_nov'] - $frow['_count'];
            ?>
            <!--main content-->
	<div class="main-content wow fadeInUp" data-wow-delay="0.1s">
		<div class="container">
			<div class="row">
				<div class="content col-md-8 col-sm-12 col-xs-12">
					<div class="section-block bg-dark-blue">
						<div class="funding-meta">
							<h1><?php echo $row['ve_name'];?></h1>
							
							<div class="video-frame mb-3">
								<img class="rounded" src="includes/volunteer_activities/image_view.php?ve_id=<?php echo $row["ve_id"]; ?>" width="500" height="281">
							</div>
                     <span>
                        <h5 class="text-orange"> <strong><?=$total; ?></strong> <span class="text-white">Openings out of</span> <strong><?=$row['ve_target_nov']; ?></strong></h5>
                     </span>
						</div>
					</div>
					<!--/tabs-->
					<!--tab panes-->
					<div class="section-block wow fadeInUp" data-wow-delay="0.1s">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="about">
								<div class="about-information">
									<h1 class="section-title text-orange">About Event</h1>
									<p class="text-white text-justify"><?php echo nl2br($row['ve_about_event']);?></p>
								</div>
							</div>
						</div>
					</div>

               <div class="section-block wow fadeInUp" data-wow-delay="0.1s">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="about">
								<div class="about-information">
									<h1 class="section-title text-orange">Volunteer Positions</h1>
									<div class="text-white">
                              <h6 class="text-orange"> Suitable for:
                                 <i class="text-white">
                                    <?php echo $row['ve_suitable_volunteer'];?>
                                 </i> 
                              </h6>
                              <h6 class="text-orange"> Skills required:
                                 <i class="text-white">
                                    <?php echo $row['ve_skills_required'];?>
                                 </i> 
                              </h6>
                              <p class="text-justify"><?php echo nl2br($row['ve_vol_pos']);?></p>
                           </div>
								</div>
							</div>
						</div>
					</div>

               <div class="section-block wow fadeInUp" data-wow-delay="0.1s">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="about">
								<div class="about-information">
									<h1 class="section-title text-orange">Point To Note</h1>
									<p class="text-white text-justify"><?php echo nl2br($row['ve_pnt_to_note']);?></p>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!--/tabs-->

				<!--/main content-->
				<!--sidebar-->
				<div class="content col-md-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.1s">
					<div class="section-block summary">
						<div class="profile-contents">
							<h4 class="position text-orange"><?php echo $row['ve_name'];?></h4>
						</div>
                  <div class="border border-bottom rounded"></div> 
                  <div class="event mt-4">
                     <div class="row mb-4">
                        <div class="col">
                           <i class="fas text-warning fa-fw fa-lg fa-calendar-day"></i> 
                           <text class="f-size2 text-white"><?=date('l jS \of F Y', strtotime($row['ve_date'])); ?></text>
                        </div>
                     </div>
                     <div class="row mb-4">
                     <div class="col">
                        <i class="fas text-warning fa-fw fa-lg fa-clock"></i> 
                        <text class="f-size2 text-white"><?=date('h:i A', strtotime($row['ve_time'])); ?></text>
                     </div>
                     </div>
                     <div class="row mb-4">
                     <div class="col">
                        <i class="fas text-warning fa-fw fa-lg fa-map-marker-alt"></i> 
                        <text class="f-size2 text-white"><?=$row['ve_location']; ?></text>
                        </div>
                     </div>
                     <div class="row mb-4">
                     <div class="col">
                        <i class="fas text-warning fa-fw fa-lg fa-users"></i> 
                        <text class="f-size2 text-white"><?=$row['ve_suitable_volunteer']; ?></text>
                        </div>
                     </div>
                     <div class="text-center">
                        <div class="row">
                           <div class="col">
                              <span class="text-orange">Sign up before <?=date('l jS \of F Y', strtotime($row['ve_date'])); ?>, <?=date('h:i A', strtotime($row['ve_time'])); ?></span>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col">
                              <?php
                                 if(isset($_SESSION['login_id'])){
                                    $event_id = $row['ve_id'];
                                    echo "<a href='#volunteer$event_id' data-toggle='modal' class='btn btn-primary text-white mt-3'><i class='fas fa-hands-helping'></i> Volunteer Now</a>";
                                 }else{
                                    echo "<a href='user_credentials_register.php?l=2' class='btn btn-primary text-white mt-3'><i class='fas fa-hands-helping'></i> Volunteer Now</a>";
                                 }
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
					</div>
               <div class="section-block wow fadeInUp" data-wow-delay="0.1s">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="about">
								<div class="about-information">
									<h1 class="section-title text-orange">Contact Us</h1>
                              <p class="text-white"><i class="fa text-orange fa-map-marker-alt"></i> Minglanilla, Cebu</p>
                              <p class="text-white"><i class="fa text-orange fa-phone-alt"></i> +639 3455 67890</p>
                              <p class="text-white"><i class="fa text-orange fa-envelope"></i> dswdmingla@gmail.com</p>
								</div>
							</div>
						</div>
					</div>
				</div>
            <?php include("includes/volunteer_modal.php"); ?>
				<!--/sidebar-->
			</div>
         <div class="row">
            <div class="col-lg-12">
            <div class="section-block wow fadeInUp" data-wow-delay="0.1s">
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="about">
								<div class="about-information">
									<h1 class="section-title text-orange">Volunteers</h1>
                           <h6 class="text-white"><strong>46</strong> Confirmed | <strong>10</strong> Pending</h6>
                           <hr>
                           <ul class="profile-info-list">
                              <li class="img-list">
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on vcx"><img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" /></a>
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" /></a>
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="" /></a>
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="" /></a>
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" /></a>
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="" /></a>
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="" /></a>
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" /></a>
                                    <a class="m-b-5" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom"><img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" /></a>
                              </li>
                           </ul>
								</div>
							</div>
						</div>
					</div>
            </div>
         </div>
		</div>
	</div>


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

   <?php 
      }else{
         header('location: campaigns_monetory.php');
         exit();
      }
   ?>