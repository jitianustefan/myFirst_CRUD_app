<?php 
require_once 'autoload.php';
if(!isset($_SESSION)){
    session_start();
}

if(User::is_loggedin() === true){
    //daca este logat fac redirect 
    User::redirect('index.php');
}

if(isset($_POST)){
   $login = new User();
   $umail = strip_tags($_POST['email']);
   $upass = strip_tags($_POST['parola']);

   if($login->logare($umail,$upass)){
       User::redirect('index.php');
   }else {
       echo "Emailul sau parola gresite";
   }
}

?>