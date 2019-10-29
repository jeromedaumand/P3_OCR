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

<!-- Header -->
<header>
    <div class="header">
        <div class="row">
            <div class="main">Page de login</div>
        </div>
    </div>
</header>
<section class="presentation">
    <div class="col">
        <div class="main"><h1><?php echo $title; ?></h1></div>
        <div class="main"><p>Espace <b>Réservé</b> aux employés.<br /></p></div>
    </div>
</section>


<section class="login">
    <div class="main">
        Mentions légales
    </div>
</section>

<?php
include "footer.php";
?>

</body>
</html>
