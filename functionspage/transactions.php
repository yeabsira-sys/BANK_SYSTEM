<?php
          if(isset($_POST["deposittran"])){
            $accountno = $_POST["account"];
            $getressql = "SELECT deposit_id, account_number, amount, date FROM deposit WHERE account_number ="."'$accountno'";
            $fetchinfo = mysqli_query(makeConnection(), $getressql);

            if(mysqli_num_rows($fetchinfo) > 0){
              
              ?>
              <table class="depotable">
                <tr class="tblrow">
                  <th class="tblhead">Deposit_id</th>
                  <th class="tblhead">Account</th>
                  <th class="tblhead">Amount</th>
                  <th class="tblhead">Date</th>
                </tr>
              <?php
                     
                while($rows = mysqli_fetch_assoc($fetchinfo)){
                  { 
                    ?><tr class="tblrow">
                      <td class="rowdata"><?php echo $rows["deposit_id"]; ?></td>
                      <td class="rowdata"><?php echo $rows["account_number"]; ?></td>
                      <td class="rowdata"><?php echo $rows["amount"]; ?></td>
                      <td class="rowdata"><?php echo $rows["date"]; ?></td>
                    </tr>
                    <?php
                   
                    }
                    mysqli_close(makeConnection());
                   
                } echo "</table>";

            }else{
              mysqli_close(makeConnection());
              ?>
              <div class="nodeposit">
                <h2>their is no deposites</h2>
              </div>
              <?php
            }
          }else{
            mysqli_close(makeConnection());
            
          }
          if(isset($_POST["transfer"])){
            $accountno = $_POST["account"];
            $getressql = "SELECT transfer_id, sender_account, receiver_account, amount, date FROM transfer WHERE sender_account ="."'$accountno'";
            $fetchinfo = mysqli_query(makeConnection(), $getressql);

            if(mysqli_num_rows($fetchinfo) > 0){
             
              ?>
              <table class="trantable">
                <tr class="tbltranrow">
                  <th class="tblhead">Transfer_id</th>
                  <th class="tblhead">sender_Acc</th>
                  <th class="tblhead">receiver_Acc</th>
                  <th class="tblhead">Amount</th>
                  <th class="tblhead">Date</th>
                </tr>
              <?php
                     
                while( $rows = mysqli_fetch_assoc($fetchinfo)){
                  { 
                    ?><tr class="tbltranrow">
                      <td class="rowdata"><?php echo $rows["transfer_id"]; ?></td>
                      <td class="rowdata"><?php echo $rows["sender_account"]; ?></td>
                      <td class="rowdata"><?php echo $rows["receiver_account"]; ?></td>
                      <td class="rowdata"><?php echo $rows["amount"]; ?></td>
                      <td class="rowdata"><?php echo date('Y-m-d H:i:s',intval($rows["date"])); ?></td>
                    </tr>
                    <?php
                   
                    }
                    mysqli_close(makeConnection());
                   
                } echo "</table>";
   
            }else{
              mysqli_close(makeConnection());
              ?>
              <div class="nodeposit">
                <h2>their is no deposites</h2>
              </div>
              <?php
            }
          }else{
            mysqli_close(makeConnection());
            
          }
          if(isset($_POST["withdraw"])){
            $accountno = $_POST["account"];
            $getressql = "SELECT withdraw_id, account_number, amount, date FROM withdraw WHERE account_number ="."'$accountno'";
            $fetchinfo = mysqli_query(makeConnection(), $getressql);

            if(mysqli_num_rows($fetchinfo) > 0){
              
              ?>
              <table class="withtable">
                <tr class="tblwithrow">
                  <th class="tblhead">Deposit_id</th>
                  <th class="tblhead">Account</th>
                  <th class="tblhead">Amount</th>
                  <th class="tblhead">Date</th>
                </tr>
              <?php
                     
                while($rows = mysqli_fetch_assoc($fetchinfo)){
                  { 
                    ?><tr class="tblwithrow">
                      <td class="rowdata"><?php echo $rows["withdraw_id"]; ?></td>
                      <td class="rowdata"><?php echo $rows["account_number"]; ?></td>
                      <td class="rowdata"><?php echo $rows["amount"]; ?></td>
                      <td class="rowdata"><?php echo date('Y-m-d H:i:s',intval($rows["date"])); ?></td>
                    </tr>
                    <?php
                   
                    }
                    mysqli_close(makeConnection());
                   
                } echo "</table>";
  
            }else{
              mysqli_close(makeConnection());
              ?>
              <div class="nodeposit">
                <h2>their is no deposites</h2>
              </div>
              <?php
            }
          }else{
            mysqli_close(makeConnection());
            
          } 

          if(isset($_POST["logfile"])){
            $accountno = $_POST["account"];
            $getressql = "SELECT log_id, account_no , transaction_type, transaction_id , prev_amount, new_amount, date FROM log_file WHERE account_no ="."'$accountno'";
            $fetchinfo = mysqli_query(makeConnection(), $getressql);

            if(mysqli_num_rows($fetchinfo) > 0){
              
              ?>
              <table class="logfiletable">
                <tr class="tbllogrow">
                  <th class="tblhead">log_id</th>
                  <th class="tblhead">account_no</th>
                  <th class="tblhead">transaction_type</th>
                  <th class="tblhead">transaction_id</th>
                  <th class="tblhead">prev_amount</th>
                  <th class="tblhead">new_amount</th>
                  <th class="tblhead">date</th>
                </tr>
              <?php
                     
                while($rows = mysqli_fetch_assoc($fetchinfo)){
                  { 
                    ?><tr class="tbllogrow">
                      <td class="rowdata"><?php echo $rows["log_id"]; ?></td>
                      <td class="rowdata"><?php echo $rows["account_no"]; ?></td>
                      <td class="rowdata"><?php echo $rows["transaction_type"]; ?></td>
                      <td class="rowdata"><?php echo $rows["transaction_id"]; ?></td>
                      <td class="rowdata"><?php echo $rows["prev_amount"]; ?></td>
                      <td class="rowdata"><?php echo $rows["new_amount"]; ?></td>
                      <td class="rowdata"><?php echo date('Y-m-d H:i:s',intval($rows["date"])); ?></td>
                    </tr>
                    <?php
                   
                    }
                    mysqli_close(makeConnection());
                   
                } echo "</table>";
  
            }else{
              mysqli_close(makeConnection());
              ?>
              <div class="nodeposit">
                <h2>their is no log files</h2>
              </div>
              <?php
            }
          }else{
            mysqli_close(makeConnection());
            
          } 
?>