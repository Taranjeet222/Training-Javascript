<?php 
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <script src="../bootstrap.min.js"></script>
    <script src="../assets/js/validation.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          var registerForm = new validateForm('EditForm');
          registerForm.addInputListeners();
      });
    </script>
	<title>Page Title</title>
</head>
<body>
    <div class="card text-center">
        <div class="card-header">
            <h3>Edit Information</h3>
        </div>
        <div class="card-body">
            <form id = "EditForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" value=""required>
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
            </form>
            <a href="" class="btn btn-primary ">Save Changes</a>
            <a href="../index.php" class="btn btn-primary ">Exit</a>
        </div>
    </div>

</body>
</html>
