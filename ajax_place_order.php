<?php
include_once 'site_connection.php';
// Include PHPMailer
require 'mail/PHPMailerAutoload.php';

if (isset($_SESSION['login'])) {
    $login_id = $_SESSION['login'];

    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $date_time = mysqli_real_escape_string($conn, $_POST['date_time']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment']);
    $payment_id = isset($_POST['payment_id']) ? mysqli_real_escape_string($conn, $_POST['payment_id']) : '';

    // Fetch everything from user's cart
    $sql_cart = "SELECT * FROM `cart` WHERE `user_id` = '$login_id'";
    $data_cart = mysqli_query($conn, $sql_cart);

    if (mysqli_num_rows($data_cart) > 0) {
        $success = true;
        $order_details_html = ""; // To store details for email

        while ($row = mysqli_fetch_assoc($data_cart)) {
            $pro_id = $row['product_id'];
            $pro_name = mysqli_real_escape_string($conn, $row['name']);
            $price = $row['price'];
            $qty = $row['num_product'];
            $size = mysqli_real_escape_string($conn, $row['size']);
            $color = mysqli_real_escape_string($conn, $row['color']);
            $image = mysqli_real_escape_string($conn, $row['image']);

            $order_details_html .= "<li>$pro_name (Qty: $qty) - Rs. " . ($price * $qty) . "</li>";

            $sql_insert = "INSERT INTO `order` 
                           (`product_id`, `user_id`, `name`, `price`, `num_product`, `image`, `size`, `color`, `address`, `city`, `pincode`, `cust_name`, `mobile`, `email`, `date_time`, `status`, `payment`) 
                           VALUES 
                           ('$pro_id', '$login_id', '$pro_name', '$price', '$qty', '$image', '$size', '$color', '$address', '$city', '$pincode', '$name', '$mobile', '$email', '$date_time', 'placed', '$payment')";

            if (!mysqli_query($conn, $sql_insert)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            // Delete from cart
            $sql_delete = "DELETE FROM `cart` WHERE `user_id` = '$login_id'";
            mysqli_query($conn, $sql_delete);

            // SEND CONFIRMATION EMAIL
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";
            $mail->SMTPAuth = true;
            $mail->Username = "choicematching12@gmail.com"; // Your config from smtp.php
            $mail->Password = "zwjizjsvywishfrk";
            $mail->setFrom('kishanpatel4594@gmail.com', 'Choice Matching Fashion');
            $mail->addAddress($email, $name);
            $mail->Subject = 'Order Placed Successfully - Choice Matching Fashion';

            $mail_body = "
                <div style='font-family: Poppins, sans-serif; padding: 20px; border: 1px solid #eee; border-radius: 10px;'>
                    <h2 style='color: #EF9C78;'>Thank You for Your Order, $name!</h2>
                    <p>Your order has been placed successfully and is being processed.</p>
                    <hr>
                    <h4>Order Details:</h4>
                    <ul>$order_details_html</ul>
                    <p><b>Delivery Address:</b> $address, $city - $pincode</p>
                    <p><b>Payment Method:</b> $payment</p>
                    <br>
                    <p>We will notify you once your order is shipped.</p>
                    <p>Regards,<br><b>CHOICE MATCHING FASHION SHOP</b></p>
                </div>";

            $mail->msgHTML($mail_body);
            $mail->send(); // Send mail in background

            echo "success";
        } else {
            echo "error_insert";
        }
    } else {
        echo "cart_empty";
    }
} else {
    echo "error_session";
}
?>