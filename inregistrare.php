<?php 
if(!isset($_SESSION)){
    session_start();
}

include ('html/head.html');
include ('html/header.php');

?>
<!DOCTYPE html>
<html>

<body>
<div class="formularinreg">
<h2>Inregistreaza-te</h2>

<form method="post" action="post_inregistrare.php">
<p>
<label>Nume</label><br>
<input type="text" name="nume" required/>
</p>
<p>
<label>Prenume</label><br>
<input type="text" name="prenume" required/>
</p>
<p>
<label>E-mail</label><br>
<input type="email" name="email" required/>
</p>
<p>
<label>Parola : </label><br>
<input type="password" name="parola_1" required/>
</p>
<p>
<label>Confirmare Parola: </label><br>
<input type="password" name="parola_2" required/>
</p>
<p>
<button type="submit" name="trim_inreg">Inregistreaza-te</button>
</p>
<p>
Sunteti deja un membru ? <a href="logare.php">Logheaza-te</a>
</p>
</form>
</div>
</body>
</html>