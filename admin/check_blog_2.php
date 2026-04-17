<?php
include '../site_connection.php';
$res = mysqli_query($conn, "SELECT * FROM blog WHERE id=2");
$row = mysqli_fetch_assoc($res);
print_r($row);
?>
