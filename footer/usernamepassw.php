<?php
if(isset($_POST["updpass"])){
  ?>
    <div class="sysuserpriv">
      <form action="" method="post" class="updatepassword">
        <div>update password and user name</div>
        <div>
          <label for="username">user name</label><br>
          <input type="text" required placeholder="user name" name="username">
        </div>
        <div>
          <label for="password">password</label><br>
          <input type="password" required name="password" placeholder="password">
        </div>
        <div><input type="submit" name="submitforcre" value="submit"></div>
      </form>
    </div>
  <?php
}
if(isset($_POST["submitforcre"])){
  $username = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);
  function validateInput($val){
    if(empty($val))
    {
        return false;
    }
    return true;
  }
  if(validateInput($username) && validateInput($password)){
    $namesql = "SELECT user_name, user_id FROM user WHERE user_name ="."'$username'"."AND password ="."'$password'";
    $return = mysqli_query(makeConnection(), $namesql);
    if(mysqli_num_rows($return) > 0){
      $row = mysqli_fetch_assoc($return);
      $_SESSION["userid"] = $row["user_id"];
      ?>
      <form action="" method="post" class="updatepassword">
        <div><h1 color="red">new password and user name</h1></div>
        <div>
          <label for="newusername">user name</label><br>
          <input type="text" required placeholder="new user name" name="newusername">
        </div>
        <div>
          <label for="newpassword">password</label><br>
          <input type="password" required name="newpassword" placeholder="new password">
        </div>
        <div><input type="submit" name="submitnewpassun" value="change"></div>
      </form>
      <?php
    
    }else{
      echo "incorrect user name";
    }
  }

}
if(isset($_POST["submitnewpassun"])){
  $newusername = htmlspecialchars($_POST["newusername"]);
  $newpassword = htmlspecialchars($_POST["newpassword"]);

  function validateInput($val, $length){
    if(empty($val))
    {
        return false;
    }
    if(strlen($val) < $length){
      return false;
    }
    return true;
  }
  if(validateInput($newusername, 8) && validateInput($newpassword, 8)){
    $namesql = "SELECT user_name, password FROM user WHERE user_name ="."'$newusername'"."AND password ="."'$newpassword'";
    $return = mysqli_query(makeConnection(), $namesql);
    $row = mysqli_fetch_assoc($return);
    if(mysqli_num_rows($return) == 0){
      $id = $_SESSION["userid"];
      unset($_SESSION["userid"]);
      $updatnameesql = "UPDATE user SET user_name ="."'$newusername'"."WHERE user_id ="."'$id'";
      $updatepasssql = "UPDATE user SET password ="."'$newpassword'"."WHERE user_id ="."'$id'";
      if(mysqli_query(makeConnection(), $updatnameesql) && mysqli_query(makeConnection(), $updatepasssql)){
        echo "new user name and password updated successfully";
      }
      
    }else{
      echo "previous user name or passpord is not alowed enter a new one";
    }
  }else{
    echo "user name and password must be atleast 8 character";
  }
}
?>