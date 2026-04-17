<?php
include_once 'admin/connection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_query($conn, "TRUNCATE TABLE `product`") or die(mysqli_error($conn));
mysqli_query($conn, "TRUNCATE TABLE `cart`") or die(mysqli_error($conn));

$baseDir = 'images' . DIRECTORY_SEPARATOR . 'choice images' . DIRECTORY_SEPARATOR;
$targetDir = 'admin' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR;

$categoryMap = [
    'Daily Wear' => 'Daily Wear Junction',
    'Ready Made (Blouse)' => 'Ready Made',
    'Printed Cotton' => 'Printed Cotton'
];

$descriptors = ['Elegant', 'Stylish', 'Exclusive', 'Premium', 'Modern', 'Designer', 'Beautiful', 'Fancy'];

$directory = new RecursiveDirectoryIterator('images' . DIRECTORY_SEPARATOR . 'choice images');
$iterator = new RecursiveIteratorIterator($directory);
$count = 0;

foreach ($iterator as $info) {
    if ($info->isFile() && preg_match('/\.(jpg|jpeg|png|webp)$/i', $info->getFilename())) {
        $filePath = $info->getPathname();
        
        $relative = str_replace('images' . DIRECTORY_SEPARATOR . 'choice images' . DIRECTORY_SEPARATOR, '', $filePath);
        $parts = explode(DIRECTORY_SEPARATOR, $relative);
        
        if (count($parts) >= 2) {
            $rawCategory = $parts[0];
            $subcategory = (count($parts) >= 3) ? $parts[1] : $rawCategory;
            $filename = $info->getFilename();
            
            if (stripos($subcategory, 'Cotton') !== false) {
                $category = 'Printed Cotton';
            } else {
                $category = isset($categoryMap[$rawCategory]) ? $categoryMap[$rawCategory] : $rawCategory;
            }
            
            $randomDesc = $descriptors[array_rand($descriptors)];
            $productName = $randomDesc . " " . $subcategory;
            $newName = rand(1, 1000000) . $filename;
            $destPath = $targetDir . $newName;
            
            if (copy($filePath, $destPath)) {
                $name_esc = mysqli_real_escape_string($conn, $productName);
                
                // GENERATING RANDOM PRICE
                $price = rand(450, 2500); 
                
                $cat_esc = mysqli_real_escape_string($conn, $category);
                $sub_esc = mysqli_real_escape_string($conn, $subcategory);
                $tag = "Best-seller, Featured, Top-rate";
                $desc = mysqli_real_escape_string($conn, "High-quality " . $productName . " perfect for any occasion. Made with premium fabric.");
                $img = mysqli_real_escape_string($conn, $newName);
                
                $sql = "INSERT INTO `product` 
                    (`name`, `price`, `category`, `tag`, `type`, `one_line_title`, `size`, `color`, `description`, `weight`, `dimension`, `material`, `image1`, `image2`, `image3`, `stock`) 
                    VALUES 
                    ('$name_esc', '$price', '$cat_esc', '$tag', '$sub_esc', '$randomDesc Collection', 'S, M, L, XL', 'Multicolor', '$desc', '0.5', '35x25x5', 'Premium Fabric', '$img', '$img', '$img', 'In Stock')";
                
                mysqli_query($conn, $sql);
                $count++;
            }
        }
    }
}
echo "Import Finished! Total: $count with unique prices.\n";
?>
