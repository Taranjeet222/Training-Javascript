<?php
session_start();
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
    <title>Document</title>
</head>
<body onload="forgot.addForm()"></body>
<div class="card text-center">
  <div class="card-body">
    <h2 class="card-title">Login</h2>
    <form>
      <div class="form-group">
        <label for="Username">Username</label>
        <input type="text" class="form-control" id="Username" placeholder="Enter your username">
      </div>
      <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" class="form-control" id="Age" placeholder="Enter your password">
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