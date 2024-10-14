<?php
    require_once "../connect.php";
    if(isset($_GET['donation_id'])) {
        $sql = "SELECT * FROM goods_donation WHERE donation_id = " . $_GET['donation_id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: ".$row["image_type"]);
        echo $row["goods_photo"];
	}
	mysqli_close($conn);
?>