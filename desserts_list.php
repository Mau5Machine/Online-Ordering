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