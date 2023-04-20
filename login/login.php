<?php
session_start();
include '../includes/database.php';
include '../includes/user.php';
if(isset($_POST['Username']) && isset($_POST['Password']))
{
  $host = "localhost";
  $username = "root";
  $password = "Taranjeet@23";
  $dbname = "USER";
  $tablename = "userdata";
  $db = new Database($host,$username,$password,$dbname);
  $USR = new User();
  $connec = $db->getConnection();
  $USR->login($_POST['Username'],$_POST['Password'],$connec,$tablename);
  echo $_SESSION['username'];
  if(isset($_SESSION['username'])){
    echo "<script>Logged in successfully.</script>";
    header('Location: ../index.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../bootstrap.min.css">
      <script src="../bootstrap.min.js"></script>
      <link rel="stylesheet" href="../assets/css/login.css">
      <script src="../assets/js/login.js"></script>
      <script src="../assets/js/validation.js"></script>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            var registerForm = new validateForm('loginForm');
            registerForm.addInputListeners();
            forgotPassword.sendEmail();
        });
      </script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title>Document</title>
  </head>
  <body onload="forgot.addForm()" class="bg-dark">
    <div class="card text-center bg-light bg-gradient" id="FirstForm">
      <div class="card-body" >
        <h2 class="card-title">Login</h2>
        <form action="login.php" method="post" id="loginForm">
          <div class="form-group">
            <label for="Username">Username</label>
            <input type="text" name="Username" class="form-control" id="Username" placeholder="Enter your username">
            <div id="nameError" class="error"></div>
          </div>
          <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" name="Password" class="form-control" id="password" placeholder="Enter your password">
            <div id="nameError" class="error"></div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="card-footer">
        <span>Not a user? <a href="../register/register.php">Register</a></span>
        <br>
        <a href="#" id="forgot-password-link">Forgot Password?</a>
      </div>
    </div>
  </body>
</html>