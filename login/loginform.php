<?php
  session_start();
  if(!empty($_SESSION)){
    session_destroy();
  }
require("../login/loginshowform.php");
  loginshow();
  ?>