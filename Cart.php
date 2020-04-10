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
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color:rgb(154,140,152);">
        <div class="container"><a class="navbar-brand" href="#" style="color:rgb(34,34,59);">Greg's List</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="HomePage.php" style="color:rgb(34,34,59);">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Businesses.php" style="color:rgb(34,34,59);">Businesses</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Purchases.php" style="color:rgb(34,34,59);">Purchases</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="Cart.php" style="color:rgb(34,34,59);">Cart</a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group"></div>
                </form><form method="post" action="Cart.php"><button  class="btn btn-light action-button" type="submit" name="signout" style="background-color:rgb(74,78,105);">Log Out</button></form></div>
        </div>
    </nav>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Item</h1>
                </div>
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Price</h1>
                </div>
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Quantity</h1>
                </div>
            </div>
        </div>
           <?php

              DisplayCart();
 
           ?>
    </div>
    <div></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <form action="Cart.php" method="post">
                           <div class="col"><button class="btn btn-primary" type="submit" name="purchase" style="background-color:rgb(74,78,105);">Checkout</button></div>
                        </form>
                    </div>
                </div>
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

   if (isset($_POST['purchase'])) {

      Purchase();
      exit();     

   }

   if (isset($_POST['remove'])) {

      RemoveFromCart();
      exit();     

   }

   //Source: CS215 Project
   function DisplayCart(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }

          $uEmail = $_SESSION['uEmail'];
          $query = mysqli_query($db, "SELECT * FROM `CartItem` WHERE uemail='$uEmail'");   

          $rows = mysqli_num_rows($query);

          if($rows == 0){

             echo "<div class='container'>";
             echo "<div class='row'>";
             echo "<div class='col-md-3'><small style='font-size:20px;color:rgb(34,34,59);'>Empty</small></div>";
             echo "<div class='col-md-3'><small style='font-size:20px;color:rgb(34,34,59);'>Empty</small></div>";
             echo "<div class='col-md-3'><small style='font-size:20px;color:rgb(34,34,59);'>Empty</small></div>";
             echo "</div>";
             echo "</div>";

          }else{

             $totalP = 0;
             $totalQ = 0;

             while($row = mysqli_fetch_assoc($query)){

                $name = $row["iname"];
                $amount = $row["camount"];
                $price = $row["iprice"];
                $priceAmt = $price * $amount;

                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-md-3'><small style='font-size:20px;color:rgb(34,34,59);'>$name</small></div>";
                echo "<div class='col-md-3'><small style='font-size:20px;color:rgb(34,34,59);'>$$priceAmt</small></div>";
                echo "<div class='col-md-3'><small style='font-size:20px;color:rgb(34,34,59);'>$amount</small></div>";
                echo "<form method='post' action='Cart.php'>";
                echo "<input type='hidden' name='name' value='$name'/>";
                echo "<div class='col-md-20'><button class='btn btn-primary btn-block' type='submit' name='remove' style='background-color:rgb(74,78,105);margin:5px;'>Remove</button></div>";
                echo "</form>";
                echo "</div>";
                echo "</div>";

                $totalP += $price * $amount;
                $totalQ += $amount;


             }

             echo "<div class='container'>";
             echo "<div class='row'>";
             echo "<div class='col-md-3'></div>";
             echo "<div class='col-md-3'><small style='font-size:20px;color:rgb(34,34,59);'><b>Total:</b> $$totalP</small></div>";
             echo "<div class='col-md-3'><small style='font-size:20px;color:rgb(34,34,59);'><b>Total:</b> $totalQ</small></div>";
             echo "</div>";
             echo "</div>";

          }

          mysqli_free_result($query);

   }

   function RemoveFromCart(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }

          $uEmail = $_SESSION['uEmail'];
          $itemName = mysqli_real_escape_string($db,$_POST['name']);
          $query = mysqli_query($db, "DELETE FROM `CartItem` WHERE `uemail`='$uEmail' AND `iname`='$itemName'");   

          mysqli_free_result($query);

   }

   function Purchase(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }


 
         $uEmail = $_SESSION['uEmail'];
         $uAddress = $_SESSION['uAddress'];

          $query = mysqli_query($db, "SELECT * FROM `CartItem` WHERE uemail='$uEmail'");   

          while($row = mysqli_fetch_assoc($query)){

             $name = mysqli_real_escape_string($db,$row["iname"]);
             $amount = $row["camount"];
             $price = $row["iprice"];
             $businessName = mysqli_real_escape_string($db,$row["bname"]);

             $sql = "INSERT INTO `Purchases` (`uemail`, `bname`, `iname`, `iprice`, `camount`, `uaddress`, `completed`) VALUES ('$uEmail','$businessName','$name','$price','$amount','$uAddress','0')";
             mysqli_query($db,$sql);      

          }

          $query = mysqli_query($db, "DELETE FROM `CartItem` WHERE `uemail`='$uEmail'"); 

          mysqli_free_result($query);
          mysqli_free_result($sql);

    }

?>