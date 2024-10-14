<?php

$conn = mysqli_connect("localhost", "root", "", "ocarms_system");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	echo("Not Successful");
}
?>