<?php
// start session
session_start();

// remove the items from the order
session_destroy();

// set page title
$pagetitle = "Thank You!";

// include the header
include_once 'inc/header.php';
?>

<div class="col-md-12">
    <div class="alert alert-success">
        <strong>Your order has been placed!</strong> Someone will be in touch with you soon to confirm!
    </div>
</div>

<div class="text-center col-md-12">
    <h5><a href="index.php">Go Back To Home Page</a></h5>
</div>

<?php
include_once 'inc/footer.php';
?>
