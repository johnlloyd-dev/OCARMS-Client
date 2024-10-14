<?php
include '../connect.php';
session_start(); 

    if(isset($_POST['goods_classification'])){

    $goods_classification = $_POST['goods_classification'];
    $pickup_location = $_POST['pickup_location'];
    $goods_description = $_POST['goods_description'];

    $status = "Pending";

    $goods = getimageSize($_FILES['goods_image']['tmp_name']);
    $goods_picture = addslashes(file_get_contents($_FILES['goods_image']['tmp_name']));

    $client_id = $_SESSION['client_id'];

    $fetch = mysqli_query($conn, "SELECT * FROM client_information WHERE client_id = $client_id");
    $row = mysqli_fetch_array($fetch);

    if(isset($_POST['account_fname']) && isset($_POST['contact_number']) && isset($_POST['gender']) && isset($_POST['account_lname'])){
        $account_fname = $_POST['account_fname'];
        $account_lname = $_POST['account_lname'];
        $full_name = "$account_fname $account_lname";
        $gender = $_POST['gender'];
        $profile_display = $full_name;
    }else{
        $account_fname = $row['client_fname'];
        $account_lname = $row['client_lname'];
        $full_name = "$account_fname $account_lname";
        $gender = $row['client_gender'];
        $profile_display = "Anonymous";
    }
    
    
    $b_date = $_POST['birth_date'];
    $contact_number = $_POST['contact_number'];

    $insert = mysqli_query($conn, "INSERT INTO goods_donation (goods_classification, pickup_location, goods_description, donation_status, profile_display, goods_photo, image_type, client_id) VALUES ('$goods_classification', '$pickup_location', '$goods_description', '$status', '$profile_display', '$goods_picture', '$goods', '$client_id')");

    $update = mysqli_query($conn, "UPDATE client_information SET client_id = '$client_id', client_name = '$full_name', client_fname = '$account_fname', client_lname = '$account_lname', client_contact_number = '$contact_number', client_gender = '$gender', client_birth_date = '$b_date' WHERE client_id = '$client_id'");

    if($insert && $update){
        mysqli_query($conn, "INSERT INTO alerts_center (alert_message, alert_link, alert_status, alert_identifier) VALUES ('$full_name added a goods donation!', 'summary_table_goods.php', 'Unread', '$client_id')");
        $get_goods = mysqli_query($conn, "SELECT * FROM `goods_donation` ORDER BY donation_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($get_goods);

        $_SESSION['donation_id'] = $row['donation_id'];
        header('location:../../goods_success.php');
        exit();
    }

}
?>