<!doctype html>
<html lang="en">

<head>
    <title>
        <?= $pageTitle ?>
    </title>
    <!-- Favicon Here -->
    <link rel="shortcut icon" href="favicon.ico" type="image/icon">
    <!-- jQuery UI and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em"
        crossorigin="anonymous"></script>
    <!-- My JS Here -->
    <script src="js/main.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ"
        crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Personal Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body id="<?= $pageWallpaper ?>">
    <div class="nav-wrapper">
        <!-- Start navigation here -->
        <div class="main-nav">
            <nav class="navbar navbar-expand-lg navbar-dark farm-blue-bg">
                <a class="navbar-brand" target="_blank" href="http://farmerstableboca.com"><img src="images/redtruck.png"
                        alt="logo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav"
                    aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="navbar-nav mr-auto">
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
                </div>
            </nav>
        </div>
    </div>
    <!-- End navigation here -->

    <!-- Wrapper for the entire document -->
    <div class="wrapper" id="content">