<?php include_once 'site_connection.php'; ?>
<?php include_once 'header.php'; ?>

<?php
$sql_select_featured = "select * from `product` where `tag` like '%Featured%'";
$data_featured = mysqli_query($conn, $sql_select_featured);

$sql_select_count = "select * from `blog`";
$data_count_all = mysqli_query($conn, $sql_select_count);
$total_data = mysqli_num_rows($data_count_all);
$limit = 4;
$page_count = ceil($total_data / $limit);

if (isset($_GET['p_id'])) {
	$page_no = (int) $_GET['p_id'];
} else {
	$page_no = 1;
}
$start = ($page_no - 1) * $limit;
$sql_select = "select * from `blog` limit $start,$limit";
$data = mysqli_query($conn, $sql_select);

if (isset($_GET['search'])) {
	$search_text = $_GET['search'];
	$sql_search_count = "select * from `blog` where `title` like '%$search_text%'";
	$data_sc = mysqli_query($conn, $sql_search_count);
	$total_data = mysqli_num_rows($data_sc);
	$page_count_s = ceil($total_data / $limit);
	if (isset($_GET['p_s_id'])) {
		$page_no = (int) $_GET['p_s_id'];
	} else {
		$page_no = 1;
	}
	$start = ($page_no - 1) * $limit;
	$sql_select = "select * from `blog` where `title` like '%$search_text%' limit $start,$limit";
	$data = mysqli_query($conn, $sql_select);
}
?>

<!-- Page Hero -->
<section style="background:#f8f8f8; border-bottom:1px solid #eee; padding:60px 0;">
	<div class="container text-center">
		<p
			style="color:#EF9C78; font-family:'Poppins',sans-serif; font-weight:700; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:12px;">
			OUR JOURNAL</p>
		<h1
			style="font-family:'Poppins',sans-serif; font-weight:800; font-size:42px; color:#13213B; letter-spacing:-1px; margin-bottom:16px;">
			Fashion Blog</h1>
		<p style="color:#666E7D; font-size:16px; max-width:480px; margin:0 auto;">Trends, tips and style stories from the
			Choice Matching team.</p>
	</div>
</section>

