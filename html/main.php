
       

        <?php
        if(!isset($_SESSION)){
            session_start();
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Lista Stiri</title>
         <?php include('html/head.html');
         require_once 'autoload.php';
            ?> 
        </head>
        <body>
            <?php
            $stire = new Stiri();
            $res = $stire->read();
            while ($noutati = mysqli_fetch_assoc($res)):?>
            
    <div class="portfolio-items-wrapper">

        <div class="portfolio-item-wrapper">
            <div class="portfolio-img-background" style="background-image: url(assets/images/<?php echo $noutati['poza'];?>);" ></div>
            <div class="img-text-wrapper">
                <!-- <div class="logo-wrapper">
                    <img src="assets/images/logos/quip.png">
                </div> -->
                <div class="subtitle">
                    <a class="afisare-link" href="afisarestire.php?id=<?php echo $noutati['id'];?>">
                    <h4 class = "card-title"><?php echo $noutati['titlu'];?></h4>
                  <h6><?php echo  substr($noutati['continut'],0,100);?></h6>
              </a>
                </div>
            
        </div>
    </div>
</div>

           
            <?php endwhile;?>
        
        </body>
        </html>
        