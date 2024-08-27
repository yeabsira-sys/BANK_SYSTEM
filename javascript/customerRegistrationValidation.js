// function to validate first name
function validateFname(){
  let fname = document.forms["cusregister"]["firstname"].value.trim();
  let errorElement = document.getElementsByClassName('fname_error');
  if (fname === "") {
    errorElement.innerHTML = "name is mandatory!";
    return false;
  }
  else if (!isNaN(fname)) {
    errorElement.textContent = "name can not contain number";
    return false;
  }
  errorElement.textContent = "";
  return true;
}

// function to validate last name
function validateLname(){
  let lname = document.forms["cusregister"]["lname"].value.trim();
  let errorElement = document.getElementsByClassName('lname_error');
  if (lname === "") {
    errorElement.innerHTML = "name is mandatory!";
    return false;
  }
  else if (!isNaN(lname)) {
    errorElement.textContent = "name can not contain number";
    return false;
  }
  errorElement.textContent = "";
  return true;
}

// function to validate customer phone number
function validatePhoneNumber() {
  let phoneNumber = document.forms["cusregister"]["phone"].value.trim();
  let errorElement = document.querySelector(".pho_error");

  if (phoneNumber === "") {
    errorElement.textContent = "Please enter customer's phone number.";
    return false;
  }

  else if(phoneNumber.length >= 10){
    
  let phonePattern = /^09[0-9]{8}$/; // Ethiopian phone number pattern
      if (!phonePattern.test(phoneNumber)) {
    errorElement.textContent = "Please enter a valid phone number";
    return false;
      }
    }
    errorElement.textContent = "";
    return true;
  }
  
// Function to validate date of birth
function validateDateOfBirth() {
  let dateOfBirth = document.forms["cusregister"]["birthdate"].value;
  let errorElement = document.querySelector(".birtherror");

  if (dateOfBirth === "") {
    errorElement.textContent = "Please enter customer's date of birth.";
    return false;
  }
  errorElement.textContent = "";
  return true;
}


function validateNationality() {
  let nationality = document.forms["cusregister"]["nationality"].value.trim();
  let errorElement = document.querySelector(".nation_error");

  if (nationality === "") {
    errorElement.textContent = "Please enter employee's nationality.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate the region
function validateRegion() {
  let region = document.forms["cusregister"]["region"].value.trim();
  let errorElement = document.querySelector(".region_error");

  if (region === "") {
    errorElement.textContent = "Please enter employee's region.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate the zone
function validateZone() {
  let zone = document.forms["cusregister"]["zone"].value.trim();
  let errorElement = document.querySelector(".zone_error");

  if (zone === "") {
    errorElement.textContent = "Please enter employee's zone.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate woreda
function validateWoreda() {
  let woreda = document.forms["cusregister"]["woreda"].value.trim();
  let errorElement = document.querySelector(".wereda_error");

  if (woreda === "") {
    errorElement.textContent = "Please enter employee's woreda.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate kebele
function validateKebele() {
  let kebele = document.forms["cusregister"]["kebele"].value;
  let errorElement = document.querySelector(".kebele_error");

  if (kebele === "") {
    errorElement.textContent = "enter employee's kebele.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate email
function validateEmail() {
  let email = document.forms["cusregister"]["email"].value.trim();
  let errorElement = document.querySelector(".email_error");
  let emailPattern = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
  if(email === ""){
    return true;
  }
 else if (!emailPattern.test(email)) {
    errorElement.textContent = "email is not valid.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// function to validate occupation

function validateOccupation(){

  let occupation = document.forms["cusregister"]["occupation"].value.trim();

  let errorElement = document.getElementsByClassName("occupation_error");

  if(occupation === ""){
    errorElement.textContent = "enter none if don't has any occupation";
    return false;
  }
  else if (!isNaN(occupation)) {
    errorElement.textContent = "occupation name can't contain numbers";
    return false;    
  }
  errorElement.textContent = "";
  return true;
}


// function to call all functions and ro prevent default action of Element

function validateAll(){

  let isValid = true;

  isValid  = validateFname() && isValid;
  isValid  = validateLname() && isValid;
  isValid  = validatePhoneNumber() && isValid;
  isValid  = validateDateOfBirth() && isValid;
  isValid  = validateNationality() && isValid;
  isValid  = validateRegion() && isValid;
  isValid  = validateWoreda() && isValid;
  isValid  = validateKebele() && isValid;
  isValid  = validateZone() && isValid;
  isValid  = validateEmail() && isValid;
  isValid  = validateOccupation() && isValid;

  return isValid;
}

// Add event listeners to which requires writing format
document.forms["cusregister"]["firstname"].addEventListener("input", validateFname);
document.forms["cusregister"]["lname"].addEventListener("input", validateLname);
document.forms["cusregister"]["phone"].addEventListener("input", validatePhoneNumber);
document.forms["cusregister"]["email"].addEventListener("input", validateEmail);

// Prevent form submission if there are validation errors
document.forms["cusregister"].addEventListener("submit", function (event) {
     if (!validateAll()) {
    event.preventDefault();
  }
  }
);