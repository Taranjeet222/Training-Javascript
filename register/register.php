<?php 
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('error_log', '/var/www/php.dv/logs/error.log');
    include '../includes/validation.php';
    include '../includes/database.php';
    include '../includes/user.php';
    $valid = new Validator();
    $nameError = '';
    $usernameError = '';
    $phoneError = '';
    $emailError = '';
    $passwordError = '';
    $confirmPasswordError = '';
    if (isset($_POST['submit-btn'])) {
        $nameError = $valid->validateName($_POST['name']);
        $usernameError = $valid->validateUsername($_POST['Username']);
        $phoneError = $valid->validatePhoneNumber($_POST['Phone']);
        $emailError = $valid->validateEmail($_POST['email']);
        $passwordError = $valid->validatePassword($_POST['Password']);
        $confirmPasswordError = $valid->validateConfirmPassword($_POST['Password'],$_POST['confirmPassword']);
        if ($nameError && $usernameError && $phoneError && $emailError && $passwordError && $confirmPasswordError) {
            //create user code,data insertion.// session variables set.
            $host = "localhost";
            $username = "root";
            $password = "Taranjeet@23";
            $dbname = "USER";
            $tablename = "userdata";
            $db = new Database($host,$username,$password,$dbname);
            $USR = new User();
            $USR->registerUser($db->getConnection(),$tablename,$_POST['name'],$_POST['Username'],$_POST['Phone'],$_POST['Age'],$_POST['email'],$_POST['Password']);
            if(isset($_SESSION['username'])){
              if (isset($_POST['rememberMe'])) {
                echo "setting";
                $cookie_value = $_SESSION['username'] . ":" . $_SESSION['password'] . ":" . $_SESSION['tablename'];
                setcookie('value',$cookie_value,time()+60*60*24*10,'/', '', false, false);
              }
              header('Location: ../index.php');
            }
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
    <link rel="stylesheet" href="../assets/css/register.css">
    <script src="../assets/js/register.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="../assets/js/validation.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          var registerForm = new validateForm('registerForm');
          registerForm.addInputListeners();
      });
    </script>
    <title>Document</title>
</head>
<body class="bg-dark">
<div class="card text-center bg-dark bg-gradient">
  <div class="card-body">
    <h2 class="card-title">Register</h2>
    <form action="register.php" method="post" id="registerForm">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
        <div id="nameError" class="error"></div>
      </div>
      <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" name="Username" class="form-control" id="Username" placeholder="Enter your username" required>
        <div id="usernameError" class="error"></div>
      </div>
      <div class="form-group">
        <label for="Phone">Phone number</label>
        <input type="text" name="Phone" class="form-control" id="Phone" placeholder="Enter your phone number" required>
        <div id="phoneError" class="error"></div>
      </div>
      <div class="form-group">
        <label for="Age">Age</label>
        <input type="number" name="Age" class="form-control" id="Age" placeholder="Enter your age" required>
        <div id="ageError" class="error"></div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
        <div id="emailError" class="error"></div>
      </div>
      <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" name="Password" class="form-control" id="password" placeholder="Enter your password" required>
        <div id="passwordError" class="error"></div>
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm password</label>
        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm password" required>
        <div id="confirmPasswordError" class="error"></div>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
        <label class="form-check-label" for="rememberMe">Remember me</label>
      </div>
      <input type="submit" name="submit-btn" id="submit" class="btn btn-primary" value="submit" >
    </form>
  </div>
</div>
</body>
</html> 