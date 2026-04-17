<?php 
include_once 'site_connection.php';
	
if (isset($_POST['login']))
{
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sql_select = "select * from `user_register` where `email`='$email' and `password`='$password'";
	$data = mysqli_query($conn,$sql_select);
	$row_count = mysqli_num_rows($data);

	if($row_count>0)
	{
		$row = mysqli_fetch_assoc($data);
		$_SESSION['login'] = $row['id'];
		$user_id = $row['id'];

		// Cart Migration Logic
		if(isset($_SESSION['num_product']) && $_SESSION['num_product'] > 0)
		{
			$cart_id = $_SESSION['cart_id'];
			$product_qty = $_SESSION['num_product'];
			$size_p = $_SESSION['size_p'];
			$color_p = $_SESSION['color_p'];

			$sql_prod = "SELECT * FROM `product` WHERE `id`='$cart_id'";
			$prod_data = mysqli_query($conn, $sql_prod);
			$prod_row = mysqli_fetch_assoc($prod_data);

			$check_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE `product_id`='$cart_id' AND `user_id`='$user_id'");
			if(mysqli_num_rows($check_cart) > 0)
			{
				$cart_row = mysqli_fetch_assoc($check_cart);
				$new_qty = $product_qty + $cart_row['num_product'];
				mysqli_query($conn, "UPDATE `cart` SET `num_product`='$new_qty' WHERE `product_id`='$cart_id' AND `user_id`='$user_id'");
			}
			else
			{
				$p_name = $prod_row['name'];
				$p_price = $prod_row['price'];
				$p_img = $prod_row['image1'];
				mysqli_query($conn, "INSERT INTO `cart` (`product_id`,`user_id`,`name`,`price`,`num_product`,`image`,`size`,`color`) VALUES ('$cart_id','$user_id','$p_name','$p_price','$product_qty','$p_img','$size_p','$color_p')");
			}
			header('location:shoping-cart.php');
		} else {
			header('location:index.php');
		}
		exit;
	}
	else
	{
		$error = "Incorrect Email or Password!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | Choice Matching</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main_css.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #13213B 0%, #1c2e4f 100%);
            z-index: -1;
        }

        .login-bg::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('images/banner-01.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.2;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 20px 20px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-wrap {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo-wrap img {
            max-height: 50px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-weight: 800;
            color: #13213B;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #13213B;
            margin-bottom: 8px;
            display: block;
        }

        .form-control-custom {
            width: 100%;
            height: 55px;
            background: #f1f3f5;
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 0 20px;
            font-size: 14px;
            transition: all 0.3s;
            outline: none;
        }

        .form-control-custom:focus {
            background: #fff;
            border-color: #EF9C78;
            box-shadow: 0 0 0 4px rgba(239, 156, 120, 0.1);
        }

        .login-btn {
            width: 100%;
            height: 55px;
            background: #EF9C78;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(239, 156, 120, 0.3);
        }

        .login-btn:hover {
            background: #d8896a;
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(239, 156, 120, 0.4);
        }

        .error-msg {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
        }

        .login-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .login-footer a {
            color: #EF9C78;
            font-weight: 700;
            text-decoration: none;
        }

        .forgot-link {
            display: block;
            text-align: right;
            font-size: 13px;
            color: #666;
            margin-top: -15px;
            margin-bottom: 25px;
            text-decoration: none;
        }

        .forgot-link:hover {
            color: #EF9C78;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
            color: #adb5bd;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }

        .divider:not(:empty)::before { margin-right: 15px; }
        .divider:not(:empty)::after { margin-left: 15px; }
    </style>
</head>
<body>

<div class="login-bg"></div>

<div class="login-card">
    <div class="logo-wrap">
        <a href="index.php">
            <img src="images/icons/logo-01.png" alt="LOGO">
        </a>
    </div>

    <div class="login-header">
        <h2>Welcome Back</h2>
        <p>Login to your account for a better experience</p>
    </div>

    <?php if(isset($error)){ ?>
        <div class="error-msg"><?php echo $error; ?></div>
    <?php } ?>

    <form method="post">
        <div class="form-group">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control-custom" placeholder="name@example.com" required>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required>
        </div>

        <a href="forgot.php" class="forgot-link">Forgot Password?</a>

        <button type="submit" name="login" class="login-btn">Login to Account</button>
    </form>

    <div class="divider">OR</div>

    <div class="login-footer">
        Don't have an account? <a href="register.php">Create Account</a>
    </div>
</div>

<?php include_once 'scripts.php'; ?>

</body>
</html>