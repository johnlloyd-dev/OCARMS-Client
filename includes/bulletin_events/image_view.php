<?php
    require_once "../connect.php";
    if(isset($_GET['be_id'])) {
        $sql = "SELECT be_image_type, be_image FROM bulletin_events WHERE be_id = " . $_GET['be_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: ".$row["be_image_type"]);
        echo $row["be_image"];
	}
	mysqli_close($conn);
?>