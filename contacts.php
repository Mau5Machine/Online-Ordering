<?php
// Start the session
session_start();

// Grab Users Name for the Session
$_SESSION['user'] = array();

// include the functions file
include 'inc/functions.php';

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

    // Check if error message is set
    if (!isset($error_message)) {
       
        // Build the subject and body of the SUBMIT EMAIL
        // Define the subject
        $subject = 'Contact Form Submission ' . date('d-m-Y');
        // Build the Message Body
        $msg_body = "Contact Form Submitted on " . date('m-d-Y') . "<br>";
        $msg_body .= "From: <strong>" . ucwords($name) . "</strong><br>";
        $msg_body .= "Email Address: <strong>" . $email . "</strong><br>";
        $msg_body .= "Phone Number: <strong>" . $phone . "</strong><br>";
        $msg_body .= "Message Body: <strong>" . $comments . "</strong><br>";

        if (sendSubmitEmail($msg_body, $subject)) {
            
            // Build the subject and body of the THANK YOU EMAIL
            $msgHTML = 'contents.html';
            $tySubject = 'Contact Form Submitted on ' . date('m-d-Y');

            if (sendThankYouEmail($email, $name, $tySubject, $msgHTML)) {
                header('location:index.php?status=thanks');
                exit;
            }
        }
    }
}

$pageTitle = 'Contact Us';
include_once 'inc/header.php';
?>

<!-- Start BODY CONTENT FOR CONTACT PAGE HERE -->
<div class="contact-wrapper">

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
                </div>

                <!-- Email Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="emailField">Email Address</label>
                    <input type="email" class="form-control" id="emailField" placeholder="Email Address" name="email" 
                        value="<?php if (isset($email)) {
                echo trim($email);
            } ?>">
                </div>

                <!-- Phone Number Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="phoneField">Phone Number</label>
                    <input type="tel" class="form-control" id="phoneField" placeholder="ie: 561-555-5545" name="phone"
                        value="<?php if (isset($phone)) {
                echo trim($phone);
            } ?>">
                </div>

                <!-- Comments Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="comments">Comments & Suggestions</label>
                    <textarea name="comments" placeholder='Message Here' id="comments" class="form-control" rows="5"><?php if (isset($comments)) {
                echo trim($comments);
            } ?></textarea>
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
    include_once 'inc/footer.php';
    ?>