<?php
include '../connect.php';
session_start(); 

if(isset($_POST['full_name'])){
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'];
    $barangay = $_POST['barangay'];
    $request_details = $_POST['request_details'];
    $description = $_POST['description'];
    $status = "Pending";


 
    $insert = mysqli_query($conn, "INSERT INTO request_info (requester_name, requester_contactnumber, requester_barangay, request_status, request_name, request_description) VALUES ('$full_name', '$contact_number', '$barangay', '$status', '$request_details', '$description')");

    if($insert){
        mysqli_query($conn, "INSERT INTO alerts_center (alert_message, alert_link, alert_status, alert_identifier) VALUES ('$full_name added a request!', 'request_table.php', 'Unread', '$barangay')");
        $get_request = mysqli_query($conn, "SELECT * FROM `request_info` ORDER BY request_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($get_request);

        $_SESSION['request_id'] = $row['request_id'];
        header('location:../../request_success.php');
        exit();
    }
}

?>