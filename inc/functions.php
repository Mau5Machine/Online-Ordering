<?php

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;

// File for the handy functions I'll need during this project
function renderMenuItems($name, $price, $cat, $description, $id)
{

//  MENU ITEM DETAILS
    echo "<div class='card text-center mx-2' id='menu-item-card'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title mb-3 text-center'>{$name}</h5>";
    echo "<h6 class='card-subtitle mb-2'><em><strong>$ {$price} per person</em></strong></h6>";
    echo "<small>( Minimum 8pp per order )</small>";
    echo "<br>";
    echo "<span class='badge farm-red-bg text-white'>{$cat}</span>";
    echo "<hr>";

    //  encode HTML in description
    $menu_description = htmlspecialchars_decode(htmlspecialchars_decode($description));

    echo "<div class='text-left'>{$menu_description}</div>";
    //  START ADD TO/UPDATE ORDER FORM + BUTTON
    echo "<form method='post' class='add-to-order-form'>";
    echo "<label for='qty'>";
    echo "How Many People? <i class='material-icons'>people</i>";
    echo "</label><br>";
    echo "<input type='number' class='order-qty' name='qty' value='8' class='col-3 ml-3 mb-3' min='8' />";
    // Menu id for javascript class HIDDEN
    echo "<div class='menu-id display-none'>{$id}</div>";
    echo "</div>";
    echo " <div class='card-footer'>";
    if (array_key_exists($id, $_SESSION['order'])) {
        // Change button to UPDATE ORDER if already in the order
        echo "<a href='order.php' class='btn btn-success w-100-pct update-order-btn'>Update Order</a>";
    } else {
        // ADD TO ORDER button if doesn't exist in order
        echo "<button type='submit' class='btn btn-primary w-100-pct add-to-order-btn' id={$id}>Add to Order</button>";
    }

    echo "</div>";
    echo "</form>";
    echo "</div>";
}

function renderDateTimeFields()
{
    ?>
<!-- Render Date and Time Form Fields -->
    <div class="md-form my-3 row">
                    <i class="fa fa-calendar fa-2x col-2" aria-hidden="true"></i>
                    <input type="text" id="startDate" class="form-control col-5" placeholder="MM/DD/YYY"
                        name="order_date">
                    <button type="button" class="btn btn-sm btn-success mt-3" data-toggle="popover" title="48 Hour Notice"
                        data-placement="bottom" data-content="Our Catering Department needs AT LEAST a 48 hour notice to prepare the orders"
                        id="popover-notice"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> More Info</button>
                </div>

                <div class="md-form my-3 row">
                    <i class="fa fa-clock fa-2x col-2" aria-hidden="true"></i>
                    <select name="order_time" class="form-control col-5">
                        <option value="">Select A Time</option>
                        <option value="8:00AM">8:00 AM</option>
                        <option value="8:30AM">8:30 AM</option>
                        <option value="9:00AM">9:00 AM</option>
                        <option value="9:30AM">9:30 AM</option>
                        <option value="10:00AM">10:00 AM</option>
                        <option value="10:30AM">10:30 AM</option>
                        <option value="11:00AM">11:00 AM</option>
                        <option value="11:30AM">11:30 AM</option>
                        <option value="12:00PM">12:00 PM</option>
                        <option value="12:30PM">12:30 PM</option>
                        <option value="1:00PM">1:00 PM</option>
                        <option value="1:30PM">1:30 PM</option>
                        <option value="2:00PM">2:00 PM</option>
                        <option value="2:30PM">2:30 PM</option>
                        <option value="3:00PM">3:00 PM</option>
                        <option value="3:30PM">3:30 PM</option>
                        <option value="4:00PM">4:00 PM</option>
                        <option value="4:30PM">4:30 PM</option>
                        <option value="5:00PM">5:00 PM</option>
                        <option value="5:30PM">5:30 PM</option>
                        <option value="6:00PM">6:00 PM</option>
                        <option value="6:30PM">6:30 PM</option>
                        <option value="7:00PM">7:00 PM</option>
                        <option value="7:30PM">7:30 PM</option>
                        <option value="8:00PM">8:00 PM</option>
                        <option value="8:30PM">8:30 PM</option>
                        <option value="9:00PM">9:00 PM</option>
                    </select>
                    <?php
}

