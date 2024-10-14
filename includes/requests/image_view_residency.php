<?php
    require_once "../connect.php";
    if(isset($_GET['request_id'])) {
        $sql = "SELECT * FROM request_info WHERE request_id = " . $_GET['request_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: ".$row["residency_image_type"]);
        echo $row["residency_image"];
	}
	mysqli_close($conn);
?>