<?php

include_once 'site_connection.php';

if (isset($_POST['register'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	if ($password1 == $password2) {
		$sql_select_email = "select * from `user_register` where `email`='$email'";
		$data_email = mysqli_query($conn, $sql_select_email);
		$email_count = mysqli_num_rows($data_email);

		$sql_select_mobile = "select * from `user_register` where `mobile_number`='$mobile'";
		$data_mobile = mysqli_query($conn, $sql_select_mobile);
		$mobile_count = mysqli_num_rows($data_mobile);

		if ($email_count == 0) {
			if ($mobile_count == 0) {
				$sql_insert = "insert into `user_register`(`name`,`email`,`mobile_number`,`password`)values('$name','$email','$mobile','$password1')";
				mysqli_query($conn, $sql_insert);

				header('location:login_home.php');
			} else { ?>
								<div style="text-align: center; color: red; padding-top:10px;">"Entered Mobile Number is already exist.... Please enter
									correct Mobile number or user Forgot Password option...."</div>
						<?php }
		} else { ?>
						<div style="text-align: center; color: red; padding-top:10px;">"Entered Email ID is already exist.... Please enter
							correct email or user Forgot Password option...."</div>
				<?php }
	} else { ?>
				<div style="text-align: center; color: red; padding-top:10px;">"Re-entered password is not match.. Kindly enter same
					password in both tab...."</div>
		<?php }
}

?>

<?php include_once 'header.php'; ?>

<!-- Page Hero -->
<section style="background: #f8f8f8; border-bottom: 1px solid #eee; padding: 60px 0;">
	<div class="container text-center">
		<p
			style="color:#EF9C78; font-family:'Poppins',sans-serif; font-weight:700; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:12px;">
			JOIN US TODAY</p>
		<h1
			style="font-family:'Poppins',sans-serif; font-weight:800; font-size:42px; color:#13213B; letter-spacing:-1px; margin-bottom:16px;">
			Create an Account</h1>
		<p style="color:#666E7D; font-size:16px; max-width:500px; margin:0 auto;">Sign up to enjoy exclusive features and
			offers.</p>
	</div>
</section>

<!-- Register Content -->
<section style="padding: 90px 0; background: #fff;">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 mx-auto">
				<div
					style="background:#fff; border:1px solid #eee; border-radius:20px; padding:50px 45px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">

					<form method="post">
						<div style="margin-bottom:20px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Full
								Name</label>
							<input type="text" name="name" placeholder="Enter your full name" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>
						<div style="margin-bottom:20px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Email
								Address</label>
							<input type="email" name="email" placeholder="Enter your email" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>
						<div style="margin-bottom:20px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Mobile
								Number</label>
							<input type="text" name="mobile" placeholder="Enter your mobile number" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>
						<div style="margin-bottom:20px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Password</label>
							<input type="password" name="password1" placeholder="Enter your password" minlength="6"
								maxlength="10" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>
						<div style="margin-bottom:30px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Re-Enter
								Password</label>
							<input type="password" name="password2" placeholder="Re-enter your password" minlength="6"
								maxlength="10" required
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>

						<button type="submit" name="register"
							style="width:100%; background:#EF9C78; color:#fff; border:none; padding:16px; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; letter-spacing:0.5px; transition:background 0.3s; margin-bottom:30px;"
							onmouseover="this.style.background='#c41a17'" onmouseout="this.style.background='#EF9C78'">
							Register &nbsp; →
						</button>

						<div style="text-align: center; border-top: 1px solid #eee; padding-top: 30px;">
							<p style="color:#666; font-size:15px; margin:0;">
								Already have an account?
								<a href="login_home.php"
									style="color:#EF9C78; font-weight:700; text-decoration:none;">Back to Login</a>
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
