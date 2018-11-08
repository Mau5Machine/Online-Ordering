<?php
// Count items in the Order
$order_count = count($_SESSION['order']);
?>

<div class="nav-wrapper">
    <!-- Start navigation here -->
    <div class="main-nav">
        <nav class="navbar navbar-expand-lg navbar-light white-bg">
            <a class="navbar-brand" target="_blank" href="http://farmerstableboca.com">
                <img src="images/redtruck.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="navbar-nav mr-auto col-md-8">

                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="index.php">
                            <i class="material-icons mr-2">
                                home
                            </i>Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link hvr-underline-from-left" href="contacts.php">
                            <i class="material-icons mr-2">
                                email
                            </i>Contact </a>
                    </li>

                    <li class="nav-item">
                        <!-- menu.php -->
                        <a class="nav-link hvr-underline-from-left" href="menu.php">
                            <i class="material-icons mr-2">
                                restaurant_menu
                            </i>Menu </a>
                    </li>
                </ul>
                <!-- TODO: COME BACK AND STYLE THIS ALL THE WAY TO THE RIGHT -->
                <div class="order-icon">
                    <?php
                    if (count($_SESSION['order']) > 0) {
                        // Link to Cart Page
                        
                        echo "<span class='badge farm-red-bg text-white' id='comparison-count'>";
                        echo $order_count;
                        echo "</span>";
                        echo "<a href='order.php' class='hvr-pop'>";
                        echo "<i class='fas fa-shopping-cart'></i>";
                        echo "</a>";
                    } else {
                        // Generate Modal
                        echo "<a href='#' data-toggle='modal' data-target='#emptyCartModal'>";
                        echo "<i class='material-icons'>shopping_cart";
                        echo "</i></a>";

                        // Modal Content
                        echo "<div class='modal fade' id='emptyCartModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                        echo "<div class='modal-dialog' role='document'>";
                        echo "<div class='modal-content'>";
                        echo "<div class='modal-header'>";
                        echo "<h5 class='modal-title' id='emptyCartModalLabel'>Empty Cart!</h5>";
                        echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                        echo "<span aria-hidden='true'>&times;</span>";
                        echo "</button>";
                        echo "</div>";
                        echo "<div class='modal-body'>";
                        echo "Your cart is empty! Take a look at our Menu to get started.";
                        echo "</div>";
                        echo "<div class='modal-footer'>";
                        echo "<button type='button' class='btn btn-secondary' id='dismiss-btn' data-dismiss='modal'>Close</button>";
                        echo "<a type='button' href='menu.php' id='menu-btn' class='btn btn-primary'>Go To Menu</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                    ?>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- End navigation here -->