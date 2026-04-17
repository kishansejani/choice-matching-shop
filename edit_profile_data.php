<?php include_once 'site_connection.php';
include_once 'header.php';

if (isset($_SESSION['login'])) {
	$id = $_SESSION['login'];

	$sql_select = "select * from user_register where id='$id'";
	$data = mysqli_query($conn, $sql_select);
	$row = mysqli_fetch_assoc($data);

	$msg = '';
	$msg_type = '';

	if (isset($_POST['verify_data'])) {
		$password = $_POST['password'];

		$sql_check = "select * from user_register where id='$id' and password='$password'";
		$data_check = mysqli_query($conn, $sql_check);
		$check = mysqli_num_rows($data_check);

		if ($check > 0) {
			$name = $_POST['name_e'];
			$email = $_POST['email_e'];
			$mobile = $_POST['mobile_e'];

			$sql_select_email = "select * from user_register where id='$id'";
			$data_email = mysqli_query($conn, $sql_select_email);
			$row_email = mysqli_fetch_assoc($data_email);
			$existing_email = $row_email['email'];

			if ($email == $existing_email) {
				$sql_update = "update user_register set name='$name',email='$email',mobile_number='$mobile' where id='$id'";
				mysqli_query($conn, $sql_update);

				header('location:my_profile.php');
			} else {
				$_SESSION['new_email'] = $email;
				$_SESSION['new_name'] = $name;
				$_SESSION['new_mobile'] = $mobile;

				header('location:mail_email_change/smtp.php');
			}
		} else {
			$msg = "Incorrect current password. Please try again.";
			$msg_type = 'error';
		}
	}
} else {
	header('location:login_home.php');
}

?>

