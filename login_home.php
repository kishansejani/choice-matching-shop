<?php

include_once 'site_connection.php';

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql_select = "select * from `user_register` where `email`='$email' and `password`='$password'";
	$data = mysqli_query($conn, $sql_select);
	$row_count = mysqli_num_rows($data);

	if ($row_count > 0) {
		$row = mysqli_fetch_assoc($data);
		$_SESSION['login'] = $row['id'];

		if (isset($_SESSION['cart_id']) && isset($_SESSION['num_product'])) {
			$user_id = $row['id'];
			$cart_id = $_SESSION['cart_id'];
			$product = $_SESSION['num_product'];
			$size_p = $_SESSION['size_p'];
			$color_p = $_SESSION['color_p'];

			if ($product > 0) {
				$sql_select = "select * from `product` where `id`='$cart_id'";
				$data = mysqli_query($conn, $sql_select);
				$row = mysqli_fetch_assoc($data);

				$sql_select_c = "select * from `cart` where `product_id`='$cart_id' and `user_id`='$user_id'";
				$data_c = mysqli_query($conn, $sql_select_c);
				$row_count = mysqli_num_rows($data_c);
				$row_data = mysqli_fetch_assoc($data_c);

				$product_id = $cart_id;
				$name = $row['name'];
				$price = $row['price'];
				$num_product = $product;
				$image = $row['image1'];

				if ($row_count > 0) {
					$new_price = $price;
					$new_num_product = $num_product + $row_data['num_product'];

					$sql_update = "update `cart` set `price`='$new_price',`num_product`='$new_num_product' where `product_id`='$product_id' and `user_id`='$user_id'";
					mysqli_query($conn, $sql_update);

					header('location:shoping-cart.php');
				} else {
					$sql_insert = "insert into `cart`(`product_id`,`user_id`,`name`,`price`,`num_product`,`image`,`size`,`color`)values('$product_id','$user_id','$name','$price','$product','$image','$size_p','$color_p')";
					mysqli_query($conn, $sql_insert);

					header('location:shoping-cart.php');
				}
			}
		} else {
			header('location:index.php');
		}
	} else { ?>
				<div style="text-align: center; color: red; padding-top:10px;">"Entered Email or Password is Incorrect...."</div>
		<?php }
}

?>

<?php include_once 'header.php'; ?>

<!-- Page Hero -->
<section style="background: #f8f8f8; border-bottom: 1px solid #eee; padding: 60px 0;">
	<div class="container text-center">
		<p
			style="color:#EF9C78; font-family:'Poppins',sans-serif; font-weight:700; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:12px;">
			WELCOME BACK</p>
		<h1
			style="font-family:'Poppins',sans-serif; font-weight:800; font-size:42px; color:#13213B; letter-spacing:-1px; margin-bottom:16px;">
			Login to Your Account</h1>
		<p style="color:#666E7D; font-size:16px; max-width:500px; margin:0 auto;">Enjoy a personalised shopping experience.
		</p>
	</div>
</section>

<!-- Login Content -->
<section style="padding: 90px 0; background: #fff;">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 mx-auto">
				<div
					style="background:#fff; border:1px solid #eee; border-radius:20px; padding:50px 45px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">

					<form method="post">
						<div style="margin-bottom:20px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Email
								Address</label>
							<input type="email" name="email" placeholder="Enter your email" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>
						<div style="margin-bottom:10px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Password</label>
							<input type="password" name="password" placeholder="Enter your password" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>

						<div style="text-align: right; margin-bottom: 28px;">
							<a href="forgot.php"
								style="color:#EF9C78; font-size:14px; font-weight:600; text-decoration:none; transition:color 0.3s;"
								onmouseover="this.style.color='#c41a17'" onmouseout="this.style.color='#EF9C78'">Forgot
								Password?</a>
						</div>

						<button type="submit" name="login"
							style="width:100%; background:#EF9C78; color:#fff; border:none; padding:16px; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; letter-spacing:0.5px; transition:background 0.3s; margin-bottom:30px;"
							onmouseover="this.style.background='#c41a17'" onmouseout="this.style.background='#EF9C78'">
							Login &nbsp; →
						</button>

						<div style="text-align: center; border-top: 1px solid #eee; padding-top: 30px;">
							<p style="color:#666; font-size:15px; margin:0;">
								New here?
								<a href="register.php"
									style="color:#EF9C78; font-weight:700; text-decoration:none;">Create an account</a>
							</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>