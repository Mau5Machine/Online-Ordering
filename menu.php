<?php
// start session
session_start();

$_SESSION['order'] = isset($_SESSION['order']) ? $_SESSION['order'] : array();

print_r($_SESSION['order']);
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

// TODO: FIX THIS ISSUE WHERE THE STUPID ALERT SHOWS UP NO MATTER WHAT

// include the menu navigation
include 'inc/menu_nav.php';

?>
<!-- Start Menu Panels Here! -->
<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade  show active" id="nav-packages" role="tabpanel" aria-labelledby="nav-packages-tab">

    <!-- PACKAGES TABBED PAGE GOES IN HERE!!!!! -->
    <!-- //////////////////////////////////////// -->
    <?php
    $sectionName = "Packages";
    ?>

    <!-- Package items in this container -->
    <article id="menu-items-list">
      <h1>
        <?= $sectionName ?>
      </h1>

      <div class="menu-card-wrapper d-flex justify-content-around flex-wrap">

        <?php
        // read all menu items from the database
        $stmt = $menu->get_packages();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    // include functions file
                    require_once 'inc/functions.php';
                    renderMenuItems($menu_name, $menu_price, $category_title, $menu_description, $menu_id);
                }
        ?>
      </div>
    </article> <!-- End of packages page -->
  </div> <!-- End of packages Container -->

  <div class="tab-pane fade" id="nav-items" role="tabpanel" aria-labelledby="nav-items-tab">

    <!--MENU TABBED PAGE GOES IN HERE!!!!! -->
    <!-- //////////////////////////////////////// -->
    <?php
    $sectionName = "Menu Items";
    ?>

    <!-- Menu items in this container -->
    <article id="menu-items-list">
      <h1>
        <?= $sectionName ?>
      </h1>
    <!-- TODO: Add a filter selector input here to choose the category to view (Handhelds, Entree, Salads, Sides, Etc..) -->

      <div class="menu-card-wrapper d-flex justify-content-center flex-wrap">

        <?php
        // read all menu items from the database
        $stmt = $menu->get_menu();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    // include functions file
                    require_once 'inc/functions.php';
                    renderMenuItems($menu_name, $menu_price, $category_title, $menu_description, $menu_id);
                }
        ?>
      </div>
    </article> <!-- End of packages page -->
  </div> <!-- End of packages Container -->

  <div class="tab-pane fade" id="nav-desserts" role="tabpanel" aria-labelledby="nav-desserts-tab">

    <!--DESSERT TABBED PAGE GOES IN HERE!!!!! -->
    <!-- //////////////////////////////////////// -->
    <?php
    $sectionName = "Desserts";
    ?>

    <!-- Dessert items in this container -->
    <article id="menu-items-list">
      <h1>
        <?= $sectionName ?>
      </h1>

      <div class="menu-card-wrapper d-flex justify-content-around flex-wrap">

        <?php
        // read all dessert items from the database
        $stmt = $menu->get_desserts();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    // include functions file
                    require_once 'inc/functions.php';
                    renderMenuItems($menu_name, $menu_price, $category_title, $menu_description, $menu_id);
                }
        ?>
      </div>
    </article> <!-- End of desserts page -->
  </div> <!-- End of desserts Container -->
</div>

<?php
include 'inc/footer.php';
?>