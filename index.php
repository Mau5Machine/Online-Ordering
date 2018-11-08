<?php
// start session
session_start();
$_SESSION['order'] = isset($_SESSION['order']) ? $_SESSION['order'] : array();

$pageTitle = 'Home';

include_once 'inc/header.php';
?>

<div class="home-wrapper">
    <!-- Banner Front Page  Goes Here -->
    <header id="banner">
        <div class="jumbotron gradient-vertical text-center">
            <img src="images/catering-sign.png" alt="catering" class="img-fluid">
            <p class="lead" id="banner-btn">
                <a class="btn btn-primary btn-lg" href="menu.php" role="button" id="cateringMenuBtn">Catering Menu</a>
                <a class="btn btn-primary btn-lg" href="#" role="button" id="startOrderBtn">Start Order</a>
            </p>
        </div>
    </header>
    <!-- End Banner -->

    <section class="container-fluid wrapper">
        <!-- Wrap all the cards and carousel in this section -->

        <!-- Start site content -->
        <article class="container front-page-container">
            <div class="front-inner-container">

                <!-- Start the content explaining how it works -->
                <div class="front-page-main-content">
                    <div class="row first-row-main-content d-flex justify-content-center flex-lg-wrap">
                        <div class="card-deck">
                            <!-- One card here -->
                            <div class="card text-white farm-grn-bg mb-3 front-cards" style="max-width: 25rem;">
                                <div class="card-header text-center front-card-header">
                                    A Simple & Healthy Online Ordering Solution</div>
                                <div class="card-body">
                                    <div class="card-title text-center">
                                        <img src="images/checklist-120x120.png"></div>
                                    <div class="card-text">
                                        <ul>
                                            <li>Browse Our Healthy and Delicious
                                                <a class="hvr-grow black-link" href="menu.php">Catering Menu</a>
                                                Options!</li>
                                            <li>Specify the quantity and add items to your order</li>
                                            <li>Pick a date and time to pick it up</li>
                                            <li>Proceed to checkout!</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- One card here -->
                            <div class="card text-white farm-red-bg mb-3 front-cards" style="max-width: 25rem;">
                                <div class="card-header text-center front-card-header">
                                    Your Catering Order is in Great Hands</div>
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        <img src="images/chef-icon.png"></h5>
                                    <p class="card-text text-center" id="front-card-text3">
                                        <ul>
                                            <li>Our menu is created and driven by conscious, healthy, clean eating
                                                philosophies.</li>
                                            <li>Everything is prepared from scratch cooked to your order.</li>
                                            <li class='text-center'>Pickup & Enjoy!<img src="images/bag-icon.png"> </li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End first row with 2 cards inside -->
        </article> <!-- End first article container -->

        <!-- Row with carousel images inside -->
        <article class="row carousel-container">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/carousel/redtruck.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/carousel/food.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/carousel/sides.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/carousel/ted.jpg" alt="Fourth slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </article> <!-- End carousel container row -->

        <!-- Article Row with one card inside -->
        <article class="row d-flex justify-content-center flex-wrap my-4">
            <!-- One card here -->
            <div class="card text-white farm-bright-grn-bg mb-3 front-cards" style="max-width: 30rem;">
                <div class="card-header text-center front-card-header">
                    Let Us Cater Your Party With Ease!</div>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <img src="images/email-sent.png"></h5>
                    <p class="card-text text-center" id="front-card-text">
                        As soon as we receive your order,<br> a member of our catering department
                        will reach out to you to confirm your order<br> and go over any special
                        instructions.
                    </p>

                    <div id="front-card-text2" class="text-center card-text">
                        <p>
                            <img src="images/fig-bullet.png"><br>
                            Interested in Offsite Catering?<br>
                            Contact us! <br>
                            <a href="mailto:catergin@farmerstableboca.com" class="hvr-grow">catering@farmerstableboca.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </article>
    </section> <!-- End Main Section Here -->


    <!-- Location and info container -->
    <article class="col-12" id="location">
        <div class="row d-flex justify-content-center flex-wrap">
            <h1 class="location-header text-center pb-3"><i class="fas fa-map-pin"></i> Location</h1>
        </div>
        <div class="row location-row justify-content-around flex-wrap">
            <div class="map col-sm-12 col-md-4 text-right">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3574.754777236248!2d-80.12445518451027!3d26.366792383365844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d91e74964e4d07%3A0x824efea8fc947e95!2sFarmer&#39;s+Table!5e0!3m2!1sen!2sus!4v1539792677024"
                    width="400" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

            <div class="address-info col-sm-12 col-md-4 pb-3">
                <p><strong>Phone:</strong> <a href="tel:+15614175836">561-417-5836</a></p>
                <p><strong>Email:</strong> <a href="mailto:catering@farmerstableboca.com">
                        catering@farmerstableboca.com</a></p>
                <p><strong>Address:</strong> 1901 North Military Trail<br>
                    BocaRaton, FL 33431</p>
            </div>
        </div>
    </article>
    <!-- End location -->

</div>

<?php
include_once 'inc/footer.php';
?>
<!-- Start Order Modal Here -->
<?php
include_once 'inc/functions.php';
renderStartOrderModal();
?>