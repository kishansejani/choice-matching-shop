<?php
include('site_connection.php');

$base = "c:/xampp/htdocs/project/project/images/choice images";
$dest = "c:/xampp/htdocs/project/project/admin/image";

$categories = [
    "Silk Material",
    "Work Material"
];

$count = 0;

foreach ($categories as $cat) { 
    if (is_dir("$base/$cat")) {
        $subcats = scandir("$base/$cat");
        foreach ($subcats as $sub) {
            if ($sub == '.' || $sub == '..') continue;
            
            $subPath = "$base/$cat/$sub";
            if (is_dir($subPath)) {
                $files = scandir($subPath);
                
                $images = [];
                foreach ($files as $f) {
                    $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
                    if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'webp') {
                        $images[] = $f;
                    }
                }
                
                foreach ($images as $img) {
                    $rand = rand(100000, 999999);
                    $safe_img = str_replace(' ', '_', $img);
                    $newImgName = "imported_{$rand}_{$safe_img}";
                    copy("$subPath/$img", "$dest/$newImgName");
                    
                    $name = ucfirst($sub) . " Premium";
                    $price = rand(800, 3500);
                    $tag = "Best-seller, Featured";
                    $type = $sub; 
                    $one_line_title = "Exclusive " . ucfirst($sub) . " Collection";
                    $size = "S - Small, M - Medium, L - Large, XL - Extra Large";
                    $color = "Red, Blue, Black, Green";
                    $desc = "Grab our stunning premium " . ucfirst($sub) . " fabric! Perfectly crafted to deliver the best quality for your wear.";
                    $weight = "0.".rand(1,6);
                    $dim = "15x15x5";
                    $mat = ucfirst($sub);
                    $stock = "In Stock";
                    
                    $sql = "INSERT INTO `product` (`name`, `price`, `category`, `tag`, `type`, `one_line_title`, `size`, `color`, `description`, `weight`, `dimension`, `material`, `image1`, `image2`, `image3`, `stock`) VALUES ('$name', '$price', '$cat', '$tag', '$type', '$one_line_title', '$size', '$color', '$desc', '$weight', '$dim', '$mat', '$newImgName', '$newImgName', '$newImgName', '$stock')";
                    mysqli_query($conn, $sql);
                    $count++;
                }
                echo "Imported $count products for $cat -> $sub \n";
            }
        }
    }
}
echo "SUCCESS! $count total products imported.";
?>
