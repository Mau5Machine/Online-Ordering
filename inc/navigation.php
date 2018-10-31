<div class="nav-wrapper">
    <!-- Start navigation here -->
    <div class="main-nav">
        <nav class="navbar navbar-expand-lg navbar-dark farm-blue-bg">
            <a class="navbar-brand" target="_blank" href="http://farmerstableboca.com"><img src="images/redtruck.png"
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
                </ul>
                <!-- TODO: COME BACK AND STYLE THIS ALL THE WAY TO THE RIGHT -->
                <h4>
                    <a href="order.php" class="align-self-end mr-5">
                        <?php
                                // Count items in the Order
                                $order_count = count($_SESSION['order']);
                                ?>
                        <img src="images/shopping-icon.png" alt="">
                        <span class="badge badge-success" id="comparison-count">
                            <?= $order_count ?></span>
                    </a>
                </h4>
            </div>
        </nav>
    </div>
</div>
<!-- End navigation here -->