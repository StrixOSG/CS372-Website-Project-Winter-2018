function formValidation()
{
	var bname = document.registration.Businessname;
	var email = document.registration.email; 
	var addr = document.registration.Address;
	var pcode = document.registration.PostalCode;
	var tel = document.registration.Telephone;
	var desc = document.registration.Description;
	var pwd = document.registration.password;
	var cpwd = document.registration.passwordrepeat;
	var img = document.registration.ImageUpload;

	if(bNameVal(bname) == false || emailVal(email) == false || addressVal(addr) == false || postalVal(pcode) == false || telephoneVal(tel) == false || descriptionVal(desc) == false || passwordVal(pwd) == false || cpasswordVal(cpwd) == false || fileUploadVal(img) == false){
                 document.registration.action ="javascript:void(0);";
                 return false;
        }
        else
        {
                 document.registration.action="BusinessCreateAccount.php";
                 return true;

        }
        return false;
}

//function bNameVal(bname)
function bNameVal(bname)
{ 
	var bname = document.registration.Businessname; 
	var bnameformat = /^(?!\s)(?!.*\s$)(?=.*[a-zA-Z0-9])[a-zA-Z0-9 '~?!]{2,}$/; //regex: https://stackoverflow.com/questions/30726203/javascript-regular-expression-for-business-name-with-some-validation
	if(bname.value.match(bnameformat))
	{
		document.getElementById("bname_err").innerHTML = "";
		document.getElementById("Businessname").className = "form-control"
		return true;
	}
	else
	{
		document.getElementById("bname_err").innerHTML = "Please enter a valid Business name.";
		document.getElementById("Businessname").className += ' border';
		return false;
	}
}

function emailVal(email)
{
	var email = document.registration.email;
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

function addressVal(addr)
{ 
	addr = document.registration.Address;
	var addrformat = /^\s*\S+(?:\s+\S+){2}/; //found regex: https://stackoverflow.com/questions/21264194/simple-regex-for-street-address        
	if(addr.value.match(addrformat))
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

function postalVal(pcode)
{
	var pcode = document.registration.PostalCode;
	var pcodeformat = /^[Ss][4][KLMNPRSTVWXYZklmnprstvwxyz] ?[0-9][ABCEGHJKLMNPRSTVWXYZabcghjklmnprstvxyz][0-9]?/; 
	if (pcode.value.match(pcodeformat)) 
	{
    	        document.getElementById("pcode_err").innerHTML = "";
    	        document.getElementById("PostalCode").className = "form-control";
    	        return true;
	}
	else 
	{
    	        document.getElementById("pcode_err").innerHTML = "Please enter a valid Regina area postal code.";
    	        document.getElementById("PostalCode").className += ' border';
		return false;
	}
}

function telephoneVal(tel)
{
	var tel = document.registration.Telephone;
	var telformat = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
	if (tel.value.match(telformat)) 
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

function descriptionVal(desc)
{
	var desc = document.registration.Description;
	if (desc.value == "")
	{
		document.getElementById("desc_err").innerHTML = "Please describe your business.";
		document.getElementById("Description").className += ' border';               
		return false;
	}
	else
	{
		document.getElementById("desc_err").innerHTML = "";
		document.getElementById("Description").className += "form-control";
		return true;
	}
}

function passwordVal(pwd)
{
	var pwd = document.registration.password;
	var pwdformat = /^(?=.*(\d|\W)).{8,}$/;
	if (pwd.value.match(pwdformat))
	{
		document.getElementById("pwd_err").innerHTML = "";
		document.getElementById("password").className = "form-control";
		return true;
	}
	else
	{
		document.getElementById("pwd_err").innerHTML = "Please enter a valid password that is more than 7 characters long and has one number.";
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

function fileUploadVal(img)  //https://stackoverflow.com/questions/21396279/display-image-and-validation-of-image-extension-before-uploading-file-using-java
{
        var img = document.registration.ImageUpload;
        var FileUploadPath = img.value;
//To check if user upload any file
        if (FileUploadPath == '') 
        {
            document.getElementById("img_err").innerHTML = "Please upload an image.";
            return false;
        } 
        else 
        {
            var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
//The file uploaded is an image
			if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") 
			{
				document.getElementById("img_err").innerHTML = "";
// To Display
                if (img.files && img.files[0]) 
                {
                    var reader = new FileReader();

                    reader.onload = function(e) 
                    {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(img.files[0]);
                }

                return true;

            } 

//The file upload is NOT an image
			else 
			{
                document.getElementById("img_err").innerHTML = "Pleas upload a photo file (GIF, PNG, JPG, JPEG and BMP.)";
            	return false;

            }
        }

    }





