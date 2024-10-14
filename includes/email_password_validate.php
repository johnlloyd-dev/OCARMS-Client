<?php
include('connect.php');
    session_start();
    
    $user_gmail= $_POST['user_gmail'];
    $user_password= $_POST['user_password'];

    $email_query = "SELECT * FROM client_information WHERE client_email_address = '$user_gmail' AND client_password = '$user_password'";
    $email_query_run = mysqli_query($conn, $email_query);
    $row=mysqli_fetch_array($email_query_run);

    if(mysqli_num_rows($email_query_run) > 0){
        $_SESSION['login_id']=$row['google_id'];
        echo json_encode(array("statusCode"=>200));
    }else{
        echo json_encode(array("statusCode"=>201));
    }
?>