// function to render the start order form modal
function renderStartOrderModal()
{
    ?>
<div class="modal fade" id="modalStartOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Pickup Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="inc/store_order_info.php" id="pickup-details-form" method="post">
                <div class="modal-body mx-3">
                    <div class="md-form my-5 row">
                        <i class="fa fa-user fa-2x col-2" aria-hidden="true"></i>
                        <input type="text" id="startFirstName" class="form-control col-10 float-right" placeholder="First Name Here"
                            name="order_fname">
                    </div>

                    <div class="md-form my-5 row">
                        <i class="fa fa-user fa-2x col-2" aria-hidden="true"></i>
                        <input type="text" id="startLastName" class="form-control col-10 float-right" placeholder="Last Name Here"
                            name="order_lname">
                    </div>

                    <div class="md-form my-5 row">
                        <i class="fa fa-envelope fa-2x col-2" aria-hidden="true"></i>
                        <input type="email" id="startEmail" class="form-control col-10 float-right" placeholder="Email Address Here"
                            name="order_email">
                    </div>

                    <div class="md-form my-5 row">
                        <i class="fa fa-phone fa-2x col-2" aria-hidden="true"></i>
                        <input type="text" id="startPhone" class="form-control col-10 float-right" placeholder="Phone Number Here"
                            name="order_phone">
                    </div>

                    <?php renderDateTimeFields() ?>

                        <div class="pickup-times mt-4">
                            <span class="ml-4"><i class="fa fa-exclamation-circle mb-3" aria-hidden="true"></i>
                                Available
                                Pickup Times</span>
                            <p><strong>Monday - Friday:</strong> <span class="times">8:00AM to 9:00PM</span></p>
                            <p><strong>Saturday:</strong> <span class="times">8:00AM to 10:00PM</span></p>
                            <p><strong>Sunday:</strong> <span class="times">8:00AM to 8:00PM</span></p>

                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" id="start-btn">Start Order <i class="material-icons">
                            restaurant_menu
                        </i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}

// function to create clear cart confirmation modal
function renderClearCartModal()
{
    ?>
<div class="modal fade" id="confirm-delete-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Are you sure?
            </div>
            <div class="modal-body">
                Do you want to proceed in removing all items from the order?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancel-delete-btn" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok delete-item-btn text-white">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php
}

// function to create delete item modal
function renderRemoveItemModal()
{
    ?>
<div class="modal fade" id="confirm-delete-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Are you sure?
            </div>
            <div class="modal-body">
                Remove this item from your order?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancel-delete-btn" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok delete-item-btn text-white">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php
}
// submit email to catering department
function sendSubmitEmail($msg_body, $subject, $html = true)
{
    $mail = new PHPMailer;
    // set who the email is sent from
    $mail->setFrom('projectcgm@cmartins.pbcs.us', 'Catering Department');
    // Set an alternative reply to address
    $mail->addReplyTo('cmartins629@gmail.com', 'Christian Martins');
    // set who the email is sent to
    $mail->addAddress('christian@farmerstableboca.com', 'Christian Martins');
    // attach subject and body to the email
    $mail->Subject = $subject;
    $mail->Body = $msg_body;
    $mail->IsHTML($html);
    ///////// End Submission Email /////////

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}
function sendThankYouEmail($email, $name, $subject, $msgHTML)
{
    ////// Start Thank You Email //////////
    $mail = new PHPMailer;
    // set who the email is sent from
    $mail->setFrom('projectcgm@cmartins.pbcs.us', 'Catering Department');
    // set who the email is sent to
    $mail->addAddress($email, $name);
    // attach subject and body to the email
    $mail->Subject = $subject;
    // attach the html document for the body of email
    $mail->msgHTML(file_get_contents($msgHTML), __DIR__);
    //Attach an image file
    $mail->addAttachment('images/catering-sign.png');

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
    ////////// End Thank You Email ////////////
}

