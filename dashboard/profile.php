<?php
require_once("header.php");
$id = $_SESSION['st_loggedin']['id'];


$data = getUserData('student', $id);


?>
<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Profile</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                <li>Profile</li>
            </ul>
        </div>
        <!-- Card -->
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card text-start shadow">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td><b>Name :</b></td>
                                <td><?php echo $data['name']; ?></td>
                            </tr>
                            <tr>
                                <td><b>Email :</b></td>
                                <td><?php
                                    echo $data['email'];
                                    if ($data['is_email_verifed'] == 1) {
                                        echo ' <i style="color:green" class="fa-solid fa-circle-check"></i>';
                                    }

                                    ?></td>
                            </tr>
                            <tr>
                                <td><b>Mobile Number :</b></td>
                                <td><?php echo $data['mobile'];
                                    if ($data['is_mobile_verifed'] == 1) {
                                        echo ' <i style="color:green" class="fa-solid fa-circle-check"></i>';
                                    }
                                    ?></td>
                            </tr>
                            <tr>
                                <td><b>Father's Name :</b></td>
                                <td><?php echo $data['father_name'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Father's Mobile Number :</b></td>
                                <td><?php echo $data['father_mobile'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Mothers's Name :</b></td>
                                <td><?php echo $data['mother_name'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Gender :</b></td>
                                <td><?php echo $data['gender'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Date Of Birth :</b></td>
                                <td><?php echo $data['birthday'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Address :</b></td>
                                <td><?php echo $data['address'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Roll :</b></td>
                                <td><?php echo $data['roll'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Roll :</b></td>
                                <td><?php echo $data['roll'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Current Class :</b></td>
                                <td><?php echo $data['current_class'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Registration Date :</b></td>
                                <td><?php echo date("Y-m-d",strtotime($data['registration_date'])) ?></td>
                            </tr>
                            <tr>
                                <td><a href="edit-profile.php" class="btn btn-info">Edit Profile</a></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- Card END -->
    </div>
</main>
<div class="ttr-overlay"></div>


<?php require_once('footer.php'); ?>