<?php
// start the session
session_start();

// get the menu item id
$id = isset($_POST['id']) ? $_POST['id'] : 1;
$quantity = isset($_POST['qty']) ? $_POST['qty'] : "";

// make quantity a minimum of 1
$quantity = $quantity <= 0 ? 1 : $quantity;

// remove the item from the array
unset($_SESSION['order'][$id]);

// add the item with the updated quantity
$_SESSION['order'][$id] = array(
    'quantity' => $quantity
);

// redirect to the order list
header("location: order.php?action=updated");
