function formValidation()
{
     var name = document.addItem.NameOfItem;
     var img = document.addItem.ImageUpload;
     var stock = document.addItem.Stock;
     var price = document.addItem.Price;

     if(nameVal(name) == false || fileUploadVal(img) == false || stockVal(stock) == false || priceVal(price) == false){
                 document.addItem.action ="javascript:void(0);";
                 return false;
        }
        else
        {
                 document.addItem.action="BusinessHomePage.php";
                 return true;
        }
        return false;
}

function nameVal(name)
{
	var name = document.addItem.NameOfItem;
	if(name.value == '')
	{
		document.getElementById("name_err").innerHTML = "Please give your item a name.";
		document.getElementById("NameOfItem").className += ' border';
		return false;
	}
	else
	{
		document.getElementById("name_err").innerHTML = "";
		document.getElementById("NameOfItem").className = "form-control";
		return true;
	}
		
}

function fileUploadVal(img)  //https://stackoverflow.com/questions/21396279/display-image-and-validation-of-image-extension-before-uploading-file-using-java
{
        var img = document.addItem.ImageUpload;
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

function stockVal(stock)
{
	var stock = document.addItem.Stock;
	if(stock.value == '')
	{
		document.getElementById("stock_err").innerHTML = "Please enter the stock amount.";
		document.getElementById("Stock").className += ' border';
		return false;
	}
	else
	{
		document.getElementById("stock_err").innerHTML = "";
		document.getElementById("Stock").className = "form-control";
		return true;
	}
}

function priceVal(price)
{
	var price = document.addItem.Price;
	var pricematch = /^\d+(,\d{1,2})?$/
	if(price.value.match(pricematch) == true || price.value == '')
	{
		document.getElementById("price_err").innerHTML = "Please enter the price amount.";
		document.getElementById("Price").className += ' border';
		return false;
	}
	else
	{
		document.getElementById("price_err").innerHTML = "";
		document.getElementById("Price").className = "form-control";
		return true;
	}
}

function changeVal()
{
	var numitem = document.change.NumOfItem;
	
	if(numItemVal(numitem) == false){
                 document.change.action ="javascript:void(0);";
                 return false;
        }
        else
        {
                 document.change.action="BusinessHomePage.php";
                 return true;
        }
        return false;
}

function numItemVal(numitem)
{
	var numitem = document.change.NumOfItem;
	if(numItem.value == '')
	{
		document.getElementById("numitem_err").innerHTML = "Please enter the stock amount.";
		document.getElementById("NumOfItem").className += ' border';
		return false;
	}
	else
	{
		document.getElementById("numitem_err").innerHTML = "";
		document.getElementById("NumOfItem").className = "form-control";
		return true;
	}
}


