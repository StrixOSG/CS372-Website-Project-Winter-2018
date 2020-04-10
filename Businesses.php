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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="HomePage.php" style="color:#22223b;">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Businesses.php" style="color:rgb(34,34,59);">Businesses</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Purchases.php" style="color:rgb(34,34,59);">Purchases</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Cart.php" style="color:rgb(34,34,59);">Cart</a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group"><label for="search-field"><i class="fa fa-search" style="padding:0px;margin:0px;padding-left:114px;color:rgb(34,34,59);"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
                </form><form method="post" action="Businesses.php"><button  class="btn btn-light action-button" type="submit" name="signout" style="background-color:rgb(74,78,105);">Log Out</button></form></div>
        </div>
    </nav>
    <div style="background-color:#f2e9e4;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center" style="color:#22223b;">Businesses</h2>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color:#f2e9e4;padding-bottom:20px;">
        <div class="container">
            <div class="row">
               <form action="Businesses.php?filter=true" method="post";">
                <div class="col-md-6"><select name="bType" style="width:463px;height:44px;padding-bottom:0px;"><option value="Food" selected="">Food</option><option value="Pawn">Pawn</option><option value="Shop">Shop</option></select></div>
                <div class="col-md-6"><button class="btn btn-primary btn-lg d-block" type="submit" name="filter" style="color:#ffffff;background-color:rgb(74,78,105);">Filter</button></div>
              </form>
            </div>
        </div>
    </div>
    <div class="projects-clean" style="background-color:rgb(242,233,228);">
        <div class="container" style="background-color:#f2e9e4;">
            <div class="intro">
                <p class="text-center"></p>
            </div>
            
            <div class="row projects" style="width:969px;">
                
                <?php

                   DisplayBusinesses();

                ?>

            </div>
        </div>
    </div>
    <div class="footer-basic" style="background-color:rgb(154,140,152);">
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

   if (isset($_POST['filter'])) {

        $type = $_POST['bType'];
        echo "<script>window.location = 'http://www.gregslist.ca/Businesses.php?filter=$type'</script>";
        exit();

   }

   //Source: CS215 Project & https://phppot.com/php/enriched-responsive-shopping-cart-in-php/
   function DisplayBusinesses(){

         $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

         if(mysqli_connect_errno()){

           exit("Error - Could not connect to MySQL");

         }

         $query = "";

         //If a filter or search is made display those results
         if(!empty($_GET['filter'])){
           
           $type = $_GET['filter'];
           $query = mysqli_query($db, "SELECT * FROM `Business` WHERE btype='$type'");
            

         } else if(!empty($_GET['search'])){

           $bName = mysqli_real_escape_string($db,$_GET['search']);
           $query = mysqli_query($db, "SELECT * FROM `Business` WHERE bname='$bName'");

         } else{

           $query = mysqli_query($db, "SELECT * FROM `Business`");


         }
         
          if(mysqli_num_rows($query) != 0){

            while($row = mysqli_fetch_assoc($query)){

            $image = $row["bimage"];
            $ename = urlencode($row["bname"]);
            $name = $row["bname"];
            $description = $row["bdescription"];
          
            echo "<div class='col-sm-6 col-lg-4 item' style='background-color:#c9ada7;color:rgb(34,34,59);width:315px;'><img class='img-fluid' src='$image'>";
            echo "<h3 class='name' style='color:#22223b;'><a href='BusinessPage.php?b=$ename'>$name</a></h3>";
            echo "<p class='description' style='color:rgb(34,34,59);'>$description</p>";
            echo"</div>";


           }

         }else{

            echo "<h3 class='name' style='color:#22223b;'>No Businesses Found. Either the Business Name Searched Did Not Match Exactly, or There Are No Businesses of the Type Selected.</h3>";

         }

         mysqli_free_result($query);

   }

?>