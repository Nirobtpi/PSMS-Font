<?php
require_once("header.php");

$st_id = $_SESSION['st_loggedin']['id'];

$st_regi_class = Student('student', 'current_class', $st_id);

if (isset($_POST['create_btn'])) {
	$class_id = $_POST['class_id'];
	$created_at = date('Y-m-d H:i:s');

	// new class registration 

	$stm = $conn->prepare("INSERT INTO new_class_registration (student_id,register_class,created_at) VALUES(?,?,?)");
	$stm->execute(array($st_id, $class_id, $created_at));

	// update student class 

	$update = $conn->prepare("UPDATE student SET current_class=? WHERE id=?");
	$update->execute(array($class_id, $st_id));

	$success = "Class Registration Success";
}

if ($st_regi_class != Null) {
	$date = date("Y-m-d");

	$stm = $conn->prepare("SELECT * FROM class WHERE start_date <= ? AND end_date >= ? AND id=?");
	$stm->execute(array($date, $date, $st_regi_class));
	$classCount = $stm->rowCount();

	// class Details 

	$classDetails = $stm->fetch(PDO::FETCH_ASSOC);
} else {
	$classCount = 0;
}

?>
<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Class</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>New Class</li>
			</ul>

		</div>
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-6 m-b30">
				<div class="widget-box">
					<?php if ($classCount != 1) : ?>
						<div class="wc-title">
							<h4>New Class Registration</h4>
						</div>
						<?php if (isset($success)) : ?>
							<div class="alert alert-success">
								<?php echo $success; ?>
							</div>
						<?php endif; ?>

						<div class="widget-inner">
							<form class="edit-profile m-b30" method="POST" action="">
								<div class="row">
									<div class="form-group col-12">
										<label class="col-form-label">Select Class</label>
										<div>
											<select name="class_id" id="class" class="form-control">
												<?php
												$date = date('Y-m-d');
												$stm = $conn->prepare("SELECT * FROM class WHERE start_date <= ? AND end_date >= ?");
												$stm->execute(array($date, $date));
												$all_class = $stm->fetchAll(PDO::FETCH_ASSOC);

												foreach ($all_class as $class) :

												?>
													<option value="<?php echo $class['id'] ?>"><?php echo $class['class_name'] ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="seperator"></div>

									<div class="col-12">
										<button type="submit" name="create_btn" class="btn">Save changes</button>
									</div>
								</div>
							</form>
						</div>
					<?php else : ?>
						<div class="wc-title">
							<h4>Class Details</h4>
						</div>
						<div class="widget-inner">
							<div class="edit-profile m-b30">
								<div class="table-responsive">
									<table class="table">
										<tr>
											<td><b>Class Name:</b></td>
											<td><?php echo $classDetails['class_name'] ?></td>
										</tr>
										<tr>
											<td>Subjects:</td>
											<td>

												<?php
												$sub_name =	$classDetails['subjects'];
												$sub_name = json_decode($sub_name);
												// print_r($sub_name);
												foreach ($sub_name as $subject) {
													$sin_sub = Student('subject', 'sub_name', $subject);

													echo $sin_sub . "<br>";
												}



												?>

											</td>
										</tr>
										<tr>
											<td><b>Start Date:</b></td>
											<td><?php echo $classDetails['start_date'] ?></td>
										</tr>
										<tr>
											<td><b>End Date:</b></td>
											<td><?php echo $classDetails['end_date'] ?></td>
										</tr>
									</table>

								</div>
							</div>
						</div>

					<?php endif; ?>


				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>
<?php require_once('footer.php') ?>