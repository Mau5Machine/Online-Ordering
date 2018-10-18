<?php
$pageWallpaper = 'home-wp';
$pageTitle = 'Home';
include 'inc/header.php';
?>

<!-- Banner Goes Here -->
<header id="banner">
    <div class="jumbotron transp-grey text-center">
        <img src="images/catering-sign.png" alt="catering" class="img-fluid">

        <p class="lead" id="banner-btn">
            <a class="btn btn-primary btn-lg" href="menu.php" role="button">Catering Menu</a>
            <a class="btn btn-primary btn-lg" href="startOrder.php" role="button">Start Order</a>
        </p>
    </div>
</header>
<!-- End Banner -->

<!-- Start site content -->
<article class="container how-it-works">
    <div class="row">
        <img src="images/text/howitworks.png" class="img-fluid my-4" id="how-it-works-header">
    </div>

    <div class="row  d-flex justify-content-around">

        <!-- How it works cards -->
        <aside class="card bg-light mb-3" style="max-width: 20rem;">
            <div class="card-header text-center farm-red-bg">
                <h4>Choose your items</h4>
            </div>
            <div class="card-body">
                <h4 class="card-title">Build your order</h4>
                <p class="car-text">
                    &bull; Specify a date & time for pickup</br>
                    &bull; Choose your items</br>
                    &bull; Review your order</br>
                    &bull; Submit!</br>
                    &bull; Check your email for verification</br>
                </p>
                <p><span class="badge badge-danger">Important</span><br>
                    We will need at least a 48 hour notice to prepare your custom catering order</p>
            </div>
        </aside>

        <!-- Arrow to next card goes here -->
        <div class="arrow">
            <img src="images/arrow.png" alt="" id="how-it-works-transfer">
        </div>

        <!-- Second card here -->
        <aside class="card bg-light mb-3" style="max-width: 20rem;">
            <div class="card-header text-center farm-red-bg">
                <h4>Prep Time!</h4>
            </div>
            <div class="card-body">
                <h4 class="card-title">Time to cook</h4>
                <p class="card-text">
                    &bull; An email is sent<br>
                    &bull; We verify the order with you<br>
                    &bull; Fresh & healthy cooking takes place<br>
                    &bull; You get a call to come pick up your order!<br>
                </p>
                <p><span class="badge badge-warning">Optional</span><br>
                    You invite us to your party!</p>
            </div>
        </aside>
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

<?php
include 'inc/footer.php';
?>