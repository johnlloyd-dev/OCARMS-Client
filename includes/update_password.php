<?php
include('connect.php');
session_start();
            $email= $_POST['email'];
            $current_pass= $_POST['current_pass'];

            $password_query = "SELECT * FROM client_information WHERE client_email_address = '$email' AND client_password = '$current_pass'";
            $password_query_run = mysqli_query($conn, $password_query);
        
            if(mysqli_num_rows($password_query_run) > 0){
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }
 ?>