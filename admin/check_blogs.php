<?php
include '../site_connection.php';
$res = mysqli_query($conn, "SELECT * FROM blog");
if($res) {
    while($row = mysqli_fetch_assoc($res)) {
        echo "ID: " . $row['id'] . " | Title: " . $row['title'] . "\n";
    }
} else {
    echo "SQL Connection Error: " . mysqli_error($conn);
}
?>
