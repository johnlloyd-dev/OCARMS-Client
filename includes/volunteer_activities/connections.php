<?php
include '../connect.php';
session_start(); 

if(isset($_POST['event_id'])){
    $event_id = $_POST['event_id'];
    $contact_number = $_POST['contact_number'];
    $b_date = $_POST['b_date'];
    $full_name = $_POST['client_name'];
    $gender = $_POST['gender'];
    $others = $_POST['others'];
    $address = $_POST['address'];
    $status = "Confirmed/Pending";
    $client_id = $_POST['client_id'];

    $get = mysqli_query($conn, "SELECT * FROM volunteer_info WHERE event_id = '".$_POST['event_id']."' AND client_id = '".$_POST['client_id']."'");
    if(mysqli_num_rows($get)==0){
        $insert = mysqli_query($conn, "INSERT INTO volunteer_info (vl_status, vl_other_info, event_id, client_id) VALUES ('$status','$others','$event_id','$client_id')");
        $update = mysqli_query($conn, "UPDATE client_information SET client_id = '$client_id', client_contact_number = '$contact_number', client_address = '$address', client_birth_date = '$b_date', client_gender = '$gender' WHERE client_id = '$client_id'");
        if($insert && $update){
            mysqli_query($conn, "INSERT INTO alerts_center (alert_message, alert_link, alert_status, alert_identifier) VALUES ('$full_name added a volunteer application!', 'summary_table_volunteer.php', 'Unread', '$client_id')");
            $get_volunteer = mysqli_query($conn, "SELECT * FROM `volunteer_info` ORDER BY vl_id DESC LIMIT 1");
            $vol = mysqli_fetch_assoc($get_volunteer);
    
            $_SESSION['vl_id'] = $vol['vl_id'];
            header('location:../../volunteer_success.php');
            exit();
        }
    }else{
        $_SESSION['status'] = "Application Unsuccesful";
        $_SESSION['text'] = "You already have pending/confirmed application for this event.";
        $_SESSION['status_code'] = "error";
        header('location:../../volunteer.php');
        exit();
    }
}

if(isset($_POST['vl_id'])){
    $event_id = $_POST['vl_id'];

    $update = mysqli_query($conn, "UPDATE volunteer_info SET vl_id = '$event_id', vl_status = 'Confirmed/Cancelled' WHERE vl_id = '$event_id'");
    if($update){
        $_SESSION['vl_id'] = $vol['vl_id'];
        $_SESSION['status'] = "Cancelling Application Success";
        $_SESSION['text'] = "Your application has been cancelled successfully!";
        $_SESSION['status_code'] = "success";
        header('location:../../my_volunteer_activities.php');
        exit();
    }else{
        $_SESSION['status'] = "Cancelling Application Unsuccesful";
        $_SESSION['text'] = "There was an error upon processing your request!";
        $_SESSION['status_code'] = "error";
        header('location:../../my_volunteer_activities.php');
        exit();
    }
}

?>