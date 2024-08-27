<?php

function  removeEmployee(){
  ?>
  <div class="removeemployee userregpage">
    <form action="managerpage.php" name="rememployee" method="post" class="rememployee-form">
      <div class="empnameholder">
        <label for="name">Employee Name</label><br>
      <input type="text" require placeholder="name" name="empname"><br>
      <span class="name-error"></span>
      </div>
      <div class="empid">
      <label for="name">Employee ID</label><br>
      <input type="number" require placeholder="ID" name="empid"><br>
      <span class="empid-error"></span>
      </div>
      <div class="button">
        <input type="submit" value="delete" name="delete" class="btnRegister">
      </div>
    </form>
  </div>
  <?php
}
?>