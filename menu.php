<?php
// start session
session_start();

$_SESSION['order'] = isset($_SESSION['order']) ? $_SESSION['order'] : array();

// include connection file
include 'inc/connect.php';

// include the menu object
include_once 'classes/menu_class.php';

// initialize objects
$menu = new Menu($pdo);

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

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
<div class="tab-content animsition" id="nav-tabContent">

  <div class="tab-pane fade show active" id="nav-packages" role="tabpanel" aria-labelledby="nav-packages-tab">

    <!-- PACKAGES TABBED PAGE GOES IN HERE!!!!! -->
    <!-- //////////////////////////////////////// -->
    <?php
    $sectionName = "images/text/packages-text.png";
    ?>

    <!-- Package items in this container -->
    <article id="menu-items-list">
      <div class="row col-md-12 section-header">
        <img class="img-fluid section-header" src="<?= $sectionName ?>">
      </div>

      <div class="menu-card-wrapper d-flex justify-content-center flex-wrap">

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

  <div class="tab-pane" id="nav-items" role="tabpanel" aria-labelledby="nav-items-tab">

    <!--MENU TABBED PAGE GOES IN HERE!!!!! -->
    <!-- //////////////////////////////////////// -->
    <?php
    $sectionName = "images/text/menu-items-text.png";
    ?>

    <!-- Menu items in this container -->
    <article id="menu-items-list">
      <div class="row col-md-12 section-header">
        <img class="img-fluid" src="<?= $sectionName ?>">
      </div>

      <?php
      // Check for category field selected
      $filter = isset($_GET['category']) ? $_GET['category'] : "";
      ?>

      <!-- Filter Form Here -->
      <form action="menu.php" method="get" class="form-container text-center">
        <label for="filter">Categories: </label>
        <select name="category" id="filter">
          <option value="">Select One</option>
          <option value="All">Show All</option>
          <option value="Handhelds">Handhelds</option>
          <option value="Salads">Salads</option>
          <option value="Entree">Entree</option>
        </select>
        <input type="submit" class='btn farm-bright-grn-bg' value='Filter'>
      </form>

      <div class="menu-card-wrapper d-flex justify-content-center flex-wrap">

        <?php
        // read all menu items from the database
        $stmt = $menu->get_menu($filter);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            // include functions file
            require_once 'inc/functions.php';
            renderMenuItems($menu_name, $menu_price, $category_title, $menu_description, $menu_id);
        }
        ?>
      </div>
    </article> <!-- End of menu items page -->
  </div> <!-- End of packages Container -->

  <div class="tab-pane fade" id="nav-desserts" role="tabpanel" aria-labelledby="nav-desserts-tab">

    <!--DESSERT TABBED PAGE GOES IN HERE!!!!! -->
    <!-- //////////////////////////////////////// -->
    <?php
    $sectionName = "images/text/desserts.png";
    ?>

    <!-- Dessert items in this container -->
    <article id="menu-items-list">
      <div class="row col-md-12 section-header">
        <img class="img-fluid" src="<?= $sectionName ?>">
      </div>

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