<?php include_once 'site_connection.php'; ?>
<?php include_once 'header.php'; ?>

<?php
if (isset($_POST['submit_msg'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];
	date_default_timezone_set('Asia/Kolkata');
	$time = date('Y-m-d H:i:s');
	$sql_insert = "insert into `contact_us`(`name`,`email`,`msg`,`time`)values('$name','$email','$msg','$time')";
	mysqli_query($conn, $sql_insert);

	require 'mail/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->SMTPSecure = "ssl";
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->SMTPAuth = true;
	$mail->Username = "choicematching12@gmail.com";
	$mail->Password = "zwjizjsvywishfrk";
	$mail->setFrom('choicematching12@gmail.com', 'Choice Matching Notification');
	$mail->addAddress('choicematching12@gmail.com');
	$mail->Subject = 'New Contact Us Message - Choice Matching';
	$mail->msgHTML("<h3>New message from Contact Us form</h3><p><b>Name:</b> $name</p><p><b>Email:</b> $email</p><p><b>Message:</b> $msg</p><p><b>Time:</b> $time</p>");

	if ($mail->send()) {
		$success = true;
	} else {
		$error_msg = $mail->ErrorInfo;
	}
}
?>

<!-- Page Hero -->
<section style="background: #f8f8f8; border-bottom: 1px solid #eee; padding: 60px 0;">
	<div class="container text-center">
		<p
			style="color:#EF9C78; font-family:'Poppins',sans-serif; font-weight:700; font-size:13px; letter-spacing:3px; text-transform:uppercase; margin-bottom:12px;">
			WE'D LOVE TO HEAR FROM YOU</p>
		<h1
			style="font-family:'Poppins',sans-serif; font-weight:800; font-size:42px; color:#13213B; letter-spacing:-1px; margin-bottom:16px;">
			Contact Us</h1>
		<p style="color:#666E7D; font-size:16px; max-width:500px; margin:0 auto;">Questions, feedback or just a hello —
			we're here for you.</p>
	</div>
</section>

<!-- Contact Content -->
<section style="padding: 90px 0; background: #fff;">
	<div class="container">
		<div class="row">

			<!-- Contact Form -->
			<div class="col-lg-7" style="margin-bottom:50px;">
				<div style="background:#fff; border:1px solid #eee; border-radius:20px; padding:50px 45px;">
					<h3
						style="font-family:'Poppins',sans-serif; font-size:24px; font-weight:800; color:#13213B; margin-bottom:8px;">
						Send Us a Message</h3>
					<p style="color:#666E7D; font-size:14px; margin-bottom:36px;">We typically reply within 24 hours.
					</p>

					<?php if (isset($success)): ?>
						<div id="contact_success_msg"
							style="background:#f0fff4; border:1px solid #b2f5d5; border-radius:10px; padding:16px 20px; margin-bottom:24px; color:#276749; font-weight:600; font-size:14px; transition: opacity 0.5s;">
							✅ Your message has been sent! We'll get back to you soon.
						</div>
						<script>
							setTimeout(function () {
								var successAlert = document.getElementById('contact_success_msg');
								if (successAlert) {
									successAlert.style.opacity = '0';
									setTimeout(function () { successAlert.style.display = 'none'; }, 500);
								}
							}, 4000); // 4 seconds delay
						</script>
					<?php endif; ?>
					<?php if (isset($error_msg)): ?>
						<div
							style="background:#fff0f0; border:1px solid #f5b2b2; border-radius:10px; padding:16px 20px; margin-bottom:24px; color:#c41a17; font-weight:600; font-size:14px;">
							❌ Failed to send message. Error: <?php echo $error_msg; ?>
						</div>
					<?php endif; ?>

					<form method="post">
						<div style="margin-bottom:20px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Your
								Name</label>
							<input type="text" name="name" placeholder="e.g. Sanjay Jain" required maxlength="50"
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>
						<div style="margin-bottom:20px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Email
								Address</label>
							<input type="email" name="email" placeholder="e.g. sanjay@email.com" required maxlength="50"
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'" onblur="this.style.borderColor='#ddd'">
						</div>
						<div style="margin-bottom:28px;">
							<label
								style="display:block; font-size:13px; font-weight:600; color:#444; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">Message</label>
							<textarea name="msg" placeholder="How can we help you?" required maxlength="500" rows="6"
								style="width:100%; padding:14px 18px; border:1px solid #ddd; border-radius:10px; font-size:15px; color:#13213B; outline:none; resize:none; transition:border 0.3s; font-family:'Inter',sans-serif;"
								onfocus="this.style.borderColor='#EF9C78'"
								onblur="this.style.borderColor='#ddd'"></textarea>
						</div>
						<button type="submit" name="submit_msg"
							style="width:100%; background:#EF9C78; color:#fff; border:none; padding:16px; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; font-family:'Poppins',sans-serif; letter-spacing:0.5px; transition:background 0.3s;"
							onmouseover="this.style.background='#c41a17'" onmouseout="this.style.background='#EF9C78'">
							Send Message &nbsp; →
						</button>
					</form>
				</div>
			</div>

			<!-- Contact Info -->
			<div class="col-lg-5" style="margin-bottom:50px;">
				<div style="padding-left: 20px;">
					<h3
						style="font-family:'Poppins',sans-serif; font-size:24px; font-weight:800; color:#13213B; margin-bottom:8px;">
						Get in Touch</h3>
					<p style="color:#666E7D; font-size:14px; margin-bottom:40px;">Visit us at our store or reach out
						online.</p>

					<!-- Address -->
					<div style="display:flex; gap:20px; align-items:flex-start; margin-bottom:32px;">
						<div
							style="width:48px; height:48px; background:#fff0f0; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#EF9C78; font-size:20px;">
							<i class="lnr lnr-map-marker"></i>
						</div>
						<div>
							<h5
								style="font-family:'Poppins',sans-serif; font-weight:700; color:#13213B; font-size:15px; margin-bottom:6px;">
								Store Address</h5>
							<p style="color:#666; font-size:14px; line-height:1.7; margin:0;">
								<?php echo nl2br($contact_data['address']); ?>
							</p>
						</div>
					</div>

					<!-- Phone -->
					<div style="display:flex; gap:20px; align-items:flex-start; margin-bottom:32px;">
						<div
							style="width:48px; height:48px; background:#fff0f0; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#EF9C78; font-size:20px;">
							<i class="lnr lnr-phone-handset"></i>
						</div>
						<div>
							<h5
								style="font-family:'Poppins',sans-serif; font-weight:700; color:#13213B; font-size:15px; margin-bottom:6px;">
								Call Us</h5>
							<p style="color:#666; font-size:14px; line-height:1.7; margin:0;"><a
									href="tel:<?php echo $contact_data['mobile']; ?>"
									style="color:#EF9C78; font-weight:600;"><?php echo $contact_data['mobile']; ?></a>
							</p>
						</div>
					</div>

					<!-- Email -->
					<div style="display:flex; gap:20px; align-items:flex-start; margin-bottom:40px;">
						<div
							style="width:48px; height:48px; background:#fff0f0; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; color:#EF9C78; font-size:20px;">
							<i class="lnr lnr-envelope"></i>
						</div>
						<div>
							<h5
								style="font-family:'Poppins',sans-serif; font-weight:700; color:#13213B; font-size:15px; margin-bottom:6px;">
								Email Us</h5>
							<p style="color:#666; font-size:14px; line-height:1.7; margin:0;"><a
									href="mailto:<?php echo $contact_data['email']; ?>"
									style="color:#EF9C78; font-weight:600;"><?php echo $contact_data['email']; ?></a>
							</p>
						</div>
					</div>

					<!-- Store Hours -->
					<div style="background:#f8f8f8; border-radius:14px; padding:24px;">
						<h5
							style="font-family:'Poppins',sans-serif; font-weight:700; color:#13213B; font-size:14px; margin-bottom:16px; text-transform:uppercase; letter-spacing:1px;">
							🕐 Store Hours</h5>
						<div
							style="display:flex; justify-content:space-between; margin-bottom:8px; font-size:14px; color:#555;">
							<span>Monday – Saturday</span><span style="font-weight:600; color:#13213B;">10:00 AM – 8:00
								PM</span>
						</div>
						<div style="display:flex; justify-content:space-between; font-size:14px; color:#555;">
							<span>Sunday</span><span style="font-weight:600; color:#EF9C78;">Closed</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div style="width:100%; height:400px; overflow:hidden;">
	<?php
	if (strpos($contact_data['map_link'], '<iframe') !== false) {
		echo $contact_data['map_link'];
	} else {
		echo "<iframe src='{$contact_data['map_link']}' width='100%' height='100%' frameborder='0' style='border:0;' allowfullscreen='' loading='lazy'></iframe>";
	}
	?>
</div>

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>