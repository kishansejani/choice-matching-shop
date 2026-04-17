<?php
$conn = mysqli_connect('localhost', 'root', '', 'project');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
echo "Connected to database 'project' successfully.<br>";

$tables = ['login', 'slider', 'product', 'about', 'user_register', 'blog'];
foreach ($tables as $table) {
    echo "Checking table '$table': ";
    $result = mysqli_query($conn, "SELECT 1 FROM `$table` LIMIT 1");
    if ($result) {
        echo "OK<br>";
    } else {
        echo "ERROR: " . mysqli_error($conn) . "<br>";
    }
}
?>
