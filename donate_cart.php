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
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet">

   <!-- CSS Libraries -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
   <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
   <link href="lib/animate/animate.min.css" rel="stylesheet">
   <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
   <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
   <link href="lib/slick/slick.css" rel="stylesheet">
   <link href="lib/slick/slick-theme.css" rel="stylesheet">

   <link href="css/sweetalert.css" rel="stylesheet">

   <!-- Template Stylesheet -->
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/style.css?v=<?php echo date('s'); ?>" rel="stylesheet">
   <link href="css/custom.css?v=<?php echo date('s'); ?>" rel="stylesheet">
   <link rel="stylesheet" href="fonts/icomoon/style.css">
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
                           $total_2 = $row_amount["_sum"];
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
                        <div class="dropdown-menu drop rounded dropdown-menu-right" aria-labelledby="userDropdown">
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

      <!--main content-->
      <form action="paypal_payment/request.php" method="POST">
      <div class="main-content wow fadeInUp" data-wow-delay="0.1s">
         <div class="container">
            <div class="row justify-content-center mb-3 mt-5">
               <div class="col-lg-4 drop">
                  <h5 class="text-center">Here's what is your</h5>
                  <h4 class="text-center">Giving Cart</h4>
                  <img class="img-profile rounded-circle" src="<?php echo $image_src; ?>" alt="<?php echo $user['client_name']; ?>">
               </div>
            </div>
            <h5 class="text-dark-blue amount"></h5>
            <p class="text-success font-italic" id="clicked_total"></p>
            <div class="table-responsive">
               <table class="table custom-table">
                  <thead>
                     <tr>
                        <!-- <th scope="col" class="d-none"><input type="hidden" name="" value=""></th> -->
                        <th scope="col">
                           <label class="control control--checkbox">
                              <input type="checkbox" class="js-check-all" checked/>
                              <div class="control__indicator"></div>
                           </label>
                        </th>
                        <th scope="col">Amount</th>
                        <th scope="col">Fundraise Name</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
               <?php
                  include('includes/connect.php');
                  $query=mysqli_query($conn,"SELECT * FROM `monetary_donation_info` WHERE client_id = $client_id AND donation_status = 'Carted'");
                  while($row=mysqli_fetch_array($query)){
                  $f_id = $row['fundraise_id'];
                  $donation_id = $row['donation_id'];
                  $_SESSION['fundraise_id'] = $f_id;
                  $_SESSION['client_id'] = $client_id;

                  $fundraise_query=mysqli_query($conn,"SELECT * FROM `campaigns_monetary` WHERE fundraise_id = $f_id");
                  $fund=mysqli_fetch_array($fundraise_query);
               ?>
                  <tr>
                     <th scope="row">
                        <label class="control control--checkbox">
                           <input type="checkbox" name="payment" id="<?=$row['donation_id'];?>" value="<?=$row['donation_amount'];?>" checked/>
                           <div class="control__indicator"></div>
                        </label>
                     </th>
                     <td><?=$row['donation_amount']; ?></td>
                     <td><?=$fund['fundraise_title']; ?></td>
                     <td>
                        <button id="del" class="btn btn warning btn-sm">
                           <i class="fas fa-trash-alt fa-fw"></i>
                        </button>
                     </td>
                  </tr> 
                  <?php } 
                  ?> 
            </tbody>
        </table>
      </div>
      <input type="hidden" name="total_amount" id="total_amount">
      <input type="hidden" name="donation_id[]" id="donation_id">
      <input type="hidden" name="item_number" value="<?=$donation_id; ?>" id="item_number">
      <input type="hidden" name="fundraise_name" value="<?=$fund['fundraise_title']; ?>" id="fundraise_name">
            <div class="row mt-5">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="text-center p-4">I'd like to pay by</h5>
                        <div class="row">
                           <div class="col-lg-4 col-md-12 col-sm-12 wow fadeInUp">
                              <div class="card main-card">
                                 <div class="card-body">
                                    <div class="card-title">
                                       <div class="rounded bg-dark-blue p-3"> GCash
                                       </div>
                                    </div>
                                    <div class="container">
                                       <div class="row mb-5 pt-4 font">
                                          <div class="col-lg-9 col-md-9 col-sm-9 col-9">                                    
                                             <p class="card-text font-size text-left">Donate money through your GCash E-Wallet.</p>
                                          </div>
                                          <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                             <img class="payment-gateway-logo" src="img/GCash-Logo.png">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-check text-center">
                                       <div class="radiobtn">
                                          <input type="radio" id="GCash" name="payment_method" value="GCash" disabled/>
                                          <label for="GCash">GCash</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-12 col-sm-12 wow fadeInUp">
                              <div class="card main-card">
                                 <div class="card-body">
                                    <div class="card-title">
                                       <div class="rounded bg-dark-blue p-3"> PayPal
                                       </div>
                                    </div>
                                    <div class="container">
                                       <div class="row mb-5 pt-4 font">
                                          <div class="col-lg-9 col-md-9 col-sm-9 col-9">                                    
                                             <p class="card-text font-size text-left">Donate money through your PayPal account.</p>
                                          </div>
                                          <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                             <img class="payment-gateway-logo" src="img/PayPal-Logo.png">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-check text-center">
                                       <div class="radiobtn">
                                          <input type="radio" id="PayPal" name="payment_method" value="PayPal" checked/>
                                          <label for="PayPal">PayPal</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-12 col-sm-12 wow fadeInUp">
                              <div class="card">
                                 <div class="card-body">
                                    <div class="card-title">
                                       <div class="rounded bg-dark-blue p-3"> Paymaya
                                       </div>
                                    </div>
                                    <div class="container">
                                       <div class="row mb-5 pt-4 font">
                                          <div class="col-lg-9 col-md-9 col-sm-9 col-9">                                    
                                             <p class="card-text font-size text-left">Donate money through your Paymaya account.</p>
                                          </div>
                                          <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                             <img class="payment-gateway-logo" src="img/Paymaya-Logo.png">
                                          </div>
                                       </div>
                                    </div>                                  
                                    <div class="form-check text-center">
                                       <div class="radiobtn">
                                          <input type="radio" id="Paymaya" name="payment_method" value="Paymaya" disabled />
                                          <label for="Paymaya">Paymaya</label>
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

            <div class="row mt-5 justify-content-center">
               <div class="col-lg-8">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="text-center m-2">Make this an anonymous donation?</h5>
                        <div class="row justify-content-center">
                           <div class="col-lg-6 check-box">
                              <input id="chck" class="input-radio" type="checkbox">
                              <label for="chck" class="check-trail">
                                 <span class="check-handler"></span>
                              </label>
                              <h6 class="text-center">Click above button to select.</h6>
                           </div>
                        </div>
                        <div class="row justify-content-center">
                           <div id="cloned" class="col-lg-10">
                              <div id="content">
                                 <div class="form-group mt-4">
                                    <label for="fname">First Name:</label>
                                    <input type="text" class="form-control" id="fname" name="account_fname" value="<?=$user['client_fname'];?>" required>
                                 </div>
                                 <div class="form-group mt-4">
                                    <label for="lname">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" name="account_lname" value="<?=$user['client_lname'];?>" required>
                                 </div>
                                 <i class="f-size text-danger">Note: Any changes done with your name above will also change your account name.</i>
                                 <hr>
                                 <div class="form-group">
                                    <label for="contact_number">Contact Number:</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?=$user['client_contact_number'];?>" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="name">Contact Email:</label>
                                    <input type="email" class="form-control" id="email" value="<?=$user['client_email_address'];?>" readonly required>
                                 </div>
                                 <div class="form-group">
                                    <label for="gender1">Gender:</label>
                                    <div class="form-check">
                                       <input class="form-check-input" type="radio" name="gender" id="gender1" value="Male" <?php if($user['client_gender'] == "Male"){echo "checked";} ?> required/>
                                       <label class="form-check-label" for="gender1">
                                             Male
                                       </label>
                                    </div>
                                    <div class="form-check">
                                       <input class="form-check-input" type="radio" name="gender" id="gender2" value="Female" <?php if($user['client_gender'] == "Female"){echo "checked";} ?> >
                                       <label class="form-check-label" for="gender2">
                                             Female
                                       </label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row mt-5 justify-content-center">
               <div class="col-lg-8">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="text-center m-2">Date of Birth</h5>
                        <div class="row justify-content-center">
                           <div class="col-lg-10">
                              <div class="form-group mt-4">
                                 <label for="name">You must be at least 13 years old to make a donation on OCARMS.</label>
                                 <input type="date" class="form-control" name="birth_date" id="name" value="<?=$user['client_birth_date'];?>" required>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row mt-3 justify-content-center">
               <div class="col-lg-6 text-center">
                  <button type="submit" id="donate" class='btn btn-warning text-dark-blue mt-3'><i class='fas fa-hand-holding-usd'></i> Donate Now</button>
               </div>
            </div>

         </div>
      </div>
