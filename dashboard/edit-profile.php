<?php
require_once("header.php");

$id = $_SESSION['st_loggedin']['id'];

$editData = getUserData('student', $id);

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
						<form class="edit-profile m-b30">
							<div class="">
								<form action="" method="POST">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Name</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $editData['name'] ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $editData['email'] ?>" readonly>
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
											<input class="form-control" type="text" value="<?php echo $editData['father_name'] ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Father's Mobile</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $editData['father_mobile'] ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Mothers's Name</label>
										<div class="col-sm-7">
											<input class="form-control" type="text" value="<?php echo $editData['mother_name'] ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Address</label>
										<div class="col-sm-7">
											<textarea class="form-control"><?php echo $editData['address'] ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Gender</label>

										<input type="radio" <?php if ($editData['gender'] == "male") { echo "checked";} ?> value="male" name="gender" id="male">

										<label for="male" style="margin-top: 10px;">&nbsp;&nbsp Male</label>&nbsp;&nbsp;

										<input type="radio" <?php if($editData['gender'] == 'female'){ echo "checked";} ?> value="male" name="gender" id="female"> <label for="female" style="margin-top: 10px;">&nbsp;&nbsp Female</label>
									</div>
									<div class="row">
										<div class="col-sm-2">
										</div>
										<div class="col-sm-7">
											<button type="submit" class="btn">Save changes</button>
										</div>
									</div>

								</form>
							</div>
					</div>
					</form>

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