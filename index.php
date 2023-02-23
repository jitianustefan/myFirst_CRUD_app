<!DOCTYPE html>
<html lang="en">
<?php
if(!isset($_SESSION)){
    session_start();
}
require_once 'autoload.php'; 
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TemaAdvPHP</title>

    <?php include("html/head.html");?>
    <?php include("html/header.php");?>
</head>

<body>
<div class="container">
            <?php
            $stire = new Stiri();
            if(isset($_GET['categorie'])){
                $res = $stire->read33($_GET['categorie']);
            }else {
                $res = $stire->read33();
            }
            
            while ($noutati = mysqli_fetch_assoc($res)):?>
             
            
    <div class="portfolio-items-wrapper">

        <div class="portfolio-item-wrapper">
            <div class="portfolio-img-background" style="background-image: url(assets/images/<?php echo $noutati['poza'];?>);" >
        </div>        
        <div class="afisare-link">
        <a  href="afisarestire.php?id=<?php echo $noutati['id'];?>">
        <h3 class = "card-title"><?php echo $noutati['titlu'];?></h3>
        <h4><?php echo  substr($noutati['continut'],0,255);?></h4>
            </div>
            </a>
        <!-- Butonul de stergere stire -->
        <div class="button-deletenews">
    <?php if(User::is_loggedin() === true){ 
     $admin = User::is_admin($_SESSION['user_session']);
            if($admin==='ADMIN') {?> 
              
                        <a href="delete_stire?id=<?php echo $noutati['id'];?>">Sterge </a>
                     
                     <?php }  
                    } ?>
                     </div>
    </div>
</div>    
            <?php endwhile;?>
        
</div>
       
</body>


</html>