<?php
// Count items in the Order
$order_count = count($_SESSION['order']);
?>

<div class="nav-wrapper">
    <!-- Start navigation here -->
    <div class="main-nav">
        <nav class="navbar navbar-expand-lg navbar-dark farm-blue-bg">
            <a class="navbar-brand" href="order.php">
            <img src="images/redtruck.png"
                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="main-nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="navbar-nav mr-auto col-md-8">

                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contacts.php">Contact</a>
                    </li>

                    <li class="nav-item">
                        <!-- menu.php -->
                        <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                    <li class="nav-item active order-item">
                    <div class="order-icon">
                    <a href="order.php">Order</a>
                    <span class="badge farm-blue-bg text-white" id="comparison-count">
                            <?= $order_count ?></span>
               </div>
                    </li>
                </ul>
                <!-- TODO: COME BACK AND STYLE THIS ALL THE WAY TO THE RIGHT -->
               
            </div>
        </nav>
    </div>
</div>
<!-- End navigation here -->