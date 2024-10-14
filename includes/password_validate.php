<?php
include('connect.php');
        session_start();

            $first_pass= $_POST['first_pass'];
            $second_pass= $_POST['second_pass'];
        
            if($first_pass===$second_pass){
                echo json_encode(array("statusCode"=>200));
            }else{
                echo json_encode(array("statusCode"=>201));
            }

 ?>