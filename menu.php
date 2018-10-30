<?php
// start session
session_start();

// include connection file
include 'inc/connect.php';

// include the menu object
include_once 'classes/menu_class.php';

// initialize objects
$menu = new Menu($pdo);

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// page wallpaper
$pageWallpaper = 'home-wp';

// page title
$pageTitle = 'Menu';

// include header
include 'inc/header.php';

// determine action alert output
echo "<div class='col-md-12'>";
// TODO: FIX THIS ISSUE WHERE THE STUPID ALERT SHOWS UP NO MATTER WHAT
  if ($action = 'added') {
      echo "<div class='alert alert-info'>";
      echo "This menu item was added to your order";
      echo "</div>";
  } elseif ($action = 'exists') {
      echo "<div class='alert alert-info'>";
      echo "Item already exists in your order!";
      echo "</div>";
  } else {
      $action = "";
  }

echo "</div>";

// include the menu navigation
include 'inc/menu_nav.php';

?>
<!-- Start Menu Panels Here! -->
<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade show active" id="nav-packages" role="tabpanel" aria-labelledby="nav-packages-tab">

    <?php
  // Include the Projects Page Here
  include 'packages_list.php';
  ?>

    <div class="tab-pane fade" id="nav-items" role="tabpanel" aria-labelledby="nav-items-tab">

      <?php
  // Include the Items Page Here
  include 'items_list.php';
  ?>

      <div class="tab-pane fade" id="nav-desserts" role="tabpanel" aria-labelledby="nav-desserts-tab">

        <?php
  //  Include Desserts Here
  include 'desserts_list.php';
   ?>
      </div>


      <?php
include 'inc/footer.php';
?>