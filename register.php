<?php
require_once("config.php");

if (isset($_POST['st_registration'])) {
	$stName = $_POST['st_name'];
	$stEmail = $_POST['st_email'];
	$stFname = $_POST['st_fname'];
	$stMname = $_POST['st_mname'];
	$birthday = $_POST['st_birthday'];
	$stphone = $_POST['st_phone'];
	$stFphone = $_POST['st_f_phone'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$patten = '/^(?:\+88|88)?(01[3-9]\d{8})$/';



	// echo $gender;


	if (empty($stName)) {
		$error = "Enter Your Name";
	} elseif (empty($stEmail)) {
		$error = "Enter Your Email Address";
	} elseif (!filter_var($stEmail, FILTER_VALIDATE_EMAIL)) {
		$error = "Please Enter A Valid Email!";
	} elseif (empty($stFname)) {
		$error = "Enter Your Father Name!";
	} elseif (empty($stMname)) {
		$error = "Enter Your Mother Name";
	} elseif (empty($stphone)) {
		$error = "Enter Your Phone Number";
	} elseif (!preg_match($patten, $stphone)) {
		$error = "Enter A Valid Phone Number";
	} elseif (!preg_match($patten, $stFphone)) {
		$error = "Please Enter A Valid Phone Number Of Your Father";
	} elseif (empty($password)) {
		$error = "Enter Your Password";
	} elseif ($password != $confirmpassword) {
		$error = "Password Doees Not Match";
	} elseif (strlen($password) < 6 || strlen($password) > 15) {
		$error = "Password Must Be Used 6 to 15 digit";
	} elseif (empty($gender)) {
		$error = "Please Select A Gender";
	}else{

		$password=sha1($password);
		$now=date("Y-d-m h:i:s");

		$stm=$conn->prepare("INSERT INTO student (name,email,mobile,father_name,father_mobile,mother_name,gender,birthday,address,password,roll,current_class,registration_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$stm->execute(array($stName, $stEmail, $stphone, $stFname, $stFphone, $stMname, $gender, $birthday, $address, $password,null,null,$now));

		$success="Data Insert Success";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />

	<!-- DESCRIPTION -->
	<meta name="description" content="PSMS : Student Registration" />

	<!-- OG -->
	<meta property="og:title" content="PSMS : Student Registration" />
	<meta property="og:description" content="PSMS : Student Registration" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">

	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

	<!-- PAGE TITLE HERE ============================================= -->
	<title>PSMS : Student Registration </title>

	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->

	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">

	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">

	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">

	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css">

</head>

<body id="bg">
	<div class="page-wraper">
		<div id="loading-icon-bx"></div>
		<div class="account-form">
			<div class="account-head" style="background-image:url(assets/images/background/bg2.jpg);">
				<a href="index.php"><img src="assets/images/logo-white-2.png" alt=""></a>
			</div>
			<div class="account-form-inner">
				<div class="account-container">
					<div class="heading-bx left">
						<h2 class="title-head">Sign Up <span>Now</span></h2>
						<p>Login Your Account <a href="login.php">Click here</a></p>

						<?php if (isset($error)) : ?>
							<div class="alert alert-danger">
								<?php echo $error; ?>
							</div>
						<?php endif; ?>
						<?php if (isset($success)) : ?>
							<div class="alert alert-success">
								<?php echo $success; ?>
							</div>
						<?php endif; ?>
					</div>
					<form class="contact-bx" method="POST">
						<div class="row placeani">
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Student Name</label>
										<input name="st_name" value="<?php getValue("st_name") ?>" type="text" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Student Email</label>
										<input name="st_email" value="<?php getValue("st_email") ?>" type="email" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Father Name</label>
										<input name="st_fname" value="<?php getValue("st_fname") ?>" type="text" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Mother Name</label>
										<input name="st_mname" value="<?php getValue("st_mname") ?>" type="text" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Date Of Birth</label>
										<input name="st_birthday" value="<?php getValue("st_birthday") ?>" type="date" class="form-control">
									</div>
								</div>
							</div>

							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Student Phone Number</label>
										<input name="st_phone" value="<?php getValue("st_phone") ?>" type="text" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Father Phone Nmber</label>
										<input name="st_f_phone" value="<?php getValue("st_f_phone") ?>" type="text" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Your Password</label>
										<input name="password" type="password" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Confirm Password</label>
										<input name="confirmpassword" type="password" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<label>Gender</label>
									<br>

									<input type="radio" value="male" name="gender" id="male" checked>
									<label for="male"> Male</label>&nbsp;&nbsp;

									<input type="radio" value="male" name="gender" id="female"> <label for="female"> Female</label>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
									<div class="input-group">
										<label>Address</label>
										<textarea name="address" class="form-control" id=""><?php getValue("address") ?></textarea>
										<!-- <input name="address" type="textarea" class="form-control"> -->
									</div>
								</div>
							</div>
							<div class="col-lg-12 m-b30">
								<button name="st_registration" type="submit" class="btn button-md">Sign Up</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- External JavaScripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
	<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
	<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
	<script src="assets/vendors/counter/waypoints-min.js"></script>
	<script src="assets/vendors/counter/counterup.min.js"></script>
	<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
	<script src="assets/vendors/masonry/masonry.js"></script>
	<script src="assets/vendors/masonry/filter.js"></script>
	<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/contact.js"></script>
	<script src='assets/vendors/switcher/switcher.js'></script>
</body>

</html>