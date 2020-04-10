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
    <link rel="stylesheet" href="error-style.css">
    <script src="businessHomeVal.js"></script>
</head>

<body style="background-color:rgb(154,140,152);">
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color:rgb(154,140,152);">
            <div class="container"><a class="navbar-brand" href="#" style="color:rgb(34,34,59);">Greg's List</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto"></ul><a href="OrdersPage.php" style="color:rgb(34,34,59);margin:15px;padding:-1px;margin-right:656px;">Orders</a><span class="navbar-text actions"><form method="post" action="BusinessHomePage.php"><button  class="btn btn-light action-button" type="submit" name="signout" style="background-color:rgb(74,78,105);">Log Out</button></form></span></div>
    </div>
    </nav>
    <h1></h1>
    </div>
    <div style="background-color:#f2e9e4;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>&nbsp; &nbsp; &nbsp;</h1>
                    <form name="addItem" action="BusinessHomePage.php" method="post" enctype="multipart/form-data" onSubmit="return formValidation();">
                        
                        <div class="error" id="name_err"></div>
                        <input class="form-control" type="text" name="NameOfItem" id="NameOfItem" placeholder="Name of Item">
                        
                        <div class="error" id="img_err"></div>
                        <input type="file" name="ImageUpload" id="ImageUpload">
                        
                        <div class="error" id="stock_err"></div>
                        <input class="form-control" type="number" name="Stock" id="Stock" placeholder="Stock" min="0">
                        
                        <div class="error" id="price_err"></div>
                        <input class="form-control" type="number" name="Price" id="Price" placeholder="Price" min="0">
                        <button class="btn btn-primary" type="submit" name="addItem" style="background-color:rgb(74,78,105);">Add Items</button>
                        <h1 style="font-size:29px;">&nbsp;&nbsp;</h1>
                    </form>
                </div>
                <div class="col-md-4">
                    <h1>Item</h1>
                </div>
                <div class="col-md-4">
                    <h1>Amount</h1>
                </div>
            </div>
        </div>
    </div>

        <?php

           DisplayInventory();

        ?>

    <div style="background-color:#f2e9e4;"></div>
    <script>
        document.getElementById("NameOfItem").addEventListener("blur", nameVal);
        document.getElementById("Stock").addEventListener("blur", stockVal);
        document.getElementById("Price").addEventListener("blur", priceVal);
    </script>
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

	if (isset($_POST['addItem'])) {

		AddItem();

	}

	if (isset($_POST['remove'])) {

		RemoveItem();

	}

	if (isset($_POST['change'])) {

		ChangeAmount();

	}

        function AddItem(){

		$db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

		if(mysqli_connect_errno()){

			exit("Error - Could not connect to MySQL");

		}

		$name = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['NameOfItem'])));
		$stock = htmlspecialchars(trim($_POST['Stock']));
		$price= htmlspecialchars(trim($_POST['Price']));
                $businessName = mysqli_real_escape_string($db,$_SESSION['bName']);
                $businessEmail = $_SESSION['bEmail'];


		if(strlen($name) > 0 && strlen($stock) > 0 && strlen($price) > 0){


                            $target_dir = "upload/";

			    foreach($_FILES as $myfile){

			    $target_file = "upload/".$myfile["name"];
			    $uploadOk = 1;
			    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			    // Check if image file is a actual image or fake image

					$check = getimagesize($myfile["tmp_name"]);

					if($check !== false) {
							//echo "File is an image - " . $check["mime"] . ".";
							$uploadOk = 1;
					} else {
							$uploadOk = 0;
					}

			    // Check if $uploadOk is set to 0 by an error
			    if ($uploadOk == 0) {

			           $sql = "INSERT INTO `InventoryItem` (`bemail`, `bname`, `istock`, `iname`, `iprice`, `iimage`) VALUES 
                                                           ('$businessEmail','$businessName','$stock','$name','$price','')";
                                   mysqli_query($db,$sql);

			    // if everything is ok, try to upload file
			    } else {
				
					if (move_uploaded_file($myfile["tmp_name"],"upload/".$myfile["name"])) {
			    
			                   $sql = "INSERT INTO `InventoryItem` (`bemail`, `bname`, `istock`, `iname`, `iprice`, `iimage`) VALUES 
                                                           ('$businessEmail','$businessName','$stock','$name','$price','$target_file')";
                                           mysqli_query($db,$sql);

					} else {
			           
			                   $sql = "INSERT INTO `InventoryItem` (`bemail`, `bname`, `istock`, `iname`, `iprice`, `iimage`) VALUES 
                                                           ('$businessEmail','$businessName','$stock','$name','$price','')";
                                           mysqli_query($db,$sql);

					}
				
			    }


                            mysqli_free_result($sql);


			}


		}else{

                        echo '<script type="text/javascript">';
                        echo 'alert("You need to fill out all fields.");';
                        echo '</script>';

	       }

               mysqli_close($db);


        }

     //Source: https://phppot.com/php/simple-php-shopping-cart/
    function DisplayInventory(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }


         $businessName = mysqli_real_escape_string($db,$_SESSION['bName']);

         $product_array = mysqli_query($db,"SELECT * FROM `InventoryItem` WHERE `bname`='$businessName' ORDER BY `idinventory` ASC");

         if (!empty($product_array)) {

            while($row = mysqli_fetch_assoc($product_array)){

               $name = mysqli_real_escape_string($db,$row["iname"]);
               $stock = $row["istock"];

	       
               echo "<div style='background-color:#f2e9e4;'>";
               echo "<div class='container'>";
               echo "<div class='row'>";
               echo "<div class='col-md-4'><small style='color:rgb(34,34,59);font-size:26px;'>$name</small></div>";
               echo "<div class='col-md-4'><small style='color:rgb(34,34,59);font-size:26px;'>$stock</small></div>";
               echo "<div class='col-md-4'>";
               echo "<form method='post' action='BusinessHomePage.php'>";
               echo "<input class='form-control' type='number' name='NumOfItem' placeholder='Number of items' min='0'>";
               echo "<input type='hidden' name='name' value='$name'/>";
               echo "<button class='btn btn-primary' type='submit' name='change'style='background-color:rgb(74,78,105);'>Change</button></form>";
               echo "<form method='post' action='BusinessHomePage.php'>";
               echo "<input type='hidden' name='name' value='$name'/>";
               echo "<button class='btn btn-primary' type='submit' name='remove' style='background-color:rgb(74,78,105);'>Remove</button></form>";
               echo "</div>";
               echo "</div>";
               echo "</div>";
               echo "</div>";
               

           }

        }

    }

    function RemoveItem(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }


         $businessName = mysqli_real_escape_string($db,$_SESSION['bName']);
         $itemName = mysqli_real_escape_string($db,$_POST['name']);

         mysqli_query($db,"DELETE FROM `InventoryItem` WHERE `bname`='$businessName' AND `iname`='$itemName'");

    }

    function ChangeAmount(){

          $db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

          if(mysqli_connect_errno()){

            exit("Error - Could not connect to MySQL");

          }


         $businessName = mysqli_real_escape_string($db,$_SESSION['bName']);
         $itemName = mysqli_real_escape_string($db,$_POST['name']);
         $stock = $_POST['NumOfItem'];

         mysqli_query($db,"UPDATE `InventoryItem` SET `istock`='$stock' WHERE `bname`='$businessName' AND `iname`='$itemName'");


    }



?>