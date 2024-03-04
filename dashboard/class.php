<?php
require_once("header.php");

$st_id = $_SESSION['st_loggedin']['id'];

if (isset($_POST['create_btn'])) {
	$class_id = $_POST['class_id'];
	$created_at = date('Y-m-d H:i:s');

	// new class registration 

	$stm = $conn->prepare("INSERT INTO new_class_registration (student_id,register_class,created_at) VALUES(?,?,?)");
	$stm->execute(array($st_id, $class_id, $created_at));

	// update student class 

	$update=$conn->prepare("UPDATE student SET current_class=? WHERE id=?");
	$update->execute(array($class_id,$st_id));

	$success = "Class Registration Success";
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

					<div class="wc-title">
						<h4>New Class Registration</h4>
					</div>
					<?php if(isset($success)): ?>
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


				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>
<?php require_once('footer.php') ?>