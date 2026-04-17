<?php include_once 'site_connection.php';
include_once 'header.php';

$sql_select_slider = "select * from `slider`";
$data_slider = mysqli_query($conn, $sql_select_slider);

$sql_select_product_bs = "select * from `product` where `tag` like '%Best-seller%' AND `stock`='In Stock'";
$data_product_bs = mysqli_query($conn, $sql_select_product_bs);

$sql_select_product_f = "select * from `product` where `tag` like '%Featured%' AND `stock`='In Stock'";
$data_product_f = mysqli_query($conn, $sql_select_product_f);

$sql_select_product_s = "select * from `product` where `tag` like '%Sale%' AND `stock`='In Stock'";
$data_product_s = mysqli_query($conn, $sql_select_product_s);

$sql_select_product_tr = "select * from `product` where `tag` like '%Top-rate%' AND `stock`='In Stock'";
$data_product_tr = mysqli_query($conn, $sql_select_product_tr);

$sql_select_blog = "select * from `blog`";
$data_blog = mysqli_query($conn, $sql_select_blog);

// Home Banners
$banners_res = mysqli_query($conn, "SELECT * FROM `home_banners` WHERE `status`=1 ORDER BY id DESC");
$home_banners = [];
while($b = mysqli_fetch_assoc($banners_res)) {
    if(!isset($home_banners[$b['position']])) {
        $home_banners[$b['position']] = $b;
    }
}

// Home Benefits
$benefits_res = mysqli_query($conn, "SELECT * FROM `home_benefits` WHERE `status`=1 ORDER BY id ASC LIMIT 3");

// Home Promo
$promo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `home_promo` WHERE `status`=1 LIMIT 1"));

// Home Brands
$brands_res = mysqli_query($conn, "SELECT * FROM `home_brands` WHERE `status`=1 ORDER BY id DESC");

?>

