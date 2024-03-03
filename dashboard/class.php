<?php
require_once("header.php")
?>
<!--Main container start -->
<main class="ttr-wrapper">
	<div class="container-fluid">
		<div class="db-breadcrumb">
			<h4 class="breadcrumb-title">Class</h4>
			<ul class="db-breadcrumb-list">
				<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
				<li>Class</li>
			</ul>
		</div>
		<div class="row">
			<!-- Your Profile Views Chart -->
			<div class="col-lg-6 m-b30">
				<div class="widget-box">
					<?php
					$all_class = AllTableData("class");
					// print_r($all_class);

					?>

					<div class="wc-title">
						<h4>Class</h4>
					</div>
					<div class="widget-inner">
						<form class="edit-profile m-b30">
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Select Class</label>
									<div>
										<select name="class" id="class" class="form-control">
											<?php foreach ($all_class as $class) : ?>
												<option value="<?php echo $class['id'] ?>"><?php echo $class['class_name'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="seperator"></div>

								<div class="col-12">
									<button type="submit" class="btn">Save changes</button>
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