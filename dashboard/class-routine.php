<?php
require_once("header.php");

$st_id = $_SESSION['st_loggedin']['id'];

$st_regi_class = Student('student', 'current_class', $st_id);


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
				<li>Class Routine</li>
			</ul>

		</div>
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-12 m-b30">
				<div class="widget-box">
					<?php if (isset($success)) : ?>
						<div class="alert alert-success">
							<?php echo $success; ?>
						</div>
					<?php endif; ?>
					<?php if ($classCount == 1) :  ?>
						<div class="wc-title">
							<h4>Class Routine</h4>
							<?php
							$stm = $conn->prepare("SELECT * FROM class_routine WHERE class_name=?");
							$stm->execute(array($st_regi_class));
							$routine_details = $stm->fetchAll(PDO::FETCH_ASSOC);
							?>
						</div>
						<div class="widget-inner">
							<div class="edit-profile m-b30">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Class Name</th>
												<th>Subjct Name</th>
												<th>Teacher Name</th>
												<th>Day</th>
												<th>Start Time</th>
												<th>End Time</th>
												<th>Rome Number</th>
											</tr>
										</thead>
										<tbody>
											<?php $i = 1;
											foreach ($routine_details as $routine) : ?>
												<tr>

													<td><?php echo $i;
														$i++ ?></td>
													<td><?php
														echo Student("class", 'class_name', $routine['class_name']);
														?></td>
													<td><?php
														echo Student("subject", 'sub_name', $routine['subject_id']);
														?></td>
													<td><?php
														echo Student("teachers", 'name', $routine['teacher_id']);
														?></td>
													<td><?php echo $routine['day'] ?></td>
													<td><?php echo $routine['time_from'] ?></td>
													<td><?php echo $routine['time_to'] ?></td>

													<td><?php echo $routine['room_number'] ?></td>

												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>

								</div>
							</div>
						</div>
					<?php else : ?>
						<div class="alert alert-danger">
							Please Register A Class
						</div>
					<?php endif; ?>


				</div>
			</div>
			<!-- Your Profile Views Chart END-->
		</div>
	</div>
</main>
<?php require_once('footer.php') ?>