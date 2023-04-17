<?php 
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ini_set('error_log', '/var/www/php.dv/logs/error.log');
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
    <title>Document</title>
</head>
<body>
<div class="card text-center">
  <div class="card-body">
    <h2 class="card-title">Register</h2>
    <form action="./registration.php" method="post">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">
      </div>
      <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" name="Username" class="form-control" id="Username" placeholder="Enter your username">
      </div>
      <div class="form-group">
        <label for="Phone">Phone number</label>
        <input type="text" name="Phone" class="form-control" id="Phone" placeholder="Enter your phone number">
      </div>
      <div class="form-group">
        <label for="Age">Age</label>
        <input type="number" name="Age" class="form-control" id="Age" placeholder="Enter your age">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" name="Password" class="form-control" id="password" placeholder="Enter your password">
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm password</label>
        <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="Confirm password">
      </div>
      <input type="submit" name="submit-btn" id="submit" class="btn btn-primary" value="submit" >
    </form>
  </div>
</div>
</body>
</html> 