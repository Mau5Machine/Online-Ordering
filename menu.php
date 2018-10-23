<?php
$pageWallpaper = 'home-wp';
$pageTitle = 'Menu';
include 'inc/header.php';
// FIXME: jQuery tabbed navigation is not working properly!!!!
?>


<script>
  $("#menu-tabs").tabs({
    heightStyle: "fill"
});
</script>
<section id="menu-tabs">
  <ul class="menu-tabbed-nav">
    <li><a href="#packages"><span>Packages</span></a></li>
    <li><a href="#courses"><span>Courses</span></a></li>
    <li><a href="#addons"><span>Add-Ons</span></a></li>
    <li><a href="#desserts"><span>Desserts</span></a></li>
  </ul>


  <article id="packages">
    <h1>Breakfast & Brunch Packages</h1>

    <!-- Card Container -->
    <div class="menu-card-wrapper d-flex justify-content-around flex-wrap">

      <!-- Card for menu items -->
      <div class="card" id="menu-item-card">
        <div class="card-body">
          <h5 class="card-title">Continental</h5>
          <h6 class="card-subtitle mb-2 text-muted"><em>$15 per person</em></h6>
          <p class="card-text">
            Assorted Mini Muffins & Breakfast Pastries,
            Greek Yogurt - Oak Nut Granola <em>Wildflower Honey, Assorted House Made Preserves</em>,
            Seasonal Fresh Fruit Bowl</p>
          <form action="">
            <input type="number" name="people_amount" placeholder="Amount of people">
            <input type="submit" name="add_to_order" value="Add">
          </form>
        </div>
      </div>
      <!-- End of Card -->
      <!-- Card for menu items -->
      <div class="card" id="menu-item-card">
        <div class="card-body">
          <h5 class="card-title">Eye Opener</h5>
          <h6 class="card-subtitle mb-2 text-muted"><em>$20 per person</em></h6>
          <p class="card-text">
            Assorted Mini Muffins & Breakfast Pastries,
            Greek Yogurt - Oak Nut Granola <em>Wildflower Honey, Assorted House Made Preserves</em>,
            Seasonal Fresh Fruit Bowl</p>
          <form action="">
            <input type="number" name="people_amount" placeholder="Amount of people">
            <input type="submit" name="add_to_order" value="Add">
          </form>
        </div>
      </div>
      <!-- End of Card -->
      <!-- Card for menu items -->
      <div class="card" id="menu-item-card">
        <div class="card-body">
          <h5 class="card-title">Continental</h5>
          <h6 class="card-subtitle mb-2 text-muted"><em>$15 per person</em></h6>
          <p class="card-text">
            Assorted Mini Muffins & Breakfast Pastries,
            Greek Yogurt - Oak Nut Granola <em>Wildflower Honey, Assorted House Made Preserves</em>,
            Seasonal Fresh Fruit Bowl</p>
          <form action="">
            <input type="number" name="people_amount" placeholder="Amount of people">
            <input type="submit" name="add_to_order" value="Add">
          </form>
        </div>
      </div>
      <!-- End of Card -->
    </div> <!-- End of card container-->

    <div class="card-wrapper d-flex justify-content-around flex-wrap">

      <!-- Card for menu items -->
      <div class="card" id="menu-item-card">
        <div class="card-body">
          <h5 class="card-title">Continental</h5>
          <h6 class="card-subtitle mb-2 text-muted"><em>$15 per person</em></h6>
          <p class="card-text">
            Assorted Mini Muffins & Breakfast Pastries,
            Greek Yogurt - Oak Nut Granola <em>Wildflower Honey, Assorted House Made Preserves</em>,
            Seasonal Fresh Fruit Bowl</p>
          <form action="">
            <input type="number" name="people_amount" placeholder="Amount of people">
            <input type="submit" name="add_to_order" value="Add">
          </form>
        </div>
      </div>
      <!-- End of Card -->
      <!-- Card for menu items -->
      <div class="card" id="menu-item-card">
        <div class="card-body">
          <h5 class="card-title">Continental</h5>
          <h6 class="card-subtitle mb-2 text-muted"><em>$15 per person</em></h6>
          <p class="card-text">
            Assorted Mini Muffins & Breakfast Pastries,
            Greek Yogurt - Oak Nut Granola <em>Wildflower Honey, Assorted House Made Preserves</em>,
            Seasonal Fresh Fruit Bowl</p>
          <form action="">
            <input type="number" name="people_amount" placeholder="Amount of people">
            <input type="submit" name="add_to_order" value="Add">
          </form>
        </div>
      </div>
      <!-- End of Card -->
      <!-- Card for menu items -->
      <div class="card" id="menu-item-card">
        <div class="card-body">
          <h5 class="card-title">Continental</h5>
          <h6 class="card-subtitle mb-2 text-muted"><em>$15 per person</em></h6>
          <p class="card-text">
            Assorted Mini Muffins & Breakfast Pastries,
            Greek Yogurt - Oak Nut Granola <em>Wildflower Honey, Assorted House Made Preserves</em>,
            Seasonal Fresh Fruit Bowl</p>
          <form action="">
            <input type="number" name="people_amount" placeholder="Amount of people">
            <input type="submit" name="add_to_order" value="Add">
          </form>
        </div>
      </div>
      <!-- End of Card -->
    </div> <!-- End of card container-->

  </article> <!-- End of packages page -->





  <?php
include 'inc/footer.php';
?>