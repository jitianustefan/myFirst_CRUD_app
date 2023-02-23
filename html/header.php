
<?php require_once 'autoload.php'; ?>

<nav class="nav">
    <div class="brand">
        <div> STIRILE VREMURILOR</div>
    </div>
    <div class="left-side">
        <div class="nav-link-wrapper">
            <a href="index.php">Noutati</a>
        </div>
        <div class="nav-link-wrapper">
            <a href="index.php?categorie=politica">Politica</a>
        </div>
        <div class="nav-link-wrapper">
            <a href="index.php?categorie=sport">Sport</a>
        </div>
        <div class="nav-link-wrapper">
            <a href="index.php?categorie=life">Life</a>
        </div>
        <div class="nav-link-wrapper">
            <a href="index.php?categorie=externe">Externe</a>
        </div>
    </div>
    <div class="right_side">
        
        <?php if(User::is_loggedin() === true)
        {  ?> 
        <div class="dropdown">
        <?php $instance = Database::getInstance();
            $conn = $instance->getConnection();
            $id1=$_SESSION['user_session'];
            $sql1="SELECT `nume` FROM `users` WHERE id=$id1" ;
            $res1 = mysqli_query($conn,$sql1);
            if($res1){
                $res2=mysqli_fetch_assoc($res1);
                echo "Salut " . $res2['nume'] . " !";
            }else {
                echo "Nume anonim";
            } 


            ?>
            <button class="dropbtn">Meniu
            <i class="fas fa-bars"></i>
            </button>
                <div class="dropdown-content">
                    <?php $admin = User::is_admin($_SESSION['user_session']);
                     if($admin==='ADMIN') {?> 
                            <a href="adaugastire.php">Adauga Stire </a>
                    <?php } ?>
                <a href="logout.php"> <?php echo "Logout"; ?> </a> 
                </div>
        </div>
             <?php
             
        }else {
            ?>
        <div class="simplemeniu">
            <a href="logare.php">Login </a>
            <a href="inregistrare.php">Inregistare</a>
        </div>
            <?php 
        }
        ?></a>
        
    </div>
</nav>