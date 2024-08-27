
<?php
/**
             * function to register or write deposit transaction to the database
             */
            function registerDeposit($amount, $accountNumber, $trantype){
              global $amount, $accountNumber;
    
                if(makeConnection()){
                  $BalanceQueiry = "SELECT balance from customer WHERE account_number ="."'$accountNumber'";
                  $getbalance = mysqli_query(makeConnection(), $BalanceQueiry);
                  $getprevbalance = mysqli_fetch_assoc($getbalance);
                    if($getbalance){
                       if($getprevbalance["balance"] === null){
                    $prevbalance = 0.0;
                  }else{
                    $prevbalance = floatval($getprevbalance["balance"]);
                  }
                  
                    }else{
                      mysqli_close(makeConnection());
                      ?>
                <div class="depositform">
                  <h1>THEIR IS UN EXPECTED ERROR</h1>
                  <h3>try again !!</h3>
                </div>
                <?php
                return false;
                    }
                  $prevbalance = floatval($prevbalance);
                  $currentBalance = floatval($prevbalance) + floatval($amount);
                  $date = date('Y/m/d h:i:s');
                  $unixtime = date('Ymdhis', strtotime($date));
                  $depositSQL = "INSERT INTO deposit(amount, date, account_number)  VALUES('$amount', ' $unixtime', '$accountNumber')";
                  if(mysqli_query(makeConnection(), $depositSQL)){       
                    if(registerLogFile($prevbalance, $currentBalance , $accountNumber, $unixtime,  $trantype)){
                      mysqli_close(makeConnection());
                      unset($_POST["makedeposit"]);
                      return true;
                    }else{
                      echo "   deposit not registerd";
                      unset($_POST["makedeposit"]);
                      $delsql = "DELETE FROM deposit WHERE date ="."'$unixtime'"."AND account_number =" ."'$accountNumber'";
                      if(!mysqli_query(makeConnection(), $delsql)){
                        mysqli_close(makeConnection());
                        ?>
                        <div class="depositform">
                          <h1>CAUTION!!</h1>
                          <h3>samething went wrong!!</h3>
                        </div>
                        <?php
                        return false;
                      }else{
                        mysqli_close(makeConnection());
                        return false;
                      }
                    }
                    
                  }
                  else{
                    mysqli_close(makeConnection());
                    return false ;
                  }
                }else{
                  return false;
                }
            }
            ?>