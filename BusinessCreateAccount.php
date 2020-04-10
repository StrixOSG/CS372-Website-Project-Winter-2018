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
    <script src="businessCreateVal.js"></script>
</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color:rgb(154,140,152);">
            <div class="container"><a class="navbar-brand" href="#" style="color:rgb(34,34,59);">Greg's List</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto"></ul><span class="navbar-text actions" style="color:#22223b;"> <a href="BusinessLogIn.php" class="login" style="color:#22223b;">Business Log In</a></span></div>
    </div>
    </nav>
    </div>
    <div class="register-photo" style="background-color:rgb(242,233,228);">
        <div class="form-container">
            <div class="image-holder"></div>
            <form name = "registration" action="BusinessCreateAccount.php" method="post" enctype="multipart/form-data" style="background-color:rgb(154,140,152);" onSubmit="return formValidation();">
                <h2 class="text-center" style="color:rgb(34,34,59);"><strong>Create</strong> an account.</h2>
                
                <div class="error" id="bname_err"></div>
                <div class="form-group"><input id="Businessname"class="form-control" type="text" name="Businessname" placeholder="Business Name"></div>
                <div class="error" id="email_err"></div>
                <div class="form-group"><input id="email" class="form-control" type="email" name="email" placeholder="Email"></div>
                <div class="error" id="addr_err"></div>
                <div class="form-group"><input id="Address" class="form-control" type="text" name="Address" placeholder="Address"></div>
                <div class="error" id="pcode_err"></div>
                <div class="form-group"><input id="PostalCode" class="form-control" type="text" name="PostalCode" placeholder="Postal Code"></div>
                <div class="error" id="tel_err"></div>
                <div class="form-group"><input id="Telephone" class="form-control" type="tel" name="Telephone" placeholder="Telephone"></div>
                <div class="form-group"><select name = "businessType" class="form-control"><optgroup label="Chose Your Business Type"><option value="Pawn" selected="">Pawn Shop</option><option value="Shop">Shop</option><option value="Food">Food</option></optgroup></select></div>
                <div class="error" id="img_err"></div>
                <div class="form-group"><small style="height:auto;font-size:23px;color:rgb(34,34,59);">Upload Your Brands Logo:</small><input id="ImageUpload" type="file" name="ImageUpload" style="color:rgb(34,34,59);"></div>
                <div class="error" id="desc_err"></div>
                <div class="form-group"><textarea id="Description" class="form-control form-control-lg" name="Description" placeholder="Describe Your Business"></textarea></div>
                <div class="error" id="pwd_err"></div>
                <div class="form-group"><input id="password" class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="error" id="cpwd_err"></div>
                <div class="form-group"><input id="passwordrepeat" class="form-control" type="password" name="passwordrepeat" placeholder="Password (repeat)"></div>
                
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" required>I agree to the license terms.</label></div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="register" style="background-color:rgb(74,78,105);">Sign Up</button></div>
            </form>
        </div>
    </div>
    <div class="footer-basic" style="background-color:rgb(154,140,152);">
        <footer>
            <div class="social"></div>
            <ul class="list-inline"></ul>
            <p class="copyright">Greg's List © 2017</p>
        </footer>
    </div>
   <script> document.getElementById("Businessname").addEventListener("blur", bNameVal);
            document.getElementById("email").addEventListener("blur", emailVal);
	    document.getElementById("Address").addEventListener("blur", addressVal);
	    document.getElementById("PostalCode").addEventListener("blur", postalVal);
	    document.getElementById("Telephone").addEventListener("blur", telephoneVal);
	    document.getElementById("Description").addEventListener("blur", descriptionVal);
	    document.getElementById("password").addEventListener("blur", passwordVal);
	    document.getElementById("passwordrepeat").addEventListener("blur", cpasswordVal);
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php

	if (isset($_POST['register'])) {

		Register();

	}

        function Register(){

		$db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

		if(mysqli_connect_errno()){

			exit("Error - Could not connect to MySQL");

		}

		$email = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['email'])));
		$businessName = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['Businessname'])));
		$postalCode = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['PostalCode'])));
		$address = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['Address'])));
		$telephone = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['Telephone'])));
                $businessType = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['businessType'])));
                $description = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['Description'])));
                $password = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['password'])));
                $passwordR = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['passwordrepeat'])));


		if(strlen($email) > 0 && strlen($businessName) > 0 && strlen($postalCode) > 0 && strlen($address) > 0 && strlen($password) > 0 && strlen($businessType) > 0 && strlen($description) > 0 && strlen($passwordR) > 0){

                    if($password == $passwordR){

                        $result = mysqli_query($db,"SELECT bemail FROM Customer WHERE bemail='$email';");
                        $result2 = mysqli_query($db,"SELECT bname FROM Customer WHERE bname='$businessName';");

                        //Check if email doesn't exist in DB
			if(mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) == 0){


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

			           $sql = "INSERT INTO `Business` (`bemail`, `bname`, `bphone`, `bpostalcode`, `bimage`, `baddress`, `btype`, `bdescription`, `bpassword`) VALUES 
                                                           ('$email','$businessName','$telephone','$postalCode','','$address','$businessType','$description','$password')";
                                   mysqli_query($db,$sql);

			    // if everything is ok, try to upload file
			    } else {
				
					if (move_uploaded_file($myfile["tmp_name"],"upload/".$myfile["name"])) {
			    
                                               $sql = "INSERT INTO `Business` (`bemail`, `bname`, `bphone`, `bpostalcode`, `bimage`, `baddress`, `btype`, `bdescription`, `bpassword`) VALUES 
                                                                              ('$email','$businessName','$telephone','$postalCode','$target_file','$address','$businessType','$description','$password')";
                                               mysqli_query($db,$sql);

					} else {
			           
                                               $sql = "INSERT INTO `Business` (`bemail`, `bname`, `bphone`, `bpostalcode`, `bimage`, `baddress`, `btype`, `bdescription`, `bpassword`) VALUES 
                                                           ('$email','$businessName','$telephone','$postalCode','','$address','$businessType','$description','$password')";

                                               mysqli_query($db,$sql);

					}
				
			    }

			    }


                            mysqli_free_result($sql);


			}

                        mysqli_free_result($result);
                        mysqli_free_result($result2);
		        echo "<script>window.location = 'http://www.gregslist.ca/BusinessLogIn.php'</script>";
                        exit();

                   }else{

                        echo '<script type="text/javascript">';
                        echo 'alert("Passwords need to match before submitting.");';
                        echo '</script>';


                   }

		}else{

                        echo '<script type="text/javascript">';
                        echo 'alert("You need to fill out all forms.");';
                        echo '</script>';

	       }

               mysqli_close($db);


        }


?>