<?php
require_once("header.php");
$id = $_SESSION['st_loggedin']['id'];

if (isset($_POST['change_password'])) {
    $current_pass = $_POST['currentpass'];
    $new_pass = $_POST['newpass'];
    $confirm_new_pass = $_POST['confirmpass'];

    $hash_current_pass = SHA1($current_pass);

    $dbpass_pass = Student('student', 'password', $id);

    if (empty($current_pass)) {
        $error = "Please Enter Your Current Password";
    } elseif (empty($new_pass)) {
        $error = "Please Enter Your New Password";
    } elseif (empty($confirm_new_pass)) {
        $error = "Please Enter Your Confirm Password";
    } elseif ($new_pass != $confirm_new_pass) {
        $error = "New Password Or Confirm Password Does Not Match";
    } elseif (strlen($new_pass) < 6 || strlen($new_pass) > 15) {
        $error = "Password Must Be Used 6 to 15 Digit";
    } elseif ($hash_current_pass != $dbpass_pass) {
        $error = "Your Password Is Wrong";
    } else {
        $new_pass = SHA1($new_pass);

        $stm = $conn->prepare("UPDATE student SET password=? WHERE id=?");
        $stm->execute(array($new_pass, $id));

        $success = "Your Password Change Successfully!";

?>
        <script>
            setTimeout(function() {
                window.location="logout.php";
            }, 2000)
        </script>
<?php
    }
}

?>
<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <div class="db-breadcrumb">
            <h4 class="breadcrumb-title">Profile</h4>
            <ul class="db-breadcrumb-list">
                <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
                <li>Change Password</li>
            </ul>
        </div>
        <!-- Card -->
        <div class="row">
            <div class="col-md-6 offset-2">
                <div class="card text-start shadow">
                    <div class="card-body">
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

                        <h4 class="card-title my-3">Change Password</h4>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="currentpass" class="form-label">Current Pasword</label>
                                <input type="password" class="form-control" name="currentpass" id="currentpass" placeholder="Enter Your Current Pasword" />
                            </div>

                            <div class="mb-3">
                                <label for="newpass" class="form-label">New Pasword</label>
                                <input type="password" class="form-control" name="newpass" id="newpass" placeholder="Enter Your New Pasword" />
                            </div>
                            <div class="mb-3">
                                <label for="confirmpass" class="form-label">Confirm New Pasword</label>
                                <input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="Enter Your New Pasword" />
                            </div>

                            <input type="submit" class="btn btn-sucess" name="change_password" value="Change Password">

                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- Card END -->
    </div>
</main>
<div class="ttr-overlay"></div>


<?php require_once('footer.php'); ?>