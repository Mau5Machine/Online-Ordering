<?php
// start session
session_start();

// clear the order array
unset($_SESSION['order']);

// redirect back to menu page
header('location:menu.php?action=cleared');
