// Function to validate the first name
function validateFirstName() {
  var firstName = document.forms["empregiter"]["fname"].value.trim();
  var errorElement = document.querySelector(".fname_error");

  if (firstName === "") {
    errorElement.textContent = "Please enter employee's first name.";
    return false;
  }
  else if (!isNaN(firstName)) {
    errorElement.textContent = "name should't contain numbers.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate last name
function validateLastName() {
  var lastName = document.forms["empregiter"]["lname"].value.trim();
  var errorElement = document.querySelector(".lname_error");

  if (lastName === "") {
    errorElement.textContent = "Please enter employee's last name.";
    return false;
  }

  else if(!isNaN(lastName)){
    errorElement.textContent = "name should't contain numbers.";
    return false;
  }
  errorElement.textContent = "";
  return true;
}

// Function to validate phone number
function validatePhoneNumber() {
  var phoneNumber = document.forms["empregiter"]["phone"].value.trim();
  var errorElement = document.querySelector(".pho_error");

  if (phoneNumber === "") {
    errorElement.textContent = "Please enter employee's phone number.";
    return false;
  }

  var phonePattern = /^09[0-9]{8}$/; // Ethiopian phone number pattern
  if(phoneNumber.length == 10){
      if (!phonePattern.test(phoneNumber)) {
    errorElement.textContent = "Please enter a valid phone number (e.g., 0934554345).";
    return false;
      }

  }
  errorElement.textContent = "";
  return true;
}

// Function to validate date of birth
function validateDateOfBirth() {
  var dateOfBirth = document.forms["empregiter"]["birthdate"].value;
  var errorElement = document.querySelector(".birtherror");

  if (dateOfBirth === "") {
    errorElement.textContent = "Please enter employee's date of birth.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate nationality
function validateNationality() {
  var nationality = document.forms["empregiter"]["nationality"].value.trim();
  var errorElement = document.querySelector(".nation_error");

  if (nationality === "") {
    errorElement.textContent = "Please enter employee's nationality.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate the region
function validateRegion() {
  var region = document.forms["empregiter"]["region"].value.trim();
  var errorElement = document.querySelector(".region_error");

  if (region === "") {
    errorElement.textContent = "Please enter employee's region.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate the zone
function validateZone() {
  var zone = document.forms["empregiter"]["zone"].value.trim();
  var errorElement = document.querySelector(".zone_error");

  if (zone === "") {
    errorElement.textContent = "Please enter employee's zone.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate woreda
function validateWoreda() {
  var woreda = document.forms["empregiter"]["woreda"].value.trim();
  var errorElement = document.querySelector(".wereda_error");

  if (woreda === "") {
    errorElement.textContent = "Please enter employee's woreda.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate kebele
function validateKebele() {
  var kebele = document.forms["empregiter"]["kebele"].value;
  var errorElement = document.querySelector(".kebele_error");

  if (kebele === "") {
    errorElement.textContent = "enter employee's kebele.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate email
function validateEmail() {
  var email = document.forms["empregiter"]["email"].value.trim();
  var errorElement = document.querySelector(".email_error");
  var emailPattern = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
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

// Function to validate role
function validateRole() {
  var role = document.forms["empregiter"]["role"].value;
  var errorElement = document.querySelector(".role_error");

  if (role === "") {
    errorElement.textContent = "Please enter emplooyee's role.";
    return false;
  }
  else if (!isNaN(role)) {
    errorElement.textContent = "only leters alowed.";
    return false;
  }
  errorElement.textContent = "";
  return true;
}
// Function to validate salary
function validateSalary() {
  var salary = document.forms["empregiter"]["salary"].value.trim();
  var errorElement = document.querySelector(".salary_error");

  if (salary === "") {
    errorElement.textContent = "Please enter employee salary.";
    return false;
  }
  else if (isNaN(salary)) {
    errorElement.textContent = "salary should only contain number.";
    return false;
  }

  errorElement.textContent = "";
  return true;
}

// Function to validate entire form
function validateForm() {
  var isValid = true;

  isValid = validateFirstName() && isValid;
  isValid = validateLastName() && isValid;
  isValid = validatePhoneNumber() && isValid;
  isValid = validateDateOfBirth() && isValid;
  isValid = validateNationality() && isValid;
  isValid = validateRegion() && isValid;
  isValid = validateZone() && isValid;
  isValid = validateWoreda() && isValid;
  isValid = validateKebele() && isValid;
  isValid = validateEmail() && isValid;
  isValid = validateRole() && isValid;
  isValid = validateSalary() && isValid;

  return isValid;
}

// Add event listeners to which requires writing format
document.forms["empregiter"]["fname"].addEventListener("input", validateFirstName);
document.forms["empregiter"]["lname"].addEventListener("input", validateLastName);
document.forms["empregiter"]["phone"].addEventListener("input", validatePhoneNumber);
document.forms["empregiter"]["email"].addEventListener("input", validateEmail);
document.forms["empregiter"]["role"].addEventListener("input", validateRole);
document.forms["empregiter"]["salary"].addEventListener("input", validateSalary);

// Prevent form submission if there are validation errors
document.forms["empregiter"].addEventListener("submit", function (event) {
     if (!validateForm()) {
    event.preventDefault();
  }
  }
);