<?php
include '../connect.php';
session_start(); 

if(isset($_POST['fundraise_id'])){
    $fundraise_id = $_POST['fundraise_id'];

    if(isset($_POST['select_amount']) && $_POST['enter_amount'] == null){
        $amount = $_POST['select_amount'];
     }else{
        $amount = $_POST['enter_amount'];
     }

     $donation_type = "Fundraise Donation";
     $donation_status = "Carted";

    $client_id = $_POST['client_id'];

    $query=mysqli_query($conn,"SELECT * FROM `monetary_donation_info` WHERE client_id = $client_id AND donation_status = 'Carted' AND fundraise_id = $fundraise_id");
    $row=mysqli_fetch_array($query);

    $org_amount = $row['donation_amount'];
    $donation_id = $row['donation_id'];
    $total_amount = (int)$org_amount+(int)$amount;

    $num_rows = mysqli_num_rows($query);

    if($num_rows > 0){
        $insert = mysqli_query($conn, "UPDATE monetary_donation_info SET donation_id = '$donation_id', donation_amount = '$total_amount' WHERE donation_id = '$donation_id'");
        $_SESSION['status'] = "Amount Changed!";
        $_SESSION['text'] = "You already carted an amount to this fundraise so we automatically added the new amount!";
        $_SESSION['status_code'] = "success";
    }else{
        $insert = mysqli_query($conn, "INSERT INTO monetary_donation_info(donation_amount, donation_type, donation_status, fundraise_id, client_id) VALUES ('$amount', '$donation_type', '$donation_status', '$fundraise_id', '$client_id')");
    }

    if($insert){
        $_SESSION['client_id'] = $client_id;
        header('location:../../donate_cart.php');
        exit();
    }
}

?>