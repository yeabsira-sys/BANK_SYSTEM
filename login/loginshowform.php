
<?php
function loginshow(){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/loginform.css">
</head>
<body>
  <div class="maincontainer">
        <div class="formcontainer">
     <!-- <img src="../images/loginpagelogo.png" alt="" class="formcontainer">-->
       <form action="" method="post" class="loginform" name="loginf">
        <label for="name" class="labelname">Name</label>
        <input type="text" name="name" placeholder="User Name" class="inputvalue1" maxlength="40"></br>
        <label for="password" class="labelpass">password</label>
        <input type="password" name="password" placeholder="Password" class="inputvalue2" maxlength="20"></br>
        <input type="submit" name="login" class="submitbtn" value="login">
        <a href="../users/updatepassword.php"><input type="button" name="forgetpassword" class="forgetpasswordbtn" value="Forget Password"></a>
      </form>
      </div>
      <div class="lowerimgdiv"></div>
    </div>
      <?php
        if(isset($_POST["login"])){
           $serverName = "localhost";
           $dbUser = "root";
           $dbPassword = "rootmein@";           
           $dbName = "Bank_Management_System";
           
           $connection = mysqli_connect( $serverName, $dbUser, $dbPassword, $dbName);// connect to the data base
           if($connection){
            $user_name = $_POST["name"];
            $password =  $_POST["password"];
             $sql = "SELECT * FROM user WHERE user_name ="."'$user_name'"."AND password ="."'$password'";
           $tolog = mysqli_query($connection, $sql);
           
              if(mysqli_num_rows($tolog) > 0)
              {
                $row = mysqli_fetch_assoc($tolog);
                $userid = $row["user_id"];
                $sqlempinfo = "SELECT * FROM employee WHERE employee_id ="."'$userid'";
                $result = mysqli_query($connection, $sqlempinfo);
                $sesionvalhold = mysqli_fetch_assoc($result);
                $_SESSION["rank"] = $row["user_type"];
                $_SESSION["username"] = $sesionvalhold["first_name"]. " ".$sesionvalhold["last_name"];
                $_SESSION["password"] = $row["password"]; 
              }                
           if(!empty($_SESSION["rank"]))
           {
            header("location:../users/".$_SESSION["rank"]."page.php");// redirects to the user page
           }
           }
           else{
            die("could not connect:".mysqli_connect_error($connection));
           echo "<h1> didn't connect</h1>";
        }
      }
      ?>
</body>
</html>
<?php
}
  ?>