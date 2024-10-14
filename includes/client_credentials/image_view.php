<?php
    require_once "../connect.php";
    if(isset($_GET['google_id'])) {
        $sql = "SELECT * FROM client_information WHERE google_id = " . $_GET['google_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: ".$row["image_type"]);
        echo $row["client_image"];
	}
	mysqli_close($conn);
?>