<!-- Blog Content -->
<section style="padding:80px 0; background:#fff;">
	<div class="container">
		<div class="row">

			<!-- Main Posts -->
			<div class="col-lg-8" style="margin-bottom:40px;" id="display_page_data">
				<?php $count = 0;
				while ($row = mysqli_fetch_assoc($data)):
					$count++; ?>
						<article
							style="margin-bottom:50px; border:1px solid #eee; border-radius:16px; overflow:hidden; transition:box-shadow 0.3s;"
							onmouseover="this.style.boxShadow='0 10px 40px rgba(0,0,0,0.08)'"
							onmouseout="this.style.boxShadow='none'">
							<!-- Image -->
							<a href="blog-detail.php?detail_id=<?php echo $row['id']; ?>"
								style="display:block; overflow:hidden; max-height:320px;">
								<img src="admin/image/<?php echo $row['image']; ?>" alt="<?php echo $row['title']; ?>"
									style="width:100%; object-fit:cover; height:320px; transition:transform 0.6s ease;"
									onmouseover="this.style.transform='scale(1.05)'"
									onmouseout="this.style.transform='scale(1)'">
							</a>

							<!-- Content -->
							<div style="padding:32px 36px 36px;">
								<!-- Meta -->
								<div style="display:flex; align-items:center; gap:16px; margin-bottom:16px; flex-wrap:wrap;">
									<span
										style="background:#fff0f0; color:#EF9C78; font-size:12px; font-weight:700; padding:4px 12px; border-radius:20px; letter-spacing:1px; text-transform:uppercase;">
										<?php echo $row['tag']; ?>
									</span>
									<span style="color:#bbb; font-size:13px;">
										<?php echo $row['day']; ?>	 	<?php echo $row['month']; ?>	 	<?php echo $row['year']; ?>
									</span>
									<span style="color:#bbb; font-size:13px;">By Admin</span>
								</div>

								<!-- Title -->
								<h2 style="margin-bottom:16px;">
									<a href="blog-detail.php?detail_id=<?php echo $row['id']; ?>"
										style="font-family:'Poppins',sans-serif; font-size:22px; font-weight:800; color:#13213B; line-height:1.3; transition:color 0.3s;"
										onmouseover="this.style.color='#EF9C78'" onmouseout="this.style.color='#13213B'">
										<?php echo $row['title']; ?>
									</a>
								</h2>

								<!-- Excerpt -->
								<p style="color:#666; font-size:15px; line-height:1.8; margin-bottom:24px;">
									<?php echo $row['short_detail']; ?>
								</p>

								<!-- Read More -->
								<a href="blog-detail.php?detail_id=<?php echo $row['id']; ?>"
									style="display:inline-flex; align-items:center; gap:8px; font-family:'Poppins',sans-serif; font-weight:700; font-size:14px; color:#EF9C78; text-decoration:none; transition:gap 0.3s;"
									onmouseover="this.style.gap='12px'" onmouseout="this.style.gap='8px'">
									Continue Reading <i class="fa fa-arrow-right"></i>
								</a>
							</div>
						</article>
				<?php endwhile; ?>

				<?php if ($count === 0): ?>
						<div style="text-align:center; padding:80px 20px;">
							<i class="zmdi zmdi-search"
								style="font-size:48px; color:#ddd; display:block; margin-bottom:16px;"></i>
							<p style="color:#666E7D; font-size:16px;">No blog posts found. Try a different search.</p>
						</div>
				<?php endif; ?>

				<!-- Pagination -->
				<div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:20px;">
					<?php
					$total_pages = isset($page_count_s) ? $page_count_s : $page_count;
					for ($i = 1; $i <= $total_pages; $i++):
						$is_active = ($i == $page_no);
						?>
							<a href="javascript:void(0)"
								class="<?php echo isset($_GET['search']) ? 'page_change_s' : 'page_change'; ?>" <?php echo isset($_GET['search']) ? "attr_search={$_GET['search']} attr_id=$i" : "attr_id=$i"; ?>
								style="width:40px; height:40px; display:inline-flex; align-items:center; justify-content:center; border-radius:8px; font-weight:700; font-size:14px; text-decoration:none; transition:all 0.3s;
						<?php echo $is_active ? 'background:#EF9C78; color:#fff; border:1px solid #EF9C78;' : 'background:#fff; color:#555; border:1px solid #ddd;'; ?>"
								onmouseover="<?php echo !$is_active ? "this.style.borderColor='#EF9C78'; this.style.color='#EF9C78'" : ''; ?>"
								onmouseout="<?php echo !$is_active ? "this.style.borderColor='#ddd'; this.style.color='#555'" : ''; ?>">
								<?php echo $i; ?>
							</a>
					<?php endfor; ?>
				</div>
			</div>

			<!-- Sidebar -->
			<div class="col-lg-4" style="margin-bottom:40px;">

				<!-- Search Box -->
				<div style="background:#f8f8f8; border-radius:14px; padding:24px; margin-bottom:32px;">
					<h5
						style="font-family:'Poppins',sans-serif; font-weight:700; color:#13213B; font-size:15px; margin-bottom:16px; text-transform:uppercase; letter-spacing:0.5px;">
						Search Posts</h5>
					<form method="get" style="display:flex; gap:8px;">
						<input type="text" name="search" placeholder="Type to search..." id="search_text"
							value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
							style="flex:1; padding:12px 16px; border:1px solid #ddd; border-radius:8px; font-size:14px; outline:none;"
							onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						<button type="submit" id="search"
							style="background:#EF9C78; color:#fff; border:none; padding:12px 16px; border-radius:8px; cursor:pointer; font-size:16px;">
							<i class="zmdi zmdi-search"></i>
						</button>
					</form>
				</div>

				<!-- Featured Products -->
				<div style="background:#fff; border:1px solid #eee; border-radius:14px; padding:24px;">
					<h5
						style="font-family:'Poppins',sans-serif; font-weight:700; color:#13213B; font-size:15px; margin-bottom:24px; text-transform:uppercase; letter-spacing:0.5px;">
						Featured Products</h5>
					<ul style="list-style:none; padding:0; margin:0;">
						<?php $a = 0;
						while ($fp = mysqli_fetch_assoc($data_featured)): ?>
								<li
									style="display:flex; gap:14px; align-items:center; margin-bottom:20px; padding-bottom:20px; border-bottom:1px solid #f2f2f2;">
									<a href="product-detail.php?detail_id=<?php echo $fp['id']; ?>"
										style="flex-shrink:0; width:70px; height:90px; border-radius:8px; overflow:hidden; display:block; background:#f5f5f5;">
										<img src="admin/image/<?php echo $fp['image1']; ?>" alt="<?php echo $fp['name']; ?>"
											style="width:100%; height:100%; object-fit:cover;">
									</a>
									<div>
										<a href="product-detail.php?detail_id=<?php echo $fp['id']; ?>"
											style="font-family:'Poppins',sans-serif; font-weight:600; font-size:14px; color:#13213B; display:block; margin-bottom:6px; line-height:1.4; transition:color 0.3s;"
											onmouseover="this.style.color='#EF9C78'" onmouseout="this.style.color='#13213B'">
											<?php echo $fp['name']; ?>
										</a>
										<span
											style="color:#EF9C78; font-weight:700; font-size:15px;">₹<?php echo $fp['price']; ?></span>
									</div>
								</li>
								<?php $a++;
								if ($a == 4)
									break;
						endwhile; ?>
					</ul>
				</div>

			</div>
		</div>
	</div>
</section>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>