// send confirmation email to user
function sendInvoiceEmail($email, $name, $msg_body, $subject, $html = true)
{
    ////// Start Thank You Email //////////
    $mail = new PHPMailer;
    // set who the email is sent from
    $mail->setFrom('projectcgm@cmartins.pbcs.us', 'Catering Department');
    // set who the email is sent to
    $mail->addAddress($email, $name);
    // attach subject and body to the email
    $mail->Subject = $subject;
    $mail->Body = $msg_body;
    $mail->IsHTML($html);

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}
// Add new user to the database
function addNewUser($fname, $lname, $email, $phone)
{
    // include_once connection file
    include 'inc/connect.php';

    // insert user into users table
    $sql = "INSERT IGNORE INTO `users` 
(`users_id`, `users_first_name`, `users_last_name`, `users_email`, `users_phone`, `users_created`) 
VALUES 
(NULL, :fname , :lname , :email , :phone , CURRENT_TIMESTAMP)";

    // prepare the statement
    $stmt = $pdo->prepare($sql);

    // bind values
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);

    // execute the statement
    return $stmt->execute();
}

// get the current user id from the db
function getCurrentUser($email)
{
    include 'inc/connect.php';

    // query statement to grab the newly created user id by email
    $sql = "SELECT `users_id` 
    FROM `users` 
    WHERE `users_email` = :email";

    // prepare the statement
    $stmt = $pdo->prepare($sql);

    // bind the email value
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    // execute the statement
    $stmt->execute();

    // return the result out of the function
    return $row = $stmt->fetch();
}

// add the order items to the db
function addOrderItems($orders_id, $order_session)
{
    include 'inc/connect.php';

    // prepare the query for the ordered_items
    $query = "INSERT INTO `ordered_items` 
    (`orders_id`, `ordered_items_id`, `ordered_items_quantity`) 
    VALUES
    ( :orders_id, :ordered_items_id, :ordered_items_quantity ) ";

    // prepare
    $stmt = $pdo->prepare($query);

    // bind values
    foreach ($order_session as $id => $quantity) {
        $stmt->bindParam(':orders_id', $orders_id, PDO::PARAM_INT);
        $stmt->bindParam(':ordered_items_id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ordered_items_quantity', $order_session[$id]['quantity'], PDO::PARAM_INT);
        // execute
        $stmt->execute();
    }
    return true;
}

// grab order id for the ordered items query
function grabOrderId()
{
    include 'inc/connect.php';

    // prepare the query
    $query = "SELECT `orders_id`, `users_id` 
    FROM `orders` 
    ORDER BY `orders_created` 
    DESC LIMIT 1";

    // prepare the query
    $stmt = $pdo->prepare($query);

    // execute
    $stmt->execute();

    // return the result out of the function
    return $row = $stmt->fetch();
}

// create a new order
function createNewOrder($users_id, $total, $instructions, $pickup)
{
    include 'inc/connect.php';

    // Prepare the query for the new order line
    $query = "INSERT INTO `orders` 
(`orders_id`, `users_id`, `orders_total`, `orders_instructions`, `orders_pickup`, `orders_created`) 
VALUES 
(NULL, :users_id, :orders_total, :instructions, :pickup, 
CURRENT_TIMESTAMP)";

    // prepare the statement
    $stmt = $pdo->prepare($query);

    // bind values
    $stmt->bindParam(':users_id', $users_id, PDO::PARAM_INT);
    $stmt->bindParam(':orders_total', $total, PDO::PARAM_INT);
    $stmt->bindParam(':instructions', $instructions);
    $stmt->bindParam(':pickup', $pickup);

    // execute
    return $stmt->execute();
}
?>