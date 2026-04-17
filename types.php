<?php
include_once 'admin/connection.php';
$r = mysqli_query($conn, "SELECT type, COUNT(*) FROM product GROUP BY type");
while($row = mysqli_fetch_row($r)) {
    echo $row[0] . ": " . $row[1] . "\n";
}
?>
