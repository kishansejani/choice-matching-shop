<?php
include_once 'admin/connection.php';
$r = mysqli_query($conn, "SELECT price, COUNT(*) as cnt FROM product GROUP BY price ORDER BY price LIMIT 10");
while($row = mysqli_fetch_row($r)) {
    echo "Price: ₹" . $row[0] . " -> " . $row[1] . " items\n";
}
?>
