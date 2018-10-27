<?php

// Check and filter the input
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
    $comments = trim(filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_SPECIAL_CHARS));
    // Check for values in form fields
    if ($name == "" || $email == "" || $comments == "") {
        $error_message = "Please fill in the required fields: Full Name, Email, and Comments";
    }
    // Checking if hidden address form is filled out for humans
    if (!isset($error_message) && $_POST['address'] != "") {
        $error_message = "Bad form input";
    }

    if (!isset($error_message)) {
        // Start setting up the email to catering department contact
        // Set the email addresses here
        $confirm_to = $email;
        
        // Set subjects
        $confirm_subject = "Contact Form Submitted Successfully!";

        // Build and email confirmation for the guest
        $confirmation_msg = '
        <html>
        <head>
            <title>Thank You For Your Input!</title>
        </head>
        <body>
        <h4>Thank You for your email ' . ucwords($name) . '</h4>
        <p>Someone will respond to you shortly at the email address you provided!</p>
        </body>
        </html>';

        // Settings for the confirmation email
        $confirm_from = "christian@afkdeveloper.com";
        $headers_confirm = "MIME-Version: 1.0" . "\r\n";
        $headers_confirm .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        $headers_confirm .= "From: $confirm_from" . "\r\n";

        // Send Confirmation Email
        mail($confirm_to, $confirm_subject, $confirmation_msg, $headers_confirm);
        
        // Submission Email in function
        require_once 'inc/submit.php';
        if (submitEmail($name, $email, $phone, $comments)) {
            // Redirect to say Thank You
            header('location: contacts.php?status=thanks');
        }
    }
}


$pageWallpaper = 'contact-wp';
$pageTitle = 'Contact Us';
include 'inc/header.php';



?>
<!-- Start BODY CONTENT FOR CONTACT PAGE HERE -->
<div id="contact-wrapper">


    <div id="contact-panel" class="container">
        <div class="row">
            <img src="images/contact-sign.png" class="img-fluid" alt="contact us" id="contact-sign">
        </div>

        <!-- Form message here -->
        <div class="form-msg col-sm-12 col-md-6">
            <?php
                if (isset($_GET['status']) && $_GET['status'] == 'thanks') {
                    ?>
            <h5 class="text-center pl-5 success-msg">Thanks for the email! Someone will reach out to you as soon as possible!</h5>
            <?php
                } else {
                    if (isset($error_message)) {
                        ?>
            <h5 class="pl-2 error-msg text-center">
                <?= $error_message ?>
            </h5>
            <?php
                    } else {
                        ?>
            <h5 class="text-center pl-5">Let us know if you have any comments or suggestions, send us an email!</h5>
            <?php
                    }
                }
?>
        </div>

        <!-- Start Contact Form Here  -->
        <section class="contact-form">
            <form action="" method="post">
                <legend>Contact Us</legend>
                <!-- Full Name Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nameField">Full Name</label>
                    <input type="text" class="form-control" id="nameField" placeholder="Full Name" name="name" value=" <?php if (isset($name)) {
    echo $name;
} ?> ">
                </div>

                <!-- Email Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="emailField">Email Address</label>
                    <input type="email" class="form-control" id="emailField" placeholder="Email Address" name="email"
                        value=" <?php if (isset($email)) {
    echo $email;
} ?> ">
                </div>

                <!-- Phone Number Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="phoneField">Phone Number</label>
                    <input type="tel" class="form-control" id="phoneField" placeholder="ie: 561-555-5545" name="phone"
                        value=" <?php if (isset($phone)) {
    echo $phone;
} ?> ">
                </div>

                <!-- Comments Field Here -->
                <div class="form-group col-sm-12 col-md-6">
                    <label for="comments">Comments & Suggestions</label>
                    <textarea name="comments" id="comments" class="form-control" rows="5">
                    </textarea>
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