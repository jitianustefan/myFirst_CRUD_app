<?php
require_once 'autoload.php';
if (!isset($_SESSION)) {
    session_start();
}
$id = $_GET['id'];
$idstire = $_GET['id-stire']; 
$stire = new Stiri();
$res = $stire->deletecom($id);
if($res){
	header('location: afisarestire.php?id=' . $idstire);
}else{
	echo "Failed to Delete Record";
}


?>