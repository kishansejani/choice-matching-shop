<?php include_once 'site_connection.php'; ?>

<?php

if (isset($_SESSION['login'])) {
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn, $sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);

	$sql_select_status = "select * from `order` where `status`='placed'";
	$data_status = mysqli_query($conn, $sql_select_status);
	$row_status = mysqli_num_rows($data_status);

	if ($row_status > 0) {
		$sql_select = "select * from `order` where `user_id`='$login_id' and `status`='placed'";
		$data = mysqli_query($conn, $sql_select);

		$sql_select_o = "select * from `order` where `user_id`='$login_id' and `status`='placed'";
		$data_o = mysqli_query($conn, $sql_select_o);
		$row_o = mysqli_fetch_assoc($data_o);

		$amt_total = "select * from `order` where `user_id`='$login_id' and `status`='placed'";
		$data_total = mysqli_query($conn, $amt_total);

		$total_price = 0;
		while ($row_total = mysqli_fetch_assoc($data_total)) {
			$total_price = $total_price + $row_total['price'] * $row_total['num_product'];
		}

		$sql_select_r = "select * from `user_register` where `id`='$login_id'";
		$data_r = mysqli_query($conn, $sql_select_r);
		$row_r = mysqli_fetch_assoc($data_r);

		$sql_select_pay = "select `payment` from `order` where `user_id`='$login_id' and `status`='placed'";
		$data_pay = mysqli_query($conn, $sql_select_pay);
		$row_pay = mysqli_fetch_assoc($data_pay);

		if ($row_pay['payment'] == 'Cash on Delivery') {
			$payment_status = 'CASH ON DELIVERY';
		} else {
			$payment_status = 'PAID';
		}

		$sql_update = "update `order` set `status`='Pending' where `user_id`='$login_id' and `status`='placed'";
		mysqli_query($conn, $sql_update);
	} else {
		header('location:order-list.php');
	}


	if (isset($_POST['list'])) {
		header('location:order-list.php');
	}
} else {
	header('location:login_home.php');
}



?>

<!-- breadcrumb -->
<html lang="en">

<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main_css.css">
	<!--===============================================================================================-->

</head>

