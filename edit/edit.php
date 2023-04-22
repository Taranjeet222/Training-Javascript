<?php 
    session_start();
    include '../includes/database.php';
    include '../includes/user.php';
    $host = "localhost";
    $username = "root";
    $password = "Taranjeet@23";
    $dbname = "USER";
    $tablename = "userdata";
    $db = new Database($host,$username,$password,$dbname);
    $USR = new User();
    $connec = $db->getConnection();
    if($_SERVER['REQUEST_METHOD']==='POST')
    {
        $USR->updateUserInfo($connec,$tablename,$_SESSION['username'],'fullname',$_POST['name']);
        $USR->updateUserInfo($connec,$tablename,$_SESSION['username'],'phone_number',$_POST['Phone']);
        $USR->updateUserInfo($connec,$tablename,$_SESSION['username'],'age',$_POST['Age']);
        $USR->updateUserInfo($connec,$tablename,$_SESSION['username'],'email',$_POST['email']);
        $USR->updateUserInfo($connec,$tablename,$_SESSION['username'],'user_password',$_POST['Password']);
        $USR->updateUserInfo($connec,$tablename,$_SESSION['username'],'username',$_POST['Username']);
        $_SESSION['username'] = $_POST['Username'];
    }
    $result = $USR->getUserInfo($connec,$_SESSION['username'],$_SESSION['tablename']);
    if(isset($_POST['delete']))
    {
        $USR->deleteUser($connec,$_SESSION['username'],$tablename);
        header('location: ../index.php');
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
    <script>
        function confirmSubmit()
        {
        var agree=confirm("Are you sure you wish to continue?");
        if (agree)
        {
            return true ;
        }
        else
        return false ;
        }
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          var registerForm = new validateForm('EditForm');
          registerForm.addInputListeners();
          validateForm.showChangesalert('EditForm','submit-btn');
      });
    </script>
	<title>Page Title</title>
</head>
<body>
    <div class="row container">
        <div class="card text-center bg-dark bg-gradient col-xxl-6">
            <div class="card-header">
                <h3>Edit Information</h3>
            </div>
            <div class="card-body">
                <form id = "EditForm"  method="post" action="edit.php">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" value="<?php echo $result['fullname']; ?>"required>
                        <div id="nameError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" name="Username" class="form-control" id="Username" placeholder="Enter your username" value="<?php echo $result['username']; ?>" required>
                        <div id="usernameError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone number</label>
                        <input type="text" name="Phone" class="form-control" id="Phone" placeholder="Enter your phone number" value="<?php echo $result['phone_number']; ?>" required>
                        <div id="phoneError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="Age">Age</label>
                        <input type="number" name="Age" class="form-control" id="Age" placeholder="Enter your age" value="<?php echo $result['age']; ?>" required>
                        <div id="ageError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo $result['email']; ?>" required>
                        <div id="emailError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" name="Password" class="form-control" id="password" placeholder="Enter your password" value="<?php echo $result['user_password']; ?>"required>
                        <div id="passwordError" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm password</label>
                        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Confirm password" value="<?php echo $result['user_password']; ?>" required>
                        <div id="confirmPasswordError" class="error"></div>
                    </div>
                    <button type="submit" name="submit-btn" id="submit-btn" class="btn btn-primary" style="margin-top:10px !important;">Save Changes</button>
                    <a href="../index.php" class="btn btn-primary " style="margin-top:10px !important;">Exit</a>
                </form>
            </div>
        </div>
        <div class="card text-center bg-dark bg-gradient col-xxl-6">
            <div class="card-header">
                <h3>Delete Your Account</h3>
            </div>
            <div class= "card-body ">
                <form id="deleteForm" method="post" action="edit.php">
                    <p class="card-text" style="text-align:left;">
                    Once your account is deleted, all of your personal information and data associated with the account 
                    will be permanently removed from our system.
                    </p>
                    <p class="card-text" style="text-align:left;">
                    By deleting your account, you agree to release us from any liability or responsibility related to 
                    your use of the website or the consequences of deleting your account.
                    </p>
                    <input type='submit' value='Delete Account' id='delete' class="btn btn-primary" name='delete' onclick='return confirmSubmit()'>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
