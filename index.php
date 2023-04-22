<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('error_log', '/var/www/php.dv/logs/error.log');
error_log(print_r($_POST,1));
if(isset($_COOKIE['value']))
{
    list($uname,$pass,$table) = explode(':',$_COOKIE['value']);
    $_SESSION['username'] = $uname;
    $_SESSION['password'] = $pass;
    $_SESSION['tablename'] = $table;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap.min.css">
    <script src="/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./assets/css/home.css">
    <title>Document</title>
</head>
<body>
    <div class="header row">
        <div class="container">
            <h1>Header Logo</h1>
        </div>
    </div>
    <div class="card text-center bg-dark bg-gradient">
        <div class="card-header">
            <h3>Introduction</h3>
        </div>
        <div class="card-body">
            <?php
            if(isset($_SESSION['username']))
            {
                echo '<h4 class="card-title">Hi ' . $_SESSION['username'] . '!</h4>';
            }
            else{
                echo '<h4 class="card-title">Welcome to Name!!</h4>';   
            }
            ?>
            <p class="card-text">
                *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum*

                *vehicula est vitae sollicitudin. Ut pulvinar ultricies posuere. Integer*

                *ac iaculis dui, vel rhoncus erat. In tortor nisl, vulputate quis ante*

                *vel, vestibulum luctus nunc. Phasellus id lectus ante. Vivamus ultrices,*

                *nunc ut sollicitudin hendrerit, leo tellus lacinia nulla, at porta orci*

                *orci eget eros. Nullam id ullamcorper mauris, sit amet cursus risus.*

                *Nullam a commodo metus, et facilisis velit. Maecenas volutpat mattis*

                *odio vel dignissim. Etiam ac fringilla diam, suscipit sodales ipsum. Nam*

                *in velit quam. Nunc luctus tempor leo, vel rhoncus mi mattis nec. Lorem*

                *ipsum dolor sit amet, consectetur adipiscing elit. Nullam felis massa,*

                *ultrices sit amet turpis vel, accumsan blandit est. Etiam nec eros*

                *commodo, cursus turpis pulvinar, volutpat odio.*
            </p>
            <?php
            if(isset($_SESSION['username']))
            {
                echo '<p class="card-text">*Sed vitae turpis ac nisi malesuada blandit. Quisque eu molestie eros. Donec*

                *facilisis hendrerit augue, eu adipiscing sem lacinia non. Integer*
                
                *sodales purus odio, non pharetra massa accumsan in. In vitae nunc non*
                
                *erat posuere tempus a id ipsum. Suspendisse enim augue, bibendum eget*
                
                *nunc in, lacinia ultrices tortor. Nam enim lorem, gravida eget varius*
                
                *eu, euismod et purus. Etiam egestas sem eu nisi porttitor pharetra.*
                
                *Donec eu libero eu lorem convallis porta. Nullam interdum vitae lorem*
                
                *sit amet dignissim. Proin sit amet tortor ac odio varius dapibus nec at*
                
                *Sem.*</p>';
            }
            else
            echo '<p class="card-text">Read More...</p>';
            ?>
            <?php
            if(isset($_SESSION['username'])) {
                echo '<a href="./edit/edit.php" class="btn btn-primary crd">Edit Account</a>';
                echo '<a href="./logout/logout.php" class="btn btn-primary crd">Logout</a>';
            } else {
                echo '<a href="./login/login.php" class="btn btn-primary crd">Login</a>';
                echo '<a href="./register/register.php" class="btn btn-primary crd">Register</a>';
            }
            ?>
        </div>
    </div>
</body>
</html>