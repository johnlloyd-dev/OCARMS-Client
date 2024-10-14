<?php
    require_once "../connect.php";
    if(isset($_GET['fundraise_id'])) {
        $sql = "SELECT fundraise_image_type, fundraise_image FROM campaigns_monetary WHERE fundraise_id = " . $_GET['fundraise_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: ".$row["fundraise_image_type"]);
        echo $row["fundraise_image"];
	}
	mysqli_close($conn);
?>