<?php
// start session
session_start();

// connect to database
include 'inc/connect.php';

// include the menu class
include_once 'classes/menu_class.php';

// initialize the menu object
$menu = new Menu($pdo);

// Grab the menu items from the order array
$ids = array();
foreach ($_SESSION['order'] as $id => $value) {
    array_push($ids, $id);
}

// Read the items from the order
$stmt = $menu->readByIds($ids);

// set the total and quantity variables
$total = 0;
$item_count = 0;

// set page title
$pageTitle = "Submit";

// include the header
include_once 'inc/header.php';
?>
<section id="submit-order">

    <!-- Page Header Goes here -->
    <div id="send-order-header" class="text-center">
        <img src="images/text/checkout-text.png" alt="">
    </div>


    <article class="container-fluid">
        <!-- One fluid container for the form and the order page -->
        <div class="row d-flex justify-content-center">
            <!-- One row for the form and order same line -->

            <div class="col-md-5 col-sm-12" id="order-half">
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th colspan='3' id='table-header'><img src="images/text/final-order-sign.png" class='img-fluid'></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    // Set the quantity in the order
    $quantity = $_SESSION['order'][$menu_id]['quantity'];
    $sub_total = $menu_price * $quantity;
    
    echo "<tr>";
    echo "<td class='pl-4'>{$menu_name}</td>";
    echo "<td>{$quantity}</td>";
    echo "<td>&#36;" . number_format($menu_price, 2, '.', ',') * $quantity . "</td>";
    echo "</tr>";
   
   

    // Addd up the quantity and total
    $item_count += $quantity;
    $total += $sub_total;
}

    $tax = $total * .06; // 6 % Sales Tax
    $grand_total = $total + $tax;


echo "<tr class='text-center'>";
echo "<td colspan='3' class='totals pl-4'>Sub Total <span class='totals-numbers pl-3'>&#36;" . number_format($total, 2, '.', ',') . "</span></td>";
echo "</tr>";
echo "<tr class='text-center'>";
echo "<td colspan='3'class='totals pl-4'>Sales Tax <span class='totals-numbers pl-4'>&#36;" . number_format($tax, 2, '.', ',') . "</span></td>";

echo "</tr>";
echo "<tr class='text-center'>";
echo "<td colspan='3' class='totals pl-4'>Grand Total <span class='totals-numbers'>&#36;" . number_format($grand_total, 2, '.', ',') . "</span></td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";

?>

                        <div class="col-md-4 col-sm-12" id="form-half">
                            <!-- Container for the form -->
                            <form class="checkout-form" method="post" action="submit-order.php">

                                <legend>Your Details</legend>
                                <!-- Ask for guest first name -->
                                <div class="form-group col-sm-12 col-md-10">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" placeholder="First Name" class="form-control"
                                        value="<?php
                        $fname = isset($_SESSION['order_details']['user_fname']) ? $_SESSION['order_details']['user_fname'] : "";
                        if (isset($fname) && !empty($fname)) {
                            echo $fname;
                        }
                        ?>">
                                </div>
                                <!-- Ask for guest last name -->
                                <div class="form-group col-sm-12 col-md-10">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" placeholder="Last Name" class="form-control"
                                        value="<?php
                        $lname = isset($_SESSION['order_details']['user_lname']) ? $_SESSION['order_details']['user_lname'] : "";
                        if (isset($lname) && !empty($lname)) {
                            echo $lname;
                        }
                        ?>">
                                </div>
                                <!-- Ask for guest email -->
                                <div class="form-group col-sm-12 col-md-10">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" placeholder="Email Address" class="form-control"
                                        value="<?php
                        $email = isset($_SESSION['order_details']['user_email']) ? $_SESSION['order_details']['user_email'] : "";
                        if (isset($email) && !empty($email)) {
                            echo $email;
                        }
                        ?>">
                                </div>
                                <!-- Ask for guest phone number -->
                                <div class="form-group col-sm-12 col-md-10">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" placeholder="Phone Number" class="form-control"
                                        value="<?php
                        $phone = isset($_SESSION['order_details']['user_phone']) ? $_SESSION['order_details']['user_phone'] : "";
                        if (isset($phone) && !empty($phone)) {
                            echo $phone;
                        }
                        ?>">
                                </div>
                                <!-- Ask for special instruction *optional -->
                                <div class="form-group col-sm-12 col-md-10">
                                    <input type="hidden" value="<?= $grand_total ?>" name="total">
                                    <label for="first">Special Instructions</label>
                                    <textarea name="order_details" type="text" id="order-details" placeholder="Special Instructions"
                                        class="col-12" rows="4"></textarea>
                                </div>

                                <?php
                    // Check if date and time are set, if not, display the button to pop up modal
                    if (isset($_SESSION['order_details']['user_date'])
                    && !empty($_SESSION['order_details']['user_date'])
                    && isset($_SESSION['order_details']['user_time'])
                    && !empty($_SESSION['order_details']['user_time'])) {
                        // set date and time variables to the session values
                        $date = $_SESSION['order_details']['user_date'];
                        $time = $_SESSION['order_details']['user_time'];
                        echo "<div class='pickup-info-container'>";
                        echo "<div class='pickup-date-row row'>";
                        echo "<h4 class='date col-12'>Pickup Date: {$date}</h4>";
                        echo "</div>";
                        echo "<div class='pickup-time-row row'>";
                        echo "<h4 class='time col-12 mt-2'>Pickup Time: {$time}</h4>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        include_once 'inc/functions.php';
                        echo "<div class='final-date-time-fields'>";
                        renderDateTimeFields();
                        echo "</div>";
                    }



                    ?>
                                <!-- Submit button here -->
                                <input id='submit-order-btn' type="submit" value="Submit" class="btn farm-bright-grn-bg">
                            </form>
                        </div><!-- End container for form -->
            </div>
    </article> <!-- End of the container for the content -->
</section> <!-- End of entire section -->

<?php
include_once 'inc/footer.php';
?>