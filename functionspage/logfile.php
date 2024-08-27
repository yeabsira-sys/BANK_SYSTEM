<?php 
        /**
         * function to registerd or write log file values to the database
         */

         function registerLogFile($prevbalance, $currentBalance, $accountNumber,  $unixtime, $trantype){
          $tablename = "";
          $transactionid = "";
          $accountno = "";
          if($trantype === "deposit"){
            $tablename = "deposit";
            $transactionid = "deposit_id";
            $accountno = "account_number";
            }
          else if($trantype === "withdraw"){
            $tablename = "withdraw";
            $transactionid = "withdraw_id";
            $accountno = "account_number";
          }
          else if($trantype === "transfer"){
            $tablename = "transfer";
            $transactionid = "transfer_id";
            if($_SESSION["cusAccount"] === "sender_account"){
              $accountno = "sender_account";
            }
            else if($_SESSION["cusAccount"] === "receiver_account"){
              $accountno = "receiver_account";
            }
          }
          $gettraid = "SELECT $transactionid FROM $tablename WHERE $accountno ="."'$accountNumber'"."AND date ="."'$unixtime'";
          $gettransactionid = mysqli_query(makeConnection(), $gettraid); 
          if($gettransactionid){
            $transaction = mysqli_fetch_assoc($gettransactionid);
            $transaction_id = intval($transaction[$transactionid]);
            $logsql = "INSERT INTO log_file(account_no, transaction_type, transaction_id, prev_amount, new_amount, date) VALUES('$accountNumber', '$trantype', '$transaction_id', '$prevbalance', '$currentBalance', '$unixtime' )";

            if(mysqli_query(makeConnection(), $logsql)){
              mysqli_close(makeConnection());
              return true;
            }else{
              mysqli_close(makeConnection());
              return false;
            }
          }else{
            mysqli_close(makeConnection());
            return false;
          }
        }
?>