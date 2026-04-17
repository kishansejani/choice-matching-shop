<?php

include_once 'site_connection.php';

$success_msg = '';
$error_msg = '';

if (isset($_POST['submit'])) {
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	if ($password == $password2) {
		$row = $_SESSION['user_row'];
		$id = $row['id'];

		$sql_select = "select * from user_register where password='$password2' and id='$id'";
		$data = mysqli_query($conn, $sql_select);
		$count = mysqli_num_rows($data);

		if ($count == 0) {
			$sql_update = "update user_register set password='$password2' where id='$id'";
			mysqli_query($conn, $sql_update);
			$success_msg = "Password has been changed successfully!";
		} else {
			$error_msg = "Entered password is already used before..! Kindly use another password.";
		}
	} else {
		$error_msg = "Re-entered password does not match..! Kindly enter same password in both fields.";
	}
}

?>

<?php include_once 'header.php'; ?>

<!-- Page Hero -->
<section style="background: #f8f8f8; border-bottom: 1px solid #eee; padding: 60px 0;">
	<div class="container text-center">
		<p
			style="color:#EF9C78; font-family:'Poppins',sans-serif; font-weight:700; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:12px;">
			SECURITY</p>
		<h1
			style="font-family:'Poppins',sans-serif; font-weight:800; font-size:42px; color:#111; letter-spacing:-1px; margin-bottom:16px;">
			Create New Password</h1>
		<p style="color:#888; font-size:16px; max-width:500px; margin:0 auto;">Enter your new password below.</p>
	</div>
</section>

<!-- Password Change Content -->
<section style="padding: 90px 0; background: #fff;">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 mx-auto">
				<div
					style="background:#fff; border:1px solid #eee; border-radius:20px; padding:50px 45px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">

					<?php if ($success_msg != ''): ?>
							<div
								style="background:#f0fff4; border:1px solid #b2f5d5; border-radius:10px; padding:16px 20px; margin-bottom:24px; color:#276749; font-weight:600; font-size:14px; text-align:center;">
								✅ <?php echo $success_msg; ?><br>Redirecting to login...
							</div>
							<script>
								setTimeout(function () {
									window.location.href = 'login_home.php';
								}, 2500);
							</script>
					<?php endif; ?>

					<?php if ($error_msg != ''): ?>
							<div
								style="background:#fff0f0; border:1px solid #f5b2b2; border-radius:10px; padding:16px 20px; margin-bottom:24px; color:#c41a17; font-weight:600; font-size:14px; text-align:center;">
								❌ <?php echo $error_msg; ?>
							</div>
					<?php endif; ?>

					<form method="post">
						<div style="margin-bottom:20px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">New
								Password</label>
							<input type="password" name="password" placeholder="Enter new password" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#111; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>
						<div style="margin-bottom:30px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Re-enter
								Password</label>
							<input type="password" name="password2" placeholder="Re-enter new password" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#111; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>

						<button type="submit" name="submit"
							style="width:100%; background:#EF9C78; color:#fff; border:none; padding:16px; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; letter-spacing:0.5px; transition:background 0.3s; margin-bottom:30px;"
							onmouseover="this.style.background='#c41a17'" onmouseout="this.style.background='#EF9C78'">
							Change Password &nbsp; →
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