<body class="animsition">

	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>

					<div class="right-top-bar flex-w h-full">
						<!-- <a href="#" class="flex-c-m trans-04 p-lr-25">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							EN
						</a>

						<a href="#" class="flex-c-m trans-04 p-lr-25">
							INR
						</a> -->

						<?php if (isset($_SESSION['login'])) { ?>
								<div class="profile-main-menu">
									<a href="#" class="flex-c-m trans-04 p-lr-25" style="border-left: 0">My Account</a>
									<ul class="profile-sub-menu">
										<li>
											<h5><?php echo $row_login['name']; ?></h5>
										</li>
										<li><a href="my_profile.php">My Profile</a></li>
										<li><a href="order-list.php">Order List</a></li>
										<li><a href="shoping-cart.php">My Cart</a></li>
										<li><a href="logouts.php">Logout</a></li>
									</ul>
								</div>
						<?php } else { ?>
								<a href="login_home.php" class="flex-c-m trans-04 p-lr-25">
									Login / Sign-in
								</a>
						<?php } ?>

						<?php if (isset($_SESSION['login'])) { ?>
								<a style="color: #b2b2b2;" class="flex-c-m trans-04 p-lr-25">
									Hello...<?php echo $row_login['name']; ?>!
								</a>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="index.php" class="logo">
						<img src="images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<!-- <div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="index.php">Home</a>
								<ul class="sub-menu">
									<li><a href="index.php">Homepage 1</a></li>
									<li><a href="index.php">Homepage 2</a></li>
									<li><a href="index.php">Homepage 3</a></li>
								</ul>
							</li>

							<li>
								<a href="product.php">Shop</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="shoping-cart.php">Shopping Cart</a>
							</li>

							<li>
								<a href="blog.php">Blog</a>
							</li>

							<li>
								<a href="about.php">About</a>
							</li>

							<li>
								<a href="contact.php">Contact</a>
							</li>
						</ul>
					</div> -->

					<!-- Icon header -->
					<!-- <div class="wrap-icon-header flex-w flex-r-m" id="cart_data_count">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="
						<?php if (isset($_SESSION['login'])) {
							echo $data_count;
						} else {
							echo "0";
						} ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>
					</div> -->
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<!-- <div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="8">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div> -->

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Free shipping for standard order over $100
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w">
						<a href="#" class="flex-c-m p-lr-13 trans-04">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m p-lr-13 trans-04">
							INR
						</a>

						<?php if (isset($_SESSION['login'])) { ?>
								<div class="profile-main-menu-m">
									<a href="#" class="flex-c-m trans-04 p-lr-25" style="border-left: 0">My Account</a>
									<ul class="profile-sub-menu-m">
										<li>
											<h5><?php echo $row_login['name']; ?></h5>
										</li>
										<li><a href="index.php" class="right-top-bar-2">My Profile</a></li>
										<li><a href="index.php">Order List</a></li>
										<li><a href="shoping-cart.php">My Cart</a></li>
										<li><a href="logout.php">Logout</a></li>
									</ul>
								</div>
						<?php } else { ?>
								<a href="login_home.php" class="flex-c-m trans-04 p-lr-25">
									Login / Sign-in
								</a>
						<?php } ?>

						<?php if (isset($_SESSION['login'])) { ?>
								<a style="color: #b2b2b2;" class="flex-c-m trans-04 p-lr-15">
									Hello... <?php echo $row_login['name']; ?>!
								</a>
						<?php } ?>
					</div>
				</li>
			</ul>

			<!-- <ul class="main-menu-m">
				<li>
					<a href="index.php">Home</a>
					<ul class="sub-menu-m">
						<li><a href="index.php">Homepage 1</a></li>
						<li><a href="home-02.php">Homepage 2</a></li>
						<li><a href="home-03.php">Homepage 3</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="product.php">Shop</a>
				</li>

				<li>
					<a href="shoping-cart.php" class="label1 rs1" data-label1="hot">Shopping Cart</a>
				</li>

				<li>
					<a href="blog.php">Blog</a>
				</li>

				<li>
					<a href="about.php">About</a>
				</li>

				<li>
					<a href="contact.php">Contact</a>
				</li>
			</ul> -->
		</div>

		<!-- Modal Search -->
		<!-- <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div> -->
	</header>

	<!-- Breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-b-10 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04"
				style="font-family: 'Inter', sans-serif; font-weight: 600;">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a href="shoping-cart.php" class="stext-109 cl8 hov-cl1 trans-04"
				style="font-family: 'Inter', sans-serif; font-weight: 600;">
				Shopping Cart
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #EF9C78;">
				Order Success
			</span>
		</div>
	</div>

	<div class="container p-t-30 p-b-20 text-center" style="background-color: #f7f9fa; margin: 0; max-width: 100%;">
		<!-- Stepper -->
		<div class="checkout-stepper m-b-40 p-t-20"
			style="display: flex; justify-content: center; align-items: flex-start; max-width: 600px; margin: 0 auto 40px;">
			<!-- Step 1 (Completed) -->
			<div style="text-align: center; flex: 1;">
				<div
					style="width: 50px; height: 50px; border-radius: 50%; background: #EF9C78; color: white; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; margin: 0 auto; box-shadow: 0 5px 15px rgba(227,29,26,0.3); z-index: 2; position: relative;">
					<i class="zmdi zmdi-check"></i>
				</div>
				<p
					style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700; color: #13213B; margin-top: 12px;">
					Shopping Bag</p>
			</div>
			<!-- Line -->
			<div style="flex: 1; height: 3px; background: #EF9C78; margin-top: 25px;"></div>

			<!-- Step 2 (Completed) -->
			<div style="text-align: center; flex: 1;">
				<div
					style="width: 50px; height: 50px; border-radius: 50%; background: #EF9C78; color: white; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; margin: 0 auto; box-shadow: 0 5px 15px rgba(227,29,26,0.3); z-index: 2; position: relative;">
					<i class="zmdi zmdi-check"></i>
				</div>
				<p
					style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700; color: #13213B; margin-top: 12px;">
					Checkout</p>
			</div>
			<!-- Line -->
			<div style="flex: 1; height: 3px; background: #EF9C78; margin-top: 25px;"></div>

			<!-- Step 3 (Active) -->
			<div style="text-align: center; flex: 1;">
				<div
					style="width: 50px; height: 50px; border-radius: 50%; background: #EF9C78; color: white; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; margin: 0 auto; box-shadow: 0 5px 15px rgba(227,29,26,0.3); z-index: 2; position: relative;">
					<i class="zmdi zmdi-check-all"></i>
				</div>
				<p
					style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700; color: #13213B; margin-top: 12px;">
					Complete</p>
			</div>
		</div>

		<div
			style="background: #fafafa; border: 1px solid #eee; border-radius: 12px; padding: 40px; text-align: center; max-width: 800px; margin: 0 auto;">
			<i class="zmdi zmdi-check-circle"
				style="font-size: 60px; color: #28a745; margin-bottom: 20px; display: block;"></i>
			<h1
				style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 32px; color: #13213B; margin-bottom: 10px;">
				Order Placed Successfully!</h1>
			<p style="font-family: 'Inter', sans-serif; font-size: 16px; color: #666;">Thank you for shopping with us.
				Your products will be delivered within the estimated time. Please find the details of your order below.
			</p>
		</div>
	</div>

	<div id="new_number_of_product" style="background-color: #f7f9fa; padding-top: 30px; padding-bottom: 20px;">
		<form class="p-t-20 p-b-85" method="post">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
						<div class="m-l-25 m-r--38 m-lr-0-xl">
							<div class="wrap-table-shopping-cart"
								style="box-shadow: 0 5px 20px rgba(0,0,0,0.05); border-radius: 12px; overflow: hidden; background: #fff; border: 1px solid #eee;">
								<table class="table-shopping-cart" align="center">
									<tr class="table_head"
										style="background-color: #fcfcfc; border-bottom: 2px solid #f2f2f2;">
										<th class="column-1"
											style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #13213B;">
											Product</th>
										<th class="column-2"
											style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #13213B;">
											Details</th>
										<th class="column-3"
											style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #13213B;">
											Price</th>
										<th class="column-4" align="center"
											style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #13213B;">
											Quantity</th>
										<th class="column-5"
											style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #13213B;">
											Total</th>
									</tr>

									<?php if (isset($_SESSION['login'])) {
										while ($row = mysqli_fetch_assoc($data)) { ?>
													<tr class="table_row">
														<td class="column-1" align="center">
															<div class="how-itemcart1">
																<img src="admin/image/<?php echo $row['image']; ?>">
															</div>
														</td>
														<td class="column-2">
															<div class="p-b-10"><?php echo $row['name']; ?></div>
															<ul>
																<li><b>Size : </b><?php echo $row['size']; ?></li>
																<li><b>Color : </b><?php echo $row['color']; ?></li>
															</ul>
														</td>
														<td class="column-3">Rs.<?php echo $row['price']; ?></td>
														<td class="column-4" align="center">
															<span class="num_pro"><?php echo $row['num_product']; ?></span>
														</td>
														<td class="column-5">
															<?php

															$total_pro = $row['num_product'];
															$price = $row['price'];

															echo 'Rs.' . $total_pro * $price;
															?>
														</td>
														<td>

														</td>
													</tr>
											<?php }
									} ?>

								</table>
							</div>

							<div class="p-t-20 p-b-20 p-lr-40 p-lr-15-sm"
								style="border: 1px solid #eee; border-top: none; border-radius: 0 0 12px 12px; background: #fafafa;">
								<div class="m-tb-5">
									<h4
										style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px; color: #13213B; margin-bottom: 20px; border-bottom: 2px solid #EF9C78; display: inline-block; padding-bottom: 5px;">
										Delivery Details</h4>
									<div class="order_text cl2 m-b-15"
										style="font-family: 'Inter', sans-serif; font-size: 14px;"><b
											style="color: #13213B; font-weight: 600; width: 100px; display: inline-block;">Address:</b>
										<?php echo $row_o['address']; ?>, <?php echo $row_o['city']; ?> -
										<?php echo $row_o['pincode']; ?></div>
									<div class="order_text cl2 m-b-15"
										style="font-family: 'Inter', sans-serif; font-size: 14px;"><b
											style="color: #13213B; font-weight: 600; width: 100px; display: inline-block;">Deliver
											To:</b> <?php echo $row_o['cust_name']; ?></div>
									<div class="order_text cl2 m-b-15"
										style="font-family: 'Inter', sans-serif; font-size: 14px;"><b
											style="color: #13213B; font-weight: 600; width: 100px; display: inline-block;">Mobile
											No:</b> <?php echo $row_o['mobile']; ?></div>
									<div class="order_text cl2 m-b-15"
										style="font-family: 'Inter', sans-serif; font-size: 14px;"><b
											style="color: #13213B; font-weight: 600; width: 100px; display: inline-block;">Email
											ID:</b> <?php echo $row_o['email']; ?></div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-lg-7 col-xl-5 m-lr-auto m-b-50">
						<div class="p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm"
							style="background:#fff; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
							<h4 class="mtext-109 cl2 p-b-30"
								style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 24px; border-bottom: 2px solid #f2f2f2; margin-bottom: 20px;">
								Order Summary
							</h4>

							<div class="flex-w flex-t p-b-13"
								style="border-bottom: 1px dashed #e1e1e1; margin-bottom: 15px;">
								<div class="size-208">
									<span class="stext-110 cl2 ">
										Subtotal:
									</span>
								</div>

								<div class="size-209">
									<span class="mtext-110 cl2">
										<?php if (isset($_SESSION['login'])) { ?>
												Rs.<?php echo $total_price; ?>
										<?php } else {
											echo "Rs.0";
										} ?>
									</span>
								</div>
							</div>

							<div class="flex-w flex-t p-t-15 p-b-30" style="border-bottom: 1px solid #e1e1e1;">
								<div class="size-208 w-full-ssm">
									<span class="stext-110 cl2"
										style="font-family: 'Inter', sans-serif; font-weight: 600;">
										Shipping:
									</span>
								</div>

								<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
									<p class="stext-111 cl6 p-t-2" style="color: #28a745; font-weight: 700;">
										FREE
									</p>
								</div>
							</div>

							<div class="flex-w flex-t p-t-27 p-b-20">
								<div class="size-208">
									<span class="mtext-101 cl2"
										style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 20px;">
										Total:
									</span>
								</div>

								<div class="size-209 p-t-1">
									<span class="mtext-110"
										style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 24px; color: #EF9C78;">
										<?php if (isset($_SESSION['login'])) { ?>
												Rs.<?php echo $total_price; ?>
										<?php } else {
											echo "Rs.0";
										} ?>
									</span>
								</div>
							</div>

							<div class="p-b-13 p-t-15" style="border-top: 1px dashed #e1e1e1; margin-top: 10px;">
								<div class="stext-110 m-b-5"
									style="color: #555; text-transform: uppercase; font-size: 11px;">Payment Method:
								</div>
								<h4
									style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 16px; color: <?php echo ($payment_status == 'PAID') ? '#28a745' : '#13213B'; ?>;">
									<i
										class="zmdi <?php echo ($payment_status == 'PAID') ? 'zmdi-check-square' : 'zmdi-money-box'; ?> m-r-5"></i>
									<?php echo $payment_status; ?>
								</h4>
							</div>

							<button class="flex-c-m stext-101 cl0 size-116 trans-04 pointer" name="list"
								style="background: #13213B; color: white; border-radius: 4px; font-weight: 700; font-family: 'Poppins', sans-serif; font-size: 16px; margin-top: 30px; transition: all 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.15);"
								onmouseover="this.style.background='#EF9C78'; this.style.boxShadow='0 4px 15px rgba(227,29,26,0.3)';"
								onmouseout="this.style.background='#13213B'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.15)';">
								Go To Your Order-List
							</button>

						</div>
					</div>
				</div>
			</div>
		</form>
	</div>


	<?php include_once 'footer.php'; ?>

	<?php include_once 'scripts.php'; ?>