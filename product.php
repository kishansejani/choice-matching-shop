<?php include_once 'site_connection.php'; ?>

<?php include_once 'header.php'; ?>

<?php

$_SESSION['short'] = 'default';

function filter_url($params) {
    $current = $_GET;
    foreach($params as $k => $v) {
        if($v === null) unset($current[$k]);
        else $current[$k] = $v;
    }
    return 'product.php?' . http_build_query($current);
}

$where = "WHERE `stock` = 'In Stock' ";

if (isset($_GET['cat_name']) && $_GET['cat_name'] != '') {
    $cat_name = mysqli_real_escape_string($conn, $_GET['cat_name']);
    $where .= " AND `category` = '$cat_name' ";
}

if (isset($_GET['size']) && $_GET['size'] != '') {
    $size = mysqli_real_escape_string($conn, $_GET['size']);
    $where .= " AND `size` LIKE '%$size%' ";
}

if (isset($_GET['min_price']) && isset($_GET['max_price'])) {
    $min = (int)$_GET['min_price'];
    $max = (int)$_GET['max_price'];
    if($max > 0) {
        $where .= " AND `price` BETWEEN $min AND $max ";
    }
}


$sql_select_data = "select * from `product` $where";
$data_data = mysqli_query($conn, $sql_select_data);
$data_count = mysqli_num_rows($data_data);

$limit = 8;
$page_count = ceil($data_count / $limit);

if (isset($_GET['all_pro_p_id'])) {
	$page_no = $_GET['all_pro_p_id'];
} else {
	$page_no = 1;
}

$start = ($page_no - 1) * $limit;

$previous = $page_no - 1;
$next = $page_no + 1;


if (isset($_SESSION['short'])) {
	if ($_SESSION['short'] == 'default') {
		$sql_select = "select * from `product` $where limit $start,$limit";
		$data = mysqli_query($conn, $sql_select);
	}
	if ($_SESSION['short'] == 'newness') {
		$sql_select = "select * from `product` $where order by `id` asc limit $start,$limit";
		$data = mysqli_query($conn, $sql_select);
	}
	if ($_SESSION['short'] == 'low_high') {
		$sql_select = "select * from `product` $where order by `price` asc limit $start,$limit";
		$data = mysqli_query($conn, $sql_select);
	}
	if ($_SESSION['short'] == 'high_low') {
		$sql_select = "select * from `product` $where order by `price` desc limit $start,$limit";
		$data = mysqli_query($conn, $sql_select);
	}

}


if (isset($_GET['search_product'])) {
	$search_pro = $_GET['search_product'];


	$sql_select_data = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%')";
	$data_data = mysqli_query($conn, $sql_select_data);
	$data_count = mysqli_num_rows($data_data);

	$limit = 8;
	$page_count_s = ceil($data_count / $limit);

	if (isset($_GET['all_pro_p_id_s'])) {
		$page_no = $_GET['all_pro_p_id_s'];
	} else {
		$page_no = 1;
	}

	$start = ($page_no - 1) * $limit;

	if (isset($_SESSION['short'])) {
		if ($_SESSION['short'] == 'default') {
			$sql_select = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%') order by `id` asc limit $start,$limit";
			$data = mysqli_query($conn, $sql_select);
		}
		if ($_SESSION['short'] == 'newness') {
			$sql_select = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%') order by `price` asc limit $start,$limit";
			$data = mysqli_query($conn, $sql_select);
		}
		if ($_SESSION['short'] == 'low_high') {
			$sql_select = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%') limit $start,$limit";
			$data = mysqli_query($conn, $sql_select);
		}
		if ($_SESSION['short'] == 'high_low') {
			$sql_select = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%') order by `price` desc limit $start,$limit";
			$data = mysqli_query($conn, $sql_select);
		}
	}

	$previous = $page_no - 1;
	$next = $page_no + 1;

}

?>

