<?php

if(!isset($_FILES['profile_picture']['name'])){
    echo json_encode(array("statusCode"=>200));
}else{
    echo json_encode(array("statusCode"=>201));
}
?>