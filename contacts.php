<?php
// Start the session
session_start();
// Grab Users Name for the Session
$_SESSION['user'] = array();
// Import PHPMailer into global namespace
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;

// Check and filter the input
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $_SESSION['user']['name'] = $name;
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $_SESSION['user']['email'] = $email;
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
    $_SESSION['user']['phone'] = $phone;
    $comments = trim(filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_SPECIAL_CHARS));
    
    // Checking if hidden address form is filled out for humans
    if (!isset($error_message) && $_POST['address'] != "") {
        $error_message = "Bad form input";
    }

    // Validate email address
    if (!isset($error_message) && !PHPMailer::validateAddress($email)) {
        $error_message = 'Invalid email address';
    }

    // Check if error message is set
    if (!isset($error_message)) {
        // include once the login constants
        include_once 'inc/login.php';
        //////// Start Submission Email /////////
        $msg_body = "Contact Form Submitted on " . date('m-d-Y') . "\n";
        $msg_body .= "From: " . ucwords($name) . "\n";
        $msg_body .= "Email Address: " . $email . "\n";
        $msg_body .= "Phone Number: " . $phone . "\n";
        $msg_body .= "Message Body: " . $comments . "\n";

        $mail = new PHPMailer;
        $mail->isSMTP();
        // $mail->SMTPDebug = 2;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = GMAIL_USER;
        $mail->Password = APP_PASS;
        // set who the email is sent from
        $mail->setFrom('christian@farmerstableboca.com', 'Catering Department');
        // set who the email is sent to
        $mail->addAddress('christian@farmerstableboca.com', 'Christian Martins');
        // attach subject and body to the email
        $mail->Subject = 'Contact Form Submission ' . date('d-m-Y');
        $mail->Body = $msg_body;
        ///////// End Submission Email /////////

        if ($mail->send()) {
         
            ////// Start Thank You Email //////////
            $mail = new PHPMailer;
            $mail->isSMTP();
            // $mail->SMTPDebug = 2;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = GMAIL_USER;
            $mail->Password = APP_PASS;
            // set who the email is sent from
            $mail->setFrom('christian@farmerstableboca.com', 'Catering Department');
            // set who the email is sent to
            $mail->addAddress($email, 'Christian Martins');
            // attach subject and body to the email
            $mail->Subject = 'Contact Form Submitted on ' . date('d-m-Y');
            $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
            $mail->AltBody = $confirmation_body;
            if ($mail->send()) {
                header('location: index.php?status=thanks');
                exit;
            }
            $error_message = "Mailer Error: " . $mail->ErrorInfo;
            ////////// End Thank You Email ////////////
        }
    }
}

$pageTitle = 'Contact Us';
include 'inc/header.php';
?>

<!-- Start BODY CONTENT FOR CONTACT PAGE HERE -->
<div class="animsition">

    <div id="contact-panel" class="container">
        <div class="row">
            <img src="images/contact-sign.png" class="img-fluid" alt="contact us" id="contact-sign">
        </div>

        <!-- Form message here -->
        <div class="form-msg col-sm-12 col-md-6">
            <?php
            if (isset($error_message)) {
                echo "<h5 class='error-msg-contact'>";
                echo "There was an Error: {$error_message}";
                echo "</h5>";
            } else {
                echo "<h5 class='default-msg-contact'>";
                echo "Have a suggestion? Help us provide a better experience for YOU! Fill out the Contact Form Below";
                echo "</h5>";
            }
            ?>
        </div>
        <!-- Start Contact Form Here  -->
        <section class="contact-form">
            <form action="" method="post" id='contact-form'>
                <legend>Contact Us</legend>
                <!-- Full Name Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nameField">Full Name</label>
                    <input type="text" class="form-control" id="nameField" placeholder="Full Name" name="name" value="<?php if (isset($name) && $name != "") {
                echo trim($name);
            } ?>">
                <span class="empty-name display-none">Please fill in the required field</span>
                </div>

                <!-- Email Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="emailField">Email Address</label>
                    <input type="email" class="form-control" id="emailField" placeholder="Email Address" name="email" 
                        value="<?php if (isset($email)) {
                echo trim($email);
            } ?>">
                <span class="empty-email display-none">Please fill in the required field</span>
                </div>

                <!-- Phone Number Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="phoneField">Phone Number</label>
                    <input type="tel" class="form-control" id="phoneField" placeholder="ie: 561-555-5545" name="phone"
                        value="<?php if (isset($phone)) {
                echo trim($phone);
            } ?>">
                <span class="empty-phone display-none">Please fill in the required field</span>
                </div>

                <!-- Comments Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="comments">Comments & Suggestions</label>
                    <textarea name="comments" placeholder='Message Here' id="comments" class="form-control" rows="5"></textarea>
                    <span class="empty-comments display-none">Please fill in the required field</span>
                </div>

                <!-- Hidden Field Here -->
                <div class="hidden-field">
                    <input type="text" id="address" name="address">
                    <p>Please leave this field blank!</p>
                </div>

                <!-- Submit Here -->
                <div class="form-group col-4">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </section>
    </div> <!-- END CONTENT BODY HERE -->
 
    <?php
    include 'inc/footer.php';
    ?>