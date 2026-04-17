<?php
include_once 'admin/connection.php';
$r = mysqli_query($conn, "SELECT category, COUNT(*) FROM product GROUP BY category");
while($row = mysqli_fetch_row($r)) {
    echo $row[0] . ": " . $row[1] . "\n";
}
?>
