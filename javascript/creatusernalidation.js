// function to validate user input for correct id 

function validateID(){
  let userid = documnet.forms ["crtyser"]["id"];
  let errorelement = document.getElementsByClassName('userid_error');
  if(userid === ""){
    errorelement.textContent = "Enter employee's id first!";
    return false;
  }
  else if(isNaN(userid)){
    errorelement.textContent = "employee id should be only number";
    return false;
  }
  errorelement.textContent = "";
  return true;
}

document.forms ["cruser"]["id"].addEventListener('input', validateID);

document.forms["crtuser"].addEventListener('submit', function(e){
      if(!validateID()){
        e.preventDefault();
}

    }
);