<!-- Slider -->
<section class="section-slide">
	<div class="wrap-slick1">
		<div class="slick1">
			<?php while ($row = mysqli_fetch_assoc($data_slider)) { ?>
				<div class="item-slick1"
					style="background-image: url(admin/image/<?php echo $row['image']; ?>); position: relative; background-size: cover; background-position: center;">
					<!-- Dark Overlay for better text readability -->
					<div
						style="position: absolute; top:0; left:0; width:100%; height:100%; background: linear-gradient(90deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 100%);">
					</div>
					<div class="container h-full" style="position: relative; z-index: 2;">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl0 respon2"
									style="font-family: 'Inter', sans-serif; font-size: 18px; letter-spacing: 2px; text-transform: uppercase; font-weight: 600; color: #fff; text-shadow: 1px 1px 5px rgba(0,0,0,0.3);"><?php echo $row['details']; ?></span>
							</div>
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl0 p-t-19 p-b-43 respon1"
									style="font-family: 'Poppins', sans-serif; font-size: 64px; font-weight: 800; color: #fff; line-height: 1.1; text-shadow: 2px 2px 10px rgba(0,0,0,0.5); text-transform: uppercase;">
									<?php echo $row['title']; ?>
								</h2>
							</div>
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="product.php" class="flex-c-m stext-101 cl0 size-101 trans-04"
									style="background: #EF9C78; color: white; border-radius: 30px; font-weight: 700; font-family: 'Poppins', sans-serif; font-size: 16px; padding: 0 40px; border: none; box-shadow: 0 10px 30px rgba(227,29,26,0.4);"
									onmouseover="this.style.background='#fff'; this.style.color='#EF9C78'; this.style.boxShadow='0 10px 30px rgba(255,255,255,0.4)';"
									onmouseout="this.style.background='#EF9C78'; this.style.color='#fff'; this.style.boxShadow='0 10px 30px rgba(227,29,26,0.4)';">
									Shop Now <i class="zmdi zmdi-arrow-right m-l-10" style="font-size: 20px;"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>


<!-- Banner - Premium Category Cards -->
<style>
	.cat-banner-section {
		padding: 50px 0 60px;
		background: #FEFEFE;
	}

	.cat-banner-section .sec-title {
		text-align: center;
		margin-bottom: 40px;
	}

	.cat-banner-section .sec-title h2 {
		font-family: 'Poppins', sans-serif;
		font-size: 32px;
		font-weight: 800;
		color: #13213B;
		letter-spacing: -0.5px;
		margin-bottom: 8px;
	}

	.cat-banner-section .sec-title p {
		color: #666E7D;
		font-size: 14px;
	}

	/* Grid Layout */
	.cat-banner-grid {
		display: grid;
		grid-template-columns: 1fr 1fr 1fr;
		grid-template-rows: auto auto;
		gap: 20px;
	}

	/* First card spans 2 rows (tall hero) */
	.cat-card-hero {
		grid-column: 1;
		grid-row: 1 / 3;
	}

	.cat-card-sm:first-of-type {
		grid-column: 2;
		grid-row: 1;
	}

	.cat-card-sm:last-of-type {
		grid-column: 2;
		grid-row: 2;
	}

	/* A 3-col narrow strip for silk + work */
	.cat-card-strip {
		grid-column: 3;
		grid-row: 1 / 3;
	}

	/* All cards base */
	.cat-card {
		position: relative;
		border-radius: 18px;
		overflow: hidden;
		box-shadow: 0 8px 25px rgba(0, 0, 0, 0.10);
		cursor: pointer;
		display: block;
		text-decoration: none;
	}

	.cat-card img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		display: block;
		transition: transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
	}

	.cat-card:hover img {
		transform: scale(1.07);
	}

	/* Gradient overlay */
	.cat-card-overlay {
		position: absolute;
		inset: 0;
		background: linear-gradient(0deg, rgba(0, 0, 0, 0.75) 0%, rgba(0, 0, 0, 0.15) 55%, transparent 100%);
		transition: background 0.4s;
	}

	.cat-card:hover .cat-card-overlay {
		background: linear-gradient(0deg, rgba(0, 0, 0, 0.82) 0%, rgba(0, 0, 0, 0.25) 60%, transparent 100%);
	}

	/* Card text */
	.cat-card-body {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		padding: 28px 28px 24px;
	}

	.cat-card-tag {
		display: inline-block;
		background: #EF9C78;
		color: #fff;
		font-family: 'Poppins', sans-serif;
		font-size: 11px;
		font-weight: 700;
		letter-spacing: 1.5px;
		text-transform: uppercase;
		padding: 4px 12px;
		border-radius: 20px;
		margin-bottom: 10px;
	}

	.cat-card-title {
		font-family: 'Poppins', sans-serif;
		font-size: 22px;
		font-weight: 800;
		color: #fff;
		line-height: 1.25;
		margin: 0 0 6px;
		text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
	}

	.cat-card-hero .cat-card-title {
		font-size: 30px;
	}

	.cat-card-sub {
		font-size: 13px;
		color: rgba(255, 255, 255, 0.8);
		margin-bottom: 16px;
	}

	.cat-card-btn {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		background: #fff;
		color: #13213B;
		font-family: 'Poppins', sans-serif;
		font-size: 13px;
		font-weight: 700;
		padding: 9px 20px;
		border-radius: 30px;
		border: none;
		letter-spacing: 0.3px;
		text-decoration: none;
		transition: background 0.3s, color 0.3s, transform 0.3s;
		box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
	}

	.cat-card:hover .cat-card-btn {
		background: #EF9C78;
		color: #fff;
		transform: translateX(4px);
	}

	.cat-card-btn i {
		font-size: 16px;
		transition: transform 0.3s;
	}

	.cat-card:hover .cat-card-btn i {
		transform: translateX(3px);
	}

	/* Fixed heights */
	.cat-card-hero {
		height: 520px;
	}

	.cat-card-sm {
		height: 248px;
	}

	.cat-card-strip {
		height: 520px;
	}

	/* Strip layout: silk + work stacked */
	.cat-strip-inner {
		display: flex;
		flex-direction: column;
		gap: 20px;
		height: 100%;
	}

	.cat-strip-inner .cat-card {
		flex: 1;
		height: auto;
	}

	/* Mobile Responsive */
	@media (max-width: 991px) {
		.cat-banner-grid {
			grid-template-columns: 1fr 1fr;
			grid-template-rows: auto auto auto;
		}

		.cat-card-hero {
			grid-column: 1 / 3;
			grid-row: 1;
			height: 380px;
		}

		.cat-card-sm:first-of-type {
			grid-column: 1;
			grid-row: 2;
			height: 220px;
		}

		.cat-card-sm:last-of-type {
			grid-column: 2;
			grid-row: 2;
			height: 220px;
		}

		.cat-card-strip {
			grid-column: 1 / 3;
			grid-row: 3;
			height: auto;
		}

		.cat-strip-inner {
			flex-direction: row;
			height: 220px;
		}
	}

	@media (max-width: 575px) {
		.cat-banner-grid {
			grid-template-columns: 1fr;
		}

		.cat-card-hero {
			grid-column: 1;
			grid-row: 1;
			height: 300px;
		}

		.cat-card-sm:first-of-type {
			grid-column: 1;
			grid-row: 2;
			height: 200px;
		}

		.cat-card-sm:last-of-type {
			grid-column: 1;
			grid-row: 3;
			height: 200px;
		}

		.cat-card-strip {
			grid-column: 1;
			grid-row: 4;
			height: auto;
		}

		.cat-strip-inner {
			flex-direction: column;
			height: auto;
		}

		.cat-strip-inner .cat-card {
			height: 200px;
		}

		.cat-card-title {
			font-size: 18px;
		}

		.cat-card-hero .cat-card-title {
			font-size: 22px;
		}

		.cat-card-body {
			padding: 18px 18px 16px;
		}
	}
