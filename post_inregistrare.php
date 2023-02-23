<?php
if(isset($_SESSION)){
    session_start();
}
require_once 'autoload.php';

if(isset($_POST)){
    $login= new USER ();
    $nume=strip_tags($_POST['nume']);
    $prenume=strip_tags($_POST['prenume']);
    $email=strip_tags($_POST['email']);
    $parola1=strip_tags($_POST['parola_1']);
    $parola2=strip_tags($_POST['parola_1']);


    if($parola1 == $parola2){
    $parola=strip_tags($_POST['parola_1']);
 }else {
        echo "Parolele nu sunt identice";
    }

    $inregistrare = $login->register($nume,$prenume,$email,$parola);

    if($inregistrare){
        $login->redirect('logare.php');
    }else{
        echo "Inregistrare esuata";
    }
}else {
    echo "Nu ati trimis date corecte";
}


?>