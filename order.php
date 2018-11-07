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

// check for items in the session order
if (count($_SESSION['order']) > 0) {

    // get the menu ids
    $ids = array();
    foreach ($_SESSION['order'] as $id => $value) {
        array_push($ids, $id);
    }

    $stmt = $menu->readByIds($ids);

    $total = 0;
    $item_count = 0;
    
    // set page title
    $pageTitle = "Order";

    include_once 'inc/header.php'; ?>
<div class="row" id="order-banner">
    <img src="images/text/your-order-text.png" alt="your order text" class="img-fluid">
</div>
<div class="container order-wrapper">

    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        // Set the quantity in the order
        $quantity = $_SESSION['order'][$menu_id]['quantity'];
        $sub_total = $menu_price * $quantity;

        echo "<div class='row order-row mx-4'>";
        echo "<div class='col-md-8 item-name m-b-10px'>";
        echo "<h5><i class='fas fa-utensils pr-2'></i>";
        echo "<strong>{$menu_name}</strong></h5>";
        echo "</div>";
     
        // Update Quantity Here
        echo "<form class='update-quantity-form'>";
        echo "<div class='menu-id display-none'>{$menu_id}</div>";
        echo "<div class='input-group'>";
        echo "<input type='number' name='qty' value='{$quantity}' class='form-control order-quantity' min='1' />";
        echo "<span class='input-group-btn'>";
        echo "<button class='btn btn-primary update-quantity' type='submit'>Update</button>";
        echo "</span>";
        echo "</div>";
        echo "</form>";

        // Delete Items Here
        echo "<a class='delete-item' id='{$menu_id}'>";
        echo "<i class='fas fa-2x fa-trash-alt farm-red'></i></a>";
        echo "<div class='col-md-2 text-center'>";
        echo "<p class='price-each'>";
        echo "$ " . number_format($menu_price, 2, '.', ',') .  " each</p>";
        echo "</div>";
        echo "</div>";

        $item_count += $quantity;
        $total += $sub_total;
    }

    echo "<div class='col-md-12 text-center totaled-order'>";
    echo "<h4 class='m-b-10px mt-4'>Total ({$item_count}items)</h4>";
    echo "<h4>$ " . number_format($total, 2, '.', ',') . "</h4>";
    echo "<a href='checkout.php' class='btn btn-success m-b-10px'>";
    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Checkout";
    echo "</a>";
    echo "<button data-href='clear_cart.php' data-toggle='modal' data-target='#confirm-delete-cart' class='btn farm-red-bg text-white ml-3' id='clear-cart'>Clear Cart</button>";
    echo "</div>";
}
// no products were added to order
// TODO: FIX THIS ISSUE WHERE USER GETS RELOCATED TO THE MENU PAGE!
else {
    // redirect to menu page
    header('location:menu.php');
}

include_once 'inc/footer.php';

include 'inc/functions.php';
renderClearCartModal();
renderRemoveItemModal();
?>


