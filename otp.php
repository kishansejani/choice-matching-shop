<?php

include_once 'site_connection.php';

$sent_otp = $_SESSION['otp'];

if (isset($_POST['verify_otp'])) {
	$get_otp = $_POST['enter_opt'];

	if ($sent_otp == $get_otp) {
		header('location:password_change.php');
	} else { ?>
				<div style="text-align: center; color: red; padding-top:10px;">"Enter OTP is not match..! Kindly enter OTP which is sent
					to your registered mail ID...."</div>
		<?php }
}

?>

<?php include_once 'header.php'; ?>

<!-- Page Hero -->
<section style="background: #f8f8f8; border-bottom: 1px solid #eee; padding: 60px 0;">
	<div class="container text-center">
		<p
			style="color:#EF9C78; font-family:'Poppins',sans-serif; font-weight:700; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:12px;">
			SECURITY CHECK</p>
		<h1
			style="font-family:'Poppins',sans-serif; font-weight:800; font-size:42px; color:#111; letter-spacing:-1px; margin-bottom:16px;">
			Verify OTP</h1>
		<p style="color:#888; font-size:16px; max-width:500px; margin:0 auto;">Enter the 6-digit code sent to your
			registered email.</p>
	</div>
</section>

<!-- Verify OTP Content -->
<section style="padding: 90px 0; background: #fff;">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 mx-auto">
				<div
					style="background:#fff; border:1px solid #eee; border-radius:20px; padding:50px 45px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">

					<form method="post">
						<div style="margin-bottom:30px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">6-Digit
								OTP</label>
							<input type="text" name="enter_opt" placeholder="123456" maxlength="6" minlength="6"
								required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#111; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif; letter-spacing:8px; font-weight:700; text-align:center;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>

						<button type="submit" name="verify_otp"
							style="width:100%; background:#EF9C78; color:#fff; border:none; padding:16px; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; letter-spacing:0.5px; transition:background 0.3s; margin-bottom:30px;"
							onmouseover="this.style.background='#c41a17'" onmouseout="this.style.background='#EF9C78'">
							Verify OTP &nbsp; →
						</button>

						<div style="text-align: center; border-top: 1px solid #eee; padding-top: 30px;">
							<p style="color:#666; font-size:15px; margin:0;">
								Back to
								<a href="login_home.php"
									style="color:#EF9C78; font-weight:700; text-decoration:none;">Login</a>
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
