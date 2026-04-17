<?php include_once 'site_connection.php'; ?>

<?php

if (isset($_SESSION['login'])) {
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn, $sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);

	$sql_select = "select * from `order` where `user_id`='$login_id' order by `status` desc";
	$data = mysqli_query($conn, $sql_select);

	$sql_select_o = "select * from `order` where `user_id`='$login_id'";
	$data_o = mysqli_query($conn, $sql_select_o);
	$row_o = mysqli_fetch_assoc($data_o);

	$amt_total = "select * from `order` where `user_id`='$login_id'";
	$data_total = mysqli_query($conn, $amt_total);

	$total_price = 0;
	while ($row_total = mysqli_fetch_assoc($data_total)) {
		$total_price = $total_price + $row_total['price'] * $row_total['num_product'];
	}

	$sql_select_r = "select * from `user_register` where `id`='$login_id'";
	$data_r = mysqli_query($conn, $sql_select_r);
	$row_r = mysqli_fetch_assoc($data_r);

	$sql_select_pay = "select `payment` from `order` where `user_id`='$login_id'";
	$data_pay = mysqli_query($conn, $sql_select_pay);
	$row_pay = mysqli_fetch_assoc($data_pay);

	if ($row_pay != "") {
		if ($row_pay['payment'] == 'Cash on Delivery') {
			$payment_status = 'CASH ON DELIVERY';
		} else {
			$payment_status = 'PAID';
		}

		if (isset($_POST['cancel'])) {
			header('location:cancel-order.php');
		}
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

	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-b-10 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04"
				style="font-family: 'Inter', sans-serif; font-weight: 600;">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #EF9C78;">
				Your Orders
			</span>
		</div>
	</div>

	<div class="container p-t-20 p-b-10">
		<h1
			style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 32px; color: #13213B; margin-bottom: 5px;">
			My Orders</h1>
		<p style="font-family: 'Inter', sans-serif; font-size: 15px; color: #666;">Track your shipments and view your
			purchase history.</p>
	</div>

	<!-- Shoping Cart -->
	<div id="new_number_of_product" style="background-color: #f7f9fa; padding-top: 30px; padding-bottom: 20px;">
		<form class="p-t-20 p-b-85" method="post">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-xl-10 m-lr-auto m-b-50">
						<div class="m-lr-0-xl">
							<?php if (isset($_SESSION['login'])) {
								while ($row = mysqli_fetch_assoc($data)) {

									$status = strtolower($row['status']);
									$progress_width = '10%';
									$step1_color = '#28a745';
									$step2_color = '#fff';
									$step2_border = '#ddd';
									$step3_color = '#fff';
									$step3_border = '#ddd';
									$step4_color = '#fff';
									$step4_border = '#ddd';

									if ($status == 'pending' || $status == 'placed') {
										$progress_width = '20%';
									} else if ($status == 'processing') {
										$progress_width = '50%';
										$step2_color = '#28a745';
										$step2_border = '#28a745';
									} else if ($status == 'shipped') {
										$progress_width = '80%';
										$step2_color = '#28a745';
										$step2_border = '#28a745';
										$step3_color = '#28a745';
										$step3_border = '#28a745';
									} else if ($status == 'delivered') {
										$progress_width = '100%';
										$step2_color = '#28a745';
										$step2_border = '#28a745';
										$step3_color = '#28a745';
										$step3_border = '#28a745';
										$step4_color = '#28a745';
										$step4_border = '#28a745';
									}

									?>
											<!-- Order Card -->
											<div class="m-b-30 p-4"
												style="background: #fff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.06); border: 1px solid #eee;">

												<!-- Top section: Details -->
												<div class="row m-b-20"
													style="border-bottom: 2px dashed #f2f2f2; padding-bottom: 20px;">
													<div class="col-md-2 col-4">
														<div style="border-radius: 8px; overflow: hidden; border: 1px solid #eee;">
															<img src="admin/image/<?php echo $row['image']; ?>"
																style="width: 100%; display: block;" alt="Product">
														</div>
													</div>
													<div class="col-md-7 col-8">
														<h4
															style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px; color: #13213B; margin-bottom: 8px;">
															<?php echo $row['name']; ?>
														</h4>
														<div
															style="font-family: 'Inter', sans-serif; font-size: 14px; color: #666; margin-bottom: 4px;">
															<b>Size:</b> <?php echo $row['size']; ?> | <b>Color:</b>
															<?php echo $row['color']; ?>
														</div>
														<div
															style="font-family: 'Inter', sans-serif; font-size: 14px; color: #666; margin-bottom: 12px;">
															<b>Quantity:</b> <?php echo $row['num_product']; ?>
														</div>
														<div
															style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 18px; color: #EF9C78;">
															Rs. <?php echo $row['price'] * $row['num_product']; ?>
														</div>
													</div>
													<div class="col-md-3 text-right">
														<?php if (strtolower($row['status']) == "pending") { ?>
																<a href="cancel-order.php?c_id=<?php echo $row['id']; ?>"
																	class="stext-104 cl0 trans-04 pointer"
																	style="background: #13213B; color: white; border-radius: 4px; padding: 8px 15px; font-weight: 600; font-size: 13px; transition: all 0.3s; display: inline-block;"
																	onmouseover="this.style.background='#EF9C78'"
																	onmouseout="this.style.background='#13213B'">Cancel Order</a>
														<?php } else { ?>
																<span
																	style="display: inline-block; background: #e8f5e9; color: #28a745; padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 12px;">Status:
																	<?php echo ucfirst($row['status']); ?></span>
														<?php } ?>
													</div>
												</div>

												<!-- Tracking Section -->
												<div class="p-t-10">
													<h5
														style="font-family: 'Inter', sans-serif; font-weight: 700; font-size: 14px; color: #333; margin-bottom: 25px;">
														Tracking Status</h5>

													<div style="position: relative; max-width: 800px; margin: 0 auto; padding: 0 20px;">
														<div
															style="position: absolute; top: 12px; left: 0; right: 0; height: 4px; background: #eee; z-index: 1;">
															<div
																style="width: <?php echo $progress_width; ?>; height: 100%; background: #28a745; transition: width 0.5s;">
															</div>
														</div>
														<div
															style="display: flex; justify-content: space-between; position: relative; z-index: 2;">
															<div style="text-align: center; width: 60px;">
																<div
																	style="width: 28px; height: 28px; border-radius: 50%; background: <?php echo $step1_color; ?>; color: white; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0 auto; box-shadow: 0 0 0 4px #fff;">
																	<i class="zmdi zmdi-check"></i>
																</div>
																<p
																	style="font-size: 11px; font-weight: 600; color: #666; margin-top: 8px;">
																	Order Placed</p>
															</div>
															<div style="text-align: center; width: 60px;">
																<div
																	style="width: 28px; height: 28px; border-radius: 50%; background: <?php echo $step2_color; ?>; border: 2px solid <?php echo $step2_border; ?>; color: white; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0 auto; box-shadow: 0 0 0 4px #fff;">
																	<?php if ($step2_color != '#fff')
																		echo '<i class="zmdi zmdi-check"></i>'; ?>
																</div>
																<p
																	style="font-size: 11px; font-weight: 600; color: #666; margin-top: 8px;">
																	Processing</p>
															</div>
															<div style="text-align: center; width: 60px;">
																<div
																	style="width: 28px; height: 28px; border-radius: 50%; background: <?php echo $step3_color; ?>; border: 2px solid <?php echo $step3_border; ?>; color: white; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0 auto; box-shadow: 0 0 0 4px #fff;">
																	<?php if ($step3_color != '#fff')
																		echo '<i class="zmdi zmdi-check"></i>'; ?>
																</div>
																<p
																	style="font-size: 11px; font-weight: 600; color: #666; margin-top: 8px;">
																	Shipped</p>
															</div>
															<div style="text-align: center; width: 60px;">
																<div
																	style="width: 28px; height: 28px; border-radius: 50%; background: <?php echo $step4_color; ?>; border: 2px solid <?php echo $step4_border; ?>; color: white; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0 auto; box-shadow: 0 0 0 4px #fff;">
																	<?php if ($step4_color != '#fff')
																		echo '<i class="zmdi zmdi-check"></i>'; ?>
																</div>
																<p
																	style="font-size: 11px; font-weight: 600; color: #666; margin-top: 8px;">
																	Delivered</p>
															</div>
														</div>
													</div>
												</div>
											</div>
									<?php }
							} else { ?>
									<div class="text-center p-t-50 p-b-50">
										<h3 style="font-family: 'Poppins', sans-serif;">You have no orders yet.</h3>
									</div>
							<?php } ?>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>


	<?php include_once 'footer.php'; ?>

	<?php include_once 'scripts.php'; ?>