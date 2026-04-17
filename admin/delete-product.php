<?php
include_once 'connection.php';

if (isset($_GET['d_id'])) {
    $id = $_GET['d_id'];
    
    // First get the image names to delete them from folder
    $sql_img = "SELECT image1, image2, image3 FROM `product` WHERE `id`='$id'";
    $res_img = mysqli_query($conn, $sql_img);
    if ($row = mysqli_fetch_assoc($res_img)) {
        if (!empty($row['image1'])) @unlink("image/".$row['image1']);
        if (!empty($row['image2'])) @unlink("image/".$row['image2']);
        if (!empty($row['image3'])) @unlink("image/".$row['image3']);
    }

    $sql_delete = "DELETE FROM `product` WHERE `id`='$id'";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('Product deleted successfully!'); window.location.href='view-product.php';</script>";
    } else {
        echo "<script>alert('Error deleting product!'); window.location.href='view-product.php';</script>";
    }
} else {
    header("Location: view-product.php");
}
?>
