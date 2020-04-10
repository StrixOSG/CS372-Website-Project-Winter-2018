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

<body style="background-color:rgb(242,232,228);">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" style="background-color:rgb(154,140,152);">
        <div class="container"><a class="navbar-brand" href="#" style="color:rgb(34,34,59);">Greg's List</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav"></ul><a href="BusinessHomePage.php" style="margin-right:398px;color:rgb(34,34,59);">Inventory</a>
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group"><label for="search-field"></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
                </form><form method="post" action="OrdersPage.php"><button  class="btn btn-light action-button" type="submit" name="signout" style="background-color:rgb(74,78,105);">Log Out</button></form></div>
        </div>
    </nav><small style="font-size:30px;color:rgb(34,34,59);">InCompleted</small>
    <div></div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Address</h1>
                </div>
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Item</h1>
                </div>
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Amount</h1>
                </div>
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);font-size:24px;">Change Completed</h1>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
          <?php

            DisplayUncompleted();

          ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1>&nbsp; &nbsp;&nbsp;</h1><small style="font-size:30px;color:rgb(34,34,59);">Completed</small></div>
    </div>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Name</h1>
                </div>
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Address</h1>
                </div>
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Item</h1>
                </div>
                <div class="col-md-3">
                    <h1 style="color:rgb(34,34,59);">Amount</h1>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
          <?php

            DisplayCompleted();

          ?>
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

   if(empty($_SESSION['bEmail'])){

       echo "<script type='text/javascript'>";
       echo "alert('You need to be logged in.');";
       echo "window.location.href='BusinessLogIn.php';";
       echo "</script>";


   }

   if(isset($_POST['signout'])){

      session_destroy();
      echo "<script type='text/javascript'>";
      echo "window.location.href='BusinessLogIn.php';";
      echo "</script>";
      exit();   

   }

   if (isset($_POST['completed'])) {

      SetCompleted();
      exit();     

   }

   function DisplayUncompleted(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }

          $businessEmail = $_SESSION['bEmail'];
          $query = mysqli_query($db, "SELECT * FROM `Business` WHERE bemail='$businessEmail'");
          $row = mysqli_fetch_assoc($query);
          $businessName = mysqli_real_escape_string($db,$row['bname']);


          $query = mysqli_query($db, "SELECT * FROM `Purchases` WHERE bname='$businessName' AND completed='0'");   

          if(mysqli_num_rows($query) != 0){

          while ($row = mysqli_fetch_assoc($query)){

          $userEmail = $row["uemail"];
          $name = $row["iname"];
          $amount = $row["camount"];
          $address = $row["uaddress"];

          $sql = mysqli_query($db, "SELECT * FROM `Customer` WHERE uemail='$userEmail'");
          $user = mysqli_fetch_assoc($sql);
          $userFName = $user['ufname'];
          $userLName = $user['ulname'];
    

            echo"<div class='row'>";
            echo"<div class='col-md-12'>";
            echo"<h1 style='color:rgb(34,34,59);'>$userFName $userLName</h1>";
            echo"</div>";
            echo"</div>";
            echo"<div class='row'>";
            echo"<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:24px;'>$address</small></div>";
            echo"<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:24px;'>$name</small></div>";
            echo"<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:24px;'>$amount</small></div>";
            echo"<div class='col-md-3'>";
            echo"<form method='post' action='OrdersPage.php'>";
            echo "<input type='hidden' name='email' value='$userEmail'/>";
            echo "<input type='hidden' name='name' value='$name'/>";
            echo"<button class='btn btn-primary btn-block' type='submit' name='completed' style='background-color:rgb(74,78,105);'>Completed</button>";
            echo"</form>";
            echo"</div>";
            echo"</div>";


          }

          }else{

          echo "<div class='row'>";
          echo "<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:20px;'>No Uncompleted Orders</small></div>";
          echo "</div>";           

          }

          mysqli_free_result($query);
          mysqli_free_result($sql);

    }

   function DisplayCompleted(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }

          $businessEmail = $_SESSION['bEmail'];
          $query = mysqli_query($db, "SELECT * FROM `Business` WHERE bemail='$businessEmail'");
          $row = mysqli_fetch_assoc($query);
          $businessName = mysqli_real_escape_string($db,$row['bname']);


          $query = mysqli_query($db, "SELECT * FROM `Purchases` WHERE bname='$businessName' AND completed='1'");   

          if(mysqli_num_rows($query) != 0){

          while ($row = mysqli_fetch_assoc($query)){

          $userEmail = $row["uemail"];
          $name = $row["iname"];
          $amount = $row["camount"];
          $address = $row["uaddress"];

          $sql = mysqli_query($db, "SELECT * FROM `Customer` WHERE uemail='$userEmail'");
          $user = mysqli_fetch_assoc($sql);
          $userFName = $user['ufname'];
          $userLName = $user['ulname'];
    

            echo "<div class='row'>";
            echo "<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:23px;'>$userFName $userLName</small></div>";
            echo "<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:23px;'>$address</small></div>";
            echo "<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:23px;'>$name</small></div>";
            echo "<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:23px;'>$amount</small></div>";
            echo "</div>";


          }

          }else{

          echo "<div class='row'>";
          echo "<div class='col-md-3'><small style='color:rgb(34,34,59);font-size:20px;'>No Completed Orders</small></div>";
          echo "</div>";           

          }

          mysqli_free_result($query);
          mysqli_free_result($sql);

    }

   function SetCompleted(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }


          $businessName = mysqli_real_escape_string($db,$_SESSION['bName']);
          $itemName = mysqli_real_escape_string($db,$_POST['name']);
          $userEmail = $_POST['email'];

          $query = "UPDATE `Purchases` SET `completed`='1' WHERE `uemail`='$userEmail' AND `bname`='$businessName' AND `iname`='$itemName'";
          mysqli_query($db,$query);


          mysqli_free_result($query);
     

   }

?>