<?php
// start session
session_start();

$_SESSION['order'] = isset($_SESSION['order']) ? $_SESSION['order'] : array();

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// include connection file
include 'inc/connect.php';

// include the menu object
include_once 'classes/menu_class.php';

// initialize objects
$menu = new Menu($pdo);

// page title
$pageTitle = 'Menu';

// include the header and menu navigation
include_once 'inc/header.php';

// Menu Navigation Tabs Are Here
?>
<section id="menu-page">
  <!-- Container for the entire Menu Nav Section + Content -->

  <div class="menu-nav">
    <!-- Menu Navigation Tabs inside here! -->
    <nav>
      <div class="nav nav-tabs d-flex justify-content-center flex-wrap" id="nav-tab" role="tablist">
        <a class="nav-item hvr-underline-from-left" id="nav-packages-tab" data-toggle="tab" href="#nav-packages" role="tab"
          aria-controls="nav-packages" aria-selected="true">Packages</a>
        <a class="nav-item hvr-underline-from-left" id="nav-items-tab" data-toggle="tab" href="#nav-items" role="tab"
          aria-controls="nav-items" aria-selected="false">Menu Items</a>
      </div>
    </nav>
  </div>

  <!-- Start Menu Panels Here! -->
  <div class="tab-content" id="nav-tabContent">

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

        <!-- Card wrapper here -->
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
        </div> <!-- End card wrapper -->
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
            <option value="Handhelds">Handhelds</option>
            <option value="Salads">Salads</option>
            <option value="Entree">Entree</option>
            <option value="Dessert">Desserts</option>
            <option value="All">Show All</option>
          </select>
          <input type="submit" class='btn farm-bright-grn-bg' value='Filter'>
        </form>

        <!-- Card wrapper here -->
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
        <!--end card wrapper here -->
      </article> <!-- End of menu items page -->
    </div> <!-- End of Menu Items Container -->
  </div><!-- End of Menu Page Content Container -->
</section> <!-- End of Menu Page! -->

<?php
include_once 'inc/footer.php';
?>