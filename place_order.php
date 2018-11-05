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
        <h1>Send Order</h1>
    </div>


    <article class="container-fluid">
        <!-- One fluid container for the form and the order page -->
        <div class="row d-flex justify-content-around">
            <!-- One row for the form and order same line -->

            <div class="col-md-5 col-sm-12" id="form-half">
                <!-- Container for the form -->
                <form class="checkout-form" method="post">

                    <legend>Submit Order</legend>
                    <!-- Ask for guest first name -->
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" placeholder="First Name" class="form-control">
                    </div>
                    <!-- Ask for guest last name -->
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" placeholder="Last Name" class="form-control">
                    </div>
                    <!-- Ask for guest email -->
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email Address" class="form-control">
                    </div>
                    <!-- Ask for guest phone number -->
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" placeholder="Phone Number" class="form-control">
                    </div>
                    <!-- Ask for special instruction *optional -->
                    <div class="form-group col-sm-12 col-md-8">
                        <label for="first">Special Instructions</label>
                        <textarea name="order_details" type="text" id="order-details" placeholder="Special Instructions"
                            class="col-12" rows="4"></textarea>
                    </div>
                    <!-- Submit button here -->
                    <input type="submit" value="Submit" class="btn farm-bright-grn-bg">
                </form>
            </div><!-- End container for form -->

            <div class="col-md-6 col-sm-12" id="order-half">
                <div class="order-summary-header">
                    <h2 class='text-center'>Order Summary</h2>
                </div>
                <table class='table table-striped'>
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

echo "<thead>";
echo "<tr class='text-center'>";
echo "<th class='totals pl-4'>Sub Total <span class='totals-numbers pl-3'>&#36;" . number_format($total, 2, '.', ',') . "</span></th>";
echo "</tr>";
echo "</thead>";
echo "<tr class='text-center'>";
echo "<td class='totals pl-4'>Sales Tax <span class='totals-numbers pl-4'>&#36;" . number_format($tax, 2, '.', ',') . "</span></td>";
echo "</tr>";
echo "<tr class='text-center'>";
echo "<td class='totals pl-4'>Grand Total <span class='totals-numbers'>&#36;" . number_format($grand_total, 2, '.', ',') . "</span></td>";
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo "</div>";

?>
            </div>


        </div> <!-- End of row for the content same line -->
    </article> <!-- End of the container for the content -->
</section> <!-- End of entire section -->
<?php
include_once 'inc/footer.php';
?>