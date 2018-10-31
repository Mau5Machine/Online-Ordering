<?php
// start session
session_start();

// get the item id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";

// remove the item from the order array
unset($_SESSION['order'][$id]);

// redirect to order page and tell user item was removed from order
header('Location: order.php?action=removed&id=' . $id);
