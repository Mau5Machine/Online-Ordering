<?php
// start session
session_start();

// Check to see if anything is in order
$_SESSION['order'] = isset($_SESSION['order']) ? $_SESSION['order'] : array();

// Check for action set in URL
$action = isset($_GET['action']) ? $_GET['action'] : "";

// connect to database
include 'inc/connect.php';

// include the menu class
include_once 'classes/menu_class.php';

// initialize the menu object
$menu = new Menu($pdo);

// set page title
$pageTitle = "Order";

include 'inc/header.php';

// TODO: Fuck with the action variable in the get request

// check for items in the session order
if (count($_SESSION['order']) > 0) {

    // get the menu ids
    $ids = array();
    foreach ($_SESSION['order'] as $id => $value) {
        array_push($ids, $id);
    }

    $stmt = $menu->readByIds($ids);

    $total = 0;
    $item_count = 0; ?>
<div class="row" id="order-banner">
    <img src="images/text/your-order-text.png" alt="your order text" class="img-fluid">
</div>
<div class="container order-wrapper animsition">

    <?php
    echo "<div class='action-alert'>";
    if ($action == "updated") {
        echo "<h5 class='alert farm-bright-grn-bg' role='alert'>Quantity Update Was Successful!</h5>";
    } elseif ($action == "removed") {
        echo "<h5 class='alert alert-danger text-white' role='alert'>Item Successfully Deleted From Your Order.</h5>";
    }

    echo "</div>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // Set the quantity in the order
        $quantity = $_SESSION['order'][$menu_id]['quantity'];
        $sub_total = $menu_price * $quantity;

        echo "<div class='row order-row mx-4'>";

        echo "<div class='col-md-8 item-name m-b-10px'><h5>{$menu_name}</h5></div>";

        // update quantity
        echo "<form class='update-quantity-form'>";

        echo "<div class='menu-id display-none'>{$menu_id}</div>";

        echo "<div class='input-group'>";

        echo "<input type='number' name='qty' value='{$quantity}' class='form-control order-quantity' min='1' />";

        echo "<span class='input-group-btn'>";

        echo "<button class='btn btn-primary update-quantity' type='submit'>Update</button>";

        echo "</span>";

        echo "</div>";

        echo "</form>";

        // delete from order
        echo "<a href='remove_from_order.php?id={$menu_id}&name={$menu_name}' id='delete' class='btn btn-default'>";
        
        echo "<i class='fas fa-2x fa-trash-alt farm-red'></i></a>";

        echo "<div class='col-md-2 text-center'>";

        echo "<p class='custom-badge'>&#36;" . number_format($menu_price, 2, '.', ',') . " per person</p>";

        echo "</div>";
        // =================

        $item_count += $quantity;
        $total += $sub_total;

        echo "</div>";
    }

    echo "<div class='col-md-12 text-center'>";

    echo "<h4 class='m-b-10px mt-4'>Total ({$item_count} items)</h4>";

    echo "<h4>&#36;" . number_format($total, 2, '.', ',') . "</h4>";

    echo "<a href='place_order.php' class='btn btn-success m-b-10px'>";

    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Finalize Order";

    echo "</a>";

    echo "</div>";
}

// no products were added to order
else {
    ?>

    <div class="modal" tabindex="-1" role="dialog" id="empty-cart-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nothing Ordered Yet!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your Order is empty! Try choosing some items from the menu first.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
header('location: menu.php');
}
?>

    <?php
include 'inc/footer.php';
