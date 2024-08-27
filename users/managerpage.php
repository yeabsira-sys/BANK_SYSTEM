<?php
session_start();
if(empty($_SESSION["username"])){
  header("location: ../login/loginform.php" );
}
include("../header/header.php");
require("../footer/footer.php");
require("../functionspage/logfile.php");
require("../functionspage/withdraw.php");
require("../functionspage/removeemployee.php");
require("../functionspage/registeremployee.php");
function makeConnection(){
        $serverName = "localhost";
        $dbUser = "root";
        $dbPassword = "rootmein@";           
        $dbName = "Bank_Management_System";
                 
      $connection = mysqli_connect( $serverName, $dbUser, $dbPassword, $dbName );// connect to the data base
return $connection;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KURATH BANK</title>
  <link rel="stylesheet" href="../footer/footer.css">
  <link rel="stylesheet" href="../header/header.css">
  <link rel="stylesheet" href="../css/managerpage.css">
</head>

<body>
<div class="mainmanagercontainer">
      <div class="rightsideman">
          <div class="managertasks">
            <form action="managerpage.php" class="listener" name="m_task" method="post">  
            <input type="submit" value="Register Employee" name= "registeremployee">          
            <input type="submit" value="Remove Employee" name= "removeemployee">
            <input type="submit" value="Register User" name= "registeruser">
            <input type="submit" value="Block Account" name= "blockaccount">
            <input type="submit" value="Update Account" name= "updateaccount">
            <input type="submit" value="Close Account" name= "closeaccount">
            <input type="submit" value="See Log File" name= "seelogfile">     
            </form>  
          </div>
      </div>
      <div class="leftsideman">
        <?php 
              if(isset($_POST["registeremployee"])) {
                registerEmployee();
              }
              if(isset($_POST["registeruser"])){
                registerUser();
              }
              if(isset($_POST["removeemployee"])){
                  removeEmployee();
              }
              if(isset($_POST["blockaccount"])){
                blockAccount();
            }
            if(isset($_POST["updateaccount"])){
                updateAccount();
            }
            if(isset($_POST["closeaccount"])){
                closeAccount();
            }
            if(isset($_POST["seelogfile"])){
              seeLogFile();
            }


        // function to display user registration form

       function registerUser(){
          ?>

            <div class="userregpage" id="userregpage">
              <form action="managerpage.php" class="user-registration-form" method="post" name="crtuser">
                  
              <div class="uservalue">
               
                    <label for="id">User's id here</label><br>
                    <input class="valu" type="number" required name="id" class="id"><br>
                    <span class="userid_error"></span>
                  </div>
                  <div class="uservalue">
                  <label for="role">User's Role</label><br>
                    <select name="role" id="userroleid">
                      <option value="teller">Teller</option>
                      <option value="cashier">Cashier</option>
                      <option value="ouditer">Ouditer</option>
                      <option value="loanofficer">Loan Officer</option>
                      <option value="manager">Manager</option>
                    </select>
                  </div>
             
              <div class="createbtn">
                <input type="submit" name="createuser" value="create" class="btnRegister">
              </div>
              </form>
            </div>  
          <?php
        }

        function blockAccount(){
          ?>
          <div class="blockaccdiv">
            <form action="managerpage.php" name="blockacno" class="blockacno" method="post">
            <div>
                <label for="acno">Acount number</label><br>
                <input type="number" name="acno" placeholder="account.no" required><br>
                <small class="acno-error"></small><br>
                <input type="submit" name="blockthis" class="btnRegister" value="Enter">
              </div>
            </form>
          </div>
          <?php
        }

        function updateAccount(){
          ?>
          <div class="updatediv">
            <form action="managerpage.php" name="udateaccname" class="updateaccname" method="post">
              <div>
                <label for="account">Enter Account Number</label><br>
                <input type="number" required name="account" placeholder="account.no">
              </div>
              <div>
                <input type="submit" name="update" class="btnRegister" value="update">
              </div>
            </form>
          </div>
          <?php
        }

        function closeAccount(){
          ?>
          <div class="closeaccdiv">
            <form action="managerpage.php" class="closeaccount" method="post">
              <div>
                <label for="acno">Account Number</label><br>
                <input type="number" required name="acno" placeholder="account.no">
              </div>
              <input type="submit" class="btnRegister" name="closethis" value="close">
            </form>
          </div>
          <?php
        }

        function seeLogFile(){
          ?>
          <div class="transaccountdiv">
            <form action="managerpage.php" name="transaccount" class="transaccount" method="post">
              <div>
                <label for="accno">Account Number</label><br>
                <input type="number" name="accno" required placeholder="account number"><br>
              </div>
              <input type="submit" name="transacno" class="btnRegister" value="Transactions">
            </form>
          </div>
          <?php
        }
        //employee remuval logic

        if(isset($_POST["delete"])){
          $empname = trim(htmlspecialchars($_POST["empname"]));
          $empid = trim(htmlspecialchars($_POST["empid"]));
          global $empname, $empid;

          // function to validate empname
          function validateEmpname($empname){
            if (empty($empname)) {
               return false;
            }
            else if(!preg_match("/^[a-zA-Z ]*$/",$empname))
                  {
                    return false;
                  }
                  return true;
                }
          
        // function to validate empid

        function validateEmpID($empid){
          if(empty($empid)){
            return false;
          }
          else if(!preg_match("/^[.0-9]*$/", $empid)){
            return false;
          }
          return true;
        }
        
        // call both validater

        function valid(){
          $valide = true;
          global $empid, $empname;
          $valide = validateEmpID($empid) && $valide;
          $valide = validateEmpname($empname) && $valide;

          return $valide;
        }
              if(valid()){
               
                   if(makeConnection()){
                    global $empid, $empname;
                    $sql = "SELECT first_name, last_name, employee_id, role FROM employee WHERE employee_id ="."'$empid'";
                    $result = mysqli_query(makeConnection(), $sql);
                    $delemp = mysqli_fetch_assoc($result);

                    if(empty($delemp)){
                      echo "<h1 class="."noemployeeinid> No Employee With That ID</h1>";
                    }
                    else if($delemp["first_name"] != $empname){
                      echo "<h1 class="."empnotsame>THEIR IS NO EMPLOYEE WITH  ".$empname."  AND  ". $empid."</h1><br>";
                    }
                    else{
                      ?>
                      <div class="commitdelet">
                        <form action="managerpage.php" method="post" name="commitdelete" class="rememployee">
                          <h1 class="empinformation">Employee Information</h1><br>
                          <div>
                           <label for="firstlastname"> full name</label>
                          <input type="button" class="empinformation" name="firstlastname" value="<?php
                           echo $delemp["first_name"]."  ".$delemp["last_name"];?>"> 
                          </div>
                          
                          <div>
                            <label for="empid">Employee id</label>
                          <input type="button" name="empid" value="<?php
                            echo $delemp["employee_id"];
                            ?>"><br>
                          </div>
                          <div>
                            <label for="role">Employee role</label>
                            <input type="button" name=
                            "role" class="emproll" value="<?php 
                            echo $delemp["role"];
                            ?>">
                          </div>
                          
                          <input type="submit" name="assuredelete" value="delete" class="btnclear">
                           
                        </form>
                      </div>
                      <?php
                      
                    }
                    
                   
              }}
      }
      // assure delete
      if(isset($_POST["assuredelete"])){
       
        $empid = $_POST["empid"];
        $sql = "DELETE FROM employee WHERE employee_id ="."'$empid'";
        echo $empid;
        if(mysqli_query(makeConnection(), $sql)){
          echo "<h3 class="."empinformation>  deleted successfuly</h3><br>";    
        }
        mysqli_close(makeConnection());
      }
        // user creation logic
            if(isset($_POST["createuser"])){
              $id = trim(htmlspecialchars($_POST["id"]));
              $role = $_POST["role"];
              // function to validate the inputed id
                function validateID($id){
                  if(empty($id)){
                    return false;
                  }
                  else if(!preg_match("/^[.0-9]*$/", $id)){
                    return false;
                  }
                  return true;
                }

                if(validateID($id)){
                
                      if(makeConnection()){
                      $sql = "SELECT employee_id, role, first_name FROM employee WHERE employee_id ="." '$id'";
                      $result = mysqli_query(makeConnection(), $sql);
                      $selectiveuser = mysqli_fetch_assoc($result);
                      if($selectiveuser["employee_id"] != $id){
                        ?>
                        <div class="no-employee">
                          <h2 class="statusinfo">THIER IS NO EMPLOYEE WITH <?php echo $id; ?></h2>
                          <h3>please enter correct id or register</h3>
                          <form action="managerpage.php" method="post">
                            <input type="submit" name="registeremployee" value="register" class="btnRegister">
                          </form>
                        </div>
                        <?php

                      }else if ($selectiveuser["role"] != $role) {
                          ?>
                          <div class="unmatchedrole">
                            <h1>UNMATCHED ROLE</h1>
                            <?php
                            // link to upgrade employee if it needed
                            ?>
                          </div>
                          <?php
                      }else{
                        $user_name = $selectiveuser["first_name"].$id."@kurath";
                        $sql = "INSERT INTO user(user_id, user_type, user_name, password) VALUES('$id', '$role','$user_name', '$id')";

                        if(mysqli_query(makeConnection(), $sql)){
                          ?>
                          <div class="closedacc">
              <div>
                   <label for="name">User Name</label><br>
                   <input type="text" readonly name="name" value="<?php echo $user_name ?>">
                </div>
                 <div>
                   <label for="acno"> default password</label><br>
                   <input type="text" readonly name="acno" value="<?php echo $id; ?>">
                 </div>
                 <h2>registerd successfully</h2>
              </div>
                          <?php
                        
                          mysqli_close(makeConnection());
                        }
                      }

                }else{
                  echo "<h1 class="."noconnection </h1><br>";
                }
              }

            }
            if(isset($_POST["submit"])) {

                // function to validate phone number at server side 
                function validatePhone($phone){
                  if(empty($phone))
                  {
                      return false;
                  }
                  else if(!preg_match("/^[.0-9]*$/",$phone))
                  {
                    return false;
                  }
                  return true;
                }
                // function to validate email at server side 
                function validateEmail($email){
                  if (!empty($email)){
                   if(!filter_var($email, FILTER_VALIDATE_EMAIL))  
                   {
                     return false;
                   }
                  } 
                   return true;
                 }
              $phone = trim(htmlspecialchars($_POST["phone"]));
              $email = htmlspecialchars($_POST["email"]);

              if(validatePhone($phone)){

                $chechsql = "SELECT first_name FROM employee WHERE phone_no ="."'$phone'";
                $sqlquery = mysqli_query(makeConnection(), $chechsql);

                if(mysqli_num_rows($sqlquery) == 0) {
                  if(validateEmail($email)){

                  $checkemail = "SELECT email FROM employee WHERE email ="."'$email'";
                  $emailqurey =  mysqli_query(makeConnection(), $checkemail);
                  if(mysqli_num_rows($emailqurey) == 0) {
              $fname = trim(htmlspecialchars($_POST["fname"]));
              $lname = trim(htmlspecialchars($_POST["lname"]));
              $birthdate = trim(htmlspecialchars($_POST["birthdate"]));
              $nationality = trim(htmlspecialchars($_POST["nationality"]));
              $region = trim(htmlspecialchars($_POST["region"]));
              $zone = trim(htmlspecialchars($_POST["zone"]));
              $woreda = trim(htmlspecialchars($_POST["woreda"]));
              $kebele = trim(htmlspecialchars($_POST["kebele"]));
              $gender = trim(htmlspecialchars($_POST["gender"]));              
              $role = trim(htmlspecialchars($_POST["role"]));
              $salary = trim(htmlspecialchars($_POST["salary"]));
              
                // function to validate first name at server side 

                function validateFname($fname){
                  if(empty($fname))
                  {
                      return false;
                  }
                  else if(!preg_match("/^[a-zA-Z ]*$/",$fname))
                  {
                    return false;
                  }
                  return true;
                }

                // function to validate last name at server side 
                function validateLname($lname){
                  if(empty($lname))
                  {
                      return false;
                  }
                  else if(!preg_match("/^[a-zA-Z ]*$/",$lname))
                  {
                    return false;
                  }
                  return true;
                }

                // function to validate date of birth
                function validateDateOfBirth($birthdate){

                  if(empty($birthdate))
                  {
                      return false;
                  }

                  return true;
                }

                // function to validate nationality at server side 
                function validateNationality($nationality){
                  if(empty($nationality))
                  {
                      return false;
                  }
                  else if(!preg_match("/^[a-zA-Z ]*$/",$nationality))
                  {
                    return false;
                  }
                  return true;
                }

                // function to validate region at server side 
                function validateRegion($region){
                  if(empty($region))
                  {
                      return false;
                  }
                  else if(!preg_match("/^[a-zA-Z ]*$/",$region))
                  {
                    return false;
                  }
                  return true;
                }
                // function to validate woreda at server side 
                function validateWoreda($woreda){
                  if(empty($woreda))
                  {
                      return false;
                  }
                  return true;
                }

                // function to validate zone at server side 
                function validateZone($zone){
                  if(empty($zone))
                  {
                      return false;
                  }
                  return true;
                }
                // function to validate kebele at server side 
                function validateKebele($kebele){
                  if(empty($kebele))
                  {
                      return false;
                  }
                  return true;
                }
                
                // function to validate role at server side 
                function validateRole($role){
                  if(empty($role))
                  {
                      return false;
                  }
                  else if(!preg_match("/^[a-zA-Z ]*$/",$role))
                  {
                    return false;
                  }
                  return true;
                }
                 // function to validate salary at server side 
                 function validateSalary($salary){
                  if(empty($salary))
                  {
                      return false;
                  }
                  else if($salary < 1000){
                    return false;
                  }
                  else if(!preg_match("/^[.0-9]*$/",$salary))
                  {
                    return false;
                  }
                  return true;
                }

                function allInputValidation(){
                  $isvalid = true;

             
                  global $fname, $lname, $phone, $birthdate, $nationality, $region, $zone, $woreda, $kebele, $email, $role, $salary;

                  $isvalid = validateFname($fname) && $isvalid;
                  $isvalid = validateLname($lname) && $isvalid;
                  $isvalid = validateDateOfBirth($birthdate) && $isvalid;
                  $isvalid = validateNationality($nationality) && $isvalid;
                  $isvalid = validateRegion($region) && $isvalid;
                  $isvalid = validateRole($role) && $isvalid;
                  $isvalid = validateKebele($kebele) && $isvalid;
                  $isvalid = validateSalary($salary) && $isvalid;
                  $isvalid = validateWoreda($woreda) && $isvalid;
                  $isvalid = ValidateZone($zone) && $isvalid;

                   return $isvalid;
                   }
       
                if (allInputValidation()){
                      
                      if(makeConnection()){
                        // generating date to store value for registered_date atribute
                       $mysqldate = date('Y-m-d');
                       global $fname, $lname, $phone, $birthdate, $nationality, $region, $zone, $woreda, $kebele, $gender, $email, $role, $salary, $date;

                      // converting the data type in to float
                      $salary = floatval($salary);
                        if(empty($email)){
                          $sql = "INSERT INTO employee (first_name, last_name, phone_no, date_of_birth, 	nationality, region, zone, woreda, kebele, 	sex, registered_date, role, 	salary) VALUES('$fname', '$lname', '$phone', '$birthdate', '$nationality', '$region', '$zone', '$woreda', '$kebele', '$gender', '$mysqldate', '$role', '$salary')";
                        }
                        else{
                          $sql = "INSERT INTO employee (first_name, last_name, phone_no, date_of_birth, 	nationality, region, zone, woreda, kebele, 	sex, email, registered_date, role, 	salary) VALUES('$fname', '$lname', '$phone', '$birthdate', '$nationality', '$region', '$zone', '$woreda', '$kebele', '$gender', '$email', '$mysqldate', '$role', '$salary')";
                        }
                        
                        if(mysqli_query(makeConnection(), $sql)){
                          $sql = "SELECT employee_id FROM employee WHERE email ="."'$phone'";
                          $result = mysqli_query(makeConnection(), $sql);
                          $id = mysqli_fetch_assoc($result);
                          $employeeid = $id["employee_id"];
                          ?>
                          <div class="closedacc">
              <div>
                   <label for="name">Employee Name</label><br>
                   <input type="text" readonly name="name" value="<?php echo " ".$fname. " ".$lname ?>">
                </div>
                 <div>
                   <label for="acno"> Employee ID</label><br>
                   <input type="text" readonly name="acno" value="<?php echo " ".$employeeid; ?>">
                 </div>
                 <h2>registerd successfully</h2>
              </div>
                          <?php
                            echo "New record created successfully";
                            unset($_POST);
                            $fname = $lname = $phone = $birthdate = $nationality = $region = $zone = $woreda = $kebele = $gender = $email = $date = $role = $salary = NULL;
                            mysqli_close(makeConnection());

                            } else {
                              echo "Error: " . $sql . "<br>" . mysqli_error($connection);
                              mysqli_close(makeConnection());

                            } 
                              }else{
                           echo "connection can not be stablished!!";
                              }
                            }else{
                              echo "insert valid inputs";
                            }
                            
                            }else{
                              echo "EMAIL ADDRESS $email IS TAKEN INTER UNIQUE EMAIL!!";
                                 }
                          }else{
                            echo "invalid email address!!";
                               }
          } else{
            echo "$phone  IS TAKEN ENTER ONLY YOUR'S PHONE NUMBER!!";
               }
        
        }else{
            echo "invalid account number!!";
               }
        
        }
          if(isset($_POST["blockthis"])){
            $accountno = trim(htmlspecialchars($_POST["acno"]));

            function validateAccNumber($accountno){
              if(empty($accountno)){
                return false;
              }
              else if(!preg_match("/^[.0-9]*$/",$accountno)){
                return false;
              }
              return true;
            }

            if(validateAccNumber($accountno)){  
             
                    if (makeConnection()) {
                      $sql = "SELECT first_name, last_name, account_number FROM customer WHERE account_number ="."'$accountno'";
  
                      $query = mysqli_query(makeConnection(), $sql);

  
                      if (mysqli_num_rows($query)) {
                         $result = mysqli_fetch_assoc($query);
                       ?>
                       <div class="blockedacccontainer">
                        <form action="managerpage.php" name="blockcust" class="blockcust" method="post">
                          <div>
                          <label for="name">Customer Name</label><br>
                          <input type="text" name="name" readonly value="<?php echo $result["first_name"]." ".$result["last_name"]; ?>"> 
                          </div>
                          <div>
                          <label for="acno">Account Number</label><br>
                          <input type="text" name="acno" readonly value="<?php echo $result["account_number"]; ?>"> 
                          </div>
                          <div>
                            <input type="submit" value="BLOCK" name="BLOCK" class="btnRegister">
                          </div>
                        </form>
                       </div>
                       <?php
                      }
                      else{
                        mysqli_close(makeConnection());
                        ?>
                        <div class="depositform">
                          <h1>THEIR IS NO ACCOUNT</h1>
                          <p>enter correct account number</p>
                        </div>
                        <?php
                      }
                    }else{
                      ?>
                      <div class="depositform">
                        <h1>CONNECTION CAN NOT BE MADE</h1>
                      </div>
                      <?php
                  }
          }else{
            ?>
            <div class="depositform">
              <h1>INVALID ACCOUNT NUMBER</h1>
              <p>enter correct account number</p>
            </div>
            <?php
        }
        }

        if(isset($_POST["BLOCK"])){
          $accountNumber = $_POST["acno"];
          $status = false;
          $blocksql = "UPDATE customer SET status ="."'$status'"." WHERE account_number ="."'$accountNumber'";
          if(mysqli_query(makeConnection(), $blocksql)){
            ?>
            <div class="depositform">
              <h1>ACCOUNT NUMBER <?php echo" :". $accountNumber;  ?> BLOCKED SUCCESSFULLY</h1>
            </div>
            <?php
          }else{
            mysqli_close(makeConnection());
            ?>
            <div class="depositform">
              <h1>ACCOUNT CAN NOT BE BLOCKED</h1>
            </div>
            <?php
          }
        }
        if(isset($_POST["update"])){
          $accountno = trim(htmlspecialchars($_POST["account"]));
          function validateAccNumber($acn){
              if(empty($acn)){
                return false;
              }
              else if(!preg_match("/^[.0-9]*$/",$acn)){
                return false;
              }
              return true;
            }

            if(validateAccNumber($accountno)){  
             
                    if (makeConnection()) {

                      $sql = "SELECT first_name, last_name, account_number FROM customer WHERE account_number ="."'$accountno'";
  
                      $query = mysqli_query(makeConnection(), $sql);

  
                      if (mysqli_num_rows($query)) {
                         $result = mysqli_fetch_assoc($query);
                        $status = true;
                         $updatesql = "UPDATE customer SET status = true WHERE account_number ="."'$accountno'";
                         if(mysqli_query(makeConnection(), $updatesql)){
                          ?>
                          <div class="updateaccount">
                            <div>
                          <label for="name">Customer Name</label><br>
                          <input type="text" name="name" readonly value="<?php echo $result["first_name"]." ".$result["last_name"]; ?>"> 
                          </div>
                          <div>
                          <label for="acno">Account Number</label><br>
                          <input type="text" name="acno" readonly value="<?php echo $result["account_number"]; ?>"> 
                          </div>
                          <h2>UPDATED SUCCESSFULLY</h2>
                          </div>
                          <?php
                         }
                    }else{
                      mysqli_close(makeConnection());
                      ?>
                    <div class="noaccountnum">
                      <h2>THEIR IS NO ACCOUNT WITH ACCOUNT NUMBER :<?php echo " ".$accountno; ?></h2>
                    </div>
                    <?php
                     }

                  }else{
                  ?>
                    <div class="noaccountnum">
                      <h2>CONNECTION TO DATABASE CAN NOT BE MADE</h2>
                    </div>
                    <?php
                  }
                  }else{
                    ?>
                    <div class="noaccountnum">
                      <h2>ACCOUNT NUMBER :<?php echo " ".$accountno. " "; ?> IS INVALID</h2>
                    </div>
                    <?php
                  }
        }
        if(isset($_POST["closethis"])){
          $accountno = trim(htmlspecialchars($_POST["acno"]));
          function validateAccNumber($acn){
              if(empty($acn)){
                return false;
              }
              else if(!preg_match("/^[.0-9]*$/",$acn)){
                return false;
              }
              return true;
            }

            if(validateAccNumber($accountno)){  
             
                    if (makeConnection()) {

                      $sql = "SELECT first_name, last_name, account_number, balance FROM customer WHERE account_number ="."'$accountno'";
  
                      $query = mysqli_query(makeConnection(), $sql);

  
                      if (mysqli_num_rows($query)) {
                         $result = mysqli_fetch_assoc($query);
                         ?>
                         <div class="closeaccountinfoholder">
                          <form action="managerpage.php" name="closeaccform" class="closeaccform" method="post">
                            <div>
                              <label for="name">Customer Name</label><br>
                              <input type="text" readonly name="name" value="<?php echo " ". $result["first_name"]. " ". $result["last_name"] ?>">
                            </div>
                            <div>
                              <label for="acno"> Account Number</label><br>
                              <input type="text" readonly name="acno" value="<?php echo $result["account_number"] ?>">
                            </div>
                            <div>
                              <label for="amount">Balance</label><br>
                              <input type="number" readonly name="amount" value="<?php echo $result["balance"] ?>">
                            </div>
                            <div>
                              <input type="submit" name="close" value="CLOSE" class="btnRegister">
                            </div>
                          </form>
                         </div>
                         <?php
                      }else{
                      ?>
                    <div class="noaccountnum">
                      <h2>THEIR IS NO ACCOUNT WITH ACCOUNT NUMBER :<?php echo " ".$accountno; ?></h2>
                    </div>
                    <?php
                     }
                    }else{
                  ?>
                    <div class="noaccountnum">
                      <h2>CONNECTION TO DATABASE CAN NOT BE MADE</h2>
                    </div>
                    <?php
                  }
                  }else{
                     ?>
                    <div class="noaccountnum">
                      <h2>ACCOUNT NUMBER :<?php echo " ".$accountno. " "; ?> IS INVALID</h2>
                    </div>
                    <?php
                  }
        }
        if(isset($_POST["close"])){
          $trantype = "withdraw";
          $amount = $_POST["amount"];
          $accountNumber = $_POST["acno"];
          if($amount > 0){
          if( registerWithdraw($amount, $accountNumber, $trantype)){
            $withdrawsql = "UPDATE customer set balance = 0 WHERE account_number ="."'$accountNumber'";
            $closeaccsql = "UPDATE customer set closed = true WHERE account_number ="."'$accountNumber'";
            if(mysqli_query(makeConnection(), $closeaccsql) && mysqli_query(makeConnection(), $withdrawsql)){
              mysqli_close(makeConnection());
              ?>
              <div class="closedacc">
              <div>
                   <label for="name">Customer Name</label><br>
                   <input type="text" readonly name="name" value="<?php echo " ".$_POST["name"] ?>">
                </div>
                 <div>
                   <label for="acno"> Account Number</label><br>
                   <input type="text" readonly name="acno" value="<?php echo " ".$accountNumber; ?>">
                 </div>
                 <h2>CLOSED SUCCESSFULLY</h2>
              </div>
              <?php
            }else{
              ?>
              <div class="noaccountnum">
                <h2> ACCOUNT CAN NOT BE CLOSED
                  </h2>
              </div>
              <?php
            }

          }else{
            ?>
            <div class="noaccountnum">
              <h2> withdrawal can not be commited
                </h2>
            </div>
            <?php
          }
         
        }
      else{
        $withdrawsql = "UPDATE customer set balance = 0 WHERE account_number ="."'$accountNumber'";
        $closeaccsql = "UPDATE customer set closed = true WHERE account_number ="."'$accountNumber'";
        if(mysqli_query(makeConnection(), $closeaccsql) && mysqli_query(makeConnection(), $withdrawsql)){
          mysqli_close(makeConnection());
          ?>
          <div class="closedacc">
          <div>
               <label for="name">Customer Name</label><br>
               <input type="text" readonly name="name" value="<?php echo " ".$_POST["name"] ?>">
            </div>
             <div>
               <label for="acno"> Account Number</label><br>
               <input type="text" readonly name="acno" value="<?php echo " ".$accountNumber; ?>">
             </div>
             <h2>CLOSED SUCCESSFULLY</h2>
          </div>
          <?php
        }else{
          ?>
          <div class="noaccountnum">
            <h2> ACCOUNT CAN NOT BE CLOSED
              </h2>
          </div>
          <?php
        }
      }
    }

    if(isset($_POST["transacno"])){
      $accountNumber = trim(htmlspecialchars($_POST["accno"]));
      function valTransAcc($acno){
        if(empty($acno)){
          return false;
        }
      return true;
    }
         
          if(valTransAcc($accountNumber)){
              $cusinfosql = "SELECT first_name, last_name, account_number, closed FROM customer WHERE account_number ="."'$accountNumber'";
              $fetchinfo = mysqli_query(makeConnection(), $cusinfosql);

              if(mysqli_num_rows($fetchinfo) > 0){
                $result = mysqli_fetch_assoc($fetchinfo);
                if($result["closed"] == false){
                ?>
                <div class="trandiv">
                  <form action="managerpage.php" name="transaccform" method="post" class="transform">
                    <div class="nameacc">
                      <label for="name">name</label><br>
                      <input type="text" name="name" readonly value="<?php echo $result["first_name"]. " ". $result["last_name"]?>">
                    </div>
                    <div class="nameacc">
                      <label for="account">account</label><br>
                      <input type="text" readonly name="account" value="<?php echo $result["account_number"]?>">
                    </div>
                    <div class="transalter">
                      <div><h1>select transaction type</h1></div>
                      <div class="options">
                        <input type="submit" name="deposittran" value="deposit">
                        <input type="submit" name="transfer" value="transfer">
                        <input type="submit" name="withdraw" value="withdraw">
                        <input type="submit" name="logfile" value="log file">
                      </div>
                    </div>
                  </form>
                </div>
                <?php
              }
              else{
                ?>
                <div class="noaccno">
                  <h2>ACCOUNT NUMBER : <?php echo " ". $accountNumber." "; ?>IS NOT ACCESSIBLE</h2><br>
                </div>
                <?php
              }
              }else{
                ?>
                <div class="noaccno">
                  <h2>THEIR IS NO ACCOUNT WITH NUMBER : <?php echo " ". $accountNumber; ?></h2><br>
                  <h3>ensert a valid account number</h3>
                </div>
                <?php
              }
          }else{
            //
          }
        }

        require("../functionspage/transactions.php");
        require("../footer/usernamepassw.php");

        ?>
      </div>
    </div>

  <script src="../javascript/registerEmpValidation.js"></script>
  <script src="../javascript/creatusernalidation.js"></script>
 <script src="../footer/footer.js"></script>
</body>
</html>