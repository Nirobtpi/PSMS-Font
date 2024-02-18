<?php
require_once("header.php");

$id = $_SESSION['st_loggedin']['id'];

$editData = getUserData('student', $id);

if (isset($_POST['update_data'])) {
	$st_name = $_POST['st_name'];
	$st_f_name = $_POST['st_f_name'];
	$st_f_m_number = $_POST['st_f_m_mumber'];
	$st_m_name = $_POST['st_m_name'];
	$st_m_name = $_POST['st_m_name'];
	$st_address = $_POST['st_address'];
	$st_gender = $_POST['gender'];
	$patten = '/^(?:\+88|88)?(01[3-9]\d{8})$/';

	// file upload 
	$file = $_FILES['file']['name'];
	$terget_dir = '../uploads/';
	$terget_file = $terget_dir . basename($_FILES['file']['name']);
	$fileExtention = strtolower(pathinfo($terget_file, PATHINFO_EXTENSION));


	if (empty($st_name)) {
		$error = "Please Enter Your Name";
	} elseif (empty($st_f_name)) {
		$error = "Enter Your Father Name";
	} elseif (empty($st_f_m_number)) {
		$error = "Please Enter Your Father Mobile Number";
	} elseif (!preg_match($patten, $st_f_m_number)) {
		$error = "Please Enter a Valid Number";
	} elseif (empty($st_m_name)) {
		$error = "Please Enter Your Mother Number";
	} elseif (empty($st_address)) {
		$error = "Please Enter Your Address";
	} elseif (!isset($st_gender)) {
		$error = "Please Enter Your Gender";
	} elseif (empty($file)) {
		$error = "Please ENter Your Photo";
	} elseif ($fileExtention != "jpg" and $fileExtention != "png" and $fileExtention != "jpeg" and $fileExtention != "gif") {
		$error = "File Must Be Used Jpeg,Png,jpg Or Gif";
	} else {
		unset($_POST);
		// photo Upload
		$newPhotoname = $id . "-" . rand(1111, 9999) . "." . $fileExtention;
		move_uploaded_file($_FILES["file"]["tmp_name"], $terget_dir . $newPhotoname);
		// photo Upload 

		$stm = $conn->prepare("UPDATE student SET name=?,father_name=?,father_mobile=?,mother_name=?,gender=?,address=?, photo=? WHERE id=?");
		$res = $stm->execute(array($st_name, $st_f_name, $st_f_m_number, $st_m_name, $st_gender, $st_address, $newPhotoname, $id));

		$success = "Data Update Successfully";

?>
		<script>
			setTimeout(function() {
				window.location = 'profile.php';
			}, 1000);
		</script>
<?php

	}
}


?>
<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Update Profile</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Update Profile</li>
			</ul>
		</div>
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<div class="wc-title">
						<h4>Update Profile</h4>
					</div>
					<div class="widget-inner">
						<div class="edit-profile m-b30">
							<div class="col-sm-6">
								<?php if (isset($error)) : ?>
									<div class="alert alert-danger">
										<?php echo $error;  ?>
									</div>
								<?php endif; ?>
								<?php if (isset($success)) : ?>
									<div class="alert alert-success">
										<?php echo $success;  ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="">
								<form action="" method="POST" enctype="multipart/form-data">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Name</label>
										<div class="col-sm-7">
											<input class="form-control" name="st_name" type="text" value="<?php echo $editData['name'] ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-7">
											<input class="form-control" name="st_email" type="text" value="<?php echo $editData['email'] ?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Phone Number</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $editData['mobile'] ?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Father's Name</label>
										<div class="col-sm-7">
											<input class="form-control" name="st_f_name" type="text" value="<?php echo $editData['father_name'] ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Father's Mobile</label>
										<div class="col-sm-7">
											<input class="form-control" name="st_f_m_mumber" type="text" value="<?php echo $editData['father_mobile'] ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Mothers's Name</label>
										<div class="col-sm-7">
											<input class="form-control" name="st_m_name" type="text" value="<?php echo $editData['mother_name'] ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Photo</label>
										<div class="col-sm-7">
											<input type="file" name="file" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Address</label>
										<div class="col-sm-7">
											<textarea class="form-control" name="st_address"><?php echo $editData['address'] ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Gender</label>

										<input type="radio" <?php if ($editData['gender'] == "male") {
																echo "checked";
															} ?> value="male" name="gender" id="male">

										<label for="male" style="margin-top: 10px;">&nbsp;&nbsp Male</label>&nbsp;&nbsp;

										<input type="radio" <?php if ($editData['gender'] == 'female') {
																echo "checked";
															} ?> value="male" name="gender" id="female"> <label for="female" style="margin-top: 10px;">&nbsp;&nbsp Female</label>
									</div>
									<div class="row">
										<div class="col-sm-2">
										</div>
										<div class="col-sm-7">
											<button type="submit" name="update_data" class="btn">Save changes</button>
										</div>
									</div>

								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>
<div class="ttr-overlay"></div>
<?php
require_once("footer.php")
?>