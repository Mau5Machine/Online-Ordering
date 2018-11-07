<?php
// start session
session_start();
$_SESSION['order'] = isset($_SESSION['order']) ? $_SESSION['order'] : array();

$pageTitle = 'Home';

include_once 'inc/header.php';
?>

<div class="home-wrapper">
    <!-- Banner Goes Here -->
    <header id="banner">
        <div class="jumbotron transp-grey text-center">
            <img src="images/catering-sign.png" alt="catering" class="img-fluid">

            <p class="lead" id="banner-btn">
                <a class="btn btn-primary btn-lg" href="menu.php" role="button" id="cateringMenuBtn">Catering Menu</a>
           
                <a class="btn btn-primary btn-lg" href="#" role="button" id="startOrderBtn">Start Order</a>
            </p>
        </div>
    </header>
    <!-- End Banner -->
    <div class="sub-header row text-center">
    <img src="images/text/front-page-text.png" alt="header-text-image" class="img-fluid">
    </div>
    <!-- Start site content -->
    <article class="container front-page-container">
        <div class="front-inner-container">
            <div class="row inner-header">
                <div class="col-12 text-center">
                    <!-- <img src="images/text/front-page-text.png" alt="header-text-image"> -->
                </div>
            </div>
            <!-- Start the content explaining how it works -->
            <div class="front-page-main-content">
                <div class="row first-row-main-content d-flex justify-content-center flex-wrap">
                    <!-- One card here -->
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header text-center">A Simplified Ordering Solution</div>
                        <div class="card-body">
                            <div class="card-title text-center"><img src="images/checklist-120x120.png"></div>
                            <div class="card-text">
                                <ul>
                                <li>Click on the Start Order Button</li>
                                <li>Select Your Items From our Fresh and Delicious Menu Options</li>
                                <li>Checkout!</li>
                                </ul>
                            <!-- TODO: FINISH THIS PAGE REMODEL! -->
                            </div>
                        </div>
                    </div>

                    <!-- One card here -->
                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-header">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Secondary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div
        
        </div>
    </article>
    <!-- End how it works container -->

    <!-- Location and info container -->
    <article class="container pb-5" id="location">
        <div class="row">
            <img src="images/text/location.png" alt="location" class="img-fluid" id="location-header">
        </div>
        <div class="row location-row d-flex justify-content-center">
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3574.754777236248!2d-80.12445518451027!3d26.366792383365844!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d91e74964e4d07%3A0x824efea8fc947e95!2sFarmer&#39;s+Table!5e0!3m2!1sen!2sus!4v1539792677024"
                    width="400" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
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