<!-- Page Hero -->
<section style="background:#f8f8f8; border-bottom:1px solid #eee; padding:50px 0;">
	<div class="container text-center">
		<p
			style="color:#EF9C78; font-family:'Poppins',sans-serif; font-weight:700; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:12px;">
			CHOICE MATCHING</p>
		<h1
			style="font-family:'Poppins',sans-serif; font-weight:800; font-size:38px; color:#13213B; letter-spacing:-0.5px; margin-bottom:16px;">
			All Products</h1>
		<p style="color:#666E7D; font-size:15px; margin-bottom:30px;"><?php echo $data_count; ?> items available in our
			collection</p>

		<!-- Category Pills -->
		<div class="category-nav-wrapper">
			<a href="<?php echo filter_url(['cat_name'=>null]); ?>" class="category-nav-link <?php echo !isset($_GET['cat_name']) ? 'active' : ''; ?>">All Products</a>
			<?php
			$p_cat_res = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1 ORDER BY sequence ASC, id DESC");
			while ($p_cat = mysqli_fetch_assoc($p_cat_res)) {
				$active = (isset($_GET['cat_name']) && $_GET['cat_name'] == $p_cat['category_name']) ? 'active' : '';
				echo "<a href='".filter_url(['cat_name'=>$p_cat['category_name']])."' class='category-nav-link $active'>{$p_cat['category_name']}</a>";
			}
			?>
		</div>
	</div>
</section>

