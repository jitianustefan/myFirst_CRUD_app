<?php

if(!isset($_SESSION)){
    session_start();
}
require_once 'autoload.php';

if(User::is_loggedin() !== true){
    User::redirect('logare.php');
}

if(isset($_POST) & !empty($_POST)){
    
    $stire = new Stiri();
    $stire -> setTitlu($_POST['titlu']);
   
    $stire -> setCategorie($_POST['categorie']);
    $stire -> setContinut($_POST['continut']);
    if(isset($_FILES["poza"]) && !empty($_FILES["poza"])){
        $stire->setPoza($_FILES["poza"]);
    }
    $res =$stire->create();
    if($res){
        echo "Datele au fost introduse cu succes";
        User::redirect("index.php");
    }else {
        echo "Mai lucreaza";
        print_r($_FILES);
       
    }
}