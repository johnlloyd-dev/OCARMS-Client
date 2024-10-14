<?php
include '../connect.php';
session_start(); 
if(isset($_POST['fname'])){
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $full_name = "$f_name $l_name";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $img = "null.jpg";

    $id = rand(100000000000000000, 1000000000000000000);

    $insert = mysqli_query($conn, "INSERT INTO `client_information`(`google_id`,`client_fname`,`client_lname`,`client_name`,`client_email_address`, `client_password`, `image_name`) VALUES('$id','$f_name','$l_name','$full_name','$email','$password','$img')");
    if($insert){
        header('Location: ../../user_credentials_login.php');
        $_SESSION['status'] = "Register Success";
        $_SESSION['text'] = "Login Now!";
        $_SESSION['status_code'] = "success";
        exit;
    }else{
        echo "Sign up failed!(Something went wrong).";
    }
}




if(isset($_POST['client_id_pi'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $full_name = "$first_name $last_name";
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $b_date = $_POST['date'];
    $client_id = $_POST['client_id_pi'];

    $get_user = mysqli_query($conn, "SELECT * FROM `client_information` WHERE `client_id`='$client_id'");
    $user = mysqli_fetch_assoc($get_user);


    if(isset($_POST['new_password_2']) && $_POST['new_password_2'] != ""){
        $new_password_2 = $_POST['new_password_2'];
    }else{
        $new_password_2 = $user['client_password'];
    }

    $sql = "UPDATE 
    client_information SET 
        client_id = '$client_id',
        client_name = '$full_name',
        client_fname = '$first_name',
        client_lname = '$last_name',
        client_email_address = '$email',
        client_contact_number = '$contact_number',
        client_address = '$address',
        client_birth_date = '$b_date',
        client_password = '$new_password_2',
        client_gender = '$gender'
        WHERE client_id = '$client_id'";

    $query_run2 = mysqli_query($conn, $sql);


    if($query_run2){
        $_SESSION['status'] = "Updated!";
        $_SESSION['text'] = "Your information is updated successfully!";
        $_SESSION['status_code'] = "success";
        header('location:../../account.php');
        exit();
    }
    else{
        $_SESSION['status'] = "Error!";
        $_SESSION['text'] = "Unknown Error Ocurred!";
        $_SESSION['status_code'] = "error";
        header('location:../../account.php');
        exit();
    
    }
}

if(isset($_POST['client_id_pp'])){

    $client_id = $_POST['client_id_pp'];

    $image_type = getimageSize($_FILES['profile_picture']['tmp_name']);
    $profile_picture = addslashes(file_get_contents($_FILES['profile_picture']['tmp_name']));
    $img_name = $_FILES['profile_picture']['name'];

    $sql = "UPDATE client_information SET client_image = '{$profile_picture}', image_name = '{$img_name}', image_type = '{$image_type['mime']}' WHERE client_id = '$client_id'";

    $query_run2 = mysqli_query($conn, $sql);


    if($query_run2){
        $_SESSION['status'] = "Updated!";
        $_SESSION['text'] = "Your profile picture is updated successfully!";
        $_SESSION['status_code'] = "success";
        header('location:../../account.php');
        exit();
    }
    else{
        $_SESSION['status'] = "Error!";
        $_SESSION['text'] = "Unknown Error Ocurred!";
        $_SESSION['status_code'] = "error";
        header('location:../../account.php');
        exit();
    
    }

}
?>