<style>
	.edit-profile-wrapper {
		min-height: 100vh;
		background: #f4f5f7;
		padding: 60px 0 80px;
	}

	.edit-profile-card {
		background: #fff;
		border-radius: 20px;
		box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
		overflow: hidden;
		max-width: 520px;
		margin: 0 auto;
	}

	/* Top Banner */
	.edit-profile-banner {
		background: linear-gradient(135deg, #EF9C78 0%, #c41a17 100%);
		padding: 35px 40px 55px;
		position: relative;
		text-align: center;
	}

	.edit-profile-banner::after {
		content: '';
		position: absolute;
		bottom: -1px;
		left: 0;
		right: 0;
		height: 40px;
		background: #fff;
		border-radius: 40px 40px 0 0;
	}

	.edit-profile-icon {
		width: 80px;
		height: 80px;
		background: rgba(255, 255, 255, 0.22);
		border: 3px solid rgba(255, 255, 255, 0.55);
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 14px;
		font-size: 32px;
		color: #fff;
	}

	.edit-profile-banner h2 {
		font-family: 'Poppins', sans-serif;
		font-size: 20px;
		font-weight: 700;
		color: #fff;
		margin: 0 0 4px;
	}

	.edit-profile-banner p {
		font-size: 13px;
		color: rgba(255, 255, 255, 0.8);
		margin: 0;
	}

	/* Body */
	.edit-profile-body {
		padding: 10px 40px 40px;
	}

	/* Alert */
	.edit-alert {
		padding: 12px 16px;
		border-radius: 10px;
		font-family: 'Poppins', sans-serif;
		font-size: 13px;
		font-weight: 600;
		margin-bottom: 20px;
		display: flex;
		align-items: center;
		gap: 10px;
	}

	.edit-alert.error {
		background: #fff0f0;
		border: 1.5px solid #ffd0cf;
		color: #c41a17;
	}

	/* Form Fields */
	.ep-field {
		margin-bottom: 20px;
	}

	.ep-field label {
		display: block;
		font-family: 'Poppins', sans-serif;
		font-size: 11px;
		font-weight: 700;
		color: #999;
		letter-spacing: 1px;
		text-transform: uppercase;
		margin-bottom: 8px;
	}

	.ep-input-wrap {
		position: relative;
	}

	.ep-input-wrap i {
		position: absolute;
		left: 16px;
		top: 50%;
		transform: translateY(-50%);
		color: #EF9C78;
		font-size: 18px;
		pointer-events: none;
	}

	.ep-input-wrap input {
		width: 100%;
		padding: 13px 18px 13px 46px;
		border: 1.5px solid #eee;
		border-radius: 12px;
		font-family: 'Poppins', sans-serif;
		font-size: 14px;
		font-weight: 500;
		color: #222;
		background: #f8f8f8;
		transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
		outline: none;
		box-sizing: border-box;
	}

	.ep-input-wrap input:focus {
		border-color: #EF9C78;
		background: #fff;
		box-shadow: 0 0 0 3px rgba(239, 156, 120, 0.10);
	}

	/* Password field has a lock icon note */
	.ep-password-note {
		font-size: 11px;
		color: #aaa;
		margin-top: 6px;
		font-style: italic;
	}

	.ep-divider {
		border: none;
		border-top: 1px solid #f0f0f0;
		margin: 24px 0;
	}

	/* Buttons */
	.ep-btn-group {
		display: flex;
		flex-direction: column;
		gap: 12px;
	}

	.ep-btn {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		width: 100%;
		padding: 14px 20px;
		border-radius: 12px;
		font-family: 'Poppins', sans-serif;
		font-size: 14px;
		font-weight: 700;
		cursor: pointer;
		border: none;
		transition: all 0.3s ease;
		text-decoration: none;
	}

	.ep-btn-primary {
		background: #EF9C78;
		color: #fff;
		box-shadow: 0 6px 20px rgba(239, 156, 120, 0.3);
	}

	.ep-btn-primary:hover {
		background: #c41a17;
		transform: translateY(-2px);
		box-shadow: 0 8px 25px rgba(239, 156, 120, 0.4);
		color: #fff;
	}

	.ep-btn-ghost {
		background: #f4f5f7;
		color: #555;
		border: 2px solid #eee;
	}

	.ep-btn-ghost:hover {
		background: #eee;
		transform: translateY(-2px);
		color: #333;
		text-decoration: none;
	}

	.ep-or {
		text-align: center;
		color: #bbb;
		font-size: 12px;
		font-weight: 600;
		position: relative;
		margin: 2px 0;
	}

	.ep-or::before,
	.ep-or::after {
		content: '';
		position: absolute;
		top: 50%;
		width: 40%;
		height: 1px;
		background: #eee;
	}

	.ep-or::before {
		left: 0;
	}

	.ep-or::after {
		right: 0;
	}

	@media (max-width: 575px) {
		.edit-profile-banner {
			padding: 28px 25px 50px;
		}

		.edit-profile-body {
			padding: 10px 25px 30px;
		}
	}
</style>

<div id="current_pass">
	<div class="edit-profile-wrapper">
		<form method="post" id="edit_data">
			<div class="container">
				<div class="edit-profile-card">

					<!-- Banner -->
					<div class="edit-profile-banner">
						<div class="edit-profile-icon">
							<i class="zmdi zmdi-edit"></i>
						</div>
						<h2>Edit Your Details</h2>
						<p>Update your account information below</p>
					</div>

					<!-- Body -->
					<div class="edit-profile-body">

						<?php if ($msg): ?>
								<div class="edit-alert error">
									<i class="zmdi zmdi-alert-circle"></i>
									<?php echo $msg; ?>
								</div>
						<?php endif; ?>

						<!-- Name -->
						<div class="ep-field">
							<label>Full Name</label>
							<div class="ep-input-wrap">
								<i class="zmdi zmdi-account"></i>
								<input type="text" name="name_e" placeholder="Enter your name" required
									value="<?php echo htmlspecialchars(@$row['name']); ?>">
							</div>
						</div>

						<!-- Email -->
						<div class="ep-field">
							<label>Email Address</label>
							<div class="ep-input-wrap">
								<i class="zmdi zmdi-email"></i>
								<input type="email" name="email_e" placeholder="Enter your email" required
									value="<?php echo htmlspecialchars(@$row['email']); ?>">
							</div>
						</div>

						<!-- Mobile -->
						<div class="ep-field">
							<label>Mobile Number</label>
							<div class="ep-input-wrap">
								<i class="zmdi zmdi-phone"></i>
								<input type="text" name="mobile_e" placeholder="Enter your mobile number" required
									value="<?php echo htmlspecialchars(@$row['mobile_number']); ?>">
							</div>
						</div>

						<!-- Current Password (verification) -->
						<div class="ep-field">
							<label>Current Password <span style="color:#EF9C78;">*</span></label>
							<div class="ep-input-wrap">
								<i class="zmdi zmdi-lock"></i>
								<input type="password" name="password" placeholder="Enter current password to confirm"
									required>
							</div>
							<p class="ep-password-note">Required to verify your identity before saving changes.</p>
						</div>

						<hr class="ep-divider">

						<!-- Buttons -->
						<div class="ep-btn-group">
							<button type="submit" name="verify_data" class="ep-btn ep-btn-primary">
								<i class="zmdi zmdi-check"></i> Save Changes
							</button>

							<div class="ep-or">OR</div>

							<a href="my_profile.php" class="ep-btn ep-btn-ghost">
								<i class="zmdi zmdi-arrow-left"></i> Back to Profile
							</a>
						</div>

					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<?php include_once 'scripts.php'; ?>