</form>

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

   <script>
      $("#flexCheckChecked").click(function () {
         $('input:checkbox').not(this).prop('checked', this.checked);
      });

      $(function() {
         var clone = $("div[id='content']").clone();
         $("#chck").click(function() {
            if ($(this).is(":checked")) {
               $("#content").detach();
            } else {
               clone.insertAfter("div[id='cloned']")
            }
         });
      });

//---------------------------------------------------------------------------------------------------------
               var numberOfChecked = $("input[name='payment']:checked").length;
               $("#clicked_total").text('* You have selected ' + numberOfChecked + ' donations.');

               var total1 = 0;
               $('input:checkbox:checked').each(function () { // iterate through each checked element.
                  total1 += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
               });
               
               $(".amount").text('Total: Php ' + total1 + '.00');
               $("#total_amount").val(total1);

               if(total1==0){
                  $("#donate").attr("disabled", "disabled");
               }else{
                  $("#donate").removeAttr("disabled");
               }

               var idArr = [];
               $("input[name='payment']:checked").each(function(){
                     idArr.push($(this).attr("id"));
               });
               $("input[name='donation_id[]']").val(idArr);
//-----------------------------------------------------------------------------------------------------------
               $("input[type='checkbox']").on("change", function () {

                  var numberOfChecked1 = $("input[name='payment']:checked").length;
                  $("#clicked_total").text('* You have selected ' + numberOfChecked1 + ' donations.');

                  var total = 0;
                  $('input:checkbox:checked').each(function () { // iterate through each checked element.
                     total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
                  });

                  $(".amount").text('Total: Php ' + total + '.00');
                  $("#total_amount").val(total);

                  if(total==0){
                     $("#donate").attr("disabled", "disabled");
                  }else{
                     $("#donate").removeAttr("disabled");
                  }

                  var idArr2 = [];
                  $("input[name='payment']:checked").each(function(){
                     idArr2.push($(this).attr("id"));
                  });
                  $("input[name='donation_id[]']").val(idArr2);

               });
//--------------------------------------------------------------------------------------------------

               $("tr").addClass('active');

               $('th[scope="row"] input[type="checkbox"]').on('click', function () {
                  if (!$(this).closest('tr').hasClass('active')) {
                     $(this).closest('tr').addClass('active');
                  } else {
                     $(this).closest('tr').removeClass('active');
                  }
               });

               $('.js-check-all').on('click', function () {

                  if ($(this).prop('checked')) {
                     $('th input[type="checkbox"]').each(function () {
                        $(this).prop('checked', true);
                        $(this).closest('tr').addClass('active');
                     })
                  } else {
                     $('th input[type="checkbox"]').each(function () {
                        $(this).prop('checked', false);
                        $(this).closest('tr').removeClass('active');
                     })
                  }
               });
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