<?php
   require 'includes/connect.php';
   session_start(); 
   if(isset($_SESSION['login_id'])){
      header('Location: index.php');
   }



   if(isset($_GET['l']) && $_GET['l'] == 1){
      $_SESSION['link'] = "campaigns_monetory.php";
   }else if(isset($_GET['l']) && $_GET['l'] == 2){
      $_SESSION['link'] = "volunteer.php";
   }else if(isset($_GET['l']) && $_GET['l'] == 3){
      $_SESSION['link'] = "index.php";
   }else if(isset($_GET['l']) && $_GET['l'] == 4){
      $_SESSION['link'] = "campaigns_goods.php";
   }

   $link = $_SESSION['link'];
   //</------------------------------------------------/>
   //                   Google Login 
   //</------------------------------------------------/>
require 'vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

$clientId = $_ENV['CLIENT_ID'];
$clientSecret = $_ENV['CLIENT_SECRET'];
$redirectUri = $_ENV['REDIRECT_URL'];

// Enter your Client ID
$client->setClientId($clientId);
// Enter your Client Secrect
$client->setClientSecret($clientSecret);
// Enter the Redirect URL
$client->setRedirectUri($redirectUri);

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");

if(isset($_GET['code'])):
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if(!isset($token["error"])){
        $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    
        // Storing data into database
        $id = mysqli_real_escape_string($conn, $google_account_info->id);
        $full_name = mysqli_real_escape_string($conn, trim($google_account_info->name));
        $email = mysqli_real_escape_string($conn, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($conn, $google_account_info->picture);
        $f_name = mysqli_real_escape_string($conn, $google_account_info->given_name);
        $l_name = mysqli_real_escape_string($conn, $google_account_info->family_name);

        // checking user already exists or not
        $get_user = mysqli_query($conn, "SELECT `google_id` FROM `client_information` WHERE `google_id`='$id'");
        if(mysqli_num_rows($get_user) > 0){
            $_SESSION['login_id'] = $id; 
            header("Location: $link");
            exit;
        }else{
            // if user not exists we will insert the user
            $insert = mysqli_query($conn, "INSERT INTO `client_information`(`google_id`,`client_fname`,`client_lname`,`client_name`,`client_email_address`,`client_image`) VALUES('$id','$f_name','$l_name','$full_name','$email','$profile_pic')");
            if($insert){
                $_SESSION['login_id'] = $id; 
                header("Location: $link");
                exit;
            }else{
                echo "Sign up failed!(Something went wrong).";
            }
        }

    }else{
        header("Location: $link");
        exit;
    }
    
else: 
   //</------------------------------------------------/>
   //                      Main UI
   //</------------------------------------------------/>
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
      <link href="css/style.css" rel="stylesheet">
      <link href="css/user.form.css" rel="stylesheet">

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
                  <div class="ml-auto">
                     <a class="btn" href="user_credentials_register.php?l=3">Register</a>
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
                     <h2>Join our extraordinary community!</h2>
                  </div>
               </div>
            </div>
         </div>
      <!-- Page Header End -->
      <!-- Service Start -->
      <div class="service">
      <div class="container">
         <div class="col-md-6 mx-auto text-center">
            <div class="header-title">
               <h2 class="wv-heading--subtitle text-dark-blue">
                  Your information is safe with us!
               </h2>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 mx-auto">
               <div class="myform form ">
                  <form id="client_form" action="includes/client_credentials/connections.php" method="POST">
                     <div class="form-group">
                        <input type="text" name="fname" class="form-control my-input" id="fname" placeholder="First Name" required>
                     </div>
                     <div class="form-group">
                        <input type="text" name="lname" class="form-control my-input" id="lname" placeholder="Last Name" required>
                     </div>
                     <div class="form-group">
                        <input type="email" name="email" class="form-control my-input checking_user" id="email" placeholder="Email" required>
                        <small class="error_email"></small>
                     </div>
                     <div class="form-group">
                        <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" id="password" class="form-control my-input" placeholder="Password" required>
                        <div class="form-check m-2">
                           <input class="form-check-input" onclick="showPass()" type="checkbox" id="pass_check">
                           <label class="form-check-label" for="pass_check">
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
                     <div class="text-center ">
                        <button type="submit" class="btn btn-block send-button tx-tfm submit-button">Create Your Free Account</button>
                     </div>
                     <div class="col-md-12 ">
                        <div class="login-or">
                           <hr class="hr-or">
                           <span class="span-or">or</span>
                        </div>
                     </div>
                     <div class="form-group">
                        <a class="btn btn-block g-button" href="<?php echo $client->createAuthUrl(); ?>">
                           <i class="fab fa-google fa-fw"></i> Sign up with Google
                        </a>
                     </div>
                     <p class="small mt-3 text-center">By signing up, you are indicating that you have read and agree to the <a
                           href="#" class="ps-hero__content__link text-primary">Terms of Use</a> and <a href="#" class="text-primary">Privacy Policy</a>.
                     </p>

                     <p class="text-center">Already have an account? <a href="user_credentials_login.php" class="text-primary ps-hero__content__link">Login Here</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
      </div>
         <!-- Service End -->
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
      <script src="js/forms.js"></script>
      <script src="js/sweetalert.min.js"></script>

      <script>
         $(document).ready(function () {
            $('.checking_user').keyup(function (e) {
               var user = $('.checking_user').val();
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
                           $('.submit-button').attr("disabled", "disabled");
                        }else{
                           $('.error_email').removeClass("text-danger").addClass("text-success");
                           $('.checking_user').removeClass("border-danger text-danger").addClass("border-success text-black");
                           $('.submit-button').removeAttr("disabled");
                        }
                     }
                  }
               });
            });
         });
      </script>


      <script>
         var myInput = document.getElementById("password");
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
               $('.submit-button').attr("disabled", "disabled");
            }else if(capital.classList.contains('invalid')){
               $('.submit-button').attr("disabled", "disabled");
            }else if(number.classList.contains('invalid')){
               $('.submit-button').attr("disabled", "disabled");
            }else if(length.classList.contains('invalid')){
               $('.submit-button').attr("disabled", "disabled");
            }else{
               $('.submit-button').removeAttr("disabled");
            }
         }

         function showPass() {
            var pass = document.getElementById("password");
            if (pass.type === "password") {
               pass.type = "text";
            } else {
               pass.type = "password";
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



<?php endif; ?>