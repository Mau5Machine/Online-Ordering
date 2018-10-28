<?php
$sectionName = "Individual Items";
?>

<!-- Package items in this container -->
<article id="menu-items-list">
    <h1>
        <?= $sectionName ?>
    </h1>

    <!-- Card Panel Layout in this Div-->
    <div class="menu-card-wrapper d-flex justify-content-around flex-wrap">

        <!-- Card Content From the Database! -->
        <?php
            include 'inc/connect.php';

            $sql = "SELECT menu_id, menu_name, menu_price, menu_description, categories.category_title 
              FROM menu 
              LEFT JOIN categories 
              ON (categories.category_id = menu.categories_category_id) 
              WHERE menu.categories_category_id > 5";

            $results = $pdo->query($sql);

            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='card text-center' id='menu-item-card'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title mb-3 text-center'>";
                echo  $row['menu_name'];
                echo "</h5>";
                echo "<h6 class='card-subtitle mb-2'><em><strong>$ " . $row['menu_price'] . " per person</em></strong>";
                echo "<br>";
                echo "8 pp minimum order</h6>";
                echo "<span class='badge badge-primary'>" . $row['category_title'] . "</span>";
                echo "<hr>";
                // encode HTML
                $menu_description = htmlspecialchars_decode(htmlspecialchars_decode($row['menu_description']));

                echo "<div class='text-left'>" . $menu_description . "</div>";
                echo "<form action='add_to_order.php' method='post'>";
                echo "How Many People?";
                echo "<input type='number' name='qty' value='8' class='col-2 ml-3 mb-3'>";
                echo "<br>";
                echo "<input type='hidden' name='menu_id' value='" . $row['menu_id'] . "'>";
                echo "<button type='submit' class='btn btn-success' name='add_to_order'>Add To Order</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
            }
        ?>

    </div> <!-- End of card container-->
</article> <!-- End of packages page -->
</div> <!-- End of packages Container -->