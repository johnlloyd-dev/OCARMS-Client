<?php
    require_once "../connect.php";
    if(isset($_GET['ve_id'])) {
        $sql = "SELECT ve_image_type, ve_image FROM volunteer_event WHERE ve_id = " . $_GET['ve_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: ".$row["ve_image_type"]);
        echo $row["ve_image"];
	}
	mysqli_close($conn);
?>