<?php

session_start();
if(empty($_SESSION)){
  header("location: ../login/loginform.php" );
}
require("../header/header.php");
require("../footer/footer.php");
require("../functionspage/deposit.php");
require("../functionspage/logfile.php");
require("../functionspage/transfer.php");
require("../functionspage/withdraw.php");
/**
 * function to create connection
 */
function makeConnection(){
  $serverName = "localhost";
            $dbUser = "root";
            $dbPassword = "rootmein@";           
            $dbName = "Bank_Management_System";
              
              $connection =  mysqli_connect( $serverName, $dbUser, $dbPassword, $dbName );// connect to the data base
              if(!$connection){
                ?>
                <div class="connectionerror">
                  <h2>CONNECTION FAILED</h2>
                </div>
                <?php
                return $connection;
                  die(mysqli_connect_error());
              }
                return $connection;
              }
              /**
               * validater for amount of money intered
               */
    function validateAmount($amount){
      if(empty($amount)){
        return false;
      }
      if($amount < 0){
        return false;
      }
      return true;
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KURATH BANK</title>
  <link rel="stylesheet" href="../css/managerpage.css">
  <link rel="stylesheet" href="../css/teller.css">
  <link rel="stylesheet" href="../footer/footer.css">
  <link rel="stylesheet" href="../header/header.css">
</head>

<body>
<div class="mainmanagercontainer">
      <div class="rightsideman">
          <div class="tellertasks">
            <form action="tellerpage.php" class="listener" name="t_task" method="post">  
            <input type="submit" value="Register Customer" name= "registercustomer">          
            <input type="submit" value="Make Deposite" name= "makedeposite">
            <input type="submit" value="Make Withdraw" name= "makewithdraw">
            <input type="submit" value="Make Transfer" name= "maketransfer">
            <input type="submit" value="Check Balance" name= "checkbalance">
            <input type="submit" value="Customer Transaction" name= "customertransaction">
            </form>  
          </div>
      </div>
      <div class="leftsideman">
      <?php 
              if(isset($_POST["registercustomer"])) {
                registerCustomer();
              }
              if(isset($_POST["makedeposite"])){
                makeDeposit();
              }
              if(isset($_POST["makewithdraw"])){
                makeWithdraw();
              }
              if(isset($_POST["maketransfer"])){
                makeTransfer();
              }
              if(isset($_POST["checkbalance"])){
                veiwBalance();
              }
              if(isset($_POST["customertransaction"])){
                seeTransactions();
              }
         function registerCustomer(){
          $_SESSION["form_customer"] = true;
          ?>
          <div id="customer-registration">
          <form action="tellerpage.php#customer-registration" class="customerregistrationform" name="cusregister" method="post">
            <div class="infocontainer">
              <div class="nameholder">
                  <div class=" values">
                    <label for="firstname">First Name</label><br>
                    <input class="valu" type="text" required name="firstname" class="name"><br>
                    <span class="fname_error"></span>
                  </div>
                  <div class="values">
                  <label for="lname">Last Name</label><br>
                    <input class="valu" type="text" required name="lname" class="l_name"><br>
                    <span class="lname_error"></span>
                  </div>
              </div>
              <div class="phonedate">
                  <div class=" values">
                  <label for="phone">Phone Number</label><br>
                      <input class="valu" type="number"  name="phone" class="phone_no"><br>
                      <span class="pho_error"></span>
                  </div>
                  <div class=" values">
                  <label for="birthdate">Date of Birth</label><br>
                      <input class="valu" type="date"  name="birthdate" class="birthdate"><br>
                      <span class="birtherror"></span>
                  </div>
              </div>
              <div class="nationregion">
                  <div class=" values">
                      <label for="nation">Nationality</label><br>
                      <input class="valu" type="text"  name="nationality" class="nationality"><br>
                      <span class="nation_error"></span>
                      </div>
                  <div class=" values">
                      <label for="region">Region</label><br>
                      <input class="valu" type="text"  name="region" class="region"><br>
                      <span class="region_error"></span>
                    </div>
                    
              </div>
              <div class="zoneworeda">
              <div class=" values">
                      <label for="zone">Zone</label><br>
                      <input class="valu" type="text"  name="zone" class="zone"><br>
                      <span class="zone_error error"></span>
                    </div>
                    <div class=" values">
                  <label for="woreda">Woreda</label><br>
                      <input class="valu" type="text"  name="woreda" class="woreda"><br>
                      <span class="wereda_error"></span>
                </div>
              </div>
              <div class="kebelegend">
                <div class=" values">
                  <label for="kebele">Kebele</label><br>
                        <input class="valu"v type="text"  name="kebele" class="kebele"><br>
                      <span class="kebele_error"></span>
                </div>
                <div class=" values">
                  <label for="sex">Gender</label><br>
                     <select name="gender" id="genderid">
                      <option class="valu" value="female">Female</option>
                      <option class="valu" value="male">Male</option>
                     </select>
                </div>
              </div>
              <div class="emailoccupation">
                <div class=" values">
                <label for="email">Email</label><br>
                      <input class="valu" type="email"  name="email" class="email"><br>
                      <span class="email_error"></span>
                </div>
                <div class=" values">
                <label for="occupation">Occupation</label><br>
                      <input class="valu" type="text"  name="occupation" class="ocupation"><br>
                      <span class="occupation_error"></span>
                </div>
                
              </div>
              <div>
                 <input type="submit" name="creatcustomer" value="Regiter" class="btnRegister">
            <input type="clear" name="clear" value="Clear" class="btnclear">
              </div>
            </div>
           
          </form>
          
 
          <?php    
        }
        // function to register deposit
        
        function makeDeposit(){
          ?>
          <div class="depositform">
            <form action="tellerpage.php" name="depositeform" class="deposit" method="post">
              <div>
                <label for="acno">Acount number</label><br>
                <input type="number" name="acno" placeholder="account.no" required><br>
                <small class="acno-error"></small><br>
                <input type="submit" name="enteracno" class="btnRegister" value="Enter">
              </div>
            </form>
          </div>
          <?php
        }
        // function to reegister withdraw
        function makeWithdraw(){
          ?>
          <div class="withdrawform">
            <form action="tellerpage.php" name="withdrawform" class="withdraw" method="post">
              <div>
                <label for="acno">Acount number</label><br>
                <input type="number" name="acno" placeholder="account.no" required><br>
                <small class="acno-error"></small><br>
                <input type="submit" name="withdaccn" class="btnRegister" value="Enter">
              </div>
            </form>
          </div>
          <?php
        }

        // function to display transfer form 

        function makeTransfer(){
          ?>
          <div class="transferform">
            <form action="tellerpage.php" name="transferform" method="post">
              <label for="senderacno">Sender Account.no</label><br>
              <input type="number" class="senderacno" name="senderacno" required placeholder="sender account"><br>
              <label for="receivereracno">Resiever Account.no</label><br>
              <input type="number" name="receiveracno" class="receivereracno" placeholder="receiver account" required><br>
              <input type="submit" name="transfermoney" class="btnRegister" value="transfer">
            </form>
          </div>
          <?php
        }

        // function to display customer transaction
        function seeTransactions(){
          ?>
          <div class="transaccountdiv">
            <form action="tellerpage.php" name="transaccount" class="transaccount" method="post">
              <div>
                <label for="accno">Account Number</label><br>
                <input type="number" name="accno" required placeholder="account number"><br>
              </div>
              <input type="submit" name="transacno" class="btnRegister">
            </form>
          </div>
          <?php
        }
        if(isset($_SESSION["form_customer"]) && $_SESSION["form_customer"] === true){

        if(isset($_POST["creatcustomer"])){
          unset($_SESSION["form_customer"]);

          $gender = trim(htmlspecialchars($_POST["gender"]));
          $firstname = trim(htmlspecialchars($_POST["firstname"]));
          $lastname = trim(htmlspecialchars($_POST["lname"]));
          $phone = trim(htmlspecialchars($_POST["phone"]));
          $birthdate = trim(htmlspecialchars($_POST["birthdate"]));
          $nationality = trim(htmlspecialchars($_POST["nationality"]));
          $region = trim(htmlspecialchars($_POST["region"]));
          $woreda = trim(htmlspecialchars($_POST["woreda"]));
          $zone = trim(htmlspecialchars($_POST["zone"]));
          $kebele = trim(htmlspecialchars($_POST["kebele"]));
          $email = htmlspecialchars($_POST["email"]);
          $occupation = trim(htmlspecialchars($_POST["occupation"]));

          function validateFname($firstname){
                if(!isset($firstname))
                {
                  return false;
                }
                else if(!preg_match("/^[a-zA-Z ]*$/",$firstname))
                {
                  return false;
                }
                return true;
              }
              // function to validate last name at server side 
              function validateLname($lastname){

                if(!isset($lastname))
                {
                    return false;
                }
                else if(!preg_match("/^[a-zA-Z ]*$/",$lastname))
                {
                  return false;
                }
                return true;
              }

              // function to validate phone number at server side 
              function validatePhone($phone){
                if(!isset($phone))
                {
                  echo $phone;
                    return false;
                }
                else if(!preg_match("/^[.0-9]*$/",$phone))
                {
                  return false;
                }
                return true;
              }
              // function to validate date of birth
              function validateDateOfBirth($birthdate){

                if(!isset($birthdate))
                {
                    return false;
                }

                return true;
              }

              // function to validate nationality at server side 
              function validateNationality($nationality){
                if(!isset($nationality))
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

                if(!isset($region))
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

                if(!isset($woreda))
                {
                    return false;
                }
                return true;
              }

              // function to validate zone at server side 
              function validateZone($zone){

                if(!isset($zone))
                {
                    return false;
                }
                return true;
              }
              // function to validate kebele at server side 
              function validateKebele($kebele){

                if(!isset($kebele))
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

            // funcrion to validate and sanitize occupation 

            function validateOccupation($occupation){

              if(empty($occupation)){
                return false;
              }
              else if (!preg_match("/^[a-zA-Z ]*$/", $occupation)) {
                return false;
              }
              return true;
            }

            // function to call all other function and use their returns as basis to insert data to the database

            function validateAll(){
              $isvalide = true;
              global $firstname, $lastname, $phone, $birthdate, $nationality, $region, $zone, $woreda, $kebele,  $email,  $occupation;
             // print_r($_POST);
              $isvalide= validateFname($firstname) && $isvalide;
              $isvalide= validateLname($lastname) && $isvalide;
              $isvalide= validatePhone($phone) && $isvalide;
              $isvalide= validateDateOfBirth($birthdate) && $isvalide;
              $isvalide= validateNationality($nationality) && $isvalide;
              $isvalide= validateRegion($region) && $isvalide;
              $isvalide= validateWoreda($woreda) && $isvalide;
              $isvalide= validateKebele($kebele) && $isvalide;
              $isvalide= validateEmail($email) && $isvalide;
              $isvalide= validateZone($zone) && $isvalide;
              $isvalide= validateOccupation($occupation) && $isvalide;

              return $isvalide;
            }
           
            if(validateAll()){


              // connect to the database
                      if(makeConnection()){
                        $genaccno = null;
                        $notunique = false;
                  while (!$notunique) {
                   $genaccno = mt_rand(1000000, 9999999);
                    
                  $sql = "SELECT account_number FROM customer WHERE account_number ="."'$genaccno'";
                    $result = mysqli_query(makeConnection(), $sql);
                    if(mysqli_num_rows($result) == 0){
                      $notunique = true;
                    }
                      }
                        

                        // generating date to store value for registered_date atribute
                       intval($opendate = date('Y-m-d')) ;
                       global $firstname, $lastname, $phone, $birthdate, $nationality, $region, $zone, $woreda, $kebele, $gender, $email, $date, $occupation, $genAccNo;
                      
                        $status = false;
                       $mysqlDate = date('Y-m-d', strtotime($birthdate));
                        $phone = intval($phone);
                        $genAccNo = intval($genAccNo);
                        if (empty($email)) {
                            $sql =  $sql = "INSERT INTO customer (account_number, first_name, last_name, phone_no, sex, status, nationality, region, zone, woreda, kebele, open_date, job_type, date_of_birth) VALUES( '$genaccno', '$firstname', '$lastname', '$phone', '$gender', '$status', '$nationality', '$region', '$zone', '$woreda', '$kebele', '$opendate', '$occupation',  '$mysqlDate')";             
                          }
                    else{
                      $sql = "INSERT INTO customer (account_number, first_name, last_name, phone_no, sex, status, nationality, region, zone, woreda, kebele, open_date, job_type, email, date_of_birth) VALUES( '$genaccno', '$firstname', '$lastname', '$phone', '$gender', '$status', '$nationality', '$region', '$zone', '$woreda', '$kebele', '$opendate', '$occupation', '$email', '$mysqlDate')";
                    }
                        
                        if(mysqli_query(makeConnection(), $sql)){
                          // write the account holder name and the account number here
                           ?>
                         <div class="newaccount">
                        <div>
                        <label for="name">Name</label><br>
                      <input type="text" name="accholdername" readonly value="<?php echo $firstname." ".$lastname;?>"><br>
                        </div>
                    <div>
                    <label for="name">Account Number</label>
                      <input type="text" name="accnumber" readonly value="<?php echo $genaccno;?>"><br>
                    </div>
                     </div>
                           <?php
                            unset($_POST);
                            $firstname = $lastname = $phone = $birthdate = $nationality = $region = $zone = $woreda = $kebele = $gender = $email = $date = $occupaion = $genAccNo = NULL;
                            mysqli_close(makeConnection());

                            } else {
                              echo "Error: " . $sql . "<br>" . mysqli_error(makeConnection());
                              mysqli_close(makeConnection());

                            } 
                              }
                              else "can not connect";
                            }
                            else{
                           echo "connection can not be stablished!!";
                              }
              }
            }
        if(isset($_POST["enteracno"])){
          $acnumber = trim(htmlspecialchars($_POST["acno"]));

          // function to validate account number 

          function validateAccNumber($acnumber){
            if(empty($acnumber)){
              return false;
            }
            else if(!preg_match("/^[.0-9]*$/",$acnumber)){
              return false;
            }
            return true;
          }

          if(validateAccNumber($acnumber)){
           
                  if (makeConnection()) {
                    $sql = "SELECT first_name, last_name, account_number, closed FROM customer WHERE account_number ="."'$acnumber'";

                    $query = mysqli_query(makeConnection(), $sql);
                    $result = mysqli_fetch_assoc($query);

                    if (empty($result)) {
                      ?>
                      <div class="depositform">
                        <h1>THEIR IS NO ACCOUNT</h1>
                        <p>enter correct account number</p>
                      </div>
                      <?php
                    }
                    else if($result["closed"] == true){
                      ?>
                      <div class="depositform">
                        <h1>ACCOUNT IS NOT ACCESSIBLE</h1>
                      </div>
                      <?php
                    }
                    else{
                      $_SESSION["form_displayed"] = true;
                    ?>
                    <div class="depositform">
                      <form action="tellerpage.php" method="post" name="accholderinfo" class="deposit">
                        <div>
                        <label for="name">Name</label>
                      <input type="text" name="accholdername" readonly value="<?php echo $result["first_name"]." ".$result["last_name"] ;?>"><br>
                        </div>
                    <div>
                    <label for="name">Account Number</label>
                      <input type="text" name="accnumber" readonly value="<?php echo $result["account_number"];?>"><br>
                    </div>
                     <div>
                      <label for="amount">Enter Amount</label>
                      <input type="number" name="amount" placeholder="amount" required><br>
                     </div>
                     <div>
                      <input type="submit" name="makedeposit" value="deposit" class="btnRegister">
                     </div>
                      </form>
                    </div>
                    <?php

                    }
                  }
          }else{
            ?>
            <div class="depositform">
              <h1><?php  echo "INVALID ACCOUNT NUMBER";
              ?></h1>
            </div>
            <?php
           
          }
        }
        if(isset($_SESSION["form_displayed"]) && $_SESSION["form_displayed"] === true){
        if (isset($_POST["makedeposit"])) {
          $amount = trim(htmlspecialchars($_POST["amount"]));
          $accountNumber = $_POST["accnumber"];
          $name = $_POST["accholdername"];
          // function to validate for valid amount 
          unset($_SESSION["form_displayed"]);
          if(validateAmount($amount)){
            $trantype = "deposit";
           
            if(registerDeposit($amount, $accountNumber, $trantype)){
                unset($_POST["makedeposit"]);
              if(makeConnection()){
                $isnotactive = false;
                $BalanceQueiry = "SELECT balance from customer WHERE account_number ="."'$accountNumber'";
                $getbalance = mysqli_query(makeConnection(), $BalanceQueiry);
                $getprevbalance = mysqli_fetch_assoc($getbalance);
                  if($BalanceQueiry){
                     if($getprevbalance["balance"] === NULL){
                      $isnotactive = true;
                      $prevbalance = 0.0;
                }else{
                  $prevbalance = floatval($getprevbalance["balance"]);
                  $isnotactive = false;
                  echo"  this is prev balance : ". $prevbalance;
                }
                
              }
              $newbalance = floatval($prevbalance) + floatval($amount);
             echo"this is new balance : ". $newbalance;
              $updatebalancesql = "UPDATE customer SET balance ="."'$newbalance'"."  WHERE account_number ="."'$accountNumber'";
              if (mysqli_query(makeConnection(), $updatebalancesql)) {
                if($isnotactive){
                  $activatorsql = "UPDATE customer SET status = "."true"." WHERE account_number ="."'$accountNumber'";
                  if(mysqli_query(makeConnection(), $activatorsql)){
                  }
                }
                ?>
                <div class="depositinfo">
                  <div><h3>--------KURATH BANK--------</h3></div>
                  <div class="depositer"><p>Name<?php echo"  "."$name"; ?></p></div>
                  <div class="depositeraccount"><p>Account number<?php echo"  "."$accountNumber"; ?></p></div>
                  <div class="depositamount"><p>Deposit<?php echo"  "."$amount"; ?></p></div>
                  <div class="depositamount"><p>Date<?php echo "  ".
                  date('Y-m-d h:i:s'); ?></p></div>
                  <div><h3>---------------------------</h3></div>

                </div>
                <?php
              }

            }else{
              ?>
              <div class="depositform">
                <h1>UNSUCCESSFUL DEPOSIT!!</h1>
                <h3>try again</h3>
              </div>
              <?php
            }
            
          }else{
          ?>
          <div class="depositform">
            <h1>INVALID AMOUNT</h1>
            <h3>enter valid amount !!</h3>
          </div>
          <?php
        }

        }
      }}


        if(isset($_POST["withdaccn"])){
          $acnumber = trim(htmlspecialchars($_POST["acno"]));

          // function to validate account number 

          function validateAccNumber($acnumber){
            if(empty($acnumber)){
              return false;
            }
            else if(!preg_match("/^[.0-9]*$/",$acnumber)){
              return false;
            }
            return true;
          }

          if(validateAccNumber($acnumber)){
            global $acnumber;

                  if (makeConnection()) {
                    $sql = "SELECT first_name, last_name, account_number, status, closed FROM customer WHERE account_number ="."'$acnumber'";

                    $query = mysqli_query(makeConnection(), $sql);
                    $result = mysqli_fetch_assoc($query);

                    if (empty($result)) {
                      ?>
                      <div class="depositform">
                        <h1>THEIR IS NO ACCOUNT</h1></br>
                        <p>enter correct account number</p>
                      </div>
                      <?php
                    }
                    else if($result["closed"] == true){
                      ?>
                      <div class="depositform">
                        <h1>THIS ACCOUNT IS NOT ACCESSIBLE</h1></br>
                      </div>
                      <?php
                    }
                    else if($result["status"] == false){
                      ?>
                      <div class="depositform">
                        <h1>ACCOUNT IS NOT ACTIVE</h1></br>
                        <p>activate account first</p>
                      </div>
                      <?php
                    }
                    else{
                      $_SESSION["form_displayed"] = true;
                    ?>
                    <div class="withdrawform">
                      <form action="tellerpage.php" method="post" name="accholderinfo" class="withdraw">
                        <div>
                        <label for="name">Name</label>
                      <input type="text" name="accholdername" readonly value="<?php echo $result["first_name"]." ".$result["last_name"] ;?>"><br>
                        </div>
                    <div>
                    <label for="name">Account Number</label>
                      <input type="text" name="accnumber" readonly value="<?php echo $result["account_number"];?>"><br>
                    </div>
                     <div>
                      <label for="amount">Enter Amount</label>
                      <input type="number" name="amount" placeholder="amount" required><br>
                     </div>
                     <div>
                      <input type="submit" name="regwithdraw" value="withdraw" class="btnRegister">
                     </div>
                      </form>
                    </div>
                    <?php

                    }
                  }
          }else{
           // mysqli_close($connection);
            ?>
            <div class="depositform">
              <h1><?php  echo "INVALID ACCOUNT NUMBER";
              ?></h1>
            </div>
            <?php
           
          }
        }

         if(isset($_SESSION["form_displayed"]) && $_SESSION["form_displayed"] === true){
          if (isset($_POST["regwithdraw"])) {
            $amount = trim(htmlspecialchars($_POST["amount"]));
            $accountNumber = trim(htmlspecialchars($_POST["accnumber"]));
            $name = htmlspecialchars($_POST["accholdername"]);
                   unset($_SESSION["form_displayed"]);
                   unset($_POST["makewithdraw"]);
            if(makeConnection()){
              $BalanceQueiry = "SELECT balance from customer WHERE account_number ="."'$accountNumber'";
              $getbalance = mysqli_query(makeConnection(), $BalanceQueiry);
              $getcrbalance = mysqli_fetch_assoc($getbalance);
              $crbalance = $getcrbalance["balance"];

             // function to validate for valid amount 
             function validAmount($amount, $crbalance){
              if($crbalance === null || $amount === null){
                return false;
              }
               if($crbalance === 0){
              return false;
             }
              if($crbalance < $amount){
              return false;
             }
              if(floatval($amount) == 0.0){
              return false;
             }
             if($amount < 0){
              return false;
             }
              
                  return true;
                
      }
    }
            if(validAmount($amount, $crbalance)){
              $trantype = "withdraw";
              if(registerWithdraw($amount, $accountNumber, $trantype)){
                
                     $BalanceQueiry = "SELECT balance from customer WHERE account_number ="."'$accountNumber'";
                     $getbalance = mysqli_query(makeConnection(), $BalanceQueiry);
                     $getprevbalance = mysqli_fetch_assoc($getbalance);
                     $prevbalance = floatval($getprevbalance["balance"]);
                   $newbalance = floatval($prevbalance) - floatval($amount);
                   $updatebalancesql = "UPDATE customer SET balance ="."'$newbalance'"."  WHERE account_number ="."'$accountNumber'";
                   if (mysqli_query(makeConnection(), $updatebalancesql)) {
                     ?>
                     <div class="withdrawinfo">
                       <div><h3>--------KURATH BANK--------</h3></div>
                       <div class="withdrawal"><p>Name<?php echo"  "."$name"; ?></p></div>
                       <div class="withdrawalaccount"><p>Account number<?php echo"  "."$accountNumber"; ?></p></div>
                       <div class="withdrawamount"><p>withdraw<?php echo"  "."$amount"; ?></p></div>
                       <div class="withdrawdate"><p>Date<?php echo "  ".
                       date('Y-m-d h:i:s'); ?></p></div>
                       <div><h3>---------------------------</h3></div>
     
                     </div>
                     <?php
                   }
     
                 else{
                   ?>
                   <div class="depositform">
                     <h1>UNSUCCESSFUL DEPOSIT!!</h1>
                     <h3>try again</h3>
                   </div>
                   <?php
                 }
                }
      }else{
        ?>
        <div class="depositform">
        <h1>insuficient amount</h1></br>
        <h3>try again !!</h3>
      </div>
        <?php
      }
    }}



      if(isset($_POST["transfermoney"])){
        $_SESSION["form_displayed"] = true;
        $_SESSION["transfercomited"] = false;
        $senderacno = trim(htmlspecialchars($_POST["senderacno"]));
        $receiveracno = trim(htmlspecialchars($_POST["receiveracno"]));
          // function to validte sender acno and receiver acno
        if($senderacno !== $receiveracno){
          function validateSenderRecieverAcno($acno){
            if(empty($acno)){
              return false;
            }
            if((string)$acno !== strval(intval($acno))){
              return false;
            }
            return true;
          }
          if(validateSenderRecieverAcno($senderacno)){
            if(validateSenderRecieverAcno($receiveracno)){
              
           if(makeConnection()){

            $sendersql = "SELECT first_name, last_name, account_number, status, closed  FROM customer WHERE account_number ="."'$senderacno'";
            $receiversql = "SELECT first_name, last_name, account_number, closed FROM customer WHERE account_number ="."'$receiveracno'";
            $getsenderinfo = mysqli_query(makeConnection(), $sendersql);
            $getreceiverinfo = mysqli_query(makeConnection(), $receiversql);

            if(mysqli_num_rows($getsenderinfo) > 0 ){
              $senderresult = mysqli_fetch_assoc($getsenderinfo);
              if($senderresult["closed"] == false){
              if($senderresult["status"] == true){
              if(mysqli_num_rows($getreceiverinfo) > 0 ){
                $receiverresult = mysqli_fetch_assoc($getreceiverinfo);
               if($receiverresult["closed"] == false){
               
                ?>

              <form action="tellerpage.php" class="senderinfo" name="senderinfo" method="post">
                <div class="senderreceiver">
                  <div class="senderinfoholder">
                  <div>
                        <label for="sendername">Name</label>
                      <input type="text" name="sendername" readonly value="<?php echo $senderresult["first_name"]." ".$senderresult["last_name"] ;?>"><br>
                        </div>
                    <div>
                    <label for="senderaccnumber">Account Number</label>
                      <input type="text" name="senderaccnumber" readonly value="<?php echo $senderresult["account_number"];?>"><br>
                    </div>
                    <div>
                          <label for="amount">Enter Amount</label>
                      <input type="number" name="amount" placeholder="amount" required><br>
                    </div>
                     <div>
                      <input type="submit" name="regiestertransfer" value="transfer" class="btnRegister">
                     </div>
                    </div>
                      <div class="receiverinfoholder">
                      <div>
                      <label for="receivername">Name</label>
                      <input type="text" name="receivername" readonly value="<?php echo $receiverresult["first_name"]." ".$receiverresult["last_name"] ;?>"><br>
                        </div>
                    <div>
                    <label for="name">Account Number</label>
                      <input type="text" name="receiveracnumber" readonly value="<?php echo $receiverresult["account_number"];?>"><br>
                    </div>
                  </div>
                </div>
                  </form>
                <?php
              }else{
                ?>
                <div class="nosenderacno">
                <h2> ACCOUNT NUMBER :<?php echo  " ".$receiveracno. " IS NOT ACCESSIBLE"; ?></h2><br>
                </div>
                <?php
            }
            
          }else{
                ?>
                <div class="nosenderacno">
                  <h2>their is no customer with account number : <?php echo  " ".$receiveracno; ?></h2>
                  <h3>enter valid account number</h3>
                </div>
                <?php
            }
            } else{
                ?>
                <div class="nosenderacno">
                  <h2> ACCOUNT NUMBER :<?php echo  " ".$senderacno. " IS NOT ACTIVE"; ?></h2><br>
                  <h3>activate account first</h3>
                </div>
                <?php
              }


            }else{
              ?>
              <div class="nosenderacno">
                <h2> ACCOUNT NUMBER :<?php echo  " ".$senderacno. " IS NOT ACCESSIBLE"; ?></h2><br>
              </div>
              <?php
              }
            }else{
              ?>
              <div class="nosenderacno">
                <h2>their is no customer with account number : <?php echo  " ".$senderacno; ?></h2>
                <h3>enter valid account number</h3>
              </div>
              <?php
            }
          }
            }
            else{
              ?>
              <div class="invalidacno">
                <h2>invalid receiver account number</h2><br>
                <h3>enter valid account number</h3>
              </div>
              <?php
            }
          }else{
            ?>
              <div class="invalidacno">
                <h2>invalid sender account number</h2><br>
                <h3>enter valid account number</h3>
              </div>
              <?php
          }
      }else{
        ?>
        <div class="invalidacno">
          <h2>can not transfer to the same account</h2>
          <h3>enter different account to transfer</h3>
        </div>
        <?php
      }
    }
 // }
    if( isset($_SESSION["form_displayed"]) && $_SESSION["form_displayed"] === true && isset($_SESSION["transfercomited"]) && $_SESSION["transfercomited"] === false){
      if(isset($_POST["regiestertransfer"])){
       unset($_SESSION["form_displayed"]);
        $sendername = $_POST["sendername"];
        $senderaccount = $_POST["senderaccnumber"];
        $receivername = $_POST["receivername"];
        $receiveraccount = $_POST["receiveracnumber"];
        $transferamount = trim(htmlspecialchars($_POST["amount"]));

        if(validateAmount($transferamount)){
          $crsenderbalancesql = "SELECT balance FROM customer WHERE account_number ="."'$senderaccount'";
          $getsendercurrentBalance = mysqli_query(makeConnection(), $crsenderbalancesql);
          $crreceiverbalancesql = "SELECT balance FROM customer WHERE account_number ="."'$receiveraccount'";
          $getreseivercurrentBalance = mysqli_query(makeConnection(), $crreceiverbalancesql);
          $fetchreceiverbalance = mysqli_fetch_assoc($getreseivercurrentBalance);
          $prevreceiverbalance = floatval($fetchreceiverbalance["balance"]);
          if($getsendercurrentBalance){
           
            $fetchbalance = mysqli_fetch_assoc($getsendercurrentBalance);
            $prevsenderbalance = floatval($fetchbalance["balance"]);
             if($prevsenderbalance >= floatval($transferamount)){
              $newsenderbalance = $prevsenderbalance - $transferamount;
              $newreceiverbalance = $prevreceiverbalance + $transferamount;

              // call register transfer function
              if(registerTransfer($senderaccount, $prevsenderbalance, $receiveraccount, $prevreceiverbalance, $transferamount)){
                $senderbalanceupdatesql = "UPDATE customer SET balance ="."'$newsenderbalance'"."  WHERE account_number ="."'$senderaccount'";

                $receiverbalanceupdatesql = "UPDATE customer SET balance ="."'$newreceiverbalance'"."  WHERE account_number ="."'$receiveraccount'";
                if(mysqli_query(makeConnection(), $senderbalanceupdatesql)){

                  if(mysqli_query(makeConnection(), $receiverbalanceupdatesql)){
                    $_SESSION["transfercomited"] = true;
                    ?>
                    <div class="transfercomited withdrawinfo">
                    <div><h3>--------KURATH BANK--------</h3></div>
                       <div class="transfer"><p>Name<?php echo"  "."$sendername"; ?></p></div>
                       <div class="senderaccount"><p>Account number<?php echo"  "."$senderaccount"; ?></p></div>
                       <div class="transferamount"><p>transfer<?php echo"  "."$transferamount"; ?></p></div>
                       <div class="transfer"><p>Name<?php echo"  "."$receivername"; ?></p></div>
                       <div class="senderaccount"><p>Account number<?php echo"  "."$receiveraccount"; ?></p></div>
                       <div class="withdrawdate"><p>Date<?php echo "  ".
                       date('Y-m-d h:i:s'); ?></p></div>
                       <div><h3>---------------------------</h3></div>
                    </div>
                    <?php
                  }else{

                  }
                }else{

                }
              }else{
                ?>
              <div class="invalidamount">
                <h2>TRANSFER CAN NOT BE COMMITED</h2>
              </div>
              <?php
              }
             }else{
              ?>
              <div class="invalidamount">
                <h2>INSUFFICIENT AMOUNT </h2>
              </div>
              <?php
            }
          }else{
            ?>
            <div class="invalidamount">
              <h2>some error occured</h2>
            </div>
            <?php
          }
        }else{
          ?>
        <div class="invalidamount">
          <h2>can not transfer to the same account</h2>
          <h3>enter different account to transfer</h3>
        </div>
        <?php
        }

      }
    }

      function veiwBalance(){
        ?>
        <div class="showbal">
          <form action="tellerpage.php" class="veiwbalance" name="veiwbalance" method="post">
            <label for="veiwbalacno">Enter Account Number</label><br>
            <input type="number" required name="veiwbalacno" class="veiwbalacno"><br>
            <input type="submit" name="veiWbalance" class="btnRegister">
          </form>
        </div>
        <?php
      }
      if(isset($_POST["veiWbalance"])){
        $accountNumber = trim(htmlspecialchars($_POST["veiwbalacno"]));
        if($accountNumber !== null){
          $getbalsql = "SELECT balance, first_name, last_name, closed FROM customer WHERE account_number ="."'$accountNumber'";
          $getbalance = mysqli_query(makeConnection(), $getbalsql);
          if(mysqli_num_rows($getbalance) > 0){
            $fethbalance = mysqli_fetch_assoc($getbalance);
            if($fethbalance["closed"] == false){
            $balance = floatval($fethbalance["balance"]);
            ?>
            <div class="veiwbalance">
              <label for="name">name</label>
              <input type="text" readonly name="name" value="<?php echo $fethbalance["first_name"]." ".$fethbalance["last_name"]; ?>"><br>
              <label for="accountnum">account number</label>
              <input type="text" readonly name="accountnum" value="<?php echo $accountNumber ?>"><br>
              <label for="amount">amount</label>
              <input type="text" readonly name="amount" value="<?php echo $fethbalance["balance"]. " : Birr"; ?>"><br>
            </div>
            <?php
          }
          else{
            ?>
            <div class="invalidacno,">
              <h2>ACCOUNT NUMBER <?php echo " : ".$accountNumber; ?> IS NOT ACCESSIBLE</h2>
            </div>
            <?php
          }
          }else{
            ?>
            <div class="invalidacno,">
              <h2>NO ACCOUNT WITH ACCOUNT NUMBER <?php echo " : ".$accountNumber; ?></h2>
            </div>
            <?php
          }
        }else{
          ?>
          <div class="invalidacno,">
            <H2>INVALID ACCOUNT NUMBER</H2>
          </div>
          <?php
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
                    <form action="tellerpage.php" name="transaccform" method="post" class="transform">
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
          require("../footer/usernamepassw.php")
        ?>
        
        </div>
    </div>
</div>

<script src="../javascript/customerRegistrationValidation.js"></script>
<script src="../footer/footer.js"></script>
 </body>
  </html>