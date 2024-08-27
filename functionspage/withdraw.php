<?php 
     function registerWithdraw($amount, $accountNumber, $trantype){
      
      if(makeConnection()){
        
        $BalanceQueiry = "SELECT balance from customer WHERE account_number ="."'$accountNumber'";
        $getbalance = mysqli_query(makeConnection(), $BalanceQueiry);
        $getprevbalance = mysqli_fetch_assoc($getbalance);
          if($BalanceQueiry){       
          $prevbalance = floatval($getprevbalance["balance"]);
        } 
          }else{
            ?>
      <div class="depositform">
        <h1>THEIR IS UN EXPECTED ERROR</h1>
        <h3>try again !!</h3>
      </div>
      <?php
      return false;
          }
        $prevbalance = floatval($prevbalance);
        $currentBalance = floatval($prevbalance) - floatval($amount);
        $date = date('Y/m/d h:i:s');
        $unixtime = date('Ymdhis', strtotime($date));
        $withdrawSQL = "INSERT INTO withdraw(account_number, date,amount)  VALUES('$accountNumber', ' $unixtime', '$amount')";
        if(mysqli_query(makeConnection(), $withdrawSQL)){                
          if(registerLogFile($prevbalance, $currentBalance , $accountNumber, $unixtime, $trantype)){
            mysqli_close(makeConnection());
            unset($_POST["makewithdraw"]);
            return true;
          }else{
            unset($_POST["makewithdraw"]);
            $delsql = "DELETE FROM withdraw WHERE date ="."'$unixtime'"."AND account_number =" ."'$accountNumber'";
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
      }
?>