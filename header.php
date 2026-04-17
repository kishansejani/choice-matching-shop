<?php include_once 'site_connection.php';

if (isset($_SESSION['login'])) {
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn, $sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);
	$sql_select_cart = "select * from `cart` where `user_id`='$login_id'";
	$data_cart = mysqli_query($conn, $sql_select_cart);
	$amt_total = "select * from `cart` where `user_id`='$login_id'";
	$data_total = mysqli_query($conn, $amt_total);
	$total_price = 0;
	while ($row_total = mysqli_fetch_assoc($data_total)) {
		$total_price = $total_price + $row_total['price'] * $row_total['num_product'];
	}
	$data_count = mysqli_num_rows($data_total);
}

$contact_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `contact_info` WHERE `id`=1"));
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Online Fashion Shopping & Delivery System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
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
	<link rel="stylesheet" type="text/css" href="css/premium.css">
	<!--===============================================================================================-->

	<style>
		:root {
			--primary-color: #13213B;
			--accent-color: #EF9C78;
			--accent-hover: #d88b6a;
			--bg-color: #F8FAFC;
			/* Slightly more premium than pure white */
			--secondary-text: #64748B;
			--glass-white: rgba(255, 255, 255, 0.7);
			--premium-shadow: 0 10px 40px -10px rgba(19, 33, 59, 0.12);
			--border-radius: 16px;
			--transition-smooth: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
		}

		body {
			background-color: var(--bg-color) !important;
			color: var(--primary-color);
			font-family: 'Inter', sans-serif !important;
			-webkit-font-smoothing: antialiased;
		}

		/* Premium Heading Style */
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		.heading-premium {
			background: linear-gradient(135deg, #13213B 20%, #EF9C78 100%);
			-webkit-background-clip: text !important;
			-webkit-text-fill-color: transparent !important;
			background-clip: text !important;
			display: inline-block;
			letter-spacing: -0.02em;
			font-weight: 800 !important;
		}

		/* Specific Exclusion for Slider, Footer & Banner Text - MUST STAY WHITE */
		.item-slick1 h2,
		.item-slick1 span,
		.item-slick1 h1,
		.item-slick1 h3,
		footer h1,
		footer h2,
		footer h3,
		footer h4,
		footer h5,
		footer h6,
		.block1-name,
		.block1 h1,
		.block1 h2,
		.block1 h3,
		.cat-card-title,
		.cat-card-tag,
		.cat-card-sub,
		.cat-card h1,
		.cat-card h2,
		.cat-card h3,
		.promo-banner-peach h1,
		.promo-banner-peach h2,
		.promo-banner-peach h3 {
			background: none !important;
			-webkit-text-fill-color: #fff !important;
			color: #fff !important;
		}

		/* Glassmorphism Section */
		.glass-card {
			background: var(--glass-white);
			backdrop-filter: blur(12px);
			-webkit-backdrop-filter: blur(12px);
			border: 1px solid rgba(255, 255, 255, 0.3);
			border-radius: var(--border-radius);
			box-shadow: var(--premium-shadow);
		}

		/* Custom Scrollbar */
		::-webkit-scrollbar {
			width: 8px;
		}

		::-webkit-scrollbar-track {
			background: var(--bg-color);
		}

		::-webkit-scrollbar-thumb {
			background: var(--primary-color);
			border-radius: 10px;
			border: 2px solid var(--bg-color);
		}

		/* Premium Header - Glass Style */
		.container-menu-desktop {
			background: rgba(255, 255, 255, 0.8) !important;
			backdrop-filter: blur(15px);
			-webkit-backdrop-filter: blur(15px);
			border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
			position: sticky;
			top: 0;
			z-index: 1000;
			transition: var(--transition-smooth);
		}

		.top-bar {
			background: var(--primary-color) !important;
		}

		/* Utility Overrides */
		.bg1 {
			background-color: var(--primary-color) !important;
		}

		.cl1 {
			color: var(--accent-color) !important;
		}

		/* Global Product Image Fix */
		.block2-pic img {
			width: 100% !important;
			height: 100% !important;
			object-fit: cover !important;
			display: block !important;
		}

		.block2-pic {
			aspect-ratio: 3/4 !important;
			width: 100% !important;
			overflow: hidden !important;
		}

		.hov-btn1:hover {
			background-color: var(--accent-color) !important;
			color: #fff !important;
			box-shadow: var(--premium-shadow);
		}

		::selection {
			background-color: var(--accent-color);
			color: #fff;
		}
	</style>
</head>

<body class="animsition">

	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						🚚 Free Delivery Above ₹600 &nbsp;|&nbsp; 🔁 Easy 10-Day Returns
					</div>

					<div class="right-top-bar flex-w h-full">
						<?php if (isset($_SESSION['login'])) { ?>
							<a class="flex-c-m trans-04 p-lr-15" style="color: rgba(255,255,255,0.85); font-size: 12px;">
								Hi, <?php echo $row_login['name']; ?>
							</a>
							<a href="wishlist.php" class="flex-c-m trans-04 p-lr-15"
								style="color: #EF9C78; font-size: 12px; font-weight: 700;">
								Wishlist ❤️
							</a>
							<a href="my_profile.php" class="flex-c-m trans-04 p-lr-15"
								style="color: #fff; font-size: 12px; font-weight: 600;">
								My Account
							</a>
							<a href="logouts.php" class="flex-c-m trans-04 p-lr-15"
								style="color: #fff; font-size: 12px; font-weight: 600;">
								Logout
							</a>
						<?php } else { ?>
							<a href="login_home.php" class="flex-c-m trans-04 p-lr-20"
								style="color: #fff; font-size: 12px; font-weight: 600;">
								Login / Register
							</a>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<a href="index.php" class="logo">
						<img src="images/icons/logo-01.png" alt="CHOICE MATCHING"
							style="max-height: 75px; width: auto; transition: transform 0.3s ease;">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
						<ul class="main-menu">
							<li class="<?php if($current_page == 'index.php') echo 'active-menu'; ?>">
								<a href="index.php">Home</a>
							</li>

							<li class="<?php if($current_page == 'product.php') echo 'active-menu'; ?>">
								<a href="product.php">Shop</a>
								<ul class="sub-menu">
									<?php
									$cat_res = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1 ORDER BY sequence ASC, id DESC");
									while ($cat_row = mysqli_fetch_assoc($cat_res)) {
										echo "<li><a href='product.php?cat_name=" . urlencode($cat_row['category_name']) . "'>{$cat_row['category_name']}</a></li>";
									}
									?>
								</ul>
							</li>

							<li class="<?php if($current_page == 'shoping-cart.php') echo 'active-menu'; ?> label1" data-label1="hot">
								<a href="shoping-cart.php">Shopping Cart</a>
							</li>

							<li class="<?php if($current_page == 'blog.php') echo 'active-menu'; ?>">
								<a href="blog.php">Blog</a>
							</li>

							<li class="<?php if($current_page == 'about.php') echo 'active-menu'; ?>">
								<a href="about.php">About</a>
							</li>

							<li class="<?php if($current_page == 'contact.php') echo 'active-menu'; ?>">
								<a href="contact.php">Contact</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m" id="cart_data_count">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
							data-notify="
						<?php if (isset($_SESSION['login'])) {
							echo $data_count;
						} else {
							echo "0";
						} ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<a href="wishlist.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<div class="logo-mobile">
				<a href="index.php">
					<img src="images/icons/logo-01.png" alt="IMG-LOGO" style="width: 280px; max-height: 70px; object-fit: contain;">
				</a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
					data-notify="
				<?php if (isset($_SESSION['login'])) {
					echo $data_count;
				} else {
					echo "0";
				} ?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<!-- <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a> -->
			</div>

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
						Free shipping for standard order over ₹600
					</div>
				</li>

				<li>
					<div class="right-top-bar flex-w h-full">
						<!-- <a href="#" class="flex-c-m p-lr-13 trans-04">
							Help & FAQs
						</a>

						<a href="#" class="flex-c-m p-lr-13 trans-04">
							INR
						</a> -->

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
							<?php
						} else { ?>
							<a href="login_home.php" class="flex-c-m trans-04 p-lr-25">
								Login / Sign-in
							</a>
							<?php
						} ?>

						<?php if (isset($_SESSION['login'])) { ?>
							<a style="color: #b2b2b2;" class="flex-c-m trans-04 p-lr-15">
								Hello... <?php echo $row_login['name']; ?>!
							</a>
							<?php
						} ?>
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li class="<?php if($current_page == 'index.php') echo 'active-menu-m'; ?>">
					<a href="index.php">Home</a>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li class="<?php if($current_page == 'product.php') echo 'active-menu-m'; ?>">
					<a href="product.php">Shop</a>
					<ul class="sub-menu-m">
						<?php
						$cat_res_m = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1 ORDER BY sequence ASC, id DESC");
						while ($cat_row_m = mysqli_fetch_assoc($cat_res_m)) {
							echo "<li><a href='product.php?cat_name=" . urlencode($cat_row_m['category_name']) . "'>{$cat_row_m['category_name']}</a></li>";
						}
						?>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li class="<?php if($current_page == 'shoping-cart.php') echo 'active-menu-m'; ?>">
					<a href="shoping-cart.php" class="label1 rs1" data-label1="hot">Shopping Cart</a>
				</li>

				<li class="<?php if($current_page == 'blog.php') echo 'active-menu-m'; ?>">
					<a href="blog.php">Blog</a>
				</li>

				<li class="<?php if($current_page == 'about.php') echo 'active-menu-m'; ?>">
					<a href="about.php">About</a>
				</li>

				<li class="<?php if($current_page == 'contact.php') echo 'active-menu-m'; ?>">
					<a href="contact.php">Contact</a>
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
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
		</div>
	</header>

	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<?php if (isset($_SESSION['login'])) {
						while ($row = mysqli_fetch_assoc($data_cart)) { ?>
							<li class="header-cart-item flex-w flex-t m-b-12">
								<div class="header-cart-item-img">
									<img src="admin/image/<?php echo $row['image']; ?>" alt="IMG">
								</div>

								<div class="header-cart-item-txt p-t-8">
									<a href="product-detail.php?detail_id=<?php echo $row['product_id']; ?>"
										class="header-cart-item-name m-b-18 hov-cl1 trans-04">
										<?php echo $row['name']; ?>
									</a>

									<span class="header-cart-item-info">
										<?php echo $row['num_product']; ?> x Rs.<?php echo $row['price']; ?>
									</span>
								</div>
							</li>
							<?php
						}
					} ?>
				</ul>

				<div class="w-full">
					<!-- <div class="header-cart-total w-full p-tb-40">
						Total: Rs.<?php echo $total_price; ?>
					</div> -->

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.php"
							class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							Manage Cart
						</a>

						<a href="order-now.php"
							class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Buy Now
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
