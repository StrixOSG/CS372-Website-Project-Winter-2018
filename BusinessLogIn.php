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
    <script src="businessLoginVal.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
</head>

<body>
    <div></div>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="background-color:rgb(154,140,152);">
            <div class="container"><a class="navbar-brand" href="#" style="color:#22223b;">Greg's List</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto"></ul><span class="navbar-text actions"> <a href="index.php" class="login" style="color:#22223b;">Customer Log In</a><a class="btn btn-light action-button" role="button" href="BusinessCreateAccount.php" style="background-color:rgb(74,78,105);">Sign Up</a></span></div>
    </div>
    </nav>
    </div>
    <div class="login-clean" style="background-color:rgb(242,233,228);">
        <form name = "login" method="post" action="BusinessLogIn.php" style="background-color:rgb(154,140,152);" onSubmit="return formValidation();">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate" style="color:#4a4e69;"></i></div>

            <div class="error" id="email_err"></div>
            <div class="form-group"><input class="form-control" type="email" name="email" id="email" placeholder="Email"></div>
            <div class="error" id="pwd_err"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" id="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="signin" style="background-color:#4a4e69;">Log In</button></div>
            <!–– Code Source: https://geekgoddess.com/how-to-resize-the-google-nocaptcha-recaptcha/ and https://www.google.com/recaptcha ––>
            <div class="g-recaptcha" data-sitekey="6Lf7Mk0UAAAAAENEv_X-UC-fidyTYi6wcCKpFEs9" data-theme="light" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
        </form>
    </div>
    <div class="footer-basic" style="background-color:rgb(154,140,152);">
        <footer>
            <div class="social"></div>
            <ul class="list-inline"></ul>
            <p class="copyright">Greg's List © 2017</p>
        </footer>
    </div>
    <script>
        document.getElementById("email").addEventListener("blur", emailVal);
	document.getElementById("password").addEventListener("blur", passwordVal);
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php

	if (isset($_POST['signin'])) {

		SignIn();
                exit();

	}

        function SignIn(){

		$db = mysqli_connect("localhost","CS372GLUser","GregsList2018","gregslist");

		if(mysqli_connect_errno()){

			exit("Error - Could not connect to MySQL");

		}

		$email = htmlspecialchars(trim($_POST['email']));
                $password = htmlspecialchars(trim($_POST['password']));
                $query = mysqli_query($db,"SELECT `bemail`, `bname`, `bphone`, `bpostalcode`, `bimage`, `baddress`, `btype`, `bdescription`, `bpassword` FROM Business WHERE bemail='$email' AND bpassword='$password';");
		
                //Code source for Google Captcha and PHP: https://www.youtube.com/watch?v=txk_WBN5F4c&
                $secret = "6Lf7Mk0UAAAAAHPSGh2V97XDsGzD5FidnxIPzuih";
                $response = $_POST["g-recaptcha-response"];
                $remoteip = $_SERVER["REMOTE_ADDR"];

                $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip");
                $result = json_decode($url, TRUE);

                if($result["success"] == 1){


                if($row = mysqli_fetch_assoc($query)){

			$_SESSION["bEmail"] = $row["bemail"];
			$_SESSION["bName"] = $row["bname"];
			$_SESSION["bPhone"] = $row["bphone"];
			$_SESSION["bPostalCode"] = $row["bpostalcode"];
			$_SESSION["bImage"] = $row["bimage"];
			$_SESSION["bAddress"] = $row["baddress"];
			$_SESSION["bType"] = $row["btype"];
			$_SESSION["bDescription"] = $row["bdescription"];
			$_SESSION["bPassword"] = $row["bpassword"];
                        echo "<script>window.location = 'http://www.gregslist.ca/BusinessHomePage.php'</script>";
			mysqli_free_result($query);
			mysqli_close($db);
			exit();

		}else{
			echo '<script type="text/javascript">';
			echo 'alert("Invalid login.");';
			echo '</script>';
		}

                } else{
                
			echo '<script type="text/javascript">';
			echo 'alert("Please check reCaptcha and try again.");';
			echo '</script>';

                }
		mysqli_free_result($query);
		mysqli_close($db);

	}


               
?>
