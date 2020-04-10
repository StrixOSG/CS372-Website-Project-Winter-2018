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

<body style="background-color:rgb(242,233,228);">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color:rgb(154,140,152);color:rgb(34,34,59);">
        <div class="container"><a class="navbar-brand" href="#" style="color:#22223b;">Greg's List</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="HomePage.php" style="color:#22223b;">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Businesses.php" style="color:rgb(34,34,59);">Businesses</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Purchases.php" style="color:rgb(34,34,59);">Purchases</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Cart.php" style="color:rgb(34,34,59);">Cart</a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group"><label for="search-field"><i class="fa fa-search" style="padding:0px;margin:0px;padding-left:114px;color:rgb(34,34,59);"></i></label><input class="form-control search-field" 
                type="search" name="search" id="search-field"></div>
                </form><form method="post" action="BusinessPage.php"><button  class="btn btn-light action-button" type="submit" name="signout" style="background-color:rgb(74,78,105);">Log Out</button></form></div>
            </div></nav>
               
                <?php

                   DisplayBusinessInfo();

                ?>
 
           <form action="BusinessPage.php?b=<?php echo urlencode($_GET['b'])?>" method="post" ">

              <select name="ratingVal"><optgroup label="This is a group"><option value="1" selected="">1 Star</option><option value="2">2 Stars</option><option value="3">3 Stars</option><option value="4">4 Stars</option><option value="5">5 
              Stars</option></optgroup></select>
              <button class="btn btn-primary" type="submit" name="rating" style="background-color:rgb(74,78,105);">Submit Rating</button>

           </form>

        <div class="row projects" style="width:1500px;">

        <?php

           DisplayInventory();

        ?>

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

   if (isset($_POST['rating'])) {

      SetRating();
      exit();     

   }

   if (isset($_POST['addtocart'])) {

      AddToCart();
      exit();     

   }

   //Source: CS215 Project
   function DisplayBusinessInfo(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }

          $businessName = mysqli_real_escape_string($db,$_GET['b']);
          $query = mysqli_query($db, "SELECT * FROM `Business` WHERE bname='$businessName'");   

          $row = mysqli_fetch_assoc($query);

          $image = $row["bimage"];
          $name = $row["bname"];
          $description = $row["bdescription"];
          $type = $row["btype"];
          $rating = GetRating();        

          echo "<img src='$image'>";
          echo "<form><small style='color:rgb(34,34,59);'></small><small style='color:rgb(34,34,59);'></small></form>";
          echo "<div></div>";
          echo "<p style='color:rgb(34,34,59);'><b>Name:</b> $name</p>";
          echo "<p style='color:rgb(34,34,59);'><b>Type:</b> $type</p>";
          echo "<p style='color:rgb(34,34,59);'><b>Description:</b> $description</p>";
          echo "<p style='color:rgb(34,34,59);'><b>Rating: $rating</b> </p>";

          mysqli_free_result($query);

    }

   function SetRating(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }

          $uEmail = $_SESSION["uEmail"];
          $rating = $_POST["ratingVal"];
          $rating = (int)$rating;
          $businessName = mysqli_real_escape_string($db,$_GET['b']);

          $query = mysqli_query($db, "SELECT * FROM `Rating` WHERE uemail='$uEmail' AND bname='$businessName'");   

          $rows = mysqli_num_rows($query);

          if($rows != 0){
          
             //Update mySQL rating for user and business
             $sql = "UPDATE `Rating` SET `rating`='$rating' WHERE uemail='$uEmail' AND bname='$businessName'";
             mysqli_query($db,$sql);

          }else{

             //Create new rating for user and business
             $sql = "INSERT INTO `Rating` (`rating`, `bname`, `uemail`) VALUES ('$rating','$businessName','$uEmail')";
             mysqli_query($db,$sql);      

          }

          mysqli_free_result($query);
          mysqli_free_result($sql);

    }

    function GetRating(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }


          $businessName = mysqli_real_escape_string($db,$_GET['b']);

          $query = mysqli_query($db, "SELECT 'rating' FROM `Rating` WHERE bname='$businessName'");   

          $rows = mysqli_num_rows($query);

          if($rows != 0){
             
             $value = 0;
             $query = mysqli_query($db, "SELECT * FROM `Rating` WHERE bname='$businessName'"); 
 
             while($row = mysqli_fetch_assoc($query)){

                $value += $row['rating'];

             }
   
             return $value / $rows;


          }else{

             return "No rating";    

          }

          mysqli_free_result($query);
          mysqli_free_result($sql);

    }

  
    //Source: https://phppot.com/php/simple-php-shopping-cart/
    function DisplayInventory(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }


         $businessName = mysqli_real_escape_string($db,$_GET['b']);

         $product_array = mysqli_query($db,"SELECT * FROM `InventoryItem` WHERE `bname`='$businessName' ORDER BY `idinventory` ASC");

         if (!empty($product_array)) {

            while($row = mysqli_fetch_assoc($product_array)){

               $image = $row["iimage"];
               $name = $row["iname"];
               $price = $row["iprice"];
               $stock = $row["istock"];
               $businessName = urlencode($row["bname"]);

	       
           echo "<div class='col-sm-4 col-lg-2 item' style='background-color:#c9ada7;color:rgb(34,34,59);width:315px;margin:50px;'><img class='img-fluid' src='$image'>";
           echo "<form method='post' action='BusinessPage.php?b=$businessName'>";
           echo "<input type='hidden' name='image' value='$image'/>";
           echo "<h3 class='name' style='color:#22223b;'>$name</a></h3>";
           echo "<input type='hidden' name='name' value='$name'/>";
           echo "<h3 class='name' style='color:#22223b;'>$$price</a></h3>";
           echo "<input type='hidden' name='price' value='$price'/>";
           echo "<p class='description' style='color:rgb(34,34,59);'>Stock: $stock</p>";
           echo "<input type='hidden' name='stock' value='$stock'/>";
           echo "<div class='col-md-8' style='color:#c9ada7;'><button class='btn btn-primary btn-block' type='submit' name='addtocart' style='background-color:rgb(74,78,105);'>Add To Cart</button></div>";
           echo "</form>";
           echo"</div>";

           }

        }

    }

    function AddToCart(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }


         $businessName = mysqli_real_escape_string($db,$_GET['b']);
         $uEmail = $_SESSION['uEmail'];
         $itemName = mysqli_real_escape_string($db,$_POST['name']);
         $price = $_POST['price'];
         $image = $_POST['image'];
         $stock = $_POST['stock'];

          $query = mysqli_query($db, "SELECT * FROM `CartItem` WHERE uemail='$uEmail' AND iname='$itemName' AND bname='$businessName'");   

          $rows = mysqli_num_rows($query);

          if($stock > 0){

             if($rows != 0){
          
                $row = mysqli_fetch_assoc($query);
                $amount = $row['camount'] + 1;         
 
                //Update mySQL rating for user and business
                $sql = "UPDATE `CartItem` SET `camount`='$amount' WHERE uemail='$uEmail' AND bname='$businessName'";
                mysqli_query($db,$sql);

             }else{

                //Create new rating for user and business
                $sql = "INSERT INTO `CartItem` (`uemail`, `bname`, `camount`, `iname`,`iimage`, `iprice`) VALUES ('$uEmail','$businessName','1','$itemName','$image','$price')";
                mysqli_query($db,$sql);      

             }

          }else{

                        echo '<script type="text/javascript">';
                        echo 'alert("Item out of stock.");';
                        echo '</script>';


          }

          mysqli_free_result($query);
          mysqli_free_result($sql);

    }

?>