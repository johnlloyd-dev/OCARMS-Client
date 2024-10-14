<?php
include('connect.php');
    session_start();
    
    $user_gmail= $_POST['user_gmail'];
    $email_query = "SELECT * FROM client_information WHERE client_email_address =  '$user_gmail'";
    $email_query_run = mysqli_query($conn, $email_query);

    if(mysqli_num_rows( $email_query_run) > 0){
        echo "Email Already Taken. Please Choose Another One!";
    }
    else{
        echo "Email Address is Available!";
    }
?>