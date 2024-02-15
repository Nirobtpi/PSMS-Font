<?php
require_once("config.php");
session_start();
$user_id = $_SESSION['st_loggedin']['id'];
$user_email = $_SESSION['st_loggedin']['email'];

// email code send 
if (isset($_POST['email_code_send'])) {
    $email_code = rand(9999, 999999);

    $stm = $conn->prepare("UPDATE student SET email_code=? WHERE id=? and email=?");
    $send_code = $stm->execute(array($email_code, $user_id, $user_email));

    if ($send_code == true) {
        $_SESSION['email_status'] = 1;

        $success = "Varification Code Send Successfully! Please Cheek Your Registration Email!";
    }
}
// email code resend
if (isset($_POST['resend_email_code_send'])) {
    $email_code = rand(9999, 999999);

    $stm = $conn->prepare("UPDATE student SET email_code=? WHERE id=? and email=?");
    $send_code = $stm->execute(array($email_code, $user_id, $user_email));

    $success = "Resend Varification Code Send Successfully! Please Cheek Your Registration Email!";
}
// email code varifi 
if (isset($_POST['email_varify'])) {
    $email_varify = $_POST['db_code'];
    $db_code = Student('student', 'email_code', $user_id);

    if (empty($email_varify)) {
        $error = "Please Enter Your Varification Code";
    } elseif ($email_varify != $db_code) {
        $error = "Invalid Varification Code!";
    } else {
        $stm = $conn->prepare("UPDATE student SET email_code= ?, is_email_verifed= ? WHERE id=?");
        $stm->execute(array(null, 1, $user_id));

        $success = "Email Varification Success!";
    }
}



// send mobile code varification 

if (isset($_POST['st_mobile_code_Send'])) {
    $mobile_code = rand(9999, 999999);

    $stm = $conn->prepare("UPDATE student SET mobile_code=? WHERE id=?");
    $res = $stm->execute(array($mobile_code, $user_id));

    if ($res == true) {
        $_SESSION['mobile_varify'] = 1;
        $success = "Mobile Code Send Successfully! Please Cheek Your Phone Number!";
    }
}

if(isset($_POST['st_mobile_varify'])){
    $mobile_varify_code=$_POST['st_mobile_code'];
    $db_mobile_code=Student('student','mobile_code',$user_id);

    if(empty($mobile_varify_code)){
        $error="Please Enter Your Varification Code";
    }elseif($mobile_varify_code != $db_mobile_code){
        $error="Invalid! Code";
    }else{
        $stm=$conn->prepare("UPDATE student SET is_mobile_verifed=?,mobile_code=? WHERE id=?");
        $stm->execute(array(1,null,$user_id));
        $success="Mobile Varification SUccess!";
    }
}
if(isset($_POST['st_mobile_resend_code'])){

    $mobile_resend_code=rand(9999,999999);

        $stm=$conn->prepare("UPDATE student SET mobile_code=? WHERE id=?");
        $stm->execute(array($mobile_resend_code,$user_id));
        $success="Mobile Varification Resend SUccess!";
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
    <meta name="description" content="PSMS - Student Varification" />

    <!-- OG -->
    <meta property="og:title" content="PSMS - Student Varification" />
    <meta property="og:description" content="PSMS - Student Login" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON ============================================= -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />

    <!-- PAGE TITLE HERE ============================================= -->
    <title>PSMS - Student Login</title>

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

                        <h2 class="title-head">Student <span>Varification</span></h2>
                        <p class="mb-3"><?php echo $_SESSION['st_loggedin']['name'] ?> Please Varify Your Account!</p>

                        <?php
                        $email_Status = Student('student', 'is_email_verifed', $user_id);
                        $mobile_Status = Student('student', 'is_mobile_verifed', $user_id);

                        if($email_Status ==1 AND $mobile_Status ==1){
                            header("location:index.php");
                        }

                        ?>
                        <?php if ($email_Status == 1) : ?>
                            <p>Email: <span class="badge badge-success">Varified</span></p>
                        <?php else : ?>
                            <p>Email: <span class="badge badge-danger">Not Varified</span></p>
                        <?php endif; ?>


                        <?php if ($mobile_Status == 1) : ?>
                            <p>Mobile: <span class="badge badge-success">Varified</span></p>
                        <?php else : ?>
                            <p>Mobile: <span class="badge badge-danger">Not Varified</span></p>
                        <?php endif; ?>

                        <!-- email code send  -->
                        <?php if ($email_Status != 1) : ?>
                            <?php if (isset($_SESSION['email_status']) == 1) : ?>
                                <!-- email code vafify field  -->
                                <form method="POST">
                                    <div class="row placeani">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input name="db_code" type="text" class="form-control" placeholder="Enter Your Code">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 m-b30">
                                            <button name="email_varify" type="submit" value="Submit" class="btn button-md">Email Varify</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- email code Resend  -->
                                <form class="contact-bx" method="POST">
                                    <div class="email-varify mt-4">
                                        <form class="contact-bx" method="POST">
                                            <div class="row placeani">
                                                <div class="col-lg-12 m-b30">
                                                    <button name="resend_email_code_send" type="submit" value="Submit" class="btn button-md">Resend Email Code</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                                <!-- email code re send field  -->
                            <?php endif; ?>
                        <?php endif; ?>
                        <!-- email code vafify field end -->

                        <?php if ($email_Status != 1 and !isset($_SESSION['email_status'])) : ?>
                            <div class="email-varify mt-4">
                                <form class="contact-bx" method="POST">
                                    <div class="row placeani">
                                        <div class="col-lg-12 m-b30">
                                            <button name="email_code_send" type="submit" value="Submit" class="btn button-md">Send Email Code</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>

                    </div>

                    <!-- email code send  -->



                    <!-- mobile code send varification  -->
                    <?php if($mobile_Status !=1): ?>
                    <?php if (isset($_SESSION['mobile_varify']) == 1) : ?>
                        <form class="contact-bx" method="POST">
                            <div class="row placeani">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Mobile Varification Code</label>
                                            <input name="st_mobile_code" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 m-b30">
                                    <button name="st_mobile_varify" type="submit" value="Submit" class="btn button-md">Mobile Varify</button>
                                </div>
                            </div>
                        </form>


                        <form class="contact-bx" method="POST">
                            <div class="row placeani">
                                <div class="col-lg-12 m-b30">
                                    <button name="st_mobile_resend_code" type="submit" value="Submit" class="btn button-md">Mobile Resend Code</button>
                                </div>
                            </div>
                        </form>

                    <?php endif; ?>
                    <?php endif; ?>


                    <!-- Hide Send Code Button  -->
                    <?php if ($mobile_Status != 1 and !isset($_SESSION['mobile_varify'])) : ?>
                        <form class="contact-bx" method="POST">
                            <div class="row placeani">
                                <div class="col-lg-12 m-b30">
                                    <button name="st_mobile_code_Send" type="submit" value="Submit" class="btn button-md">Send Mobile Code</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php 
 unset($_SESSION['email_status']);
 unset($_SESSION['mobile_varify'])
?>
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
    <!-- <script src='assets/vendors/switcher/switcher.js'></script> -->
</body>

</html>