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

        <link href="css/sweetalert.css" rel="stylesheet">

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
                                    <a class="nav-link items" aria-current="page" href="dashboard.php">Dashboard</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a class="nav-link items" href="my_donations.php">My Donations</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a class="nav-link items" href="my_volunteer_activities.php">My Volunteer Activities</a>
                                </li>
                                <li class="nav-item font-weight-bold">
                                    <a class="nav-link active items" href="account.php">Account</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-5 justify-content-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" id="pp_form" action="includes/client_credentials/connections.php" enctype="multipart/form-data">
                                        <h5 class="card-title text-center">Profile Picture</h5>
                                        <div class="form-group">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8">
                                                    <label for="profile_picture">Profile Picture:</label>
                                                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="readURL(this);">
                                                    <small class="text-dark">Please select an image to enable save button.</small>
                                                </div>
                                                <div class="col-lg-4 mt-2">
                                                    <img id="imagePreview" style="object-fit: cover;" src="<?php echo $image_src; ?>" width="120rem" height="110rem"required/>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" disabled id="client_id_pp" name="client_id_pp" value="<?=$user['client_id']?>" class="btn btn-warning btn-sm submit-btn">
                                            <i class="fas fa-edit">
                                            </i> Save
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5 justify-content-center">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="includes/client_credentials/connections.php" enctype="multipart/form-data">
                                        <h5 class="card-title text-center">Personal Information</h5>

                                        <div class="form-group">
                                            <label for="first_name">First Name:</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?=$user['client_fname']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name:</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?=$user['client_lname']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Birthdate:</label>
                                            <input type="date" class="form-control" name="date" id="date" value="<?=$user['client_birth_date']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender-1">Gender:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="gender-1" value="Male" <?php if($user['client_gender'] == "Male"){echo "checked";} ?> >
                                                <label class="form-check-label" for="gender-1">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="gender-2" value="Female" <?php if($user['client_gender'] == "Female"){echo "checked";} ?>>
                                                <label class="form-check-label" for="gender-2">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <h5 class="card-title text-center">Contact Details</h5>
                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?=$user['client_address']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number:</label>
                                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?=$user['client_contact_number']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address:</label>
                                            <input type="email" class="form-control" <?php if($user['client_password'] == ""){echo "readonly";} ?> id="email" name="email" value="<?=$user['client_email_address']; ?>" required>
                                            <small class="error_email"></small>
                                        </div>
                                        
                                        <?php
                                            if($user['client_password'] != ""){
                                        ?>
                                        <hr>
                                        <h5 class="card-title text-center">Change Password (Optional)</h5>
                                        <div class="form-group">
                                            <label for="current_password">Current Password:</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password"> 
                                            <small class="inco_pass"></small>
                                            <div class="form-check m-2">
                                                <input class="form-check-input" onclick="showPass()" type="checkbox" id="pass_check">
                                                <label class="form-check-label" for="pass_check">
                                                    Show Password
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password_1">New Password:</label>
                                            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" id="new_password_1" name="new_password_1">
                                            <div class="form-check m-2">
                                                <input class="form-check-input" onclick="showPass1()" type="checkbox" id="pass_check1">
                                                <label class="form-check-label" for="pass_check1">
                                                    Show Password
                                                </label>
                                            </div>
                                        </div>
                                        <div id="message-1">
                                            <h6>Password must contain the following:</h6>
                                            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                            <p id="number" class="invalid">A <b>number</b></p>
                                            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password_2">Confirm Password:</label>
                                            <input type="password" class="form-control" id="new_password_2" name="new_password_2">
                                            <small class="pass_not_match"></small>
                                        </div>
                                        <?php } else {
                                            echo "";
                                         }?> 
                                        <button type="submit" name="client_id_pi" value="<?=$user['client_id']?>" class="btn btn-warning btn-sm submit-btn">
                                            <i class="fas fa-edit">
                                            </i> Save
                                        </button>
                                    </form>
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

            $(document).ready(function () {
             $('#new_password_2').keyup(function (e) {
                 var second_pass = $('#new_password_2').val();
                 var first_pass = $('#new_password_1').val();
                 $.ajax({
                     type: "POST",
                     url: "includes/password_validate.php",
                     data: {
                         "first_pass": first_pass,
                         "second_pass": second_pass,
                     },
                     success: function (response) {
                        var dataResult = JSON.parse(response);
                        if(dataResult.statusCode==201){
                            $('.pass_not_match').text("Password not match!").addClass("text-danger");
                            $('#new_password_2').addClass("border-danger");
                            $('.submit-btn').attr("disabled", "disabled");
                        }else if(dataResult.statusCode==200){
                            $('.pass_not_match').text("Password match!").removeClass("text-danger").addClass("text-success");
                            $('#new_password_2').removeClass("border-danger").addClass("border-success");
                            if($('.pass_not_match').text() == "Password match!" && $('.inco_pass').text() == "Password Correct!"){
                                $('.submit-btn').removeAttr("disabled");
                            }
                        }
                        if(second_pass==""){
                            $('.pass_not_match').text("Please enter password!").removeClass("text-success").addClass("text-danger");
                            $('#new_password_2').removeClass("border-success").addClass("border-danger");
                            $('.submit-btn').attr("disabled", "disabled");
                        }
                    }
                 });
             });

             $('#current_password').keyup(function (e) {
                 var current_pass = $('#current_password').val();
                 var email = $('#email').val();
                 $.ajax({
                     type: "POST",
                     url: "includes/update_password.php",
                     data: {
                         "email": email,
                         "current_pass": current_pass,
                     },
                     success: function (response) {
                        var dataResult = JSON.parse(response);
                        if(dataResult.statusCode==201){
                            $('.inco_pass').text("Incorrect Password!").addClass("text-danger");
                            $('#current_password').addClass("border-danger");
                            $('.submit-btn').attr("disabled", "disabled");
                        }else if(dataResult.statusCode==200){
                            $('.inco_pass').text("Password Correct!").removeClass("text-danger").addClass("text-success");
                            $('#current_password').removeClass("border-danger").addClass("border-success");
                            if($('.pass_not_match').text() == "Password match!" && $('.inco_pass').text() == "Password Correct!"){
                                $('.submit-btn').removeAttr("disabled");
                            }
                        }
                        if(current_pass==""){
                            $('.inco_pass').text("Please enter password!").removeClass("text-success").addClass("text-danger");
                            $('#current_password').removeClass("border-success").addClass("border-danger");
                            $('.submit-btn').attr("disabled", "disabled");
                        }
                    }
                 });
             });

             
             $('#email').keyup(function (e) {
               var user = $('#email').val();
               $.ajax({
                  type: "POST",
                  url: "includes/email_validate.php",
                  data: {
                     "user_gmail": user,
                  },
                  success: function (response) {
                     if(user==""){
                        $('.error_email').text("This field is empty!").addClass("text-danger");
                        $('.checking_user').addClass("border-danger");
                     }else{
                        $('.error_email').text(response).removeClass("text-danger").addClass("text-black");
                        if(response!= "Email Address is Available!"){
                           $('.error_email').removeClass("text-black").addClass("text-danger");
                           $('.checking_user').addClass("border-danger text-danger");
                           $('.submit-btn').attr("disabled", "disabled");
                        }else{
                           $('.error_email').removeClass("text-danger").addClass("text-success");
                           $('.checking_user').removeClass("border-danger text-danger").addClass("border-success text-black");
                           $('.submit-btn').removeAttr("disabled");
                        }
                     }
                  }
               });
            });
             
            $('#profile_picture').change(function (e) {
                $('#client_id_pp').removeAttr("disabled");
            });

         });

         var myInput = document.getElementById("new_password_1");
         var letter = document.getElementById("letter");
         var capital = document.getElementById("capital");
         var number = document.getElementById("number");
         var length = document.getElementById("length");

         // When the user clicks on the password field, show the message box
         myInput.onfocus = function() {
            document.getElementById("message-1").style.display = "block";
         }

         // When the user clicks outside of the password field, hide the message box
         myInput.onblur = function() {
            document.getElementById("message-1").style.display = "none";
         }

         // When the user starts to type something inside the password field
         myInput.onkeyup = function() {
            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if(myInput.value.match(lowerCaseLetters)) {  
               letter.classList.remove("invalid");
               letter.classList.add("valid");
            } else {
               letter.classList.remove("valid");
               letter.classList.add("invalid");
            }
            
            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if(myInput.value.match(upperCaseLetters)) {  
               capital.classList.remove("invalid");
               capital.classList.add("valid");
            } else {
               capital.classList.remove("valid");
               capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if(myInput.value.match(numbers)) {  
               number.classList.remove("invalid");
               number.classList.add("valid");
            } else {
               number.classList.remove("valid");
               number.classList.add("invalid");
            }
            
            // Validate length
            if(myInput.value.length >= 8) {
               length.classList.remove("invalid");
               length.classList.add("valid");
            } else {
               length.classList.remove("valid");
               length.classList.add("invalid");
            }

            if(letter.classList.contains('invalid')){
               $('.submit-btn').attr("disabled", "disabled");
            }else if(capital.classList.contains('invalid')){
               $('.submit-btn').attr("disabled", "disabled");
            }else if(number.classList.contains('invalid')){
               $('.submit-btn').attr("disabled", "disabled");
            }else if(length.classList.contains('invalid')){
               $('.submit-btn').attr("disabled", "disabled");
            }else{
               $('.submit-btn').removeAttr("disabled");
            }
         }


         function showPass() {
            var pass = document.getElementById("current_password");
            if (pass.type === "password") {
               pass.type = "text";
            } else {
               pass.type = "password";
            }
         }

         function showPass1() {
            var pass1 = document.getElementById("new_password_1");
            if (pass1.type === "password") {
                pass1.type = "text";
            } else {
                pass1.type = "password";
            }
            
         }
        </script>

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
