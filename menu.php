<?php
$pageWallpaper = 'home-wp';
$pageTitle = 'Menu';
include 'inc/header.php';

// include the connection file
require_once 'inc/connect.php';

// Prepare a SQL select statement to view the menu items
$sql = "SELECT package_id, title, cost, description, course FROM packages";

// Run a query on the database
$results = $pdo->query($sql);
?>

<section id="menu-tabs"> <!-- Container for the entire Menu Nav Section + Content -->

  <div class="menu-nav"> <!-- Menu Navigation Tabs inside here! -->
    <nav>
      <div class="nav nav-tabs d-flex justify-content-center flex-wrap" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-packages-tab" data-toggle="tab" href="#nav-packages" role="tab"
          aria-controls="nav-packages" aria-selected="true">Packages</a>
        <a class="nav-item nav-link" id="nav-courses-tab" data-toggle="tab" href="#nav-courses disabled" role="tab"
          aria-controls="nav-courses" aria-selected="false">Courses</a>
        <a class="nav-item nav-link" id="nav-addons-tab" data-toggle="tab" href="#nav-addons disabled" role="tab" aria-controls="nav-addons"
          aria-selected="false">Addons</a>
      </div>
    </nav>
  </div>

  <!-- Start Menu Panels Here! -->
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-packages" role="tabpanel" aria-labelledby="nav-packages-tab">

      <!-- Package itemns in this container -->
      <article id="packages">
        <h1>Breakfast & Brunch Packages</h1>

        <!-- Card Panel Layout in this Div-->
        <div class="menu-card-wrapper d-flex justify-content-around flex-wrap">
              
              <!-- Card Content From the Database! -->
              <?php
                while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='card' id='menu-item-card'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title mb-3'><a href='details.php?id='" . $row['package_id'] . "'>" . $row['title'] . "</a></h5>";
                    echo "<h6 class='card-subtitle mb-2'><em><strong>$ " . $row['cost'] . " per person</em></strong></h6>";
                    echo "<p class='card-text'>";
                    echo "<ul>";
                    echo $row['description'];
                    echo "</ul>";
                    echo "<form action=''>";
                    echo "<input type='number' name='people_amount' placeholder='Amount of people' id='qty'>";
                    echo "<input type='hidden' name='package_id' value='" . $row['package_id'] . "'>";
                    echo "<button type='submit' class='btn btn-success' name='add_to_order'><i class='fas fa-plus'></i></button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                }
              ?>
     
        </div> <!-- End of card container-->

      </article> <!-- End of packages page -->

    </div> <!-- End of packages Container -->

  <div class="tab-pane fade" id="nav-courses" role="tabpanel" aria-labelledby="nav-courses-tab">

    <h1>Hello</h1>
<style>

</style>

  </div>
  <div class="tab-pane fade" id="nav-addons" role="tabpanel" aria-labelledby="nav-addons-tab">

    <p>Wtf?</p>
  
  </div>
  </div>
  <div class="tab-content">


  </div>

</div>

</section>


<?php
include 'inc/footer.php';
?>