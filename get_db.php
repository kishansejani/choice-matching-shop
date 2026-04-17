<?php
include('site_connection.php');
echo "TABLES:\n";
$res = mysqli_query($conn, 'SHOW TABLES');
while($r = mysqli_fetch_row($res)) {
    echo $r[0] . "\n";
}

echo "\nCATEGORIES:\n";
$c = mysqli_query($conn, 'SELECT * FROM category');
while($r = mysqli_fetch_assoc($c)) {
    print_r($r);
}

echo "\nSUBCATEGORIES:\n";
$s = mysqli_query($conn, 'SELECT * FROM sub_category');
while($r = mysqli_fetch_assoc($s)) {
    print_r($r);
}
?>
