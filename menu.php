<?php
$pageWallpaper = 'home-wp';
$pageTitle = 'Menu';
include 'inc/header.php';
?>


<?php
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