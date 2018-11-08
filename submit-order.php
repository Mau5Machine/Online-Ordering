<?php
// start the session
session_start();

if (isset($_SESSION['order']) && count($_SESSION['order']) > 0) {
    // Grab the form input
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // filter first name
        $fname = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
        // filter last name
        $lname = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
        $fullName = ucwords($fname) . " " . ucwords($lname);
        // filter email
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        // filter phone number
        $phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
        // filter phone number
        $instructions = trim(filter_input(INPUT_POST, 'order_details', FILTER_SANITIZE_SPECIAL_CHARS));
        // Grab the hidden total value
        $total = $_POST['total'];
        // Check for the date and time set
        if (isset($_POST['order_date']) && isset($_POST['order_time'])) {
            // filter datetime
            $date = trim(filter_input(INPUT_POST, 'order_date', FILTER_SANITIZE_STRING));
            $time = trim(filter_input(INPUT_POST, 'order_time', FILTER_SANITIZE_STRING));
            // Change the format of the date to mysql ready format
            $pickup = $date . " " . $time;
            $pickup = date("Y-m-d H:i:s", strtotime($pickup));
        } elseif (isset($_SESSION['order_details']['pickup'])
                && !empty($_SESSION['order_details']['pickup'])) {
            $date = $_SESSION['order_details']['user_date'];
            $time = $_SESSION['order_details']['user_time'];
            $pickup = $_SESSION['order_details']['pickup'];
        } else {
            header('location:error.php');
        }

        // include the connection file
        include 'inc/connect.php';

        // include the menu class
        include_once 'classes/menu_class.php';

        // initialize the menu object
        $menu = new Menu($pdo);

        // get the menu ids
        $ids = array();
        foreach ($_SESSION['order'] as $id => $value) {
            array_push($ids, $id);
        }

        // include the functions file
        include 'inc/functions.php';

        // Add the user to the database //
        addNewUser($fname, $lname, $email, $phone);
       

        // Grab the newly added users id //
        $results = getCurrentUser($email);
        $users_id = $results['users_id'];

        // Create the new order //
        createNewOrder($users_id, $total, $instructions, $pickup);
       
        // Grab the most recent order ID for the addOrderItems //
        $orders_id = grabOrderId();
        $orders_id = $orders_id['orders_id'];

        // Add the ordered items to the database //
        // addOrderItems($orders_id, $_SESSION['order']);

        // set the subject
        $subject = "ALERT! New Catering Order Submitted " . date('m/d/Y');

        // send email to catering department
        $msg_body = "<h2>New Catering Order Submitted on  " . date('m-d-Y') . "</h2><br>";
        $msg_body .= "From: " . $fullName . "<br>";
        $msg_body .= "Email Address: " . $email . "<br>";
        $msg_body .= "Phone Number: " . $phone . "<br>";
        $msg_body .= "<h2>Order Items:</h2><br>";
        // run the method to grab order items details

        $stmt = $menu->readByIds($ids);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            // Set the quantity in the order
            $quantity = $_SESSION['order'][$menu_id]['quantity'];

            // Run the function to add the ordered items to the database
            try {
                AddOrderItems($orders_id, $menu_id, $menu_name, $quantity);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            $msg_body .= "<h2><strong>&bull; {$menu_name} for {$quantity} people</strong></h2><br>";
        }
        $msg_body .= "<br>";
        $msg_body .= "<h2>Special Instructions: </h2><br>";
        $msg_body .= "<h2>" . $instructions . "</h2><br>";
        $msg_body .= "<h2><strong>Total: ";
        $msg_body .= "$" . number_format($total, 2, '.', ',') . "</h2></strong>";
        $msg_body .= "<h2><strong>Pickup Date: {$date}</h2></strong><br>";
        $msg_body .= "<h2><strong>Pickup Time: {$time}</h2></strong><br>";
    
        if (sendSubmitEmail($msg_body, $subject)) {
        
        // setup invoice email for the guest
            $invoice_subject = "Thank You For Your Order " . $fullName;

            // invoice body
            $invoice_msg = "<html lang='en'>";
            $invoice_msg .= "<body>";
            $invoice_msg .= "<h2>Thank You For Your Order {$fullName}!</h2>";
            $invoice_msg .= "<table border=1 cellspacing=0 cellpadding=4>";
            $invoice_msg .= "<thead>";
            $invoice_msg .= "<tr>";
            $invoice_msg .= "<th>Item</th>";
            $invoice_msg .= "<th>Quantity</th>";
            $invoice_msg .= "<th>Price</th>";
            $invoice_msg .= "</tr>";
            $invoice_msg .= "</thead>";
            
            $stmt = $menu->readByIds($ids);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                // Set the quantity in the order
                $invoice_msg .= "<tr>";
                $quantity = $_SESSION['order'][$menu_id]['quantity'];
                $invoice_msg .= "<td>{$menu_name}</td>";
                $invoice_msg .= "<td>for {$quantity}</td>";
                $invoice_msg .= "<td>";
                $invoice_msg .= "$" . number_format($menu_price, 2, '.', ',') * $quantity;
                $invoice_msg .= "</td>";
                $invoice_msg .= "</tr>";
            }
            
            $invoice_msg .= "<tr>";
            $invoice_msg .= "<td colspan=3>Total ";
            $invoice_msg .= "$" . number_format($total, 2, '.', ',');
            $invoice_msg .= "</td>";
            $invoice_msg .= "</tr>";
            $invoice_msg .= "</table>";
            $invoice_msg .= "<div>";
            $invoice_msg .= "<h4>Special Instructions: </h4>";
            $invoice_msg .= "<p>{$instructions}</p>";
            $invoice_msg .= "</div>";
            $invoice_msg .= "<div>";
            $invoice_msg .= "<h4>Pickup On: <strong>{$date} at {$time}</strong></h4>";
            $invoice_msg .= "</div>";
            $invoice_msg .= "</body>";
            $invoice_msg .= "</html>";

            // Send the invoice email
            if (sendInvoiceEmail($email, $fullName, $invoice_msg, $invoice_subject)) {
                // unset the session order
                unset($_SESSION['order']);
                unset($_SESSION['order_details']);
                unset($_SESSION);
                header('location:index.php?status=thanks');
            } else {
                // ABOUT: This means there was an error sending the invoice email
            }
        } else {
            // ABOUT: This means there was an error sending BOTH the emails
        }
    } else {
        // ABOUT: This means that there was an error collecting post form data
        header('location:error.php');
    }
} else {
    // ABOUT: This means the cart is empty or has not been started!
    header('location:index.php?status=empty');
}
