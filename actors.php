<?php
//test extranet banquaire pour OCR
include ('inc_db_connection.php');
include ('constante.php');
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <title><?php echo $title ; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css"  href="style.css" />
</head>
<body>

<?php
include('header.php');
?>

<section class="presentation">
    <div class="col">
        <div class="main"><h1><?php echo $title; ?></h1></div>
        <div class="main"><p>Espace <b>Réservé</b> aux employés.</p></div>
    </div>
</section>


<!-- Grid d'affichage des partenaires -->
<div class="col">
    <div class="row"> <!-- un container par partenaire -->
        <div class="side"> <!-- container pour le logo -->
            <div class="fakeimg"><img src="/img/logo.jpg"></div>
        </div>
        <div class="main"> <!-- container pour le descriptif -->
            <h3>Nom du partenaire</h3>
            <p>Contenue textuelContenue textuelContenue textuelContenue textuel ... + Lien..</p>
            <div class="bouton">
                <a href="#" >Lire la suite...</a>
            </div>
        </div>
    </div>
    <div class="row"> <!-- un container par partenaire -->
        <div class="side"> <!-- container pour le logo -->
            <div class="fakeimg"><img src="/img/logo.jpg"></div>
        </div>
        <div class="main"> <!-- container pour le descriptif -->
            <h3>Nom du partenaire</h3>
            <p>Contenue textuelContenue textuelContenue textuelContenue textuel ... + Lien..</p>
            <div class="bouton">
                <a href="#" >Lire la suite...</a>
            </div>
        </div>
    </div>
    <div class="row"> <!-- un container par partenaire -->
        <div class="side"> <!-- container pour le logo -->
            <div class="fakeimg"><img src="/img/logo.jpg"></div>
        </div>
        <div class="main"> <!-- container pour le descriptif -->
            <h3>Nom du partenaire</h3>
            <p>Contenue textuelContenue textuelContenue textuelContenue textuel ... + Lien..</p>
            <div class="bouton">
                <a href="acteur.php" >Lire la suite...</a>
            </div>
        </div>
    </div>
</div>


<?php
include "footer.php";
?>
</body>
</html>



