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
    <script src="customerCreateVal.js"></script>
</head>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color:rgb(154,140,152);">
            <div class="container"><a class="navbar-brand" href="#" style="color:rgb(34,34,59);">Greg's List</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto"></ul><span class="navbar-text actions"> <a href="index.php" class="login" style="color:rgb(34,34,59);">Customer Log In</a></span></div>
    </div>
    </nav>
    </div>
    <div class="register-photo" style="background-color:rgb(242,233,228);">
        <div class="form-container">
            <div class="image-holder"></div>
            <form name = "registration" action="CustomerCreateAccount.php" method="post" style="background-color:rgb(154,140,152);" onSubmit="return formValidation();">
                <h2 class="text-center" style="color:rgb(34,34,59);"><strong>Create</strong> an account.</h2>

                <div class="error" id="fname_err"></div>
                <div class="form-group"><input class="form-control" type="text" name="FirstName" id="FirstName" placeholder="First Name"></div>

                <div class="error" id="lname_err"></div>
                <div class="form-group"><input class="form-control" type="text" name="LastName" id="LastName" placeholder="Last Name"></div>

                <div class="error" id="email_err"></div>
                <div class="form-group"><input class="form-control" type="email" name="email" id="email" placeholder="Email"></div>

                <div class="error" id="addr_err"></div>
                <div class="form-group"><input class="form-control" type="text" name="Address" id="Address" placeholder="Address"></div>

                <div class="error" id="tel_err"></div>
                <div class="form-group"><input class="form-control" type="tel" name="Telephone" id="Telephone" placeholder="Telephone"></div>

                <div class="error" id="pwd_err"></div>
                <div class="form-group"><input class="form-control" type="password" name="password" id="password" placeholder="Password"></div>
                

                <div class="error" id="cpwd_err"></div>
                <div class="form-group"><input class="form-control" type="password" name="passwordrepeat" id="passwordrepeat" placeholder="Password (repeat)"></div>



                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" required>I agree to the license terms.</label></div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="register" style="background-color:rgb(74,78,105);">Sign Up</button></div><a href="CustomerLogIn.html" class="already">You already have an account? Login here.</a></form>
        </div>
    </div>
    <div class="footer-basic" style="background-color:rgb(154,140,152);">
        <footer>
            <div class="social"></div>
            <ul class="list-inline"></ul>
            <p class="copyright">Greg's List © 2017</p>
        </footer>
    </div>
    <script>
        document.getElementById("FirstName").addEventListener("blur", fNameVal);
        document.getElementById("LastName").addEventListener("blur", lNameVal);
        document.getElementById("email").addEventListener("blur", emailVal);
        document.getElementById("Address").addEventListener("blur", addressVal);
        document.getElementById("Telephone").addEventListener("blur", telephoneVal);
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
		$firstName = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['FirstName'])));
		$lastName = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['LastName'])));
		$address = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['Address'])));
		$telephone = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['Telephone'])));
                $password = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['password'])));
                $passwordR = htmlspecialchars(mysqli_real_escape_string($db,trim($_POST['passwordrepeat'])));


		if(strlen($email) > 0 && strlen($firstName) > 0 && strlen($lastName) > 0 && strlen($address) > 0 && strlen($telephone) > 0 && strlen($password) > 0 && strlen($passwordR) > 0){

                  if($password == $passwordR){

                        $result = mysqli_query($db,"SELECT uemail FROM Customer WHERE uemail='$email';");

                        //Check if email doesn't exist in DB
			if(mysqli_num_rows($result) == 0){


			    $sql = "INSERT INTO `Customer` (`uemail`, `ufname`, `ulname`, `uaddress`, `uphone`, `upassword`) VALUES ('$email','$firstName','$lastName','$address','$telephone','$password')";
                            mysqli_query($db,$sql);

                            mysqli_free_result($sql);


			}

                        mysqli_close($db);
                        mysqli_free_result($result);
		        echo "<script>window.location = 'http://www.gregslist.ca/index.php'</script>";
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

       


        }


?>