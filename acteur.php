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


<div class="col"><!-- un container global partenaire -->
        <div class="main"> <!-- container pour le logo -->
            <div class="fakeimg"><img src="/img/logo.jpg"></div>
        </div>
        <div class="main"> <!-- container pour le descriptif -->
            <h3>Nom du partenaire</h3>
            <p>Contenue textuelContenue textuelContenue textuelContenue textuel ... + Lien..</p>
            <div class="bouton">
                <a href="actors.php" >Retour...</a>
            </div>
        </div>
</div>

<section class="commentaire"> <!-- container pour les commentaires -->
        <div class="row">
            <div class="side">X commentaires</div>
            <div class="bouton"><p align="center"><a href="#">Nouveau<br />commentaire</a></p></div>
            <div class="bouton"><p align="center"><a href="#">X like / Y dislike</a></p></div>
        </div>

            <div class="col"><!-- commentaire -->
                <div class="main">Prénom</div>
                <div class="main">date</div>
                <div class="main">text</div>
            </div>
            <div class="col"><!-- commentaire -->
                <div class="main">Prénom</div>
                <div class="main">date</div>
                <div class="main">text</div>
            </div>
            <div class="col"><!-- commentaire -->
                <div class="main">Prénom</div>
                <div class="main">date</div>
                <div class="main">text</div>
            </div>
</section>

<?php
include "footer.php";
?>

</body>
</html>
