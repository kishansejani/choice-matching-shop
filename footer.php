<!-- Footer -->
<footer style="background: #13213B; padding: 70px 0 0 0;">
	<div class="container">
		<div class="row" style="padding-bottom: 50px;">
			<!-- Brand -->
			<div class="col-sm-6 col-lg-3" style="padding-bottom: 40px;">
				<a href="index.php">
					
					<img src="images/icons/logo-01.png" alt="Choice Matching"
						style="max-height:95px; margin-bottom: 10px; filter: invert(1); mix-blend-mode: screen;">
				</a>
				<p style="color: rgba(255,255,255,0.55); font-size: 13px; line-height: 1.8; margin-top: 15px;">
					Choice Matching Fashion Shop — your destination for modern Indian fashion. Quality you can feel,
					style you can see.
				</p>
				<div style="margin-top: 20px; display: flex; gap: 12px;">
					<a href="#"
						style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.08); display:flex; align-items:center; justify-content:center; color:#fff; transition: background 0.3s;"
						onmouseover="this.style.background='#EF9C78'"
						onmouseout="this.style.background='rgba(255,255,255,0.08)'">
						<i class="fa fa-facebook"></i>
					</a>
					<a href="#"
						style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.08); display:flex; align-items:center; justify-content:center; color:#fff; transition: background 0.3s;"
						onmouseover="this.style.background='#EF9C78'"
						onmouseout="this.style.background='rgba(255,255,255,0.08)'">
						<i class="fa fa-instagram"></i>
					</a>
					<a href="#"
						style="width:36px; height:36px; border-radius:50%; background:rgba(255,255,255,0.08); display:flex; align-items:center; justify-content:center; color:#fff; transition: background 0.3s;"
						onmouseover="this.style.background='#EF9C78'"
						onmouseout="this.style.background='rgba(255,255,255,0.08)'">
						<i class="fa fa-pinterest-p"></i>
					</a>
				</div>
			</div>

			<!-- Collections -->
			<div class="col-sm-6 col-lg-3" style="padding-bottom: 40px;">
				<h5
					style="color:#fff; font-family:'Poppins',sans-serif; font-weight:700; font-size:14px; letter-spacing:1px; text-transform:uppercase; margin-bottom:24px;">
					Collections</h5>
				<ul style="list-style:none; padding:0; margin:0;">
					<?php
					$f_cat_res = mysqli_query($conn, "SELECT * FROM `category` WHERE status=1 LIMIT 6");
					while ($f_cat = mysqli_fetch_assoc($f_cat_res)) {
						echo '<li style="margin-bottom:12px;"><a href="product.php?cat_name=' . urlencode($f_cat['category_name']) . '"
							style="color:rgba(255,255,255,0.55); font-size:14px; transition:color 0.3s;"
							onmouseover="this.style.color=\'#EF9C78\'"
							onmouseout="this.style.color=\'rgba(255,255,255,0.55)\'">' . $f_cat['category_name'] . '</a></li>';
					}
					?>
					<li style="margin-bottom:12px;"><a href="product.php"
							style="color:rgba(255,255,255,0.55); font-size:14px; transition:color 0.3s;"
							onmouseover="this.style.color='#EF9C78'"
							onmouseout="this.style.color='rgba(255,255,255,0.55)'">All Products</a></li>
				</ul>
			</div>

			<!-- Help -->
			<div class="col-sm-6 col-lg-3" style="padding-bottom: 40px;">
				<h5
					style="color:#fff; font-family:'Poppins',sans-serif; font-weight:700; font-size:14px; letter-spacing:1px; text-transform:uppercase; margin-bottom:24px;">
					Help & Info</h5>
				<ul style="list-style:none; padding:0; margin:0;">
					<li style="margin-bottom:12px;"><a href="order-list.php"
							style="color:rgba(255,255,255,0.55); font-size:14px; transition:color 0.3s;"
							onmouseover="this.style.color='#EF9C78'"
							onmouseout="this.style.color='rgba(255,255,255,0.55)'">Track My Order</a></li>
					<li style="margin-bottom:12px;"><a href="about.php"
							style="color:rgba(255,255,255,0.55); font-size:14px; transition:color 0.3s;"
							onmouseover="this.style.color='#EF9C78'"
							onmouseout="this.style.color='rgba(255,255,255,0.55)'">About Us</a></li>
					<li style="margin-bottom:12px;"><a href="contact.php"
							style="color:rgba(255,255,255,0.55); font-size:14px; transition:color 0.3s;"
							onmouseover="this.style.color='#EF9C78'"
							onmouseout="this.style.color='rgba(255,255,255,0.55)'">Contact Us</a></li>
					<li style="margin-bottom:12px;"><a href="blog.php"
							style="color:rgba(255,255,255,0.55); font-size:14px; transition:color 0.3s;"
							onmouseover="this.style.color='#EF9C78'"
							onmouseout="this.style.color='rgba(255,255,255,0.55)'">Blog</a></li>
				</ul>
			</div>

			<!-- Newsletter -->
			<div class="col-sm-6 col-lg-3" style="padding-bottom: 40px;">
				<h5
					style="color:#fff; font-family:'Poppins',sans-serif; font-weight:700; font-size:14px; letter-spacing:1px; text-transform:uppercase; margin-bottom:24px;">
					Stay in the Loop</h5>
				<p style="color:rgba(255,255,255,0.55); font-size:13px; line-height:1.7; margin-bottom:20px;">Get latest
					arrivals, exclusive offers and fashion tips — directly in your inbox.</p>
				<div style="display:flex; gap:8px;">
					<input type="email" placeholder="Your email address"
						style="flex:1; padding:12px 16px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.12); border-radius:6px; color:#fff; font-size:13px; outline:none;">
					<button
						style="background:#EF9C78; color:#fff; border:none; padding:12px 18px; border-radius:6px; font-weight:700; cursor:pointer; font-size:13px; transition:background 0.3s;"
						onmouseover="this.style.background='#c41a17'" onmouseout="this.style.background='#EF9C78'">
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</div>
				<?php $c_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `contact_info` WHERE `id`=1")); ?>
				<p style="color:rgba(255,255,255,0.4); font-size:11px; margin-top:10px;">📍 <?php echo $c_data['address']; ?></p>
				<p style="color:rgba(255,255,255,0.4); font-size:11px; margin-top:4px;">📞 <?php echo $c_data['mobile']; ?></p>
			</div>
		</div>

		<!-- Bottom Bar -->
		<div
			style="border-top:1px solid rgba(255,255,255,0.08); padding: 24px 0; display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:16px;">
			<p style="color:rgba(255,255,255,0.4); font-size:12px; margin:0;">
				&copy;
				<script>document.write(new Date().getFullYear());</script> Choice Matching Fashion Shop. All rights
				reserved.
			</p>
			<div style="display:flex; gap:8px; align-items:center;">
				<img src="images/icons/icon-pay-01.png" alt="Pay" style="height:22px; opacity:0.5;">
				<img src="images/icons/icon-pay-02.png" alt="Pay" style="height:22px; opacity:0.5;">
				<img src="images/icons/icon-pay-03.png" alt="Pay" style="height:22px; opacity:0.5;">
				<img src="images/icons/icon-pay-04.png" alt="Pay" style="height:22px; opacity:0.5;">
			</div>
		</div>
	</div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
	<span class="symbol-btn-back-to-top">
		<i class="zmdi zmdi-chevron-up"></i>
	</span>
</div>