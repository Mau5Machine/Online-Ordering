<?php
// start session
session_start();

// get the menu id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$qty = isset($_GET['qty']) ? $_GET['gty'] : 1;

// make quantity a minimum of 1
$qty = $qty <= 0 ? 1 : $qty;

// add item to array
$order_item = array(
    'quantity' => $qty
);

// check if cart session was created, if NOT, create cart session array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// check if the item is in the array, if it is, do not add
if (array_key_exists($id, $_SESSION['cart'])) {
    // redirect to menu page and let user know the item exists in the order already
    header("location: menu.php?action=exists&id=' . $id . '");
}

// else add item to the array
else {
    $_SESSION['order'][$id] = $order_item;

    // redirect to menu page and let the user know the item was added to the order
    header("location: menu.php?action=added");
}