<!-- Product Section -->
<div style="background:#fff; padding: 50px 0 100px;">
	<div class="container">

		<!-- Toolbar: Sort + Search -->
		<div
			style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-bottom:40px; padding:20px 24px; background:#f8f8f8; border-radius:12px; border:1px solid #eee;">

			<!-- Sort By -->
			<div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
				<span
					style="font-size:13px; font-weight:700; color:#555; text-transform:uppercase; letter-spacing:0.5px;">Sort:</span>
				<?php if (isset($_GET['search_product'])) { ?>
						<a href="product.php?search_product=<?php echo $search_pro; ?>" id="default_s"
							class="filter-link<?php if ($_SESSION['short'] == 'default')
								echo ' filter-link-active'; ?>"
							style="font-size:13px; padding:8px 16px; border-radius:6px; border:1px solid #ddd; background:#fff; color:#555; cursor:pointer;">Default</a>
						<a href="javascript:void(0)" attr_id="short" attr_id_s="<?php echo $search_pro; ?>" id="newness_s"
							class="filter-link"
							style="font-size:13px; padding:8px 16px; border-radius:6px; border:1px solid #ddd; background:#fff; color:#555; cursor:pointer;">Newest</a>
						<a href="javascript:void(0)" attr_id="short" attr_id_s="<?php echo $search_pro; ?>" id="low_high_s"
							class="filter-link low_high_active"
							style="font-size:13px; padding:8px 16px; border-radius:6px; border:1px solid #ddd; background:#fff; color:#555; cursor:pointer;">Price
							↑</a>
						<a href="javascript:void(0)" attr_id="short" attr_id_s="<?php echo $search_pro; ?>" id="high_low_s"
							class="filter-link"
							style="font-size:13px; padding:8px 16px; border-radius:6px; border:1px solid #ddd; background:#fff; color:#555; cursor:pointer;">Price
							↓</a>
				<?php } else { ?>
						<a href="product.php" id="default"
							class="filter-link<?php if ($_SESSION['short'] == 'default')
								echo ' filter-link-active'; ?>"
							style="font-size:13px; padding:8px 16px; border-radius:6px; border:1px solid #ddd; background:#fff; color:#555;">Default</a>
						<a href="javascript:void(0)" attr_id="short" id="newness" class="filter-link"
							style="font-size:13px; padding:8px 16px; border-radius:6px; border:1px solid #ddd; background:#fff; color:#555; cursor:pointer;">Newest</a>
						<a href="javascript:void(0)" attr_id="short" id="low_high" class="filter-link low_high_active"
							style="font-size:13px; padding:8px 16px; border-radius:6px; border:1px solid #ddd; background:#fff; color:#555; cursor:pointer;">Price
							↑</a>
						<a href="javascript:void(0)" attr_id="short" id="high_low" class="filter-link"
							style="font-size:13px; padding:8px 16px; border-radius:6px; border:1px solid #ddd; background:#fff; color:#555; cursor:pointer;">Price
							↓</a>
				<?php } ?>
			</div>

			<!-- Filter Buttons -->
			<div style="display:flex; gap:10px;">
				<button class="js-show-filter" style="background:#13213B; color:#fff; border:none; padding:10px 20px; border-radius:8px; cursor:pointer; font-size:14px; display:flex; align-items:center; gap:8px;">
					<i class="zmdi zmdi-filter-list"></i> Filter
				</button>
				
				<form method="get" style="display:flex; gap:0;">
					<input type="text" name="search_product" id="search_product_text"
						value="<?php echo isset($_GET['search_product']) ? htmlspecialchars($_GET['search_product']) : ''; ?>"
						placeholder="Search products..." class="search-product"
						style="padding:10px 18px; border:1px solid #ddd; border-right:none; border-radius:8px 0 0 8px; font-size:14px; outline:none; min-width:220px;">
					<button type="submit"
						style="background:#EF9C78; color:#fff; border:none; padding:10px 18px; border-radius:0 8px 8px 0; cursor:pointer; font-size:16px;">
						<i class="zmdi zmdi-search"></i>
					</button>
				</form>
			</div>
		</div>

		<!-- Filter Section -->
		<div class="dis-none panel-filter w-full p-t-10" style="background: #f9f9f9; border-radius: 12px; margin-bottom: 30px; padding: 30px; border: 1px solid #eee;">
			<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
				<div class="filter-col1 p-r-15 p-b-27" style="flex: 1; min-width: 200px;">
					<div class="mtext-102 cl2 p-b-15" style="font-weight: 700; color: #13213B; margin-bottom: 15px; font-size: 16px;">Price Range</div>
					<ul>
						<li class="p-b-6"><a href="<?php echo filter_url(['min_price'=>null, 'max_price'=>null]); ?>" class="filter-link stext-106 trans-04">All Prices</a></li>
						<li class="p-b-6"><a href="<?php echo filter_url(['min_price'=>0, 'max_price'=>500]); ?>" class="filter-link stext-106 trans-04">₹0 - ₹500</a></li>
						<li class="p-b-6"><a href="<?php echo filter_url(['min_price'=>500, 'max_price'=>1000]); ?>" class="filter-link stext-106 trans-04">₹500 - ₹1000</a></li>
						<li class="p-b-6"><a href="<?php echo filter_url(['min_price'=>1000, 'max_price'=>2000]); ?>" class="filter-link stext-106 trans-04">₹1000 - ₹2000</a></li>
						<li class="p-b-6"><a href="<?php echo filter_url(['min_price'=>2000, 'max_price'=>5000]); ?>" class="filter-link stext-106 trans-04">₹2000 - ₹5000</a></li>
					</ul>
				</div>

				<div class="filter-col2 p-r-15 p-b-27" style="flex: 1; min-width: 200px;">
					<div class="mtext-102 cl2 p-b-15" style="font-weight: 700; color: #13213B; margin-bottom: 15px; font-size: 16px;">Available Sizes</div>
					<ul>
						<li class="p-b-6"><a href="<?php echo filter_url(['size'=>null]); ?>" class="filter-link stext-106 trans-04">All Sizes</a></li>
						<?php
						$sz_q = mysqli_query($conn, "SELECT * FROM `size` WHERE status=1 ORDER BY sequence ASC");
						while($sz = mysqli_fetch_assoc($sz_q)){
							echo "<li class='p-b-6'><a href='".filter_url(['size'=>$sz['size_name']])."' class='filter-link stext-106 trans-04'>{$sz['size_name']}</a></li>";
						}
						?>
					</ul>
				</div>

				<div class="filter-col3 p-b-27" style="flex: 1; min-width: 200px;">
					<div class="mtext-102 cl2 p-b-15" style="font-weight: 700; color: #13213B; margin-bottom: 15px; font-size: 16px;">Fast Filters</div>
					<div class="flex-w p-t-4 m-r--5">
						<a href="product.php" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5" style="border: 1px solid #ddd; border-radius: 20px; padding: 5px 15px; font-size: 12px;">Clear All Filters</a>
					</div>
				</div>
			</div>
		</div>

		<?php if (isset($_GET['search_product'])): ?>
				<p style="color:#666E7D; font-size:14px; margin-bottom:30px;">Showing results for: <strong
						style="color:#13213B;">"<?php echo htmlspecialchars($_GET['search_product']); ?>"</strong> &mdash;
					<?php echo $data_count; ?> products found</p>
		<?php endif; ?>

		<!-- products -->

		<div id="all_product_page_change_data">
			<div class="row isotope-grid">

				<?php while ($row = mysqli_fetch_assoc($data)) { ?>
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
							<div class="block2">
								<div class="block2-pic hov-img0">
									<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

									<!-- <a href="javascript:void(0)" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 quick_view" attr_id="<?php echo $row['id']; ?>">
								Quick View
							</a> -->
								</div>

								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>"
											class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											<?php echo $row['name']; ?>
											<?php if (isset($_GET['search_product'])) { ?>
													<input type="hidden" name="search_txt"
														value="<?php echo $_GET['search_product']; ?>" id="srch_txt">
											<?php } ?>

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
											<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png"
												alt="ICON">
											<img class="icon-heart2 dis-block trans-04 ab-t-l"
												src="images/icons/icon-heart-02.png" alt="ICON">
										</a>
									</div>
								</div>
							</div>
						</div>
				<?php } ?>
			</div>

			<!-- Pagination -->

			<div class="flex-l-m flex-w w-full p-t-10 m-lr--7">


				<?php if (isset($_GET['search_product'])) {
					if ($page_no > 1) { ?>
								<a href="javascript:void(0)"
									class="flex-c-m how-pagination1 trans-04 m-all-7 search_product_page_change" attr_id=<?php echo $previous; ?> style="font-size: 13px;">
									Pre
								</a>
						<?php }
				} else {
					if ($page_no > 1) { ?>
								<a href="javascript:void(0)" class="flex-c-m how-pagination1 trans-04 m-all-7 all_product_page_change"
									attr_id=<?php echo $previous; ?> style="font-size: 13px;">
									Pre
								</a>
						<?php }
				} ?>

				<?php
				if (isset($_GET['search_product'])) {
					for ($i = 1; $i <= $page_count_s; $i++) { ?>
								<a href="javascript:void(0)" class="flex-c-m how-pagination1 trans-04 m-all-7 
								<?php
								if (isset($_GET['all_pro_p_id_s'])) {
									if ($_GET['all_pro_p_id_s'] == $i) {
										echo "active-pagination1";
									} else {
										echo "";
									}
								} else {
									if ($i == 1) {
										echo "active-pagination1";
									}
								} ?> search_product_page_change" attr_id=<?php echo $i; ?>>
									<?php echo $i; ?>
								</a>
						<?php }
				} else {
					for ($i = 1; $i <= $page_count; $i++) { ?>
								<a href="javascript:void(0)" class="flex-c-m how-pagination1 trans-04 m-all-7 
								<?php
								if (isset($_GET['all_pro_p_id'])) {
									if ($_GET['all_pro_p_id'] == $i) {
										echo "active-pagination1";
									} else {
										echo "";
									}
								} else {
									if ($i == 1) {
										echo "active-pagination1";
									}
								} ?> all_product_page_change" attr_id=<?php echo $i; ?>>
									<?php echo $i; ?>
								</a>
						<?php }
				} ?>


				<?php if (isset($_GET['search_product'])) {
					if ($page_no < $page_count_s) { ?>
								<a href="javascript:void(0)"
									class="flex-c-m how-pagination1 trans-04 m-all-7 search_product_page_change" attr_id=<?php echo $next; ?> style="font-size: 13px;">
									Next
								</a>
						<?php }
				} else {
					if ($page_no < $page_count) { ?>
								<a href="javascript:void(0)" class="flex-c-m how-pagination1 trans-04 m-all-7 all_product_page_change"
									attr_id=<?php echo $next; ?> style="font-size: 13px;">
									Next
								</a>
						<?php }
				} ?>

			</div>
		</div>
	</div> <!-- end id=all_product_page_change_data -->
</div> <!-- end container -->
</div> <!-- end product section -->

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>