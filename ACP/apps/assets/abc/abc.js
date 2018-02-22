function validateform() { 
	var status = true; 
	
	// Validate Email
	var str = document.getElementById("txtEmail").value;
	if (str === "") { 
		document.getElementById("valEmail").innerHTML = "* Email address is required.";
		status = false;
	}  else if (!str.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
		document.getElementById("valEmail").innerHTML = "* Please enter a valid email.";
		status = false;
	} else if (str.length > 30){
		document.getElementById("valEmail").innerHTML = "* Email must be 30 characters of less";
		status = false;
	} else {	
		document.getElementById("valEmail").innerHTML = "";
	}
	
	// Validate First Name
	str = document.getElementById("txtFirstName").value;
	if (str === "") {
		document.getElementById("valFirstName").innerHTML = "* First Name is required";
		status = false;
	} else if (!str.match(/^[a-zA-Z\s]+$/)) {
		document.getElementById("valFirstName").innerHTML = "* First Name must be alphabet";
		status = false;
	} else if (str.length > 30) {
		document.getElementById("valFirstName").innerHTML = "* First Name must be 30 characters or less";
		status = false;
	} else {
		document.getElementById("valFirstName").innerHTML = "";
	}
	
	// Validate Last Name
	str = document.getElementById("txtLastName").value;
	if (str === "") {
		document.getElementById("valLastName").innerHTML = "* Last Name is required.";
		status = false;
	} else if (!str.match(/^[a-zA-Z\s]+$/)) {
		document.getElementById("valLastName").innerHTML = "* Last Name must be alphabet.";
		status = false;
	} else if (str.length > 30) {
		document.getElementById("valLastName").innerHTML = "* Last Name must be 30 characters or less.";
		status = false;	
	} else {
		document.getElementById("valLastName").innerHTML = "";
	}
	
	// Validate Password
	str = document.getElementById("txtPassword").value;
	if (str === "") {
		document.getElementById("valPassword").innerHTML = "* Passowrd is required.";
		status = false;
	} else {
		document.getElementById("valPassword").innerHTML = "";
	}
	
	// Validate ConfirmPassword
	str = document.getElementById("txtConfirmPassword").value;
	if (str === "") {
		document.getElementById("valConfirmPassword").innerHTML = "* Confirmation Password is required.";
		status = false;
	} else {
		document.getElementById("valConfirmPassword").innerHTML = "";
	}
	
	if (trim(document.getElementById("txtConfirmPassword").value) !== trim(document.getElementById("txtPassword").value)) {
		document.getElementById("valPassword").innerHTML = "* Passowrd does not match.";
		return false;
	} else {
		document.getElementById("valPassword").innerHTML = "";
	}
		

	return status;
}


