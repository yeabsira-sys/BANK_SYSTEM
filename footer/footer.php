<?php
  //session_start();
   // we dont really to start session it will get it from the includer page if it is set on their
   include("../login/loginshowform.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="footercontainer">
    <div class="userinfo">
    <div class="logout">
      <form action="" method="post">
      <input type="submit" name="logout" value="Logout" class="logoutbtn">
    </form>
          <?php
    # fetch user name from session 
      if(isset($_POST["logout"])){
        header("location: ../login/loginform.php");
      }
    
      ?>
    </div>
    <div class="username">
    <?php
    echo $_SESSION["username"];
     $form = $_SESSION["rank"]."page.php"
     ?>
    </div>
    <dix class="user">
      <form action=""method="post">
        <input type="submit" class="userbtn" name="updpass" value="update password">
      </form>
      <!--if this btn is clicked the user goes to user setting for where he can update his password-->
      <?php
      
      ?>
    </dix>
    </div>
  <Div class="datetime">
    <div class="jsdate">
      <span id="day">day</span>,
      <span id="date">00</span>
      <span id="month">month</span>,
      <span id="year">0000</span>
    </div>
    <div class="jstime">
      <span id="hour">00</span>:
      <span id="minute">00</span>:
      <span id="seconds">00</span>:
      <span id="ampm">00</span>
    </div>
  </Div>
</div>
</body>
</html>