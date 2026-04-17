<?php include_once 'site_connection.php'; ?>
<?php include_once 'header.php'; ?>
<?php
$sql_select = "select * from `about`";
$data = mysqli_query($conn, $sql_select);
$row = mysqli_fetch_assoc($data);
?>

<!-- Page Hero -->
<section style="background: #f8f8f8; border-bottom: 1px solid #eee; padding: 60px 0;">
	<div class="container text-center">
		<p
			style="color: #EF9C78; font-family:'Poppins',sans-serif; font-weight:800; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:12px; opacity: 0.9;">
			WHO WE ARE</p>
		<h1
			style="font-family:'Poppins',sans-serif; font-weight:800; font-size:42px; color:#111; letter-spacing:-1px; margin-bottom:16px;">
			About Choice Matching</h1>
		<p style="color:#888; font-size:16px; max-width:550px; margin:0 auto;">Fashion that speaks for you — crafted
			with passion, curated with love.</p>
	</div>
</section>

<!-- Our Story -->
<section style="padding: 90px 0; background: #fff;">
	<div class="container">
		<div class="row align-items-center" style="margin-bottom: 80px;">
			<div class="col-md-7 col-lg-8" style="padding-right: 60px;">
				<span
					style="display:inline-block; background:rgba(239, 156, 120, 0.1); color:#EF9C78; font-size:12px; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:6px 16px; border-radius:50px; margin-bottom:20px;">Our 
					Story</span><br>
				<h2
					style="font-family:'Poppins',sans-serif; font-size:34px; font-weight:800; color:#111; letter-spacing:-0.5px; margin-bottom:24px;">
					Where Fashion Meets Tradition</h2>
				<p style="color:#555; font-size:16px; line-height:1.9; margin-bottom:20px;">
					<?php echo $row['story_detail']; ?>
				</p>
				<p style="color:#888; font-size:14px; line-height:1.8;">
					📍 CHOICE MATCHING FASHION SHOP, Near Vastral Metro Station, Vastral, Ahmedabad 382418, Gujarat
					&nbsp;|&nbsp; 📞 7359343509
				</p>
			</div>
			<div class="col-11 col-md-5 col-lg-4 m-lr-auto">
				<div style="border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.1);">
					<img src="admin/image/<?php echo $row['story_image']; ?>" alt="Our Story"
						style="width:100%; display:block;">
				</div>
			</div>
		</div>

		<!-- Our Mission -->
		<div class="row align-items-center">
			<div class="col-11 col-md-5 col-lg-4 m-lr-auto" style="margin-bottom:30px;">
				<div style="border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.1);">
					<img src="admin/image/<?php echo $row['mission_image']; ?>" alt="Our Mission"
						style="width:100%; display:block;">
				</div>
			</div>
			<div class="col-md-7 col-lg-8" style="padding-left: 60px;">
				<span
					style="display:inline-block; background:rgba(239, 156, 120, 0.1); color:#EF9C78; font-size:12px; font-weight:800; letter-spacing:2px; text-transform:uppercase; padding:6px 16px; border-radius:50px; margin-bottom:20px;">Our 
					Mission</span><br>
				<h2
					style="font-family:'Poppins',sans-serif; font-size:34px; font-weight:800; color:#111; letter-spacing:-0.5px; margin-bottom:24px;">
					Dressed For Every Moment</h2>
				<p style="color:#555; font-size:16px; line-height:1.9;">
					<?php echo $row['mission_detail']; ?>
				</p>
			</div>
		</div>
	</div>
</section>

<!-- Quote Section -->
<section style="background: #111; padding: 80px 0;">
	<div class="container text-center">
		<div style="max-width: 700px; margin: 0 auto;">
			<i class="fa fa-quote-left" style="font-size:36px; color:#EF9C78; margin-bottom:24px; display:block;"></i>
			<p
				style="font-family:'Poppins',sans-serif; font-size:22px; color:#fff; font-weight:500; font-style:italic; line-height:1.7; margin-bottom:24px;">
				"<?php echo $row['best_thought']; ?>"
			</p>
			<span style="color:rgba(255,255,255,0.5); font-size:14px; letter-spacing:2px; text-transform:uppercase;">—
				<?php echo $row['thought_by']; ?></span>
		</div>
	</div>
</section>

<!-- Why Choose Us -->
<section style="padding: 90px 0; background: #f8f8f8;">
	<div class="container">
		<div class="text-center" style="margin-bottom:60px;">
			<h2 style="font-family:'Poppins',sans-serif; font-size:34px; font-weight:800; color:#111;">Why Choose Us?
			</h2>
			<p style="color:#888; margin-top:10px;">We take pride in what we offer</p>
		</div>
		<div class="row">
			<div class="col-md-4 text-center" style="margin-bottom:30px;">
				<div
					style="background:#fff; padding:50px 30px; border-radius:16px; border:1px solid #eee; height:100%;">
					<div
						style="width:64px; height:64px; background:rgba(239, 156, 120, 0.1); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; font-size:28px; color:#EF9C78;">
						<i class="zmdi zmdi-truck"></i>
					</div>
					<h4 style="font-family:'Poppins',sans-serif; font-weight:700; color:#111; margin-bottom:12px;">Fast 
						Delivery</h4>
					<p style="color:#888; font-size:14px; line-height:1.7;">Free delivery on all orders above ₹600 with
						real-time tracking.</p>
				</div>
			</div>
			<div class="col-md-4 text-center" style="margin-bottom:30px;">
				<div
					style="background:#fff; padding:50px 30px; border-radius:16px; border:1px solid #eee; height:100%;">
					<div
						style="width:64px; height:64px; background:rgba(239, 156, 120, 0.1); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; font-size:28px; color:#EF9C78;">
						<i class="zmdi zmdi-star"></i>
					</div>
					<h4 style="font-family:'Poppins',sans-serif; font-weight:700; color:#111; margin-bottom:12px;">
						Premium Quality</h4>
					<p style="color:#888; font-size:14px; line-height:1.7;">Every product is handpicked and
						quality-checked before it reaches you.</p>
				</div>
			</div>
			<div class="col-md-4 text-center" style="margin-bottom:30px;">
				<div
					style="background:#fff; padding:50px 30px; border-radius:16px; border:1px solid #eee; height:100%;">
					<div
						style="width:64px; height:64px; background:rgba(239, 156, 120, 0.1); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; font-size:28px; color:#EF9C78;">
						<i class="zmdi zmdi-refresh-sync"></i>
					</div>
					<h4 style="font-family:'Poppins',sans-serif; font-weight:700; color:#111; margin-bottom:12px;">Easy 
						Returns</h4>
					<p style="color:#888; font-size:14px; line-height:1.7;">Hassle-free 10-day return policy — no
						questions asked.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>