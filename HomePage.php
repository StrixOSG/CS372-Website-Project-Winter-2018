<?php

	session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS372_Project</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Projects-Clean.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color:#9a8c98;">
        <div class="container"><a class="navbar-brand" href="#" style="color:rgb(34,34,59);">Greg's List</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="HomePage.php" style="color:rgb(34,34,59);">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Businesses.php" style="color:rgb(34,34,59);">Businesses</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Purchases.php" style="color:rgb(34,34,59);">Purchases</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Cart.php" style="color:rgb(34,34,59);">Cart</a></li>
                </ul>
                <form class="form-inline mr-auto" action="Businesses.php">
                    <div class="form-group"><label for="search-field"><i class="fa fa-search" style="padding:0px;margin:0px;padding-left:114px;color:rgb(34,34,59);"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
                </form><form method="post" action="HomePage.php"><button  class="btn btn-light action-button" type="submit" name="signout" style="background-color:rgb(74,78,105);">Log Out</button></form></div>
        </div>
    </nav>
    <div class="carousel slide" data-ride="carousel" id="carousel-1">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item"><img class="w-100 d-block" src="assets/img/meeting.jpg" alt="Slide Image"></div>
            <div class="carousel-item"><img class="w-100 d-block" src="assets/img/Unknown.jpeg" alt="Slide Image"></div>
            <div class="carousel-item active"><img class="w-100 d-block" src="assets/img/Unknown-2.jpeg" alt="Slide Image"></div>
            <div class="carousel-item"><img class="w-100 d-block" src="assets/img/Unknown-3.jpeg" alt="Slide Image"></div>
            <div class="carousel-item"><img class="w-100 d-block" src="assets/img/Unknown-1.jpeg" alt="Slide Image"></div>
        </div>
        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
        <ol
            class="carousel-indicators">
            <li data-target="#carousel-1" data-slide-to="0"></li>
            <li data-target="#carousel-1" data-slide-to="1"></li>
            <li data-target="#carousel-1" data-slide-to="2" class="active"></li>
            <li data-target="#carousel-1" data-slide-to="3"></li>
            <li data-target="#carousel-1" data-slide-to="4"></li>
            </ol>
    </div>
    <div class="footer-basic" style="color:rgb(154,140,152);background-color:rgb(154,140,152);">
        <footer>
            <div class="social"></div>
            <ul class="list-inline"></ul>
            <p class="copyright">Greg's List © 2017</p>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php

        if(empty($_SESSION['uEmail'])){

           echo "<script type='text/javascript'>";
           echo "alert('You need to be logged in.');";
           echo "window.location.href='index.php';";
           echo "</script>";


        }

        if(isset($_POST['signout'])){

           session_destroy();
           echo "<script type='text/javascript'>";
           echo "window.location.href='index.php';";
           echo "</script>";
           exit();   

        }

?>