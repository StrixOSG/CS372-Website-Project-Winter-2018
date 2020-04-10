function formValidation(event)
{
	var fname = document.registration.FirstName;
	var lname = document.registration.LastName;
	var email = document.registration.email; 
	var addr = document.registration.Address;
	var tel = document.registration.Telephone;
	var pwd = document.registration.password;
	var cpwd = document.registration.passwordrepeat;
 
	if(fNameVal(fname) == false || lNameVal(lname) == false || emailVal(email) == false || addressVal(addr) == false || telephoneVal(tel) == false || passwordVal(pwd) == false || cpasswordVal(cpwd) == false) {

          document.registration.action ="javascript:void(0);";
          return false;

        }else{

          document.registration.action="CustomerCreateAccount.php";
          return true;

        }

        return false;

}

function fNameVal(fname)
{ 
	var fname = document.registration.FirstName;
	var fnameformat = /^[A-Za-z]+$/;

	if(fname.value.match(fnameformat))
	{
		document.getElementById("fname_err").innerHTML = "";
		document.getElementById("FirstName").className = "form-control";
		return true;
	}
	else
	{
		document.getElementById("fname_err").innerHTML = "<p>Please enter a valid first name.</p>";
		document.getElementById("FirstName").className += ' border';
		return false;
	}
}

function lNameVal(lname)
{ 
	var lName = document.registration.LastName;
	var lnameformat = /^[A-Za-z]+$/;

	if(lName.value.match(lnameformat))
	{
		document.getElementById("lname_err").innerHTML = "";
		document.getElementById("LastName").className = "form-control";
		return true;
	}
	else
	{
		document.getElementById("lname_err").innerHTML = "Please enter a valid last name.";
		document.getElementById("LastName").className += ' border';
		return false;
	}
}

function emailVal(email)
{
	var Email = document.registration.email;
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(Email.value.match(mailformat))
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

function addressVal(addr)
{ 
	var Addr = document.registration.Address;
	var addrformat = /^\s*\S+(?:\s+\S+){2}/; //found regex: https://stackoverflow.com/questions/21264194/simple-regex-for-street-address

	if(Addr.value.match(addrformat))
	{
		document.getElementById("addr_err").innerHTML = "";
		document.getElementById("Address").className = "form-control";
		return true;
	}
	else
	{
		document.getElementById("addr_err").innerHTML = "Please enter a valid address.";
		document.getElementById("Address").className += ' border';
		return false;
	}
}

function telephoneVal(tel)
{
	var Tel = document.registration.Telephone;
	var telformat = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

	if (Tel.value.match(telformat)) 
	{
    	        document.getElementById("tel_err").innerHTML = "";
    	        document.getElementById("Telephone").className = "form-control";
    	        return true;
	} 
	else 
	{
    	        document.getElementById("tel_err").innerHTML = "Please enter a valid phone number.";
    	        document.getElementById("Telephone").className += ' border';
		return false;
	}
}

function passwordVal(pwd)
{
	var Pwd = document.registration.password;
	var pwdformat = /^(?=.*(\d|\W)).{8,}$/;

	if (Pwd.value.match(pwdformat))
	{
		document.getElementById("pwd_err").innerHTML = "";
		document.getElementById("password").className = "form-control";
		return true;
	}
	else
	{
		document.getElementById("pwd_err").innerHTML = "Must contain at least 8 characters and one number";
		document.getElementById("password").className += ' border';
		return false;
	}
}

function cpasswordVal(cpwd)
{
	var pwd = document.registration.password; 
        var cpwd = document.registration.passwordrepeat;


	if (pwd.value != cpwd.value)
	{
		document.getElementById("cpwd_err").innerHTML = "Check that your passwords match";
		document.getElementById("passwordrepeat").className += ' border';
		return false;
	}
	else
	{
                document.getElementById("cpwd_err").innerHTML = "";
		document.getElementById("passwordrepeat").className = "form-control";
		return true;
	}
}








