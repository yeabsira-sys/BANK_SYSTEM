<?php 
      // function to register transfer transaction

      function registerTransfer($senderaccount, $prevsenderbalance, $receiveraccount, $prevreceiverbalance ,$transferamount){
        $trantype = "transfer";

        $date = date('Y/m/d h:i:s');
        $unixtime = date('Ymdhis', strtotime($date));

        $transfersql = "INSERT INTO transfer(sender_account, 	receiver_account, date, amount) VALUES('$senderaccount','$receiveraccount','$unixtime', '$transferamount')";
        if(mysqli_query(makeConnection(), $transfersql)){

          // write sender's transaction to the log file
          $sendercurrentbalance = $prevsenderbalance - $transferamount;
          $_SESSION["cusAccount"] = "sender_account";
          if(registerLogFile($prevsenderbalance, $sendercurrentbalance , $senderaccount, $unixtime, $trantype)){
           // write receiver's's transaction to the log file
          $receivercurrentbalance = $prevreceiverbalance + $transferamount;
          $_SESSION["cusAccount"] = "receiver_account";
          if(registerLogFile($prevreceiverbalance, $receivercurrentbalance , $receiveraccount, $unixtime, $trantype)){
           return true;
          }else{
            $delettransfersql = "DELETE FROM transfer WHERE account_number ="."'$senderaccount'"."AND date ="."'$unixtime'";
            $deletlogfilesql = "DELETE FROM logfile WHERE account_number ="."'$senderaccount'"."AND date ="."'$unixtime'";
            if(mysqli_query(makeConnection(), $delettransfersql) && mysqli_query(makeConnection(), $deletlogfilesql)){
            }else{
              ?>
        <div class="invalidamount">
          <h2>CAUTION</h2>
          <h3>TRANSACTION FAILOR</h3>
        </div>
        <?php
            }                return false;

          }
          }else{
            $delettransfersql = "DELETE FROM transfer WHERE account_number ="."'$senderaccount'"."AND date ="."'$unixtime'";
            if(mysqli_query(makeConnection(), $delettransfersql)){

            }else{
              ?>
        <div class="invalidamount">
          <h2>CAUTION</h2>
          <h3>TRANSACTION FAILOR</h3>
        </div>
        <?php
            }
            return false;
          }
        }
      }
?>