<?php
// start session
session_start();

// get the item id
$id = isset($_POST['did']) ? $_POST['did'] : "";

// remove the item from the order array
unset($_SESSION['order'][$id]);
