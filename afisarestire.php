
<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'autoload.php';
include ('html/head.html');
include ('html/header.php');
$stire = new Stiri();
$res = $stire->read($_GET['id']);
while ($noutati = mysqli_fetch_assoc($res)):?>
<div class="content-wrapperind">
        <img class="img-stire" src="assets/images/<?php echo $noutati['poza'];?>" style="max-width:400px;width:100%;margin:auto">
    
    <div class="write-content">
    <h2><?php echo $noutati['titlu'];?></h2>
    <p><?php echo $noutati['continut'];?></p>


    <?php if(User::is_loggedin() === true){ ?>

    <form method="post" action="#">
        <p><label for="continut_comm"></label>
        <textarea name="continut_comm" rows="20" cols="50" placeholder="Adugati comentariu" required></textarea>
        </p>
        <input type="submit" value="Trimite comentariu" name="trim_comm"/>
    </form>
    </div>
        <?php } ?>
<?php endwhile;

if(isset($_POST['trim_comm']) && !empty($_POST['continut_comm'])){
    $commentariu = new Stiri();
    $continut_comm=strip_tags($_POST['continut_comm']);
    $continut_comm=trim($_POST['continut_comm']);
    $id_utilizator=strip_tags($_SESSION['user_session']);
    $id_stire=strip_tags($_GET['id']);

    $inregistrare = $commentariu->comentariu($continut_comm,$id_utilizator,$id_stire);

    if($inregistrare){
        echo "Inregistrarea a avut loc cu succces";
    }else {
        echo "Adaugarea nu a avut loc cu succes!";
    }

}

//Afisarea comentariilor 


 $afis = new Stiri();
 $id_stire=strip_tags($_GET['id']);
 $res = $afis-> afiscom($id_stire);
 while ($afisare = mysqli_fetch_assoc($res)):?>
 <div class="afisarea-comm">
 <?php  
$id_utilizator=$afisare['id_utilizator'];

$sql1="SELECT id,nume,tip_utilizator FROM users WHERE id=$id_utilizator";
$instance= Database::getInstance();
$conn= $instance->getConnection();
$res1 = mysqli_query($conn, $sql1);
$rez = mysqli_fetch_assoc($res1);
?><div class="afisare-nume" ><?php echo $rez['nume'] . ": ";
 ?>  
 </div>
 <?php
 ?><div class="afisare-data-adaugare"><?php echo $afisare['ts'];?> </div> 
<div ><?php
echo $afisare['text'];
 ?></div>


<div class="button-delete">
<?php if(User::is_loggedin() === true ){ 
    $id_admin_cont=strip_tags($_SESSION['user_session']);
    $admin = User::is_admin($_SESSION['user_session']);
    
 if($id_utilizator == $id_admin_cont){
    ?> <a href="delete.php?id=<?php echo $afisare['id']?>&id-stire=<?php echo $_GET['id']?>" class="sterge-stirea">Sterge </a><?php
}elseif($admin==='ADMIN'){
    ?><a href="delete.php?id=<?php echo $afisare['id']?>&id-stire=<?php echo $_GET['id']?>" class="sterge-stirea">Sterge </a><?php
    
}


} ?>
 </div>
 </div>
 <?php endwhile;?>
</div>


