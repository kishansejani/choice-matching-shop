<?php
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

echo "Dropping database 'project' to clear orphaned files...<br>";
mysqli_query($conn, "DROP DATABASE IF EXISTS `project`") or die(mysqli_error($conn));

echo "Creating database 'project'...<br>";
mysqli_query($conn, "CREATE DATABASE `project`") or die(mysqli_error($conn));

mysqli_select_db($conn, 'project');

echo "<br>Importing project.sql...<br>";

$sql = file_get_contents('project.sql');
$lines = explode("\n", $sql);
$query = "";
$count = 0;

foreach ($lines as $line) {
    $line = trim($line);
    if (empty($line) || strpos($line, "--") === 0 || strpos($line, "/*") === 0) {
        continue;
    }
    $query .= $line . " ";
    if (substr($line, -1) == ';') {
        if (mysqli_query($conn, $query)) {
            $count++;
        } else {
            echo "Error in query: " . mysqli_error($conn) . "<br>Query: $query <br>";
        }
        $query = "";
    }
}

echo "Finished importing $count statements.<br>";
echo "Database fix process complete. Please check the project now.";
?>
