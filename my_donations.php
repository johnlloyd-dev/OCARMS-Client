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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/slick/slick.css" rel="stylesheet">
    <link href="lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Datatables -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.jqueryui.min.css">

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
                                <a class="nav-link items" href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item font-weight-bold">
                                <a class="nav-link active items" href="#">My Donations</a>
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
                        <div class="card mb-5">
                            <div class="card-header">
                                <h5>
                                    <?=$user['client_name'];?>'s Monetary Donations
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-wrap-2">
                                    <table class="table-2" id="table-2">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th>Donation Date</th>
                                                <th>Fundraise Name</th>
                                                <th>Donation Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                    require 'includes/connect.php';
                                    $get_info = mysqli_query($conn, "SELECT * FROM `monetary_donation_info` WHERE `client_id`='$client_id' AND donation_status = 'Donated'");
                                    while($get = mysqli_fetch_assoc($get_info)){
                                    $fund_id = $get['fundraise_id'];
                                    $get_info2 = mysqli_query($conn, "SELECT * FROM `campaigns_monetary` WHERE `fundraise_id`='$fund_id'");
                                    $get2 = mysqli_fetch_assoc($get_info2);
                                ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="scope"><?=$get['donation_date'];?></th>
                                                <td><?=$get2['fundraise_title'];?></td>
                                                <td><?=$get['donation_amount'];?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#moneyModal<?=$get['donation_id']?>"><i class="fas fa-info-circle"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                        <?php 
                                        include('includes/donation_money_modal.php');
                                    } 
                                    ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                    <?=$user['client_name'];?>'s Goods Donations
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-wrap-2">
                                    <table class="table-2" id="table-2">
                                        <thead class="thead-primary">
                                            <tr>
                                                <th>Donation Date</th>
                                                <th>Goods Classification</th>
                                                <th>Goods Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                    require 'includes/connect.php';
                                    $get_info3 = mysqli_query($conn, "SELECT * FROM `goods_donation` WHERE client_id = $client_id");
                                    while($get3 = mysqli_fetch_assoc($get_info3)){
                                ?>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="scope"><?=$get3['donation_date'];?></th>
                                                <td><?=$get3['goods_classification'];?></td>
                                                <td><?=$get3['goods_description'];?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#goodsModal<?=$get3['donation_id']?>"><i class="fas fa-info-circle"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php 
                                        include('includes/donation_goods_modal.php');
                                    } 
                                    ?>
                                    </table>
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

    <!-- Datatable Javascript -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.jqueryui.min.js"></script>
    <script src="vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables/buttons.jqueryui.min.js"></script>
    <script src="vendor/datatables/jszip.min.js"></script>
    <script src="vendor/datatables/pdfmake.min.js"></script>
    <script src="vendor/datatables/vfs_fonts.js"></script>
    <script src="vendor/datatables/buttons.html5.min.js"></script>
    <script src="vendor/datatables/buttons.print.min.js"></script>
    <script src="vendor/datatables/buttons.colVis.min.js"></script>
    <script src="vendor/datatables/dataTables.select.min.js"></script>

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
                        if (dataResult.statusCode == 201) {
                            $('.pass_not_match').text("Password not match!").addClass(
                                "text-danger");
                            $('#new_password_2').addClass("border-danger");
                            $('.submit-btn').attr("disabled", "disabled");
                        } else if (dataResult.statusCode == 200) {
                            $('.pass_not_match').text("Password match!").removeClass(
                                "text-danger").addClass("text-success");
                            $('#new_password_2').removeClass("border-danger").addClass(
                                "border-success");
                            if ($('.pass_not_match').text() == "Password match!" && $(
                                    '.inco_pass').text() == "Password Correct!") {
                                $('.submit-btn').removeAttr("disabled");
                            }
                        }
                        if (second_pass == "") {
                            $('.pass_not_match').text("Please enter password!").removeClass(
                                "text-success").addClass("text-danger");
                            $('#new_password_2').removeClass("border-success").addClass(
                                "border-danger");
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
                        if (dataResult.statusCode == 201) {
                            $('.inco_pass').text("Incorrect Password!").addClass(
                                "text-danger");
                            $('#current_password').addClass("border-danger");
                            $('.submit-btn').attr("disabled", "disabled");
                        } else if (dataResult.statusCode == 200) {
                            $('.inco_pass').text("Password Correct!").removeClass(
                                "text-danger").addClass("text-success");
                            $('#current_password').removeClass("border-danger").addClass(
                                "border-success");
                            if ($('.pass_not_match').text() == "Password match!" && $(
                                    '.inco_pass').text() == "Password Correct!") {
                                $('.submit-btn').removeAttr("disabled");
                            }
                        }
                        if (current_pass == "") {
                            $('.inco_pass').text("Please enter password!").removeClass(
                                "text-success").addClass("text-danger");
                            $('#current_password').removeClass("border-success").addClass(
                                "border-danger");
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
                        if (user == "") {
                            $('.error_email').text("This field is empty!").addClass(
                                "text-danger");
                            $('.checking_user').addClass("border-danger");
                        } else {
                            $('.error_email').text(response).removeClass("text-danger")
                                .addClass("text-black");
                            if (response != "Email Address is Available!") {
                                $('.error_email').removeClass("text-black").addClass(
                                    "text-danger");
                                $('.checking_user').addClass("border-danger text-danger");
                                $('.submit-btn').attr("disabled", "disabled");
                            } else {
                                $('.error_email').removeClass("text-danger").addClass(
                                    "text-success");
                                $('.checking_user').removeClass("border-danger text-danger")
                                    .addClass("border-success text-black");
                                $('.submit-btn').removeAttr("disabled");
                            }
                        }
                    }
                });
            });

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
