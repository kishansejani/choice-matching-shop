<?php include_once 'site_connection.php';

if (isset($_SESSION['login'])) {
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn, $sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);

	$sql_select = "select * from `cart` where `user_id`='$login_id'";
	$data = mysqli_query($conn, $sql_select);

	$sql_select_pro_id = "select `product_id` from `cart` where `user_id`='$login_id'";
	$data_pro_id = mysqli_query($conn, $sql_select_pro_id);

	while ($row = mysqli_fetch_assoc($data_pro_id)) {
		$pro_id = $row['product_id'];

		$sql_select = "select * from `product` where `id`='$pro_id'";
		$data_price = mysqli_query($conn, $sql_select);
	}



	$amt_total = "select * from `cart` where `user_id`='$login_id'";
	$data_total = mysqli_query($conn, $amt_total);

	$total_price = 0;
	while ($row_total = mysqli_fetch_assoc($data_total)) {
		$total_price = $total_price + $row_total['price'] * $row_total['num_product'];
	}
}

if (isset($_POST['buy'])) {
	if (isset($_SESSION['login'])) {
		header('location:order-now.php');
	} else {
		header('location:login_cart.php');
	}
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
			<span class="stext-109 cl4" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #EF9C78;">
				Shopping Cart
			</span>
		</div>
	</div>

	<!-- Shoping Cart -->
	<div id="new_number_of_product" style="background-color: #f7f9fa; padding-top: 30px; padding-bottom: 20px;">
		<form class="p-t-20 p-b-85" method="post">
			<div class="container">

				<!-- Stepper -->
				<div class="checkout-stepper m-b-50"
					style="display: flex; justify-content: center; align-items: flex-start; max-width: 600px; margin: 0 auto 50px;">
					<!-- Step 1 -->
					<div style="text-align: center; flex: 1;">
						<div
							style="width: 50px; height: 50px; border-radius: 50%; background: #EF9C78; color: white; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700; margin: 0 auto; box-shadow: 0 5px 15px rgba(227,29,26,0.3); z-index: 2; position: relative;">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
						<p
							style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 700; color: #13213B; margin-top: 12px;">
							Shopping Bag</p>
					</div>
					<!-- Line -->
					<div style="flex: 1; height: 3px; background: #eee; margin-top: 25px;"></div>

					<!-- Step 2 -->
					<div style="text-align: center; flex: 1;">
						<div
							style="width: 50px; height: 50px; border-radius: 50%; background: #fff; border: 2px solid #ddd; color: #aaa; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; margin: 0 auto; z-index: 2; position: relative;">
							2
						</div>
						<p
							style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 500; color: #aaa; margin-top: 12px;">
							Checkout</p>
					</div>
					<!-- Line -->
					<div style="flex: 1; height: 3px; background: #eee; margin-top: 25px;"></div>

					<!-- Step 3 -->
					<div style="text-align: center; flex: 1;">
						<div
							style="width: 50px; height: 50px; border-radius: 50%; background: #fff; border: 2px solid #ddd; color: #aaa; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; margin: 0 auto; z-index: 2; position: relative;">
							3
						</div>
						<p
							style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 500; color: #aaa; margin-top: 12px;">
							Complete</p>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
						<div class="m-l-25 m-r--38 m-lr-0-xl">
							<div class="wrap-table-shopping-cart"
								style="box-shadow: 0 5px 20px rgba(0,0,0,0.05); border-radius: 12px; overflow: hidden; background: #fff; border: 1px solid #eee;">
								<table class="table-shopping-cart">
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
										<th class="column-4"
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

															<a href="javascript:void(0)" class="delete_from_cart" attr_id=<?php echo $row['id']; ?>>
																<div class="how-itemcart1">
																	<img src="admin/image/<?php echo $row['image']; ?>" alt="IMG">
																</div>
															</a>

															<a href="#"
																class="flex-c-m stext-101 cl2 size-106 bg8 bor13 hov-btn3 p-lr-1 trans-04 cart_delete"
																attr_id=<?php echo $row['id']; ?>>Remove</a>

														</td>
														<td class="column-2">
															<div class="p-b-10">
																<a href="product-detail.php?detail_id=<?php echo $row['product_id']; ?>"
																	class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
																	<?php echo $row['name']; ?>
															</div>
															</a>
															<ul>
																<li><b>Size : </b><?php echo $row['size']; ?></li>
																<li><b>Color : </b><?php echo $row['color']; ?></li>
															</ul>
														</td>
														<td class="column-3">Rs.<?php echo $row['price']; ?></td>
														<td class="column-4">
															<div class="wrap-num-product flex-w m-l-auto m-r-0">
																<a href="javascript:void(0)" attr_id=<?php echo $row['id']; ?>
																	attr_pro=<?php echo $row['num_product'] - 1; ?> class="dec_number">
																	<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
																		<i class="fs-16 zmdi zmdi-minus"></i>
																	</div>
																</a>

																<input class="mtext-104 cl3 txt-center num-product" type="number"
																	name="num-product1" value="<?php echo $row['num_product']; ?>">

																<a href="javascript:void(0)" attr_id=<?php echo $row['id']; ?>
																	attr_pro=<?php echo $row['num_product'] + 1; ?> class="add_number">
																	<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
																		<i class="fs-16 zmdi zmdi-plus"></i>
																	</div>
																</a>
															</div>
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

							<div class="flex-w flex-sb-m p-t-18 p-b-15 p-lr-40 p-lr-15-sm"
								style="border: 1px solid #eee; border-top: none; border-radius: 0 0 12px 12px;">
								<!-- <div class="flex-w flex-m m-r-20 m-tb-5">
									<input class="stext-104 plh4 size-117 p-lr-20 m-r-10 m-tb-5" type="text"
										name="coupon" placeholder="Coupon Code"
										style="border: 1px solid #e1e1e1; border-radius: 4px; font-family: 'Inter', sans-serif;">

									<div class="flex-c-m stext-101 cl0 size-118 trans-04 pointer m-tb-5"
										style="background: #13213B; color: white; border-radius: 4px; font-family: 'Poppins', sans-serif; font-weight: 600; padding: 0 25px; transition: all 0.3s;"
										onmouseover="this.style.background='#EF9C78'"
										onmouseout="this.style.background='#13213B'">
										Apply coupon
									</div>
								</div> -->

								<a href="product.php">
									<div class="flex-c-m stext-101 cl0 size-119 trans-04 pointer m-tb-10"
										style="background: #f7f7f7; color: #13213B; border: 1px solid #13213B; border-radius: 4px; font-family: 'Poppins', sans-serif; font-weight: 600; padding: 0 25px; transition: all 0.3s;"
										onmouseover="this.style.background='#13213B'; this.style.color='#fff';"
										onmouseout="this.style.background='#f7f7f7'; this.style.color='#13213B';">
										Add More Product
									</div>
								</a>
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-lg-7 col-xl-5 m-lr-auto m-b-50">
						<div class="p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm"
							style="background:#fff; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
							<h4 class="mtext-109 cl2 p-b-30"
								style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 24px; border-bottom: 2px solid #f2f2f2; margin-bottom: 20px;">
								Cart Totals
							</h4>

							<div class="flex-w flex-t p-b-13"
								style="border-bottom: 1px dashed #e1e1e1; margin-bottom: 15px;">
								<div class="size-208">
									<span class="stext-110 cl2">
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

							<div class="flex-w flex-t p-t-27 p-b-33">
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

							<button class="flex-c-m stext-101 cl0 size-116 trans-04 pointer" name="buy"
								style="background: #EF9C78; color: white; border-radius: 8px; font-weight: 700; font-family: 'Poppins', sans-serif; font-size: 16px; transition: all 0.3s; box-shadow: 0 5px 20px rgba(227,29,26,0.25);"
								onmouseover="this.style.background='#13213B'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.15)';"
								onmouseout="this.style.background='#EF9C78'; this.style.boxShadow='0 5px 20px rgba(227,29,26,0.25)';">
								Proceed to Checkout <i class="zmdi zmdi-arrow-right m-l-10"
									style="font-size: 20px;"></i>
							</button>

							<div class="p-t-20 text-center" style="border-top: 1px solid #eee; margin-top: 20px;">
								<div
									style="display: inline-flex; align-items: center; justify-content: center; background: #e8f5e9; color: #28a745; padding: 6px 15px; border-radius: 20px;">
									<i class="zmdi zmdi-shield-check" style="font-size: 18px; margin-right: 6px;"></i>
									<span
										style="font-size: 12px; font-family: 'Inter', sans-serif; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">100%
										Secure Checkout</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>


	<?php include_once 'footer.php'; ?>

	<?php include_once 'scripts.php'; ?>