<?php
require_once("config.php");
session_start();
$user_id = $_SESSION['st_loggedin']['id'];

if (!isset($_SESSION['st_loggedin'])) {
    header("location:login.php");
}

// session_destroy();

// if (isset($_POST['email_code_send_btn'])) {
//     $user_email = $_SESSION['st_loggedin']['email'];

//     $email_code = rand(9999, 999999);

//     $subject = "PSMS- Email Varification.";


//     $message = "
//     <html>
//     <head>
//     <title>Email Varification.</title>
//     </head>
//     <body>
//     <p><b>Email Varification.</b></p>
//     <table>
//     <tr>
//     <th>Code</th>
//     <th>" . $email_code . "</th>
//     <th>Lastname</th>
//     </tr>
//     <p>Thanks.</p>
//     </table>
//     </body>
//     </html>";

//     // Always set content-type when sending HTML email
//     $headers = "MIME-Version: 1.0" . "\r\n";
//     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

//     $headers .= 'From: <' . $_SESSION['st_loggedin']['email'] . '>' . "\r\n";

//     $send_mail = mail($user_email, $subject, $message, $headers);

//     if ($send_mail == true) {
//         $stm = $conn->prepare("UPDATE student SET email_code=? WHERE id=? AND email=?");
//         $stm->execute(array($email_code, $user_id, $_SESSION['st_loggedin']['email']));

//         $_SESSION['email_code_send'] == 1;
//         $success = "Code Send Successfully Please Cheek your EMail";
//     } else {
//         $error = "Email Send Failed!";
//     }
// };


// // email varify 

// if (isset($_POST['email_varify'])) {
//     $email_code = $_POST['email_code'];
//     $dbCode = Student('student', 'email_code', $user_id);
//     echo $dbCode;

//     if (empty($email_code)) {
//         $error = "Email Code is Required!";
//     } elseif ($email_code != $dbCode) {
//         $error = "Envalid Code!";
//     } else {
//         $stm = $conn->prepare("UPDATE student SET email_code=?,is_email_verifed=? WHERE id=? AND email=?");
//         $stm->execute(array(null, 1, $user_id, $_SESSION['st_loggedin']['email']));
//         unset($_SESSION['email_code_send']);
//         $success = "Your Email Varify Success";
//     }
// }

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
    <meta name="description" content="PSMS - Student Varifican" />

    <!-- OG -->
    <meta property="og:title" content="PSMS - Student Varifican" />
    <meta property="og:description" content="PSMS - Student Varifican" />
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
                        <h2 class="title-head">Student <span>Varifican</span></h2>
                        <p class="mb-3"><?php echo $_SESSION['st_loggedin']['name'] ?> Please Varify Your Account</p>

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

                        <!-- varifaction code  -->

                        <p>Email:
                            <?php if ($_SESSION['st_loggedin']['is_email_verifed'] === 1) {
                                echo "<span class='badge badge-success'> Email Varified! </span>";
                            } else {
                                echo "<span class='badge badge-danger'> Email Not Varified! </span>";
                            }
                            ?>
                        </p>
                        <p>Mobile:
                            <?php if ($_SESSION['st_loggedin']['is_mobile_verifed'] === 1) {
                                echo "<span class='badge badge-success'> Mobile Varified! </span>";
                            } else {
                                echo "<span class='badge badge-danger'> Mobile Not Varified! </span>";
                            }
                            ?>
                        </p>
                    </div>
                    <?php if (isset($_SESSION['email_code_send']) == 1) : ?>

                        <form class="contact-bx" method="POST">
                            <div class="row placeani">
                                <div class="col-lg-12 m-b30">
                                    <button name="email_code_send_btn" type="submit" value="Submit" class="btn button-md">Resend Code</button>
                                </div>
                            </div>
                        </form>

                        <form class="contact-bx" method="POST">
                            <div class="row placeani">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label>Email Code</label>
                                            <input name="email_code" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 m-b30">
                                    <button name="email_varify" type="submit" value="Submit" class="btn button-md">Email Varify</button>
                                </div>
                            </div>
                        </form>

                    <?php else : ?>
                        <form class="contact-bx" method="POST">
                            <div class="row placeani">
                                <div class="col-lg-12 m-b30">
                                    <button name="email_code_send_btn" type="submit" value="Submit" class="btn button-md">Click To Varify Your Email</button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>

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
    <!-- <script src='assets/vendors/switcher/switcher.js'></script> -->
</body>

</html>