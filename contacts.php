<?php
// Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
// Check and filter the input
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
    $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
    $comments = trim(filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_SPECIAL_CHARS));
    // Check for values in form fields
    if ($first_name == "" || $last_name == "" || $email == "" || $comments == "") {
        $error_message = "Please fill in the required fields: First Name, Last Name, Email, and Comments";
    }
    // Checking if hidden address form is filled out for humans
    if (!isset($error_message) && $_POST['address'] != "") {
        $error_message = "Bad form input";
    }
    // Checking if the email address is valid
    if (!isset($error_message) && !PHPMailer::validateAddress($email)) {
        $error_message = "Invalid Email Address";
    }

    if (!isset($error_message)) {
        // Build email body
        $email_body = "";
        $email_body .= "First Name: " . $first_name . "\n";
        $email_body .= "Last Name: " . $last_name. "\n";
        $email_body .= "Email: " . $email. "\n";
        $email_body .= "Phone Number: " . $phone. "\n";
        $email_body .= "\n\nComments\n\n";
        $email_body .= "Comments: " . $comments. "\n";
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
            <img src="images/contact-sign.png" alt="contact us" id="contact-sign">
            <?php
                if (isset($_GET['status']) && $_GET['status'] == 'thanks') {
                    echo '<p>Thanks for the email! I&rsquo;ll check out your comments shortly!</p>';
                } else {
                    if (isset($error_message)) {
                        echo "<p class='danger'>" . $error_message . "</p>";
                    } else {
                        echo '<p>If you think there is something missing let me know, complete the form to send me an email!</p>';
                    }
                }

?>
        </div>

        <section class="contact-form">
            <form action="" method="post">
                <legend>Contact Us</legend>
                <div class="form-group col-6">
                    <label for="firstNameField">First Name</label>
                    <input type="text" class="form-control" id="firstNameField" placeholder="First Name" name="first_name"
                        required value=" <?php if (isset($first_name)) {
    echo $first_name;
} ?> ">
                </div>
                <div class="form-group col-6">
                    <label for="lastNameField">Last Name</label>
                    <input type="text" class="form-control" id="lastNameField" placeholder="Last Name" name="last_name"
                        required value=" <?php if (isset($last_name)) {
    echo $last_name;
} ?> ">
                </div>
                <div class="form-group col-6">
                    <label for="emailField">Email Address</label>
                    <input type="email" class="form-control" id="emailField" placeholder="Email Address" name="email"
                        required value=" <?php if (isset($email)) {
    echo $email;
} ?> ">
                </div>
                <div class="form-group col-6">
                    <label for="phoneField">Phone Number</label>
                    <input type="tel" class="form-control" id="phoneField" placeholder="Phone Number" name="phone"
                        value=" <?php if (isset($phone)) {
    echo $phone;
} ?> ">
                </div>
                <div class="form-group col-6">
                    <label for="comments">Comments & Suggestions</label>
                    <textarea name="comments" id="comments" class="form-control" rows="5">
                    </textarea>
                </div>
                <div class="form-group col-4">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
                <div class="hidden-field">
                    <input type="text" id="address" name="address">
                    <p>Please leave this field blank!</p>
                </div>
            </form>
        </section>

</div> <!-- END CONTENT BODY HERE -->

<?php
include 'inc/footer.php';
?>