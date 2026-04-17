<?php include_once 'site_connection.php';
include_once 'header.php';

if (isset($_SESSION['login'])) {
	$id = $_SESSION['login'];

	$sql_select = "select * from user_register where id='$id'";
	$data = mysqli_query($conn, $sql_select);
	$row = mysqli_fetch_assoc($data);

	if (isset($_POST['edit_data'])) {
		header('location:edit_profile_data.php');
	}

	if (isset($_POST['change_pass'])) {
		header('location:change_profile_pass.php');
	}
} else {
	header('location:login_home.php');
}

?>

<style>
	.profile-page-wrapper {
		min-height: 100vh;
		background: #FEFEFE;
		padding: 80px 0 100px;
	}

	.profile-card {
		background: #fff;
		border-radius: 30px;
		box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
		overflow: hidden;
		max-width: 550px;
		margin: 0 auto;
		border: 1px solid #f2f2f2;
	}

	/* Top Banner */
	.profile-card-banner {
		background: linear-gradient(135deg, #EF9C78 0%, #D88D6A 100%);
		padding: 50px 40px 70px;
		position: relative;
		text-align: center;
	}

	.profile-card-banner::after {
		content: '';
		position: absolute;
		bottom: -1px;
		left: 0;
		right: 0;
		height: 40px;
		background: #fff;
		border-radius: 40px 40px 0 0;
	}

	.profile-avatar {
		width: 100px;
		height: 100px;
		background: rgba(255, 255, 255, 0.25);
		border: 4px solid rgba(255, 255, 255, 0.6);
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 18px;
		font-size: 42px;
		color: #fff;
		box-shadow: 0 10px 20px rgba(0,0,0,0.1);
	}

	.profile-card-banner h2 {
		font-family: 'Poppins', sans-serif;
		font-size: 26px;
		font-weight: 800;
		color: #fff;
		margin: 0 0 6px;
		letter-spacing: -0.5px;
	}

	.profile-card-banner p {
		font-family: 'Poppins', sans-serif;
		font-size: 14px;
		font-weight: 500;
		color: rgba(255, 255, 255, 0.9);
		margin: 0;
		text-transform: uppercase;
		letter-spacing: 1px;
	}

	/* Body */
	.profile-card-body {
		padding: 10px 45px 50px;
	}

	.profile-field-group {
		margin-bottom: 24px;
	}

	.profile-field-group label {
		display: block;
		font-family: 'Poppins', sans-serif;
		font-size: 12px;
		font-weight: 700;
		color: #999;
		letter-spacing: 1.5px;
		text-transform: uppercase;
		margin-bottom: 10px;
	}

	.profile-field-group .field-value {
		display: flex;
		align-items: center;
		gap: 15px;
		background: #FDFDFD;
		border: 1.5px solid #F0F0F0;
		border-radius: 16px;
		padding: 15px 22px;
		font-family: 'Poppins', sans-serif;
		font-size: 16px;
		font-weight: 600;
		color: #13213B;
		transition: border-color 0.3s;
	}

	.profile-field-group:hover .field-value {
		border-color: #EF9C78;
	}

	.profile-field-group .field-value i {
		color: #EF9C78;
		font-size: 20px;
	}

	.profile-divider {
		border: none;
		border-top: 1px solid #f2f2f2;
		margin: 30px 0;
	}

	/* Buttons */
	.profile-btn-group {
		display: flex;
		flex-direction: column;
		gap: 15px;
	}

	.profile-btn {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 12px;
		width: 100%;
		padding: 16px 25px;
		border-radius: 16px;
		font-family: 'Poppins', sans-serif;
		font-size: 15px;
		font-weight: 700;
		cursor: pointer;
		border: none;
		transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
		text-decoration: none;
	}

	.profile-btn-primary {
		background: #EF9C78;
		color: #fff;
		box-shadow: 0 10px 30px rgba(239, 156, 120, 0.35);
	}

	.profile-btn-primary:hover {
		background: #13213B;
		color: #fff;
		transform: translateY(-4px);
		box-shadow: 0 15px 35px rgba(19, 33, 59, 0.25);
	}

	.profile-btn-outline {
		background: #fff;
		color: #EF9C78;
		border: 2px solid #EF9C78;
	}

	.profile-btn-outline:hover {
		background: #FFF5F2;
		transform: translateY(-4px);
		color: #D88D6A;
		border-color: #D88D6A;
	}

	.profile-btn-ghost {
		background: #F8F8F8;
		color: #666E7D;
		border: 1px solid #EEE;
	}

	.profile-btn-ghost:hover {
		background: #EEE;
		transform: translateY(-2px);
		color: #13213B;
	}

	.profile-or {
		text-align: center;
		color: #DDD;
		font-size: 13px;
		font-weight: 700;
		position: relative;
		margin: 10px 0;
		font-family: 'Poppins', sans-serif;
	}

	.profile-or::before,
	.profile-or::after {
		content: '';
		position: absolute;
		top: 50%;
		width: 42%;
		height: 1px;
		background: #EEE;
	}

	.profile-or::before {
		left: 0;
	}

	.profile-or::after {
		right: 0;
	}

	@media (max-width: 575px) {
		.profile-card-banner {
			padding: 30px 25px 55px;
		}

		.profile-card-body {
			padding: 10px 25px 30px;
		}
	}
</style>

<div class="profile-page-wrapper">
	<form method="post">
		<div class="container">
			<div class="profile-card">
				<!-- Banner -->
				<div class="profile-card-banner">
					<div class="profile-avatar">
						<i class="zmdi zmdi-account"></i>
					</div>
					<h2><?php echo htmlspecialchars($row['name']); ?></h2>
					<p>Member Account</p>
				</div>

				<!-- Body -->
				<div class="profile-card-body">
					<!-- Name -->
					<div class="profile-field-group">
						<label>Full Name</label>
						<div class="field-value">
							<i class="zmdi zmdi-account"></i>
							<?php echo htmlspecialchars($row['name']); ?>
						</div>
					</div>

					<!-- Email -->
					<div class="profile-field-group">
						<label>Email Address</label>
						<div class="field-value">
							<i class="zmdi zmdi-email"></i>
							<?php echo htmlspecialchars($row['email']); ?>
						</div>
					</div>

					<!-- Mobile -->
					<div class="profile-field-group">
						<label>Mobile Number</label>
						<div class="field-value">
							<i class="zmdi zmdi-phone"></i>
							<?php echo htmlspecialchars($row['mobile_number']); ?>
						</div>
					</div>

					<hr class="profile-divider">

					<!-- Buttons -->
					<div class="profile-btn-group">
						<button type="submit" name="edit_data" class="profile-btn profile-btn-primary">
							<i class="zmdi zmdi-edit"></i> Edit Your Details
						</button>
						<button type="submit" name="change_pass" class="profile-btn profile-btn-outline">
							<i class="zmdi zmdi-lock"></i> Change Password
						</button>

						<div class="profile-or">OR</div>

						<a href="index.php" class="profile-btn profile-btn-ghost">
							<i class="zmdi zmdi-home"></i> Back to Home
						</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<?php include_once 'scripts.php'; ?>