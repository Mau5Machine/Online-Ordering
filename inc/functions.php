<?php
// File for the handy functions I'll need during this project
function renderMenuItems($name, $price, $cat, $description, $id)
{

//  MENU ITEM DETAILS
    echo "<div class='card text-center mx-2' id='menu-item-card'>";

    echo "<div class='card-body'>";

    echo "<h5 class='card-title mb-3 text-center'>{$name}</h5>";
            
    echo "<h6 class='card-subtitle mb-2'><em><strong>$ {$price} per person</em></strong></h6>";
                    
    echo "<small>( Minimum 8pp per order )</small>";
        
    echo "<br>";

    echo "<span class='badge farm-red-bg text-white'>{$cat}</span>";
            
    echo "<hr>";

    //  encode HTML in description
    $menu_description = htmlspecialchars_decode(htmlspecialchars_decode($description));

    echo "<div class='text-left'>{$menu_description}</div>";
        
    //  START ADD TO/UPDATE ORDER FORM + BUTTON
    echo "<form method='get' class='add-to-order-form'>";

    echo "<label for='qty'>How Many People?</label>";

    echo "<input type='number' class='order-qty' name='qty' value='1' class='col-4 ml-3 mb-3' min='1' />";

    // Menu id for javascript class HIDDEN
    echo "<div class='menu-id display-none'>{$id}</div>";
            
    echo "</div>";

    echo " <div class='card-footer'>";

    if (array_key_exists($id, $_SESSION['order'])) {
        // Change button to UPDATE ORDER if already in the order
        echo "<a href='order.php' class='btn btn-success w-100-pct'>Update Order</a>";
    } else {
        // ADD TO ORDER button if doesn't exist in order
        echo "<button type='submit' class='btn btn-primary w-100-pct add-to-order'>Add to Order</button>";
    }
    
    echo "</div>";

    echo "</form>";

    echo "</div>";
}
