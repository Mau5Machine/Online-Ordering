<?php
// FIXME: THIS PAGE IS BROKEN AND DOES NOT UPDATE THE QUANTITY, NEED TO FIX!!!!
// start the session
session_start();

// get the menu item id
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";

// make quantity a minimum of 1
$quantity = $quantity <= 0 ? 1 : $quantity;

// remove the item from the array
unset($_SESSION['order'][$id]);

// add the item with the updated quantity
$_SESSION['order'][$id] = array(
    'quantity' => $quantity
);

// redirect to the order list
header("location: order.php");