</style>

<div class="cat-banner-section">
	<div class="container">
		<div class="sec-title">
			<h2>Shop by Category</h2>
			<p>Discover our handcrafted fashion collections</p>
		</div>

		<div class="cat-banner-grid">

			<!-- HERO CARD -->
			<?php if(isset($home_banners['hero'])){ $b = $home_banners['hero']; ?>
			<a href="<?php echo $b['link']; ?>" class="cat-card cat-card-hero">
				<img src="images/<?php echo $b['image']; ?>" alt="<?php echo $b['title']; ?>">
				<div class="cat-card-overlay"></div>
				<div class="cat-card-body">
					<span class="cat-card-tag"><?php echo $b['tag']; ?></span>
					<h3 class="cat-card-title"><?php echo $b['title']; ?></h3>
					<p class="cat-card-sub"><?php echo $b['subtitle']; ?></p>
					<span class="cat-card-btn">Shop Now <i class="zmdi zmdi-arrow-right"></i></span>
				</div>
			</a>
			<?php } ?>

			<!-- SMALL CARD 1 -->
			<?php if(isset($home_banners['sm1'])){ $b = $home_banners['sm1']; ?>
			<a href="<?php echo $b['link']; ?>" class="cat-card cat-card-sm">
				<img src="images/<?php echo $b['image']; ?>" alt="<?php echo $b['title']; ?>">
				<div class="cat-card-overlay"></div>
				<div class="cat-card-body">
					<span class="cat-card-tag"><?php echo $b['tag']; ?></span>
					<h3 class="cat-card-title"><?php echo $b['title']; ?></h3>
					<p class="cat-card-sub"><?php echo $b['subtitle']; ?></p>
					<span class="cat-card-btn">Shop Now <i class="zmdi zmdi-arrow-right"></i></span>
				</div>
			</a>
			<?php } ?>

			<!-- SMALL CARD 2 -->
			<?php if(isset($home_banners['sm2'])){ $b = $home_banners['sm2']; ?>
			<a href="<?php echo $b['link']; ?>" class="cat-card cat-card-sm">
				<img src="images/<?php echo $b['image']; ?>" alt="<?php echo $b['title']; ?>">
				<div class="cat-card-overlay"></div>
				<div class="cat-card-body">
					<span class="cat-card-tag"><?php echo $b['tag']; ?></span>
					<h3 class="cat-card-title"><?php echo $b['title']; ?></h3>
					<p class="cat-card-sub"><?php echo $b['subtitle']; ?></p>
					<span class="cat-card-btn">Shop Now <i class="zmdi zmdi-arrow-right"></i></span>
				</div>
			</a>
			<?php } ?>

			<!-- STRIP: Silk + Work stacked -->
			<div class="cat-card-strip">
				<div class="cat-strip-inner">
					<?php if(isset($home_banners['strip1'])){ $b = $home_banners['strip1']; ?>
					<a href="<?php echo $b['link']; ?>" class="cat-card">
						<img src="images/<?php echo $b['image']; ?>" alt="<?php echo $b['title']; ?>">
						<div class="cat-card-overlay"></div>
						<div class="cat-card-body">
							<span class="cat-card-tag"><?php echo $b['tag']; ?></span>
							<h3 class="cat-card-title"><?php echo $b['title']; ?></h3>
							<p class="cat-card-sub"><?php echo $b['subtitle']; ?></p>
							<span class="cat-card-btn">Shop Now <i class="zmdi zmdi-arrow-right"></i></span>
						</div>
					</a>
					<?php } ?>

					<?php if(isset($home_banners['strip2'])){ $b = $home_banners['strip2']; ?>
					<a href="<?php echo $b['link']; ?>" class="cat-card">
						<img src="images/<?php echo $b['image']; ?>" alt="<?php echo $b['title']; ?>">
						<div class="cat-card-overlay"></div>
						<div class="cat-card-body">
							<span class="cat-card-tag"><?php echo $b['tag']; ?></span>
							<h3 class="cat-card-title"><?php echo $b['title']; ?></h3>
							<p class="cat-card-sub"><?php echo $b['subtitle']; ?></p>
							<span class="cat-card-btn">Shop Now <i class="zmdi zmdi-arrow-right"></i></span>
						</div>
					</a>
					<?php } ?>
				</div>
			</div>

		</div><!-- .cat-banner-grid -->
	</div>
