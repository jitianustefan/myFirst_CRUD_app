<?php
require_once 'autoload.php';
if (!isset($_SESSION)) {
    session_start();
}
if(User::is_loggedin() !== true)
{
	// daca nu este logat fac redirect
	User::redirect('index.php');
}
$id = $_GET['id'];
$stire = new Stiri();
$res = $stire->delete($id);
if($res){
	header('location: index.php');
}else{
	echo "Failed to Delete Record";
}


?>