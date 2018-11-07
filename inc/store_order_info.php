<?php
// Start the session
session_start();

// Set the order_details session array
$_SESSION['order_details'] = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // filter first name
    $fname = filter_input(INPUT_POST, 'order_fname', FILTER_SANITIZE_STRING);
    $_SESSION['order_details']['user_fname'] = ucwords($fname);
    // filter last name
    $lname = filter_input(INPUT_POST, 'order_lname', FILTER_SANITIZE_STRING);
    $_SESSION['order_details']['user_lname'] = ucwords($lname);
    // filter email
    $email = trim(filter_input(INPUT_POST, 'order_email', FILTER_SANITIZE_EMAIL));
    $_SESSION['order_details']['user_email'] = $email;
    // filter phone number
    $phone = trim(filter_input(INPUT_POST, 'order_phone', FILTER_SANITIZE_STRING));
    $_SESSION['order_details']['user_phone'] = $phone;
    // filter datetime
    $date = trim(filter_input(INPUT_POST, 'order_date', FILTER_SANITIZE_STRING));
    $_SESSION['order_details']['user_date'] = $date;
    $time = trim(filter_input(INPUT_POST, 'order_time', FILTER_SANITIZE_STRING));
    $_SESSION['order_details']['user_time'] = $time;
    // Change the format of the date to mysql ready format
    $pickup = $date . " " . $time;
    $pickup = date("Y-m-d H:i:s", strtotime($pickup));
    // Add the insert ready pick up date and time to the session array
    $_SESSION['order_details']['pickup'] = $pickup;

    $dateMatch = explode('/', $date);

    if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($date) || empty($time)) {
        $error_message = 'Please fill in ALL the required fields';
        echo $error_message;
    } elseif (count($dateMatch) != 3
            || strlen($dateMatch[0]) != 2
            || strlen($dateMatch[1]) != 2
            || strlen($dateMatch[2]) != 4
            || !checkdate($dateMatch[0], $dateMatch[1], $dateMatch[2])) {
        $error_message = "Invalid Date!";
        echo $error_message;
    } else {
        // add only once date is correct format
        $_SESSION['order_details']['user_date'] = $date;
        // relocate to menu page
        header('location:../menu.php');
    }
}