</div>


<!-- Product -->
<section class="sec-product p-t-20 p-b-50" style="background: #fff;">
	<div class="container">
		<div class="p-b-50 text-center premium-animate">
			<h3
				style="font-family: 'Poppins', sans-serif; font-size: 36px; font-weight: 800; color: #13213B; letter-spacing: -0.5px;">
				Our Selection
			</h3>
			<p style="color: #666E7D; font-size: 14px; margin-top: 8px;">Handpicked products from our finest collections
			</p>
		</div>

		<!-- Tab01 -->
		<div class="tab01">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs justify-content-center" role="tablist" style="border-bottom: none; gap: 15px;">
				<li class="nav-item p-b-10">
					<a class="nav-link active premium-tab" data-toggle="tab" href="#Best-seller" role="tab">Best
						Seller</a>
				</li>

				<li class="nav-item p-b-10">
					<a class="nav-link premium-tab" data-toggle="tab" href="#Featured" role="tab">Featured</a>
				</li>

				<li class="nav-item p-b-10">
					<a class="nav-link premium-tab" data-toggle="tab" href="#Sale" role="tab">Sale</a>
				</li>

				<li class="nav-item p-b-10">
					<a class="nav-link premium-tab" data-toggle="tab" href="#Top-rate" role="tab">Top Rate</a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content p-t-40">
				<style>
					.premium-tab {
						font-family: 'Poppins', sans-serif;
						font-weight: 600;
						color: #666 !important;
						border-radius: 30px !important;
						padding: 8px 25px !important;
						border: 1px solid #ddd !important;
						background: #fff;
						transition: all 0.3s ease;
					}

					.premium-tab:hover {
						border-color: #EF9C78 !important;
						color: #EF9C78 !important;
					}

					.premium-tab.active {
						background: #EF9C78 !important;
						color: #fff !important;
						border-color: #EF9C78 !important;
						box-shadow: 0 4px 15px rgba(239, 156, 120, 0.3);
					}
				</style>
				<!-- - -->
				<div class="tab-pane fade show active" id="Best-seller" role="tabpanel">
					<!-- Slide2 -->
					<div class="wrap-slick2">
						<div class="slick2">


							<?php while ($row = mysqli_fetch_assoc($data_product_bs)) { ?>

								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

											<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												Quick View
											</a> -->
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>"
													class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?php echo $row['name']; ?>
												</a>

												<span class="stext-105 cl3">
													Rs.<?php echo $row['price']; ?>
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" 
													data-id="<?php echo $row['id']; ?>" 
													data-name="<?php echo $row['name']; ?>" 
													data-price="<?php echo $row['price']; ?>" 
													data-image="admin/image/<?php echo $row['image1']; ?>">
													<img class="icon-heart1 dis-block trans-04"
														src="images/icons/icon-heart-01.png" alt="ICON">
													<img class="icon-heart2 dis-block trans-04 ab-t-l"
														src="images/icons/icon-heart-02.png" alt="ICON">
												</a>
											</div>
										</div>
									</div>
								</div>

							<?php } ?>

						</div>
					</div>
				</div>

				<!-- - -->
				<div class="tab-pane fade" id="Featured" role="tabpanel">
					<!-- Slide2 -->
					<div class="wrap-slick2">
						<div class="slick2">

							<?php while ($row = mysqli_fetch_assoc($data_product_f)) { ?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

											<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												Quick View
											</a> -->
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>"
													class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?php echo $row['name']; ?>
												</a>

												<span class="stext-105 cl3">
													Rs.<?php echo $row['price']; ?>
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" 
													data-id="<?php echo $row['id']; ?>" 
													data-name="<?php echo $row['name']; ?>" 
													data-price="<?php echo $row['price']; ?>" 
													data-image="admin/image/<?php echo $row['image1']; ?>">
													<img class="icon-heart1 dis-block trans-04"
														src="images/icons/icon-heart-01.png" alt="ICON">
													<img class="icon-heart2 dis-block trans-04 ab-t-l"
														src="images/icons/icon-heart-02.png" alt="ICON">
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>

				<!-- - -->
				<div class="tab-pane fade" id="Sale" role="tabpanel">
					<!-- Slide2 -->
					<div class="wrap-slick2">
						<div class="slick2">

							<?php while ($row = mysqli_fetch_assoc($data_product_s)) { ?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

											<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												Quick View
											</a> -->
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>"
													class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?php echo $row['name']; ?>
												</a>

												<span class="stext-105 cl3">
													Rs.<?php echo $row['price']; ?>
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" 
													data-id="<?php echo $row['id']; ?>" 
													data-name="<?php echo $row['name']; ?>" 
													data-price="<?php echo $row['price']; ?>" 
													data-image="admin/image/<?php echo $row['image1']; ?>">
													<img class="icon-heart1 dis-block trans-04"
														src="images/icons/icon-heart-01.png" alt="ICON">
													<img class="icon-heart2 dis-block trans-04 ab-t-l"
														src="images/icons/icon-heart-02.png" alt="ICON">
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>

						</div>
					</div>
				</div>

				<!-- - -->
				<div class="tab-pane fade" id="Top-rate" role="tabpanel">
					<!-- Slide2 -->
					<div class="wrap-slick2">
						<div class="slick2">

							<?php while ($row = mysqli_fetch_assoc($data_product_tr)) { ?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

											<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												Quick View
											</a> -->
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>"
													class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?php echo $row['name']; ?>
												</a>

												<span class="stext-105 cl3">
													Rs.<?php echo $row['price']; ?>
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2" 
													data-id="<?php echo $row['id']; ?>" 
													data-name="<?php echo $row['name']; ?>" 
													data-price="<?php echo $row['price']; ?>" 
													data-image="admin/image/<?php echo $row['image1']; ?>">
													<img class="icon-heart1 dis-block trans-04"
														src="images/icons/icon-heart-01.png" alt="ICON">
													<img class="icon-heart2 dis-block trans-04 ab-t-l"
														src="images/icons/icon-heart-02.png" alt="ICON">
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Load more -->
	<div class="flex-c-m flex-w w-full p-t-10">
		<a href="product.php" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
			Load All Products
		</a>
	</div>
</section>

<!-- Our Benefits -->
<section class="p-t-20 p-b-40" style="background-color: #fff;">
	<div class="container">
		<h3
			style="font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; color: #13213B; margin-bottom: 25px; border-bottom: 2px solid #EF9C78; display: inline-block; padding-bottom: 6px;">
			Our Benefits</h3>
		<div class="row">
			<?php while($ben = mysqli_fetch_assoc($benefits_res)){ ?>
			<!-- Benefit -->
			<div class="col-md-4 p-b-20">
				<div style="background: #fff0f0; border-radius: 10px; padding: 20px; display: flex; align-items: center; gap: 18px; transition: transform 0.3s;"
					onmouseover="this.style.transform='translateY(-5px)'"
					onmouseout="this.style.transform='translateY(0)'">
					<div
						style="width: 55px; height: 55px; background: #EF9C78; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0; box-shadow: 0 4px 10px rgba(227,29,26,0.2);">
						<i class="<?php echo $ben['icon']; ?>"></i>
					</div>
					<div>
						<h4
							style="font-family: 'Inter', sans-serif; font-weight: 700; font-size: 15px; color: #13213B; margin-bottom: 4px;">
							<?php echo $ben['title']; ?></h4>
						<p style="font-family: 'Inter', sans-serif; font-size: 13px; color: #666E7D; margin: 0;"><?php echo $ben['subtitle']; ?></p>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>

<!-- Watches Promo Banner -->
<div class="container p-b-60">
	<?php if($promo){ ?>
	<div class="promo-banner-peach"
		style="background: linear-gradient(135deg, var(--primary-color), var(--accent-color)); border-radius: var(--border-radius); padding: 50px 70px; display: flex; justify-content: space-between; align-items: center; position: relative; overflow: hidden; box-shadow: var(--premium-shadow);">
		<div style="position: relative; z-index: 2; border-left: 4px solid var(--accent-color); padding-left: 25px;">
			<h3
				style="color: #fff !important; font-family: 'Poppins', sans-serif; font-weight: 400; font-size: 24px; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 2px; display: block !important;">
				<?php echo $promo['heading1']; ?></h3>
			<h2
				style="color: #fff !important; font-family: 'Poppins', sans-serif; font-weight: 900; font-size: 52px; letter-spacing: -2px; line-height: 1.1; display: block !important;">
				<?php echo $promo['heading2']; ?></h2>
			<p style="color: #fff !important; font-family: 'Poppins', sans-serif; font-weight: 300; font-size: 32px; letter-spacing: -1px; margin-top: 10px;">
				<?php echo $promo['subheading']; ?></p>
		</div>
		<!-- Subtle background watch icon -->
		<i class="<?php echo $promo['icon']; ?>"
			style="font-size: 280px; color: rgba(255,255,255,0.1); position: absolute; right: -5%; top: 50%; transform: translateY(-50%); z-index: 1;"></i>
		<a href="<?php echo $promo['link']; ?>"
			style="position: relative; z-index: 2; background: #fff; color: var(--primary-color); padding: 15px 40px; font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 15px; border-radius: 30px; text-transform: uppercase; letter-spacing: 1px; transition: var(--transition-smooth);"
			onmouseover="this.style.background=var(--accent-color); this.style.color='#fff'; this.style.transform='scale(1.05)';"
			onmouseout="this.style.background='#fff'; this.style.color=var(--primary-color); this.style.transform='scale(1)';"
            class="hov-btn1">Shop Selection</a>
	</div>
	<?php } ?>
</div>

<!-- Featured Brands section -->
<section class="p-b-60 bg0">
	<div class="container">
		<h3
			style="font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 700; color: #13213B; margin-bottom: 25px; border-bottom: 2px solid #EF9C78; display: inline-block; padding-bottom: 6px;">
			Featured Brands</h3>
		<div class="row">
			<?php while($brand = mysqli_fetch_assoc($brands_res)){ ?>
			<!-- Brand -->
			<div class="col-6 col-md-3 p-b-30">
				<div style="border-radius: 12px; overflow: hidden; position: relative; height: 380px; box-shadow: 0 10px 20px rgba(0,0,0,0.05);"
					class="hov-img0">
					<img src="images/<?php echo $brand['image']; ?>" alt="Brand" style="width: 100%; height: 100%; object-fit: cover;">
					<div
						style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 40px 20px 20px; background: linear-gradient(transparent, rgba(0,0,0,0.8)); text-align: center;">
						<h4
							style="color: white; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 28px; letter-spacing: -1px;">
							<?php echo $brand['name']; ?></h4>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>

<!-- Edge Banner -->
<div class="container p-b-80">
	<div
		style="background: #faece5; border-radius: 10px; padding: 25px 40px; display: flex; align-items: center; gap: 40px; flex-wrap: wrap; justify-content: center; position: relative; border-bottom: 4px solid #f2cfc0;">
		<div style="text-align: center; flex-shrink: 0;">
			<h2
				style="font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 800; color: #13213B; line-height: 1; letter-spacing: 1px;">
				LIFESTYLE<br><span style="font-weight: 300;">EDGE</span></h2>
		</div>
		<div class="dis-none-sm" style="width: 1px; height: 50px; background: rgba(0,0,0,0.1);"></div>
		<div style="display: flex; align-items: center; gap: 15px;">
			<div
				style="width: 50px; height: 50px; border-radius: 50%; background: transparent; border: 1px solid #c9b0a3; display: flex; align-items: center; justify-content: center; color: #13213B; font-size: 22px;">
				<i class="zmdi zmdi-truck"></i>
			</div>
			<div>
				<h4 style="font-family: 'Inter', sans-serif; font-weight: 700; font-size: 15px; color: #13213B;">Free
					Delivery</h4>
				<p style="font-size: 13px; color: #555; margin: 0;">On all orders, for 365 days</p>
			</div>
		</div>
		<div style="display: flex; align-items: center; gap: 15px;">
			<div
				style="width: 50px; height: 50px; border-radius: 50%; background: transparent; border: 1px solid #c9b0a3; display: flex; align-items: center; justify-content: center; color: #13213B; font-size: 22px;">
				<i class="zmdi zmdi-ticket-star"></i>
			</div>
			<div>
				<p style="font-size: 12px; color: #555; margin: 0; line-height: 1.2;">Welcome Voucher</p>
				<h4 style="font-family: 'Inter', sans-serif; font-weight: 700; font-size: 15px; color: #13213B;">Benefits
					Worth ₹2000+</h4>
			</div>
		</div>

		<div
			style="width: 100%; text-align: center; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 10px; margin-top: 10px;">
			<p style="font-size: 11px; color: #555; font-weight: 600;">Get Extra ₹250 Off on your first order</p>
		</div>
	</div>
</div>

<!-- Awesome Blog Section Redesign -->
<section class="sec-blog bg0 p-t-60 p-b-90" style="background:#fcfcfc; border-top: 1px solid #eee;">
	<div class="container">
		<div class="p-b-50 text-center">
			<h3
				style="font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 32px; color: #13213B; letter-spacing: -0.5px;">
				Latest on the Blog</h3>
			<div style="width: 60px; height: 3px; background: #EF9C78; margin: 15px auto 10px;"></div>
			<p style="color: #666; font-size: 15px;">Style guides, fresh looks and fashion tips</p>
		</div>

		<div class="row">
			<?php $count = 0;
			while ($row = mysqli_fetch_assoc($data_blog)) { ?>
				<div class="col-sm-6 col-md-4 p-b-40">
					<article
						style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #eee; transition: all 0.3s; height: 100%; display: flex; flex-direction: column;"
						onmouseover="this.style.boxShadow='0 15px 35px rgba(0,0,0,0.08)'; this.style.transform='translateY(-5px)';"
						onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)';">
						<!-- Blog Image -->
						<div style="height: 240px; overflow: hidden; position: relative;">
							<a href="blog-detail.php?detail_id=<?php echo $row['id']; ?>"
								style="display: block; width: 100%; height: 100%;">
								<img src="admin/image/<?php echo $row['image']; ?>" alt="Blog"
									style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s;"
									onmouseover="this.style.transform='scale(1.08)'"
									onmouseout="this.style.transform='scale(1)'">
							</a>
							<!-- Date Badge -->
							<div
								style="position: absolute; top: 15px; left: 15px; background: #fff; padding: 6px 12px; border-radius: 6px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center;">
								<span
									style="display: block; font-family: 'Poppins', sans-serif; font-weight: 800; font-size: 18px; color: #13213B; line-height: 1;"><?php echo $row['day']; ?></span>
								<span
									style="display: block; font-size: 11px; font-weight: 600; color: #EF9C78; text-transform: uppercase; margin-top: 3px;"><?php echo $row['month']; ?></span>
							</div>
						</div>

						<!-- Blog Content -->
						<div style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column;">
							<div style="margin-bottom: 15px;">
								<span
									style="background: #fff0f0; color: #EF9C78; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.5px;"><?php echo $row['tag']; ?></span>
							</div>

							<h4 style="margin-bottom: 12px;">
								<a href="blog-detail.php?detail_id=<?php echo $row['id']; ?>"
									style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 20px; color: #13213B; line-height: 1.4; transition: color 0.3s;"
									onmouseover="this.style.color='#EF9C78'" onmouseout="this.style.color='#13213B'">
									<?php echo $row['title']; ?>
								</a>
							</h4>

							<p style="color: #666; font-size: 14px; line-height: 1.7; flex-grow: 1;">
								<?php echo substr($row['short_detail'], 0, 90) . '...'; ?>
							</p>

							<div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #f2f2f2;">
								<a href="blog-detail.php?detail_id=<?php echo $row['id']; ?>"
									style="display: inline-flex; align-items: center; gap: 8px; font-family: 'Inter', sans-serif; font-weight: 700; font-size: 13px; color: #13213B; text-transform: uppercase; letter-spacing: 0.5px; transition: color 0.3s;"
									onmouseover="this.style.color='#EF9C78'" onmouseout="this.style.color='#13213B'">
									Read Article <i class="fa fa-long-arrow-right"></i>
								</a>
							</div>
						</div>
					</article>
				</div>
				<?php
				$count++;
				if ($count == 3) {
					break;
				}
			} ?>
		</div>

		<!-- Load more button -->
		<div class="flex-c-m flex-w w-full p-t-30">
			<a href="blog.php" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
				View All Blogs
			</a>
		</div>
	</div>
</section>


	<!-- Premium Trust Section -->
	<section class="trust-section p-t-30 p-b-30" style="background: linear-gradient(180deg, #F8FAFC 0%, #fff 100%);">
		<div class="container text-center">
			<h2 class="ltext-105 p-b-15">Why Shop With Us?</h2>
			<p class="stext-113 cl6 p-b-50">Experience the difference of premium quality and dedicated service.</p>
			
			<div class="row">
				<div class="col-md-4 p-b-30">
					<div class="glass-card p-t-45 p-b-40 p-lr-30 h-full trans-04">
						<div class="fs-40 cl1 p-b-20" style="color: var(--accent-color) !important;"><i class="zmdi zmdi-truck"></i></div>
						<h4 class="mtext-108 p-b-15">Express Delivery</h4>
						<p class="stext-102 cl3">Fast and reliable shipping to your doorstep, handled with care.</p>
					</div>
				</div>
				
				<div class="col-md-4 p-b-30">
					<div class="glass-card p-t-45 p-b-40 p-lr-30 h-full trans-04">
						<div class="fs-40 cl1 p-b-20" style="color: var(--accent-color) !important;"><i class="zmdi zmdi-star"></i></div>
						<h4 class="mtext-108 p-b-15">Premium Quality</h4>
						<p class="stext-102 cl3">Curated fashion collections made from the finest materials.</p>
					</div>
				</div>
				
				<div class="col-md-4 p-b-30">
					<div class="glass-card p-t-45 p-b-40 p-lr-30 h-full trans-04">
						<div class="fs-40 cl1 p-b-20" style="color: var(--accent-color) !important;"><i class="zmdi zmdi-lock"></i></div>
						<h4 class="mtext-108 p-b-15">Secure Payments</h4>
						<p class="stext-102 cl3">Your transactions are protected with state-of-the-art security.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<style>
		.hov-translate-up:hover {
			transform: translateY(-10px);
		}
	</style>

	<?php include_once 'footer.php'; ?>


<!-- Modal1 -->
<!-- <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>
							

							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>	
							</div>


							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->


<?php include_once 'scripts.php'; ?>
