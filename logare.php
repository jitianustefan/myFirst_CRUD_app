<?php
require_once 'autoload.php';
if(!isset($_SESSION)){
    session_start();
}

if(User::is_loggedin() === true){
    //daca este logat fac redirect 
    User::redirect('index.php');
}
include ('html/head.html');
include ('html/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logare</title>
</head>
<body>
    <div class="formularinreg">
    <h2>Logare</h2>
    <form action="post_logare.php" method="post">
    <p>
    <label for="email">E-mail</label><br>
    <input type="email" name="email" />
    </p>
    <p>
    <label for="parola">Parola</label><br>
    <input type="password" name="parola"/>
    </p>
    <input type="submit" value="logheaza-te" name="trim_log"/>
    </form>



    </div>
</body>
</html>