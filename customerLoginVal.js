function formValidation()
{
	var email = document.login.email;
	var pwd = document.login.password;

	if(emailVal(email) == false || passwordVal(pwd) == false) {

          document.login.action ="javascript:void(0);";
		return false;

        }else{

          document.login.action="index.php";
 		return true;

        }

        return false;
}

function emailVal(email)
{
	var email = document.login.email;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(email.value.match(mailformat))
	{
		document.getElementById("email_err").innerHTML = "";
		document.getElementById("email").className = "form-control";
		return true;
	}
	else
	{
		document.getElementById("email_err").innerHTML = "Please enter a valid email.";
		document.getElementById("email").className += ' border';
		return false;
	}
}

function passwordVal(pwd)
{
	var pwd = document.login.password;
	var pwdformat = /^(?=.*(\d|\W)).{8,}$/; //regex: www.cs.uregina.ca/shaver1m/signup.php
	if (pwd.value.match(pwdformat))
	{
		document.getElementById("pwd_err").innerHTML = "";
		document.getElementById("password").className = "form-control";
		return true;
	}
	else
	{
		document.getElementById("pwd_err").innerHTML = "Please enter a valid password";
		document.getElementById("password").className += ' border';
		return false;
	}
}