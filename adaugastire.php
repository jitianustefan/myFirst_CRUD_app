<?php
if(!isset($_SESSION)){
    session_start();
}
include('html/head.html');
include('html/header.php');
require_once 'autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adauga stire</title>
</head>
<body>

    <form class="formularinreg" action="post_adaugastire.php" method="post" enctype="multipart/form-data">
    <p><label for="titlu">Titlu</label>    
    <input type="text" name="titlu" required />
</p>
<p><label for="poza">Imagine </label>
        <input type="file" name="poza" required />
</p>
<p><label for="categorie"> Catrgorie </label>
        <select name="categorie">
            <option value="politica">Politica</option>
            <option value="sport">Sport</option>
            <option value="life">Life</option>
            <option value="externe">Externe</option>
        </select>
</p>
<p><label for="continut">Continut</label>
<textarea name="continut" rows="15" cols="50" placeholder="Aici va fi continut dumneavoastra"  reqiured></textarea>
</p>
<p>
    <input type="submit" name="trim_stire" value="Trimite stirea"  />
    </form>
    
</body>
</html>